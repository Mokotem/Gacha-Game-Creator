<?php

namespace GachaGameCreator\Modele;

class Session
{
    private static ?Session $instance = null;

    /**
     * @throws \Exception
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new \Exception("La session n'a pas réussi à démarrer.");
        }
    }

    public function active() : bool
    {
        return $this->has("idPlayer");
    }

    public static function get() : Session
    {
        if (is_null(Session::$instance))
            Session::$instance = new Session();
        return Session::$instance;
    }

    public function has(string $nom) : bool
    {
        return isset($_SESSION[$nom]);
    }

    public function id() : int
    {
        return $_SESSION["idPlayer"] ?? -1;
    }
    public function setId(int $value) : int
    {
        return $_SESSION["idPlayer"] == $value;
    }

    public function write(string $nom, mixed $valeur) : void
    {
        $_SESSION[$nom] = $valeur;
    }

    public function read(string $nom) : mixed
    {
        return $_SESSION[$nom];
    }

    public function delete(string $nom) : void
    {
        unset($_SESSION[$nom]);
    }

    public function destroy() : void
    {
        Cookie::supprimer(session_name(), "/"); // supprime le cookie de session
        session_unset();     // vide $_SESSION, equivalent à $_SESSION = []
        session_destroy();   // supprime les données de session stockées
        Session::$instance = null;
    }
}