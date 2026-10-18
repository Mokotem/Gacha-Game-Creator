<?php

Use GachaGameCreator\Modele\Data\Player;
Use GachaGameCreator\Modele\Data\Gacha;
Use GachaGameCreator\Modele\Session;

/**
 * @var Player $player;
 * @var array<Gacha> $gachas;
 */
?>

<h1>
    Gachas made by <a href="index.php?bro=account&id=<?=$player->id?>"><?=$player->name?></a>
</h1>
<div class="line"></div>

<div>
    <?php
    $credits = false;
    $visibility = Session::get()->id() == $player->id;
    foreach ($gachas as $gacha)
    {
        include __DIR__."/../preview/gacha.php";
    }
    ?>
</div>
