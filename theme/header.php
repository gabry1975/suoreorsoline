<?php
if (!defined('ABSPATH')) {
    exit;
}
$sec = orsoline_current_section();
$nb = function ($k) use ($sec) { return $sec === $k ? '#f8e7e6' : 'transparent'; };
$nf = function ($k) use ($sec) { return $sec === $k ? '#b04a5a' : '#2a1a22'; };
$logo = get_template_directory_uri() . '/assets/img/logo.png';
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div style="font-family:'Funnel Sans',system-ui,sans-serif;color:#2a1a22;background:#fbf8f7;min-height:100vh;font-size:17px;line-height:1.55">

<header class="site-header" style="position:sticky;top:0;z-index:50;padding:16px 32px 0">
  <div class="hd-in" style="max-width:1320px;margin:0 auto;height:76px;background:rgba(255,253,250,.88);backdrop-filter:blur(14px);border:1px solid #efe3e5;border-radius:20px;padding:0 10px 0 24px;display:flex;align-items:center;justify-content:space-between;gap:24px;box-shadow:0 10px 30px -18px rgba(90,20,45,.25)">
    <a class="lk" href="<?php echo esc_url(orsoline_url()); ?>" style="display:block;flex:none"><img src="<?php echo esc_url($logo); ?>" alt="Collegio Universitario Orsoline Missionarie del Sacro Cuore" style="height:clamp(38px,3.6vw,50px);width:auto;cursor:pointer;display:block;flex:none"></a>
    <button type="button" class="lk nav-toggle" aria-label="Apri il menu" aria-expanded="false" aria-controls="site-nav"><span></span><span></span><span></span></button>
    <nav id="site-nav" class="site-nav" style="display:flex;align-items:center;gap:4px;font-size:15px;font-weight:500">
      <a class="lk hv-sky" href="<?php echo esc_url(orsoline_url()); ?>" style="cursor:pointer;padding:10px clamp(10px,1.2vw,18px);white-space:nowrap;border-radius:999px;background:<?php echo $nb('home'); ?>;color:<?php echo $nf('home'); ?>">Home</a>
      <a class="lk hv-sky" href="<?php echo esc_url(orsoline_url('chi-siamo')); ?>" style="cursor:pointer;padding:10px clamp(10px,1.2vw,18px);white-space:nowrap;border-radius:999px;background:<?php echo $nb('chi'); ?>;color:<?php echo $nf('chi'); ?>">Chi Siamo</a>
      <div class="dd" style="position:relative">
        <div class="hv-sky" tabindex="0" style="cursor:pointer;padding:10px clamp(10px,1.2vw,18px);white-space:nowrap;border-radius:999px;background:<?php echo $nb('sub'); ?>;color:<?php echo $nf('sub'); ?>;display:flex;gap:8px;align-items:center">Il Collegio <span style="font-size:9px">▼</span></div>
        <div class="dd-menu" style="position:absolute;top:100%;left:50%;transform:translateX(-50%);padding-top:14px">
          <div style="width:640px;background:#ffffff;border:1px solid #efe3e5;border-radius:20px;box-shadow:0 30px 60px -24px rgba(90,20,45,.35);padding:14px;display:grid;grid-template-columns:1fr 1fr;gap:6px">
            <?php foreach (orsoline_spazi() as $s) : ?>
            <a class="lk hv-pink" href="<?php echo esc_url(orsoline_url($s['slug'])); ?>" style="cursor:pointer;display:flex;align-items:center;gap:14px;padding:10px;border-radius:18px">
              <div style="width:52px;height:52px;border-radius:14px;flex:none;background:repeating-linear-gradient(135deg,#f3e7ea 0 8px,#ebdde1 8px 16px)"></div>
              <div style="font-weight:600;font-size:16px;line-height:1.25"><?php echo esc_html($s['title']); ?></div>
            </a>
            <?php endforeach; ?>
            <?php /* Regolamento: rimanda alla sezione della Home con la scheda e il download del PDF. */ ?>
            <a class="lk hv-pink" href="<?php echo esc_url(orsoline_url() . '#regolamento'); ?>" style="cursor:pointer;display:flex;align-items:center;gap:14px;padding:10px;border-radius:18px">
              <div style="width:52px;height:52px;border-radius:14px;flex:none;background:#b04a5a;color:#fff;display:grid;place-items:center;font:500 11px 'Geist Mono',monospace">PDF</div>
              <div style="font-weight:600;font-size:16px;line-height:1.25">Regolamento</div>
            </a>
          </div>
        </div>
      </div>
      <a class="lk hv-sky" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;padding:10px clamp(10px,1.2vw,18px);white-space:nowrap;border-radius:999px;background:<?php echo $nb('contatti'); ?>;color:<?php echo $nf('contatti'); ?>">Contatti</a>
      <a class="lk hv-wine nav-cta" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;margin-left:10px;white-space:nowrap;background:#b04a5a;color:#fff;padding:15px clamp(14px,1.6vw,24px);border-radius:999px;font-weight:600;display:flex;gap:10px;align-items:center">Richiesta Informazioni <span style="width:22px;height:22px;border-radius:50%;background:#fff;color:#b04a5a;display:grid;place-items:center;font-size:12px">→</span></a>
    </nav>
  </div>
</header>
