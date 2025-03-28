<?php
require_once 'src/db_connect.php';

// Handle contact form update
if (isset($_POST['update'])) {
    $contact_id = intval($_POST['contact_form_sub_ID']);
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sub_date = $_POST['sub_date'];

    $sql = "UPDATE Contact_form_sub SET first_name=?, email=?, message=?, sub_date=? WHERE contact_form_sub_ID=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$first_name, $email, $message, $sub_date, $contact_id]);
}

// Fetch all contact form submissions
$sql = "SELECT * FROM Contact_form_sub";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Contact Submissions</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Update Contact Submissions</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submission Date</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= $row['contact_form_sub_ID'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= htmlspecialchars($row['sub_date']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to home</a>
</body>
</html>