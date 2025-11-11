<?php 

require '../config.php';
require 'encrypt_decrypt.php';

ob_start();
ob_flush();
ob_clean();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION['user_id'])) {
    $userIds = $_SESSION['user_id'];
} else {
    header('location:../logout.php');
    die;
}
date_default_timezone_set('Asia/Kolkata');
$date  = date('Y-m-d H:i:s');

// PROD Credentials
// $client_secret = 'b32e3423-e86e-4080-af40-72743dcc41ed';
// $service_id = '71c223ba-ad64-4172-9e50-de8b4fae5259';
// $encryptdecryptKey = '429c5a7fc29b104b239ae1fc1af3771f12ea0f4c38fe34999c90ba55f150616dd5d6f03d89080d8014c8dd19';


// UAT Credentials
$client_secret = 'bacc6de1-2257-48f8-8055-963ff9ef30d1';
$service_id = 'cc2b9c4a-79d9-4879-856f-221cf0e30271';
$encryptdecryptKey = '2dd79ed422e99ad5beca7ed2e58ae1dd2507ccc47e1459a4fefd455212aa92fc4d0e13621a3effc02752bb7e';

    $signatureUrl = 'https://collectbot-v2.neokred.tech/payin/api/v2/t1/external/upi/qr/generate/intent'; // PROD

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize input data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $address3 = mysqli_real_escape_string($conn, $_POST['address3']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
     $amnt = mysqli_real_escape_string($conn, $_POST['amnt']);
     
    $tdydate = date('Y-m-d H:i:s');
    
    // Update query
      $updateQuery = "UPDATE users SET name='$firstname', address='$address1', address2='$address2', city='$city', state='$state', pincode='$zipcode', email='$email', update_time_date='$tdydate' WHERE id='$userIds'";
 
    if (mysqli_query($conn, $updateQuery)) {
        // Insert order details into the database
        $loopQuery = mysqli_query($conn, "SELECT * FROM cart WHERE userid = '$userIds'");
        $orderid = rand(1111111111, 9999999999);
        $date = date('Y-m-d H:i:s');
        $payment_method = 'UPI';
        $userid = $userIds;
        $status = 'Pending';

        while ($getcart = mysqli_fetch_assoc($loopQuery)) {
            $productid = $getcart['productid'];
            $quantity = $getcart['quantity'];
            $price = $getcart['price'];
            $mobile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT mobile FROM users WHERE id = '$userIds'"))['mobile'];
            
            $insQuery = "INSERT INTO orders (productid, quantity, price, orderid, payment_method, userid, date, status, userMobileNo) VALUES ('$productid', '$quantity', '$price', '$orderid', '$payment_method', '$userid', '$date', '$status', '$mobile')";
            mysqli_query($conn, $insQuery);
        }

        // Data to send to PG QR Intent
         $payloadData = [
            // "amount" => "1", // testing amount (strict)
            "amount" => "$amnt",
            "remark" => "MeticulouslyComputer",
            "refId" => "$orderid"
        ]; 

        $requestPayload = encryptDataGCM($payloadData, $encryptdecryptKey);
        $requestPayload = json_encode($requestPayload);

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $signatureUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'client_secret: ' . $client_secret,
            'serviceid: ' . $service_id
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_ip = '103.235.104.104';  // Replace this with your actual IP
        curl_setopt($ch, CURLOPT_INTERFACE, $server_ip);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPayload);

        // Execute the request
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $res = json_decode($response, true);
        }

        curl_close($ch);

        if($res['statusCode'] == '200'){
            // echo "<pre>";
            // print_r($res);
            // echo "</pre>";
            $encrypted = $res['data'];
            $authTag = $res['authTag'];
            $decrypted = decryptDataGCM($encrypted, $encryptdecryptKey, $authTag);

            // redirect to generate QR
             $upiIntend = $decrypted['upiIntentString'];
             $amount = $decrypted['amount'];
            
            $transactionId = $decrypted['transactionId'];
            $orderId = $decrypted['orderId'];
            $refId = $decrypted['refId'];
            

        } elseif($res['statusCode'] == '500'){
            // echo "<pre>";
            // print_r($res);
            // echo "</pre>";
            $encrypted = $res['data'];
            $authTag = $res['authTag'];
            $decrypted = decryptDataGCM($encrypted, $encryptdecryptKey, $authTag);
            // print_r($decrypted);
            echo "<script>alert('".$res['message']."'); window.location.assign('../checkout.php'); </script>";
        }
        $insert = mysqli_query($conn, "INSERT INTO `tbl_order` (`amount`, `transactionId`, `orderId`, `refId`, `updated_at`, `created_at` ) VALUES ( '$amount', '$transactionId', '$orderId', '$refId', '$date', '$date')");
    } else {
        echo "<script>alert('Error updating details. Please try again.'); window.location.href='../checkout.php';</script>";
    }
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