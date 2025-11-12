<?php
// Database configuration constants
define('DB_HOST', 'localhost');  // Change to your database host
define('DB_USER', 'root');       // Change to your database username
define('DB_PASS', '');           // Change to your database password
define('DB_NAME', 'car_rental'); // Change to your database name

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set
mysqli_set_charset($conn, "utf8");

// Uncomment for debugging
// echo "Database connected successfully";
?>