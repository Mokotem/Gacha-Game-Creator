<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\Item;

/**
 * @extends BaseRepository<Item>
 */
class ItemRepository extends BaseRepository
{
    private GachaRepository $gacha;
    private SourceRepository $source;

    public function __construct(GachaRepository $gachaRepo, SourceRepository $sourceRepo)
    {
        parent::__construct("Item");
        $this->gacha = $gachaRepo;
        $this->source = $sourceRepo;
    }

    public function fromTable(array $value) : Item
    {
        return new Item
        (
            $value["idItem"],
            $value["name"],
            $value["rarity"],
            $value["idImage"],
            $this->gacha->fromId($value["idGacha"]),
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
                     (:name, :rarity, :idimage, :idgacha, :small, :full, :source, :idsource, :character);");

        try
        {
            $state->execute(
                [
                    "name" => $item->name,
                    "rarity" => $item->rarity,
                    "idimage" => $item->imageId,
                    "idgacha" => $item->gacha->id,
                    "small" => $item->urlSmall,
                    "full" => $item->urlFull,
                    "source" => $item->urlSource,
                    "idsource" => $item->source->id,
                    "character" => $item->character
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