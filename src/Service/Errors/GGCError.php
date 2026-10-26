<?php

namespace GachaGameCreator\Service\Errors;

class GGCError
{
    /** @var array<GGCError> */
    private static array $errors;

    public static function press(string $value, int $size = 12) : string
    {
        if (strlen($value) > $size)
        {
            $value = substr($value, 0, $size - 2);
            return $value."..";
        }
        else
        {
            return $value;
        }
    }

    public static function has(int $code) : ?GGCError
    {
        return GGCError::$errors[$code];
    }

    public string $name;
    public string $message;
    public string $img;
    public string $source;

    public function __construct(string $name, string $message, string $sourceId, string $imageId)
    {
        $this->name = $name;
        $this->message = $message;

        if (strlen($sourceId) < 4 || strlen($imageId) < 4)
        {
            $sourceId = "2028593279974167002";
            $imageId = "HCcC1jlawAAiKa2";
        }

        $this->source = "https://x.com/futabadoodles/status/$sourceId";
        $this->img = "https://pbs.twimg.com/media/$imageId?format=jpg";
    }

    public static function init() : void
    {
        self::$errors[42119] = new GGCError(
            "The database is currently not available.",
            "Sorry I have no money!",
            "1945933566728155603",
            "GwFYQ9gWoAAzd2Z"
        );
    }
}

class IdNotFoundError extends GGCError
{
    public function __construct(string $name, string $id)
    {
        parent::__construct("$name ID:'".self::press($id)."' does not exists.",
            "How did you end up here ?",
            "2058633428313260256",
            "HJG8J0yaQAAVp11"
        );
    }
}

class ActionNotFoundError extends GGCError
{
    public function __construct(string $controler, string $action)
    {
        parent::__construct(
            "The dude <i>$controler</i> can't \"".self::press($action)."\".",
            "What are you trying to do ?",
            "1973836524761592284",
            "G2R52rfbwAAx0Pz"
        );
    }
}

class BroNotFoundError extends GGCError
{
    public function __construct(string $controler)
    {
        parent::__construct(
            "There is no dude named \"".self::press($controler)."\".",
            "yea.",
            "1965128691283099701",
            "G0WKIQJacAALXsR"
        );
    }
}

class NotImplementedError extends GGCError
{
    public function __construct(string $name)
    {
        parent::__construct(
            "The feature '$name' is not implemented yet.",
            "I'm coding! Get out!",
            "2028593279974167002",
            "HCcC1jlawAAiKa2"
        );
    }
}