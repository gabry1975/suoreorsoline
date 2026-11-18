<?php
/**
 * Chi Siamo (/chi-siamo/).
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
  <main>
    <section style="max-width:1320px;margin:0 auto;padding:56px 32px 0">
      <div style="font-size:14px;color:#86737a;display:flex;gap:8px"><a class="lk hv-text" href="<?php echo esc_url(orsoline_url()); ?>" style="cursor:pointer">Home</a><span>/</span><span style="color:#2a1a22">Chi Siamo</span></div>
      <h1 style="font-family:'Funnel Display',sans-serif;font-weight:600;font-size:clamp(64px,10vw,132px);line-height:.9;overflow-wrap:anywhere;letter-spacing:-.045em;margin:24px 0 48px">Chi <span style="font-weight:300;color:#b04a5a">Siamo</span></h1>
      <div style="height:460px;border-radius:24px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;padding:24px">
        <span style="font:500 11px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:7px 12px;border-radius:999px">IMMAGINE · Foto d’archivio storico dell’Istituto — 2600×920</span>
      </div>
    </section>
    <section style="max-width:1320px;margin:0 auto;padding:96px 32px 120px;display:grid;grid-template-columns:260px minmax(0,1fr);gap:80px">
      <?php /* Menu laterale: struttura del secondo mockup (indice + linea storica verticale), stile del sito. */ ?>
      <aside class="cs-aside" style="position:sticky;top:120px;align-self:start">
        <div style="font:500 11px 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:#86737a;margin-bottom:16px">In questa pagina</div>
        <a class="lk hv-text" href="#cs-storia" data-jump style="display:block;cursor:pointer;font-weight:500;padding:8px 0">…dalla storia</a>
        <a class="lk hv-text" href="#cs-milano" data-jump style="display:block;cursor:pointer;font-weight:500;padding:8px 0;margin-bottom:28px">…a Milano</a>
        <div style="border-left:1px solid #e6d6da;display:flex;flex-direction:column">
          <?php
          $tl = [['1575', 'Parma', 'cs-1575'], ['1591', 'Maddalena Molinari', 'cs-1591'], ['1623', 'Vittoria Masi', 'cs-1623'], ['1898', 'Madre Zileri dal Verme', 'cs-1898'], ['1926', 'La prima missione in Cina', 'cs-1926'], ['1884', 'Milano', 'cs-1884'], ['1987', 'Nuovo Collegio Universitario', 'cs-1987']];
          foreach ($tl as [$y, $t, $id]) : ?>
          <a class="lk hv-text" href="#<?php echo $id; ?>" data-jump style="display:block;cursor:pointer;padding:7px 0 7px 18px;position:relative;font-size:14px;line-height:1.45;color:#5a4850">
            <span style="position:absolute;left:-4px;top:14px;width:7px;height:7px;border-radius:50%;background:#b04a5a"></span>
            <span style="font:500 12px 'Geist Mono',monospace;color:#b04a5a;margin-right:10px"><?php echo $y; ?></span><?php echo esc_html($t); ?>
          </a>
          <?php endforeach; ?>
        </div>
      </aside>
      <article style="max-width:760px;font-size:19px;line-height:1.7;color:#3a2a31">
        <h2 id="cs-storia" style="font-weight:600;font-size:48px;line-height:1.05;letter-spacing:-.03em;margin:0 0 36px;color:#2a1a22">Orsoline Missionarie del Sacro Cuore… <span style="font-weight:300;color:#b04a5a">dalla storia</span></h2>
        <p id="cs-1575" style="font-size:26px;line-height:1.4;letter-spacing:-.01em;font-weight:500;margin:0 0 28px;color:#2a1a22">La nostra tradizione comincia da lontano, quando l’Istituto, che ha come scopo principale l’educazione, è sorto nel 1575 a Parma in Italia.</p>
        <p style="margin:0 0 24px">Per questo possiamo affermare che il nostro carisma, il dono che lo Spirito di Dio ha fatto all’Istituto fin dalle origini, ci rende educatrici dal sorgere.</p>
        <p style="margin:0 0 24px">La nostra storia è per lungo tratto di tempo – dall’origine cinquecentesca fino alla fine dell’Ottocento – tutta parmigiana: ha inizio quando il sacerdote Giovanni Vaira, sacerdote-canonico della Steccata, accolse una bambina povera da “far crescere”. Ad essa, presto, se ne sarebbero aggiunte altre, affidate alla cura di signore della città. Le “Figlie del soccorso” ottennero la protezione e l’aiuto economico del duca Ottavio Farnese, che consentì loro di acquistare una prima casa, in prossimità della Chiesa di sant’Ambrogio.</p>
        <p id="cs-1591" style="margin:0 0 24px">Nel 1591, con Maddalena Molinari nacque la Congregazione col nome di “Compagnia parmense delle Vergini di Sant’Orsola” e, attorno alla Madre Molinari, che consideriamo nostra fondatrice, ben presto, si radunò una comunità di donne, proprio con l’intento di educare. Insieme le giovani condussero una vita religiosa, pur senza prendere ufficialmente i voti e l’esperienza di vita evangelica della comunità, che si concretizzò subito nell’accogliere ed educare la gioventù e, nella scia del rinnovamento sostenuto da san Carlo Borromeo nel Concilio di Trento, assunse Sant’Orsola, come protettrice della nuova forma di vita religiosa femminile, dedita all’educazione.</p>
        <div style="display:grid;grid-template-columns:240px minmax(0,1fr);gap:32px;margin:48px 0;align-items:center">
          <div style="aspect-ratio:3/4;border-radius:20px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;justify-content:center;padding:16px">
            <span style="font:500 10px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:5px 9px;border-radius:999px">IMMAGINE · Sant’Orsola</span>
          </div>
          <p style="margin:0">Sant’Orsola, fu una giovane donna bretone, del III–IV secolo, martirizzata a Colonia, autenticamente realizzata nell’amore, libera da ogni forma di omologazione, anche se oggi poco conosciuta o, forse, conosciuta soltanto per aspetti tra storia e leggenda più che per la qualità profondamente umana della sua vita e della sua fede. Emblematica è la personalità della santa che difende le proprie scelte di fronte al volere del padre, si circonda di altre giovani e, attirata dall’amore di Cristo, con fermezza ed entusiasmo affronta con loro anche il martirio.</p>
        </div>
        <blockquote style="margin:56px -48px;padding:48px 56px;background:#b04a5a;color:#fff;border-radius:20px;font-family:'Funnel Display',sans-serif;font-size:34px;line-height:1.25">Tale giovane donna, sant’Orsola, può essere l’icona dell’azione educativa: il fascino della libertà per Amore e, nello stesso tempo, la piena realizzazione umana, il suo amore verginale a Cristo, la sua perseveranza fino al martirio, la fermezza, l’entusiasmo e il coraggio.</blockquote>
        <p style="margin:0 0 24px">Con il sostegno spirituale e la consulenza amministrativa dei Padri Gesuiti, la Compagnia di Sant’Orsola iniziò ufficialmente la sua opera di carità e di educazione, rivolta non più, come nei primissimi anni, solo alle fanciulle in necessità ma anche alle figlie di famiglie illustri.</p>
        <p id="cs-1623" style="margin:0 0 24px">Nel 1623 Vittoria Masi, che succedette alla Molinari, fece approvare le prime Costituzioni della Compagnia di Sant’Orsola e per questo è considerata oggi cofondatrice dell’Istituto. In questo periodo erano sorti tanti nuclei di Orsoline in diverse città italiane tutte ispirate a S. Angela Merici; le Orsoline Parmensi non attinsero alla sua spiritualità, ma assunsero la Spiritualità Ignaziana e si affiancarono ai Padri Gesuiti anche nelle loro attività apostoliche ed in particolare nell’educazione alla fede dei giovani.</p>
        <p style="margin:0 0 24px">Acquisirono ben presto la consapevolezza che lo scopo principale della loro consacrazione era la Maggior Gloria di Dio che è la salvezza dei fratelli. S’impegnarono a seguire con gioia Gesù, a uniformarsi sempre più intimamente a Lui mediante la preghiera, la contemplazione, la pratica degli Esercizi Spirituali, l’esame di coscienza.</p>
        <p style="margin:0 0 24px">Nutrirono una visione del mondo positiva perché erano sostenute dalla certezza che Dio opera continuamente nel mondo, nella storia e nella vita di ogni persona. Per questo ancora oggi s’impegnano a cercare Dio in tutte le realtà umane divenendo contemplative nell’azione apostolica. Si sentono impegnate in una lotta costante per raggiungere la libertà interiore e saper discernere se, nel prendere le decisioni concrete, sono guidate dallo Spirito di Gesù o dagli impulsi del male che sempre pone ostacoli alla realizzazione del Regno di Dio.</p>
        <p id="cs-1898" style="margin:0 0 24px">Solo nel 1898, quando fu eletta Priora Madre Lucrezia Zileri dal Verme, la Compagnia di S. Orsola da Istituto Laico divenne Congregazione vera e propria, di Diritto Pontificio, con l’approvazione della Santa Sede e il riconoscimento delle Costituzioni nel 1926.</p>
        <p style="margin:0 0 24px">Madre Zileri si prodigò per aprire altre case in Italia per la formazione umana e religiosa di giovani e preparò il terreno per l’apostolato missionario.</p>
        <p id="cs-1926" style="margin:0 0 24px">La prima missione fu in Cina nel 1926; le suore italiane vennero in seguito espulse dalla Cina nel 1950 durante la rivoluzione cinese e aprirono altre missioni: in Australia, in Giappone, a Taiwan, nelle Filippine e altri luoghi in Oriente, dove siamo tuttora.</p>
        <p style="margin:0 0 96px">L’Istituto ha vissuto il suo carisma di vita apostolica fin dall’inizio ed è rimasto aperto alle necessità dei diversi luoghi e delle situazioni storiche.</p>
        <h2 id="cs-milano" style="font-weight:600;font-size:48px;line-height:1.05;letter-spacing:-.03em;margin:0 0 36px;color:#2a1a22">Orsoline Missionarie del Sacro Cuore… <span style="font-weight:300;color:#b04a5a">a Milano</span></h2>
        <p id="cs-1884" style="font-size:26px;line-height:1.4;letter-spacing:-.01em;font-weight:500;margin:0 0 28px;color:#2a1a22">L’Istituto “Orsoline Missionarie del Sacro Cuore” è presente in Milano sin dal 1884, e vede nel 1936 la costruzione di una struttura destinata a divenire “Scuola di tirocinio per allieve maestre di Scuola materna”.</p>
        <p id="cs-1987" style="margin:0 0 24px">In questo edificio, si inizia ben presto ad ospitare impiegate e studentesse universitarie. Nel 1987, dopo un’avveduta ristrutturazione, si inaugura il Nuovo Collegio Universitario.</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin:40px 0">
          <div style="aspect-ratio:4/3;border-radius:20px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;padding:14px"><span style="font:500 10px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:5px 9px;border-radius:999px">IMMAGINE · L’edificio del 1936</span></div>
          <div style="aspect-ratio:4/3;border-radius:20px;background:repeating-linear-gradient(135deg,#f3e7ea 0 14px,#ebdde1 14px 28px);display:flex;align-items:flex-end;padding:14px"><span style="font:500 10px 'Geist Mono',monospace;background:#ffffff;color:#76636b;padding:5px 9px;border-radius:999px">IMMAGINE · Il Collegio oggi</span></div>
        </div>
        <p style="margin:0 0 24px">Il Collegio si propone di offrire alle Studentesse, che liberamente accettano di farne parte, una proposta educativa ispirata al Vangelo, in un ambiente familiare, reso sempre più accogliente soprattutto dall’apporto concreto di ciascuna.</p>
        <p style="margin:0 0 32px">La residenza, attualmente, presenta camere doppie e singole con bagno dedicato, confortevoli spazi comuni, cappella, giardino, palestra, cucina attrezzata, rete wi-fi con fibra ottica, sala pc e biblioteca.</p>
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:48px">
          <?php foreach (['camere doppie e singole con bagno dedicato', 'spazi comuni', 'cappella', 'giardino', 'palestra', 'cucina attrezzata', 'rete wi-fi con fibra ottica', 'sala pc', 'biblioteca'] as $a) : ?><span style="background:#fff;border:1px solid #efe3e5;padding:8px 16px;border-radius:999px;font-size:15px"><?php echo esc_html($a); ?></span><?php endforeach; ?>
        </div>
        <a class="lk hv-wine" href="<?php echo esc_url(orsoline_url('cappella')); ?>" style="cursor:pointer;display:inline-flex;font-size:16px;font-weight:600;background:#b04a5a;color:#fff;padding:16px 28px;border-radius:999px">Scopri Il Collegio →</a>
      </article>
    </section>
  </main>
<?php get_footer();
