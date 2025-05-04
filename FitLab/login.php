<?php
// Start a session to store login information for the user
session_start();

// Include necessary files for database connection
require_once 'config.php';
require_once 'src/db_connect.php';

// Initialize variables to store form inputs and error messages
$email = $password = "";
$error = "";

// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize the email input to remove any unwanted characters
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Store the password entered by the user
    $password = $_POST['password'];

    // Validate if the email is in a proper email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If the email format is invalid, set an error message
        $error = "Invalid email format!";
    } else {
        try {
            // Prepare a SQL query to fetch user information based on the email entered
            $stmt = $connection->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if a user is found and if the password matches the hashed password stored in the database
            if ($user && password_verify($password, $user['password'])) {
                // If login is successful, store user's email and user ID in session variables
                $_SESSION['user'] = $user['email'];
                $_SESSION['user_id'] = $user['user_ID'];

                // Regenerate the session ID to prevent session fixation attacks
                session_regenerate_id(true);

                // Redirect the user to the main page (index.php) after a successful login
                header("Location: index.php");
                exit(); // Stop the script after redirecting
            } else {
                // If login fails, set an error message
                $error = "Invalid email or password!";
            }
        } catch (PDOException $e) {
            // In case of any database errors, log the error and show a general error message
            error_log($e->getMessage());
            $error = "Database error. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet"> <!-- Add Bootstrap for styling -->
    <link href="css/main.css" rel="stylesheet"> <!-- Add custom styles -->
</head>
<body>
<div class="container" style="max-width: 400px; margin-top: 100px;">
    <h2 class="text-center">Login to <span style="font-family: Papyrus, Kristen ITC, sans-serif;">FitLab</span></h2>

    <!-- Display error message if there is any -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Create the login form -->
    <form method="POST">
        <div class="form-group">
            <!-- Input field for email -->
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <!-- Input field for password -->
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <!-- Submit button to log in -->
        <button type="submit" class="btn btn-primary btn-block">Login</button>

        <!-- Provide a link for users who don't have an account to sign up -->
        <p class="text-center mt-2">Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
</div>
</body>
</html>