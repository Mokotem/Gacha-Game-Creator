<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Modele\Data\Newgrounds;
use GachaGameCreator\Modele\Data\Source;
use GachaGameCreator\Modele\Data\Zerochan;
use mysql_xdevapi\Exception;

/**
 * @extends BaseRepository<Source>
 */
class SourceRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("Source");
    }

    public function insert($value): bool
    {
        return false;
    }

    public function fromTable(array $value) : Source
    {
        if ($value["idSource"] == 1)
        {
            return new Zerochan(1, $value["name"], $value["homePageUrl"]);
        }
        else if ($value["idSource"] == 2)
        {
            return new Newgrounds(2, $value["name"], $value["homePageUrl"]);
        }
        else
        {
            throw new Exception("Source id '$value[idSource]' does not exists");
        }
    }
}