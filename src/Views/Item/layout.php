<?php use GachaGameCreator\Modele\Data\Gacha;

/**
   * @var string $bodyPath
   * @var Gacha $gacha
   * */
?>
<body>
    <?php

    require(__DIR__ . "/../nav.php");
    ?>
    <div>
        <?php

        if (strlen($message) > 1)
        {
            require(__DIR__ . "/../displayMessage.php");
        }

        ?>
        <main>

        <?php
            require($bodyPath);
        ?>
        </main>

        <?php
        require __DIR__."/../footer.html";
        ?>
    </div>
</body>