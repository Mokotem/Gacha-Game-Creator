<?php
    /** @var string $bodyPath */
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
        <footer>
            Site de frite4656
        </footer>
    </div>
</body>