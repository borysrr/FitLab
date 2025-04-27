<?php
session_start();
require_once 'src/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your orders.";
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $connection->prepare("SELECT * FROM Orders WHERE Users_user_ID = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<h2>Your Order Details</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Order ID</th>
        <th>Total Cost</th>
        <th>Order Date</th>
        <th>User ID</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= htmlspecialchars($order['order_ID']) ?></td>
            <td>$<?= htmlspecialchars($order['total_cost']) ?></td>
            <td><?= htmlspecialchars($order['order_date']) ?></td>
            <td><?= htmlspecialchars($order['Users_user_ID']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><a href="index.php">Back to Home</a></p>

</body>
</html>