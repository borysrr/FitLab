<?php
require_once 'src/db_connect.php';

// Fetch all products from the database
$sql = "SELECT * FROM Products";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Available Products</h2>
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock Quantity</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['product_ID']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>$<?= htmlspecialchars($row['price']) ?></td>
            <td><?= htmlspecialchars($row['stock_quantity']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to home</a>
</body>
</html>