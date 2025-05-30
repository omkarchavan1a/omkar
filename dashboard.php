<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session for admin authentication
session_start();
// Database connection
$conn = new mysqli('localhost', 'root', '', 'rental');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Include CSS file
echo "<link rel='stylesheet' href='dashboard.css'>";
echo "<link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";

// Query to fetch customer rentals and statistics
$rentals = $conn->query("SELECT id, customer_name, car_id, mobile_number, rental_days, booking_date, created_at FROM cars");
$total_rentals = $rentals->num_rows;
$active_rentals = $conn->query("SELECT COUNT(*) as count FROM cars WHERE booking_date <= CURDATE() AND DATE_ADD(booking_date, INTERVAL rental_days DAY) >= CURDATE()")->fetch_assoc()['count'];
$total_revenue = $conn->query("SELECT SUM(rental_days * 1000) as revenue FROM cars")->fetch_assoc()['revenue'] ?? 0;

// Start dashboard container
echo "<div class='dashboard-container'>";

// Display success/error messages if set
if (isset($_SESSION['success'])) {
    echo "<div class='message success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<div class='message error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
    unset($_SESSION['error']);
}

// Header Section
echo "<div class='dashboard-header'>";
echo "<div class='welcome-section'>Welcome, Admin!</div>";
echo "</div>";

// Stats Cards Section
echo "<div class='stats-container'>";
echo "<div class='stat-card'>";
echo "<h3>Total Rentals</h3>";
echo "<div class='value'>$total_rentals</div>";
echo "</div>";

echo "<div class='stat-card'>";
echo "<h3>Active Rentals</h3>";
echo "<div class='value'>$active_rentals</div>";
echo "</div>";

echo "<div class='stat-card'>";
echo "<h3>Total Revenue</h3>";
echo "<div class='value'>₹$total_revenue</div>";
echo "</div>";
echo "</div>";

// Booking Graph Section
echo "<div class='graph-section'>";
echo "<div class='graph-header'>";
echo "<h2>Booking Trends</h2>";
echo "</div>";
echo "<canvas id='bookingGraph'></canvas>";
echo "</div>";

// Car Status Section
echo "<div class='car-status-section'>";
echo "<div class='car-status-header'>";
echo "<h2>Car Rentals</h2>";
echo "</div>";

// Display Customer Rentals Section
echo "<div class='car-list'>";

if ($rentals->num_rows > 0) {
    while ($rental = $rentals->fetch_assoc()) {
        $isActive = strtotime($rental['booking_date']) <= time() && 
                    strtotime($rental['booking_date'] . ' + ' . $rental['rental_days'] . ' days') >= time();
        
        echo "<div class='car-item'>";
        echo "<div class='car-info'>";
        echo "<div>";
        echo "<h4>" . htmlspecialchars($rental['customer_name']) . "</h4>";
        echo "<p>Car ID: " . htmlspecialchars($rental['car_id']) . "</p>";
        echo "<p>Mobile: " . htmlspecialchars($rental['mobile_number']) . "</p>";
        echo "</div>";
        echo "</div>";
        echo "<div>";
        echo "<span class='status-indicator " . ($isActive ? 'status-active' : 'status-inactive') . "'>";
        echo $isActive ? 'Active' : 'Completed';
        echo "</span>";
        echo "<p>" . htmlspecialchars($rental['rental_days']) . " days</p>";
        echo "<p>From: " . htmlspecialchars($rental['booking_date']) . "</p>";
        echo "<form action='remove_rental.php' method='post' style='margin-top: 10px;'>";
        echo "<input type='hidden' name='rental_id' value='" . $rental['id'] . "'>";
        echo "<button type='submit' class='action-button'>Remove Rental</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    
    while ($rental = $rentals->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($rental['customer_name']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['car_id']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['mobile_number']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['rental_days']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['booking_date']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['created_at']) . "</td>";
        echo "</tr>";
    }

} else {
    echo "<p class='no-rentals'>No active rentals found.</p>";
}

// Payment Screenshots Section
echo "<div class='screenshot-section'>";
echo "<div class='section-header'>";
echo "<h2>Payment Screenshots</h2>";
echo "</div>";

$screenshots = $conn->query("SELECT file_name, file_size, file_type, file_content FROM payment_screenshots");

if ($screenshots !== false && $screenshots->num_rows > 0) {
    echo "<div class='screenshot-grid'>";
    while ($row = $screenshots->fetch_assoc()) {
        echo "<div class='screenshot-card'>";
        echo "<div class='screenshot-preview'>";
        echo "<img src='data:" . htmlspecialchars($row['file_type']) . ";base64," . htmlspecialchars($row['file_content']) . "' alt='" . htmlspecialchars($row['file_name']) . "' />";
        echo "</div>";
        echo "<div class='screenshot-info'>";
        echo "<h4>" . htmlspecialchars($row['file_name']) . "</h4>";
        echo "<p>Size: " . round(htmlspecialchars($row['file_size']) / 1024, 2) . " KB</p>";
        echo "<form action='remove_screenshot.php' method='post'>";
        echo "<input type='hidden' name='file_name' value='" . htmlspecialchars($row['file_name']) . "'>";
        echo "<button type='submit' class='action-button'>Remove</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<div class='empty-state'>";
    echo "<p>No payment screenshots uploaded yet</p>";
    echo "</div>";
}
echo "</div>";

// User Messages Section from info table
echo "<div class='user-messages-section'>";
echo "<div class='section-header'>";
echo "<h2>User Messages</h2>";
echo "</div>";

// Fetch all data from info table
$userMessages = $conn->query("SELECT * FROM info ORDER BY id DESC");

if ($userMessages !== false && $userMessages->num_rows > 0) {
    echo "<div class='message-list'>";
    while ($message = $userMessages->fetch_assoc()) {
        echo "<div class='message-item'>";
        echo "<div class='message-header'>";
        echo "<h4>" . htmlspecialchars($message['name']) . "</h4>";
        echo "<p>Email: " . htmlspecialchars($message['email']) . "</p>";
        echo "<p>Phone: " . htmlspecialchars($message['phone']) . "</p>";
        if (!empty($message['website'])) {
            echo "<p>Website: " . htmlspecialchars($message['website']) . "</p>";
        }
        echo "</div>";
        echo "<div class='message-content'>";
        echo "<p>" . htmlspecialchars($message['message']) . "</p>";
        echo "</div>";
        echo "<div class='message-actions'>";
        echo "<form action='delete_message.php' method='post'>";
        echo "<input type='hidden' name='message_id' value='" . $message['ID'] . "'>";
        echo "<button type='submit' class='remove-button'>Remove</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<div class='empty-state'>";
    echo "<p>No messages received yet</p>";
    echo "</div>";
}
echo "</div>";

// Fetch booking data for graph
$bookingData = $conn->query("SELECT DATE(booking_date) as date, COUNT(*) as count FROM cars GROUP BY DATE(booking_date) ORDER BY date DESC LIMIT 7");
$dates = [];
$counts = [];

while ($row = $bookingData->fetch_assoc()) {
    array_unshift($dates, $row['date']);
    array_unshift($counts, $row['count']);
}

// Add graph initialization script
echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('bookingGraph').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['" . implode("', '", $dates) . "'],
                datasets: [{
                    label: 'Daily Bookings',
                    data: [" . implode(", ", $counts) . "],
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>";

$conn->close();
