<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Modele\Repositories\BaseRepository;
use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\Player;
use PDOException;
use PDOStatement;

/**
 * @extends BaseRepository<Player>
 */
class PlayerRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("Player");
    }

    public function fromTable(array $value) : Player
    {
        return new Player(
            $value["idPlayer"],
            $value["email"],
            $value["name"],
            $value["password"],
            $value["money"]
        );
    }

    public function fromEmail(string $email) : ?Player
    {
        $result = $this->getWhere("email", $email);
        if (count($result) > 0)
        {
            return $result[0];
        }
        return null;
    }

    /** @param Player $p */
    public function insert($p): bool
    {
        $state = Connexion::getPdo()->prepare(
            "INSERT INTO Player (email, name, password, money) VALUES (:email, :name, :password, :money);"
        );

        try
        {
            $state->execute(
                [
                    "email" => $p->email,
                    "name" => $p->name,
                    "password" => $p->password,
                    "money" => 0
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

    public static function isAdmin(Player $p): bool
    {
        if (is_null($p->isAdmin))
        {
            $state = Connexion::getPdo()->prepare("SELECT * FROM Admin WHERE idPlayer=':id';");
            $state->execute(["id" => $p->id]);
            $state->fetch();
            $p->isAdmin = $state->rowCount() > 0;
        }

        return $p->isAdmin;
    }
}
?>