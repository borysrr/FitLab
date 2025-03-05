<?php
session_start();

// Define variables to hold form data and errors
$email = $password = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
    // Dummy user data (Replace with actual database validation)
    else {
        $valid_email = "user@example.com";
        $valid_password = "password123";

        if ($email === $valid_email && $password === $valid_password) {
            $_SESSION['user'] = $email;
            header("Location: dashboard.php"); // Redirect to dashboard after successful login
            exit();
        } else {
            $error = "Invalid email or password!";
        }
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

    <!-- Display error message if login fails -->
    <?php if (isset($error)) { echo "<div class='alert alert-danger text-center'>$error</div>"; } ?>

    <!-- Login Form -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
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
