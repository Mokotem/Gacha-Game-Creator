<?php

/** 
 * @var string $message;
 * @var int $code;
 * @var string $redirect;
 * */

if (!isset($code) || !isset($message))
{
    $name = "Unknown error";
    $code = "GGC0";
}

?>

<h1>Error <?=$code?></h1>
<p class="error"><?=$message?></p>
<br />
<?=$redirect?>
<br />
<a href="index.php?action=home"><- Home</a>
