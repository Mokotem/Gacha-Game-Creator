<?php
    /** @var string $bodyPath
     * @var string $message
     * */
?>

<!DOCTYPE html>
<head>
    <link href="main.css" rel="stylesheet" />
    <title>GGC > Account</title>
</head>
<body>
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