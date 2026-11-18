# SEO del sito (Rank Math)

Plugin: **Rank Math SEO** (gratuito). Configurazione iniziale del 2026-11-18 con `imposta-seo.php`
(`wp --user=1 eval-file imposta-seo.php`). **Da quel momento si modifica tutto dalla bacheca**: rieseguire lo script
sovrascriverebbe le modifiche.

## Dove si modifica

- **Titolo, descrizione e parole chiave di una pagina:** apri la pagina (anche da "Modifica con Elementor") →
  riquadro / icona **Rank Math SEO** → "Modifica snippet" e "Parola chiave principale".
  La prima parola chiave è la principale, le altre sono secondarie (Rank Math gratuito ne permette fino a 5).
- **Dati del Collegio per Google** (indirizzo, telefono, email, orari segreteria, logo, coordinate):
  Rank Math → **Titoli e Meta → Local SEO**.
- **Immagine per la condivisione sui social** (Facebook, WhatsApp): Rank Math → Titoli e Meta → Globale →
  "Miniatura OpenGraph". Serve una foto di almeno 1200×630 px (il logo è troppo piccolo e viene scartato).
- **Sitemap:** `/sitemap_index.xml` (Rank Math → Sitemap).

## Parole chiave

Oltre a "collegio" si usano i sinonimi cercati da studentesse e famiglie: *residenza universitaria*, *pensionato
universitario*, *studentato*, *alloggio per studentesse*, sempre con "Milano".

| Pagina | Titolo SEO | Parole chiave (la prima è la principale) |
|---|---|---|
| Home | Collegio universitario femminile Milano \| Orsoline | collegio universitario femminile Milano, residenza universitaria femminile Milano, pensionato universitario Milano, studentato femminile Milano, alloggio per studentesse Milano |
| Chi Siamo | Chi siamo: le Orsoline Missionarie del Sacro Cuore | Orsoline Missionarie del Sacro Cuore, collegio suore Milano, residenza universitaria cattolica Milano, storia del collegio universitario |
| Camere | Camere singole e doppie per studentesse \| Collegio Orsoline | camere per studentesse Milano, camera singola universitaria Milano, stanze per universitarie Milano, alloggio studentesse con bagno |
| Cappella | La cappella del Collegio \| Collegio Orsoline Milano | cappella collegio universitario, residenza universitaria cattolica Milano, Messa per studentesse Milano |
| Cucina | Cucina attrezzata per studentesse \| Collegio Orsoline | cucina residenza universitaria, cucina in comune studentesse Milano, autogestione pasti collegio universitario |
| Portineria e Salottini Ospiti | Portineria e salottini ospiti \| Collegio Orsoline Milano | portineria residenza universitaria, orari collegio universitario Milano, residenza universitaria sicura Milano |
| Spazi Comuni | Spazi comuni, palestra e lavanderia \| Collegio Orsoline | palestra residenza universitaria, lavanderia studentesse Milano, spazi comuni studentato |
| Giardino | Il giardino del Collegio \| Collegio Orsoline Milano | residenza universitaria con giardino Milano, collegio universitario giardino |
| Sale Meeting e Studio | Sale meeting e studio, Wi-Fi in fibra \| Collegio Orsoline | sala studio Milano studentesse, aula studio residenza universitaria, studentato con wifi Milano |
| Foresteria | Foresteria \| Collegio Orsoline Milano | foresteria Milano, ospitalità religiosa Milano *(da rivedere quando ci sarà il testo)* |
| Eventi | Eventi in Collegio \| Collegio Orsoline Milano | eventi collegio universitario Milano, vita in collegio *(da rivedere quando ci sarà il testo)* |
| Contatti | Contatti e richiesta informazioni \| Collegio Orsoline Milano | contatti collegio universitario Milano, informazioni residenza universitaria femminile, collegio Via Adele Martignoni |

Le descrizioni (max ~155 caratteri) sono nello script e nel riquadro Rank Math di ogni pagina.

## Struttura tecnica (già a posto)

- Un solo **H1** per pagina; titoli di sezione in H2.
- **Dati strutturati** (schema.org): il Collegio come `LodgingBusiness` con indirizzo, coordinate, telefono, email,
  orari della segreteria e logo; ogni pagina come `WebPage` (Chi Siamo come `AboutPage`, Contatti come `ContactPage`).
  L'autore delle pagine è il Collegio (filtro `rank_math/json_ld` nel tema).
- **URL identici** al sito online (vedi `seo/README.md`), sitemap con le sole 12 pagine reali.
- Lo stage è in **noindex** (Impostazioni → Lettura): Rank Math aggiunge il *canonical* solo quando il sito è indicizzabile.

## Al go-live

1. Impostazioni → Lettura: togliere "Scoraggia i motori di ricerca".
2. Collegare **Google Search Console** (verifica da Rank Math → Generale → Strumenti per webmaster) e inviare `/sitemap_index.xml`.
3. Redirect 301 di `seo/redirects.csv`.
4. Creare/aggiornare la scheda **Google Business Profile** del Collegio con lo stesso indirizzo e telefono.
