<?php
session_start();
require_once 'src/db_connect.php';

if (isset($_POST['submit'])) {
    try {
        // Get the submitted form data
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Check if the email already exists
        $check_sql = "SELECT * FROM Users WHERE email = :email";
        $statement = $connection->prepare($check_sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            echo "Email already exists. Please use a different one.";
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO Users (email, password) VALUES (:email, :password)";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $statement->execute();

            echo "Registration successful! You can now log in.";
        }

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Create an Account</h2>
<form method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>

    <input type="submit" name="submit" value="Create Account">
</form>
<a href="login.php">Already have an account? Login here</a>
</body>
</html>