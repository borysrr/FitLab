<?php
// Include the helper functions file
require 'lib/functions.php';
?>

<?php
// Include the website's header template
require 'templates/header.php';
?>

<!-- Main content container, centered and spaced from the top -->
<div style='text-align: center; margin-top: 50px;'>

    <!-- Page title and description -->
    <h1>Contact Form</h1>
    <p>If you're facing any issues, please fill out the form below, and we'll get back to you.</p>

    <?php if (isset($_GET["success"])): ?>
        <!-- Show success message after form is submitted -->
        <p style="color: green; text-align: center;">Form submitted successfully!</p>
    <?php endif; ?>

    <!-- Start of contact form -->
    <form action="submit_form.php" method="post" style="display: inline-block; text-align: left; margin-top: 20px;">

        <!-- Name field input -->
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required style="width: 300px; padding: 5px;"><br><br>

        <!-- Email field input -->
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required style="width: 300px; padding: 5px;"><br><br>

        <!-- Description textarea for the user to describe their issue -->
        <label for="description">Describe Your Issue:</label><br>
        <textarea id="description" name="description" rows="5" required style="width: 300px; padding: 5px;"></textarea><br><br>

        <!-- Submit button styled with color and spacing -->
        <button type="submit" style="background-color: lightgreen; color: white; padding: 10px 20px; border: none; cursor: pointer;">Submit</button>
    </form>
</div>