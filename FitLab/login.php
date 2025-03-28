<?php
session_start();
require_once 'src/db_connect.php'; // Ensure correct database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define variables to hold form data and errors
$email = $password = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format!";
        } else {
            // Check if the email exists in the database
            $stmt = $connection->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Debugging: Check stored password and hash
                echo "Stored hashed password: " . $user['password'] . "<br>";

                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Set session variables for the logged-in user
                    $_SESSION['user'] = $email;
                    $_SESSION['user_id'] = $user['user_ID']; // Store user ID from database

                    // Redirect to dashboard after successful login
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Invalid email or password! (Password does not match)";
                }
            } else {
                $error = "Invalid email or password! (Email not found)";
            }
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FitLab</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<div class="container" style="max-width: 400px; margin-top: 100px;">
    <h2 class="text-center">Login to <span style="font-family: Papyrus, Kristen ITC, sans-serif;">FitLab</span></h2>

    <!-- Display error message if any -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <p class="text-center" style="margin-top: 10px;">Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
</div>

</body>
</html>