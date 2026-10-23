<?php

use GachaGameCreator\Service\Errors\GGCError;

/**
 * @var GGCError $error;
 * @var string $redirect;
 * @var PDOException $pdo:
 * */

?>

<h1 class="error">Error</h1>

<div class="duo">
    <div>
        <h2>
            <?=$error->name?>
        </h2>
        <p>
            <?=$error->message?>
        </p>
    </div>
    <div style="text-align: center">
        <div>
            <img src="<?=$error->img?>"/>
        </div>
        <a href="<?=$error->source?>" target="_blank">@futabadoodles <img src="content/externalb.png"/></a>
    </div>
</div>
<a class="fat" href="index.php?action=home"><- Home</a>
<br />
<?=$redirect?>

<?php
if (isset($pdo))
{
    echo "<div class='line'></div>";
    echo "<h2>".$pdo->getCode()." <span class='grayText'>#".$pdo->errorInfo[1]."</span></h2>";
    echo "<p class='discret'>".$pdo->getMessage()."</p>";
}
?>
