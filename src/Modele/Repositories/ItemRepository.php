<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\HaveItem;
use GachaGameCreator\Modele\Data\Item;
use GachaGameCreator\Modele\Data\Player;

/**
 * @extends BaseRepository<Item>
 */
class ItemRepository extends BaseRepository
{
    private GachaRepository $gacha;
    private SourceRepository $source;
    private EffectRepository $effect;

    public function __construct(GachaRepository $gachaRepo, SourceRepository $sourceRepo, EffectRepository $effect)
    {
        parent::__construct("Item");
        $this->gacha = $gachaRepo;
        $this->source = $sourceRepo;
        $this->effect = $effect;
    }

    public function fromTable(array $value) : Item
    {
        return new Item
        (
            $value["idItem"],
            $value["name"],
            $value["rarity"],
            $value["idImage"],
            $value["idGacha"],
            $value["urlFull"],
            $value["urlSmall"],
            $value["urlSource"],
            $value["character"],
            $this->source->fromId($value["idSource"])
        );
    }

    /**
     * @param Item $item
     * */
    public function insert($item) : bool
    {
        $state = Connexion::getPdo()->prepare("INSERT INTO Item VALUES
                     (:name, :rarity, :idimage, :idgacha, :small, :full, :source, :idsource, :character, :d);");

        try
        {
            $state->execute(
                [
                    "name" => $item->name,
                    "rarity" => $item->rarity,
                    "idimage" => $item->imageId,
                    "idgacha" => $item->idGacha,
                    "small" => $item->urlSmall,
                    "full" => $item->urlFull,
                    "source" => $item->urlSource,
                    "idsource" => $item->source->id,
                    "character" => $item->character,
                    "d" => (new \DateTime())->format("Y-m-d")
                ]
            );
        }
        catch (\PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
            return false;
        }

        return true;
    }

    public function insertOwner(Player $p, HaveItem $item) : bool
    {
        $state = Connexion::getPdo()->prepare(
            "insert into HaveItem values ($p->id, $item->item->id, $item->effect->id, :date);");
        try
        {
            $state->execute(
                [
                    "date" => (new \DateTime())->format("d-m-Y")
                ]
            );
        }
        catch (\Exception $ex)
        {
            BaseControler::errorFromPDO($ex);
            return false;
        }

        return true;
    }

    public function importItems(Player $p) : bool
    {
        $p->items = [];
        try
        {
            $state = Connexion::getPdo()->query("SELECT * FROM HaveItem WHERE idPlayer = $p->id;");
        }
        catch (\Exception $ex)
        {
            BaseControler::errorFromPDO($ex);
            return false;
        }

        foreach ($state as $line)
        {
            $hit = new HaveItem(
                $this->fromId($line["idItem"]),
                $this->effect->fromId($line["idEffect"]),
                new \DateTime($line["obtained"])
            );
            $p->items[] = $hit;
        }

        return true;
    }
}