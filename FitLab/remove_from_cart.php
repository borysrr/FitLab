<?php
require 'lib/functions.php';

// Used to remove all the items in the cart
if (isset($_GET['name'])) {
    removeFromCart($_GET['name']);
}

// Redirects back to the cart.php
header("Location: cart.php");
exit;
?>