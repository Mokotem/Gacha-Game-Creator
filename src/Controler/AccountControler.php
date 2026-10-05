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
        $this->afficher("create.html");
    }
    public function create()
    {
        $player = PlayerRepository::getFromTaba($_POST);
        $state = PlayerRepository::insert($player);

        if (is_null($state->errorCode()))
        {
            $this->signinForm();
        }
        else
        {
            BaseControler::error(
                $state->errorInfo(),
                $state->errorCode(),
                "<a href='index.php?bro=account&action=create'><- Create account</a>"
            );
        }
    }

    public function signinForm()
    {
        $this->afficher("signin.html");
    }
    public function signin()
    {

    }
}

?>