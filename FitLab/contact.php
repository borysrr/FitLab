<?php
require 'lib/functions.php';
?>
<?php require 'templates/header.php'; ?>

<div style='text-align: center; margin-top: 50px;'>
    <h1>Contact Form</h1>
    <p>If you're facing any issues, please fill out the form below, and we'll get back to you.</p>

    <form action="submit_form.php" method="post" style="display: inline-block; text-align: left; margin-top: 20px;">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required style="width: 300px; padding: 5px;"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required style="width: 300px; padding: 5px;"><br><br>

        <label for="description">Describe Your Issue:</label><br>
        <textarea id="description" name="description" rows="5" required style="width: 300px; padding: 5px;"></textarea><br><br>

        <button type="submit" style="background-color: lightgreen; color: white; padding: 10px 20px; border: none; cursor: pointer;">Submit</button>
    </form>
</div>