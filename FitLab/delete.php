<?php
// Include the database connection to interact with the database
require_once 'src/db_connect.php';

// Unified delete handler function
function handleDelete($connection, $postKey, $dbField, $table, $redirectFlag) {
    // Check if the form has been submitted for a delete action
    if (isset($_POST[$postKey])) {
        // Get the ID to delete from the POST data
        $id = $_POST[$dbField];
        try {
            // Prepare SQL query to delete the record by its ID from the specified table
            $sql = "DELETE FROM $table WHERE $dbField = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$id]); // Execute the delete statement

            // Redirect with a success message indicating which record was deleted
            header("Location: delete.php?deleted=$redirectFlag");
            exit;
        } catch (PDOException $error) {
            // Catch any errors and display an error message
            echo "Error deleting from $table: " . $error->getMessage();
        }
    }
}

// Call the handleDelete function for various entities like contacts, orders, products, shipping, and users
handleDelete($connection, 'delete_contact', 'contact_form_sub_ID', 'Contact_form_sub', 'contact');
handleDelete($connection, 'delete_order', 'order_ID', 'Orders', 'order');
handleDelete($connection, 'delete_product', 'product_ID', 'Products', 'product');
handleDelete($connection, 'delete_shipping', 'Shipping_ID', 'Shipping_and_Payment', 'shipping');
handleDelete($connection, 'delete_user', 'user_ID', 'Users', 'user');

// Fetch all records from different tables
function fetchAll($connection, $table) {
    // Prepare and execute the SQL query to fetch all data from the specified table
    $stmt = $connection->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(); // Return the fetched data as an associative array
}

// Fetch all records for different tables
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
    <!-- Display a success message if a record has been successfully deleted -->
    <p style="color: green;">
        <?= ucfirst($_GET["deleted"]) ?> successfully deleted!
    </p>
<?php endif; ?>

<?php
// Function to render tables dynamically for each type of entity
function renderTable($title, $headers, $rows, $idField, $deleteName, $fieldsToShow) {
    echo "<h3>$title</h3><table border='1'><tr>";

    // Render table headers
    foreach ($headers as $header) echo "<th>$header</th>";
    echo "<th>Actions</th></tr>";

    // Render table rows and a delete button for each row
    foreach ($rows as $row) {
        echo "<tr><form method='post'>"; // Start form for each row to handle delete action
        foreach ($fieldsToShow as $field) {
            // Display data for each field specified
            echo "<td>" . htmlspecialchars($row[$field]) . "</td>";
        }
        echo "<td>
                <input type='hidden' name='$idField' value='{$row[$idField]}'>
                <button type='submit' name='$deleteName' onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</button>
              </td></form></tr>";
    }

    echo "</table>";
}

// Render tables for each entity (contacts, orders, products, shipping, and users)
renderTable("Delete Contact Form Submissions", ["Submission ID", "First Name", "Email", "Message", "Submission Date"], $contacts, 'contact_form_sub_ID', 'delete_contact', ['contact_form_sub_ID', 'first_name', 'email', 'message', 'sub_date']);
renderTable("Delete Orders", ["Order ID", "Total Cost", "Order Date", "User ID"], $orders, 'order_ID', 'delete_order', ['order_ID', 'total_cost', 'order_date', 'Users_user_ID']);
renderTable("Delete Products", ["Product ID", "Name", "Description", "Price", "Stock Quantity"], $products, 'product_ID', 'delete_product', ['product_ID', 'name', 'description', 'price', 'stock_quantity']);
renderTable("Delete Shipping and Payment", ["Shipping ID", "Name", "Phone", "Address", "Payment", "Confirmation", "Order ID"], $shipping, 'Shipping_ID', 'delete_shipping', ['Shipping_ID', 'name', 'phone_number', 'address', 'payment_type', 'confirmation', 'Orders_order_ID']);
renderTable("Delete Users", ["User ID", "Email"], $users, 'user_ID', 'delete_user', ['user_ID', 'email']);
?>

<!-- Link to go back to the home page -->
<a href="index.php">Back to home</a>
</body>
</html>