<?php

use Sample\Controllers\Sample;

require_once(ABSPATH.'wp-admin/includes/user.php');

$router = new AltoRouter();
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$router->setBasePath($basePath);

//===========================================================

$router->map(
    'GET',
    '/sample/home/',
    function() {
        $controller = new Sample();
        $controller->home();
    }
);


//===========================================================




$match = $router->match();
if($match['target']) {
    $match['target']();
}