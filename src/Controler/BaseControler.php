<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Repositories\Connexion;
use PDOException;
use PDOStatement;

abstract class BaseControler
{
    private string $directory;
    protected array $args;

    protected function __construct(string $directory)
    {
        $this->directory = $directory;
        $this->args = [];
    }

    protected function afficher(string $page, array $args = [])
    {
        extract($args);
        extract($this->args);
        $bodyPath = __DIR__ . "/../Views/".$this->directory."/$page";
        require(__DIR__ . "/../Views/" . $this->directory . "/layout.php");
        $this->args = [];
    }

    /**
     * 1: action no exists
     * 2: contr does not exists
     * 3: email allready exists
     */
    public static function error(string $errorMessage, int $pcode, string $redirect = "")
    {
        $code = "GGC" . $pcode;
        $bodyPath = __DIR__ . "/../Views/Error.php";
        require(__DIR__ . "/../Views/Home/layout.php");
    }

    private static string $pdoRedirect = "";

    public static function setPDOErrorRedirect(string $path)
    {
        self::$pdoRedirect = $path;
    }

    public static function errorFromPDO(PDOException $pdo, string $redirect = "")
    {
        $code = $pdo->getCode();
        $errorMessage = $pdo->getMessage();

        if (strlen($redirect) < 2)
        {
            $redirect = self::$pdoRedirect;
        }

        $bodyPath = __DIR__ . "/../Views/Error.php";
        require(__DIR__ . "/../Views/Home/layout.php");
    }
}

?>