<?php
require '../config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = "https://pay.easebuzz.in/payment/initiateLink";    
$merchant_key = "MVGIY53D5Z"; // Replace with actual merchant key
$salt = "974SRW4YCR"; // Replace with actual salt key
$ctxn=$_POST['txn_id'];
$amt=$_POST['txn_amt'];
$key='MVGIY53D5Z';
$pinfo=$_POST['p_info'];
$firstname=$_POST['fullname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$surl=$_POST['surl'];
$furl=$_POST['furl'];

$add=mysqli_query($conn, "INSERT INTO easebuzz (email,phone,txnid,amount,productinfo,status) VALUES ('$email','$phone','$ctxn','$amt','$pinfo','pending')");

$params = [
    'txnid' => $ctxn,
    'amount' => $amt,
    'productinfo' => $pinfo,
    'firstname' => $firstname,
    'email' => $email,
    'phone' => $phone,
    'surl' => $surl,
    'furl' => $furl,
    'request_flow'=>'SEAMLESS',
    'udf1' => '',
    'udf2' => '',
    'udf3' => '',
    'udf4' => '',
    'udf5' => '',
    'udf6' => '',
    'udf7' => ''
];

$hash_data = [
    $merchant_key,
    $params['txnid'],
    $params['amount'],
    $params['productinfo'],
    $params['firstname'],
    $params['email'],
    $params['udf1'] ?? '',
    $params['udf2'] ?? '',
    $params['udf3'] ?? '',
    $params['udf4'] ?? '',
    $params['udf5'] ?? '',
    $params['udf6'] ?? '',
    $params['udf7'] ?? '',
    '', '', '', // udf8, udf9, udf10 must be empty
];
$params['key'] = $merchant_key;
$params['hash'] = hash('sha512', implode('|', $hash_data) . "|" . $salt);
// echo $params['hash'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);
$response = curl_exec($ch);
curl_close($ch);

$response=json_decode($response, true);
// print_r($response); die();
// if (!isset($response['data']) || empty($response['data'])) {
//     die("Error: Payment initiation failed or access_key not found.");
// }
$acsToken=$response['data'];
$prodUrl='https://pay.easebuzz.in/initiate_seamless_payment/';
$proData=[
    'payment_mode'=>'UPI',
    'upi_qr'=>'true',
    // 'upi_va'=>'9694637370@ybl',
    'access_key'=>$acsToken,
    'request_mode'=>'SUVA'
];
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $prodUrl);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($proData));
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$response2 = curl_exec($ch2);
if (curl_errno($ch2)) {
    echo "cURL Error: " . curl_error($ch2);
} else {
    $response2=json_encode(json_decode($response2, true), true);
    print_r($response2);
}
curl_close($ch2);
?>