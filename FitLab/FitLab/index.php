<?php
require 'lib/functions.php';
require 'templates/header.php';

echo "<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap' rel='stylesheet'>";

// Hero Section with Call-to-Action
echo "<div style='text-align: center; padding: 50px 20px; background: linear-gradient(to right, #007bff, #00c6ff); color: white;'>";
echo "<h1 style='font-family: Poppins, sans-serif; font-size: 48px; letter-spacing: 2px;'>Welcome To Our Store</h1>";
echo "<p style='font-size: 20px; max-width: 600px; margin: 20px auto;'>Supplements & Apparel for Your Fitness Journey</p>";
echo "<a href='products.php'><button style='background: white; color: #007bff; padding: 15px 25px; border: none; border-radius: 5px; font-size: 18px; cursor: pointer;'>Shop Now</button></a>";
echo "</div>";


// Logo Section
echo "<div style='text-align: center; margin-top: 30px;'>";
echo "<img src='/products%20images/favicon.png' alt='logo Image' style='max-width: 15%; height: auto;'>";
echo "<p style='font-size: 20px; max-width: 600px; margin: 20px auto;'>Popular Supplements & Apparel</p>";
echo "</div>";

// Product Section Layout
echo "<div style='display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin-left: auto; margin-right: auto;'>";

$products = [
    ["products images/Choco Mint whey.png", "Choco Mint Whey Protein Powder", "20.99"],
    ["products images/ChocolateVegan.png", "Chocolate Flavour Vegan Protein Powder", "18.99"],
    ["products images/Cinnamon Biscoff Whey.png", "Cinnamon Biscoff Whey Protein Powder", "20.99"],
    ["products images/protein powder.jpg", "Protein Powder", "17.99"],
    ["products images/clearwhey.jpg", "Clear Whey Cranberry & Raspberry", "19.99"],
    ["products images/mass gainer.jpg", "Serious Mass Gainer", "21.99"],
    ["products images/apple.jpg", "Clear Whey Apple", "19.99"],
    ["products images/clearwhey watermelon.jpg", "Clear Whey Watermelon", "19.99"],
    ["products images/clearwhey plum.jpg", "Clear Whey Plum", "19.99"],
    ["products images/creatine.jpg", "Creatine Monohydrate", "16.99"],
    ["products images/strawmass.jpg", "Strawberry Mass Gainer", "23.99"],
    ["products images/preworkout.jpg", "Gold Pre-Workout", "13.99"],

    // Clothing
    ["clothing images/blackhoodiemens.jpg", "Black Hoodie - Mens", "34.99"],
    ["clothing images/whitetshirtmens.jpg", "White T-Shirt - Mens", "3.99"],
    ["clothing images/navyshortsmens.png", "Navy Shorts - Mens", "8.99"],

    ["clothing images/blackleggingswomans.jpg", "Black Leggings - Womans", "20.99"],
    ["clothing images/pinksports.jpg", "Pink Sports Bra - Womans", "6.99"],
    ["clothing images/whitejoggers.jpg", "White Joggers - Womans", "20.99"]
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

// Footer Section
require 'templates/footer.php';

?>