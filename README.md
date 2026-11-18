# Collegio Universitario Orsoline Missionarie del Sacro Cuore — nuovo sito

Nuova versione del sito https://www.collegioorsolinesacrocuoremilano.it/ (sito di riferimento per testi e immagini: **non va mai modificato**).

- **Stage:** https://mindlyc38.sg-host.com (WordPress su SiteGround, alias SSH `suoreorsoline`). È in `noindex` (`blog_public=0`) fino al go-live.
- **Go-live:** si riusa il dominio attuale, puntandolo a questo sito.

## Struttura del repository

In locale ci sono solo le cartelle versionate; core di WordPress, upload e database restano sul server.

| Cartella / file | Contenuto |
|---|---|
| `theme/` | Tema `orsoline` (attivo sullo stage) |
| `mu-plugins/`, `plugins/`, `elementor/`, `custom-code/`, `tools/` | Per ora vuote |
| `seo/` | URL da mantenere e redirect per il go-live |
| `deploy-theme.ps1` | Carica il tema sullo stage e controlla la sintassi PHP (`-Activate` per attivarlo) |
| `sync-from-server.ps1` | Scarica dal server le cartelle versionate |

## Il tema `orsoline`

Ricostruzione fedele del mockup realizzato con Claude Design (https://claude.ai/artifact/HdE1bXBLmAYZaxEgauUDwq).
**Il desktop deve restare uguale al mockup**: markup e stili inline sono quelli del mockup.

- Pagine: `front-page.php` (Home), `page-chi-siamo.php`, `template-spazio.php` (i 7 spazi del Collegio, scelto per slug in `functions.php`), `page-contatti.php`, `index.php` (pagine generiche e 404).
- Contenuti degli spazi e note UX: `inc/data.php`. Form Contatti: `inc/contact-form.php` (email all'indirizzo amministratore di WordPress).
- Mobile/tablet: `assets/css/responsive.css` (hamburger sotto 1100px, una colonna sotto 900px). Sopra i 1100px non cambia nulla.
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
- [ ] Testi e immagini modificabili da WordPress (oggi sono nei template); sostituire i segnaposto "IMMAGINE · …".
- [ ] Testi delle pagine Cappella e Sale Meeting da riportare dal sito online.
- [ ] Tempi di percorrenza ("xx min") e recensioni reali in Home.
- [ ] Destinatario definitivo delle email del form Contatti.
- [ ] Verificare il link `/dev/contatti/` del sito online.
- [ ] Al go-live: dominio, `blog_public=1`, redirect 301.
