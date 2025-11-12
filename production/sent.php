<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$website = $_POST['website']; 
$message = $_POST['message'];

// database connection
$conn = new mysqli('localhost', 'root', '', 'rental');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO info (name, email, phone, website, message) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssiss", $name, $email, $phone, $website, $message);
        $stmt->execute();
        echo "Successfully sent";
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
}
?>