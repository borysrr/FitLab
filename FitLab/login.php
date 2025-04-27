<?php
require_once 'config.php';
require_once 'src/db_connect.php';
session_start();

$email = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        try {
            $stmt = $connection->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user'] = $user['email'];
                $_SESSION['user_id'] = $user['user_ID'];
                session_regenerate_id(true);

                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid email or password!";
            }
        } catch (PDOException $e) {
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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
<div class="container" style="max-width: 400px; margin-top: 100px;">
    <h2 class="text-center">Login to <span style="font-family: Papyrus, Kristen ITC, sans-serif;">FitLab</span></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <p class="text-center mt-2">Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
</div>
</body>
</html>