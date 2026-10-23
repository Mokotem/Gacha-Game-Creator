<?php


function money(int $amount) : string
{
    return "<div class='money'>
                <p>$amount</p><img src='content/money.png'/>
            </div>";
}

require_once __DIR__ . "/../src/Lib/Psr4AutoloaderClass.php";

use GachaGameCreator\Lib\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass(false);
$loader->register();
$loader->addNamespace("GachaGameCreator", __DIR__ . "/../src");

use GachaGameCreator\Controler\BaseControler;
use GachaGameCreator\Service\Errors\GGCError;

GGCError::init();

set_time_limit(10);

BaseControler::call($_GET["bro"], $_GET["action"]);

