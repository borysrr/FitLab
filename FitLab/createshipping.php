<?php
if (isset($_POST['submit'])) {
    require "common.php";
    try {
        require_once 'src/db_connect.php';

        $new_shipping = array(
            "name" => escape($_POST['name']),
            "phone_number" => escape($_POST['phone_number']),
            "address" => escape($_POST['address']),
            "payment_type" => escape($_POST['payment_type']),
            "confirmation" => escape($_POST['confirmation']),
            "Orders_order_ID" => escape($_POST['Orders_order_ID'])
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "Shipping_and_Payment",
            implode(", ", array_keys($new_shipping)),
            ":" . implode(", :", array_keys($new_shipping))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_shipping);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

require "templates/header.php";

if (isset($_POST['submit']) && $statement) {
    echo "Shipping information successfully added!";
}
?>

<h2>Add Shipping Details</h2>
<form method="post">
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

    <label for="Orders_order_ID">Order ID</label>
    <input type="text" name="Orders_order_ID" id="Orders_order_ID" required>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>