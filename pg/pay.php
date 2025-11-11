<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config.php';
require 'encrypt.php';
require 'decrypt.php';
ob_start();
ob_flush();
ob_clean();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION['user_id'])) {
    $user_id=$_SESSION['user_id'];
} else {
    header('location:../logout.php');
    die;
}

// Encryption Decryption Keys--------------
// Provided keys
$edKey = "badb80ceb77597b092c951695e85ba7c";
$ivKey = "d44d234e3964f2a869db77d79ae2204a";
// Convert keys to binary format
$key = utf8_encode($edKey);
$iv = utf8_encode($ivKey);
// Encryption Decryption Keys--------------

// Test Credentials
$secretKey = 'badb80ceb77597b092c951695e85ba7c';
$saltKey = 'd44d234e3964f2a869db77d79ae2204a';
$encryptdecryptKey = '3191196808b66f630d3891fe2ec73837';
$userId = 'e5b6f439-3759-44b5-ab3b-b3fabfd35ccb';

// $signatureUrl = 'http://gateway.vimopay.in/api/Signature/authorizeuat'; // TEST
$signatureUrl = 'https://prod.vidual.in/api/Signature/authorize'; // PROD

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize input data
    $firstname = mysqli_real_escape_string($conn, $_POST['cartid']);
    $amnt = mysqli_real_escape_string($conn, $_POST['amount']);
    $userid = mysqli_real_escape_string($conn,$_POST['userid']);

    if($userid != $user_id){
        echo '<script>alert("User Verification Failed., Please Try Again");</script>';
            header('Location: ../checkout.php?error=1');
            die();
    }
    $cartdata = mysqli_query($conn,"SELECT SUM(price) as totalprice, SUM(mrp) as totalmrp,id FROM cart WHERE userid = '$user_id' ");
    $fetchcartdata = mysqli_fetch_array($cartdata);

    $amount = $fetchcartdata['totalprice'];


    if($amnt != $amount){
        echo '<script>alert("Amount Verification Failed., Please Try Again");</script>';
        header('Location: ../checkout.php?error=2');
        die();
    }

        // Signature Authorization and Authentication --------

        // Setup cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $signatureUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'secretKey: ' . $secretKey,
                'saltKey: ' . $saltKey,
                'encryptdecryptKey: ' . $encryptdecryptKey,
                'userId: ' . $userId,
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload));

            // Execute the request
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $error = 'Error: ' . curl_error($ch);
                curl_close($ch);
                echo $error;
                die();
            } else {
                curl_close($ch);
                $res = json_decode($response, true);
                // print_r($res);
                $signData = $res['data']; // Bearer Token to send in 
            }


        // Generate UPI Intent

        $genRes = generateUPI($conn, $signData, $userId, $user_id, $amnt);
        $decrypted = decrypt($genRes['data'], $key, $iv);
        $redRes = json_decode($decrypted);
        
        $loopQuery = mysqli_query($conn,"SELECT * FROM cart WHERE userid = '$user_id' ");
        $orderid = rand(1111111111,9999999999);
        $date = date('Y-m-d H:i:s');
        $txnid = $redRes->txnId;
        $payment_method = 'UPI';
        $userid = $user_id;
        $status = 'Pending';
        while($getcart = mysqli_fetch_assoc($loopQuery)){
            $productid = $getcart['productid'];
            $quantity = $getcart['quantity'];
            $price = $getcart['price'];
            $mobile = mysqli_fetch_assoc(mysqli_query($conn,"SELECT mobile FROM users WHERE id = '$user_id' "))['mobile'];
            // enter the transaction in db
            $insQuery = mysqli_query($conn,"INSERT INTO orders (`productid`, `quantity`, `price`, `txnid`, `orderid`, `payment_method`, `userid`, `date`, `status`, `userMobileNo`) 
                                                    VALUES ('$productid','$quantity','$price','$txnid','$orderid','$payment_method','$userid', '$date', '$status', '$mobile') ");
    
        }
        // $deleteCart = mysqli_query($conn,"DELETE FROM cart WHERE userid = '$user_id' "); need to implement this query on landing page
        
       $upiIntend = $redRes->upiIntend;

        // echo ' <script>
        //     // Simulating an API response with the UPI link
        //     const apiResponse = {
        //     upiLink: "'.$upiIntend.'"
        //     };

        //     // Function to handle UPI link
        //     function openUPILink(upiLink) {
        //     if (/Mobi|Android/i.test(navigator.userAgent)) { // Check if the user is on a mobile device
        //         window.location.href = upiLink; // Redirect to the UPI link
        //     } else {
        //         alert("This UPI link can only be opened on mobile devices.");
        //     }
        //     }

        //     // Automatically open the UPI link
        //     openUPILink(apiResponse.upiLink);

        //     window.location.assign("https://prozino.in/");
        // </script>';


}

function generateUPI($conn, $signData, $userId, $user_id, $amnt)
{
    // Encryption Decryption Keys--------------
    // Provided keys
$edKey = "badb80ceb77597b092c951695e85ba7c";
$ivKey = "d44d234e3964f2a869db77d79ae2204a";
    // Convert keys to binary format
    $key = utf8_encode($edKey);
    $iv = utf8_encode($ivKey);
    // Encryption Decryption Keys--------------

    // Get Required User Details -----
    $query = mysqli_query($conn,"SELECT * FROM users WHERE id = '$user_id' ");
    $fetch = mysqli_fetch_assoc($query);
    $mobile = $fetch['mobile'];
    $merchantRefId = generateRandomID();
    $amount = $amnt;
    $Lat = '28.70';
    $Long = '70.14';

    // $UPIUrl = 'http://gateway.vimopay.in/api/Payment/upiuat'; // TEST
    $UPIUrl = 'https://prod.vidual.in/api/Payment/upi'; // PROD

    $bearerToken = 'Bearer ' . $signData;

    $data = [
        'userMobileNo' => $mobile,
        'merchantRefId' => $merchantRefId,
        'amount' => $amount,
        'Lat' => $Lat,
        'Long' => $Long,
        'udf1' => '',
        'udf2' => '',
        'udf3' => ''
    ];
    $data = json_encode($data, true);
    $payload = [ 'requestBody' => encrypt($data, $key, $iv) ];
    $stringPayload = json_encode($payload, true);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $UPIUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: ' . $bearerToken,
        'userId: ' . $userId,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $stringPayload);

    // Execute the request
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = 'Error: ' . curl_error($ch);
        curl_close($ch);
        echo $error;
        die();
    } else {
        curl_close($ch);
        $resp = json_decode($response, true);
        return $resp;
    }
}

function generateRandomID($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 0, $length);
}
?>


<form id="myForm" method="POST" action="../payment.php">
    <input type="hidden" value="<?php echo $upiIntend; ?>" name="UPI">
    <input type="hidden" value="<?php echo $amount; ?>" name="AMOUNT">
</form>
<script>
window.onload = function() {
            document.getElementById('myForm').submit();
        };
</script>