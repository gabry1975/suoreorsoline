<?php
/**
 * Impostazioni SEO iniziali (Rank Math) — 2026-11-18.
 * Uso:  wp --user=1 eval-file imposta-seo.php
 *
 * Dopo la prima esecuzione tutto si modifica dalla bacheca:
 *  - per pagina: riquadro "Rank Math SEO" nell'editor (titolo, descrizione, parole chiave);
 *  - dati del Collegio (indirizzo, telefono, orari, logo): Rank Math > Titoli e Meta > Local SEO.
 * Rieseguire lo script SOVRASCRIVE le modifiche fatte in bacheca: usarlo solo per la configurazione iniziale.
 */

if (!defined('ABSPATH') || !class_exists('RankMath')) {
    WP_CLI::error('Rank Math non è attivo.');
}

// Logo nella libreria media (serve a Rank Math per logo dell'organizzazione e immagine social predefinita).
$logo_id = (int) get_option('orsoline_logo_media_id');
if (!$logo_id || !wp_get_attachment_url($logo_id)) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $tmp = wp_tempnam('logo.png');
    copy(get_template_directory() . '/assets/img/logo.png', $tmp);
    $logo_id = media_handle_sideload(['name' => 'logo-collegio-orsoline.png', 'tmp_name' => $tmp], 0, 'Logo Collegio Universitario Orsoline Missionarie del Sacro Cuore');
    if (is_wp_error($logo_id)) {
        WP_CLI::error($logo_id->get_error_message());
    }
    update_post_meta($logo_id, '_wp_attachment_image_alt', 'Collegio Universitario Orsoline Missionarie del Sacro Cuore');
    update_option('orsoline_logo_media_id', $logo_id);
}
$logo = wp_get_attachment_url($logo_id);

// ---------- Dati del Collegio (schema.org, Local SEO) ----------
$titles = get_option('rank-math-options-titles', []);
$titles = array_merge($titles, [
    'knowledgegraph_type'      => 'company',
    'knowledgegraph_name'      => 'Collegio Universitario Orsoline Missionarie del Sacro Cuore',
    'website_name'             => 'Collegio Universitario Orsoline Missionarie del Sacro Cuore',
    'website_alternate_name'   => 'Collegio Orsoline Milano',
    'organization_description' => 'Collegio universitario femminile di ispirazione cristiana a Milano, gestito dalle Suore Orsoline Missionarie del Sacro Cuore: residenza per studentesse universitarie dal 1987, convenzionata con l’Università Cattolica del Sacro Cuore.',
    'knowledgegraph_logo'      => $logo,
    'knowledgegraph_logo_id'   => $logo_id,
    'local_business_type'      => 'LodgingBusiness',
    'local_address'            => [
        'streetAddress'   => 'Via Adele Martignoni, 8',
        'addressLocality' => 'Milano',
        'addressRegion'   => 'MI',
        'postalCode'      => '20124',
        'addressCountry'  => 'IT',
    ],
    'local_address_format'     => '{address}, {postalcode} {locality} ({region})',
    'phone_numbers'            => [['type' => 'customer support', 'number' => '+39 02 6688999']],
    'email'                    => 'amministrazione.omscmi@gmail.com',
    'url'                      => home_url('/'),
    'geo'                      => '45.4924894, 9.1963774',
    // Orari della segreteria
    'opening_hours'            => array_merge(...array_map(function ($d) {
        return [['day' => $d, 'time' => '09:30-11:30'], ['day' => $d, 'time' => '15:00-17:00']];
    }, ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])),
    'opening_hours_format'     => 'off',
    'local_seo_about_page'     => 8,
    'local_seo_contact_page'   => 16,
    'open_graph_image'         => $logo,
    'open_graph_image_id'      => $logo_id,
    'title_separator'          => '|',
    // Schema predefinito delle pagine (Rank Math): WebPage + Article + Organizzazione.
    'pt_page_default_rich_snippet' => 'article',
]);
update_option('rank-math-options-titles', $titles);

$modules = (array) get_option('rank_math_modules', []);
foreach (['local-seo', 'sitemap', 'rich-snippet'] as $m) {
    if (!in_array($m, $modules, true)) {
        $modules[] = $m;
    }
}
update_option('rank_math_modules', array_values($modules));
update_option('rank_math_wizard_completed', true);
update_option('rank_math_registration_skip', true);
update_option('blogdescription', 'Residenza universitaria femminile a Milano, vicino alla Stazione Centrale');

// ---------- Titolo, descrizione e parole chiave per pagina ----------
// La prima parola chiave è quella principale; le altre sono secondarie.
$pagine = [
    'home' => [
        'Collegio universitario femminile Milano | Orsoline',
        'Residenza universitaria femminile a Milano, a pochi passi dalla Stazione Centrale. Camere singole e doppie, convenzione con l’Università Cattolica.',
        'collegio universitario femminile Milano, residenza universitaria femminile Milano, pensionato universitario Milano, studentato femminile Milano, alloggio per studentesse Milano',
    ],
    'chi-siamo' => [
        'Chi siamo: le Orsoline Missionarie del Sacro Cuore',
        'Educatrici dal 1575, a Milano dal 1884: la storia delle Orsoline Missionarie del Sacro Cuore e del collegio universitario femminile aperto nel 1987.',
        'Orsoline Missionarie del Sacro Cuore, collegio suore Milano, residenza universitaria cattolica Milano, storia del collegio universitario',
    ],
    'camere' => [
        'Camere singole e doppie per studentesse | Collegio Orsoline',
        'Camere singole e doppie con bagno attiguo per studentesse universitarie a Milano, personalizzabili da ciascuna ospite nel rispetto del Regolamento.',
        'camere per studentesse Milano, camera singola universitaria Milano, stanze per universitarie Milano, alloggio studentesse con bagno',
    ],
    'cappella' => [
        'La cappella del Collegio | Collegio Orsoline Milano',
        'La cappella del Collegio è sempre aperta per la preghiera personale; S. Messa il lunedì, il mercoledì e il venerdì alle 18.00.',
        'cappella collegio universitario, residenza universitaria cattolica Milano, Messa per studentesse Milano',
    ],
    'cucina' => [
        'Cucina attrezzata per studentesse | Collegio Orsoline',
        'Ampia cucina con piastre a induzione, frigoriferi e armadietti personali: in Collegio ogni studentessa autogestisce la propria alimentazione.',
        'cucina residenza universitaria, cucina in comune studentesse Milano, autogestione pasti collegio universitario',
    ],
    'portineria-e-salottini-ospiti' => [
        'Portineria e salottini ospiti | Collegio Orsoline Milano',
        'Portineria attiva ogni giorno, emergenze gestite giorno e notte; salottini per ricevere gli ospiti dalle 8:00 alle 20:00, previo accordo.',
        'portineria residenza universitaria, orari collegio universitario Milano, residenza universitaria sicura Milano',
    ],
    'spazi-comuni' => [
        'Spazi comuni, palestra e lavanderia | Collegio Orsoline',
        'Palestra, lavatrici a gettoni, stendini e assi da stiro a ogni piano: gli spazi comuni del collegio universitario femminile a Milano.',
        'palestra residenza universitaria, lavanderia studentesse Milano, spazi comuni studentato',
    ],
    'giardino' => [
        'Il giardino del Collegio | Collegio Orsoline Milano',
        'Il giardino e le piante ornamentali rendono più piacevole la vita nel collegio universitario femminile di Milano, in ogni stagione.',
        'residenza universitaria con giardino Milano, collegio universitario giardino',
    ],
    'sala-meeting' => [
        'Sale meeting e studio, Wi-Fi in fibra | Collegio Orsoline',
        'Sala meeting sul giardino, sala studio con scrivanie singole, Wi-Fi in fibra ottica e sala computer per le studentesse del Collegio.',
        'sala studio Milano studentesse, aula studio residenza universitaria, studentato con wifi Milano',
    ],
    'foresteria' => [
        'Foresteria | Collegio Orsoline Milano',
        'La foresteria del Collegio Orsoline Missionarie del Sacro Cuore a Milano, vicino alla Stazione Centrale.',
        'foresteria Milano, ospitalità religiosa Milano',
    ],
    'eventi' => [
        'Eventi in Collegio | Collegio Orsoline Milano',
        'Incontri, momenti di festa e iniziative per le studentesse del collegio universitario Orsoline Missionarie del Sacro Cuore a Milano.',
        'eventi collegio universitario Milano, vita in collegio',
    ],
    'contatti' => [
        'Contatti e richiesta informazioni | Collegio Orsoline Milano',
        'Via Adele Martignoni 8, 20124 Milano, tel. 02 6688999. Scrivici per informazioni sulla residenza universitaria; visite su appuntamento.',
        'contatti collegio universitario Milano, informazioni residenza universitaria femminile, collegio Via Adele Martignoni',
    ],
];

foreach ($pagine as $slug => [$title, $desc, $kw]) {
    $id = $slug === 'home' ? (int) get_option('page_on_front') : (int) (get_page_by_path($slug)->ID ?? 0);
    if (!$id) {
        WP_CLI::warning("Pagina non trovata: $slug");
        continue;
    }
    update_post_meta($id, 'rank_math_title', $title);
    update_post_meta($id, 'rank_math_description', $desc);
    update_post_meta($id, 'rank_math_focus_keyword', $kw);
    WP_CLI::log(sprintf('%-30s %2d car. titolo, %3d car. descrizione', $slug, mb_strlen($title), mb_strlen($desc)));
}
WP_CLI::success('Impostazioni SEO applicate.');
