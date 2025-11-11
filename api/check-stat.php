<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require '../config.php';

header('Content-Type: application/json');

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");


// Check if the API key is valid
if (!checkApiKey()) {
    // Invalid or missing API key
    http_response_code(401); // Unauthorized
    echo json_encode(["message" => "Unauthorized: Invalid API Key"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    $transactionId = mysqli_real_escape_string($conn, $data['transactionId']);

    if (empty($transactionId) || $transactionId == '') {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($response = [
            'success' => false,
            'message' => 'Empty/Missing Params'
        ], true);
        exit;
    }

    $get = mysqli_query($conn, "SELECT `upiId`, `customerName`, `amount`, `transactionId`, `custRefNo`, `upiTxnId`, `orderId`, `txnTime`, `txnStatus`, `mcc`, `refId`, `updated_at`  FROM tbl_order WHERE `transactionId` = '$transactionId' ");
    if (mysqli_num_rows($get) > 0) {
        $fetch = mysqli_fetch_assoc($get);

        $response['success'] = true;
        $response['message'] = 'Data Found';
        $response['data'] = $fetch;
    } else {
        $response['success'] = false;
        $response['message'] = 'Data Not Found';
        $response['data'] = null;
    }
    header("HTTP/1.1 200 OK");
} else {
    $response['success'] = false;
    $response['message'] = 'Method Not allowed';
    header("HTTP/1.1 405 Method Not Allowed");
}
echo json_encode($response, true);
