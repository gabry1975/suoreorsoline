<?php
/**
 * Template generico (pagine non previste dal mockup, es. privacy policy, 404).
 * Usa titolo e briciole di pane nello stile delle pagine del mockup.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
  <main>
    <section style="max-width:1320px;margin:0 auto;padding:56px 32px 48px">
      <div style="font-size:14px;color:#86737a;display:flex;gap:8px"><a class="lk hv-text" href="<?php echo esc_url(orsoline_url()); ?>" style="cursor:pointer">Home</a><span>/</span><span style="color:#2a1a22"><?php echo is_404() ? 'Pagina non trovata' : esc_html(get_the_title()); ?></span></div>
      <h1 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(48px,7vw,96px);line-height:.95;overflow-wrap:anywhere;letter-spacing:-.045em;margin:24px 0 0"><?php echo is_404() ? 'Pagina non trovata' : esc_html(get_the_title()); ?></h1>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <article style="max-width:760px;font-size:19px;line-height:1.7;color:#3a2a31">
        <?php
        if (is_404()) {
            echo '<p><a href="' . esc_url(orsoline_url()) . '">Torna alla home</a></p>';
        } else {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }
        ?>
      </article>
    </section>
  </main>
<?php get_footer();
