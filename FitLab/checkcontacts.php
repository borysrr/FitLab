<?php
// Include the database connection script
require_once 'src/db_connect.php';

// Check if the form is submitted to update contact submission details
if (isset($_POST['update'])) {
    // Get the values from the form and sanitize them
    $contact_id = intval($_POST['contact_form_sub_ID']); // Ensure ID is an integer
    $first_name = $_POST['first_name']; // Get first name
    $email = $_POST['email']; // Get email
    $message = $_POST['message']; // Get the message content
    $sub_date = $_POST['sub_date']; // Get submission date

    // Prepare the SQL query to update the contact form submission
    $stmt = $connection->prepare("UPDATE Contact_form_sub SET first_name=?, email=?, message=?, sub_date=? WHERE contact_form_sub_ID=?");
    // Execute the query with the provided values
    $stmt->execute([$first_name, $email, $message, $sub_date, $contact_id]);
}

// Fetch all contact form submissions from the database
$stmt = $connection->prepare("SELECT * FROM Contact_form_sub");
$stmt->execute();
$submissions = $stmt->fetchAll(); // Fetch all records as an associative array
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Submissions</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Link to the CSS file for styling -->
</head>
<body>
<h2>Update Contact Submissions</h2>

<!-- Display a table with all contact submissions -->
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <!-- Table headers -->
        <th>ID</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submission Date</th>
    </tr>

    <!-- Loop through each submission and display it in the table -->
    <?php foreach ($submissions as $row): ?>
        <tr>
            <!-- Display each field of the submission -->
            <td><?= $row['contact_form_sub_ID'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= htmlspecialchars($row['sub_date']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Link to go back to the homepage -->
<p><a href="index.php">Back to Home</a></p>
</body>
</html>