<?php
    /** @var string $bodyPath */
?>

<!DOCTYPE html>
<head>
    <link href="main.css" rel="stylesheet" />
    <title>GGC > Home</title>
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
        </main>
        <footer>
            Site de frite4656
        </footer>
    </div>
</body>