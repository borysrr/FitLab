<?php
// Start the session to manage user data and authentication
session_start();

// Include common functions
require "common.php";

// Include the session handler for custom session management
require_once 'session_handler.php';
$session = new SessionHandlerCustom();

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect them to the login page and pass the current page as the redirect destination
    header("Location: login.php?redirect=createorders.php");
    exit();
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    try {
        // Include the database connection file
        require_once 'src/db_connect.php';

        // Get the logged-in user ID from session
        $user_id = $_SESSION['user_id'];

        // Prepare the data for the new order
        $new_order = [
            "order_ID" => uniqid(), // Generate a unique order ID
            "total_cost" => escape($_POST['total_cost']), // Sanitize total cost input
            "order_date" => date("Y-m-d H:i:s"), // Capture current date and time for the order
            "Users_user_ID" => $user_id // Link the order to the logged-in user ID
        ];

        // SQL query to insert the order into the 'Orders' table
        $sql = "INSERT INTO Orders (order_ID, total_cost, order_date, Users_user_ID) VALUES (:order_ID, :total_cost, :order_date, :Users_user_ID)";
        $statement = $connection->prepare($sql); // Prepare the query
        $statement->execute($new_order); // Execute the query with the provided data

        // Get the order ID of the last inserted order
        $order_ID = $connection->lastInsertId();

        // Check if there are items in the user's cart
        if (!empty($_SESSION['cart'])) {
            // Loop through each product in the cart
            foreach ($_SESSION['cart'] as $product) {
                // Prepare the data for inserting each product into the 'Products' table
                $new_product = [
                    "name" => $product['name'],
                    "description" => $product['description'],
                    "price" => $product['price'],
                    "stock_quantity" => $product['stock_quantity'],
                    "Orders_order_ID" => $order_ID // Associate the product with the new order
                ];

                // SQL query to insert the product into the 'Products' table
                $product_sql = "INSERT INTO Products (name, description, price, stock_quantity, Orders_order_ID) VALUES (:name, :description, :price, :stock_quantity, :Orders_order_ID)";
                $product_statement = $connection->prepare($product_sql); // Prepare the query
                $product_statement->execute($new_product); // Execute the query with the product data
            }
        }

        // Display a success message with the Order ID and a link to enter shipping details
        echo "Order successfully added! Your Order ID is: <strong>" . htmlspecialchars($order_ID) . "</strong><br>";
        echo "<a href='createshipping.php?order_ID=" . urlencode($order_ID) . "'>Click here to enter shipping details</a>";

    } catch (PDOException $error) {
        // Catch any database-related errors and display the error message
        echo "Error: " . $error->getMessage();
    }
}

// Include the header template
require "templates/header.php";
?>

<!-- HTML form to create a new order -->
<h2>Add an Order</h2>
<form method="post">
    <!-- Input field for the total cost of the order -->
    <label for="total_cost">Total Cost</label>
    <input type="text" name="total_cost" id="total_cost" required>

    <!-- Submit button to submit the form -->
    <input type="submit" name="submit" value="Submit">
</form>

<!-- Link to navigate back to the home page -->
<a href="index.php">Back to home</a>

<?php
// Include the footer template
include "templates/footer.php";
?>