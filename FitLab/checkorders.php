<?php
// Start the session to manage user-specific data
session_start();

// Include the database connection script
require_once 'src/db_connect.php';

// Check if the user is logged in by checking the session for a user ID
if (!isset($_SESSION['user_id'])) {
    // If not logged in, display a message and stop the script
    echo "You must be logged in to view your orders.";
    exit; // Stops further execution of the script
}

// Retrieve the user ID from the session to get their orders
$user_id = $_SESSION['user_id'];

// Prepare an SQL query to fetch orders for the logged-in user
$stmt = $connection->prepare("SELECT * FROM Orders WHERE Users_user_ID = :user_id");
// Bind the user ID to the prepared statement to protect against SQL injection
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
// Execute the query
$stmt->execute();
// Fetch all orders as an associative array
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Link to the CSS file for styling -->
</head>
<body>

<h2>Your Order Details</h2>

<!-- Display the orders in a table format -->
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <!-- Table headers for the order details -->
        <th>Order ID</th>
        <th>Total Cost</th>
        <th>Order Date</th>
        <th>User ID</th>
    </tr>

    <!-- Loop through each order and display it in the table -->
    <?php foreach ($orders as $order): ?>
        <tr>
            <!-- Display each order's details in respective columns -->
            <td><?= htmlspecialchars($order['order_ID']) ?></td>
            <td>$<?= htmlspecialchars($order['total_cost']) ?></td>
            <td><?= htmlspecialchars($order['order_date']) ?></td>
            <td><?= htmlspecialchars($order['Users_user_ID']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Link to go back to the homepage -->
<p><a href="index.php">Back to Home</a></p>

</body>
</html>