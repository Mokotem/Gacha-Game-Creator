<?php

namespace GachaGameCreator\Modele\Data;

class Effect extends BaseData
{
    public string $name;

    public function __construct(?int $id, string $name)
    {
        parent::__construct($id);
        $this->name = $name;
    }
}