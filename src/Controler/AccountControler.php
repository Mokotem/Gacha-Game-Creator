<?php

namespace GachaGameCreator\Controler;
  
class AccountControler extends BaseControler
{
    public function __construct()
    {
        parent::__construct("Account");
    }

    public function create()
    {
        $this->afficher("create.html");
    }

    public function signIn()
    {
        $this->afficher("signIn.html");
    }
}

?>