<?php


namespace GachaGameCreator\Modele\Repositories;

use \PDO;
use PDOException;

class Connexion
{
    private static ?Connexion $instance = null;

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

        $this->pdo = new PDO(
            "sqlsrv:server = tcp:" . $config["server"] . "," . $config["port"] . "; Database = " . $config["database"],
            $config["login"],
            $config["password"]
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>