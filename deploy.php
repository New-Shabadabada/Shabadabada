<?php
// DOC php deployer https://deployer.org/
/* DOC installer php deployer
curl -LO https://deployer.org/deployer.phar
sudo chmod +x /usr/local/bin/dep
*/

namespace Deployer;
require 'recipe/common.php';
require __DIR__ . '/static-vendor/autoload.php';
require 'recipe/rsync.php';



if(!is_file(__DIR__. '/deploy-configuration.php')) {

    echo 'You have to create a "deploy-configuration.php" at the root of your project. You can use "deploy-configuration-sample.php" as a template file' . "\n";
    exit();
}

require __DIR__. '/deploy-configuration.php';

// ===========================================================================
// fin configuration
// ===========================================================================
// Project name
set('application', APPLICATION_NAME);

// Project repository
set('repository', GIT_REPOSITORY);

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);
set('allow_anonymous_stats', false);


// Tasks =====================================================================

desc('Deploy your project');
task('deploy', [
    'loadConfiguration',
    'deploy:info',
    'deploy:prepare',
    // 'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    // 'deploy:shared',
    'deploy:writable',
    // 'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    // 'deploy:unlock',
    'cleanup',
    'success',
    'build',
    // 'sendAssets',
    'chmod',
    'informations'

]);
// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');


task('install', [
    'installRequirements',
    'deploy',
    'installBDD',
    'installWordpress',
    'buildHtaccess',
    'chmod',
    'activatePlugins',
    'informations',
]);


task('build', [
    'makeSymlink',
    'composer',
    'createConfiguration',
]);

task('reset', [
    'loadConfiguration',
    'uninstall',
    'dropDatabase',
    'install'
]);


//===========================================================
// tâches de dev local
//===========================================================
task('installDevelopment', [
    'installRequirements',
    'loadConfiguration',
    'composer',
    'createConfiguration',
    'installBDD',
    'installWordpress',
    'chmod',
    'buildHtaccess',
    'activatePlugins',
    'informations',
]);

task('resetDevelopment', [
    'loadConfiguration',
    'localUninstall',
    'dropDatabase',
    'composer',
    'createConfiguration',
    'installBDD',
    'installWordpress',
    'chmod',
    'buildHtaccess',
    'activatePlugins',
    'informations',
]);


task('localUninstall', function() {
    cd('{{site_filepath}}');
    run('sudo rm -rf vendor wp composer.lock');
});

//===========================================================
// tâches communes
//===========================================================

task('sendAssets', function() {
    cd('{{site_filepath}}');
    run('sudo chmod -R 775 wp-content/themes');
});
before('sendAssets', 'rsync');


task('loadConfiguration', function() {
    if(!defined('WP_CONFIGURATION_FILE')) {
        define('WP_CONFIGURATION_FILE', get('wp_configuration'));
        require __DIR__ . '/configuration/' . WP_CONFIGURATION_FILE;
    }
});

task('composer', function() {
    cd('{{site_filepath}}');
    run('composer install');
});


// APO déployer le front
// dans /var/www/html/apo-Shabadabada
// dep deployFront production
task('deployFront', function() {
    upload(__DIR__ . '/public/front', '{{site_filepath}}');
});


task('deleteFront', function() {
    run('rm -rf {{site_filepath}}/front');
});









task('createConfiguration', function() {
    upload(__DIR__ . '/configuration/' . WP_CONFIGURATION_FILE, '{{site_filepath}}/configuration-current.php');
});
before('createConfiguration', 'loadConfiguration');


task('makeSymlink', function () {
    run('ln -s {{current_release_filepath}} {{site_filepath}}');
});

task('chmod', function() {
    cd('{{site_filepath}}');
    run('composer run chmod');
    run('sudo chmod -R 775 wp-content');
});

task('buildHtaccess', function() {
    cd('{{site_filepath}}');
    run('composer run activate-htaccess');
    run ("echo 'RewriteCond %{HTTP:Authorization} ^(.*)' >> ./.htaccess");
    run ("echo 'RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]' >> ./.htaccess");
    run ("echo 'SetEnvIf Authorization \"(.*)\" HTTP_AUTHORIZATION=$1' >> ./.htaccess");
});

task('downloadUploads', function() {
    download('{{site_filepath}}/wp-content/uploads/', __DIR__ . '/public/wp-content/uploads');
    cd('{{site_filepath}}');
    run('sudo chmod -R 775 {{site_filepath}}/wp-content/uploads');
    upload(__DIR__ . '/public/wp-content/uploads/', '{{site_filepath}}/wp-content/uploads');
});

task('sendUploads', function() {
    cd('{{site_filepath}}');
    run('sudo chmod -R 775 {{site_filepath}}/wp-content/uploads');
    upload(__DIR__ . '/public/wp-content/uploads/', '{{site_filepath}}/wp-content/uploads');
});



//===========================================================
// tâches d'installation
//===========================================================

task('installRequirements', function() {
    if(test('[ -f "/usr/local/bin/wp" ]')) {
        run('curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && sudo mv wp-cli.phar /usr/local/bin/wp');
    }
    if(test('[ -f "/usr/local/bin/composer" ]')) {
        run('cd /tmp && php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');" && php composer-setup.php --quiet && sudo mv composer.phar /usr/local/bin/composer');
    }
});


task('installBDD', function() {
    run('mysql -h'.DB_HOST.' -u'.DB_USER.' -p'.DB_PASSWORD.' --execute="CREATE DATABASE '.DB_NAME.' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"');
});
before('installBDD', 'loadConfiguration');


task('installWordpress', function() {
    cd('{{site_filepath}}');
    run('wp core install --url="' . WP_HOME . '" --title="'.SITE_NAME.'" --admin_user="'.BO_USER.'" --admin_password="'.BO_PASSWORD.'" --admin_email="'.BO_EMAIL.'" --skip-email;');
});
before('installWordpress', 'loadConfiguration');


task('activatePlugins', function() {
    cd('{{site_filepath}}');
    run('sudo chown -R $USER wp-content/uploads');
    run('composer run activate-plugins');
    run('composer run activate-theme sample');
});

task('informations', function() {
    writeln('Wordpress installed : ' . WP_HOME);
    writeln('Backoffice : ' . WP_SITEURL . '/wp-admin');
});
before('informations', 'loadConfiguration');

//===========================================================

task('synchronizeProduction', function() {
    cd('{{site_filepath}}');
    run('composer run chmod');
    run('sudo chown -R {{user}} wp-content/uploads');
    run('git add . && git commit -m "synchronize production" && git push');
    runLocally('git pull');
});


task('uninstall', function() {
    cd('{{deploy_path}}');
    run('sudo rm -rf .dep back releases/ shared/ current');
});


task('dropDatabase', function() {
    run('mysql -h'.DB_HOST.' -u'.DB_USER.' -p'.DB_PASSWORD.' --execute="DROP DATABASE '.DB_NAME.' "');
});
before('dropDatabase', 'loadConfiguration');