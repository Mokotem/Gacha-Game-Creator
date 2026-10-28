<?php

namespace GachaGameCreator\Modele\Data;

class HaveItem
{
    public Item $item;
    public Effect $effect;
    public \DateTime $obtained;
    public int $idPlayer;

    public function __construct(int $player, Item $item, Effect $effect, \DateTime $date)
    {
        $this->idPlayer = $player;
        $this->item = $item;
        $this->effect = $effect;
        $this->obtained = $date;
    }
}