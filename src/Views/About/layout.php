<?php
/** @var string $bodyPath */
?>

<!DOCTYPE html>
<head>
    <link href="main.css" rel="stylesheet" />
    <title>GGC > About</title>
</head>
<body>
<?php

require(__DIR__ . "/../nav.html");
?>
<div>
    <main>
        <?php
        require($bodyPath);
        ?>
    </main>
</div>
</body>