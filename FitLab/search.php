<?php
require 'lib/functions.php';
?>

<?php require 'layout/header.php'; ?>

<div style="text-align: center; margin-top: 50px;">
    <h2 style="color: dodgerblue;">Search Products</h2>

    <!-- Search Form -->
    <form method="GET" action="search.php" style="margin-top: 20px;">
        <input type="text" name="query" placeholder="Search by product name" style="padding: 10px; width: 300px;">
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Search</button>
    </form>

    <div style="margin-top: 30px;">

        <?php
        // Product List
        $products = [
            ["images/Choco Mint whey.png", "Choco Mint Whey Protein Powder", "$20.99"],
            ["images/ChocolateVegan.png", "Chocolate Flavour Vegan Protein Powder", "$18.99"],
            ["images/Cinnamon Biscoff Whey.png", "Cinnamon Biscoff Whey Protein Powder", "$20.99"]
        ];

        // Get the search query from the URL
        $query = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

        // If there's a search query, filter the products
        if ($query) {
            $filteredProducts = array_filter($products, function ($product) use ($query) {
                return strpos(strtolower($product[1]), $query) !== false; // Case insensitive search
            });
        } else {
            $filteredProducts = $products; // Show all products if no query is entered
        }

        // Display the products
        if (count($filteredProducts) > 0) {
            echo "<div style='display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; padding: 20px; max-width: 1200px; margin-left: auto; margin-right: auto;'>";

            foreach ($filteredProducts as $product) {
                echo "<div style='flex: 1 1 300px; text-align: center; background: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);'>";
                echo "<img src='{$product[0]}' alt='{$product[1]}' style='width: 100%; max-width: 250px; height: auto; border-radius: 10px;'>";
                echo "<h3 style='margin-top: 15px; color: #333;'>{$product[1]}</h3>";
                echo "<p style='font-weight: bold; color: #007bff;'>{$product[2]}</p>";
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

<?php require 'layout/footer.php'; ?>