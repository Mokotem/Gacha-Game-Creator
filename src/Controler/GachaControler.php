<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;

class GachaControler extends BaseControler
{
    public function __construct()
    {
        parent::__construct("Gacha");
    }

    public function create()
    {
        $this->showp("create.html");
    }
}

?>