<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\Player;
use PDOException;
use PDOStatement;

class PlayerRepository
{
    public static function getWhere(string $attr, string $value) : PDOStatement
    {
        $state = Connexion::getPdo()->prepare(
            "SELECT * FROM Player WHERE ".$attr."=:vid;");
        $state->execute(["vid" => $value]);

        return $state;
    }

    public static function getFromId(int $id) : PDOStatement
    {
        return PlayerRepository::getWhere("idPlayer", $id);
    }

    public static function getFromEmail(string $email) : PDOStatement
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
}

?>