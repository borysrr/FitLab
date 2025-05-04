<?php
// Include necessary files for functions, header, and database connection
require 'lib/functions.php';
require 'templates/header.php';
require_once 'src/db_connect.php';
?>

<!-- Section for the product page header -->
<div class="product-page-header">
    <h1>Products</h1>
    <p>Explore our range of amazing products.</p>
</div>

<!-- Grid for displaying the products -->
<div class="product-grid">
    <?php
    // Prepare the SQL query to select all products that belong to the 'supplement' category from the Products table
    $stmt = $connection->prepare("SELECT * FROM Products WHERE category = 'supplement'");

    // Execute the SQL query
    $stmt->execute();

    // Fetch all the results as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through each product in the fetched results and display it
    foreach ($products as $product): ?>
        <!-- Display each product in a card layout -->
        <div class="product-card">
            <!-- Show the product image -->
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="product-image">

            <!-- Show the product name -->
            <h3><?= $product['name'] ?></h3>

            <!-- Show the product price -->
            <p class="product-price">$<?= $product['price'] ?></p>

            <!-- Show the stock quantity of the product -->
            <p>Stock: <?= $product['stock_quantity'] ?></p>

            <!-- Link to add the product to the cart with its details passed as URL parameters -->
            <a href="add_to_cart.php?image=<?= $product['image'] ?>&name=<?= $product['name'] ?>&price=<?= $product['price'] ?>">
                <!-- Button to add the product to the cart -->
                <button class="btn-add-to-cart">Add to Cart</button>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<!-- Include the footer template -->
<?php require 'templates/footer.php'; ?>