<?php
require'../header.php'; 
// Include the QR code library
include 'phpqrcode-master/qrlib.php';

// Define the response object
$response = new stdClass();
$response->txnId = "9f763f43eb3e4b5ab9487413e8220d76";
$response->upiIntend = "upi://pay?pa=vid.prozinoe@finobank&pn=Prozino%20E%20Private%20Limited&mc=5611&tr=9f763f43eb3e4b5ab9487413e8220d76&tn=Prozino%20ECommerce%20Pr&am=1&cu=INR&mode=05&orgid=187064&catagory=01&url=https://www.finobank.com/&sign=MEUCIDNctT5QbjKHIM/2vYiKJMtZiymQhbkhJfjTiNZCgQ/aAiEAnGR8FGnSrHA/7X9jZcq9Ln2edFY6vdSpMTJqt1IPAyE=";
$response->qr = "";
$response->userMobileNo = "7023574769";
$response->merchantRefId = "v47oXf05";
$response->amount = "1";
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

<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
                <h3>Scan this QR Code to Pay:</h3>
                <img src='<?=$qrCodeFilePath;?>' alt='QR Code'>
        </div>
    </div>
</div>
<?php require'../footer.php'; ?>