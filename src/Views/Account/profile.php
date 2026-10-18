<?php use GachaGameCreator\Modele\Data\Player;/**
   * @var Player $player
   */

?>

<h1>
    <?=$player->name?>
</h1>

<div class="line"></div>

<nav>
    <div>
        <a href="index.php?bro=account&action=gachas&id=<?=$player->id?>">Gachas</a>
    </div>
</nav>