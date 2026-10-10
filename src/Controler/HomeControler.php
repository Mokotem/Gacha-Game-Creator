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
        $this->showp("homeView.php");
    }

    public function confirmPassword()
    {
        $this->showp("confirmPassword.html");
    }

    /**
     * @inheritDoc
     */
    public function defaultAction()
    {
        $this->home();
    }
}

?>