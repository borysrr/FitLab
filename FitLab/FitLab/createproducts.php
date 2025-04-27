<?php
session_start();
require "common.php";

if (isset($_POST['submit'])) {
    try {
        require_once 'src/db_connect.php';

        // Check if user is logged in, assuming user ID is stored in session
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            echo "You must be logged in to place an order.";
            exit;
        }

        // Prepare order data
        $new_order = array(
            "order_ID" => uniqid(), // Generates a unique order ID
            "total_cost" => escape($_POST['total_cost']),
            "order_date" => date("Y-m-d H:i:s"), // Current timestamp
            "Users_user_ID" => $user_id // Using the session user ID
        );

        // Prepare SQL query for inserting the order
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "Orders",
            implode(", ", array_keys($new_order)),
            ":" . implode(", :", array_keys($new_order))
        );

        // Execute the order insert query
        $statement = $connection->prepare($sql);
        $statement->execute($new_order);

        // Get the order ID
        $order_ID = $connection->lastInsertId(); // Get the last inserted order ID

        // Assuming you have a cart system, let's say the cart data is in $_SESSION['cart']
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $product) {
                // For each product in the cart, insert it into the Products table
                $new_product = array(
                    "name" => $product['name'], // Product name
                    "description" => $product['description'], // Product description
                    "price" => $product['price'], // Product price
                    "stock_quantity" => $product['stock_quantity'], // Stock quantity (randomly generated or from cart)
                    "Orders_order_ID" => $order_ID // Link the product to the order
                );

                // Prepare the insert SQL query for products
                $product_sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "Products",
                    implode(", ", array_keys($new_product)),
                    ":" . implode(", :", array_keys($new_product))
                );

                // Insert each product into the database
                $product_statement = $connection->prepare($product_sql);
                $product_statement->execute($new_product);
            }
        }

        // Success message
        echo "Order successfully added!";

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

require "templates/header.php";
?>

<h2>Add an Order</h2>
<form method="post">
    <label for="total_cost">Total Cost</label>
    <input type="text" name="total_cost" id="total_cost" required>

    <!-- Removed manual User ID input field. It will now use the logged-in user's ID -->
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>