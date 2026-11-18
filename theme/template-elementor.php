<?php
/**
 * Pagine costruite con Elementor: header e footer del tema, contenuto da Elementor.
 * Scelto automaticamente in functions.php (template_include) per ogni pagina modificata con Elementor.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
  <main>
<?php
while (have_posts()) {
    the_post();
    the_content();
}
?>
  </main>
<?php get_footer();
