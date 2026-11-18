<?php
/**
 * Form "Scrivici" della pagina Contatti.
 * Invia una email all'indirizzo amministratore di WordPress (Impostazioni > Generali).
 * Destinatario modificabile con il filtro 'orsoline_contact_recipient'.
 */

if (!defined('ABSPATH')) {
    exit;
}

/** Opzioni dei chip del form, come nel mockup. */
function orsoline_form_options($field)
{
    $o = [
        'relazione' => ['La Studentessa', 'Genitore', 'Altro-Specificare nel messaggio'],
        'universita' => ['Cattolica', 'Politecnico', 'Statale', 'Bocconi', 'Altro-Specificare nel messaggio'],
        'periodo' => ['Intero anno accademico da settembre a luglio', 'Altro-Specificare nel messaggio'],
    ];
    return $o[$field] ?? [];
}

function orsoline_handle_contact()
{
    $back = home_url('/contatti/');
    $field = function ($k) {
        return isset($_POST[$k]) ? sanitize_text_field(wp_unslash($_POST[$k])) : '';
    };

    $ok_nonce = isset($_POST['orsoline_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['orsoline_nonce'])), 'orsoline_contatti');
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));

    // Campo trappola per i bot: se compilato, fingiamo l'invio.
    if ($field('sito_web') !== '') {
        wp_safe_redirect(add_query_arg('inviato', '1', $back));
        exit;
    }
    if (!$ok_nonce || !is_email($email) || empty($_POST['privacy'])) {
        wp_safe_redirect(add_query_arg('inviato', '0', $back));
        exit;
    }

    $pick = function ($k) use ($field) {
        $v = $field($k);
        return in_array($v, orsoline_form_options($k), true) ? $v : '';
    };
    $msg = isset($_POST['messaggio']) ? sanitize_textarea_field(wp_unslash($_POST['messaggio'])) : '';

    $body = "Richiesta informazioni dal sito\n\n"
        . 'Email: ' . $email . "\n"
        . 'Relazione con la Studentessa: ' . $pick('relazione') . "\n"
        . 'Nome e Cognome della Studentessa: ' . $field('nome') . "\n"
        . 'Dati anagrafici: ' . $field('anagrafica') . "\n"
        . 'Università: ' . $pick('universita') . "\n"
        . 'Periodo di permanenza: ' . $pick('periodo') . "\n\n"
        . "Messaggio:\n" . $msg . "\n\n"
        . "Consenso privacy: sì\n";

    $to = apply_filters('orsoline_contact_recipient', get_option('admin_email'));
    $sent = wp_mail($to, 'Richiesta informazioni dal sito', $body, ['Reply-To: ' . $email]);

    wp_safe_redirect(add_query_arg('inviato', $sent ? '1' : '0', $back));
    exit;
}
add_action('admin_post_nopriv_orsoline_contatti', 'orsoline_handle_contact');
add_action('admin_post_orsoline_contatti', 'orsoline_handle_contact');
