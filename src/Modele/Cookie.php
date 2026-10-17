<?php

namespace GachaGameCreator\Modele;

class Cookie
{
    public static function enregistrer(string $cle, mixed $valeur, int $houres = -1): void
    {
        setcookie($cle, serialize($valeur), ["expires" => $houres < 0 ? 0 : time() + ($houres * 3600)]);
    }

    public static function lire(string $cle): mixed
    {
        return unserialize($_COOKIE[$cle]);
    }

    public static function contient(string $cle) : bool
    {
        return isset($_COOKIE[$cle]);
    }

    public static function supprimer(string $cle, string $path = "") : void
    {
        unset($_COOKIE[$cle]);
        setcookie($cle, "", ["expires" => 1, "path" => $path]);
    }
}