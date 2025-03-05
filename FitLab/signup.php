<?php
session_start();

// Define variables to hold error messages and form values
$email = $password = $confirm_password = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
    // Check if passwords match
    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    }
    // Check if password is strong enough (at least 8 characters, including numbers and letters)
    elseif (strlen($password) < 8 || !preg_match("/[0-9]/", $password) || !preg_match("/[a-zA-Z]/", $password)) {
        $error = "Password must be at least 8 characters long and include both letters and numbers.";
    } else {
        // Simulate user registration (Replace with database storage)
        $_SESSION['user'] = $email;
        $_SESSION['success'] = "Registration successful! Welcome to FitLab.";
        header("Location: index.php"); // Redirect to main page after signup
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - FitLab</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<div class="container" style="max-width: 400px; margin-top: 100px;">
    <h2 class="text-center">Sign Up to <span style="font-family: Papyrus, Kristen ITC, sans-serif;">FitLab</span></h2>

    <?php if (isset($error)) { echo "<div class='alert alert-danger text-center'>$error</div>"; } ?>
    <?php if (isset($_SESSION['success'])) { echo "<div class='alert alert-success text-center'>{$_SESSION['success']}</div>"; unset($_SESSION['success']); } ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Sign Up</button>
        <p class="text-center" style="margin-top: 10px;">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

</body>
</html>
