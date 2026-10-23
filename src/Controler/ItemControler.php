<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Data\HaveItem;
use GachaGameCreator\Modele\Repositories\Connexion;
use GachaGameCreator\Modele\Repositories\EffectRepository;
use GachaGameCreator\Modele\Repositories\GachaRepository;
use GachaGameCreator\Modele\Repositories\ItemRepository;
use GachaGameCreator\Modele\Repositories\PlayerRepository;
use GachaGameCreator\Modele\Repositories\SourceRepository;
use GachaGameCreator\Modele\Session;
use GachaGameCreator\Service\Errors\NotImplementedError;

class ItemControler extends BaseControler
{
    private GachaRepository $gacha;
    private PlayerRepository $player;
    private ItemRepository $item;
    private SourceRepository $source;
    private EffectRepository $effect;

    public function __construct()
    {
        parent::__construct("Item");
        $this->player = new PlayerRepository();
        $this->gacha = new GachaRepository($this->player);
        $this->source = new SourceRepository();
        $this->effect = new EffectRepository();
        $this->item = new ItemRepository($this->gacha, $this->source, $this->effect);
    }


    public function defaultAction()
    {
        $this->explore();
    }

    public function get()
    {
        $ite = $this->item->fromId($_POST["idItem"]);
        $eff = $this->effect->fromId($_POST["idEffect"]);

        try {
        $state = Connexion::getPdo()->query("Select * from HaveItem WHERE idItem=$_POST[idItem] AND idEffect=$_POST[idEffect]");
        }
        catch (\PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
        }

        $owners = $state->fetchAll();

        if (count($owners) > 0)
        {
            $this->front($ite->id);
        }
        else
        {
            $player = $this->player->fromId(Session::getAccount());
            if ($this->item->insertOwner($player, new HaveItem($ite, $eff, new \DateTime())))
            {
                $this->showp();
            }
        }
    }

    public function front(int $id = -1)
    {
        BaseControler::error(new NotImplementedError("item front page"));
    }

    public function explore()
    {
        BaseControler::error(new NotImplementedError("explore items"));
    }
}