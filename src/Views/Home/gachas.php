
<h1>
    Explore Gachas
</h1>
<div class="line"></div>
<form>
    <label for="srch">search:</label>
    <input id="srch" type="search" />
</form>
<div class="line"></div>

<?php

Use GachaGameCreator\Modele\Data\Gacha;
Use GachaGameCreator\Modele\Data\Item;

/**
 * @var array<Gacha> $gachas;
 */

$credits = true;

foreach ($gachas as $gacha)
{
    include __DIR__."/../preview/gacha.php";
}

?>



