<?php
/**
 * Contatti (/contatti/). Il form invia una email (vedi inc/contact-form.php).
 */
if (!defined('ABSPATH')) {
    exit;
}
$sent = isset($_GET['inviato']) && $_GET['inviato'] === '1';
$error = isset($_GET['inviato']) && $_GET['inviato'] === '0' ? 'Non è stato possibile inviare il messaggio: controlla l’email e il consenso privacy e riprova, oppure chiamaci allo 02/6688999.' : '';
get_header();
?>
  <main>
    <section style="max-width:1320px;margin:0 auto;padding:56px 32px 48px">
      <div style="font-size:14px;color:#86737a;display:flex;gap:8px"><a class="lk hv-text" href="<?php echo esc_url(orsoline_url()); ?>" style="cursor:pointer">Home</a><span>/</span><span style="color:#2a1a22">Contatti</span></div>
      <h1 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(64px,10vw,132px);line-height:.9;overflow-wrap:anywhere;letter-spacing:-.045em;margin:24px 0 0">Conta<span style="font-weight:300;color:#a0244a">tti</span></h1>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px;display:grid;grid-template-columns:minmax(0,1.5fr) minmax(0,1fr);gap:20px;align-items:start">
      <div style="background:#fff;border:1px solid #efe3e5;border-radius:24px;padding:52px">
        <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:40px;letter-spacing:-.03em;margin:0 0 36px">Scrivici</h2>
        <?php if ($sent) : ?>
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
              <div style="display:flex;gap:8px;flex-wrap:wrap"><input type="hidden" name="relazione" value=""><?php foreach (orsoline_form_options('relazione') as $o) : ?><button type="button" class="lk" data-chip="relazione" data-value="<?php echo esc_attr($o); ?>" style="cursor:pointer;padding:11px 18px;border-radius:999px;font-size:15px;background:#fff;color:#2a1a22;border:1px solid #e6d6da"><?php echo esc_html($o); ?></button><?php endforeach; ?></div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Nome e Cognome della Studentessa</span><input type="text" name="nome" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px"></label>
              <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Dati anagrafici</span><input type="text" name="anagrafica" style="height:56px;border:1px solid #e6d6da;background:#fbf8f7;padding:0 22px;border-radius:999px"></label>
            </div>
            <div style="display:flex;flex-direction:column;gap:12px"><span style="font-size:15px;font-weight:600">Università</span>
              <div style="display:flex;gap:8px;flex-wrap:wrap"><input type="hidden" name="universita" value=""><?php foreach (orsoline_form_options('universita') as $o) : ?><button type="button" class="lk" data-chip="universita" data-value="<?php echo esc_attr($o); ?>" style="cursor:pointer;padding:11px 18px;border-radius:999px;font-size:15px;background:#fff;color:#2a1a22;border:1px solid #e6d6da"><?php echo esc_html($o); ?></button><?php endforeach; ?></div>
            </div>
            <div style="display:flex;flex-direction:column;gap:12px"><span style="font-size:15px;font-weight:600">Periodo di permanenza in Collegio</span>
              <div style="display:flex;gap:8px;flex-wrap:wrap"><input type="hidden" name="periodo" value=""><?php foreach (orsoline_form_options('periodo') as $o) : ?><button type="button" class="lk" data-chip="periodo" data-value="<?php echo esc_attr($o); ?>" style="cursor:pointer;padding:11px 18px;border-radius:999px;font-size:15px;background:#fff;color:#2a1a22;border:1px solid #e6d6da"><?php echo esc_html($o); ?></button><?php endforeach; ?></div>
            </div>
            <label style="display:flex;flex-direction:column;gap:10px"><span style="font-size:15px;font-weight:600">Il tuo messaggio</span><textarea name="messaggio" rows="5" style="border:1px solid #e6d6da;background:#fbf8f7;padding:16px 22px;border-radius:24px;resize:vertical"></textarea></label>
            <label style="display:flex;gap:10px;align-items:flex-start;font-size:14px;color:#76636b"><input type="checkbox" name="privacy" value="1" required style="margin-top:4px;accent-color:#a0244a"><span>Ho letto l’informativa privacy e acconsento al trattamento dei dati.</span></label>
            <button type="submit" class="lk hv-wine" style="cursor:pointer;align-self:flex-start;background:#a0244a;color:#fff;padding:18px 40px;border-radius:999px;font-weight:600;font-size:16px">Invia →</button>
          </div>
          </form>
        <?php endif; ?>
      </div>
      <div style="display:flex;flex-direction:column;gap:20px">
        <div style="background:#a0244a;color:#fff;border-radius:24px;padding:40px;display:flex;flex-direction:column;gap:24px">
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:32px;letter-spacing:-.02em;margin:0">Contatti</h2>
          <div style="font-size:17px;line-height:1.5">Via Adele Martignoni, 8<br>20124 Milano (MI)<br>Italia</div>
          <a href="tel:026688999" style="font-family:'Funnel Display',sans-serif;font-size:48px;line-height:1;color:#f2d4d3">02/6688999</a>
          <a href="mailto:amministrazione.omscmi@gmail.com" style="color:#fff;background:rgba(255,255,255,.12);padding:12px 18px;border-radius:999px;font-size:15px;align-self:flex-start">amministrazione.omscmi@gmail.com</a>
        </div>
        <div style="height:260px;border-radius:24px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:grid;place-items:center">
          <span style="font:500 11px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:7px 12px;border-radius:999px">MAPPA · Via Adele Martignoni, 8</span>
        </div>
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:24px;padding:32px 36px">
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:26px;letter-spacing:-.02em;margin:0 0 14px">Link Utili</h2>
          <div style="display:flex;flex-direction:column">
            <a href="http://www.omscgen.it/" target="_blank" style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f3e9eb;color:#2a1a22">Suore Orsoline Missionarie del Sacro Cuore<span style="color:#a0244a">↗</span></a>
            <a href="http://chiesadimilano.it" target="_blank" style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f3e9eb;color:#2a1a22">Diocesi di Milano<span style="color:#a0244a">↗</span></a>
            <a href="http://www.radiovaticana.org" target="_blank" style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f3e9eb;color:#2a1a22">Radio Vaticana<span style="color:#a0244a">↗</span></a>
            <a href="http://www.news.va" target="_blank" style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f3e9eb;color:#2a1a22">La Santa Sede<span style="color:#a0244a">↗</span></a>
            <a href="http://www.vatican.va" target="_blank" style="display:flex;justify-content:space-between;padding:12px 0;color:#2a1a22">Sito Vaticano<span style="color:#a0244a">↗</span></a>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer();
