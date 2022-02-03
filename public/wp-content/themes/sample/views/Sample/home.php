<?php
namespace Shabadabada;
use Shabadabada\Api;
use Shabadabada\Api\Deezer;
use Shabadabada\Api\DeezerApo;
use Shabadabada\Models\Music;
    use Shabadabada\Models\CoreModel;
    use Shabadabada\Models\Game;


    // TODO : create clean integration for import data
    set_time_limit(0);
    //phpinfo();
    //exit();
    // 
    echo('ici');
    // Deezer import test
    $deezerTest = new DeezerApo();
    $deezerTest->import();
    //$deezerTest->insertBoWp('https://api.deezer.com/search?q=artist:"ZZ-Top"track:"La-Grange"');


    //hello world<br>
