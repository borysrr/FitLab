<?php
// Start the session to access session variables if needed
session_start();

// Include the database connection file
require_once 'src/db_connect.php';

// Prepare the SQL query to select user ID and email from the Users table
$sql = "SELECT user_ID, email FROM Users";

// Use a prepared statement to execute the SQL query
$statement = $connection->prepare($sql);
$statement->execute();

// Fetch all rows returned from the query and store them in the $users array
$users = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <!-- Link to the external CSS file to apply consistent styling -->
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- Page Heading -->
<h2>Users List</h2>

<!-- Begin a table to display the list of users -->
<table border="1">
    <tr>
        <!-- Table column headers -->
        <th>User ID</th>
        <th>Email</th>
    </tr>

    <!-- Loop through each user in the $users array and display their data in a row -->
    <?php foreach ($users as $user): ?>
        <tr>
            <!-- Use htmlspecialchars to safely output user data (prevents XSS attacks) -->
            <td><?= htmlspecialchars($user['user_ID']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Link to go back to the homepage -->
<a href="index.php">Back to home</a>

</body>
</html>