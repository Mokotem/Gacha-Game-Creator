<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use \PDO;
use PDOException;

class Connexion
{
    private static ?Connexion $instance = null;

    public static function getPdo() : PDO
    {
        if (is_null(Connexion::$instance))
        {
            self::$instance = new Connexion();
        }

        return self::$instance->pdo;
    }

    private PDO $pdo;


    private function __construct()
    {
        $config = parse_ini_file(__DIR__ . "/config.ini", false, INI_SCANNER_RAW);

        try
        {
            $this->pdo = new PDO("sqlsrv:server = tcp:".$config["server"].",1433; Database = ".$config["database"],
                $config["login"],
                $config["motDePasse"]);
        }
        catch (PDOException $ex)
        {
            BaseControler::setPDOErrorRedirect("");
            BaseControler::errorFromPDO($ex);
            return;
        }

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>