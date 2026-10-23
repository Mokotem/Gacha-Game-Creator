<?php
    /** @var string $bodyPath
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
        </main>
        <?php
        require __DIR__."/../footer.html";
        ?>
    </div>
</body>