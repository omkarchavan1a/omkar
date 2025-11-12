<!DOCTYPE html>
<html>
<head>
    <title>Payment QR Code</title>
    <style type="text/css">
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f6d365;
        }
        .qr_code {
            text-align: center;
            width: 40%; 
        }
        input {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }
    .upload_screenshot {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-family: Arial, sans-serif;
    }
    .upload_screenshot:hover {
        background-color: #0056b3;
    }
    
    </style>
</head>
<body>
    <div class="qr_code">
        <p>Scan the QR Code with any UPI App to pay the amount:</p>
        <center><img src="QR.jpg" alt="QR CODE" class="get_qr"></center>
        <div class="flex m20">
            <label>UTR/REFERENCE/TRANSACTION ID (Paytm QR format):</label>
            <input type="text" name="transaction_id" placeholder="Enter your transaction ID" class="m10 id" required pattern="^[A-Za-z0-9]{6,23}@paytm$" oninput="validateTransactionId(this)">
        </div>
        <script>
            function validateTransactionId(element) {
                const transactionId = element.value.trim();
                const uploadScreenshotButton = document.querySelector('.upload_screenshot');
                if (transactionId !== '' && /^[A-Za-z0-9]{6,23}@paytm$/.test(transactionId)) {
                    uploadScreenshotButton.style.display = 'block';
                } else {
                    uploadScreenshotButton.style.display = 'none';
                }
            }
        </script>
        <button class="upload_screenshot" style="display: none;" onclick="window.location.href='screenshot.php'">Upload Screenshot</button>
    </div>
</body>
</html>
