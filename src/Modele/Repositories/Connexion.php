<?php


namespace GachaGameCreator\Modele\Repositories;

use \PDO;

class Connexion
{
    private static Connexion $instance;

    public static function getPdo() : PDO
    {
        if (is_null(Connexion::$instance))
        {
            $instance = new Connexion();
        }

        return $instance->pdo;
    }

    private PDO $pdo;


    private function __construct()
    {
        $config = parse_ini_file(__DIR__ . "/config.ini", false, INI_SCANNER_RAW);

        $nomHote = $config["nomHote"];
        $nomBaseDeDonnees = $config["nomBaseDeDonnees"];
        $port = $config["port"];
        $login = $config["login"];
        $motDePasse = $config["motDePasse"];

        $this->pdo = new PDO(
            "mysql:host=$nomHote;port=$port;dbname=$nomBaseDeDonnees;charset=utf8mb4",
            $login,
            $motDePasse
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>