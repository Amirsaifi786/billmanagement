<?php require'../config.php'; 

$response = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $userMobileNo = $_POST['userMobileNo'];
        $merchantRefId = $_POST['merchantRefId'];
        $amount = $_POST['amount'];
        $udf1 = $_POST['udf1'];
        $udf2 = $_POST['udf2'];
        $udf3 = $_POST['udf3'];
        $txnStatus = $_POST['txnStatus'];
        $bankRefId = $_POST['bankRefId'];
        $rrn = $_POST['rrn'];
        $payerVPA = $_POST['payerVPA'];
        $txnId = $_POST['txnId'];
        $txnStatusCode = $_POST['txnStatusCode'];
        

            $get = mysqli_query($conn,"SELECT * FROM orders WHERE txnId = '$txnId' ");
            
            if(mysqli_num_rows($get) > 0){

                $update = mysqli_query($conn,"UPDATE orders SET `userMobileNo` = '$userMobileNo', `merchantRefId` = '$merchantRefId', `amount` = '$amount', `udf1` = '$udf1', `udf2` = '$udf2', `udf3` = '$udf3', `txnStatus` = '$txnStatus', `bankRefId` = '$bankRefId', `rrn` = '$rrn', `payerVPA` = '$payerVPA',  `txnStatusCode` = '$txnStatusCode' WHERE `txnId` = '$txnId'; ");

                if($update){
                    $response['successStatus'] = true;
                    $response['message'] = "Success";
                    $response['responseCode'] = "000";
                } else {
                    $response['successStatus'] = false;
                    $response['message'] = "Failure";
                    $response['responseCode'] = "001";
                }

            }
            else {
                $insert = mysqli_query($conn,"INSERT INTO orders (`userMobileNo`, `merchantRefId`, `amount`, `udf1`, `udf2`, `udf3`, `txnStatus`, `bankRefId`, `rrn`, `payerVPA`, `txnStatusCode`, `txnId`) VALUES ('$userMobileNo', '$merchantRefId', '$amount', '$udf1', '$udf2', '$udf3', '$txnStatus', '$bankRefId', '$rrn', '$payerVPA', '$txnStatusCode', '$txnId' ) ");
                 if($insert){
                    $response['successStatus'] = true;
                    $response['message'] = "Success";
                    $response['responseCode'] = "000";
                } else {
                    $response['successStatus'] = false;
                    $response['message'] = "Failure";
                    $response['responseCode'] = "001";
                }
            }
            
    } else {
        $response['successStatus'] = false;
        $response['message'] = "Failure";
        $response['responseCode'] = "001";
    }
    header('Content-Type: application/json');
    echo json_encode($response, true);

?>