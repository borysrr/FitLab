<?php
require 'lib/functions.php';
require 'templates/header.php';
?>

<div style="text-align: center; margin-top: 50px;">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <h1 style="font-family: Poppins, sans-serif; color: dodgerblue; text-shadow: 3px 3px 6px rgba(0,0,0,0.3); font-size: 48px; letter-spacing: 2px;">Search Items</h1>

    <!-- Search Form -->
    <form method="GET" action="search.php" style="margin-top: 20px;">
        <input type="text" name="query" placeholder="Search by product name" style="padding: 10px; width: 300px;">
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Search</button>
    </form>

    <div style="margin-top: 30px;">

        <?php
        // Product List
        $products = [
            ["products images/Choco Mint whey.png", "Choco Mint Whey Protein Powder", "20.99"],
            ["products images/ChocolateVegan.png", "Chocolate Flavour Vegan Protein Powder", "18.99"],
            ["products images/Vanilla Vegan.png", "Vanilla Vegan Protein Powder", "18.99"],
            ["products images/Cinnamon Biscoff Whey.png", "Cinnamon Biscoff Whey Protein Powder", "20.99"],
            ["products images/Strawberry Vegan.png", "Strawberry Vegan Protein Powder", "18.99"],
            ["products images/COOKIES AND Cream Whey.png", "Cookies and Cream Whey Protein Powder", "20.99"],
            ["products images/protein powder.jpg", "Protein Powder", "17.99"],
            ["products images/mass gainer.jpg", "Serious Mass Gainer", "21.99"],
            ["products images/clearwhey.jpg", "Clear Whey Cranberry & Raspberry", "19.99"],
            ["products images/apple.jpg", "Creatine Whey Apple", "19.99"],
            ["products images/clearwhey watermelon.jpg", "Clear Whey Watermelon", "19.99"],
            ["products images/clearwhey plum.jpg", "Clear Whey Plum", "19.99"],
            ["products images/strawmass.jpg", "Strawberry Mass Gainer", "23.99"],
            ["products images/milkprotein.jpg", "Milk Protein Powder", "16.99"],
            ["products images/creatine.jpg", "Creatine Monohydrate", "16.99"],
            ["products images/creatinepills.jpg", "Creatine Pills", "19.99"],
            ["products images/pre.jpg", "Pre-Workout", "13.99"],
            ["products images/preworkout.jpg", "Gold Pre-Workout", "13.99"],

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
            ["clothing images/pinkjoggers.jpg", "Pink Joggers - Womans", "20.99"]
        ];

        // Get search query from URL
        $query = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

        // Filter products if search query is entered
        $filteredProducts = $query
            ? array_filter($products, fn($product) => strpos(strtolower($product[1]), $query) !== false)
            : $products;

        // Display Products
        if (count($filteredProducts) > 0) {
            echo "<div style='display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin-left: auto; margin-right: auto;'>";

            foreach ($filteredProducts as $product) {
                echo "<div style='flex: 1 1 300px; text-align: center; background: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);'>";
                echo "<img src='{$product[0]}' alt='{$product[1]}' style='width: 100%; max-width: 250px; height: auto; border-radius: 10px;'>";
                echo "<h3 style='margin-top: 15px; color: #333;'>{$product[1]}</h3>";
                echo "<p style='font-weight: bold; color: #007bff;'>\${$product[2]}</p>";
                echo "<button style='background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;'>Add to Cart</button>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p style='color: red;'>No products found for your search.</p>";
        }
        ?>

    </div>
</div>

<?php require 'templates/footer.php'; ?>
