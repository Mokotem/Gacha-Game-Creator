<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\BaseData;
use GachaGameCreator\Modele\Data\HaveItem;
use GachaGameCreator\Modele\Data\Item;
use GachaGameCreator\Modele\Data\Player;

/**
 * @extends BaseRepository<Item>
 */
class ItemRepository extends BaseRepository
{
    private SourceRepository $source;

    public function __construct(
        SourceRepository $sourceRepo)
    {
        parent::__construct("Item");
        $this->source = $sourceRepo;
    }

    public function fromTable(array $value) : Item
    {
        $result = new Item
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

        if (isset($value["idItem"]))
        {
            $state = Connexion::getPdo()->query("SELECT idPlayer FROM LikeItem WHERE idItem = $value[idItem]");
            $result->likes = $state->fetchAll(\PDO::FETCH_NUM);
        }

        return $result;
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
}