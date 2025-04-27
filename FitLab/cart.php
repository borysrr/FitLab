<?php
session_start();
require 'lib/functions.php';
require 'templates/header.php';

echo "<h1 style='text-align: center;'>Shopping Cart</h1>";

if (!empty($_SESSION['cart'])) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 80%; margin: auto; text-align: center; border-collapse: collapse;'>";
    echo "<tr style='background: #007bff; color: white;'>
            <th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th>
          </tr>";

    $total = 0;

    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;

        echo "<tr>
                <td><img src='{$item['image']}' style='width: 50px; height: auto;'></td>
                <td>{$item['name']}</td>
                <td>\${$item['price']}</td>
                <td>{$item['quantity']}</td>
                <td>$" . number_format($subtotal, 2) . "</td>
                <td><a href='remove_from_cart.php?name={$item['name']}' style='color: red;'>Remove</a></td>
              </tr>";
    }

    echo "</table>";

    echo "<div style='display: flex; justify-content: space-between; align-items: center; width: 80%; margin: 20px auto;'>
            <h2>Total: \$" . number_format($total, 2) . "</h2>
            <a href='clear_cart.php'>
                <button style='background: red; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Clear Cart</button>
            </a>
          </div>";

    echo "<div style='text-align: center; margin-top: 20px;'>
            <a href='products.php'>
                <button style='background: #28a745; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;'>Back to Products</button>
            </a>
          </div>";

    echo "<div style='text-align: center; margin-top: 40px;'>
            <form action='checkout.php' method='POST' style='display: inline;'>
                <button type='submit' style='background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;'>Proceed to Checkout</button>
            </form>
          </div>";
} else {
    echo "<p style='text-align: center; font-size: 18px;'>Your cart is empty.</p>";
}

require 'templates/footer.php';
?>