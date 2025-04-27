<?php
require_once 'src/db_connect.php';

// Fetch all shipping records
$sql = "SELECT * FROM Shipping_and_Payment";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Shipping Details</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Shipping Details</h2>
<table border="1">
    <tr>
        <th>Shipping ID</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Payment Type</th>
        <th>Confirmation</th>
        <th>Order ID</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['Shipping_ID']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['phone_number']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['payment_type']) ?></td>
            <td><?= htmlspecialchars($row['confirmation']) ?></td>
            <td><?= htmlspecialchars($row['Orders_order_ID']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to home</a>
</body>
</html>