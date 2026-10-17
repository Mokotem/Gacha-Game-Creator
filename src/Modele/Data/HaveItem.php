<?php

namespace GachaGameCreator\Modele\Data;

class HaveItem
{
    public Item $item;
    public Effect $effect;
    public \DateTime $obtained;

    public function __construct(Item $item, Effect $effect, \DateTime $date)
    {
        $this->item = $item;
        $this->effect = $effect;
        $this->obtained = $date;
    }
}