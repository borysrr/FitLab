<?php
// Start the session to manage session data
session_start();

$_SESSION = [];
// Destroy the session, effectively logging out the user
session_destroy();

// Check if the session cookie is being used
if (ini_get("session.use_cookies")) {
    // Retrieve the session cookie parameters
    $params = session_get_cookie_params();

    // Set the session cookie with an expiration time in the past to remove it from the browser
    setcookie(session_name(), '', time() - 42000,
        // Set the cookie parameters to match the original cookie's path and domain
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect the user to the login page after logging out
header("Location: login.php");

// End the script to ensure no further code is executed
exit();
?>
