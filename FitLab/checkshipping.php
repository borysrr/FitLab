<?php
// Include the file that connects to the database
require_once 'src/db_connect.php';

// SQL query to select all records from the Shipping_and_Payment table
$sql = "SELECT * FROM Shipping_and_Payment";

// Prepare the SQL statement using PDO
$statement = $connection->prepare($sql);

// Execute the prepared statement
$statement->execute();

// Fetch all the results into an array
$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Shipping Details</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Optional custom stylesheet -->
</head>
<body>

<h2>Shipping Details</h2>

<!-- Create a table to display shipping and payment details -->
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

    <!-- Loop through each row in the result and output the data safely -->
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

<!-- Simple navigation link back to the homepage -->
<a href="index.php">Back to home</a>

</body>
</html>