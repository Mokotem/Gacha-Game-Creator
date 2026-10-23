<?php

use GachaGameCreator\Service\Errors\GGCError;

/**
 * @var PDOException $pdo :
 * @var string $redirect
 * */

?>

<h1 class="error">Error</h1>
<h2><?=$pdo->getCode()?> <p class="gray"><?=$pdo->errorInfo[1]?></p></h2>
<p class="discret"><?=$pdo->getMessage()?></p>
<div class="line"></div>
<a href="index.php?action=home"><- Home</a>
<br />
<?=$redirect?>

