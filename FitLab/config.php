<?php
// Link the database with the website
$host = "localhost";
$username = "root";
$password = "";
$dbname = "FitLab";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);