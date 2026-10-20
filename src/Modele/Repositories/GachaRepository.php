<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Modele\Data\Gacha;
use GachaGameCreator\Controler\BaseControler;
use PDOException;

/**
 * @extends BaseRepository<Gacha>
 */
class GachaRepository extends BaseRepository
{
    private PlayerRepository $player;
    private ItemRepository $item;

    function __construct(PlayerRepository $player)
    {
        parent::__construct("Gacha");
        $this->player = $player;
    }

    public function setItems(ItemRepository $items)
    {
        $this->item = $items;
    }

    public function fromTable(array $value) : Gacha
    {
        $result = new Gacha(
            $value["idGacha"],
            $value["title"],
            $value["description"],
            $this->player->fromId($value["idPlayer"]),
            $value["pullPrice"] ?? 10,
            $value["visibility"] ?? 0
            );

        $result->items = $this->childs($result, $this->item);

        return $result;
    }

    public function insert($value) : bool
    {
        $state = Connexion::getPdo()->prepare("INSERT INTO Gacha VALUES (:title, :desc, :idPlayer, :visib, :pull);");

        try
        {
            $state->execute(
                [
                    "title" => $value->title,
                    "desc" => $value->desc,
                    "idPlayer" => $value->owner->id,
                    "visib" => $value->visibility,
                    "pull" => $value->pullPrice
                ]
            );
        }
        catch (PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
            return false;
        }

        return true;
    }

    public function update(Gacha $g) : bool
    {
        $state = Connexion::getPdo()->prepare("UPDATE $this->table
        SET title = :t, description = :d, pullPrice = :p WHERE $this->clep = $g->id");

        try
        {
            $state->execute(
                [
                    "t" => $g->title,
                    "d" => $g->desc,
                    "p" => $g->pullPrice
                ]
            );
        }
        catch (PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
            return false;
        }

        return $state->rowCount() > 0;
    }

    public function itemCount(Gacha $value) : int
    {
        $state = Connexion::getPdo()->prepare(
            "SELECT COUNT(idItem) FROM Gacha G LEFT JOIN Item I ON I.idGacha = G.idGacha WHERE G.idGacha=:id");

        try
        {
            $state->execute(
                [
                    "id" => $value->id
                ]
            );
        }
        catch (PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
            return 0;
        }

        return $state->fetch(\PDO::FETCH_NUM)[0];
    }
}

?>