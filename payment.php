<?php
require'header.php'; 


if(!isset($_POST['UPI'])){
    echo "<script>alert('Payment Verification Failed');</script>";
    header('Location: index.php');
} else {
    $upi = $_POST['UPI'];
    $amount = $_POST['AMOUNT'];
}

// Include the QR code library
include 'pg/phpqrcode-master/qrlib.php';

// Define the response object
$response = new stdClass();
$response->txnId = "9f763f43eb3e4b5ab9487413e8220d76";
$response->upiIntend = "$upi";
$response->qr = "";
$response->userMobileNo = "7023574769";
$response->merchantRefId = "v47oXf05";
$response->amount = "$amount";
$response->lat = "28.70";
$response->Long = "70.14";
$response->udf1 = "";
$response->udf2 = "";
$response->udf3 = "";

// Get the UPI Intent URL
$upiIntend = $response->upiIntend;

// Specify the file path to save the QR code image
$qrCodeFilePath = 'qr_code.png';

// Generate the QR code
QRcode::png($upiIntend, $qrCodeFilePath, QR_ECLEVEL_L, 10);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
        .timer-container {
            text-align: center;
            background: #ffffff;
            border: 1px solid #dee2e6;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .timer {
            font-size: 2.5rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="timer-container">
        <div class="timer" id="timer">01:00 </div>
        <p>left to pay and confirm your order</p>
        <img src='<?=$qrCodeFilePath;?>' alt='QR Code' style="height:200px"><br>
        <a class="btn btn-danger btn-lg" id="payNowButton" href="<?php echo $upi; ?>">Pay With UPI</a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Timer Logic
        let timerElement = document.getElementById('timer');
        let timeRemaining = 01 * 60; // 10 minutes in seconds

        function updateTimer() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeRemaining > 0) {
                timeRemaining--;
            } else {
                clearInterval(timerInterval);
                document.getElementById('payNowButton').disabled = true;
                timerElement.textContent = "Time's up!";
                alert('You will receive a message once the payment has been confirmed from our website.');
                window.location.assign('index.php');
            }
        }

        const timerInterval = setInterval(updateTimer, 1000);

function isMobileDevice() {
            return /Mobi|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }
        // Add a click event listener to the button
        document.getElementById('payNowButton').addEventListener('click', function() {
            if (isMobileDevice()) {
                // Proceed further for mobile
                console.log('User is on a mobile device. Proceeding...');
                // Add your mobile-specific logic here
            } else {
                // Alert for non-mobile devices
                alert('This UPI link will only open on mobile');
            }
        });
    </script>
</body>
</html>

<?php require'footer.php'; ?>