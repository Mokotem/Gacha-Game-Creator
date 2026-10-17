<?php
Use GachaGameCreator\Modele\Data\Gacha;
Use GachaGameCreator\Modele\Data\Item;
/**
 * @var Gacha $gacha
 * @var array<Item> $items
 * @var array<int> $availablesIts
 * @var array<int> $availablesEfs
 * */
?>


<p class="mini">#<?=$gacha->id?></p>
<h1><?=$gacha->title?></h1>

<div class="line"></div>

<div>


    <h2>Items</h2>

    <div style="display: flex; overflow-x: scroll;">
        <?php
        foreach ($items as $it)
        {
            echo $it->getPreviewInGacha();
        }
        ?>
    </div>
    <a href="index.php?bro=gacha&action=allItems&id=<?=$gacha->id?>">Show all items</a>

    <div class="line"></div>

    <script>
        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }

        function random()
        {
            its = <?=json_encode($availablesIts)?>
            efs = <?=json_encode($availablesEfs)?>
            n = getRandomInt(its.length);
            document.getElementById("idItem").value = its[n];
            document.getElementById("idEffect").value = efs[n];
        }
    </script>

    <form action="index.php?bro=item&action=get" method="post" onsubmit="random()">
        <div style="margin: 0px auto">

        <input id="idItem" hidden/>
        <input id="idEffect" hidden/>

        <label for="subut"><?=$gacha->pullPrice?></label>
        <button id="subut" style="background-color: rgb(0, 255, 255)" type="submit">
            Pull!
        </button>
        </div>
    </form>

</div>