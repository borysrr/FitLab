<?php
session_start();
require "common.php";

require_once 'session_handler.php';
$session = new SessionHandlerCustom();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=createorders.php");
    exit();
}

if (isset($_POST['submit'])) {
    try {
        require_once 'src/db_connect.php';

        $user_id = $_SESSION['user_id'];
        $new_order = [
            "order_ID" => uniqid(),
            "total_cost" => escape($_POST['total_cost']),
            "order_date" => date("Y-m-d H:i:s"),
            "Users_user_ID" => $user_id
        ];

        // Insert the order into the database
        $sql = "INSERT INTO Orders (order_ID, total_cost, order_date, Users_user_ID) VALUES (:order_ID, :total_cost, :order_date, :Users_user_ID)";
        $statement = $connection->prepare($sql);
        $statement->execute($new_order);

        $order_ID = $connection->lastInsertId();

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {
                $new_product = [
                    "name" => $product['name'],
                    "description" => $product['description'],
                    "price" => $product['price'],
                    "stock_quantity" => $product['stock_quantity'],
                    "Orders_order_ID" => $order_ID
                ];

                $product_sql = "INSERT INTO Products (name, description, price, stock_quantity, Orders_order_ID) VALUES (:name, :description, :price, :stock_quantity, :Orders_order_ID)";
                $product_statement = $connection->prepare($product_sql);
                $product_statement->execute($new_product);
            }
        }

        echo "Order successfully added! Your Order ID is: <strong>" . htmlspecialchars($order_ID) . "</strong><br>";
        echo "<a href='createshipping.php?order_ID=" . urlencode($order_ID) . "'>Click here to enter shipping details</a>";

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

require "templates/header.php";
?>

<h2>Add an Order</h2>
<form method="post">
    <label for="total_cost">Total Cost</label>
    <input type="text" name="total_cost" id="total_cost" required>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php";
?>