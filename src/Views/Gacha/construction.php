
<?php

Use GachaGameCreator\Modele\Data\Gacha;

/**
 * @var Gacha$gacha
 */
?>

<div>
    <h2 class="construction">
       Construction
    </h2>
    <a href="index.php?bro=about&action=gacha">About construction</a>
</div>
<div class="line"></div>
<div>
    <script src="scripts/editGacha.js"></script>
    <?php
    $editMode = true;
    include __DIR__."/gachaForm.php";
    ?>
</div>
<div class="line"></div>
<a class="fat" href="index.php?bro=gacha&action=addItem&id=<?=$gacha->id?>">
    + Add item
</a>
