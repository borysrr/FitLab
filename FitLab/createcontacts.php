<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Include common functions
    require "common.php";

    try {
        // Include the database connection file
        require_once 'src/db_connect.php';

        // Sanitize and escape form data before inserting into the database
        $new_user = [
            "firstname" => escape($_POST['firstname']),   // Clean the first name
            "lastname" => escape($_POST['lastname']),     // Clean the last name
            "email" => escape($_POST['email']),           // Clean the email address
            "age" => escape($_POST['age']),               // Clean the age
            "location" => escape($_POST['location'])      // Clean the location
        ];

        // SQL query to insert new user into the 'users' table
        $sql = "INSERT INTO users (firstname, lastname, email, age, location) VALUES (:firstname, :lastname, :email, :age, :location)";
        $statement = $connection->prepare($sql); // Prepare the SQL query
        $statement->execute($new_user); // Execute the query with the form data

        // Success message after inserting the user
        echo "{$new_user['firstname']} successfully added"; // Inform the user that the data was added
    } catch(PDOException $error) {
        // If there's an error, display the error message
        echo "Error: " . $error->getMessage();
    }
}

// Include the header template
require "templates/header.php";
?>

<!-- HTML form to add a new user -->
<h2>Add a user</h2>
<form method="post">
    <!-- First Name field -->
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>

    <!-- Last Name field -->
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" required>

    <!-- Email field -->
    <label for="email">Email Address</label>
    <input type="email" name="email" id="email" required>

    <!-- Age field -->
    <label for="age">Age</label>
    <input type="number" name="age" id="age" required>

    <!-- Location field -->
    <label for="location">Location</label>
    <input type="text" name="location" id="location" required>

    <!-- Submit button for form -->
    <input type="submit" name="submit" value="Submit">
</form>

<!-- Link to navigate back to the home page -->
<a href="index.php">Back to home</a>

<?php
// Include the footer template (e.g., for consistent footer design across pages)
include "templates/footer.php";
?>