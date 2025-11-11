<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function generateHash($data, $salt) { 
    return hash('sha512', implode('|', $data) . "|" . $salt);
}

function initiatePayment($params) {
    $url = "https://pay.easebuzz.in/payment/initiateLink";
    
    $merchant_key = "MVGIY53D5Z"; // Replace with actual merchant key
    $salt = "974SRW4YCR"; // Replace with actual salt key
    
    // Prepare hash sequence
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
    $params['hash'] = generateHash($hash_data, $salt);
    
    // cURL request
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
    
    return json_decode($response, true);
}

// Example usage
$params = [
    'txnid' => 'TXN123456',
    'amount' => '500.00',
    'productinfo' => 'Sample Product',
    'firstname' => 'John',
    'email' => 'john@example.com',
    'phone' => '9876543210',
    'surl' => 'https://yourwebsite.com/success',
    'furl' => 'https://yourwebsite.com/failure',
    'udf1' => '',
    'udf2' => '',
    'udf3' => '',
    'udf4' => '',
    'udf5' => '',
    'udf6' => '',
    'udf7' => ''
];

$response = initiatePayment($params);

// Debug response to check structure
// print_r($response);

// Ensure response contains expected data
if (!isset($response['data']) || empty($response['data'])) {
    die("Error: Payment initiation failed or access_key not found.");
}

$access_key = $response['data']; // Extract access key
$payment_mode = "UPI";
$amount = "100.00";
$customer_email = "customer@example.com";
$customer_phone = "9876543210";
$txn_id = "TXN123456";
$redirect_url = "https://yourwebsite.com/payment-success";
$webhook_url = "https://yourwebsite.com/webhook";

if (empty($access_key)) {
    die("Error: Access key is empty!");
}
echo "Access Key: " . $access_key . PHP_EOL;
function initiateSeamlessPayment($access_key, $payment_mode, $amount, $customer_email, $customer_phone, $txn_id, $redirect_url, $webhook_url) {
    $url = "https://pay.easebuzz.in/initiate_seamless_payment/";

    $data = [
        'access_key' => $access_key,
        'payment_mode' => $payment_mode,
        'amount' => $amount,
        'customer_email' => $customer_email,
        'customer_phone' => $customer_phone,
        'txn_id' => $txn_id,
        'redirect_url' => $redirect_url,
        'webhook_url' => $webhook_url,
    ];

    echo "Sending Data: ";
    var_dump($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $responses = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    curl_close($ch);

    echo "Response: ";
    var_dump($responses);  // Debug full response

    return $responses;
}

// Call function
$seamlessResponse = initiateSeamlessPayment($access_key, $payment_mode, $amount, $customer_email, $customer_phone, $txn_id, $redirect_url, $webhook_url);

if (empty($seamlessResponse)) {
    echo "API Response is empty!";
}

?>
