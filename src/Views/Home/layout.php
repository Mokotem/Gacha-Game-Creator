<?php
    /** @var string $bodyPath */
?>

<!DOCTYPE html>
<head>
    <link href="main.css" rel="stylesheet" />
    <title>GGC > Home</title>
</head>
<body>
    <div>
        <nav>
            <a href="index.php?bro=home&action=home">Home</a>
            <a href="index.php?bro=gacha&action=create">Create</a>
            <a href="index.php?bro=gacha&action=explore">Explore</a>
        </nav>
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