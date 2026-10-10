<?php

/** 
 * @var string $errorMessage;
 * @var int $code;
 * @var string $redirect;
 * */

if (!isset($code) || !isset($errorMessage))
{
    $name = "Unknown error";
    $code = "GGC0";
}

?>

<h1>Error <?=$code?></h1>
<div class="line"></div>
<p class="error"><?= $errorMessage?></p>
<br />
<?=$redirect?>
<br />
<a href="index.php?action=home"><- Home</a>
