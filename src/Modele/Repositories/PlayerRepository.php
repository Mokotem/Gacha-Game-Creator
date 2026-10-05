<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Modele\Data\Player;

class PlayerRepository
{
    public static function getWhere(string $attr, string $value)
    {
        $state = Connexion::getPdo()->prepare(
            "SELECT * FROM Player WHERE ".$attr."=:vid;");
        $state->execute(["vid" => $value]);

        if (is_null($state->errorCode()) && $state->rowCount() > 0)
        {
            return PlayerRepository::getFromTaba($state->fetch());
        }
        return null;
    }

    public static function getFromId(int $id) : ?Player
    {
        return PlayerRepository::getWhere("idPlayer", $id);
    }

    public static function getFromEmail(string $email) : Player
    {
        return PlayerRepository::getWhere("email", $email);
    }

    public static function getFromTaba(array $taba) : Player
    {
        return new Player(
            $taba["id"],
            $taba["email"],
            $taba["name"],
            $taba["password"],
            $taba["money"]);
    }

    public static function insert(Player $p) : bool
    {
        $state = Connexion::getPdo()->prepare(
            "INSERT INTO Player (email, name, password, money) VALUES (:email, :name, :password, :money);"
        );
        $state->execute(
            [
                "email" => $p->email,
                "name" => $p->name,
                "password" => $p->password,
                "money" => $p->money
            ]
        );

        return is_null($state->errorCode());
    }
}

?>