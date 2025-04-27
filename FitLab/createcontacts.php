<?php
if (isset($_POST['submit'])) {
    require "common.php";
    try {
        require_once 'src/db_connect.php';

        $new_user = [
            "firstname" => escape($_POST['firstname']),
            "lastname" => escape($_POST['lastname']),
            "email" => escape($_POST['email']),
            "age" => escape($_POST['age']),
            "location" => escape($_POST['location'])
        ];

        // Prepare SQL query for insertion
        $sql = "INSERT INTO users (firstname, lastname, email, age, location) VALUES (:firstname, :lastname, :email, :age, :location)";
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        // Success message
        echo "{$new_user['firstname']} successfully added";
    } catch(PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

require "templates/header.php";
?>

    <h2>Add a user</h2>
    <form method="post">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" required>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" required>
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>
        <label for="age">Age</label>
        <input type="number" name="age" id="age" required>
        <label for="location">Location</label>
        <input type="text" name="location" id="location" required>
        <input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>