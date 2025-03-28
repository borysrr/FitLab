<?php
session_start();
require_once 'src/db_connect.php';

// Fetch all users from the Users table
$sql = "SELECT user_ID, email FROM Users";
$statement = $connection->prepare($sql);
$statement->execute();
$users = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Users List</h2>
<table border="1">x
    <tr>
        <th>User ID</th>
        <th>Email</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['user_ID']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to home</a>
</body>
</html>