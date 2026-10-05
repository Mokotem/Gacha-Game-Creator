<?php

namespace GachaGameCreator\Modele\Data;

class Player
{
    public int $id;
    public string $email;
    public string $name;
    public int $money;
    public string $password;

    public function __construct(
        int $id,
        string $email,
        string $name,
        string $password,
        int $money = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->money = $money;
    }
}

?>