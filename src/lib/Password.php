<?php

namespace GachaGameCreator\lib;

class Password
{
    private static ?string $poivre = null;

    private static function getPoivre(): string
    {
        if (is_null(Password::$poivre)) {
            $configurationSite = parse_ini_file(
                __DIR__ . '/../config.ini',
                false,
                INI_SCANNER_RAW
            );
            Password::$poivre = $configurationSite["poivre"] ?? "";
        }
        return Password::$poivre;
    }

    public static function hacher(string $mdpClair): string
    {
        $mdpPoivre = hash_hmac("sha256", $mdpClair, Password::getPoivre());
        $mdpHache = password_hash($mdpPoivre, PASSWORD_DEFAULT);
        return $mdpHache;
    }

    public static function verifier(string $mdpClair, string $mdpHache): bool
    {
        $mdpPoivre = hash_hmac("sha256", $mdpClair, Password::getPoivre());
        return password_verify($mdpPoivre, $mdpHache);
    }
}