<?php
require 'lib/functions.php';

if (isset($_GET['name'])) {
    removeFromCart($_GET['name']);
}

header("Location: cart.php");
exit;
?>