<?php
    /** @var string $bodyPath */
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
        <footer>
            Site de frite4656
        </footer>
    </div>
</body>