<?php
require_once 'src/db_connect.php';

// Handle contact form submission deletion
if (isset($_POST['delete_contact'])) {
    $contact_id = $_POST['contact_form_sub_ID'];
    try {
        $sql = "DELETE FROM Contact_form_sub WHERE contact_form_sub_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$contact_id]);
        header("Location: delete.php?deleted=contact");
        exit;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

// Handle order deletion
if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_ID'];
    try {
        $sql = "DELETE FROM Orders WHERE order_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$order_id]);
        header("Location: delete.php?deleted=order");
        exit;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

// Handle product deletion
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_ID'];
    try {
        $sql = "DELETE FROM Products WHERE product_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$product_id]);
        header("Location: delete.php?deleted=product");
        exit;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

// Handle shipping/payment deletion
if (isset($_POST['delete_shipping'])) {
    $shipping_id = $_POST['Shipping_ID'];
    try {
        $sql = "DELETE FROM Shipping_and_Payment WHERE Shipping_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$shipping_id]);
        header("Location: delete.php?deleted=shipping");
        exit;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

// Handle user deletion
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_ID'];
    try {
        $sql = "DELETE FROM Users WHERE user_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$user_id]);
        header("Location: delete.php?deleted=user");
        exit;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

// Fetch all data from tables
$contact_sql = "SELECT * FROM Contact_form_sub";
$contact_statement = $connection->prepare($contact_sql);
$contact_statement->execute();
$contacts = $contact_statement->fetchAll();

$order_sql = "SELECT * FROM Orders";
$order_statement = $connection->prepare($order_sql);
$order_statement->execute();
$orders = $order_statement->fetchAll();

$product_sql = "SELECT * FROM Products";
$product_statement = $connection->prepare($product_sql);
$product_statement->execute();
$products = $product_statement->fetchAll();

$shipping_sql = "SELECT * FROM Shipping_and_Payment";
$shipping_statement = $connection->prepare($shipping_sql);
$shipping_statement->execute();
$shipping = $shipping_statement->fetchAll();

$user_sql = "SELECT * FROM Users";
$user_statement = $connection->prepare($user_sql);
$user_statement->execute();
$users = $user_statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Entries</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Delete Entries</h2>

<!-- Success Messages -->
<?php if (isset($_GET["deleted"])): ?>
    <p style="color: green;">
        <?php
        if ($_GET["deleted"] == 'contact') echo "Contact form submission successfully deleted!";
        elseif ($_GET["deleted"] == 'order') echo "Order successfully deleted!";
        elseif ($_GET["deleted"] == 'product') echo "Product successfully deleted!";
        elseif ($_GET["deleted"] == 'shipping') echo "Shipping/Payment successfully deleted!";
        elseif ($_GET["deleted"] == 'user') echo "User successfully deleted!";
        ?>
    </p>
<?php endif; ?>

<!-- Delete Contact Form Submissions Section -->
<h3>Delete Contact Form Submissions</h3>
<table border="1">
    <tr>
        <th>Submission ID</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submission Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($contacts as $row): ?>
        <tr>
            <form method="post">
                <td><?= $row['contact_form_sub_ID'] ?></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['message'] ?></td>
                <td><?= $row['sub_date'] ?></td>
                <td>
                    <input type="hidden" name="contact_form_sub_ID" value="<?= $row['contact_form_sub_ID'] ?>">
                    <button type="submit" name="delete_contact" onclick="return confirm('Are you sure you want to delete this submission?');">
                        Delete
                    </button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Delete Orders Section -->
<h3>Delete Orders</h3>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Total Cost</th>
        <th>Order Date</th>
        <th>User ID</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $row): ?>
        <tr>
            <form method="post">
                <td><?= $row['order_ID'] ?></td>
                <td><?= $row['total_cost'] ?></td>
                <td><?= $row['order_date'] ?></td>
                <td><?= $row['Users_user_ID'] ?></td>
                <td>
                    <input type="hidden" name="order_ID" value="<?= $row['order_ID'] ?>">
                    <button type="submit" name="delete_order" onclick="return confirm('Are you sure you want to delete this order?');">
                        Delete
                    </button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Delete Products Section -->
<h3>Delete Products</h3>
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock Quantity</th>
        <th>Order ID</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $row): ?>
        <tr>
            <form method="post">
                <td><?= $row['product_ID'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['stock_quantity'] ?></td>
                <td><?= $row['Orders_order_ID'] ?></td>
                <td>
                    <input type="hidden" name="product_ID" value="<?= $row['product_ID'] ?>">
                    <button type="submit" name="delete_product" onclick="return confirm('Are you sure you want to delete this product?');">
                        Delete
                    </button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Delete Shipping/Payment Section -->
<h3>Delete Shipping and Payment</h3>
<table border="1">
    <tr>
        <th>Shipping ID</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Payment Type</th>
        <th>Confirmation</th>
        <th>Order ID</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($shipping as $row): ?>
        <tr>
            <form method="post">
                <td><?= $row['Shipping_ID'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['phone_number'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['payment_type'] ?></td>
                <td><?= $row['confirmation'] ?></td>
                <td><?= $row['Orders_order_ID'] ?></td>
                <td>
                    <input type="hidden" name="Shipping_ID" value="<?= $row['Shipping_ID'] ?>">
                    <button type="submit" name="delete_shipping" onclick="return confirm('Are you sure you want to delete this shipping/payment?');">
                        Delete
                    </button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Delete Users Section -->
<h3>Delete Users</h3>
<table border="1">
    <tr>
        <th>User ID</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $row): ?>
        <tr>
            <form method="post">
                <td><?= htmlspecialchars($row['user_ID']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <input type="hidden" name="user_ID" value="<?= $row['user_ID'] ?>">
                    <button type="submit" name="delete_user" onclick="return confirm('Are you sure you want to delete this user?');">
                        Delete
                    </button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php">Back to home</a>
</body>
</html>