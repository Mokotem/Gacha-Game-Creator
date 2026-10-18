<?php

require_once __DIR__ . "/../src/Lib/Psr4AutoloaderClass.php";

use GachaGameCreator\Lib\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass(false);
$loader->register();
$loader->addNamespace("GachaGameCreator", __DIR__ . "/../src");

use GachaGameCreator\Controler\BaseControler;

BaseControler::call($_GET["bro"], $_GET["action"]);