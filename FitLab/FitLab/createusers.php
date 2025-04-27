<?php
session_start();
require "common.php";
require_once 'src/db_connect.php';

if (isset($_POST['submit'])) {
    try {
        $email = escape($_POST['email']);
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user
        $sql = "INSERT INTO Users (email, password) VALUES (:email, :password)";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        echo "User successfully registered. <a href='login.php'>Login here</a>";

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>

<!-- HTML Form -->
<?php require "templates/header.php"; ?>
<h2>Sign Up</h2>
<form method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" name="submit" value="Sign Up">
</form>
<?php require "templates/footer.php"; ?>