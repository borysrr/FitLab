<?php
// Include the functions file where the addToCart function is defined
require 'lib/functions.php';

// Check if the 'image', 'name', and 'price' are passed as query parameters in the URL
if (!empty($_GET['image']) && !empty($_GET['name']) && !empty($_GET['price'])) {
    // Call the addToCart function to add the product to the shopping cart
    addToCart($_GET['image'], $_GET['name'], $_GET['price']);
}

// Redirect the user to the cart page after adding the item
header("Location: cart.php");
exit;
?>