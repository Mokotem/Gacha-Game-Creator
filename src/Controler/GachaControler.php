<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Repositories\GachaRepository;
use GachaGameCreator\Modele\Repositories\ItemRepository;
use GachaGameCreator\Modele\Repositories\PlayerRepository;
use GachaGameCreator\Modele\Repositories\SourceRepository;
use GachaGameCreator\Modele\Session;

class GachaControler extends BaseControler
{
    private GachaRepository $gacha;
    private PlayerRepository $player;
    private ItemRepository $item;
    private SourceRepository $source;

    public function __construct()
    {
        parent::__construct("Gacha");
        $this->player = new PlayerRepository();
        $this->gacha = new GachaRepository($this->player);
        $this->source = new SourceRepository();
        $this->item = new ItemRepository($this->gacha, $this->source);
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

    public function select(int $id = -1)
    {
        $ga = $this->gacha->fromId($id < 0 ? $_GET['id'] : $id);
        $items = $this->gacha->join($ga, "Item", $this->item);
        $this->showp("frontPage.php", ["gacha" => $ga, "items" => $items]);
    }

    public function addItemForm()
    {
        $ga = $this->gacha->fromId($_GET['id']);
        $sources = $this->source->getAll();
        $this->showp("addItem.php", ["gacha" => $ga, "sources" => $sources]);
    }

    public function addItem()
    {
        $it = $this->item->fromTable($_POST);
        $it->source->fillInfos($it);
        if ($this->item->insert($it))
        {
            $this->select($_POST["idGacha"]);
        }
    }

    public function create()
    {
        $ga = $this->gacha->fromTable($_POST);
        if ($this->gacha->insert($ga))
        {
            $this->explore();
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