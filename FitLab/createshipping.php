<?php
// Start the session to manage user data, especially for checking if the user is logged in
session_start();

// Include common functions, such as the escape function to sanitize input
require "common.php";

// Include the session handler to manage session-related tasks
require_once 'session_handler.php';
$session = new SessionHandlerCustom();

// Check if the user is logged in by verifying the session variable 'user_id'
// If not, redirect the user to the login page and pass a 'redirect' parameter
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=createshipping.php");
    exit(); // Exit the script to stop further execution
}

// Retrieve the order ID
$order_ID_from_get = $_GET['order_ID'] ?? '';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    try {
        // Include the database connection file to interact with the database
        require_once 'src/db_connect.php';

        // Prepare the data from the form submission, ensuring it's sanitized before use
        $new_shipping = array(
            "name" => escape($_POST['name']), // Sanitize the 'name' input
            "phone_number" => escape($_POST['phone_number']), // Sanitize the 'phone_number' input
            "address" => escape($_POST['address']), // Sanitize the 'address' input
            "payment_type" => escape($_POST['payment_type']), // Sanitize the 'payment_type' input
            "confirmation" => escape($_POST['confirmation']), // Sanitize the 'confirmation' input
            "Orders_order_ID" => escape($_POST['Orders_order_ID']) // Sanitize the 'Orders_order_ID' input
        );

        // Create an SQL query string dynamically by using the array keys (column names) and values
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "Shipping_and_Payment", // Table name
            implode(", ", array_keys($new_shipping)), // Get the column names from the array keys
            ":" . implode(", :", array_keys($new_shipping)) // Create placeholder names for the prepared statement
        );

        // Prepare the SQL query for execution
        $statement = $connection->prepare($sql);
        // Execute the query with the data from the form
        $statement->execute($new_shipping);

        // If successful, set a success flag
        $success = true;

    } catch (PDOException $error) {
        // If an error occurs, display the SQL query and the error message
        echo $sql . "<br>" . $error->getMessage();
    }
}

// Include the header template to display the page header
require "templates/header.php";

// If the shipping details were successfully added, display a success message
if (isset($success) && $success) {
    echo "Shipping information successfully added!";
}
?>

<!-- HTML form for collecting shipping details -->
<h2>Add Shipping Details</h2>
<form method="post">
    <!-- Input fields for shipping information: name, phone number, address, payment type, confirmation, and order ID -->
    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" required>

    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" required>

    <label for="address">Address</label>
    <input type="text" name="address" id="address" required>

    <label for="payment_type">Payment Type</label>
    <input type="text" name="payment_type" id="payment_type" required>

    <label for="confirmation">Confirmation</label>
    <input type="text" name="confirmation" id="confirmation" required>

    <!-- Hidden input field for the Order ID, prefilled with the value -->
    <label for="Orders_order_ID">Order ID</label>
    <input type="text" name="Orders_order_ID" id="Orders_order_ID" required value="<?php echo htmlspecialchars($order_ID_from_get); ?>">

    <!-- Submit button to submit the form -->
    <input type="submit" name="submit" value="Submit">
</form>

<!-- Link to navigate back to the home page -->
<a href="index.php">Back to home</a>

<?php
// Include the footer template for consistent footer design
include "templates/footer.php";
?>