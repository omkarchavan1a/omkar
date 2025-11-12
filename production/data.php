<?php
session_start();
$car_id = $_POST['car-id'] ?? null;
$customer_name = $_POST['customer-name'] ?? null;

if (!$car_id || !$customer_name) {
    $_SESSION['error'] = "Missing required information";
    header("Location: return.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'rental');
if ($conn->connect_error) {
    $_SESSION['error'] = "Database connection failed: " . $conn->connect_error;
    header("Location: return.php");
    exit();
}

$stmt = $conn->prepare("INSERT INTO return_table(customer_name, car_id) VALUES(?, ?)");
if ($stmt) {
    $stmt->bind_param("ss", $customer_name, $car_id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Car has been returned successfully.";
    } else {
        $_SESSION['error'] = "Error executing query: " . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Error preparing statement: " . $conn->error;
}
$conn->close();

header("Location: return.php");
exit();
?>