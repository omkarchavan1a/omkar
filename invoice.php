<?php
require_once "check_auth.php";
require_once 'config.php'; // Include the configuration file for database connection

// Function to validate mobile number
function validateMobileNumber($mobile_number) {
    // Remove any spaces, dashes or other characters
    $cleaned_number = preg_replace('/[^0-9]/', '', $mobile_number);
    
    // Check if it's exactly 10 digits and starts with valid Indian mobile prefix
    if (strlen($cleaned_number) === 10 && preg_match('/^[6-9]/', $cleaned_number)) {
        return $cleaned_number;
    }
    return false;
}

// Function to generate invoice
function generateInvoice($customer_name, $car_id, $mobile_number, $rental_days, $car_rent) {
    $total_amount = $rental_days * $car_rent;
    
    // Map car IDs to car names
    $car_names = [
        'C001' => 'Maruti Suzuki Swift',
        'C002' => 'Honda Accord',
        'C003' => 'Hyundai Elantra',
        'C004' => 'Tata Punch',
        'C005' => 'Tata Harrier',
        'C006' => 'Tata Safari'
    ];
    
    $car_name = isset($car_names[$car_id]) ? $car_names[$car_id] : 'Unknown Car';

    $invoice = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Car Rental Invoice</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            body {
                background-color: #f0f8ff;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 20px;
            }

            .invoice-container {
                background-color: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 800px;
                position: relative;
            }

            .invoice-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
            }

            .invoice-title {
                font-size: 32px;
                font-weight: bold;
                color: #333;
            }

            .yellow-circle {
                width: 80px;
                height: 80px;
                background-color: #ffd700;
                border-radius: 50%;
                position: absolute;
                top: -20px;
                right: -20px;
                z-index: -1;
            }

            .payment-info {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 30px;
            }

            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                margin: 30px 0;
            }

            .invoice-table th {
                background-color: #004d6f;
                color: white;
                padding: 12px;
                text-align: left;
            }

            .invoice-table td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
            }

            .invoice-table tr:nth-child(even) {
                background-color: #f8f9fa;
            }

            .terms-section {
                background-color: #0099cc;
                color: white;
                padding: 20px;
                border-radius: 8px;
                margin-top: 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .car-icon {
                font-size: 2em;
                color: #333;
                margin-bottom: 10px;
            }

            .totals {
                margin-top: 20px;
                text-align: right;
            }

            .totals div {
                margin: 10px 0;
            }

            .total-amount {
                font-size: 24px;
                font-weight: bold;
                color: #004d6f;
            }
            
            .payment-button {
                display: inline-flex;
                align-items: center;
                padding: 12px 24px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s ease;
                margin-top: 20px;
            }

            .payment-button:hover {
                background-color: #45a049;
            }

            .payment-button i {
                margin-right: 10px;
                font-size: 18px;
            }

            .payment-section {
                text-align: center;
                margin-top: 30px;
            }

            @media (max-width: 768px) {
                .invoice-container {
                    padding: 20px;
                }

                .invoice-header {
                    flex-direction: column;
                    text-align: center;
                }

                .terms-section {
                    flex-direction: column;
                    text-align: center;
                }

                .car-icon {
                    margin-top: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class='invoice-container'>
            <div class='yellow-circle'></div>
            <div class='invoice-header'>
                <i class='fas fa-car car-icon'></i>
                <h1 class='invoice-title'>INVOICE</h1>
                <div class='logo'>
                    <!-- Add your logo here -->
                </div>
            </div>

            <div class='payment-info'>
                <h3>PAYMENT INFO:</h3>
                <p>Account Name: ".htmlspecialchars($customer_name)."</p>
                <p>Mobile Number: ".htmlspecialchars($mobile_number)."</p>
                <p>Brand Name: Car Rental</p>
            </div>

            <table class='invoice-table'>
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>CAR NAME</th>
                        <th>PRICE</th>
                        <th>DAYS</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>".htmlspecialchars($car_name)." (".htmlspecialchars($car_id).")</td>
                        <td>Rs ".htmlspecialchars($car_rent)."</td>
                        <td>".htmlspecialchars($rental_days)."</td>
                        <td>Rs ".htmlspecialchars($total_amount)."</td>
                    </tr>
                </tbody>
            </table>

            <div class='totals'>
                <div>SUBTOTAL: Rs <span class='subtotal'>".htmlspecialchars($total_amount)."</span></div>
                <div class='total-amount'>TOTAL: Rs <span class='total'>".htmlspecialchars($total_amount)."</span></div>
            </div>

            <div class='terms-section'>
                <div>
                    <h3>TERMS & CONDITIONS</h3>
                    <p>Terms and conditions apply.</p>
                </div>
            </div>
            
            <div class='payment-section'>
                <a href='payment.php?rental_id=".htmlspecialchars($_GET['rental_id'] ?? '')."&total_amount=".htmlspecialchars($total_amount)."' class='payment-button'>
                    <i class='fas fa-credit-card'></i> Proceed to Payment
                </a>
            </div>
        </div>
    </body>
    </html>";

    return $invoice;
}

// Get data preferentially from URL parameters (sent from the form page)
$rental_id = $_GET['rental_id'] ?? null;
$customer_name = $_GET['customer_name'] ?? '';
$car_id = $_GET['car_id'] ?? '';
$mobile_number = $_GET['mobile_number'] ?? '';
$rental_days = $_GET['rental_days'] ?? 0;
$total_amount = $_GET['total_amount'] ?? 0;

// If we're missing data from URL parameters, try to get from POST (fallback)
if (empty($customer_name) || empty($car_id) || empty($mobile_number) || empty($rental_days)) {
    $customer_name = filter_input(INPUT_POST, 'customer-name', FILTER_SANITIZE_STRING) ?? '';
    $car_id = filter_input(INPUT_POST, 'car-id', FILTER_SANITIZE_STRING) ?? '';
    $mobile_number = filter_input(INPUT_POST, 'mobile_number', FILTER_SANITIZE_STRING) ?? '';
    $rental_days = filter_input(INPUT_POST, 'rental-days', FILTER_VALIDATE_INT) ?? 0;
}

// Validate mobile number
$validated_mobile = validateMobileNumber($mobile_number);
if (!$validated_mobile) {
    die('Invalid mobile number. Please enter a valid 10-digit Indian mobile number.');
}

// Final validation check
if (!$customer_name || !$car_id || !$validated_mobile || !$rental_days) {
    die('Invalid input detected. Please go back and ensure all fields are correctly filled.');
}

// Use validated mobile number
$mobile_number = $validated_mobile;

// Determine car rent based on car ID
$car_rent = 0;
switch ($car_id) {
    case 'C001':
        $car_rent = 500;
        break;
    case 'C002':
        $car_rent = 600;
        break;
    case 'C003':
        $car_rent = 700;
        break;
    case 'C004':
        $car_rent = 800;
        break;
    case 'C005':
        $car_rent = 1000;
        break;
    case 'C006':
        $car_rent = 1100;
        break;           
    default:
        die('Invalid Car ID provided.');
}

// If total_amount is not provided or zero, calculate it
if (empty($total_amount) || $total_amount == 0) {
    $total_amount = $car_rent * $rental_days;
}

// Generate and output the invoice
echo generateInvoice($customer_name, $car_id, $mobile_number, $rental_days, $car_rent);
?>