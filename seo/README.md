# SEO — mantenere gli URL del sito online

Il sito di riferimento è https://www.collegioorsolinesacrocuoremilano.it/ (WordPress, permalink `/%postname%/`).
`urls-sito-online.csv` elenca le pagine indicizzate (da wp-sitemap.xml) con lo slug da mantenere.

- Lo stage ha gli stessi slug: **non cambiarli** quando si rifanno le pagine.
- Lo stage ha `blog_public=0` (noindex). **Rimetterlo a 1 solo al go-live.**
- Al go-live: stessi permalink `/%postname%/`; se un URL cambia, aggiungere un redirect 301 in `redirects.csv`.
- Fuori sitemap: esiste un link `/dev/contatti/` nel sito online (da verificare se va redirezionato).

## Dominio e identità
- Al go-live il dominio `collegioorsolinesacrocuoremilano.it` viene riutilizzato per questo sito: puntare il dominio qui, non creare un nuovo dominio.
- Titolo sito: **COLLEGIO UNIVERSITARIO ORSOLINE Missionarie del Sacro Cuore** (come nel logo).
- Favicon: stemma del logo attuale (stesso file del sito online, `cropped-orsoline-logo-new`), già impostato sullo stage.
