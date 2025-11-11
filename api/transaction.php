<?php
require '../config.php';
require '../cb_pg/encrypt_decrypt.php';

header('Content-Type: application/json');

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");
$response = [];

// Check if the API key is valid
if (!checkApiKey()) {
    http_response_code(401);
    echo json_encode(["message" => "Unauthorized: Invalid API Key"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");

    if (!$rawData) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Empty/Missing Params']);
        exit;
    }

    $data = json_decode($rawData, true);
    $amount = $data['amount'] ?? null;
    $remark = $data['remark'] ?? 'remark';
    $refId = $data['refId'] ?? '123order';

    if (!$amount) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Amount cannot be null']);
        exit;
    }

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO tbl_order (amount, refId, remark, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $amount, $refId, $remark, $date, $date);

    if (!$stmt->execute()) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Couldn't create order. Please contact Support."]);
        exit;
    }

    // Payment Gateway Credentials
$client_secret = 'bacc6de1-2257-48f8-8055-963ff9ef30d1';
$service_id = 'cc2b9c4a-79d9-4879-856f-221cf0e30271';
$encryptdecryptKey = '2dd79ed422e99ad5beca7ed2e58ae1dd2507ccc47e1459a4fefd455212aa92fc4d0e13621a3effc02752bb7e';

    $signatureUrl = 'https://collectbot-v2.neokred.tech/payin/api/v2/t1/external/upi/qr/generate/intent';

    // Encrypt payload
    $payloadData = ['amount' => $amount, 'remark' => $remark, 'refId' => $refId];
    $requestPayload = encryptDataGCM($payloadData, $encryptdecryptKey);

    // cURL Request
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $signatureUrl,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'client_secret: ' . $client_secret,
            'serviceid: ' . $service_id
        ],
        CURLOPT_POSTFIELDS => json_encode($requestPayload),
        CURLOPT_TCP_KEEPALIVE => 1,
        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        CURLOPT_TIMEOUT => 10, // Set timeout for faster response
    ]);

    $apiResponse = curl_exec($ch);

    if (curl_errno($ch)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'cURL Error: ' . curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);
    $res = json_decode($apiResponse, true);

    if ($res['statusCode'] == '200') {
        $decrypted = decryptDataGCM($res['data'], $encryptdecryptKey, $res['authTag']);

        $status = $decrypted['status'];
        $upiIntend = $decrypted['upiIntentString'];
        $transactionId = $decrypted['transactionId'];
        $orderId = $decrypted['orderId'];
        $amount = floor($decrypted['amount'] * 100) / 100;

        // Update order details
        $stmt = $conn->prepare("UPDATE tbl_order SET transactionId = ?, orderId = ?, status = ?, updated_at = ? WHERE refId = ? AND amount = ?");
        $stmt->bind_param('ssssss', $transactionId, $orderId, $status, $date, $refId, $amount);
        $stmt->execute();

        $resp['statusCode'] = $res['statusCode'];
        $resp['message'] = $res['message'];
        $resp['timestamp'] = $res['timestamp'];
        $resp['upiIntend'] = $decrypted;
    } else {
        $resp = [
            'statusCode' => $res['statusCode'],
            'message' => $res['message'],
            'timestamp' => $res['timestamp'],
            'upiIntend' => null,
        ];
    }

    $response['success'] = true;
    $response['message'] = 'Data Found';
    $response['data'] = $resp; 
    http_response_code(200);
} else {
    $response['success'] = false;
    $response['message'] = 'Method Not Allowed';
    http_response_code(405);
}

echo json_encode($response);
exit;
