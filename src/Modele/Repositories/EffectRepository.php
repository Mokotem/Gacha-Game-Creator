<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\Effect;

/**
 * @extends BaseRepository<Effect>
 */
class EffectRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("Effect");
    }

    public function fromTable(array $value) : Effect
    {
        return new Effect($value["effectId"], $value["name"]);
    }

    public function insert($value): bool
    {
        $state = Connexion::getPdo()->prepare("insert into $this->table (name) values (:n)");
        try
        {
            $state->execute(["n" => $value->name]);
        }
        catch (\PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
            return false;
        }

        return true;
    }
}