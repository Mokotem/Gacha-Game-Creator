<?php use GachaGameCreator\Modele\Data\Item;

/**
   * @var array<\GachaGameCreator\Modele\Data\Source> $sources;
   * @var \GachaGameCreator\Modele\Data\Gacha $gacha;
   * @var Item $item;
   * @var bool $confirm;
   * @var string $errorMessage;
   */
?>

<p class="fat">Add an item to
    <a href="index.php?bro=gacha&action=front&id=<?=$gacha->id?>">
        <?=$gacha->title?></a></p>

<div class="line"></div>

<script src="scripts/lib.js"></script>
<script src="scripts/checkItemForm.js"></script>

<form class="main" name="form1" method="post" action="index.php?bro=gacha&action=<?= $confirm ? 'uploadItem' : 'confirmItem' ?>" onsubmit="return Check()">
    <div>
        <label for="name">item name:</label>
        <input required id="name" name="name" type="text" maxlength="32" value="<?=$item->name?>"/>
        <p class="error" id="nameError"></p>
    </div>

    <div class="flat">
        <div>
            <label for="sour">source:</label>
            <select <?= $confirm ? "readonly disabled" : "" ?> name="idSource" id="sour">
                <?php
                foreach ($sources as $s)
                {
                    if ((isset($item) && $item->source->id == $s->id) || (!isset($item) && $s->id == 1))
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
            <label for="imageId" >ID:</label>
            <input required <?= $confirm ? "readonly disabled" : "" ?> id="imageId" name="idImage" type="text" value="<?=$item->imageId?>"/>
        </div>
        <a class="mini" target="_blank" href="index.php?bro=about&action=sources">about sources</a>
    </div>

    <input hidden type="number" name="idGacha" value="<?=$gacha->id?>"/>
    <input hidden type="number" name="rarity" value="1"/>
    <input hidden type="text" name="urlSmall" value=""/>
    <input hidden type="text" name="urlFull" value=""/>
    <input hidden type="text" name="character" value=""/>


    <p id="loadError" class="error">
        <?= $errorMessage?>
    </p>

    <div>
        <?php
        if ($confirm)
        {
            require(__DIR__ . "/confirmItem.php");
        }
        else
        {
            echo "<button id='subid' class='yellow' type='submit'>Load</button>";
            echo "<p id='loadid' hidden>loading ...</p>";
        }
        ?>
    </div>
</form>
