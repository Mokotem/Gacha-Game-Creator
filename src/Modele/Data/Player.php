<?php

namespace GachaGameCreator\Modele\Data;


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

    public function __toString(): string
    {
        return "{player $this->id, $this->name}";
    }

    public function getPreview(string $tag = "") : string
    {
        return "<div $tag class='flat'>
                    <p class='mini'>by</p>
                    <a class='mini' href=index.php?bro=account&id=$this->id>$this->name</a>
                </div>";
    }
}

?>