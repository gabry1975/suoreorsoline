"""
Converte le pagine del tema (HTML con stili inline, in src/) in pagine Elementor.

Uscite:
  pages/<slug>.json             dati Elementor da salvare con save.php
  ../../theme/assets/css/elementor.css   stile dei blocchi (classi o-xxxxxx), compreso il mobile

Regole:
  - elementi con testo        -> widget Titolo / Editor di testo / Bottone
  - elementi con figli        -> contenitore (link se era un <a>)
  - aside dei menu, prev/next e form -> widget Shortcode
  - ogni stile inline diventa una classe; le regole mobile di responsive.css basate
    su [style*="..."] vengono applicate alle stesse classi.

Uso:  python -I genera.py
"""
import hashlib
import json
import os
import re
import sys

from bs4 import BeautifulSoup, NavigableString, Tag

HERE = os.path.dirname(os.path.abspath(__file__))
SRC = os.path.join(HERE, 'src')
OUT = os.path.join(HERE, 'pages')
THEME = os.path.normpath(os.path.join(HERE, '..', '..', 'theme'))
CSS_OUT = os.path.join(THEME, 'assets', 'css', 'elementor.css')
RESPONSIVE = os.path.join(THEME, 'assets', 'css', 'responsive.css')

PAGES = ['home', 'chi-siamo', 'cappella', 'portineria-e-salottini-ospiti', 'sala-meeting',
         'camere', 'cucina', 'spazi-comuni', 'giardino', 'contatti']

# Proprietà che vanno sul contenitore del widget (posizionamento nel layout del genitore).
WRAP = {'position', 'top', 'right', 'bottom', 'left', 'inset', 'z-index', 'grid-column', 'grid-row',
        'grid-area', 'align-self', 'justify-self', 'flex', 'flex-grow', 'flex-shrink', 'flex-basis',
        'order', 'margin', 'margin-top', 'margin-right', 'margin-bottom', 'margin-left'}
HEADINGS = {'h1', 'h2', 'h3', 'h4', 'h5', 'h6'}
INLINE_TAGS = {'span', 'a', 'label', 'strong', 'em', 'b', 'i', 'small'}

# Classi leggibili per gli stili in linea più comuni dentro i testi.
NAMED_INLINE = {
    'font-weight:300;color:#a0244a': 'o-accent',
    'font-weight:300;color:#f2d4d3': 'o-accent-chiaro',
}


def parse_style(s):
    out = []
    for part in (s or '').split(';'):
        if ':' in part:
            k, v = part.split(':', 1)
            out.append((k.strip().lower(), v.strip()))
    return out


def decls(props, important=True):
    res = []
    for k, v in props:
        if k == 'background' and 'gradient(' in v:
            # Sfondo a righe dei segnaposto: senza !important, così lo sfondo impostato in Elementor lo sostituisce.
            res.append('background-image:%s' % v)
            continue
        res.append('%s:%s%s' % (k, v, '!important' if important else ''))
    return ';'.join(res)


class Gen:
    def __init__(self):
        self.rules = {}        # selettore -> dichiarazioni (base)
        self.order = []
        self.inline = {}       # stile inline -> classe
        self.elements = []     # (classe, tipo, stile originale, livello-alto)
        self.seen_cls = set()
        self.counter = 0
        self.prefix = 'a'

    # ---------- utilità ----------
    def new_id(self):
        self.counter += 1
        return '%s%06x' % (self.prefix, self.counter)

    def add_rule(self, sel, body):
        if not body:
            return
        if sel not in self.rules:
            self.order.append(sel)
            self.rules[sel] = body

    def cls_for(self, kind, style, extra=''):
        key = '%s|%s|%s' % (kind, style, extra)
        return 'o-' + hashlib.md5(key.encode()).hexdigest()[:6]

    def inline_html(self, el):
        """HTML interno di un elemento di testo, con gli stili inline trasformati in classi."""
        frag = BeautifulSoup(el.decode_contents(), 'html.parser')
        for t in frag.find_all(True):
            st = t.get('style')
            if st is not None:
                norm = ';'.join('%s:%s' % kv for kv in parse_style(st))
                c = NAMED_INLINE.get(norm) or self.inline.get(norm)
                if not c:
                    c = 'o-i-' + hashlib.md5(norm.encode()).hexdigest()[:6]
                self.inline[norm] = c
                self.add_rule('.elementor .' + c, decls(parse_style(st)))
                del t['style']
                t['class'] = (t.get('class') or []) + [c]
            for a in ('data-jump',):
                if t.has_attr(a):
                    del t[a]
        return str(frag).strip()

    @staticmethod
    def has_text(el):
        return any(isinstance(c, NavigableString) and c.strip() for c in el.children)

    @staticmethod
    def kids(el):
        return [c for c in el.children if isinstance(c, Tag)]

    @staticmethod
    def parent_display(el):
        d = dict(parse_style(el.parent.get('style') if el.parent else ''))
        return d.get('display', 'block')

    def extra_classes(self, el):
        return [c for c in (el.get('class') or []) if c.startswith('hv-')]

    # ---------- conversione ----------
    def convert_children(self, el, top=False):
        out = []
        kids = self.kids(el)
        # Si raggruppano i paragrafi solo se il genitore è "a blocchi" (in flex/grid lo spazio tra paragrafi è il gap).
        pd = dict(parse_style(el.get('style', ''))).get('display', 'block')
        can_group = pd not in ('flex', 'inline-flex', 'grid')
        i = 0
        while i < len(kids):
            k = kids[i]
            # Paragrafi consecutivi uguali (senza id) -> un solo Editor di testo.
            if can_group and k.name == 'p' and not k.get('id') and self.has_text(k):
                group = [k]
                while i + 1 < len(kids) and kids[i + 1].name == 'p' and not kids[i + 1].get('id') \
                        and kids[i + 1].get('style') == k.get('style'):
                    i += 1
                    group.append(kids[i])
                out.append(self.text_widget(group))
            else:
                node = self.convert(k, top)
                if node:
                    out.append(node)
            i += 1
        return out

    def convert(self, el, top=False):
        style = el.get('style', '')
        classes = el.get('class') or []
        # Parti automatiche -> shortcode
        if el.name == 'aside' and 'cs-aside' in classes:
            return self.shortcode('[orsoline_chi_indice]', style, ['cs-aside'])
        if el.name == 'aside' and 'sp-aside' in classes:
            return self.shortcode('[orsoline_spazi_menu]', style, ['sp-aside'])
        if el.name == 'form':
            return self.shortcode('[orsoline_form_contatti]', '', [])
        if el.name == 'div' and 'PRECEDENTE' in el.get_text() and all(c.name == 'a' for c in self.kids(el)):
            return self.shortcode('[orsoline_spazi_nav]', '', [])

        if self.has_text(el) or (not self.kids(el) and el.get_text(strip=True)):
            return self.leaf(el)
        return self.container(el, top)

    def container(self, el, top):
        style = el.get('style', '')
        cls = self.cls_for('con', style)
        props = parse_style(style)
        self.add_rule('.elementor .e-con.' + cls, decls(props))
        self.elements.append((cls, 'con', style, top))
        settings = {'content_width': 'full', 'css_classes': ' '.join(['o', cls] + self.extra_classes(el))}
        if el.name in ('section', 'article', 'aside', 'header', 'footer', 'nav', 'main'):
            settings['html_tag'] = el.name
        if el.name == 'a':
            settings['html_tag'] = 'a'
            settings['link'] = {'url': el.get('href', ''), 'is_external': 'on' if el.get('target') == '_blank' else '', 'nofollow': ''}
            settings['css_classes'] += ' lk'
        if el.get('id'):
            settings['_element_id'] = el['id']
        return {'id': self.new_id(), 'elType': 'container', 'isInner': not top, 'settings': settings,
                'elements': self.convert_children(el)}

    def leaf(self, el):
        style = el.get('style', '')
        props = parse_style(style)
        wrap = [(k, v) for k, v in props if k in WRAP]
        inner = [(k, v) for k, v in props if k not in WRAP]
        pdisp = self.parent_display(el)
        d = dict(props)
        if el.name == 'a':
            kind = 'btn'
        elif el.name in ('p', 'blockquote'):
            return self.text_widget([el])
        else:
            kind = 'head'
        # display del testo: come l'originale; gli elementi in linea restano in linea solo in un genitore "a blocchi"
        if 'display' not in d:
            inline_ctx = el.name in INLINE_TAGS and pdisp not in ('flex', 'inline-flex', 'grid') \
                and d.get('position') not in ('absolute', 'fixed')
            inner.append(('display', 'inline' if inline_ctx else 'block'))
        cls = self.cls_for(kind, style, pdisp + el.name)
        self.elements.append((cls, kind, style, False))
        self.add_rule('.elementor .elementor-widget.' + cls, decls(wrap))
        extra = self.extra_classes(el)
        if kind == 'btn':
            self.add_rule('.elementor .%s .elementor-button' % cls, decls(inner))
            settings = {'text': self.inline_html(el), '_css_classes': ' '.join(['o', 'o-btn', cls] + extra),
                        'link': {'url': el.get('href', ''), 'is_external': 'on' if el.get('target') == '_blank' else '', 'nofollow': ''}}
            wt = 'button'
        else:
            self.add_rule('.elementor .%s .elementor-heading-title' % cls, decls(inner))
            tag = el.name if el.name in HEADINGS else ('span' if el.name in INLINE_TAGS else 'div')
            settings = {'title': self.inline_html(el), 'header_size': tag, '_css_classes': ' '.join(['o', cls] + extra)}
            wt = 'heading'
        if el.get('id'):
            settings['_element_id'] = el['id']
        return {'id': self.new_id(), 'elType': 'widget', 'widgetType': wt, 'settings': settings, 'elements': []}

    def text_widget(self, group):
        el = group[0]
        style = el.get('style', '')
        props = parse_style(style)
        if el.name == 'p':
            margin = [(k, v) for k, v in props if k.startswith('margin')] or [('margin', '0')]
            rest = [(k, v) for k, v in props if not k.startswith('margin')]
        else:
            margin, rest = [('margin', '0')], props
        cls = self.cls_for('txt', style, el.name)
        self.elements.append((cls, 'txt-' + el.name, style, False))
        self.add_rule('.elementor .elementor-widget.' + cls, decls(rest))
        self.add_rule('.elementor .%s p' % cls, decls(margin))
        html = ''.join('<p>%s</p>' % self.inline_html(p) for p in group)
        settings = {'editor': html, '_css_classes': ' '.join(['o', cls])}
        if el.get('id'):
            settings['_element_id'] = el['id']
        return {'id': self.new_id(), 'elType': 'widget', 'widgetType': 'text-editor', 'settings': settings, 'elements': []}

    def shortcode(self, code, style, extra):
        props = [(k, v) for k, v in parse_style(style) if k in WRAP]
        cls = self.cls_for('sc', style, code)
        self.add_rule('.elementor .elementor-widget.' + cls, decls(props))
        return {'id': self.new_id(), 'elType': 'widget', 'widgetType': 'shortcode',
                'settings': {'shortcode': code, '_css_classes': ' '.join(['o', cls] + extra)}, 'elements': []}

    # ---------- mobile ----------
    def responsive(self):
        css = open(RESPONSIVE, encoding='utf-8').read()
        css = re.sub(r'/\*.*?\*/', '', css, flags=re.S)
        blocks = []
        for m in re.finditer(r'@media\s*\(([^)]*)\)\s*\{((?:[^{}]*\{[^{}]*\})*)\s*\}', css):
            rules = re.findall(r'([^{}]+)\{([^{}]*)\}', m.group(2))
            blocks.append((m.group(1).strip(), rules))
        out = []
        for media, rules in blocks:
            body = []
            for sels, dec in rules:
                props = [(k, v.replace('!important', '').strip()) for k, v in parse_style(dec)]
                # separa i selettori sulle virgole fuori dalle virgolette (es. clamp(52px,6vw,84px))
                for sel in [s.strip() for s in re.split(r',(?=(?:[^"]*"[^"]*")*[^"]*$)', sels)]:
                    mm = re.fullmatch(r'\[style\*="([^"]+)"\](.*)', sel)
                    if not mm:
                        continue
                    needle, suffix = mm.group(1), mm.group(2).strip()
                    for cls, kind, style, top in self.elements:
                        if needle not in style:
                            continue
                        body.extend(self.target_rules(cls, kind, props, suffix))
            if media.startswith('max-width:900px'):
                for cls, kind, style, top in self.elements:
                    if top:
                        body.append('.elementor .e-con.%s{padding-left:16px!important;padding-right:16px!important}' % cls)
            if body:
                out.append('@media (%s){\n  %s\n}' % (media, '\n  '.join(dict.fromkeys(body))))
        return '\n'.join(out)

    def target_rules(self, cls, kind, props, suffix):
        res = []
        if suffix:
            child = suffix.replace('>', '').strip()
            child = re.sub(r'^div', '', child)
            res.append('.elementor .e-con.%s > %s{%s}' % (cls, child or '*', decls(props)))
            return res
        if kind == 'con':
            res.append('.elementor .e-con.%s{%s}' % (cls, decls(props)))
            return res
        wrap = [(k, v) for k, v in props if k in WRAP]
        inner = [(k, v) for k, v in props if k not in WRAP]
        if kind.startswith('txt'):
            if kind == 'txt-p':
                m = [(k, v) for k, v in props if k.startswith('margin')]
                r = [(k, v) for k, v in props if not k.startswith('margin')]
                if m:
                    res.append('.elementor .%s p{%s}' % (cls, decls(m)))
                if r:
                    res.append('.elementor .elementor-widget.%s{%s}' % (cls, decls(r)))
            else:
                res.append('.elementor .elementor-widget.%s{%s}' % (cls, decls(props)))
            return res
        if wrap:
            res.append('.elementor .elementor-widget.%s{%s}' % (cls, decls(wrap)))
        if inner:
            target = '.elementor-button' if kind == 'btn' else '.elementor-heading-title'
            res.append('.elementor .%s %s{%s}' % (cls, target, decls(inner)))
        return res


BASE_CSS = """/*
 * Stile dei blocchi Elementor del tema Orsoline.
 * FILE GENERATO da tools/elementor/genera.py: non modificarlo a mano.
 * Le classi o-xxxxxx sono assegnate ai contenitori/widget delle pagine (campo "Classi CSS" in Elementor).
 * Le proprietà sono !important: il design resta quello del mockup anche se si cambiano gli stili in Elementor;
 * lo sfondo dei riquadri immagine invece si può sostituire da Elementor (Stile > Sfondo).
 */

/* Azzera i default di Elementor sui blocchi del tema */
.elementor .e-con.o{display:block!important;flex-direction:row!important;flex-wrap:nowrap!important;justify-content:normal!important;align-items:normal!important;align-content:normal!important;gap:normal!important;width:auto!important;max-width:none!important;min-width:0;height:auto!important;min-height:0!important;padding:0!important;margin:0!important;position:static!important;overflow:visible!important;z-index:auto!important;border-radius:0!important;transition:none!important;flex:0 1 auto!important;align-self:auto!important;order:0!important;color:inherit}
.elementor .elementor-widget.o{margin:0!important;position:static!important;flex:0 1 auto!important;align-self:auto!important;width:auto!important;max-width:none!important}
.elementor .o .elementor-heading-title{margin:0!important;padding:0!important;line-height:inherit!important;color:inherit;font-family:inherit}
.elementor .o :where(div,span).elementor-heading-title{font-size:inherit!important;font-weight:inherit!important}
.elementor .o-btn .elementor-button{background:none!important;border:0!important;border-radius:0!important;padding:0!important;margin:0!important;font:inherit!important;color:inherit!important;line-height:inherit!important;letter-spacing:inherit!important;text-transform:none!important;text-decoration:none!important;box-shadow:none!important;transition:none!important;width:auto!important;text-align:inherit!important;display:inline!important;fill:currentColor}
.elementor .o-btn .elementor-button-content-wrapper,.elementor .o-btn .elementor-button-text{display:contents!important}
.elementor a.e-con.o{text-decoration:none!important}
.elementor .elementor-widget-text-editor.o{color:inherit}
"""


def main():
    g = Gen()
    os.makedirs(OUT, exist_ok=True)
    for i, slug in enumerate(PAGES):
        g.prefix = 'abcdefghij'[i]
        g.counter = 0
        soup = BeautifulSoup(open(os.path.join(SRC, slug + '.html'), encoding='utf-8').read(), 'html.parser')
        main_el = soup.find('main')
        data = [g.convert(s, top=True) for s in g.kids(main_el)]
        json.dump(data, open(os.path.join(OUT, slug + '.json'), 'w', encoding='utf-8'), ensure_ascii=False)
        n = len(json.dumps(data))
        print('%-32s %d sezioni, %d byte' % (slug, len(data), n))
    css = BASE_CSS + '\n/* Blocchi */\n' + '\n'.join('%s{%s}' % (s, g.rules[s]) for s in g.order) \
        + '\n\n/* Mobile e tablet (da responsive.css) */\n' + g.responsive() + '\n'
    open(CSS_OUT, 'w', encoding='utf-8', newline='\n').write(css)
    print('CSS: %d regole, %d byte' % (len(g.order), len(css)))


if __name__ == '__main__':
    sys.exit(main())
