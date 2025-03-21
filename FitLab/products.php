<?php
require 'lib/functions.php';
require 'templates/header.php';

echo "<div style='text-align: center; margin-top: 50px;'>";
echo "<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap' rel='stylesheet'>";
echo "<h1 style='font-family: Poppins, sans-serif; color: dodgerblue; text-shadow: 3px 3px 6px rgba(0,0,0,0.3); font-size: 48px; letter-spacing: 2px;'>Products</h1>";
echo "<p>Explore our range of amazing products.</p>";

// Product Section Layout
echo "<div style='display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin-left: auto; margin-right: auto;'>";

$products = [
    ["products images/Choco Mint whey.png", "Choco Mint Whey Protein Powder", "20.99"],
    ["products images/ChocolateVegan.png", "Chocolate Flavour Vegan Protein Powder", "18.99"],
    ["products images/Vanilla Vegan.png", "Vanilla Vegan Protein Powder", "18.99"],
    ["products images/proteinworks.jpg", "ProteinWorks Vegan Protein Chocolate Silk", "17.50"],
    ["products images/vegaprotein.jpg", "VEGA Vegan Protein & Green Chocolate", "19.50"],
    ["products images/strawmass.jpg", "Strawberry Mass Gainer", "23.99"],
    ["products images/Cinnamon Biscoff Whey.png", "Cinnamon Biscoff Whey Protein Powder", "20.99"],
    ["products images/Strawberry Vegan.png", "Strawberry Vegan Protein Powder", "18.99"],
    ["products images/COOKIES AND Cream Whey.png", "Cookies and Cream Whey Protein Powder", "20.99"],
    ["products images/protein powder.jpg", "Protein Powder", "17.99"],
    ["products images/mass gainer.jpg", "Serious Mass Gainer", "21.99"],
    ["products images/clearwhey.jpg", "Clear Whey Cranberry & Raspberry", "19.99"],
    ["products images/apple.jpg", "Creatine Whey Apple", "19.99"],
    ["products images/clearwhey watermelon.jpg", "Clear Whey Watermelon", "19.99"],
    ["products images/clearwhey plum.jpg", "Clear Whey Plum", "19.99"],
    ["products images/peaprotein.png", "Vegan Pea Protein Vannila", "17.50"],
    ["products images/milkprotein.jpg", "Milk Protein Powder", "16.99"],
    ["products images/creatine.jpg", "Creatine Monhydrate", "16.99"],
    ["products images/creatinepills.jpg", "Creatine Pills", "19.99"],
    ["products images/pre.jpg", "Pre-Workout", "13.99"],
    ["products images/preworkout.jpg", "Gold Pre-Workout", "13.99"]
];

foreach ($products as $product) {
    echo "<div style='flex: 1 1 300px; text-align: center; background: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);'>";
    echo "<img src='{$product[0]}' alt='{$product[1]}' style='width: 100%; max-width: 250px; height: auto; border-radius: 10px;'>";
    echo "<h3 style='margin-top: 15px; color: #333;'>{$product[1]}</h3>";
    echo "<p style='font-weight: bold; color: #007bff;'>\${$product[2]}</p>";
    echo "<a href='add_to_cart.php?image={$product[0]}&name={$product[1]}&price={$product[2]}'>";
    echo "<button style='background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;'>Add to Cart</button>";
    echo "</a>";
    echo "</div>";
}

echo "</div>";

require 'templates/footer.php';
?>