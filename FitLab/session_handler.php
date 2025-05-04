<?php
// Custom session handler class to manage user sessions
class SessionHandlerCustom
{
    // Method to kill the session
    public function killSession()
    {
        // Clear all session data by setting the session array to an empty array
        $_SESSION = [];

        // Check if session cookies are being used
        if (ini_get('session.use_cookies')) {
            // Retrieve the session cookie parameters
            $params = session_get_cookie_params();

            // Set the session cookie to expire in the past
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'], $params['secure'], $params['httponly']
            );
        }

        // Destroy the session completely, clearing session data on the server
        session_destroy();
    }

    // Method to forget (log out) the session and redirect the user
    public function forgetSession()
    {
        // Call the killSession method to end the session and clear data
        $this->killSession();

        // Redirect the user to the login page after ending the session
        header("Location: login.php");

        // Stop further execution of the script after the redirect
        exit;
    }
}
?>