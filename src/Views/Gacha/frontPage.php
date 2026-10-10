<?php
Use GachaGameCreator\Modele\Data\Gacha;
/** @var Gacha $gacha */
?>


<p class="mini">#<?=$gacha->id?></p>
<h1><?=$gacha->title?></h1>
<?=$gacha->owner->getCredits()?>
