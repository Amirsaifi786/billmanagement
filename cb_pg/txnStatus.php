<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require '../config.php';
require 'encrypt_decrypt.php';

// header('Content-Type: Application/json');

date_default_timezone_set('Asia/Kolkata');
$date  = date('Y-m-d H:i:s');
// PROD Credentials
$client_secret = 'bacc6de1-2257-48f8-8055-963ff9ef30d1';
$service_id = 'cc2b9c4a-79d9-4879-856f-221cf0e30271';
$encryptdecryptKey = '2dd79ed422e99ad5beca7ed2e58ae1dd2507ccc47e1459a4fefd455212aa92fc4d0e13621a3effc02752bb7e';

$signatureUrl = 'https://collectbot-v2.neokred.tech/payin/api/v2/t1/external/upi/qr/status'; // PROD


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    
    $transactionId = $data['transactionId'];
    $refId = $data['refId'];
    
    if (empty($transactionId) || $transactionId == '' || empty($refId) || $refId == '') {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($response = [
            'success' => false,
            'message' => 'Empty/Missing Params'
        ], true);
        exit;
    }
    // Data to send to PG QR Intent
    $payloadData = [
        "transactionId" => "$transactionId",
        // "refId" => "$refId"
    ];
    // echo "<pre>";
    // print_r($payloadData);
    // echo "</pre>";
    $requestPayload = encryptDataGCM($payloadData, $encryptdecryptKey);
    $requestPayload = json_encode($requestPayload);
    /*
    echo "<pre>";
    print_r($requestPayload);
    echo "</pre>";
    */
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
    // curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout after 30 seconds
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPayload);

    // Execute the request
    $response = curl_exec($ch);
    //print_r($response); die();
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        $response = json_decode($response, true);
    }
    /*
    echo "<pre>";
    print_r($res);
    echo "</pre>";
    */
    curl_close($ch);

    
        // echo "<pre>";
        // print_r($res);
        // echo "</pre>";
        $encrypted = $response['data'];
        $authTag = $response['authTag'];
        $decrypted = decryptDataGCM($encrypted, $encryptdecryptKey, $authTag);
        /*
        echo "<pre>";
        print_r($decrypted);
        echo "</pre>";
        */
    
     
    $response['success'] = true;
    $response['message'] = 'Data Found.';
    $response['data'] = $decrypted;
} else {
    $response['success'] = false;
    $response['message'] = 'Method Not allowed';
    header("HTTP/1.1 405 Method Not Allowed");
}
echo json_encode($response, true);
