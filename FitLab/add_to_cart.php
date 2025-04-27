<?php
require 'lib/functions.php';

if (!empty($_GET['image']) && !empty($_GET['name']) && !empty($_GET['price'])) {
    addToCart($_GET['image'], $_GET['name'], $_GET['price']);
}

header("Location: cart.php");
exit;
?>