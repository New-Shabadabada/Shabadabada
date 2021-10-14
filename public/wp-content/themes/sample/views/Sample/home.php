<?php
namespace Shabadabada;
use Shabadabada\Api;
use Shabadabada\Deezer;
use Shabadabada\DeezerApo;
use Shabadabada\Models\Music;
    use Shabadabada\Models\CoreModel;
    use Shabadabada\Models\Game;

    set_time_limit(0);
    //phpinfo();
    //exit();
    // 
    // die('ici');
    // Deezer import test
    $deezerTest = new DeezerApo();
    $deezerTest->import();
    //$deezerTest->insertBoWp('https://api.deezer.com/search?q=artist:"ZZ-Top"track:"La-Grange"');

    ?>
    hello world<br>
