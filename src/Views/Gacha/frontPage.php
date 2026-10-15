<?php
Use GachaGameCreator\Modele\Data\Gacha;
Use GachaGameCreator\Modele\Data\Item;
/** @var Gacha $gacha */
/** @var array<Item> $items */
?>


<p class="mini">#<?=$gacha->id?></p>
<h1><?=$gacha->title?></h1>

<div class="line"></div>

<div>


    <h2>Items</h2>

    <div>
        <?php
        foreach ($items as $it)
        {
            echo $it->getPreviewInGacha();
        }
        ?>
    </div>
    <a href="index.php?bro=gacha&action=addItem&id=<?=$gacha->id?>">+ Add item</a>

</div>

<div class="line"></div>

<div>
<?=$gacha->owner->getPreview()?>

</div>
