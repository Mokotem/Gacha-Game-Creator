<?php

namespace GachaGameCreator\Modele\Data;

use BaseData;

class Player extends BaseData
{
    public string $email;
    public string $name;
    public int $money;
    public string $password;
    public ?bool $isAdmin;

    public function __construct(
        ?int $id,
        string $email,
        string $name,
        string $password,
        ?int $money = null)
    {
        parent::__construct($id);
        $this->id = is_null($id) ? -1 : $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->money = is_null($money) ? 0 : $money;
        $this->isAdmin = null;
    }
}

?>