<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\lib\Password;
use GachaGameCreator\Modele\Data\Player;
use GachaGameCreator\Modele\Repositories\Connexion;
use GachaGameCreator\Modele\Repositories\PlayerRepository;
use GachaGameCreator\Modele\Session;
use http\Exception\BadMethodCallException;

class AccountControler extends BaseControler
{
    private PlayerRepository $player;

    public function __construct()
    {
        parent::__construct("Account");
        $this->player = new PlayerRepository();
    }

    public function defaultAction()
    {
        $this->signin();
    }

    public function createForm()
    {
        $this->showp("create.html");
    }

    public function create() : bool
    {
        $player = $this->player->fromTable($_POST);

        $p = $this->player->fromEmail($_POST["email"]);
        if (is_null($p))
        {
            $player->password = Password::hacher($player->password);

            if ($this->player->insert($player))
            {
                $this->args["message"] = "Account created!";
                $this->signinForm();
                return true;
            }
        }
        else
        {
            BaseControler::error(
                "An account with the email '" . $_POST["email"] . "' already exists.",
                3,
                "<a href=index.php?bro=account&action=createForm><- Create account</a>"
            );
            return false;
        }

        return false;
    }

    public function signinForm()
    {
        $this->showp("signin.html");
    }

    public function signin() : bool
    {
        if ($_POST["method"] == "email")
        {
            $pl = $this->player->getWhere("money", 1000)[0];
            if (is_null($pl))
            {
                $this->args["message"] = "No account with email '$_POST[email]'.";
                $this->signinForm();
                return false;
            }
        }
        else
        {
            $pl = $this->player->fromId($_POST["idPlayer"]);
            if (is_null($pl))
            {
                $this->args["message"] = "No account with account ID:$_POST[idPlayer].";
                $this->signinForm();
                return false;
            }
        }

        if (Password::verifier($_POST["password"], $pl->password))
        {
            Session::get()->setId($pl->id);
            $this->profile();
            return true;
        }
        else
        {
            $this->args["message"] = "Wrong password.";
            $this->signinForm();
            return false;
        }
    }

    public function profile()
    {
        if (Session::get()->active())
        {
            $player = $this->player->fromId(Session::get()->id());
            $this->showp("profile.php", ["player" => $player]);
        }
        else
        {
            $this->signinForm();
        }
    }
}

?>