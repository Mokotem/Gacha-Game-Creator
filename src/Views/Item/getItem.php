<?php
/**
 * @var \GachaGameCreator\Modele\Data\Item $item;
 */
?>

<div>
    <h2>
        You pulled
    </h2>
    <h1>
        <?=$item->name?>
    </h1>
</div>

<div>
    <img src="<?=$item->urlFull?>"/>
</div>

<div>
    <a class="fat" href="index.php?bro=account&action=items">OK</a>
</div>
