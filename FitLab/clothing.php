<?php
// Include helper functions (if any are defined in functions.php)
require 'lib/functions.php';

// Include the common header template (e.g. navigation bar, site layout)
require 'templates/header.php';

// Connect to the database
require_once 'src/db_connect.php';
?>

<!-- Section title and short description -->
<div class="product-page-header">
    <h1>Products</h1>
    <p>Explore our range of amazing products.</p>
</div>

<!-- Container that holds all product cards in a grid layout -->
<div class="product-grid">
    <?php
    // Prepare SQL query to select only products from the 'clothing' category
    $stmt = $connection->prepare("SELECT * FROM Products WHERE category = 'clothing'");
    $stmt->execute();

    // Fetch all matching products as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through each product and display it
    foreach ($products as $product): ?>
        <div class="product-card">
            <!-- Display product image -->
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="product-image">

            <!-- Display product name -->
            <h3><?= $product['name'] ?></h3>

            <!-- Display product price -->
            <p class="product-price">$<?= $product['price'] ?></p>

            <!-- Display stock quantity -->
            <p>Stock: <?= $product['stock_quantity'] ?></p>

            <!-- Add to cart button with product data passed via GET parameters -->
            <a href="add_to_cart.php?image=<?= $product['image'] ?>&name=<?= $product['name'] ?>&price=<?= $product['price'] ?>">
                <button class="btn-add-to-cart">Add to Cart</button>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<!-- Include the common footer -->
<?php require 'templates/footer.php'; ?>