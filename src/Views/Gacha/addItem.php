<?php
/**
 * @var array<\GachaGameCreator\Modele\Data\Source> $sources;
 * @var \GachaGameCreator\Modele\Data\Gacha $gacha;
 */
?>

<p class="fat">Add an item to
    <a href="index.php?bro=gacha&action=select&id=<?=$gacha->id?>">
        <?=$gacha->title?></a></p>

<div class="line"></div>

<form class="mainForm" name="form1" method="post" action="index.php?bro=gacha&action=addItem" on>
    <div>
        <label for="name">item name:</label>
        <input required id="name" name="name" type="text" minlength="4" maxlength="24"/>
        <p class="error" id="nameError"></p>
    </div>

    <div class="flat">
        <div>
            <label for="sour">source:</label>
            <select name="idSource" id="sour">
                <?php
                foreach ($sources as $s)
                {
                    if ($s->id == 1)
                    {
                        echo "<option value=$s->id selected>$s->name</option>";
                    }
                    else
                    {
                        echo "<option value=$s->id>$s->name</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div>
            <label for="imageId">ID:</label>
            <input required id="imageId" name="idImage" type="text"/>
        </div>
        <a class="mini" target="_blank" href="index.php?bro=about&action=sources">about sources</a>
    </div>

    <input hidden type="number" name="idGacha" value="<?=$gacha->id?>"/>
    <input hidden type="number" name="rarity" value="1"/>
    <input hidden type="text" name="urlSmall" value=""/>
    <input hidden type="text" name="urlFull" value=""/>
    <input hidden type="text" name="urlSource" value=""/>
    <input hidden type="text" name="character" value=""/>

    <div>
        <button type="submit">Add</button>
    </div>
</form>
