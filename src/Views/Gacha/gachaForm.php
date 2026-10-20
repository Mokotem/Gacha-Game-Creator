
<?php

use GachaGameCreator\Modele\Data\Gacha;
use GachaGameCreator\Modele\Session;

/**
 * @var Gacha $gacha
 * @var bool $editMode;
 */
?>

<script src="scripts/lib.js"></script>
<script src="scripts/checkGachaForm.js"></script>

<form class="mainForm" name="form1" method="post" action="index.php?bro=gacha&action=uploadGacha" onsubmit="return CheckGacha()">
    <div>
        <label for="title">gacha title: </label>
        <input required type="text" name="title" id="title" value="<?=$gacha->title ?? ""?>" onchange="onChange()"/>
        <p class="error" id="titleError"></p>
    </div>
    <div>
        <label for="desc">description: </label>
        <textarea id="desc" name="description" onchange="onChange()"><?=$gacha->desc ?? ""?></textarea>
        <p class="error" id="descError"></p>
    </div>
    <div>
        <label for="pull">pull price: </label>
        <input type="number" min="1" max="100" value="<?=$gacha->pullPrice ?? "10"?>" id="pull" name="pullPrice" onchange="onChange()"/>
    </div>

    <input name="mode" readonly value="<?=$editMode ? "edit" : "create"?>" hidden>
    <input name="idPlayer" readonly value="<?=Session::get()->id()?>" hidden>
    <input name="idGacha" readonly value="<?=$gacha->id ?? ""?>" hidden>

    <div>
        <button id="subGachaForm" <?=$editMode ? "disabled" : ""?> type="submit"><?=$editMode ? "Apply changes" : "Create"?></button>
    </div>
</form>