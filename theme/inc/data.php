<?php
/**
 * Contenuti del mockup: spazi del Collegio e note UX.
 * Testi riportati invariati dal mockup di Claude Design.
 */

if (!defined('ABSPATH')) {
    exit;
}

/** Spazi del Collegio, nell'ordine del mockup (menu, bento, precedente/successivo). */
function orsoline_spazi()
{
    return [
        ['slug' => 'cappella', 'title' => 'Cappella', 'missing' => true,
            'imgs' => [['label' => 'Cappella — vista d’insieme', 'col' => 'span 2', 'row' => 'span 2'], ['label' => 'Altare'], ['label' => 'Dettaglio arredi sacri']]],
        ['slug' => 'portineria-e-salottini-ospiti', 'title' => 'Portineria e Salottini Ospiti', 'showHours' => true,
            'paras' => ['Il servizio di portineria si effettua dalle ore 7:00 alle 24:00 nei giorni feriali, il sabato dalle 7:00 alle 1:00 del giorno successivo e i giorni festivi dalle ore 8:00 alle 24:00. Eventuali emergenze saranno adeguatamente gestite giorno e notte. In casi particolari, saranno concessi uscite e rientri, con orari diversi, solo a gruppi e con il consenso previo della Direttrice.',
                'La Studentessa potrà pernottare liberamente presso parenti e amici notificandolo nell’apposito registro sito in portineria dal quale, attraverso anche i cartellini di presenza, saranno in ogni momento facilmente individuabili le presenti o le assenti dal Collegio.'],
            'imgs' => [['label' => 'Portineria', 'col' => 'span 2'], ['label' => 'Salottino ospiti']],
            'citeSrc' => 'Da «Regolamento» (art. 5)',
            'cite' => '«Gli Studenti e le Studentesse esterni/e potranno essere ricevuti nei salottini attigui alla portineria dalle ore 8:00 alle ore 20:00, previo accordo con la Direttrice, per offrire a tutte la possibilità di un equo utilizzo di tali ambienti.»'],
        ['slug' => 'sala-meeting', 'title' => 'Sale Meeting e Studio', 'missing' => true,
            'imgs' => [['label' => 'Sala meeting', 'col' => 'span 2', 'row' => 'span 2'], ['label' => 'Sala studio'], ['label' => 'Sala pc e biblioteca']]],
        ['slug' => 'camere', 'title' => 'Camere',
            'paras' => ['Disponiamo di camere singole e doppie generalmente con bagno attiguo attrezzato con doccia e dedicato all’uso in comune con un’altra camera.',
                'Ogni Studentessa potrà vivacizzare la camera esprimendo la propria personalità, sempre nel rispetto di quanto richiamato dal “Regolamento”.'],
            'imgs' => [['label' => 'Camera arredata', 'row' => 'span 2', 'caption' => 'esempio di camera arredata dal Collegio…'], ['label' => 'Camera personalizzata', 'row' => 'span 2', 'caption' => '…e personalizzata dalla Studentessa'], ['label' => 'Bagno attiguo', 'row' => 'span 2', 'caption' => 'esempio di bagno attiguo alle camere']],
            'citeSrc' => 'Da «Regolamento» (art. 6)',
            'cite' => '“…è compito di ogni Studentessa la pulizia e il riordino della stanza…. la pulizia dei bagni è quotidianamente affidata al personale di Servizio….”',
            'statement' => 'Obiettivo fondamentale del «Regolamento» è quello di promuovere e agevolare la convivenza serena.'],
        ['slug' => 'cucina', 'title' => 'Cucina',
            'paras' => ['L’ampia cucina, dotata di piastre ad induzione ed attigua alle sale pranzo, permette di usufruire delle postazioni in modo agevole.',
                'Sono a disposizione delle Studentesse frigoriferi, congelatori e un armadietto, con chiave personale, nel quale riporre le proprie stoviglie per l’uso quotidiano.',
                'Pentole, tegami ed altro, in quantità e misure adatte all’uso di una persona, devono essere adatti all’induzione.',
                'Ogni Studentessa è invitata alla cura delle proprie stoviglie, all’uso delle attrezzature comuni con attenzione e senso di responsabilità, al fine di una serena e reciproca convivenza.',
                'La pulizia della cucina, così come di tutte le parti comuni, è affidata al Personale del Collegio.'],
            'imgs' => [['label' => 'Cucina — postazioni a induzione', 'col' => 'span 2', 'row' => 'span 2'], ['label' => 'Sala pranzo'], ['label' => 'Armadietti personali']],
            'statement' => 'La scelta del nostro Collegio è di offrire l’occasione educativa di autogestire la propria alimentazione, anziché usufruire di un «servizio mensa».'],
        ['slug' => 'spazi-comuni', 'title' => 'Spazi Comuni',
            'paras' => ['Ad ogni piano, troviamo gli accessori (oltre ad una aspirapolvere alloggiata in portineria) per la pulizia della propria camera che è affidata alla Studentessa che la abita.',
                'Sono anche presenti contenitori per la raccolta differenziata: che deve essere scrupolosamente osservata anche in cucina!',
                'Ci sono poi stendini, ferri e assi da stiro più 2 lavatrici a gettoni per la cura dei propri abiti e corredi.',
                'Vi attende una spaziosa palestra munita di diversi attrezzi e passatempi.'],
            'imgs' => [['label' => 'Palestra', 'col' => 'span 2', 'row' => 'span 2'], ['label' => 'Lavanderia'], ['label' => 'Spazi di piano']],
            'statement' => '“Orandum est ut sit mens sana in corpore sano” che significa',
            'statement2' => '“Bisogna pregare affinché ci sia una mente sana in un corpo sano”.',
            'statementNote' => '(La frase è di Giovenale e la inserisce nelle sue Satire, scritto del I secolo d.C.)'],
        ['slug' => 'giardino', 'title' => 'Giardino',
            'paras' => ['Il giardino e le piante ornamentali interne, aiutano a rendere più piacevole il soggiornarvi…in ogni stagione!'],
            'imgs' => [['label' => 'Giardino — vista ampia', 'col' => 'span 2', 'row' => 'span 2'], ['label' => 'Giardino in primavera'], ['label' => 'Piante ornamentali interne']]],
    ];
}

/** Restituisce lo spazio con quello slug (con indice), oppure null. */
function orsoline_spazio($slug)
{
    foreach (orsoline_spazi() as $i => $s) {
        if ($s['slug'] === $slug) {
            return $s + ['index' => $i];
        }
    }
    return null;
}

/** Note UX del mockup, per sezione. */
function orsoline_notes($section)
{
    $n = [
        'home' => ['Ispirazione domusismc.it: home narrativa, sezioni centrate e ritmo editoriale (accoglienza → spazi → città → voci delle ospiti).', 'Hero immersivo a tutta altezza con messaggio centrato sopra la foto.', 'NUOVO · Accoglienza: risponde alla prima ansia di chi arriva a Milano (e dei genitori).', 'NUOVO · Servizi in città: atenei, trasporti e servizi con tempi di percorrenza — leva decisiva per chi sceglie dove vivere.', 'NUOVO · Recensioni: la riprova sociale è il contenuto più persuasivo per il target 19–25. Testi di esempio da sostituire.', 'Badge “Contenuto nuovo” disattivabile dai Tweaks.'],
        'chi' => ['Titoli di pagina XXL: impatto editoriale da magazine.', 'Linea storica orizzontale e cliccabile: le date guidano alla sezione del testo corrispondente.', 'Pull-quote su Sant’Orsola in card piena bordeaux: il messaggio di libertà e coraggio parla direttamente al target.', 'L’elenco dei servizi (dal copy) è ripetuto come chip scansionabili.'],
        'sub' => ['Navigazione tra i 7 spazi a pill orizzontali in testa: interazione “story-like”.', 'Hero split: titolo dello spazio + foto di copertina.', 'Galleria bento a righe fisse: in WordPress basta una Gallery con layout predefinito.', 'Citazioni dal Regolamento e frasi-chiave affiancate in due card a contrasto.'],
        'contatti' => ['Form con input a pill e chip: tono da app, meno “modulo burocratico”.', 'Contatti in card bordeaux con telefono XXL cliccabile.', 'Stato di conferma dopo l’invio, da collegare a Contact Form 7 / WPForms.', 'Consenso privacy da validare con il testo legale.'],
    ];
    return $n[$section] ?? [];
}
