<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Repositories\SourceRepository;

class AboutControler extends BaseControler
{
    private SourceRepository $sources;

    public function __construct()
    {
        parent::__construct("About");
        $this->sources = new SourceRepository();
    }

    public function sources()
    {
        $this->showp("sources.php", ["sources" => $this->sources->getAll()]);
    }

    public function defaultAction()
    {
        $this->showp("about.html");
    }

    public function gacha()
    {
        $this->showp("gacha.html");
    }

    public function items()
    {
        $this->showp("items.html");
    }
}
