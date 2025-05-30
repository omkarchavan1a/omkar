<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    $_SESSION['error'] = 'Unauthorized access';
    header('Location: dashboard.php');
    exit();
}

if (!isset($_POST['rental_id']) || !is_numeric($_POST['rental_id'])) {
    $_SESSION['error'] = 'Invalid rental ID';
    header('Location: dashboard.php');
    exit();
}

$rental_id = (int)$_POST['rental_id'];

$stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
$stmt->bind_param("i", $rental_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Rental successfully removed';
    } else {
        $_SESSION['error'] = 'No rental found with that ID';
    }
} else {
    $_SESSION['error'] = 'Error deleting rental: ' . $conn->error;
}

$stmt->close();
$conn->close();

header('Location: dashboard.php');
exit();
?>