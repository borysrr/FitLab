<?php
// Start the session to manage user data, especially user login status
session_start();

// Include the common functions file
require "common.php";

// Ensure the user is logged in before proceeding with order creation
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, show an error message and exit
    echo "You must be logged in to place an order.";
    exit;
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    try {
        // Include the database connection file to interact with the database
        require_once 'src/db_connect.php';

        // Get the user ID from the session to link the order to the logged-in user
        $user_id = $_SESSION['user_id'];

        // Prepare the data for the new order
        $new_order = [
            "order_ID" => uniqid(), // Generate a unique order ID
            "total_cost" => escape($_POST['total_cost']), // Sanitize and get the total cost from the form input
            "order_date" => date("Y-m-d H:i:s"), // Get the current date and time for the order
            "Users_user_ID" => $user_id // Link the order to the logged-in user by their ID
        ];

        // SQL query to insert the new order into the Orders table
        $sql = "INSERT INTO Orders (order_ID, total_cost, order_date, Users_user_ID) VALUES (:order_ID, :total_cost, :order_date, :Users_user_ID)";
        // Prepare the SQL query for execution
        $statement = $connection->prepare($sql);
        // Execute the query with the new order data
        $statement->execute($new_order);

        // Get the last inserted order ID
        $order_ID = $connection->lastInsertId();

        // Check if there are any items in the session cart
        if (!empty($_SESSION['cart'])) {
            // Loop through each product in the cart
            foreach ($_SESSION['cart'] as $product) {
                // Prepare the data to insert each product into the Products table
                $new_product = [
                    "name" => $product['name'],
                    "description" => $product['description'],
                    "price" => $product['price'],
                    "stock_quantity" => $product['stock_quantity'],
                    "Orders_order_ID" => $order_ID // Link the product to the new order
                ];

                // SQL query to insert each product into the Products table
                $product_sql = "INSERT INTO Products (name, description, price, stock_quantity, Orders_order_ID) VALUES (:name, :description, :price, :stock_quantity, :Orders_order_ID)";
                // Prepare the SQL query for execution
                $product_statement = $connection->prepare($product_sql);
                // Execute the query with the product data
                $product_statement->execute($new_product);
            }
        }

        // Display a success message after the order is successfully created
        echo "Order successfully added!";
    } catch (PDOException $error) {
        // If there is a database error, display the error message
        echo "Error: " . $error->getMessage();
    }
}

// Include the header template to display the page header
require "templates/header.php";
?>

<!-- HTML form to create a new order -->
<h2>Add an Order</h2>
<form method="post">
    <!-- Input field for the total cost of the order -->
    <label for="total_cost">Total Cost</label>
    <input type="text" name="total_cost" id="total_cost" required> <!-- Required field for total cost -->

    <!-- Submit button to submit the form -->
    <input type="submit" name="submit" value="Submit">
</form>

<!-- Link to navigate back to the home page -->
<a href="index.php">Back to home</a>

<?php
// Include the footer template (e.g., for consistent footer design)
include "templates/footer.php";
?>