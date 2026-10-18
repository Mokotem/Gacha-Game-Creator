<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Repositories\GachaRepository;
use GachaGameCreator\Modele\Repositories\PlayerRepository;

class HomeControler extends BaseControler
{
    private PlayerRepository $player;
    private GachaRepository $gacha;

    public function __construct()
    {
        parent::__construct("Home");
        $this->player = new PlayerRepository();
        $this->gacha = new GachaRepository($this->player);
    }

    public function home()
    {
        $this->showp("homeView.php");
    }

    public function confirmPassword()
    {
        $this->showp("confirmPassword.html");
    }

    public function gachas()
    {
        $this->showp("gachas.php", ["values" => $this->gacha->getAll()]);
    }

    /**
     * @inheritDoc
     */
    public function defaultAction()
    {
        $this->home();
    }
}

?>