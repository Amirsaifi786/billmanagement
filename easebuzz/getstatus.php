<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = "https://dashboard.easebuzz.in/transaction/v2.1/retrieve";    
$merchant_key = "MVGIY53D5Z"; // Replace with actual merchant key
$salt = "974SRW4YCR"; // Replace with actual salt key
$ctxn=$_POST['ctxn_id'];
$hashinp=$merchant_key.'|'.$ctxn.'|'.$salt;
$hash = hash('sha512', $hashinp);

$postData=[
    'txnid'=>$ctxn,
    'key'=>$merchant_key,
    'hash'=>$hash
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded'
]);
$response = curl_exec($ch);
curl_close($ch);
$response=json_decode($response, true);
print_r(json_encode($response, true)); die();
if (!isset($response['data']) || empty($response['data'])) {
    die("Error: Payment initiation failed or access_key not found.");
}
?>