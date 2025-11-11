<?php
require 'config.php';
include_once('easebuzz-lib/easebuzz_payment_gateway.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION['user_id'])) {
    $userIds = $_SESSION['user_id'];
} else {
    header('location:logout.php');
    die;
}
date_default_timezone_set('Asia/Kolkata');
$date  = date('Y-m-d H:i:s');
if(!empty($_POST) && (sizeof($_POST) > 0))
{
    $firstname = mysqli_real_escape_string($conn, $_POST['name']);
    $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $address3 = mysqli_real_escape_string($conn, $_POST['address3']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $amnt = mysqli_real_escape_string($conn, $_POST['amnt']);
    $umob=mysqli_real_escape_string($conn, $_POST['phone']);
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
        $mobile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT mobile FROM users WHERE id = '$userIds'"))['mobile'];
        while ($getcart = mysqli_fetch_assoc($loopQuery)) {
            $productid = $getcart['productid'];
            $quantity = $getcart['quantity'];
            $price = $getcart['price'];
            
            //$insQuery = "INSERT INTO orders (productid, quantity, price, orderid, payment_method, userid, date, status, userMobileNo) VALUES ('$productid', '$quantity', '$price', '$orderid', '$payment_method', '$userid', '$date', '$status', '$mobile')";
            //mysqli_query($conn, $insQuery);
        }
        $payAmt=number_format($amnt, 2, '.', '');
        $postData=[
            'txnid'=>'TXN'.$orderid,
            'amount'=>$payAmt,
            'firstname'=>$firstname,
            'email'=>$email,
            'phone'=>$umob,
            'productinfo'=>'checkout pay',
            'surl'=>'https://atharvktechnologies.com/response.php',
            'furl'=>'https://atharvktechnologies.com/response.php',
            'udf1'=>'',
            'udf2'=>'',
            'udf3'=>'',
            'udf4'=>'',
            'udf5'=>'',
            'address1'=>$address1,
            'address2'=>$address2,
            'city'=>$city,
            'state'=>$state,
            'country'=>'',
            'zipcode'=>$zipcode
        ];
        $MERCHANT_KEY = "MVGIY53D5Z";
        $SALT = "974SRW4YCR";
        //$ENV = "test";    // setup test enviroment (testpay.easebuzz.in).
        $ENV = "prod";   // setup production enviroment (pay.easebuzz.in).
        $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
        $result = $easebuzzObj->initiatePaymentAPI($postData);
        print_r($result);
    } else {
        echo "<script>alert('Error updating details. Please try again.'); window.location.href='checkout.php';</script>";
    }
}
else
{
    echo '<h1>Please fill all mandatory fields.</h1>';
        echo "<script>alert('Error updating details. Please try again.'); window.location.href='checkout.php';</script>";
}
?>
