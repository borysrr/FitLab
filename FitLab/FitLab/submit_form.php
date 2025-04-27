<?php
require_once 'src/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["description"];
    $sub_date = date("Y-m-d H:i:s"); // Store current timestamp

    try {
        $sql = "INSERT INTO Contact_form_sub (first_name, email, message, sub_date) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$first_name, $email, $message, $sub_date]);

        // Redirect back with success message
        header("Location: contact.php?success=1");
        exit;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>
