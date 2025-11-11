<?php
 
require '../config.php';
session_start();
require('../razorpay-php-master/Razorpay.php');

if(!empty($_SESSION['user_id']))
{
      $userIds = $_SESSION['user_id'];
      
    $selectoldwallets = mysqli_query($conn, "SELECT * FROM users WHERE id='$userIds'");
    $userinfo = mysqli_fetch_array($selectoldwallets);
}else{
    ?>
  <script>
      window.location.assign('https://meticulouslycomputer.com/');
  </script>
  <?php
}

date_default_timezone_set("Asia/Calcutta");   // India time (GMT+5:30)
$tdayDate = date('Y-m-d H:i:s');

if(isset($_REQUEST['amnt']))
{
    $payId = $_REQUEST['amnt']; 
 
    $get = mysqli_query($conn,"SELECT 
    SUM(price) AS totalprice, SUM(mrp) AS totalmrp, id,  productid,  quantity  FROM cart WHERE userid = '".$_SESSION['user_id']."'");
    $fget = mysqli_fetch_assoc($get);
      $price = $fget['totalprice']; 
     $productid = $fget['productid']; 
     $quantity = $fget['quantity']; 
 
}

function generateRandomAlphanumeric($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

$randomString = generateRandomAlphanumeric(10);

$userid = $userIds;  
$payment_method = "Razorpay"; 
$paystatus = "Pending"; 
$newbalance = $price;
 $newprice = $price;
$currency = 'INR';
 
// Razorpay order id generate
use Razorpay\Api\Api;


$keyId = "rzp_live_VXhZQlCj8JZjKl";
$keySecret = "jbt6bxoiDYU4BXjqNnZsCicr";
$api = new Api($keyId, $keySecret);

$orderData = [
    'amount' => $newprice * 100,
    'currency' => "$currency",
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($keyId . ':' . $keySecret)
));

$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit();
} else {
    $data = json_decode($response, true);
}

$razorpayOrderId = $data['id'];
$orderid = $razorpayOrderId;

 
$Update = mysqli_query($conn, "INSERT INTO `orders`(`productid`, `quantity`, `price`, `txnid`, `orderid`, `status`, `date`, `payment_method`, `userid`) VALUES('$productid','$quantity','$price','','$orderid','$paystatus','$tdayDate','$payment_method','$userid')");

// Prepare data for the POST request to Razorpay
$postData = [
    "key_id" => $keyId,
    "amount" => $newprice * 100,
    "order_id" => $orderid,
    "name" => $userinfo['title'] . ' ' . $userinfo['name'],
    "description" => $userinfo['address'],
    "currency" => "INR",
    "image" => $userinfo['profile.php'],
    "prefill" => [
        "name" => $userinfo['title'] . ' ' . $userinfo['name'],
        "contact" => $userinfo['mobile'],
        "email" => $userinfo['email']
    ],
    "notes" => [
        "shipping address" => $userinfo['address']
    ],
    "callback_url" => "https://meticulouslycomputer.com/payments/landing.php",
    "cancel_url" => "https://meticulouslycomputer.com/payments/landing.php"
];
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/checkout/embedded');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit();
} else {
    echo $response;
}
?>