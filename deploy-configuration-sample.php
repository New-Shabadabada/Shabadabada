<?php
namespace Deployer;

// ================================================================
// configuration
// ================================================================

define('GIT_REPOSITORY', 'git@github.com:O-clock-Oz/worpress-template.git');

// Wordpress installation data ====================================
define('APPLICATION_NAME', 'WP Sample');
define('SITE_NAME', 'WP Sample - minimal Wordpress installation with vuejs');
define('BO_USER', 'julien');
define('BO_PASSWORD', 'aaaa');
define('BO_EMAIL', 'juliens@mail.com');
// ================================================================


// configuration for production serveur ==========================
host('production')  // name of the "environment" : "production"

    ->set('wp_configuration', '00-production.php')  // which wordpress configuration file to use (locatest in "configuration" folder)
    ->set('branch', 'develop') // git branch which will be deployed

    ->hostname('ec2-54-159-124-125.compute-1.amazonaws.com')    // host of the production server
    ->user('ubuntu')                    // ssh user used to connect to the production server
    ->identityFile('~/.ssh/ozAws.pem')  // ssh key used to connect to the production server

    ->set('deploy_path', '/var/www/html/wp-sample') // in which folder the code will be deployed on production server
    ->set('current_release_filepath', '/var/www/html/wp-sample/current/public') // which folder will be used as source files folder
    ->set('site_filepath', '/var/www/html/wp-sample/public')    // which folder will be used as apache root folder

    ->set('rsync_src', __DIR__ . '/public/wp-content/themes/sample/assets/dist')    // local source folder to be synchronized with production server
    ->set('rsync_dest','{{release_path}}/public/wp-content/themes/sample/assets/dist')  // server production folder to be synchronized with local folder
;


// configuration for local deployment (like a preprod) =============
localhost('test')

    ->set('wp_configuration', '10-localhost.php')
    ->set('branch', 'develop')

    ->hostname('localhost')

    ->set('deploy_path', '/var/www/html/wp-sample')
    ->set('current_release_filepath', '/var/www/html/wp-sample/current/public')
    ->set('site_filepath', '/var/www/html/wp-sample/back')

    ->set('rsync_src', __DIR__ . '/public/wp-content/themes/sample/assets/dist')
    ->set('rsync_dest','{{release_path}}/public/wp-content/themes/sample/assets/dist')
;


// configuration for development installation (current folder) =====
localhost('development')
    ->set('wp_configuration', '20-development.php')
    ->set('branch', 'develop')

    ->hostname('localhost')

    ->set('site_filepath', '/var/www/html/oz/spe/worpress-template/public')
;