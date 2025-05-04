<?php
// Including configuration and database connection files
require_once('config.php');
session_start(); // Starting the session to manage user data throughout the session
require_once 'src/db_connect.php'; // Including the database connection file

// Enabling error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initializing variables
$email = $password = $confirm_password = ""; // Variables to hold form input data
$error = ""; // Variable to hold error messages

// Checking if the form is submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizing and assigning the form input values to variables
    $email = trim($_POST['email']); // Removing unnecessary spaces from the email
    $password = $_POST['password']; // Storing the password input
    $confirm_password = $_POST['confirm_password']; // Storing the confirmation password input

    // Validation checks for form inputs
    // 1. Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!"; // Error message if email format is invalid
    }
    // 2. Check if password and confirm password match
    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!"; // Error message if passwords don't match
    }
    // 3. Validate password strength
    elseif (strlen($password) < 8 || !preg_match("/[0-9]/", $password) || !preg_match("/[a-zA-Z]/", $password)) {
        $error = "Password must be at least 8 characters long and include both letters and numbers."; // Error message for weak password
    } else {
        try {
            // Check if the provided email already exists in the database
            $stmt = $connection->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]); // Execute the query to search for the email in the Users table

            // If email is already in the database, return an error
            if ($stmt->rowCount() > 0) {
                $error = "Email already exists!"; // Error message if email is found in the database
            } else {
                // If email doesn't exist, proceed to insert the new user
                // Hash the password before storing it in the database for security reasons
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // SQL query to insert a new user into the Users table
                $sql = "INSERT INTO Users (email, password) VALUES (:email, :password)";
                $stmt = $connection->prepare($sql); // Prepare the SQL statement for execution

                // Execute the query with the provided email and hashed password
                $stmt->execute([
                    'email' => $email,
                    'password' => $hashed_password
                ]);

                // After successful insertion, start a session and store user data
                $_SESSION['user'] = $email; // Store the email in session
                $_SESSION['user_id'] = $connection->lastInsertId(); // Get the ID of the newly inserted user and store it in session

                // Redirect the user to the homepage
                header("Location: index.php");
                exit(); // Stop further execution to prevent any other code from running after the redirect
            }
        } catch (PDOException $e) {
            // If there is any database error, display the error message
            $error = "Error: " . $e->getMessage(); // Display the error message from the exception
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<div class="container" style="max-width: 400px; margin-top: 100px;">
    <h2 class="text-center">Sign Up for <span style="font-family: Papyrus, Kristen ITC, sans-serif;">FitLab</span></h2>

    <!-- Display error messages, if any -->
    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Signup form -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <!-- Input field for email with current value populated -->
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <!-- Input field for password -->
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <!-- Input field for confirm password -->
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Sign Up</button>
        <p class="text-center" style="margin-top: 10px;">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

</body>
</html>