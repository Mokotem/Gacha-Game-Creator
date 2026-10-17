<?php use GachaGameCreator\Modele\Data\Item;

/**
* @var Item $item;
*/
?>


<div>

<label for="img1">small:</label><br />
<img id="img1" src="<?= $item->urlSmall?>" />
</div>
<div>

<label for="img2">full:</label><br />
<img id="img2" src="<?= $item->urlFull?>" />
</div>
    
<div>
    <label for="sr">image source (optional):</label>
    <input class="big" placeholder="none" name="urlSource" id="sr" <?= is_null($item->urlSource) ? "" : "readonly disabled" ?> type="text"
            value="<?= $item->urlSource ?? "" ?>"/>
</div>

<input hidden name="idSource" value="<?=$item->source->id?>" />
<input hidden name="idImage" value="<?=$item->imageId?>" />

<button type="button" style="background-color:rgb(255, 0, 0)" onclick="Cancel()">
    Cancel
</button>
<button style="background-color:rgb(0, 255, 0)" type="submit">
    Confirm
</button>
