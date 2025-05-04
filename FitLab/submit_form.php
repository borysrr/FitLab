<?php
// Including the database connection file
require_once 'src/db_connect.php';

// Checking if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizing and storing form input values
    $first_name = $_POST["name"]; // User's first name from the form
    $email = $_POST["email"]; // User's email from the form
    $message = $_POST["description"]; // User's message from the form
    $sub_date = date("Y-m-d H:i:s"); // Getting the current date and time for submission

    try {
        // SQL query to insert form data into the 'Contact_form_sub' table
        $sql = "INSERT INTO Contact_form_sub (first_name, email, message, sub_date) VALUES (?, ?, ?, ?)";

        // Preparing the SQL statement to prevent SQL injection
        $stmt = $connection->prepare($sql);

        // Executing the prepared statement with the form data
        $stmt->execute([$first_name, $email, $message, $sub_date]);

        // Redirecting the user to the contact page with a success parameter
        header("Location: contact.php?success=1");
        exit; // Ensuring that no further code is executed after the redirect
    } catch (PDOException $error) {
        // If an error occurs during the database operation, it is caught here
        echo "Error: " . $error->getMessage(); // Displaying the error message
    }
}
?>