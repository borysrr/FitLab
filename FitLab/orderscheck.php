<?php
session_start();
require_once 'src/db_connect.php';

// Ensure the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "You must be logged in to view your orders.";
    exit;
}

// Fetch orders for the logged-in user
$sql = "SELECT * FROM Orders WHERE Users_user_ID = :user_id";
$statement = $connection->prepare($sql);
$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Your Order Details</h2>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Total Cost</th>
        <th>Order Date</th>
        <th>User ID</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['order_ID']) ?></td>
            <td>$<?= htmlspecialchars($row['total_cost']) ?></td>
            <td><?= htmlspecialchars($row['order_date']) ?></td>
            <td><?= htmlspecialchars($row['Users_user_ID']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to home</a>
</body>
</html>