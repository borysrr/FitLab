<?php
// Include the database connection file
require_once 'src/db_connect.php';

// SQL query to select all products from the Products table
$sql = "SELECT * FROM Products";

// Prepare and execute the query using PDO to prevent SQL injection
$statement = $connection->prepare($sql);
$statement->execute();

// Fetch all product records from the database
$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Link to your custom stylesheet -->
</head>
<body>

<h2>Available Products</h2>

<!-- Start of product table -->
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock Quantity</th>
    </tr>

    <!-- Loop through each product and display its details in the table -->
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

<!-- Link back to the homepage -->
<a href="index.php">Back to home</a>

</body>
</html>