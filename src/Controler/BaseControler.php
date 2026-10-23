<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Repositories\Connexion;
use GachaGameCreator\Modele\Session;
use GachaGameCreator\Service\Errors\ActionNotFoundError;
use GachaGameCreator\Service\Errors\BroNotFoundError;
use GachaGameCreator\Service\Errors\GGCError;
use PDOException;
use PDOStatement;

abstract class BaseControler
{
    public static function call(?string $bro, ?string $action = null) : bool
    {
        if (is_null($bro))
        {
            $bro = "Home";
        }

        $cont = "GachaGameCreator\\Controler\\". ucfirst($bro)."Controler";

        if (!class_exists($cont))
        {
            BaseControler::error(new BroNotFoundError($bro));
            return false;
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
                BaseControler::error(new ActionNotFoundError($bro, $action));
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
        foreach ($args as $a)
        {
            $this->args[] = $a;
        }
        BaseControler::showPage($this->directory, $page, $this->args);
        $this->args = [];
    }

    private static function showPage(string $directory, string $page, array $args = [])
    {
        if ($directory == "none")
        {
            $_title = "";
            require __DIR__ . "/../Views/header.php";

            extract($args);

            $bodyPath = __DIR__ . "/../Views/$page";
            require(__DIR__ . "/../Views/Home/layout.php");
        }
        else
        {
            $_title = " > $directory";
            require __DIR__ . "/../Views/header.php";

            extract($args);

            $bodyPath = __DIR__ . "/../Views/" . $directory . "/$page";
            require(__DIR__ . "/../Views/" . $directory . "/layout.php");
        }
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
    public static function error(GGCError $error)
    {
        self::showPage("none", "errors/ggc.php", [
            "error" => $error, "_title" => "Error"]);
    }

    private static string $pdoRedirect = "";

    public static function setPDOErrorRedirect(string $path)
    {
        self::$pdoRedirect = $path;
    }

    public static function errorFromPDO(PDOException $pdo, string $redirect = "")
    {
        if (strlen($redirect) < 2)
        {
            $redirect = self::$pdoRedirect;
        }

        $err = GGCError::has($pdo->errorInfo[1]);
        if (is_null($err))
        {
            self::showPage("none", "errors/pdo.php", [
                "pdo" => $pdo,
                "redirect" => $redirect,
                "_title" => "Error"]);
        }
        else
        {
            self::showPage("none", "errors/ggc.php", [
                "pdo" => $pdo,
                "error" => $err,
                "redirect" => $redirect,
                "_title" => "Error"]);
        }

    }
}

?>