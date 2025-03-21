<?php
session_start(); // Start the session to access cart data
require 'lib/functions.php';
require 'templates/header.php';

echo "<h1 style='text-align: center;'>Shopping Cart</h1>";

if (!empty($_SESSION['cart'])) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 80%; margin: auto; text-align: center; border-collapse: collapse;'>";
    echo "<tr style='background: #007bff; color: white;'><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr>";

    $total = 0; // Initialize total price

    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;

        echo "<tr>";
        echo "<td><img src='{$item['image']}' style='width: 50px; height: auto;'></td>";
        echo "<td>{$item['name']}</td>";
        echo "<td>\${$item['price']}</td>";
        echo "<td>{$item['quantity']}</td>";
        echo "<td>\$" . number_format($subtotal, 2) . "</td>";
        echo "<td><a href='remove_from_cart.php?name={$item['name']}' style='color: red;'>Remove</a></td>";
        echo "</tr>";
    }

    echo "</table>";

    // Total price and clear cart button aligned using flexbox
    echo "<div style='display: flex; justify-content: space-between; align-items: center; width: 80%; margin: 20px auto;'>";
    echo "<h2>Total: \$" . number_format($total, 2) . "</h2>";
    echo "<a href='clear_cart.php'><button style='background: red; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Clear Cart</button></a>";
    echo "</div>";

    // Checkout Button (without the box)
    echo "<div style='text-align: center; margin-top: 20px;'>";
    echo "<form action='checkout.php' method='POST' style='display: inline;'>";
    echo "<button type='submit' style='background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;'>Proceed to Checkout</button>";
    echo "</form>";
    echo "</div>";

} else {
    echo "<p style='text-align: center; font-size: 18px;'>Your cart is empty.</p>";
}

?>