<?php
require_once('config.php');
session_start();
require_once 'src/db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $password = $confirm_password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 8 || !preg_match("/[0-9]/", $password) || !preg_match("/[a-zA-Z]/", $password)) {
        $error = "Password must be at least 8 characters long and include both letters and numbers.";
    } else {
        try {
            // Check if email already exists
            $stmt = $connection->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);

            if ($stmt->rowCount() > 0) {
                $error = "Email already exists!";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO Users (email, password) VALUES (:email, :password)";
                $stmt = $connection->prepare($sql);
                $stmt->execute([
                    'email' => $email,
                    'password' => $hashed_password
                ]);

                $_SESSION['user'] = $email;
                $_SESSION['user_id'] = $connection->lastInsertId();

                header("Location: index.php");
                exit();
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
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

    <?php if ($error): ?>
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
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Sign Up</button>
        <p class="text-center" style="margin-top: 10px;">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

</body>
</html>