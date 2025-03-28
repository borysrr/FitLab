<?php
session_start();
require 'lib/functions.php';
require 'templates/header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Ensure the cart is not empty
if (empty($_SESSION['cart'])) {
    echo "<h1 style='text-align: center;'>Checkout</h1>";
    echo "<p style='text-align: center; font-size: 18px;'>Your cart is empty. <a href='index.php'>Continue Shopping</a></p>";
    require 'templates/footer.php';
    exit;
}

// Ensure total cost is calculated and available
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
    foreach ($_SESSION['cart'] as $item) {
        $_SESSION['total'] += $item['price'] * $item['quantity']; // Adjust according to your cart structure
    }
}

$form_errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postal_code = trim($_POST['postal_code'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $payment_method = $_POST['payment_method'] ?? '';
    $valid_methods = ['credit_card', 'paypal', 'apple_pay'];

    // Validate required fields
    if (empty($name)) {
        $form_errors[] = "Full Name is required.";
    }
    if (empty($address)) {
        $form_errors[] = "Address is required.";
    }
    if (empty($city)) {
        $form_errors[] = "City is required.";
    }
    if (empty($postal_code)) {
        $form_errors[] = "Postal Code is required.";
    }
    if (empty($phone_number)) {
        $form_errors[] = "Phone Number is required.";
    }
    if (!in_array($payment_method, $valid_methods)) {
        $form_errors[] = "Please select a valid payment method.";
    }

    // If there are errors, display the form again with the error messages
    if (!empty($form_errors)) {
        echo "<h1 style='text-align: center;'>Please Include all Listed Below</h1>";
        foreach ($form_errors as $error) {
            echo "<p style='text-align: center; color: red; font-size: 18px;'>$error</p>";
        }
    } else {
        // Generate a unique order ID (you can customize the prefix)
        $order_id = mt_rand(1000000000, 9999999999);

        try {
            require_once 'src/db_connect.php';

            // Insert into the Orders table
            $sql = "INSERT INTO Orders (order_ID, total_cost, order_date, Users_user_ID) VALUES (?, ?, NOW(), ?)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$order_id, $_SESSION['total'], $_SESSION['user_id']]); // Use the session user ID and total

            // Insert into the Shipping_and_Payment table
            $sql_shipping = "INSERT INTO Shipping_and_Payment (name, phone_number, address, payment_type, confirmation, Orders_order_ID)
                             VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_shipping = $connection->prepare($sql_shipping);
            $stmt_shipping->execute([$name, $phone_number, $address, $payment_method, 'confirmed', $order_id]);

            // Clear the cart after successful order
            unset($_SESSION['cart']);
            unset($_SESSION['total']);

            echo "<h1 style='text-align: center;'>Order Confirmation</h1>";
            echo "<p style='text-align: center; font-size: 22px; margin-bottom: 20px;'>Thank you, <strong>$name</strong>! Your order has been placed successfully.</p>";
            echo "<p style='text-align: center; font-size: 20px; margin-bottom: 15px;'>Order ID: <strong>$order_id</strong></p>";  // Display generated order ID
            echo "<p style='text-align: center; font-size: 20px; margin-bottom: 15px;'>Shipping to: <strong>$address, $city, $postal_code</strong></p>";
            echo "<p style='text-align: center; font-size: 20px; margin-bottom: 15px;'>Payment Method: <strong>" . ucfirst(str_replace('_', ' ', $payment_method)) . "</strong></p>";
            echo "<p style='text-align: center; font-size: 20px; margin-bottom: 15px;'>Phone Number: <strong>$phone_number</strong></p>";  // Display phone number
            echo "<p style='text-align: center; font-size: 18px;'><a href='index.php'>Continue Shopping</a></p>";

        } catch (PDOException $error) {
            echo "<p style='color: red;'>Error: " . $error->getMessage() . "</p>";
        }
        exit;
    }
}

// Checkout form
echo "<h1 style='text-align: center;'>Checkout</h1>";
echo "<form action='checkout.php' method='POST' style='width: 60%; margin: auto; text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background: #f9f9f9;'>";

echo "<label style='display: block; margin: 10px; font-weight: bold;'>Full Name:</label>";
echo "<input type='text' name='name' value='" . htmlspecialchars($name ?? '') . "' style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

echo "<label style='display: block; margin: 10px; font-weight: bold;'>Address:</label>";
echo "<input type='text' name='address' value='" . htmlspecialchars($address ?? '') . "' style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

echo "<label style='display: block; margin: 10px; font-weight: bold;'>City:</label>";
echo "<input type='text' name='city' value='" . htmlspecialchars($city ?? '') . "' style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

echo "<label style='display: block; margin: 10px; font-weight: bold;'>Postal Code:</label>";
echo "<input type='text' name='postal_code' value='" . htmlspecialchars($postal_code ?? '') . "' style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

echo "<label style='display: block; margin: 10px; font-weight: bold;'>Phone Number:</label>";
echo "<input type='text' name='phone_number' value='" . htmlspecialchars($phone_number ?? '') . "' style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

echo "<label style='display: block; margin: 10px; font-weight: bold;'>Payment Method:</label>";
echo "<select name='payment_method' style='padding: 10px; width: 80%; border-radius: 5px;'>";
echo "<option value='credit_card'" . ($payment_method == 'credit_card' ? ' selected' : '') . ">Credit Card</option>";
echo "<option value='paypal'" . ($payment_method == 'paypal' ? ' selected' : '') . ">PayPal</option>";
echo "<option value='apple_pay'" . ($payment_method == 'apple_pay' ? ' selected' : '') . ">Apple Pay</option>";
echo "</select>";

echo "<br><br>";
echo "<button type='submit' style='background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;'>Confirm Order</button>";

echo "</form>";
?>