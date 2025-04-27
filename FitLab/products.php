<?php

require 'lib/functions.php';
require 'templates/header.php';
require_once 'src/db_connect.php';

echo "<div style='text-align: center; margin-top: 50px;'>";
echo "<h1 style='font-family: Poppins, sans-serif; color: dodgerblue; font-size: 48px;'>Products</h1>";
echo "<p>Explore our range of amazing products.</p>";
echo "<div style='display: flex; justify-content: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin: auto;'>";

$stmt = $connection->prepare("SELECT * FROM Products WHERE category = 'supplement'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "<div style='flex: 1 1 300px; background: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;'>";
    echo "<img src='{$product['image']}' alt='{$product['name']}' style='width: 100%; max-width: 250px; border-radius: 10px;'>";
    echo "<h3>{$product['name']}</h3>";
    echo "<p style='color: #007bff; font-weight: bold;'>£{$product['price']}</p>";
    echo "<p>Stock: {$product['stock_quantity']}</p>";
    echo "<a href='add_to_cart.php?image={$product['image']}&name={$product['name']}&price={$product['price']}'>";
    echo "<button style='background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Add to Cart</button>";
    echo "</a>";
    echo "</div>";
}

echo "</div>";
require 'templates/footer.php';
?>