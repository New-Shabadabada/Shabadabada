<?php

/**
 * Plugin Name: Shabadabada
 * Author: Amandine JD Solene
 */

use Shabadabada\Api;
use Shabadabada\Plugin;


// rename vendor file by static-vendor to avoid doing a composer-install everytime someone download the branch
// declare in composer.json the new config
require __DIR__ . '/static-vendor/autoload.php';


//class Plugin instanciation 
$plugin = new Plugin();

// hook registration for the plugin activation and deactivation
// when the plugin will be activate, wp will call the activate method of the callable $plugin
// when the plugin will be deactivate, wp will call the deactivate method of the callable $plugin
register_activation_hook(__FILE__, [$plugin, 'activate']);
register_deactivation_hook(__FILE__, [$plugin, 'deactivate']);


$api = new Api;
register_activation_hook(__FILE__, [$api, 'activate']);
register_deactivation_hook(__FILE__, [$api, 'deactivate']);
