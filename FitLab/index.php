<?php
require 'lib/functions.php';
?>
<?php require 'layout/header.php'; ?>

<?php

// Add some text below
echo "<div style='text-align: center; margin-top: 30px;'>";
echo "<h1 style='color: red;'>Sale 20% OFF</h1>";

// Adjust the image size by setting a smaller width (e.g., 50%)
echo "<img src='/images/sale.png' alt='Sale Image' style='max-width: 55%; height: auto; margin-top: 20px;'>";

echo "</div>";

echo "<div style='text-align: center; margin-top: 50px;'>";
echo "<h3>Welcome to FitLab</h3>";
echo "</div>";

// Row of product images (centered)
echo "<div style='display: flex; justify-content: center; align-items: center; gap: 20px; margin-top: 50px;'>";

// Creatine Image
echo "<div style='flex: 1; text-align: center;'>";
echo "<img src='/images/creatine.png' alt='Creatine' style='width: 200px; height: auto;'>";
echo "<p>Creatine</p>";
echo "<p style='font-weight: bold;'>$29.99</p>";  // Price added
echo "</div>";

// Protein Powder Image
echo "<div style='flex: 1; text-align: center;'>";
echo "<img src='/images/protein.png' alt='Protein Powder' style='width: 200px; height: auto;'>";
echo "<p>Protein Powder</p>";
echo "<p style='font-weight: bold;'>$49.99</p>";  // Price added
echo "</div>";

// Jumper Image
echo "<div style='flex: 1; text-align: center;'>";
echo "<img src='/images/jumper.png' alt='Jumper' style='width: 200px; height: auto;'>";
echo "<p>Jumper</p>";
echo "<p style='font-weight: bold;'>$59.99</p>";  // Price added
echo "</div>";

echo "</div>";

?>

<?php
echo "<div style='text-align: center; margin-top: 50px;'>";
    echo "<a href='contact.php' style='margin: 0 10px;'>Contacts</a>";
    echo "</div>";
    ?>

<?php require 'layout/footer.php'; ?>
