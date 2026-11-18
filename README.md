# Collegio Universitario Orsoline Missionarie del Sacro Cuore — nuovo sito

Nuova versione del sito https://www.collegioorsolinesacrocuoremilano.it/ (sito di riferimento per testi e immagini: **non va mai modificato**).

- **Stage:** https://mindlyc38.sg-host.com (WordPress su SiteGround, alias SSH `suoreorsoline`). È in `noindex` (`blog_public=0`) fino al go-live.
- **Go-live:** si riusa il dominio attuale, puntandolo a questo sito.

## Struttura del repository

In locale ci sono solo le cartelle versionate; core di WordPress, upload e database restano sul server.

| Cartella / file | Contenuto |
|---|---|
| `theme/` | Tema `orsoline` (attivo sullo stage) |
| `tools/elementor/` | Conversione delle pagine in Elementor (vedi il suo README) |
| `mu-plugins/`, `plugins/`, `elementor/`, `custom-code/` | Per ora vuote |
| `seo/` | URL da mantenere e redirect per il go-live |
| `deploy-theme.ps1` | Carica il tema sullo stage e controlla la sintassi PHP (`-Activate` per attivarlo) |
| `sync-from-server.ps1` | Scarica dal server le cartelle versionate |

## Pagine in Elementor

Dal 2026-11-18 i **contenuti delle pagine sono in Elementor** (plugin gratuito, versione 4.x), per dare al cliente autonomia su testi e immagini.
Header, footer, menu e banner cookie restano nel tema. È previsto il passaggio a **Elementor Pro** più avanti
(Theme Builder per header/footer, widget Form): le pagine non andranno rifatte.

- Le pagine Elementor usano `template-elementor.php` (header e footer del tema + contenuto Elementor).
- Il design è bloccato in `assets/css/elementor.css` (classi `o-xxxxxx`, generato da `tools/elementor/genera.py`):
  in Elementor si cambiano testi, link, immagini e si duplicano/spostano blocchi, ma non la grafica.
- Immagini: i riquadri "IMMAGINE · …" sono contenitori; la foto si imposta come sfondo (Stile → Sfondo), poi si cancella l'etichetta.
- Parti automatiche come widget Shortcode (`inc/shortcodes.php`): `[orsoline_chi_indice]`, `[orsoline_spazi_menu]`,
  `[orsoline_spazi_nav]`, `[orsoline_form_contatti]`.
- Impostazioni Elementor: colori e font predefiniti disattivati, Google Fonts disattivato.

I vecchi template PHP (`front-page.php`, `page-chi-siamo.php`, `template-spazio.php`, `page-contatti.php`) restano solo
come riserva per una pagina che non sia costruita con Elementor.

## Il tema `orsoline`

Ricostruzione fedele del mockup realizzato con Claude Design (https://claude.ai/artifact/HdE1bXBLmAYZaxEgauUDwq).
**Il desktop deve restare uguale al mockup.**

- Colore di base `#a0244a` (prugna, come nel mockup); sfondi rosa `#f8e7e6` e `#f2d4d3` (tonalità dal sito delle Orsoline di Parma).
- Chi Siamo e spazi del Collegio hanno il menu laterale del secondo mockup (https://claude.ai/artifact/AHtzkU1gmbHm1ZPiDTKbzv), con lo stile del sito.
- Form Contatti: `inc/contact-form.php` (email all'indirizzo amministratore di WordPress).
- Mobile/tablet: `assets/css/responsive.css` per header/footer e parti del tema, `assets/css/elementor.css` per i blocchi delle pagine
  (hamburger sotto 1100px, una colonna sotto 900px). Sopra i 1100px non cambia nulla.
- Font (Funnel Display, Funnel Sans, Geist Mono) e logo sono self-hosted in `assets/`.

Interruttori in `functions.php`:

- `orsoline_show_ux_notes` — pannello "Note UX" del mockup: **spento** su richiesta.
- `orsoline_show_new_badges` — badge "CONTENUTO NUOVO": acceso come nel mockup.
- `orsoline_show_cookie_banner` — banner cookie provvisorio (solo informativo): da spegnere quando si installa iubenda.

## SEO

Gli URL delle pagine devono restare **identici** a quelli del sito online (vedi `seo/README.md` e `seo/urls-sito-online.csv`).
Non cambiare gli slug delle pagine dalla bacheca. Al go-live: `blog_public=1` e redirect di `seo/redirects.csv`.

## Da fare

- [ ] Cookie e privacy con **iubenda** (al posto del banner provvisorio); collegare l'informativa al form Contatti e al footer.
- [ ] Sostituire i segnaposto "IMMAGINE · …" con le foto (da Elementor).
- [ ] Testi delle pagine Cappella e Sale Meeting da riportare dal sito online.
- [ ] Testi e immagini delle nuove pagine Foresteria (`/foresteria/`) ed Eventi (`/eventi/`), aggiunte il 2026-11-18.
- [ ] Tempi di percorrenza ("xx min") e recensioni reali in Home.
- [ ] Destinatario definitivo delle email del form Contatti.
- [ ] Passaggio a Elementor Pro (header/footer con Theme Builder, form Elementor) quando c'è la licenza.
- [ ] Verificare il link `/dev/contatti/` del sito online.
- [ ] Al go-live: dominio, `blog_public=1`, redirect 301.
