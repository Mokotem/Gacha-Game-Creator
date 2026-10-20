<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Repositories\Connexion;
use GachaGameCreator\Modele\Session;
use PDOException;
use PDOStatement;

abstract class BaseControler
{
    public static function call(?string $bro, ?string $action = null) : bool
    {
        if (!is_null($bro))
        {
            $cont = "GachaGameCreator\\Controler\\". ucfirst($bro)."Controler";

            if (!class_exists($cont))
            {
                BaseControler::error("Controler '" . $cont . "' does not exists.", 2);
                return false;
            }
        }
        else
        {
            $cont = "GachaGameCreator\Controler\HomeControler";
        }

        $main = new $cont();

        if (!is_null($action))
        {
            $actionList = get_class_methods($main);

            if (in_array($action, $actionList))
            {
                $main->$action();
            }
            else
            {
                BaseControler::error("Action '$action' is not implemented in '$cont'.", 1);
                return false;
            }
        }
        else
        {
            $main->defaultAction();
        }
        
        return true;
    }

    private string $directory;
    protected array $args;

    protected function __construct(string $directory)
    {
        $this->directory = $directory;
        $this->args = [];
    }

    public abstract function defaultAction();

    protected function showp(string $page, array $args = [])
    {
        $_title = $this->directory;
        require __DIR__."/../Views/header.php";

        extract($args);
        extract($this->args);

        $bodyPath = __DIR__ . "/../Views/" . $this->directory . "/$page";
        require(__DIR__ . "/../Views/" . $this->directory . "/layout.php");
        $this->args = [];
    }

    protected function checkLogedin() : bool
    {
        if (Session::get()->active())
        {
            return true;
        }
        else
        {
            $this->showp("../Account/signin.html");
            return false;
        }
    }

    /**
     * 1: action no exists
     * 2: contr does not exists
     * 3: email allready exists
     * 4: user doesn't exists
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