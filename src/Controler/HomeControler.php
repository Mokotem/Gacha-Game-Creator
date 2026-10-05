<?php

namespace GachaGameCreator\Controler;

use GachaGameCreator\Controler\BaseControler;

class HomeControler extends BaseControler
{
    public function __construct()
    {
        parent::__construct("Home");
    }

    public function home()
    {
        $this->afficher("homeView.php");
    }

    public function confirmPassword()
    {
        $this->afficher("confirmPassword.html");
    }
}

?>