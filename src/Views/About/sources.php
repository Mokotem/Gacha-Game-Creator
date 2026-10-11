<?php

/**
 * @var array<\GachaGameCreator\Modele\Data\Source> $sources
 */

?>

<h1>Image sources</h1>
<p>
    When creating an item, you can choose an image from these sources:
</p>
<div>
    <?php
    foreach ($sources as $s)
    {
        echo "<div class='blockline'>
                <p>".ucfirst($s->name)."</p>
                <a href=$s->homePageUrl>".$s->homePageUrl."</a>
              </div>";
    }
    ?>
</div>
