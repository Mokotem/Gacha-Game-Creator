<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Repositories\GachaRepository;
use GachaGameCreator\Modele\Repositories\PlayerRepository;
use GachaGameCreator\Modele\Session;

class GachaControler extends BaseControler
{
    private GachaRepository $gacha;
    private PlayerRepository $player;

    public function __construct()
    {
        parent::__construct("Gacha");
        $this->player = new PlayerRepository();
        $this->gacha = new GachaRepository($this->player);
    }

    public function defaultAction()
    {
        $this->explore();
    }

    public function createForm()
    {
        $this->showp("create.html");
    }

    public function explore()
    {
        $this->showp("explore.php", ["values" => $this->gacha->getAll()]);
    }

    public function create()
    {
        $ga = $this->gacha->fromTable($_POST);
        if ($this->gacha->insert($ga))
        {
            $this->myGachas();
        }
    }

    public function myGachas()
    {
        $gachas = $this->gacha->getWhere("idPlayer", Session::getAccount());
        echo "debug: ". print_r($gachas);
        $this->showp("myGachas.php", ["values" => $gachas]);
    }

}

?>