<?php
// Include external PHP files for functions and header
require 'lib/functions.php';
require 'templates/header.php';

// Display welcome section with store message and Shop Now button
echo "<div class='welcome-container'>";
echo "<h1>Welcome To Our Store</h1>"; // Main title of the welcome section
echo "<p>Supplements & Apparel for Your Fitness Journey</p>"; // Description under the title
echo "<a href='products.php'><button class='shop-now-button'>Shop Now</button></a>"; // Button linking to products page
echo "</div>";

// Display store logo and a heading
echo "<div class='logo-container'>";
echo "<img src='/products%20images/favicon.png' alt='logo Image' style='max-width: 15%; height: auto;'>"; // Logo image
echo "<h2>Popular Supplements & Apparel</h2>"; // Subheading for the product section
echo "</div>";

// Display product section
echo "<div class='product-section'>";

// Define the products in an array: image, name, and price
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

    // Clothing items
    ["clothing images/blackhoodiemens.jpg", "Black Hoodie - Mens", "34.99"],
    ["clothing images/whitetshirtmens.jpg", "White T-Shirt - Mens", "3.99"],
    ["clothing images/navyshortsmens.png", "Navy Shorts - Mens", "8.99"],
    ["clothing images/blackleggingswomans.jpg", "Black Leggings - Womans", "20.99"],
    ["clothing images/pinksports.jpg", "Pink Sports Bra - Womans", "6.99"],
    ["clothing images/whitejoggers.jpg", "White Joggers - Womans", "20.99"]
];

// Loop through each product to display it on the page
foreach ($products as $product) {
    echo "<div class='product-card'>"; // Start a new product card container
    echo "<img src='{$product[0]}' alt='{$product[1]}'>"; // Display product image
    echo "<h3>{$product[1]}</h3>"; // Display product name
    echo "<p>\${$product[2]}</p>"; // Display product price
    echo "<a href='add_to_cart.php?image={$product[0]}&name={$product[1]}&price={$product[2]}'>"; // Link to add product to cart
    echo "<button class='add-to-cart-button'>Add to Cart</button>"; // Add to cart button
    echo "</a>";
    echo "</div>"; // End of product card container
}
echo "</div>"; // End of product section

// Include the footer of the page
require 'templates/footer.php';
?>