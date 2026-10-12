<?php

namespace GachaGameCreator\Modele\Data;

abstract class Source extends BaseData
{
    public string $name;
    public string $homePageUrl;
    
    public function __construct(int $id, string $name, string $homePage)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->homePageUrl = $homePage;
    }

    public abstract function fillInfos(Item $item) : bool;
}