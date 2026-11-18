<?php
if (!defined('ABSPATH')) {
    exit;
}
$logo = get_template_directory_uri() . '/assets/img/logo.png';
$sec = orsoline_current_section();
$notes = $sec !== '' ? orsoline_notes($sec) : [];
if ($sec === 'sub') {
    $notes_title = get_the_title(get_queried_object_id());
} else {
    $notes_title = ['home' => 'Home', 'chi' => 'Chi Siamo', 'contatti' => 'Contatti'][$sec] ?? '';
}
?>
<footer style="padding:0 32px 32px">
  <div style="max-width:1320px;margin:0 auto;background:#a0244a;color:#fbeef1;border-radius:24px;padding:64px 64px 32px">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;gap:32px;flex-wrap:wrap;padding-bottom:48px;border-bottom:1px solid rgba(255,255,255,.12)">
      <div style="font-weight:600;font-size:clamp(48px,6.5vw,88px);line-height:.9;letter-spacing:-.045em">Vieni a <span style="font-weight:300;color:#f2d4d3">trovarci</span></div>
      <a class="lk hv-white" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;background:#f2d4d3;color:#7d1a39;padding:18px 30px;border-radius:999px;font-weight:600">Richiesta Informazioni →</a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:32px;padding:48px 0;font-size:15px;line-height:1.7">
      <div><div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.1em;text-transform:uppercase;color:#f2d4d3;margin-bottom:14px">Contatti</div>Via Adele Martignoni, 8<br>20124 Milano (MI)<br><br>Chiamaci: 02 66 88 999<br>Email: amministrazione.omscmi@gmail.com</div>
      <div><div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.1em;text-transform:uppercase;color:#f2d4d3;margin-bottom:14px">Servizio Portineria</div>giorni feriali<br><strong style="font-weight:600">dalle 7:00 alle 24:00</strong><br>sabato<br><strong style="font-weight:600">dalle 7:00 all’1:00</strong><br>giorni festivi<br><strong style="font-weight:600">dalle 8:00 alle 24:00</strong></div>
      <div><div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.1em;text-transform:uppercase;color:#f2d4d3;margin-bottom:14px">Orari Segreteria</div>Da lunedì a venerdì<br><strong style="font-weight:600">9:30-11:30 e 15:00-17:00</strong></div>
      <div><div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.1em;text-transform:uppercase;color:#f2d4d3;margin-bottom:14px">CIN</div>(Codice Identificativo Nazionale)<br><span style="font-family:'Geist Mono',monospace;font-size:14px">IT015146B7SJG2IHDW</span></div>
    </div>
    <div style="display:flex;justify-content:space-between;align-items:center;gap:24px;flex-wrap:wrap;font-size:13px;color:#ecd5db;padding-top:24px;border-top:1px solid rgba(255,255,255,.12)">
      <div style="background:#ffffff;border-radius:999px;padding:8px 18px"><img src="<?php echo esc_url($logo); ?>" alt="Collegio Orsoline Sacro Cuore" style="height:36px;width:auto;display:block"></div>
      <div style="display:flex;gap:20px">
        <a class="lk hv-textw" href="<?php echo esc_url(orsoline_url()); ?>" style="cursor:pointer">Home</a>
        <a class="lk hv-textw" href="<?php echo esc_url(orsoline_url('chi-siamo')); ?>" style="cursor:pointer">Chi Siamo</a>
        <a class="lk hv-textw" href="<?php echo esc_url(orsoline_url('cappella')); ?>" style="cursor:pointer">Il Collegio</a>
        <a class="lk hv-textw" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer">Contatti</a>
      </div>
      <span>Copyright © 2021 Collegio "Orsoline Missionarie del Sacro Cuore" - Milano / All Rights Reserved</span>
    </div>
  </div>
</footer>

<?php if (orsoline_show_cookie_banner()) : ?>
<div id="orsoline-cookie" hidden style="position:fixed;left:24px;bottom:24px;z-index:60;max-width:440px;background:#ffffff;border:1px solid #efe3e5;color:#3a2a31;padding:20px 22px;border-radius:20px;font-size:13px;line-height:1.55;display:flex;gap:16px;align-items:center;box-shadow:0 20px 48px -16px rgba(90,20,45,.35)">
  <span>Utilizziamo i cookie per essere sicuri che tu possa avere la migliore esperienza sul nostro sito. Se continui ad utilizzare questo sito noi assumiamo che tu ne sia felice.</span>
  <button type="button" class="lk" data-cookie-ok style="cursor:pointer;background:#a0244a;color:#fff;padding:10px 18px;border-radius:999px;font-weight:600">Ok</button>
</div>
<?php endif; ?>

<?php if (orsoline_show_notes() && $notes) : ?>
<div id="orsoline-notes" style="position:fixed;right:24px;bottom:24px;z-index:70;width:350px;background:#a0244a;color:#fbeef1;border-radius:24px;box-shadow:0 20px 48px -16px rgba(0,0,0,.4);font-size:13px;line-height:1.55;overflow:hidden">
  <div style="display:flex;justify-content:space-between;align-items:center;padding:16px 20px;border-bottom:1px solid rgba(255,255,255,.1)">
    <span style="font:500 11px 'Geist Mono',monospace;letter-spacing:.1em;text-transform:uppercase;color:#f2d4d3">Note UX v5 · <?php echo esc_html($notes_title); ?></span>
    <button type="button" class="lk" data-notes-hide aria-label="Chiudi note" style="cursor:pointer;opacity:.6;font-size:16px">×</button>
  </div>
  <ol style="margin:0;padding:14px 20px 18px 36px;display:flex;flex-direction:column;gap:8px">
    <?php foreach ($notes as $n) : ?><li><?php echo esc_html($n); ?></li><?php endforeach; ?>
  </ol>
</div>
<button type="button" class="lk" id="orsoline-notes-btn" hidden style="position:fixed;right:24px;bottom:24px;z-index:70;cursor:pointer;background:#a0244a;color:#f2d4d3;padding:12px 18px;border-radius:999px;font:500 11px 'Geist Mono',monospace;letter-spacing:.1em">NOTE UX</button>
<?php endif; ?>

</div>
<?php wp_footer(); ?>
</body>
</html>
