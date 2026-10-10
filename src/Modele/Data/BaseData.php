<?php

namespace GachaGameCreator\Modele\Data;

class BaseData
{
    public ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }
}

?>