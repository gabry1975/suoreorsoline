# Conversione delle pagine in Elementor

Strumenti usati il 2026-11-18 per portare le pagine del tema (HTML con stili inline) in Elementor.

- `src/` — HTML delle pagine come erano prima della conversione (riferimento).
- `genera.py` — crea `pages/<slug>.json` (dati Elementor) e `theme/assets/css/elementor.css` (stile dei blocchi).
- `save.php` — salva un JSON in una pagina: `wp --user=1 eval-file save.php <ID> <file.json>`
  (va eseguito **come amministratore**, altrimenti Elementor ripulisce i contenuti).

## Attenzione

**Non risalvare le pagine dai JSON dopo che il cliente le ha modificate in Elementor**: si perderebbero le sue modifiche.
Da quel momento le pagine si modificano solo in Elementor.

`elementor.css` si può rigenerare solo se `src/` non cambia (le classi `o-xxxxxx` dipendono dagli stili originali).
Per nuovi stili, aggiungere regole a mano in un altro file CSS del tema invece di rigenerare.

## Come funziona

- Testi → widget Titolo / Editor di testo; link a forma di bottone → widget Bottone; gruppi → contenitori.
- Riquadri "IMMAGINE · …" → contenitori con sfondo a righe: si sostituisce con una foto da
  Elementor (Stile → Sfondo), poi si cancella l'etichetta.
- Parti automatiche → widget Shortcode: `[orsoline_chi_indice]`, `[orsoline_spazi_menu]`,
  `[orsoline_spazi_nav]`, `[orsoline_form_contatti]` (vedi `theme/inc/shortcodes.php`).
- Lo stile è nelle classi con `!important`: il design resta quello del mockup anche se si cambiano
  gli stili dei widget in Elementor.

Verifica fatta dopo la conversione: screenshot desktop (1440px) e mobile (390px) di tutte le 10 pagine
confrontati pixel per pixel con quelli di prima → identici.
