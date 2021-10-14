<?php
/**
 * Plugin Name: Sample plugin
 */

use Sample\Api;
use Sample\Plugin;

require __DIR__ . '/static-vendor/autoload.php';

$plugin = new Plugin();
// WARNING attention il faut mettre  __FILE__ le fichier qui gère le plugin
register_activation_hook(__FILE__, [$plugin, 'activate']);
register_deactivation_hook(__FILE__, [$plugin, 'deactivate']);


 $api = new Api();
register_activation_hook(__FILE__, [$api, 'activate']);
register_deactivation_hook(__FILE__, [$api, 'deactivate']);