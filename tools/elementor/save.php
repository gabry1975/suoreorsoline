<?php
// Uso: wp eval-file save.php <post_id> <file.json>
list($id, $file) = [(int) $args[0], $args[1]];
$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) { WP_CLI::error('JSON non valido: ' . $file); }
$doc = \Elementor\Plugin::$instance->documents->get($id, false);
if (!$doc) { WP_CLI::error('Documento non trovato: ' . $id); }
$doc->set_is_built_with_elementor(true);
update_post_meta($id, '_elementor_template_type', 'wp-page');
$doc->save(['elements' => $data, 'settings' => ['hide_title' => 'yes']]);
\Elementor\Plugin::$instance->files_manager->clear_cache();
WP_CLI::success("Salvata pagina $id (" . count($data) . " sezioni)");
