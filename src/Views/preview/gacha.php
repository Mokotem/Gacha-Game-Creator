<?php

Use GachaGameCreator\Modele\Data\Gacha;
Use GachaGameCreator\Modele\Data\Item;

/**
 * @var Gacha $gacha
 * @var bool $credits
 * @var bool $visibility
 */
?>

<div class="box">
    <div class="flat">
        <a href="index.php?bro=gacha&action=front&id=<?=$gacha->id?>"><?=$gacha->title?></a>
        <?php
        if ($credits)
        {
            echo $gacha->owner->credits();
        }
        ?>
        <?=
        $visibility ?
        $gacha->visibility > 9 ? "<p class='valid'>public</p>" : "<p class='construction'>in construction</p>"
            : ""
        ?>
    </div>
    <div class="horizontalScroll">
        <?php
        foreach ($gacha->items as $i)
        {
            echo $i->preview();
        }
        ?>
    </div>
</div>
