<?php use GachaGameCreator\Modele\Repositories\Connexion;/** @template T of BaseRepository */
abstract class BaseRepository
{
    private string $table;
    protected function __construct(string $tableName)
    {
        $this->table = $tableName;
    }

    /** @return T */
    public abstract function fromTable(array $value);

    /** @return T */
    protected function getFromId(int $id)
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
}

?>