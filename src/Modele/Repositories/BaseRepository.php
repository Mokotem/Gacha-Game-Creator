<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Modele\Data\BaseData;
use GachaGameCreator\Modele\Repositories\Connexion;
use PDOException;

/** @template T of BaseData */
abstract class BaseRepository
{
    private string $table;
    protected function __construct(string $tableName)
    {
        $this->table = $tableName;
    }

    /** @return T  */
    public abstract function fromTable(array $value);

    /** @return T */
    protected function get(int $id)
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

        if ($state->columnCount() > 0)
        {
            return $this->fromTable($state->fetch());
        }

        BaseControler::error("Player id '$id' not found.", "4");
        return null;
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

    public function getWhere(string $attr, string $value): array
    {
        $state = Connexion::getPdo()->prepare("SELECT * FROM " . $this->table . " WHERE :att = :v;");

        try
        {
            $state->execute(
                [
                    "att" => $attr,
                    "v" => $value
                ]
            );
        }
        catch (PDOException $error)
        {
            BaseControler::errorFromPDO($error);
            return [];
        }

        return $state->fetchAll();
    }

    public function delete(string $id): bool
    {
        $state = Connexion::getPdo()->prepare("DELETE FROM " . $this->table . " WHERE id:table = ':id';");

        try
        {
            $state->execute(
                [
                    "table" => $this->table,
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
        $state = Connexion::getPdo()->prepare("UPDATE " . $this->table . " SET :att = :value WHERE id:table = :id;");

        try
        {
            $state->execute(
                [
                    "table" => $this->table,
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