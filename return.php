<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Check if user is admin
if (!isset($_SESSION["is_admin"]) || !$_SESSION["is_admin"]) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return car</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Return a Car</h2>
        
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="message success">' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="message error">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="data.php" method="post">
            <div class="form-group">
                <label for="car-id">Car ID:</label>
                <select id="car-id" name="car-id" required>
            <option value="">Choose a car</option>
            <option value="C001">Maruti Suzuki Swift</option>
            <option value="C002">Honda Accord</option>
            <option value="C003">Hyundai Elantra</option>
            <option value="C004">Tata Punch</option>
            <option value="C005">Tata Harrier</option>
            <option value="C006">Tata Safari</option>
          </select>
            </div>
            <div class="form-group">
                <label for="customer-name">Customer Name:</label>
                <input type="text" id="customer-name" name="customer-name" placeholder="Enter customer name" required>
            </div>
            <div class="form-group">
                <button type="submit">Return Car</button>
                <a href="index.php" class="button">Back to Home</a>
            </div>
        </form>
    </div>
</body>
</html>