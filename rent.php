<?php
require_once "check_auth.php";
require_once "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer-name'];
    $car_id = $_POST['car-id'];
    $mobile_number = $_POST['mobile_number'];
    $rental_days = $_POST['rental-days'];
    $booking_date = $_POST['booking_date']; 
    
    // Calculate total amount based on car price and rental days
    $car_prices = array(
        'C001' => 500,
        'C002' => 600,
        'C003' => 700,
        'C004' => 800,
        'C005' => 1000,
        'C006' => 1100
    );
    
    $total_amount = $car_prices[$car_id] * $rental_days;
    
    if (!preg_match("/^[6-9]\d{9}$/", $mobile_number)) {
        echo "Invalid mobile number. Please enter a valid 10-digit Indian mobile number.";
        exit();
    }
    
    $sql = "INSERT INTO cars (customer_name, car_id, mobile_number, rental_days, booking_date, total_amount, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiss", $customer_name, $car_id, $mobile_number, $rental_days, $booking_date, $total_amount);
    if ($stmt->execute()) {
        $rental_id = $conn->insert_id;
        header("Location: invoice.php?rental_id=" . $rental_id . 
               "&customer_name=" . urlencode($customer_name) .
               "&car_id=" . urlencode($car_id) .
               "&mobile_number=" . urlencode($mobile_number) .
               "&rental_days=" . urlencode($rental_days) .
               "&total_amount=" . urlencode($total_amount) .
               "&booking_date=" . urlencode($booking_date)); 
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rent a Car</title>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Jost', sans-serif;
    }

    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .container {
      width: 100%;
      max-width: 800px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      padding: 40px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
    }

    .form-section {
      padding-right: 40px;
    }

    .image-section {
      background: #ff6b6b;
      border-radius: 8px;
      padding: 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
    }

    h1 {
      color: #333;
      margin-bottom: 30px;
      font-size: 28px;
      font-weight: 600;
    }

    .form-group {
      margin-bottom: 24px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #555;
      font-weight: 500;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 12px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    select:focus {
      border-color: #ff6b6b;
      outline: none;
    }

    button {
      background-color: #ff6b6b;
      color: white;
      padding: 14px 28px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    button:hover {
      background-color: #ff5252;
    }

    .car-preview {
      margin-top: 20px;
      text-align: center;
    }

    .car-price {
      font-size: 24px;
      color: white;
      margin-top: 15px;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const carSelect = document.getElementById('car-id');
      const priceDisplay = document.getElementById('price-display');
      const rentalDays = document.getElementById('rental-days');
      const totalPrice = document.getElementById('total-price');
      
      const carPrices = {
        'C001': 500,
        'C002': 600,
        'C003': 700,
        'C004': 800,
        'C005': 1000,
        'C006': 1100
      };

      function updatePrice() {
        const selectedCar = carSelect.value;
        const days = parseInt(rentalDays.value) || 0;
        const price = carPrices[selectedCar] || 0;
        const total = price * days;
        
        priceDisplay.textContent = selectedCar ? `₹${price} per day` : 'Select a car';
        totalPrice.textContent = `Total: ₹${total}`;
      }

      carSelect.addEventListener('change', updatePrice);
      rentalDays.addEventListener('input', updatePrice);
      
      // Form validation
      document.querySelector('form').addEventListener('submit', function(e) {
        const name = document.getElementById('customer-name').value;
        const mobile = document.getElementById('mobile_number').value;
        const bookingDate = document.getElementById('booking_date').value;
        
        if (!/^[A-Za-z\s]{3,50}$/.test(name)) {
          e.preventDefault();
          alert('Please enter a valid name (3-50 characters, letters only)');
        }
        
        if (!/^[6-9]\d{9}$/.test(mobile)) {
          e.preventDefault();
          alert('Invalid mobile number. Please enter a valid 10-digit Indian mobile number.');
        }
        
        if (!bookingDate) {
          e.preventDefault();
          alert('Please select a booking date');
        }
      });

      const urlParams = new URLSearchParams(window.location.search);
      const carId = urlParams.get('car_id');
      
      if (carId) {
        carSelect.value = carId;
        const event = new Event('change');
        carSelect.dispatchEvent(event);
      }
    });
  </script>
</head>
<body>
  <div class="container">
    <div class="form-section">
      <h1>Rent a Car</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="customer-name">Customer Name</label>
          <input type="text" id="customer-name" name="customer-name" placeholder="Enter your full name" required>
        </div>
        
        <div class="form-group">
          <label for="car-id">Select Car</label>
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
          <label for="mobile_number">Mobile Number</label>
          <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter mobile number" required>
        </div>
        
        <div class="form-group">
          <label for="rental-days">Number of Days</label>
          <input type="number" id="rental-days" name="rental-days" min="1" placeholder="Enter rental duration" required>
        </div>
        
        <div class="form-group">
          <label for="booking_date">Booking Date</label>
          <input type="date" id="booking_date" name="booking_date" placeholder="Select booking date" required min="<?php echo date('Y-m-d'); ?>">
        </div>
        
        <button type="submit">Proceed to Book</button>
      </form>
    </div>
    
    <div class="image-section">
      <h2>Your Selection</h2>
      <div class="car-preview">
        <span id="price-display">Select a car</span>
        <div class="car-price" id="total-price">Total: ₹0</div>
      </div>
    </div>
  </div>
</body>
</html>