"""
2026-11-18: aggiunge gli spazi Foresteria ed Eventi.
  - pages/foresteria.json, pages/eventi.json: copia della struttura di Cappella con titoli e segnaposto nuovi
  - pages/home.json: due schede in più nella griglia "Il Collegio" (copie della scheda Giardino, larghe 2 colonne)
Da usare solo finché le pagine non sono state modificate dal cliente in Elementor.
"""
import copy
import json
import os

HERE = os.path.dirname(os.path.abspath(__file__))
P = os.path.join(HERE, 'pages')
SITE = 'https://mindlyc38.sg-host.com'

NEW = [
    ('foresteria', 'Foresteria', ['Foresteria — vista d’insieme', 'Foresteria — camera', 'Foresteria — dettaglio'], 'k'),
    ('eventi', 'Eventi', ['Eventi — momento in Collegio', 'Eventi — incontro', 'Eventi — festa'], 'l'),
]


def load(name):
    return json.load(open(os.path.join(P, name + '.json'), encoding='utf-8'))


def save(name, data):
    json.dump(data, open(os.path.join(P, name + '.json'), 'w', encoding='utf-8'), ensure_ascii=False)


def walk(nodes):
    for n in nodes:
        yield n
        yield from walk(n.get('elements', []))


def reid(nodes, prefix):
    for i, n in enumerate(walk(nodes), 1):
        n['id'] = '%s%06x' % (prefix, i)


# --- nuove pagine da Cappella ---
base = load('cappella')
for slug, title, labels, prefix in NEW:
    d = copy.deepcopy(base)
    imgs = iter(labels)
    for n in walk(d):
        s = n.get('settings', {})
        t = s.get('title')
        if t is None:
            continue
        if t == 'Cappella':
            s['title'] = title
        elif t.startswith('IMMAGINE COPERTINA'):
            s['title'] = 'IMMAGINE COPERTINA · %s — 1600×1100' % title
        elif t.startswith('[ TESTO DA RIPORTARE'):
            s['title'] = '[ TESTO DA DEFINIRE — nuova pagina /%s/ ]' % slug
        elif t.startswith('IMMAGINE · '):
            s['title'] = 'IMMAGINE · ' + next(imgs)
    reid(d, prefix)
    save(slug, d)
    print('creata', slug)

# --- due schede in più nella Home ---
home = load('home')
grid = home[3]['elements'][1]
assert grid['elements'][6]['settings']['link']['url'].endswith('/giardino/'), 'struttura della Home cambiata'
if not any(c['settings'].get('link', {}).get('url', '').endswith('/eventi/') for c in grid['elements']):
    for j, (slug, title, _, prefix) in enumerate(NEW):
        card = copy.deepcopy(grid['elements'][6])
        card['settings']['link']['url'] = '%s/%s/' % (SITE, slug)
        for n in walk([card]):
            s = n.get('settings', {})
            if 'title' in s:
                s['title'] = s['title'].replace('Giardino', title)
            n['id'] = 'h%d%05x' % (j, abs(hash(n['id'])) % 0xfffff)
        grid['elements'].append(card)
    # id univoci e stabili per le nuove schede
    for k, n in enumerate(walk(grid['elements'][7:]), 1):
        n['id'] = 'm%06x' % k
    save('home', home)
    print('home: aggiunte 2 schede')
