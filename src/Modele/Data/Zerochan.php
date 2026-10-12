<?php

namespace GachaGameCreator\Modele\Data;

class Zerochan extends Source
{

    function __construct(int $id, string $name, string $homePage)
    {
        parent::__construct($id, $name, $homePage);
    }

    public function fillInfos(Item $item): bool
    {
        $data = file_get_contents("https://www.zerochan.net/$item->imageId?json");
        if (!$data)
        {
            return false;
        }

        $obj = json_decode($data);
        $item->character = $obj->primary;
        $item->urlSource = $obj->source;
        $item->urlSmall = $obj->small;
        $item->urlFull = $obj->full;

        return true;
    }
}