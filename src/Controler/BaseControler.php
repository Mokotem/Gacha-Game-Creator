<?php

namespace GachaGameCreator\Controler;

abstract class BaseControler
{
    private string $directory;

    protected function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    protected function afficher(string $page, array $args = [])
    {
        extract($args);
        $bodyPath = __DIR__ . "/../Views/".$this->directory."/$page";
        require(__DIR__ . "/../Views/" . $this->directory . "/layout.php");
    }

    /**
     * 1: action no exists
     * 2: contr does not exists
     */
    public static function error(string $message, string $code, string $redirect = "")
    {
        $bodyPath = __DIR__ . "/../Views/Error.php";
        require(__DIR__ . "/../Views/Home/layout.php");
    }
}

?>