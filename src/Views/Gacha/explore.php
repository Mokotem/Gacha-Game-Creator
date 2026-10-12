
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

/** @var array $values */
/** @var \GachaGameCreator\Modele\Data\Gacha $gacha */

foreach ($values as $gacha)
{
    echo "<div class='blockline'>";

    echo "<div>";
    echo "<a href='index.php?bro=gacha&action=select&id=".$gacha->id."'>".$gacha->title."</a>";
    echo "<p class='money'>".$gacha->pullPrice."po</p>";
    echo "</div>";

    echo "<div>";
    echo "<p class='mini'>by</p><a class='mini' href=index.php?bro=account&id=".$gacha->owner->id.">".$gacha->owner->name."</a>";
    echo "</div>";

    echo "</div>";
}

?>



