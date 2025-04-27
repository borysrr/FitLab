<?php
session_start();
require_once 'session_handler.php';
$session = new SessionHandlerCustom();

require 'lib/functions.php';
require 'templates/header.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    echo "<h1 style='text-align: center;'>Checkout</h1>";
    echo "<p style='text-align: center; font-size: 18px;'>Your cart is empty. <a href='index.php'>Continue Shopping</a></p>";
    require 'templates/footer.php';
    exit;
}

// Calculate total if not set
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
    foreach ($_SESSION['cart'] as $item) {
        $_SESSION['total'] += $item['price'] * $item['quantity'];
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

    if (!$name) $form_errors[] = "Full Name is required.";
    if (!$address) $form_errors[] = "Address is required.";
    if (!$city) $form_errors[] = "City is required.";
    if (!$postal_code) $form_errors[] = "Postal Code is required.";
    if (!$phone_number) $form_errors[] = "Phone Number is required.";
    if (!in_array($payment_method, $valid_methods)) {
        $form_errors[] = "Please select a valid payment method.";
    }

    if ($form_errors) {
        echo "<h1 style='text-align: center;'>Please fix the following:</h1>";
        foreach ($form_errors as $error) {
            echo "<p style='text-align: center; color: red; font-size: 18px;'>$error</p>";
        }
    } else {
        $order_id = mt_rand(1000000000, 9999999999);

        try {
            require_once 'src/db_connect.php';

            // Insert order
            $stmt = $connection->prepare("
                INSERT INTO Orders (order_ID, total_cost, order_date, Users_user_ID) VALUES (?, ?, NOW(), ?) ");
            $stmt->execute([$order_id, $_SESSION['total'], $_SESSION['user_id']]);

            // Insert shipping/payment
            $stmt_shipping = $connection->prepare("
                INSERT INTO Shipping_and_Payment (name, phone_number, address, payment_type, confirmation, Orders_order_ID) VALUES (?, ?, ?, ?, ?, ?) ");
            $stmt_shipping->execute([
                $name, $phone_number, $address, $payment_method, 'confirmed', $order_id
            ]);

            // Clear cart
            unset($_SESSION['cart'], $_SESSION['total']);

            // Confirmation message
            echo "<h1 style='text-align: center;'>Order Confirmation</h1>";
            echo "<p style='text-align: center; font-size: 22px;'>Thank you, <strong>$name</strong>! Your order has been placed.</p>";
            echo "<p style='text-align: center;'>Order ID: <strong>$order_id</strong></p>";
            echo "<p style='text-align: center;'>Shipping to: <strong>$address, $city, $postal_code</strong></p>";
            echo "<p style='text-align: center;'>Payment Method: <strong>" . ucfirst(str_replace('_', ' ', $payment_method)) . "</strong></p>";
            echo "<p style='text-align: center;'>Phone Number: <strong>$phone_number</strong></p>";
            echo "<p style='text-align: center;'><a href='index.php'>Continue Shopping</a></p>";

        } catch (PDOException $error) {
            echo "<p style='color: red;'>Error: " . $error->getMessage() . "</p>";
        }
        require 'templates/footer.php';
        exit;
    }
}

// Checkout Form
?>

<h1 style='text-align: center;'>Checkout</h1>

<form action='checkout.php' method='POST' style='width: 60%; margin: auto; text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background: #f9f9f9;'>

    <?php
    $fields = [
        'name' => 'Full Name',
        'address' => 'Address',
        'city' => 'City',
        'postal_code' => 'Postal Code',
        'phone_number' => 'Phone Number'
    ];

    foreach ($fields as $field => $label) {
        echo "<label style='display: block; margin: 10px; font-weight: bold;'>$label:</label>";
        echo "<input type='text' name='$field' value='" . htmlspecialchars($$field ?? '') . "' style='padding: 10px; width: 80%; border-radius: 5px; border: 1px solid #ccc;'>";
    }
    ?>

    <label style='display: block; margin: 10px; font-weight: bold;'>Payment Method:</label>
    <select name='payment_method' style='padding: 10px; width: 80%; border-radius: 5px;'>
        <option value='credit_card'<?= $payment_method == 'credit_card' ? ' selected' : '' ?>>Credit Card</option>
        <option value='paypal'<?= $payment_method == 'paypal' ? ' selected' : '' ?>>PayPal</option>
        <option value='apple_pay'<?= $payment_method == 'apple_pay' ? ' selected' : '' ?>>Apple Pay</option>
    </select>

    <br><br>
    <button type='submit' style='background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;'>
        Confirm Order
    </button>
</form>

<?php
require 'templates/footer.php';
?>