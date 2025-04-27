<?php
require_once 'src/db_connect.php';

if (isset($_POST['update'])) {
    $contact_id = intval($_POST['contact_form_sub_ID']);
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sub_date = $_POST['sub_date'];

    $stmt = $connection->prepare("UPDATE Contact_form_sub SET first_name=?, email=?, message=?, sub_date=? WHERE contact_form_sub_ID=?");
    $stmt->execute([$first_name, $email, $message, $sub_date, $contact_id]);
}

$stmt = $connection->prepare("SELECT * FROM Contact_form_sub");
$stmt->execute();
$submissions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Submissions</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Update Contact Submissions</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submission Date</th>
    </tr>
    <?php foreach ($submissions as $row): ?>
        <tr>
            <td><?= $row['contact_form_sub_ID'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= htmlspecialchars($row['sub_date']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><a href="index.php">Back to Home</a></p>
</body>
</html>