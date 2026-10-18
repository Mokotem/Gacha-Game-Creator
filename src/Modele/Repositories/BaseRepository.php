<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\BaseData;
use GachaGameCreator\Modele\Repositories\Connexion;
use PDOException;

/** @template T of BaseData */
abstract class BaseRepository
{
    protected string $table;
    protected string $clep;

    protected function __construct(string $tableName)
    {
        $this->table = $tableName;
        $this->clep = "id".$tableName;
    }

    /** @return T  */
    public abstract function fromTable(array $value);


    /** @param T $value */
    public abstract function insert($value) : bool;

    /** @return T */
    public function fromId(int $id)
    {
        $state = Connexion::getPdo()->prepare("SELECT * FROM " . $this->table . " WHERE id".$this->table." = :id;");

        try
        {
            $state->execute(
                [
                    "id" => $id
                ]
            );
        }
        catch (PDOException $error)
        {
            BaseControler::errorFromPDO($error);
            return null;
        }

        $line = $state->fetch();
        if ($line)
        {
            return $this->fromTable($line);
        }

        BaseControler::error("Player id '$id' not found.", "4");
        return null;
    }

    /**
     * @return array<T>
     */
    final protected function fromState(\PDOStatement $state) : array
    {
        $result = [];
        foreach ($state as $line)
        {
            $result[] = $this->fromTable($line);
        }

        return $result;
    }

    /**
     * @param T $data
     */
    public function join(BaseData $data, BaseRepository $repo) : array
    {
        try
        {
            $state = Connexion::getPdo()->query("SELECT * FROM $this->table WHERE $repo->clep = $data->id");
        }
        catch (PDOException $ex)
        {
            BaseControler::errorFromPDO($ex);
            return [];
        }

        return $this->fromState($state);
    }

    public function getAll(): array
    {
        $state = Connexion::getPdo()->prepare("SELECT * FROM " . $this->table);

        try
        {
            $state->execute();
        }
        catch (PDOException $error)
        {
            BaseControler::errorFromPDO($error);
            return [];
        }

        $result = [];

        foreach ($state as $value)
        {
            $result[] = $this->fromTable($value);
        }

        return $result;
    }

    /**
     * @return array<T>
     */
    public function getWhere(string $attr, string $value): array
    {
        try
        {
            $state = Connexion::getPdo()->query("SELECT * FROM $this->table WHERE $attr = '$value';");
        }
        catch (PDOException $error)
        {
            BaseControler::errorFromPDO($error);
            return [];
        }

        return $this->fromState($state);
    }

    public function delete(string $id): bool
    {
        $state = Connexion::getPdo()->prepare("DELETE FROM " . $this->table . " WHERE $this->clep = ':id';");

        try
        {
            $state->execute(
                [
                    "id" => $id
                ]
            );
        }
        catch (PDOException $error)
        {
            BaseControler::errorFromPDO($error);
            return false;
        }

        return $state->rowCount() > 0;
    }

    public function edit(int $id, string $attr, string $value): bool
    {
        $state = Connexion::getPdo()->prepare("UPDATE " . $this->table . " SET :att = :value WHERE $this->clep = :id;");

        try
        {
            $state->execute(
                [
                    "id" => $id,
                    "att" => $attr,
                    "value" => $value
                ]
            );
        }
        catch (PDOException $error)
        {
            BaseControler::errorFromPDO($error);
            return false;
        }

        return $state->rowCount() > 0;
    }
}

?>