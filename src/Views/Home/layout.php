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
            <a href="index.php?action=home">Home</a>
            <a href="index.php?action=create">Create</a>
            <a href="index.php?action=explore">Explore</a>
        </nav>
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