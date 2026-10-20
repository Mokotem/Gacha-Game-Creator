<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Repositories\EffectRepository;
use GachaGameCreator\Modele\Repositories\GachaRepository;
use GachaGameCreator\Modele\Repositories\ItemRepository;
use GachaGameCreator\Modele\Repositories\PlayerRepository;
use GachaGameCreator\Modele\Repositories\SourceRepository;

class HomeControler extends BaseControler
{
    private PlayerRepository $player;
    private GachaRepository $gacha;
    private ItemRepository $item;
    private SourceRepository $source;
    private EffectRepository $effect;

    public function __construct()
    {
        parent::__construct("Home");
        $this->player = new PlayerRepository();
        $this->gacha = new GachaRepository($this->player);
        $this->source = new SourceRepository();
        $this->effect = new EffectRepository();
        $this->item = new ItemRepository($this->gacha, $this->source, $this->effect);
        $this->gacha->setItems($this->item);
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
        $this->showp("gachas.php", ["gachas" => $this->gacha->getWhere("visibility > 9")]);
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