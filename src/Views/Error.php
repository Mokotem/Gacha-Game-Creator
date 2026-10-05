<?php

/** 
 * @var string $message;
 * @var int $code;
 * */

if (!isset($code) || !isset($message))
{
    $name = "Unknown error";
    $code = 0;
}

?>

<h1>Error <?=$code?></h1>
<p><?=$message?></p>
<a href="index.php?action=home"><- Home</a>