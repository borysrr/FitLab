<?php
session_start();
require "common.php";

// ✅ Part 2: Require login before proceeding
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

        // Prepare order data
        $new_order = array(
            "order_ID" => uniqid(),
            "total_cost" => escape($_POST['total_cost']),
            "order_date" => date("Y-m-d H:i:s"),
            "Users_user_ID" => $user_id
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "Orders",
            implode(", ", array_keys($new_order)),
            ":" . implode(", :", array_keys($new_order))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_order);

        $order_ID = $connection->lastInsertId();
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $product) {
                $new_product = array(
                    "name" => $product['name'],
                    "description" => $product['description'],
                    "price" => $product['price'],
                    "stock_quantity" => $product['stock_quantity'],
                    "Orders_order_ID" => $order_ID
                );

                $product_sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "Products",
                    implode(", ", array_keys($new_product)),
                    ":" . implode(", :", array_keys($new_product))
                );

                $product_statement = $connection->prepare($product_sql);
                $product_statement->execute($new_product);
            }
        }

        echo "Order successfully added! Your Order ID is: <strong>" . htmlspecialchars($order_ID) . "</strong><br>";
        echo "<a href='createshipping.php?order_ID=" . urlencode($order_ID) . "'>Click here to enter shipping details</a>";

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
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>