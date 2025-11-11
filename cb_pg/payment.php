<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require 'encrypt_decrypt.php';
require '../config.php';

header('Content-Type: application/json');

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");

$headers = getAllHeaders();
$requestData = [
    'GET' => $_GET,
    'POST' => $_POST,
    'REQUEST' => $_REQUEST,
    'FILES' => $_FILES,
    'COOKIES' => $_COOKIE,
    'SERVER' => $_SERVER
];
$rawRequestData = null;
$rawRequest = file_get_contents('php://input');
if ($rawRequest) {
    $rawRequestData = json_decode($rawRequest, true);
}

if ($rawRequestData === null && json_last_error() !== JSON_ERROR_NONE) {
    $rawRequestData = $rawRequest;
}
$clientIP = getClientIP();

logResponse(['callBakRequest'=> ['headers'=>$headers, 'request' => [$requestData, $rawRequestData], 'clientIP' => $clientIP]]);

$response = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rawData = file_get_contents("php://input");
    $dataRes = json_decode($rawData, true);


    $data = $dataRes['data'];
    $authTag = $dataRes['authTag'];
    $key = '2dd79ed422e99ad5beca7ed2e58ae1dd2507ccc47e1459a4fefd455212aa92fc4d0e13621a3effc02752bb7e';
    
    $decrypted = decryptDataGCM($data, $key, $authTag);

    $upiId = $decrypted['upiId'];
    $customerName = $decrypted['customerName'];
    $amount = $decrypted['amount'];
    $transactionId = $decrypted['transactionId'];
    $custRefNo = $decrypted['custRefNo'];
    $upiTxnId = $decrypted['upiTxnId'];
    $orderId = $decrypted['orderId'];
    $txnTime = $decrypted['txnTime'];
    $txnStatus = $decrypted['txnStatus'];
    $mcc = $decrypted['mcc'];
    $refId = $decrypted['refId'];

    $get = mysqli_query($conn, "SELECT * FROM `tbl_order` WHERE refId = '$refId' ");

    if (mysqli_num_rows($get) > 0) {

        $update = mysqli_query($conn, "UPDATE `tbl_order`
                                        SET
                                            `upiId` = '$upiId',
                                            `customerName` = '$customerName',
                                            `amount` = '$amount',
                                            `custRefNo` = '$custRefNo',
                                            `upiTxnId` = '$upiTxnId',
                                            `txnTime` = '$txnTime',
                                            `txnStatus` = '$txnStatus',
                                            `mcc` = '$mcc',
                                            `updated_at` = '$date'
                                        WHERE
                                            `refId` = '$refId'
                                            AND `transactionId` = '$transactionId'
                                            AND `orderId` = '$orderId'");
        if ($update) {
            $response['successStatus'] = true;
            $response['message'] = "Success";
            $response['result'] = "ok";
        } else {
            $response['successStatus'] = false;
            $response['message'] = "Failure";
            $response['result'] = "failed";
        }
    } else {
        $insert = mysqli_query($conn, "INSERT INTO
                                            `tbl_order` (
                                                `upiId`,
                                                `customerName`,
                                                `amount`,
                                                `transactionId`,
                                                `custRefNo`,
                                                `upiTxnId`,
                                                `orderId`,
                                                `txnTime`,
                                                `txnStatus`,
                                                `mcc`,
                                                `refId`,
                                                `updated_at`,
                                                `created_at`
                                            )
                                        VALUES
                                            (
                                                '$upiId',
                                                '$customerName',
                                                '$amount',
                                                '$transactionId',
                                                '$custRefNo',
                                                '$upiTxnId',
                                                '$orderId',
                                                '$txnTime',
                                                '$txnStatus',
                                                '$mcc',
                                                '$refId',
                                                '$date',
                                                '$date')");
        if ($insert) {
            $response['successStatus'] = true;
            $response['message'] = "Success";
            $response['result'] = "ok";
        } else {
            $response['successStatus'] = false;
            $response['message'] = "Failure";
            $response['result'] = "failed";
        }
    }
    // send call back to some url
    $requestPayload = [
        'upiId' => "$upiId",
        'customerName' => "$customerName",
        'amount' => "$amount",
        'transactionId' => "$transactionId",
        'custRefNo' => "$custRefNo",
        'upiTxnId' => "$upiTxnId",
        'orderId' => "$orderId",
        'txnTime' => "$txnTime",
        'txnStatus' => "$txnStatus",
        'mcc' => "$mcc",
        'refId' => "$refId",
    ];

    // send call back to application
    $func = sendCallback($requestPayload);
} else {
    $response['successStatus'] = false;
    $response['message'] = "Failure";
    $response['result'] = "method failed";
}

function sendCallback($requestPayload){
    $requestPayload = json_encode($requestPayload);

    $url ='https://api.11pay.me/pay/notify/meticulouslyPay';
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPayload);

    // Execute the request
    $curlResp = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        $resp = json_decode($curlResp, true);
    }
    curl_close($ch);

    logResponse(['response from callback' => $resp]);
    return true;
}

echo json_encode($response, true);
