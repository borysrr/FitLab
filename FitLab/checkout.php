<?php
session_start();
require 'lib/functions.php';
require 'templates/header.php';

if (empty($_SESSION['cart'])) {
    echo "<h1 style='text-align: center;'>Checkout</h1>";
    echo "<p style='text-align: center; font-size: 18px;'>Your cart is empty. <a href='index.php'>Continue Shopping</a></p>";
    require 'templates/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postal_code = trim($_POST['postal_code'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');  // Changed from email to phone_number
    $payment_method = $_POST['payment_method'] ?? '';
    $valid_methods = ['credit_card', 'paypal', 'apple_pay'];

    // Validate required fields
    if (empty($name) || empty($address) || empty($city) || empty($postal_code) || empty($phone_number) || !in_array($payment_method, $valid_methods)) {
        echo "<h1 style='text-align: center;'>Checkout</h1>";
        echo "<p style='text-align: center; color: red; font-size: 18px;'>Please fill in all required fields and select a valid payment method.</p>";
        echo "<p style='text-align: center;'><a href='checkout.php'>Go Back</a></p>";
        require 'templates/footer.php';
        exit;
    }

    // Generate a random order ID
    $order_id = uniqid('order_');  // Generate a unique order ID (you can customize the prefix)

    // Simulate order confirmation
    echo "<h1 style='text-align: center;'>Order Confirmation</h1>";
    echo "<p style='text-align: center; font-size: 18px;'>Thank you, $name! Your order has been placed successfully.</p>";
    echo "<p style='text-align: center; font-size: 16px;'>Order ID: $order_id</p>";  // Display generated order ID
    echo "<p style='text-align: center; font-size: 16px;'>Shipping to: $address, $city, $postal_code</p>";
    echo "<p style='text-align: center; font-size: 16px;'>Payment Method: " . ucfirst(str_replace('_', ' ', $payment_method)) . "</p>";
    echo "<p style='text-align: center; font-size: 16px;'>Phone Number: $phone_number</p>";  // Display phone number
    echo "<p style='text-align: center;'><a href='index.php'>Continue Shopping</a></p>";

    // Clear the cart
    unset($_SESSION['cart']);
} else {
    // Checkout form
    echo "<h1 style='text-align: center;'>Checkout</h1>";
    echo "<form action='checkout.php' method='POST' style='width: 60%; margin: auto; text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background: #f9f9f9;'>";

    echo "<label style='display: block; margin: 10px; font-weight: bold;'>Full Name:</label>";
    echo "<input type='text' name='name' required style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

    echo "<label style='display: block; margin: 10px; font-weight: bold;'>Address:</label>";
    echo "<input type='text' name='address' required style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

    echo "<label style='display: block; margin: 10px; font-weight: bold;'>City:</label>";
    echo "<input type='text' name='city' required style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

    echo "<label style='display: block; margin: 10px; font-weight: bold;'>Postal Code:</label>";
    echo "<input type='text' name='postal_code' required style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

    echo "<label style='display: block; margin: 10px; font-weight: bold;'>Phone Number:</label>";
    echo "<input type='text' name='phone_number' required style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";

    echo "<label style='display: block; margin: 10px; font-weight: bold;'>Payment Method:</label>";
    echo "<select name='payment_method' required style='padding: 10px; width: 80%; border-radius: 5px;'>";
    echo "<option value='credit_card'>Credit Card</option>";
    echo "<option value='paypal'>PayPal</option>";
    echo "<option value='apple_pay'>Apple Pay</option>";
    echo "</select>";

    echo "<br><br>";
    echo "<button type='submit' style='background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;'>Confirm Order</button>";

    echo "</form>";
}
?>
