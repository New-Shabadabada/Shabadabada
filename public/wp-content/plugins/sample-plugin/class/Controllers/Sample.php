<?php
namespace Sample\Controllers;


class Sample extends CoreController
{
    public function home()
    {
        $data = [];
        $this->show('views/Sample/home.php', $data);
    }
}
