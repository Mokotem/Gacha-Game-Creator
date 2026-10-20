
<?php
use GachaGameCreator\Modele\Session;
 ?>

<nav>
    <div>
        <a href="index.php?bro=home">Home</a>
        <a href="index.php?bro=gacha&action=create">Create</a>
        <a href="index.php?bro=home&action=explore">Explore</a>
        <a href="index.php?bro=home&action=gachas">Gachas</a>
        <a href="index.php?bro=item&action=explore">Items</a>
    </div>
    <div>
        <a href="index.php?bro=account&action=profile">Account</a>
        <?=Session::get()->active() ? money(Session::get()->money()) : ""?>
    </div>
</nav>