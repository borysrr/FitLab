<?php
require 'lib/functions.php';
?>
<?php require 'layout/header.php'; ?>

<?php

// Slide Show Section
echo "<div style='text-align: center; margin-top: 50px; position: relative;'>";
echo "<h2 style='color: dodgerblue;'>Welcome To</h2>";

// Logo Section
echo "<div style='text-align: center; margin-top: 50px;'>";
echo "<img src='/images/fitlab.png' alt='logo Image' style='max-width: 20%; height: auto; margin-top: 20px;'>";
echo "</div>";

// Product Section Layout
echo "<div style='display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin-left: auto; margin-right: auto;'>";

    $products = [
    ["images/Choco Mint whey.png", "Choco Mint Whey Protein Powder", "$20.99"],
    ["images/ChocolateVegan.png", "Chocolate Flavour Vegan Protein Powder", "$18.99"],
    ["images/Cinnamon Biscoff Whey.png", "Ciannamon Biscoff Whey Protein Powder", "$20.99"]
];

foreach ($products as $product) {
    echo "<div style='flex: 1 1 300px; text-align: center; background: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);'>";
    echo "<img src='{$product[0]}' alt='{$product[1]}' style='width: 100%; max-width: 250px; height: auto; border-radius: 10px;'>";
    echo "<h3 style='margin-top: 15px; color: #333;'>{$product[1]}</h3>";
    echo "<p style='font-weight: bold; color: #007bff;'>{$product[2]}</p>";
    echo "<button style='background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;'>Add to Cart</button>";
    echo "</div>";
}

echo "</div>";
?>

<?php require 'layout/footer.php'; ?>
