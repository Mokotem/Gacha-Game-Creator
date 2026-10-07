<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Modele\Data\Player;
use GachaGameCreator\Modele\Repositories\PlayerRepository;

class AccountControler extends BaseControler
{
    public function __construct()
    {
        parent::__construct("Account");
    }

    public function createForm()
    {
        $this->showp("create.html");
    }
    public function create() : bool
    {
        $player = PlayerRepository::getFromTaba($_POST);

        $state = PlayerRepository::getFromEmail($_POST["email"]);
        $state->fetchAll();
        if ($state->rowCount() > 0)
        {
            BaseControler::error("An account with the email '" . $_POST["email"] . "' already exists.",
                3,
                "<a href=index.php?bro=account&action=createForm><- Create account</a>");
            return false;
        }

        if (PlayerRepository::insert($player))
        {
            $this->args["message"] = "Account created!";
            $this->signinForm();
            return true;
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