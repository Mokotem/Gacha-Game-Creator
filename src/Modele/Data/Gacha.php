<?php

namespace GachaGameCreator\Modele\Data;

class Gacha extends BaseData
{
    public string $title;
    public ?string $desc;
    public Player $owner;
    public int $visibility;
    public int $pullPrice;

    public function __construct(?int $id, string $title, ?string $desc, Player $player, int $pullPrice = 10, int $visibility = 0)
    {
        parent::__construct($id);
        $this->title = $title;
        $this->desc = $desc;
        $this->owner = $player;
        $this->pullPrice = $pullPrice;
        $this->visibility = $visibility;
    }
}

?>