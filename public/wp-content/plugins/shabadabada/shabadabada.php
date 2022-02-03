<?php

/**
 * Plugin Name: Shabadabada
 * Author: Amandine JD Solene
 */

use Shabadabada\Api\Api;
use Shabadabada\Plugin;


// rename vendor file by static-vendor to avoid doing a composer-install everytime someone download the branch
// declare in composer.json the new config
require __DIR__ . '/static-vendor/autoload.php';


$plugin = new Plugin();
// Methods activate and deactivate defines in Plugin.php
register_activation_hook(__FILE__, [$plugin, 'activate']);
register_deactivation_hook(__FILE__, [$plugin, 'deactivate']);


$api = new Api;
register_activation_hook(__FILE__, [$api, 'activate']);
register_deactivation_hook(__FILE__, [$api, 'deactivate']);
