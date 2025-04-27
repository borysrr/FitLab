<?php
require 'lib/functions.php';

// Ensure required parameters are provided
if (isset($_GET['image'], $_GET['name'], $_GET['price'])) {
    addToCart($_GET['image'], $_GET['name'], $_GET['price']);
}

// Redirect to cart page
header("Location: cart.php");
exit;
?>