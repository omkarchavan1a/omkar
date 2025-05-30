<?php
session_start();
require_once 'db_connect.php';

if (!isset($_POST['file_name'])) {
    $_SESSION['error'] = "Invalid request";
    header("Location: dashboard.php");
    exit();
}

$file_name = $_POST['file_name'];

$stmt = $conn->prepare("DELETE FROM payment_screenshots WHERE file_name = ?");
$stmt->bind_param("s", $file_name);

if ($stmt->execute()) {
    $_SESSION['success'] = "Screenshot removed successfully.";
} else {
    $_SESSION['error'] = "Error removing screenshot: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit();
?>