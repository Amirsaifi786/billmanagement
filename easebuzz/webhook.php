<?php
require '../config.php';

// Read raw POST data
$data = file_get_contents("php://input");

// Parse the form-urlencoded data into an array
parse_str($data, $parsedData);

// Convert JSON response to an array if data is JSON
if (empty($parsedData) && !empty($data)) {
    $parsedData = json_decode($data, true);
}
    print_r($parsedData);
    $check=mysqli_query($conn, "SELECT * FROM easebuzz WHERE txnid='".$parsedData['txnid']."'");
    if(mysqli_num_rows($check)>0)
    {
        $today=date("Y-m-d H:i:s");
        $getId=mysqli_fetch_assoc($check);
        $getId=$getId['id'];
        $add=mysqli_query($conn, "UPDATE easebuzz SET hash='".$parsedData['hash']."', mode='".$parsedData['mode']."', udf1='".$parsedData['udf1']."', udf2='".$parsedData['udf2']."', udf3='".$parsedData['udf3']."', udf4='".$parsedData['udf4']."', udf5='".$parsedData['udf5']."', udf6='".$parsedData['udf6']."', udf7='".$parsedData['udf7']."', udf8='".$parsedData['udf8']."', udf9='".$parsedData['udf9']."', udf10='".$parsedData['udf10']."', email='".$parsedData['email']."', error='".$parsedData['error']."', phone='".$parsedData['phone']."', txnid='".$parsedData['txnid']."', amount='".$parsedData['amount']."', bank_ref_num='".$parsedData['bank_ref_num']."', upi_va='".$parsedData['upi_va']."', addedon='".$parsedData['addedon']."', easepayid='".$parsedData['easepayid']."', firstname='".$parsedData['firstname']."', productinfo='".$parsedData['productinfo']."', status='".$parsedData['status']."', furl='".$parsedData['furl']."', surl='".$parsedData['surl']."',updated_at='$today' WHERE id='$getId'");
    }
    else
    {
        $add=mysqli_query($conn, "INSERT INTO easebuzz (hash,mode,udf1,udf2,udf3,udf4,udf5,udf6,udf7,udf8,udf9,udf10,email,error,phone,txnid,amount,bank_ref_num,upi_va,addedon,easepayid,firstname,productinfo,status,furl,surl) VALUES ('".$parsedData['hash']."','".$parsedData['mode']."','".$parsedData['udf1']."','".$parsedData['udf2']."','".$parsedData['udf3']."','".$parsedData['udf4']."','".$parsedData['udf5']."','".$parsedData['udf6']."','".$parsedData['udf7']."','".$parsedData['udf8']."','".$parsedData['udf9']."','".$parsedData['udf10']."','".$parsedData['email']."','".$parsedData['error']."','".$parsedData['phone']."','".$parsedData['txnid']."','".$parsedData['amount']."','".$parsedData['bank_ref_num']."','".$parsedData['upi_va']."','".$parsedData['addedon']."','".$parsedData['easepayid']."','".$parsedData['firstname']."','".$parsedData['productinfo']."','".$parsedData['status']."','".$parsedData['furl']."','".$parsedData['surl']."')");
    }
    file_put_contents("webhook.txt", json_encode($parsedData, JSON_PRETTY_PRINT) . "\n", FILE_APPEND);

    $func = sendCallback($parsedData);


function sendCallback($requestPayload){
    $requestPayload = json_encode($requestPayload);

    $url ='https://api.11pay.me/pay/notify/easeBuzzPay';
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


echo json_encode($parsedData, true);

?>
