<?php
/** @var string $bodyPath */
?>

<body>
<?php

require(__DIR__ . "/../nav.php");
?>
<div>
    <main>
        <div>
        <?php
        require($bodyPath);
        ?>
        </div>
    </main>
</div>
</body>