<?php use GachaGameCreator\Modele\Data\Gacha;

use GachaGameCreator\Modele\Session;

/**
   * @var string $bodyPath
   * @var Gacha $gacha
 * @var string $message
   * */
?>
<body>
    <?php

    require(__DIR__ . "/../nav.php");
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
                    include __DIR__ . "/construction.php";
                    echo "</aside>";
                }
            }
            ?>
        </main>
        <?php
        require __DIR__."/../footer.html";
        ?>
    </div>
</body>
