<?php

Use GachaGameCreator\Modele\Data\Gacha;

/**
 * @var Gacha $gacha
 * @var bool $credits
 * @var bool $visibility
 */
?>

<div class="box">
    <div class="flat">
        <a href="index.php?bro=gacha&action=front&id="><?=$gacha->title?></a>
        <?php
        if ($credits)
        {
            echo $gacha->owner->credits();
        }
        ?>
        <?=
        $visibility ?
        $gacha->visibility > 0 ? "<p class='valid'>public</p>" : "<p class='error'>private</p>"
            : ""
        ?>
    </div>
    <div>

    </div>
</div>
