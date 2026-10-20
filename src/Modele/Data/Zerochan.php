<?php

namespace GachaGameCreator\Modele\Data;

class Zerochan extends Source
{

    function __construct(int $id, string $name, string $homePage)
    {
        parent::__construct($id, $name, $homePage);
    }

    public function fillInfos(Item $item) : string
    {
        $data = file_get_contents("https://www.zerochan.net/$item->imageId?json");
        if (!$data)
        {
            return "ID '$item->imageId' not found.";
        }

        $obj = json_decode($data);
        $item->character = $obj->primary;
        $item->urlSource = $obj->source;

        if (is_null($obj->small))
        {
            if (is_null($obj->medium))
            {
                return "small or medium size of image ID '$item->imageId' not available.";
            }

            $item->urlFull = $obj->medium;
        }
        else
        {
            $item->urlSmall = $obj->small;
        }

        if (is_null($obj->full))
        {
            if (is_null($obj->medium))
            {
                return "full or medium size of image ID '$item->imageId' not available.";
            }

            $item->urlFull = $obj->medium;
        }
        else
        {
            $item->urlFull = $obj->full;
        }

        return "";
    }
}