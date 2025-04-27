<?php
require_once 'src/db_connect.php';

// Unified delete handler
function handleDelete($connection, $postKey, $dbField, $table, $redirectFlag) {
    if (isset($_POST[$postKey])) {
        $id = $_POST[$dbField];
        try {
            $sql = "DELETE FROM $table WHERE $dbField = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$id]);
            header("Location: delete.php?deleted=$redirectFlag");
            exit;
        } catch (PDOException $error) {
            echo "Error deleting from $table: " . $error->getMessage();
        }
    }
}

handleDelete($connection, 'delete_contact', 'contact_form_sub_ID', 'Contact_form_sub', 'contact');
handleDelete($connection, 'delete_order', 'order_ID', 'Orders', 'order');
handleDelete($connection, 'delete_product', 'product_ID', 'Products', 'product');
handleDelete($connection, 'delete_shipping', 'Shipping_ID', 'Shipping_and_Payment', 'shipping');
handleDelete($connection, 'delete_user', 'user_ID', 'Users', 'user');

// Fetch all
function fetchAll($connection, $table) {
    $stmt = $connection->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll();
}

$contacts = fetchAll($connection, 'Contact_form_sub');
$orders = fetchAll($connection, 'Orders');
$products = fetchAll($connection, 'Products');
$shipping = fetchAll($connection, 'Shipping_and_Payment');
$users = fetchAll($connection, 'Users');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Entries</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h2>Delete Entries</h2>

<?php if (isset($_GET["deleted"])): ?>
    <p style="color: green;">
        <?= ucfirst($_GET["deleted"]) ?> successfully deleted!
    </p>
<?php endif; ?>

<?php
function renderTable($title, $headers, $rows, $idField, $deleteName, $fieldsToShow) {
    echo "<h3>$title</h3><table border='1'><tr>";
    foreach ($headers as $header) echo "<th>$header</th>";
    echo "<th>Actions</th></tr>";

    foreach ($rows as $row) {
        echo "<tr><form method='post'>";
        foreach ($fieldsToShow as $field) {
            echo "<td>" . htmlspecialchars($row[$field]) . "</td>";
        }
        echo "<td>
                <input type='hidden' name='$idField' value='{$row[$idField]}'>
                <button type='submit' name='$deleteName' onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</button>
              </td></form></tr>";
    }

    echo "</table>";
}

// Render all sections
renderTable("Delete Contact Form Submissions", ["Submission ID", "First Name", "Email", "Message", "Submission Date"], $contacts, 'contact_form_sub_ID', 'delete_contact', ['contact_form_sub_ID', 'first_name', 'email', 'message', 'sub_date']);
renderTable("Delete Orders", ["Order ID", "Total Cost", "Order Date", "User ID"], $orders, 'order_ID', 'delete_order', ['order_ID', 'total_cost', 'order_date', 'Users_user_ID']);
renderTable("Delete Products", ["Product ID", "Name", "Description", "Price", "Stock Quantity"], $products, 'product_ID', 'delete_product', ['product_ID', 'name', 'description', 'price', 'stock_quantity']);
renderTable("Delete Shipping and Payment", ["Shipping ID", "Name", "Phone", "Address", "Payment", "Confirmation", "Order ID"], $shipping, 'Shipping_ID', 'delete_shipping', ['Shipping_ID', 'name', 'phone_number', 'address', 'payment_type', 'confirmation', 'Orders_order_ID']);
renderTable("Delete Users", ["User ID", "Email"], $users, 'user_ID', 'delete_user', ['user_ID', 'email']);
?>

<a href="index.php">Back to home</a>
</body>
</html>