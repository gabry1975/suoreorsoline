<?php
/**
 * Tema Orsoline: ricostruzione del mockup di Claude Design.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ORSOLINE_VERSION', '2.8.4');

require_once __DIR__ . '/inc/data.php';
require_once __DIR__ . '/inc/contact-form.php';
require_once __DIR__ . '/inc/shortcodes.php';

/**
 * SEO (Rank Math): le pagine sono del Collegio, non di una persona.
 * Nello schema JSON-LD l'autore diventa l'organizzazione e si toglie il nodo "Person" senza nome.
 */
add_filter('rank_math/json_ld', function ($data) {
    $org = ['@id' => home_url('/#organization')];
    foreach ($data as $key => $node) {
        if (is_array($node) && ($node['@type'] ?? '') === 'Person') {
            unset($data[$key]);
            continue;
        }
        if (is_array($node) && isset($node['author'])) {
            $data[$key]['author'] = $org;
        }
    }
    return $data;
}, 99);

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
});

add_action('wp_enqueue_scripts', function () {
    $uri = get_template_directory_uri();
    wp_enqueue_style('orsoline-fonts', $uri . '/assets/css/fonts.css', [], ORSOLINE_VERSION);
    wp_enqueue_style('orsoline', get_stylesheet_uri(), ['orsoline-fonts'], ORSOLINE_VERSION);
    wp_enqueue_style('orsoline-responsive', $uri . '/assets/css/responsive.css', ['orsoline'], ORSOLINE_VERSION);
    // Stile dei blocchi Elementor (generato da tools/elementor/genera.py): dopo il CSS di Elementor.
    $deps = wp_style_is('elementor-frontend', 'registered') ? ['orsoline-responsive', 'elementor-frontend'] : ['orsoline-responsive'];
    wp_enqueue_style('orsoline-elementor', $uri . '/assets/css/elementor.css', $deps, ORSOLINE_VERSION);
    // Regole scritte a mano per i blocchi Elementor.
    wp_enqueue_style('orsoline-custom', $uri . '/assets/css/custom.css', ['orsoline-elementor'], ORSOLINE_VERSION);
    wp_enqueue_script('orsoline', $uri . '/assets/js/main.js', [], ORSOLINE_VERSION, true);
}, 20);

/** La pagina è costruita con Elementor? */
function orsoline_is_elementor_page($id = null)
{
    $id = $id ?: get_queried_object_id();
    if (!$id || !did_action('elementor/loaded')) {
        return false;
    }
    $doc = \Elementor\Plugin::$instance->documents->get($id);
    return $doc && $doc->is_built_with_elementor();
}

add_action('wp_head', function () {
    $dir = get_template_directory_uri() . '/assets/fonts/';
    foreach (['FunnelSans-latin.woff2', 'FunnelDisplay-latin.woff2'] as $f) {
        echo '<link rel="preload" href="' . esc_url($dir . $f) . '" as="font" type="font/woff2" crossorigin>' . "\n";
    }
}, 1);

/**
 * Pagine costruite con Elementor: template-elementor.php (header/footer del tema + contenuto Elementor).
 * Altrimenti i template PHP del tema; gli spazi del Collegio usano tutti template-spazio.php.
 */
add_filter('template_include', function ($template) {
    if ((is_page() || is_front_page()) && orsoline_is_elementor_page()) {
        $t = locate_template('template-elementor.php');
        if ($t) {
            return $t;
        }
    }
    if (is_page() && orsoline_spazio(get_post_field('post_name', get_queried_object_id()))) {
        $t = locate_template('template-spazio.php');
        if ($t) {
            return $t;
        }
    }
    return $template;
});

/**
 * Note UX del mockup: spente sul sito (richiesta del 2026-11-18). Per riattivarle:
 * add_filter('orsoline_show_ux_notes', '__return_true');
 * Badge "Contenuto nuovo": spenti su richiesta (2026-11-18); per riattivarli nei template PHP:
 * add_filter('orsoline_show_new_badges', '__return_true');
 */
function orsoline_show_notes()
{
    return (bool) apply_filters('orsoline_show_ux_notes', false);
}

/**
 * Banner cookie provvisorio del mockup (solo informativo, non blocca nessun cookie).
 * Da spegnere quando si installa iubenda: add_filter('orsoline_show_cookie_banner', '__return_false');
 */
function orsoline_show_cookie_banner()
{
    return (bool) apply_filters('orsoline_show_cookie_banner', true);
}

function orsoline_show_badges()
{
    return (bool) apply_filters('orsoline_show_new_badges', false);
}

/** URL di una pagina del sito a partire dallo slug (gli slug sono quelli del sito online). */
function orsoline_url($slug = '')
{
    return $slug === '' ? home_url('/') : home_url('/' . $slug . '/');
}

/** Sezione attiva del menu: home, chi, sub, contatti. */
function orsoline_current_section()
{
    if (is_front_page()) {
        return 'home';
    }
    if (is_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
        if ($slug === 'chi-siamo') {
            return 'chi';
        }
        if ($slug === 'contatti') {
            return 'contatti';
        }
        if (orsoline_spazio($slug)) {
            return 'sub';
        }
    }
    return '';
}

/** Badge "CONTENUTO NUOVO" del mockup. */
function orsoline_new_badge()
{
    if (orsoline_show_badges()) {
        echo '<span style="font:500 10px \'Geist Mono\',monospace;letter-spacing:.08em;border:1px dashed #b04a5a;color:#b04a5a;padding:4px 8px;border-radius:999px">CONTENUTO NUOVO</span>';
    }
}
