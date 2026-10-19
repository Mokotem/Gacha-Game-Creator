<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Repositories\Connexion;
use GachaGameCreator\Modele\Repositories\EffectRepository;
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
    private EffectRepository $effect;

    public function __construct()
    {
        parent::__construct("Gacha");
        $this->player = new PlayerRepository();
        $this->gacha = new GachaRepository($this->player);
        $this->source = new SourceRepository();
        $this->effect = new EffectRepository();
        $this->item = new ItemRepository($this->gacha, $this->source, $this->effect);
        $this->gacha->setItems($this->item);

    }

    public function defaultAction()
    {
        if (isset($_GET["id"]))
        {
            $this->front($_GET["id"]);
        }
        else
        {
            BaseControler::call("home", "gachas");
        }
    }

    public function create()
    {
        if ($this->checkLogedin())
        {
            $this->showp("create.html");
        }
    }

    public function front(int $id = -1)
    {
        $ga = $this->gacha->fromId($id < 0 ? $_GET['id'] : $id);
        $this->showp("frontPage.php", ["gacha" => $ga, "items" => $items]);
    }

    public function allItems()
    {
        $ga = $this->gacha->fromId($_GET['id']);
        $this->showp(
            "allItems.php",
            ["gacha" => $ga, "items" => $items]
        );
    }

    public function addItem()
    {
        $ga = $this->gacha->fromId($_GET['id']);
        $sources = $this->source->getAll();
        $this->showp("addItem.php", [
            "gacha" => $ga,
            "sources" => $sources,
            "confirm" => false,
            "errorMessage" => ""
            ]);
    }

    public function confirmItem()
    {
        $ga = $this->gacha->fromId($_POST['idGacha']);
        $sources = $this->source->getAll();

        $it = $this->item->fromTable($_POST);
        if ($it->source->fillInfos($it))
        {
            $this->showp(
                "addItem.php",
                [
                    "gacha" => $ga,
                    "sources" => $sources,
                    "confirm" => true,
                    "item" => $it,
                    "errorMessage" => ""
                ]
            );
        }
        else
        {
            $this->showp(
                "addItem.php",
                [
                    "gacha" => $ga,
                    "sources" => $sources,
                    "confirm" => false,
                    "item" => $it,
                    "errorMessage" => "Error loading id '".$it->imageId."'."
                ]
            );
        }

    }

    public function uploadItem()
    {
        $it = $this->item->fromTable($_POST);
        $it->source->fillInfos($it);

        if ($this->item->insert($it))
        {
            $this->front($_POST["idGacha"]);
        }
    }

    public function uploadGacha()
    {
        $_POST["idPlayer"] = Session::get()->id();
        $ga = $this->gacha->fromTable($_POST);
        if ($this->gacha->insert($ga))
        {
            $this->front(Connexion::getPdo()->lastInsertId());
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