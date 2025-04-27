<?php
require 'lib/functions.php';
?>
<?php require 'templates/header.php'; ?>

<?php
echo "<div style='text-align: center; margin-top: 50px;'>";
echo "<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap' rel='stylesheet'>";
echo "<h1 style='font-family: Poppins, sans-serif; color: dodgerblue; text-shadow: 3px 3px 6px rgba(0,0,0,0.3); font-size: 48px; letter-spacing: 2px;'>Clothing</h1>";
echo "<p>Find the best apparel for fitness and style.</p>";

// Layout
echo "<div style='display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin-left: auto; margin-right: auto;'>";
echo "<div class='clothing-container'>";

$products = [
    // Mens Clothing
    ["clothing images/blackhoodiemens.jpg", "Black Hoodie - Mens", "34.99"],
    ["clothing images/blackjoggersmens.jpg", "Black Joggers - Mens", "14.99"],
    ["clothing images/blacktshirtmens.png", "Black T-Shirt - Mens", "5.99"],
    ["clothing images/blackshortsmens.jpg", "Black Shorts - Mens", "9.99"],
    ["clothing images/whitehoodiemen.jpg", "White Hoodie - Mens", "33.99"],
    ["clothing images/whitejoggermens.jpg", "White Joggers - Mens", "14.99"],
    ["clothing images/whitetshirtmens.jpg", "White T-Shirt - Mens", "3.99"],
    ["clothing images/whiteshortsmen.jpg", "White Shorts - Mens", "8.99"],
    ["clothing images/navyhoodiemens.jpg", "Navy Hoodie - Mens", "34.99"],
    ["clothing images/navyjoggersmens.jpg", "Navy Joggers - Mens", "12.99"],
    ["clothing images/navytshirtmens.jpg", "Navy T-Shirt - Mens", "3.99"],
    ["clothing images/navyshortsmens.png", "Navy Shorts - Mens", "8.99"],

    // Womans Clothing
    ["clothing images/blackhoodiewomans.jpg", "Black Hoodie - Womans", "30.99"],
    ["clothing images/blackleggingswomans.jpg", "Black Leggings - Womans", "20.99"],
    ["clothing images/blacksportswomans.jpg", "Black Sports Bra - Womans", "7.99"],
    ["clothing images/blackjoggers.jpg", "Black Joggers - Womans", "22.99"],
    ["clothing images/whitehoodie.jpg", "White Hoodie - Womans", "31.99"],
    ["clothing images/whiteleggings.jpg", "White Leggings - Womans", "21.99"],
    ["clothing images/whitesports.jpg", "White Sports Bra - Womans", "7.99"],
    ["clothing images/whitejoggers.jpg", "White Joggers - Womans", "20.99"],
    ["clothing images/pinkhoodie.jpg", "Pink Hoodie - Womans", "29.99"],
    ["clothing images/pinkleggings.jpg", "Pink Leggings - Womans", "18.99"],
    ["clothing images/pinksports.jpg", "Pink Sports Bra - Womans", "6.99"],
    ["clothing images/pinkjoggers.jpg", "Pink Joggers - Womans", "20.99"],
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