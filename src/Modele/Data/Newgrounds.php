<?php

namespace GachaGameCreator\Modele\Data;

class Newgrounds extends Source
{
    public function __construct(int $id, string $name, string $homePage)
    {
        parent::__construct($id, $name, $homePage);
    }

    public function fillInfos(Item $item): bool
    {
        return false;
    }
}