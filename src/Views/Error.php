<?php

/** 
 * @var string $message;
 * @var int $code;
 * @var string $redirect;
 * */

if (!isset($code) || !isset($message))
{
    $name = "Unknown error";
    $code = 0;
}

?>

<h1>Error <?=$code?></h1>
<p class="error"><?=$message?></p>
<a href="index.php?action=home"><- Home</a>
<?=$redirect?>
