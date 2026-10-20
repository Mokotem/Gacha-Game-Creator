<?php use GachaGameCreator\Modele\Data\Gacha; use GachaGameCreator\Modele\Data\Item;

/**
 * @var Gacha $gacha;
 * @var array<Item> $items;
 */

?>

<h2>
    Available items in <a href="index.php?bro=gacha&action=front&id=<?=$gacha->id?>"><?=$gacha->title?></a>
</h2>

<div class="line"></div>

<div style="justify-content: space-evenly">
    <?php
    foreach ($gacha->items as $it)
    {
        echo $it->preview();
    }
    ?>
</div>

<div class="line"></div>

<a class="fat" href="index.php?bro=gacha&action=front&id=<?= $gacha->id ?>"><?='<- '. $gacha->title ?></a>

<div class="line"></div>

<?php include __DIR__."/credits.php";?>