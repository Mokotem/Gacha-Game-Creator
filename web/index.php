<?php

phpinfo();

require_once __DIR__ . "/../src/Lib/Psr4AutoloaderClass.php";

use GachaGameCreator\Lib\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace("GachaGameCreator", __DIR__ . "/../src");

use GachaGameCreator\Controler\BaseControler;

if (isset($_GET["bro"]))
{
    $cont = "GachaGameCreator\\Controler\\". ucfirst($_GET["bro"])."Controler";

    if (!class_exists($cont))
    {
        BaseControler::error("Controler '" . $cont . "' does not exists.", 2);
        goto end;
    }
}
else
{
    $cont = "GachaGameCreator\Controler\HomeControler";
}

if (isset($_GET["action"]))
{
    $main = new $cont();

    $action = $_GET["action"];

    $actionList = get_class_methods($main);

    if (in_array($action, $actionList))
    {
        $main->$action();
    }
    else
    {
        BaseControler::error("Action '" . $action . "' does not exists.", 1);
        goto end;
    }
}
else
{
    $main = new GachaGameCreator\Controler\HomeControler();
    $main->home();
}

end:

?>