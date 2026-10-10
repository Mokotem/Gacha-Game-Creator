<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Data\Player;
use GachaGameCreator\Modele\Repositories\PlayerRepository;

class AccountControler extends BaseControler
{
    private PlayerRepository $repo;

    public function __construct()
    {
        parent::__construct("Account");
        $this->repo = new PlayerRepository();
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
        $player = $this->repo->fromTable($_POST);

        $p = $this->repo->fromEmail($_POST["email"]);
        if (is_null($p))
        {
            if (PlayerRepository::insert($player))
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

    public function signin()
    {

    }
}

?>