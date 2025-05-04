<?php
// Start a session to manage user data, especially for session management
session_start();

// Include the common functions for sanitizing inputs
require "common.php";

// Include the database connection to interact with the database
require_once 'src/db_connect.php';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    try {
        // Get the user input for email and password, and sanitize the email
        $email = escape($_POST['email']);
        $password = $_POST['password'];

        // Hash the password to securely store it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert the new user into the Users table
        $sql = "INSERT INTO Users (email, password) VALUES (:email, :password)";
        // Prepare the SQL statement using the connection object
        $statement = $connection->prepare($sql);

        // Execute the statement with the provided email and hashed password
        $statement->execute([
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        // Display a success message with a link to the login page
        echo "User successfully registered. <a href='login.php'>Login here</a>";

    } catch (PDOException $error) {
        // If there is an error, display the error message
        echo "Error: " . $error->getMessage();
    }
}
?>

<!-- HTML Form for user registration -->
<?php require "templates/header.php"; ?>
<h2>Sign Up</h2>
<!-- The form will submit via POST to the same page -->
<form method="post">
    <!-- Input field for the user's email address -->
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <!-- Input field for the user's password -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <!-- Submit button for the form -->
    <input type="submit" name="submit" value="Sign Up">
</form>

<?php require "templates/footer.php"; ?>