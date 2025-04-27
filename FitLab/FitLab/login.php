<?php
require_once 'config.php';
session_start();
require_once 'src/db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format!";
        } else {
            // Fetch user by email
            $stmt = $connection->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Password matched — set session variables
                $_SESSION['user'] = $user['email'];
                $_SESSION['user_id'] = $user['user_ID'];

                // Redirect
                $redirect = $_GET['redirect'] ?? 'index.php';
                header("Location: " . $redirect);
                exit();
            } else {
                $error = "Invalid email or password!";
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

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
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