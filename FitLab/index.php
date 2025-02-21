<?php
require 'lib/functions.php';
?>
<?php require 'layout/header.php'; ?>

<?php

// Add some text below
echo "<div style='text-align: center; margin-top: 30px;'>";
echo "<h1 style='color: red;'>Sale 20% OFF</h1>";

// Add an image below the text
echo "<img src='images/sale.png' alt='Sale Image' style='max-width: 100%; height: auto; margin-top: 20px;'>";

echo "</div>";

echo "<div style='text-align: center; margin-top: 50px;'>";
echo "<h3>Welcome to FitLab</h3>";
echo "<a href='contact.php' style='margin: 0 10px;'>Contacts</a>";
echo "</div>";

?>

<?php require 'layout/footer.php'; ?>
