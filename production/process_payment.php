<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['screenshot']['tmp_name'];
        $fileName = $_FILES['screenshot']['name'];
        $fileSize = $_FILES['screenshot']['size'];
        $fileType = $_FILES['screenshot']['type'];
        
        // Validate file type (e.g., only allow images)
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedFileTypes)) {
            // Read the file content
            $fileContent = file_get_contents($fileTmpPath);
            $fileContent = base64_encode($fileContent); // Encode the file content
            
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'rental');
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            } else {
                // Prepare SQL statement to insert screenshot data
                $stmt = $conn->prepare("INSERT INTO payment_screenshots (file_name, file_size, file_type, file_content) VALUES (?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("siss", $fileName, $fileSize, $fileType, $fileContent);
                    $stmt->execute();
                    $stmt->close();
                echo "<i><h1>Screenshot submitted successfully.</h1></i>";
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
                $conn->close();
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Error uploading file.";
    }
}?>

