<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user"]) || $_SESSION["user"] !== "yes") {
    header("Location: login.php");
    exit();
}

// For admin-only pages, add this check
function checkAdmin() {
    if (!isset($_SESSION["user_email"]) || $_SESSION["user_email"] !== "admin@gmail.com") {
        header("Location: index.php");
        exit();
    }
}
?>
