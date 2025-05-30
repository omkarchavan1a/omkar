<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if message ID is provided
if (!isset($_POST['message_id']) || empty($_POST['message_id'])) {
    $_SESSION['error'] = "Message ID is required";
    header("Location: dashboard.php");
    exit();
}

// Get the message ID
$message_id = intval($_POST['message_id']);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'rental');
if ($conn->connect_error) {
    $_SESSION['error'] = "Database connection failed: " . $conn->connect_error;
    header("Location: dashboard.php");
    exit();
}

// Prepare and execute the delete query
$stmt = $conn->prepare("DELETE FROM info WHERE ID = ?");
if ($stmt) {
    $stmt->bind_param("i", $message_id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Message deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting message: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    $_SESSION['error'] = "Error preparing statement: " . $conn->error;
}

$conn->close();

// Redirect back to dashboard
header("Location: dashboard.php");
exit();
?>