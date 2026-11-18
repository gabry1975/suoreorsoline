<?php
/**
 * Home page (mockup: pagina Home, hero "bento").
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
  <main>
    <section style="padding:24px 32px 0">
      <div style="position:relative;max-width:1456px;margin:0 auto;height:max(640px,calc(100vh - 140px));border-radius:24px;overflow:hidden;background:repeating-linear-gradient(135deg,#dcedf6 0 14px,#d1e6f1 14px 28px);display:flex;align-items:center;justify-content:center;text-align:center">
        <span style="position:absolute;top:20px;right:20px;font:500 11px 'Geist Mono',monospace;background:#fff;color:#76636b;padding:7px 12px;border-radius:999px">IMMAGINE HERO · Studentesse nel giardino del Collegio — 2800×1500</span>
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(90,20,45,.15) 0%,rgba(90,20,45,.55) 100%)"></div>
        <div style="position:relative;max-width:900px;padding:0 32px;color:#fff;display:flex;flex-direction:column;align-items:center">
          <span style="background:rgba(255,255,255,.18);backdrop-filter:blur(8px);padding:8px 16px;border-radius:999px;font-size:14px;font-weight:500;margin-bottom:28px">Collegio Universitario Femminile · Milano</span>
          <h1 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(48px,6.4vw,96px);line-height:.95;letter-spacing:-.04em;margin:0 0 24px;text-wrap:balance">“Orsoline Missionarie <span style="font-weight:300;color:#f2d4d3">del Sacro Cuore</span>”</h1>
          <p style="font-size:20px;margin:0 0 36px;color:#fbeef1">Convenzionato con l’Università Cattolica del Sacro Cuore.</p>
          <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center">
            <a class="lk hv-pink" href="<?php echo esc_url(orsoline_url('chi-siamo')); ?>" style="cursor:pointer;background:#fff;color:#a0244a;padding:16px 28px;border-radius:999px;font-weight:600;white-space:nowrap">Il Collegio →</a>
            <a class="lk hv-wine" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;background:#a0244a;color:#fff;padding:16px 28px;border-radius:999px;font-weight:600;white-space:nowrap">Richiesta Informazioni</a>
          </div>
        </div>
      </div>
    </section>

    

    <section style="max-width:1320px;margin:0 auto;padding:120px 32px 100px">
      <p style="font-size:46px;line-height:1.15;letter-spacing:-.02em;font-weight:500;margin:0 0 72px;max-width:1120px;text-wrap:pretty">E’ una delle strutture d’ispirazione cristiana presenti nella città metropolitana di Milano, gestita dalle Suore <span style="font-weight:300;color:#a0244a">“Orsoline Missionarie del Sacro Cuore”</span>, ospita Studentesse Universitarie dal 1987.</p>
      <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:20px">
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:32px;display:flex;flex-direction:column;gap:40px">
          <div style="width:48px;height:48px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font:500 14px 'Geist Mono',monospace">01</div>
          <p style="margin:0;font-size:18px">Convenzionato con l’Università Cattolica del Sacro Cuore, accoglie anche Studentesse, italiane e straniere, provenienti da altri atenei milanesi.</p>
        </div>
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:32px;display:flex;flex-direction:column;gap:40px">
          <div style="width:48px;height:48px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font:500 14px 'Geist Mono',monospace">02</div>
          <p style="margin:0;font-size:18px">Nelle vicinanze non mancano supermercati, farmacie, banche, bar e pizzerie che offrono servizi d’asporto e di consegna a domicilio.</p>
        </div>
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:32px;display:flex;flex-direction:column;gap:40px">
          <div style="width:48px;height:48px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font:500 14px 'Geist Mono',monospace">03</div>
          <p style="margin:0;font-size:18px">Gode di una rete di servizi pubblici (Metropolitane, mezzi di superficie e vicinanza alla stazione Centrale) che consente di raggiungere facilmente atenei e punti di interesse.</p>
        </div>
      </div>
    </section>

    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <div style="background:#f8e7e6;border-radius:24px;padding:80px 72px">
        <div style="display:flex;flex-direction:column;align-items:center;text-align:center;max-width:820px;margin:0 auto 64px;gap:20px">
          <div style="display:flex;gap:10px;align-items:center"><span style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#a0244a">Accoglienza</span><?php orsoline_new_badge(); ?></div>
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(40px,4.6vw,64px);line-height:1;letter-spacing:-.035em;margin:0;text-wrap:balance">Una casa, <span style="font-weight:300;color:#a0244a">non solo un posto letto</span></h2>
          <p style="margin:0;font-size:19px;color:#5a4850;text-wrap:pretty">Arrivare a Milano per studiare è un passaggio importante. In Collegio trovi una comunità di studentesse e di Suore che ti accoglie dal primo giorno: qualcuno a cui chiedere, con cui condividere una cena o una sessione d’esame.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(380px,1fr));gap:24px;align-items:stretch">
          <div style="border-radius:20px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;padding:14px;min-height:420px"><span style="font:500 10px 'Geist Mono',monospace;background:#fff;color:#76636b;padding:5px 9px;border-radius:999px">IMMAGINE · Momento di accoglienza / nuove arrivate</span></div>
          <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px">
            <div style="background:#fff;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:12px"><span style="width:40px;height:40px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font-weight:600">1</span><div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:22px;letter-spacing:-.01em">Primo arrivo</div><p style="margin:0;font-size:15px;color:#5a4850">Ti accompagniamo nell’inserimento: la presentazione degli spazi, del «Regolamento» e delle compagne di piano.</p></div>
            <div style="background:#fff;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:12px"><span style="width:40px;height:40px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font-weight:600">2</span><div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:22px;letter-spacing:-.01em">Comunità</div><p style="margin:0;font-size:15px;color:#5a4850">Studentesse italiane e straniere, di atenei diversi, in un ambiente familiare in cui crescere insieme.</p></div>
            <div style="background:#fff;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:12px"><span style="width:40px;height:40px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font-weight:600">3</span><div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:22px;letter-spacing:-.01em">Sicurezza</div><p style="margin:0;font-size:15px;color:#5a4850">Portineria presidiata ogni giorno ed emergenze gestite giorno e notte.</p></div>
            <div style="background:#fff;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:12px"><span style="width:40px;height:40px;border-radius:50%;background:#d4ecf7;color:#1f5f82;display:grid;place-items:center;font-weight:600">4</span><div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:22px;letter-spacing:-.01em">Formazione</div><p style="margin:0;font-size:15px;color:#5a4850">Una proposta educativa ispirata al Vangelo, vissuta in libertà e nel rispetto di ciascuna.</p></div>
          </div>
        </div>
      </div>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:36px;gap:24px">
        <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:64px;line-height:1;letter-spacing:-.035em;margin:0">Il <span style="font-weight:300;color:#a0244a">Collegio</span></h2>
        <a class="lk hv-fill" href="<?php echo esc_url(orsoline_url('chi-siamo')); ?>" style="cursor:pointer;border:1px solid #2a1a22;padding:12px 22px;border-radius:999px;font-weight:500;font-size:15px">Chi Siamo →</a>
      </div>
      <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));grid-auto-rows:280px;gap:20px">
        <?php
        $layout = [['span 2', 'span 2'], ['span 1', 'span 1'], ['span 1', 'span 1'], ['span 1', 'span 1'], ['span 1', 'span 1'], ['span 2', 'span 1'], ['span 2', 'span 1']];
        foreach (orsoline_spazi() as $i => $s) : ?>
          <a class="lk hv-lift" href="<?php echo esc_url(orsoline_url($s['slug'])); ?>" style="cursor:pointer;grid-column:<?php echo $layout[$i][0]; ?>;grid-row:<?php echo $layout[$i][1]; ?>;border-radius:20px;position:relative;overflow:hidden;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;flex-direction:column;justify-content:space-between;padding:20px;transition:transform .25s">
            <span style="align-self:flex-start;font:500 10px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:6px 10px;border-radius:999px">IMMAGINE · <?php echo esc_html($s['title']); ?></span>
            <div style="background:#ffffff;border-radius:20px;padding:14px 18px;display:flex;justify-content:space-between;align-items:center;gap:12px">
              <div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:23px;line-height:1.15;letter-spacing:-.015em"><?php echo esc_html($s['title']); ?></div>
              <span style="width:38px;height:38px;flex:none;border-radius:50%;background:#a0244a;color:#fff;display:grid;place-items:center">→</span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <div style="display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1.6fr);gap:56px;align-items:end;margin-bottom:40px">
        <div style="display:flex;flex-direction:column;gap:18px">
          <div style="display:flex;gap:10px;align-items:center"><span style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#a0244a">Servizi in città</span><?php orsoline_new_badge(); ?></div>
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(40px,4.6vw,64px);line-height:1;letter-spacing:-.035em;margin:0">Milano <span style="font-weight:300;color:#a0244a">a portata di mano</span></h2>
        </div>
        <p style="margin:0;font-size:18px;color:#5a4850;max-width:620px">Dal Collegio raggiungi facilmente atenei e punti di interesse con metropolitane e mezzi di superficie, a pochi passi dalla stazione Centrale. Tutto ciò che serve ogni giorno è sotto casa.</p>
      </div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:12px">
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:18px">
            <div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:24px;letter-spacing:-.015em">Università</div>
            <div style="display:flex;flex-direction:column"><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Cattolica</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Politecnico</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Statale</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Bocconi</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div></div>
          </div>
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:18px">
            <div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:24px;letter-spacing:-.015em">Trasporti</div>
            <div style="display:flex;flex-direction:column"><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Metropolitana</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Mezzi di superficie</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Stazione Centrale</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div></div>
          </div>
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:18px">
            <div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:24px;letter-spacing:-.015em">Vita quotidiana</div>
            <div style="display:flex;flex-direction:column"><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Supermercati</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Farmacie</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Banche</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Bar e pizzerie</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div></div>
          </div>
        <div style="background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:28px;display:flex;flex-direction:column;gap:18px">
            <div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:24px;letter-spacing:-.015em">Tempo libero</div>
            <div style="display:flex;flex-direction:column"><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Parchi</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Biblioteche</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div><div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 0;border-top:1px solid #f3e9eb;font-size:15px"><span style="min-width:0">Cinema e teatri</span><span style="font:500 11px 'Geist Mono',monospace;color:#1f5f82;background:#e3f2fa;padding:4px 9px;border-radius:999px;white-space:nowrap;flex-shrink:0">xx min</span></div></div>
          </div>
      </div>
      <p style="margin:14px 0 0;font:500 11px 'Geist Mono',monospace;color:#86737a">[ tempi di percorrenza da verificare e inserire ]</p>
    </section>
    <section style="background:#e3f2fa;padding:110px 32px;margin-bottom:120px">
      <div style="max-width:1320px;margin:0 auto">
        <div style="display:flex;flex-direction:column;align-items:center;text-align:center;gap:18px;margin-bottom:56px">
          <div style="display:flex;gap:10px;align-items:center"><span style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#1f5f82">Le studentesse</span><?php orsoline_new_badge(); ?></div>
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(40px,4.6vw,64px);line-height:1;letter-spacing:-.035em;margin:0">Dicono <span style="font-weight:300;color:#a0244a">di noi</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px">
          <figure style="margin:0;background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:32px;display:flex;flex-direction:column;justify-content:space-between;gap:32px">
          <div style="display:flex;flex-direction:column;gap:16px"><span style="font-family:'Funnel Display',sans-serif;font-size:56px;line-height:.6;color:#f2d4d3">“</span><blockquote style="margin:0;font-size:18px;line-height:1.55;color:#3a2a31">Sono arrivata da fuori regione senza conoscere nessuno: dopo una settimana avevo già trovato le mie compagne di studio. La cucina condivisa è il posto dove sono nate le amicizie più belle.</blockquote></div>
          <figcaption style="display:flex;align-items:center;gap:14px"><span style="width:48px;height:48px;flex:none;border-radius:50%;background:repeating-linear-gradient(135deg,#dcedf6 0 6px,#d1e6f1 6px 12px)"></span><span><span style="display:block;font-weight:600">Giulia</span><span style="display:block;font-size:14px;color:#86737a">Università Cattolica · 3° anno</span></span></figcaption>
        </figure>
          <figure style="margin:0;background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:32px;display:flex;flex-direction:column;justify-content:space-between;gap:32px">
          <div style="display:flex;flex-direction:column;gap:16px"><span style="font-family:'Funnel Display',sans-serif;font-size:56px;line-height:.6;color:#f2d4d3">“</span><blockquote style="margin:0;font-size:18px;line-height:1.55;color:#3a2a31">La posizione è perfetta: con la metro sono in università in pochi minuti e la stazione Centrale è vicinissima quando torno a casa nel weekend. La sala studio è silenziosa anche sotto esame.</blockquote></div>
          <figcaption style="display:flex;align-items:center;gap:14px"><span style="width:48px;height:48px;flex:none;border-radius:50%;background:repeating-linear-gradient(135deg,#dcedf6 0 6px,#d1e6f1 6px 12px)"></span><span><span style="display:block;font-weight:600">Sofia</span><span style="display:block;font-size:14px;color:#86737a">Politecnico · 2° anno</span></span></figcaption>
        </figure>
          <figure style="margin:0;background:#fff;border:1px solid #efe3e5;border-radius:20px;padding:32px;display:flex;flex-direction:column;justify-content:space-between;gap:32px">
          <div style="display:flex;flex-direction:column;gap:16px"><span style="font-family:'Funnel Display',sans-serif;font-size:56px;line-height:.6;color:#f2d4d3">“</span><blockquote style="margin:0;font-size:18px;line-height:1.55;color:#3a2a31">Mi sono sentita accolta fin dal primo giorno. Le Suore sono sempre disponibili e l’ambiente è sereno: per i miei genitori è stato importante sapermi in un posto sicuro.</blockquote></div>
          <figcaption style="display:flex;align-items:center;gap:14px"><span style="width:48px;height:48px;flex:none;border-radius:50%;background:repeating-linear-gradient(135deg,#dcedf6 0 6px,#d1e6f1 6px 12px)"></span><span><span style="display:block;font-weight:600">Amina</span><span style="display:block;font-size:14px;color:#86737a">Università Statale · 1° anno</span></span></figcaption>
        </figure>
        </div>
        <p style="margin:24px 0 0;text-align:center;font:500 11px 'Geist Mono',monospace;color:#1f5f82">[ testi di esempio — da sostituire con recensioni reali e consenso delle studentesse ]</p>
      </div>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <div style="background:#f8e7e6;border-radius:24px;padding:72px;display:grid;grid-template-columns:minmax(0,1.1fr) minmax(0,1fr);gap:64px;align-items:center">
        <div>
          <span style="background:#fff;color:#a0244a;padding:7px 14px;border-radius:999px;font-size:13px;font-weight:500">Dal 1884 a Milano</span>
          <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:72px;line-height:.95;letter-spacing:-.035em;margin:24px 0 28px">Vieni a <span style="font-weight:300;color:#a0244a">trovarci</span></h2>
          <p style="font-size:19px;margin:0;color:#5a4850;text-wrap:pretty">L’Istituto “Orsoline Missionarie del Sacro Cuore” è presente in Milano sin dal 1884 e si propone di offrire alle Studentesse una proposta educativa ispirata al Vangelo, in un ambiente familiare, reso sempre più accogliente soprattutto dall’apporto concreto di ciascuna.</p>
        </div>
        <div style="background:#ffffff;border-radius:20px;padding:36px;box-shadow:0 24px 48px -28px rgba(90,20,45,.35)">
          <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px">
            <div style="width:56px;height:68px;border-radius:10px;background:#a0244a;color:#fff;display:grid;place-items:center;font:500 12px 'Geist Mono',monospace">PDF</div>
            <div><div style="font-weight:600;font-size:20px">«Regolamento»</div><div style="font:500 12px 'Geist Mono',monospace;color:#86737a">regolamento_2025_26.pdf</div></div>
          </div>
          <p style="margin:0 0 28px;font-size:16px;color:#5a4850">Per una più completa comprensione della vita al Collegio, si rimanda all’attenta lettura del «Regolamento» che dovrà essere accettato e firmato da ogni Studentessa che liberamente accetterà di farne parte.</p>
          <div style="display:flex;gap:10px;flex-wrap:wrap">
            <a href="<?php echo esc_url(home_url("/wp-content/uploads/2026/11/regolamento_2025_26.pdf")); ?>" target="_blank" style="background:#a0244a;color:#fff;padding:14px 22px;border-radius:999px;font-weight:600;text-decoration:none">Scarica il Regolamento ↓</a>
            <a class="lk hv-pink" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;border:1px solid #a0244a;color:#a0244a;padding:13px 22px;border-radius:999px;font-weight:500">Richiesta Informazioni</a>
          </div>
        </div>
      </div>
    </section>
  <section style="max-width:1320px;margin:0 auto;padding:0 32px 120px">
      <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:56px;line-height:1;letter-spacing:-.035em;margin:0 0 28px">Dove <span style="font-weight:300;color:#a0244a">siamo</span></h2>
      <div style="display:grid;grid-template-columns:minmax(0,1.55fr) minmax(0,1fr);gap:16px;min-height:560px">
        <div style="position:relative;border-radius:24px;overflow:hidden;background:repeating-linear-gradient(135deg,#dcedf6 0 14px,#d1e6f1 14px 28px);min-height:480px">
          <span style="position:absolute;top:18px;left:18px;font:500 11px 'Geist Mono',monospace;background:#fff;color:#76636b;padding:7px 12px;border-radius:999px">MAPPA · Google Maps embed, stile personalizzato</span>
          <div style="position:absolute;left:50%;top:44%;transform:translate(-50%,-100%);display:flex;flex-direction:column;align-items:center">
            <div style="background:#a0244a;color:#fff;padding:10px 16px;border-radius:14px;font-weight:600;font-size:14px;white-space:nowrap;box-shadow:0 12px 24px -8px rgba(160,36,74,.5)">Collegio Orsoline</div>
            <div style="width:14px;height:14px;background:#a0244a;transform:rotate(45deg);margin-top:-8px"></div>
            <div style="width:18px;height:18px;border-radius:50%;background:#a0244a;border:4px solid #fff;margin-top:6px;box-shadow:0 0 0 10px rgba(160,36,74,.18)"></div>
          </div>
          <div style="position:absolute;left:16px;right:16px;bottom:16px;background:#fff;border-radius:18px;padding:22px 24px;display:flex;justify-content:space-between;align-items:flex-end;gap:20px;flex-wrap:wrap;box-shadow:0 20px 40px -20px rgba(90,20,45,.3)">
            <div style="display:flex;flex-direction:column;gap:12px">
              <div style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:22px;line-height:1.2;letter-spacing:-.01em;color:#2a1a22">Via Adele Martignoni, 8 · 20124 Milano (MI)</div>
              <div style="display:flex;gap:6px;flex-wrap:wrap">
                <span style="background:#e3f2fa;color:#1f5f82;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:500">Metropolitane</span>
                <span style="background:#e3f2fa;color:#1f5f82;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:500">Mezzi di superficie</span>
                <span style="background:#e3f2fa;color:#1f5f82;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:500">Stazione Centrale</span>
              </div>
            </div>
            <a href="https://maps.google.com/?q=Via+Adele+Martignoni+8+Milano" target="_blank" style="flex:none;background:#a0244a;color:#fff;padding:12px 18px;border-radius:999px;font-size:14px;font-weight:600;text-decoration:none;white-space:nowrap">Apri in Maps ↗</a>
          </div>
        </div>
        <div style="background:#f8e7e6;border-radius:24px;padding:12px;display:flex;flex-direction:column;gap:12px">
          <div style="flex:1;min-height:240px;border-radius:16px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;padding:12px"><span style="font:500 10px 'Geist Mono',monospace;background:#fff;color:#76636b;padding:5px 9px;border-radius:999px">IMMAGINE · Ingresso del Collegio</span></div>
          <div style="padding:16px 18px 18px;display:flex;flex-direction:column;gap:20px">
            <div>
              <h2 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:34px;letter-spacing:-.025em;line-height:1.05;margin:0 0 10px;color:#2a1a22">Visita guidata</h2>
              <p style="margin:0;font-size:17px;color:#5a4850">E’ sempre gradita una vostra visita al Collegio previo appuntamento.</p>
            </div>
            <div style="display:flex;gap:8px;flex-wrap:wrap">
              <a href="tel:026688999" style="background:#a0244a;color:#fff;padding:12px 20px;border-radius:999px;font-weight:600;font-size:15px;text-decoration:none;white-space:nowrap">02/6688999</a>
              <a class="lk hv-rose" href="<?php echo esc_url(orsoline_url('contatti')); ?>" style="cursor:pointer;background:#fff;color:#a0244a;padding:12px 20px;border-radius:999px;font-weight:600;font-size:15px;white-space:nowrap">Richiesta Informazioni</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer();
