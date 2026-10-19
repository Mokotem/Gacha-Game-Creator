<?php use GachaGameCreator\Modele\Data\Gacha;

use GachaGameCreator\Modele\Session;

/**
   * @var string $bodyPath
   * @var Gacha $gacha
   * */
?>

<!DOCTYPE html>
<head>
    <link href="main.css" rel="stylesheet" />
    <title>GGC > Gacha</title>
</head>
<body>
    <?php

    require(__DIR__ . "/../nav.html");
    ?>
    <div>

        <main>

            <?php

            if (strlen($message) > 1)
            {
                require(__DIR__ . "/../displayMessage.php");
            }

            ?>
            <div>
            <?php
                require($bodyPath);
            ?>
            </div>
            <?php
            if (Session::get()->active())
            {
                if (Session::get()->id() == $gacha->owner->id)
                {
                    echo "<aside>";
                    include __DIR__."/settings.php";
                    echo "</aside>";
                }
            }
            ?>
        </main>
        <footer>
            Site de frite4656
        </footer>
    </div>
</body>
