<?php
require 'lib/functions.php';

// Clears the cart after the button is pressed
clearCart();

// Redirects back to the cart.php and not index.php
header("Location: cart.php");
exit;
?>