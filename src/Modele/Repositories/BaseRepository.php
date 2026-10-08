<?php use GachaGameCreator\Modele\Repositories\Connexion;/** @template T of BaseData */
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
        $state = Connexion::getPdo()->prepare("SELECT * FROM :table WHERE id:table = ':id';");
        
        try
        {
            $state->execute(
                [
                    "table" => $this->table,
                    "id" => $id
                ]);
        }
        catch(PDOException $error)
        {
            
        }

        $line = $state->fetch();

        if ($state->rowCount() > 0)
        {
            return $this->fromTable($line);
        }
        else
        {
            return null;
        }
    }

    public function getWhere(string $attr, string $value) : array
    {
        $state = Connexion::getPdo()->prepare("SELECT * FROM :table WHERE :att = :value;");

        try
        {
            $state->execute(
                [
                    "table" => $this->table,
                    "att" => $attr,
                    "value" => $value
                ]);
        }
        catch (PDOException $error)
        {

        }

        return $state->fetchAll();
    }

    public function delete(string $id) : bool
    {
        $state = Connexion::getPdo()->prepare("DELETE FROM :table WHERE id:table = ':id';");

        try
        {
            $state->execute(
                [
                    "table" => $this->table,
                    "id" => $id
                ]);
        }
        catch (PDOException $error)
        {

            return false;
        }

        return $state->rowCount() > 0;
    }

    public function edit(int $id, string $attr, string $value) : bool
    {
        $state = Connexion::getPdo()->prepare("UPDATE :table SET :att = :value WHERE id:table = :id;");

        try
        {
            $state->execute(
                [
                    "table" => $this->table,
                    "id" => $id
                ]);
        }
        catch (PDOException $error)
        {

            return false;
        }

        return $state->rowCount() > 0;
    }
}

?>