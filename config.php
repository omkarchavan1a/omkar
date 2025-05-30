<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'car_rental');

// Security configuration
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection function
function getDBConnection() {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            error_log("Database connection failed: " . $conn->connect_error);
            die("Connection failed. Please try again later.");
        }
        $conn->set_charset("utf8mb4");
    }
    return $conn;
}

// Security functions
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateFileUpload($file) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'File upload error'];
    }
    
    if (!in_array($file['type'], ALLOWED_FILE_TYPES)) {
        return ['status' => false, 'message' => 'Invalid file type'];
    }
    
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        return ['status' => false, 'message' => 'File too large'];
    }
    
    return ['status' => true, 'message' => 'File valid'];
}
?>
