<?php
/**
 * Shortcode per le parti automatiche delle pagine Elementor
 * (si inseriscono con il widget "Shortcode" di Elementor):
 *
 * [orsoline_chi_indice]     menu laterale di Chi Siamo (indice + linea storica)
 * [orsoline_spazi_menu]     menu laterale degli spazi del Collegio
 * [orsoline_spazi_nav]      link Precedente / Successivo tra gli spazi
 * [orsoline_form_contatti]  form "Scrivici" della pagina Contatti
 */

if (!defined('ABSPATH')) {
    exit;
}

/** Slug della pagina corrente (anche nell'anteprima dell'editor Elementor). */
function orsoline_current_slug()
{
    $id = get_queried_object_id() ?: get_the_ID();
    return $id ? get_post_field('post_name', $id) : '';
}

add_shortcode('orsoline_chi_indice', function () {
    $tl = [['1575', 'Parma', 'cs-1575'], ['1591', 'Maddalena Molinari', 'cs-1591'], ['1623', 'Vittoria Masi', 'cs-1623'], ['1898', 'Madre Zileri dal Verme', 'cs-1898'], ['1926', 'La prima missione in Cina', 'cs-1926'], ['1884', 'Milano', 'cs-1884'], ['1987', 'Nuovo Collegio Universitario', 'cs-1987']];
    ob_start(); ?>
<nav aria-label="In questa pagina">
  <div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#86737a;margin-bottom:16px">In questa pagina</div>
  <a class="lk hv-text" href="#cs-storia" data-jump style="display:block;cursor:pointer;font-weight:500;padding:8px 0">…dalla storia</a>
  <a class="lk hv-text" href="#cs-milano" data-jump style="display:block;cursor:pointer;font-weight:500;padding:8px 0;margin-bottom:28px">…a Milano</a>
  <div style="border-left:1px solid #e6d6da;display:flex;flex-direction:column">
    <?php foreach ($tl as [$y, $t, $id]) : ?>
    <a class="lk hv-text" href="#<?php echo $id; ?>" data-jump style="display:block;cursor:pointer;padding:7px 0 7px 18px;position:relative;font-size:14px;line-height:1.45;color:#5a4850">
      <span style="position:absolute;left:-4px;top:14px;width:7px;height:7px;border-radius:50%;background:#a0244a"></span>
      <span style="font:500 12px 'Geist Mono',monospace;color:#a0244a;margin-right:10px"><?php echo $y; ?></span><?php echo esc_html($t); ?>
    </a>
    <?php endforeach; ?>
  </div>
</nav>
    <?php
    return ob_get_clean();
});

add_shortcode('orsoline_spazi_menu', function () {
    $cur = orsoline_current_slug();
    ob_start(); ?>
<nav aria-label="Il Collegio">
  <div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#86737a;margin-bottom:12px">Il Collegio</div>
  <?php foreach (orsoline_spazi() as $i => $s) : $on = $s['slug'] === $cur; ?>
  <a class="lk hv-text" href="<?php echo esc_url(orsoline_url($s['slug'])); ?>"<?php echo $on ? ' aria-current="page"' : ''; ?> style="cursor:pointer;display:flex;gap:12px;align-items:baseline;padding:10px 0;border-bottom:1px solid #efe3e5">
    <span style="font:500 11px 'Geist Mono',monospace;color:#b4979f"><?php echo str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
    <span style="<?php echo $on ? 'font-weight:600;color:#a0244a' : ''; ?>"><?php echo esc_html($s['title']); ?></span>
  </a>
  <?php endforeach; ?>
</nav>
    <?php
    return ob_get_clean();
});

add_shortcode('orsoline_spazi_nav', function () {
    $spazi = orsoline_spazi();
    $sub = orsoline_spazio(orsoline_current_slug());
    $idx = $sub ? $sub['index'] : 0;
    $n = count($spazi);
    $prev = $spazi[($idx + $n - 1) % $n];
    $next = $spazi[($idx + 1) % $n];
    ob_start(); ?>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
  <a class="lk hv-border" href="<?php echo esc_url(orsoline_url($prev['slug'])); ?>" style="cursor:pointer;border:1px solid #efe3e5;background:#fff;border-radius:999px;padding:18px 28px;display:flex;align-items:center;gap:18px">
    <span style="width:44px;height:44px;border-radius:50%;background:#e3f2fa;color:#a0244a;display:grid;place-items:center">←</span>
    <div><div style="font:500 11px 'Geist Mono',monospace;color:#86737a">PRECEDENTE</div><div style="font-weight:600;font-size:20px"><?php echo esc_html($prev['title']); ?></div></div>
  </a>
  <a class="lk hv-border" href="<?php echo esc_url(orsoline_url($next['slug'])); ?>" style="cursor:pointer;border:1px solid #efe3e5;background:#fff;border-radius:999px;padding:18px 28px;display:flex;align-items:center;justify-content:flex-end;gap:18px;text-align:right">
    <div><div style="font:500 11px 'Geist Mono',monospace;color:#86737a">SUCCESSIVO</div><div style="font-weight:600;font-size:20px"><?php echo esc_html($next['title']); ?></div></div>
    <span style="width:44px;height:44px;border-radius:50%;background:#a0244a;color:#fff;display:grid;place-items:center">→</span>
  </a>
</div>
    <?php
    return ob_get_clean();
});

add_shortcode('orsoline_form_contatti', function () {
    $sent = isset($_GET['inviato']) && $_GET['inviato'] === '1';
    $error = isset($_GET['inviato']) && $_GET['inviato'] === '0' ? 'Non è stato possibile inviare il messaggio: controlla l’email e il consenso privacy e riprova, oppure chiamaci allo 02/6688999.' : '';
    $chips = function ($field) {
        $out = '<input type="hidden" name="' . esc_attr($field) . '" value="">';
        foreach (orsoline_form_options($field) as $o) {
            $out .= '<button type="button" class="lk" data-chip="' . esc_attr($field) . '" data-value="' . esc_attr($o) . '" style="cursor:pointer;padding:11px 18px;border-radius:999px;font-size:15px;background:#fff;color:#2a1a22;border:1px solid #e6d6da">' . esc_html($o) . '</button>';
        }
        return $out;
    };
    ob_start();
    if ($sent) : ?>
<div style="padding:48px 0;display:flex;flex-direction:column;gap:16px;align-items:flex-start">
  <div style="width:64px;height:64px;border-radius:50%;background:#f2d4d3;color:#a0244a;display:grid;place-items:center;font-size:28px">✓</div>
  <div style="font-family:'Funnel Display',sans-serif;font-size:40px;line-height:1.1">Grazie, messaggio inviato.</div>
  <a class="lk" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;color:#a0244a;text-decoration:underline;font-size:15px">Invia un altro messaggio</a>
</div>
    <?php else : ?>
<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
<input type="hidden" name="action" value="orsoline_contatti">
<?php wp_nonce_field('orsoline_contatti', 'orsoline_nonce'); ?>
<div style="position:absolute;left:-9999px" aria-hidden="true"><input type="text" name="sito_web" tabindex="-1" autocomplete="off"></div>
<div style="display:flex;flex-direction:column;gap:30px">
  <?php if ($error) : ?><p style="margin:0;color:#a0244a;font-weight:600"><?php echo esc_html($error); ?></p><?php endif; ?>
  <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">La tua email</span><input type="email" name="email" required style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px;outline-color:#a0244a"></label>
  <div style="display:flex;flex-direction:column;gap:12px"><span style="font-size:15px;font-weight:600">Relazione con la Studentessa</span>
    <div style="display:flex;gap:8px;flex-wrap:wrap"><?php echo $chips('relazione'); ?></div>
  </div>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
    <label style="display:flex;flex-direction:column;gap:10px;grid-column:1 / -1"><span style="font-size:15px;font-weight:600">Nome e Cognome della Studentessa</span><input type="text" name="nome" autocomplete="name" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px"></label>
    <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Nazionalità</span><input type="text" name="nazionalita" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px"></label>
    <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Data di nascita</span><input type="date" name="data_nascita" max="<?php echo esc_attr(wp_date('Y-m-d')); ?>" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px;color:#2a1a22"></label>
    <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Luogo di nascita</span><input type="text" name="luogo_nascita" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px"></label>
    <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Comune di residenza</span><input type="text" name="comune_residenza" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px"></label>
  </div>
  <div style="display:flex;flex-direction:column;gap:12px"><span style="font-size:15px;font-weight:600">Università</span>
    <div style="display:flex;gap:8px;flex-wrap:wrap"><?php echo $chips('universita'); ?></div>
  </div>
  <div style="display:flex;flex-direction:column;gap:12px"><span style="font-size:15px;font-weight:600">Periodo di permanenza in Collegio</span>
    <div style="display:flex;gap:8px;flex-wrap:wrap"><?php echo $chips('periodo'); ?></div>
  </div>
  <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Il tuo messaggio</span><textarea name="messaggio" rows="5" style="border:1px solid #e6d6da;background:#fbf8f7;padding:16px 22px;border-radius:24px;resize:vertical"></textarea></label>
  <label style="display:flex;gap:10px;align-items:flex-start;font-size:14px;color:#76636b"><input type="checkbox" name="privacy" value="1" required style="margin-top:4px;accent-color:#a0244a"><span>Ho letto l’informativa privacy e acconsento al trattamento dei dati.</span></label>
  <button type="submit" class="lk hv-wine" style="cursor:pointer;align-self:flex-start;background:#a0244a;color:#fff;padding:18px 40px;border-radius:999px;font-weight:600;font-size:16px">Invia →</button>
</div>
</form>
    <?php endif;
    return ob_get_clean();
});
