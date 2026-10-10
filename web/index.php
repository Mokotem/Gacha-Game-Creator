<?php

require_once __DIR__ . "/../src/Lib/Psr4AutoloaderClass.php";

use GachaGameCreator\Lib\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass(false);
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

$main = new $cont();

if (isset($_GET["action"]))
{

    $action = $_GET["action"];

    $actionList = get_class_methods($main);

    if (in_array($action, $actionList))
    {
        $main->$action();
    }
    else
    {
        BaseControler::error("Action '" . $action . "' is not implemented.", 1);
        goto end;
    }
}
else
{
    $main->defaultAction();
}

end:

?>