<?php
/**
 * Spazi del Collegio: cappella, portineria-e-salottini-ospiti, sala-meeting, camere, cucina, spazi-comuni, giardino.
 * Template scelto in functions.php (template_include) in base allo slug della pagina.
 */
if (!defined('ABSPATH')) {
    exit;
}
$spazi = orsoline_spazi();
$sub = orsoline_spazio(get_post_field('post_name', get_queried_object_id()));
$idx = $sub['index'];
$paras = $sub['paras'] ?? [];
$lead = $paras[0] ?? null;
$rest = array_slice($paras, 1);
$cols = (!empty($sub['cite']) && !empty($sub['statement'])) ? '1fr 1fr' : '1fr';
$prev = $spazi[($idx + 6) % 7];
$next = $spazi[($idx + 1) % 7];
get_header();
?>
  <main>
    <section style="max-width:1320px;margin:0 auto;padding:40px 32px 0">
      <div style="display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1.25fr);gap:20px;min-height:520px">
        <div style="background:#b04a5a;color:#fff;border-radius:24px;padding:48px;display:flex;flex-direction:column;justify-content:space-between">
          <div style="font-size:14px;opacity:.8;display:flex;gap:8px"><a class="lk" href="<?php echo esc_url(orsoline_url()); ?>" style="cursor:pointer">Home</a><span>/</span><span>Il Collegio</span></div>
          <div>
            <div style="width:56px;height:4px;border-radius:2px;background:#f7d9df;margin-bottom:28px"></div>
            <h1 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(52px,6vw,84px);overflow-wrap:anywhere;line-height:.98;letter-spacing:-.035em;margin:0;text-wrap:balance"><?php echo esc_html($sub['title']); ?></h1>
          </div>
        </div>
        <div style="border-radius:24px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;padding:22px">
          <span style="font:500 11px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:7px 12px;border-radius:999px">IMMAGINE COPERTINA · <?php echo esc_html($sub['title']); ?> — 1600×1100</span>
        </div>
      </div>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:88px 32px 100px;display:grid;grid-template-columns:240px minmax(0,1fr);gap:72px">
      <?php /* Menu laterale degli spazi: struttura del secondo mockup, stile del sito. */ ?>
      <aside class="sp-aside" style="position:sticky;top:120px;align-self:start">
        <div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#86737a;margin-bottom:12px">Il Collegio</div>
        <?php foreach ($spazi as $i => $s) : $on = $s['slug'] === $sub['slug']; ?>
        <a class="lk hv-text" href="<?php echo esc_url(orsoline_url($s['slug'])); ?>"<?php echo $on ? ' aria-current="page"' : ''; ?> style="cursor:pointer;display:flex;gap:12px;align-items:baseline;padding:10px 0;border-bottom:1px solid #efe3e5">
          <span style="font:500 11px 'Geist Mono',monospace;color:#b4979f"><?php echo str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
          <span style="<?php echo $on ? 'font-weight:600;color:#b04a5a' : ''; ?>"><?php echo esc_html($s['title']); ?></span>
        </a>
        <?php endforeach; ?>
      </aside>
      <div style="min-width:0">
      <?php if (!empty($sub['missing'])) : ?>
        <div style="border:1.5px dashed #c99aa6;background:#fff;border-radius:24px;padding:28px 32px;margin-bottom:48px;max-width:860px;font:14px/1.6 'Geist Mono',monospace;color:#76636b">[ TESTO DA RIPORTARE INVARIATO DAL SITO ATTUALE — pagina /<?php echo esc_html($sub['slug']); ?>/ ]</div>
      <?php endif; ?>
      <div style="display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:80px;margin-bottom:72px">
        <?php if ($lead) : ?>
          <p style="margin:0;font-size:34px;line-height:1.2;letter-spacing:-.02em;font-weight:500;text-wrap:pretty"><?php echo esc_html($lead); ?></p>
        <?php endif; ?>
        <div style="display:flex;flex-direction:column;gap:18px;font-size:18px;color:#3a2a31">
          <?php foreach ($rest as $p) : ?><p style="margin:0;text-wrap:pretty"><?php echo esc_html($p); ?></p><?php endforeach; ?>
        </div>
      </div>
      <?php if (!empty($sub['showHours'])) : ?>
        <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:72px">
          <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px"><div style="background:#e3f2fa;color:#b04a5a;display:inline-block;padding:5px 12px;border-radius:999px;font-size:13px;font-weight:500;margin-bottom:24px">giorni feriali</div><div style="font-family:'Funnel Display',sans-serif;font-size:40px;line-height:1">7:00 – 24:00</div></div>
          <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px"><div style="background:#e3f2fa;color:#b04a5a;display:inline-block;padding:5px 12px;border-radius:999px;font-size:13px;font-weight:500;margin-bottom:24px">sabato</div><div style="font-family:'Funnel Display',sans-serif;font-size:40px;line-height:1">7:00 – 1:00</div></div>
          <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px"><div style="background:#e3f2fa;color:#b04a5a;display:inline-block;padding:5px 12px;border-radius:999px;font-size:13px;font-weight:500;margin-bottom:24px">giorni festivi</div><div style="font-family:'Funnel Display',sans-serif;font-size:40px;line-height:1">8:00 – 24:00</div></div>
        </div>
      <?php endif; ?>
      <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));grid-auto-rows:300px;gap:16px;margin-bottom:72px">
        <?php foreach ($sub['imgs'] as $im) : $im += ['col' => 'span 1', 'row' => 'span 1', 'caption' => null]; ?>
          <figure style="margin:0;grid-column:<?php echo $im['col']; ?>;grid-row:<?php echo $im['row']; ?>;border-radius:20px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;flex-direction:column;justify-content:space-between;align-items:flex-start;padding:16px">
            <span style="font:500 10px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:5px 9px;border-radius:999px">IMMAGINE · <?php echo esc_html($im['label']); ?></span>
            <?php if ($im['caption']) : ?><figcaption style="background:#fff;color:#b04a5a;padding:8px 14px;border-radius:999px;font-family:'Funnel Display',sans-serif;font-size:17px"><?php echo esc_html($im['caption']); ?></figcaption><?php endif; ?>
          </figure>
        <?php endforeach; ?>
      </div>
      <div style="display:grid;grid-template-columns:<?php echo $cols; ?>;gap:16px;margin-bottom:72px">
        <?php if (!empty($sub['cite'])) : ?>
          <div style="background:#e3f2fa;border-radius:20px;padding:40px;display:flex;flex-direction:column;gap:20px">
            <span style="align-self:flex-start;background:#fff;color:#b04a5a;padding:6px 14px;border-radius:999px;font-size:13px;font-weight:500"><?php echo esc_html($sub['citeSrc']); ?></span>
            <p style="margin:0;font-family:'Funnel Display',sans-serif;font-size:28px;line-height:1.3;color:#2a1a22"><?php echo esc_html($sub['cite']); ?></p>
          </div>
        <?php endif; ?>
        <?php if (!empty($sub['statement'])) : ?>
          <div style="background:#d4ecf7;color:#173f57;border-radius:20px;padding:40px;display:flex;flex-direction:column;justify-content:center">
            <span style="color:#b04a5a;font-size:24px;margin-bottom:16px">✦</span>
            <p style="font-size:30px;line-height:1.2;letter-spacing:-.015em;font-weight:500;margin:0;text-wrap:balance"><?php echo esc_html($sub['statement']); ?></p>
            <?php if (!empty($sub['statement2'])) : ?><p style="font-family:'Funnel Display',sans-serif;font-size:28px;line-height:1.3;margin:16px 0 0;color:#b04a5a"><?php echo esc_html($sub['statement2']); ?></p><?php endif; ?>
            <?php if (!empty($sub['statementNote'])) : ?><p style="font-size:14px;margin:20px 0 0;opacity:.65"><?php echo esc_html($sub['statementNote']); ?></p><?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
        <a class="lk hv-border" href="<?php echo esc_url(orsoline_url($prev['slug'])); ?>" style="cursor:pointer;border:1px solid #efe3e5;background:#fff;border-radius:999px;padding:18px 28px;display:flex;align-items:center;gap:18px">
          <span style="width:44px;height:44px;border-radius:50%;background:#e3f2fa;color:#b04a5a;display:grid;place-items:center">←</span>
          <div><div style="font:500 11px 'Geist Mono',monospace;color:#86737a">PRECEDENTE</div><div style="font-weight:600;font-size:20px"><?php echo esc_html($prev['title']); ?></div></div>
        </a>
        <a class="lk hv-border" href="<?php echo esc_url(orsoline_url($next['slug'])); ?>" style="cursor:pointer;border:1px solid #efe3e5;background:#fff;border-radius:999px;padding:18px 28px;display:flex;align-items:center;justify-content:flex-end;gap:18px;text-align:right">
          <div><div style="font:500 11px 'Geist Mono',monospace;color:#86737a">SUCCESSIVO</div><div style="font-weight:600;font-size:20px"><?php echo esc_html($next['title']); ?></div></div>
          <span style="width:44px;height:44px;border-radius:50%;background:#b04a5a;color:#fff;display:grid;place-items:center">→</span>
        </a>
      </div>
      </div>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <div style="background:#e3f2fa;border-radius:24px;padding:56px 64px;display:flex;justify-content:space-between;align-items:center;gap:40px;flex-wrap:wrap">
        <div>
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:56px;line-height:1;letter-spacing:-.035em;margin:0 0 14px">Vieni a <span style="font-weight:300;color:#b04a5a">trovarci</span></h2>
          <p style="margin:0;font-size:19px;color:#5a4850">E’ sempre gradita una vostra visita al Collegio, previo appuntamento (tel. 02-6688999)</p>
        </div>
        <a class="lk hv-wine" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;background:#b04a5a;color:#fff;padding:18px 30px;border-radius:999px;font-weight:600">Richiesta Informazioni →</a>
      </div>
    </section>
  </main>
<?php get_footer();
