<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$username='37497435';
$password='I7y3zf97AW';
$apiRefNum="FTXH".date('Ymdhis').rand(1111,9999);
$valueDt=date('d-m-Y');
$pymtType=$_POST['pymtType'];
$amount=$_POST['amount'];
$beneName=$_POST['beneName'];
$beneIFSC=$_POST['beneIFSC'];
$beneAcctNum=$_POST['beneAcctNum'];
$txnSendBy=$_POST['txnSendBy'];
$sendJsonData = [
	'ftxPayReq' => [
		'header' => [
			'version'=> '01.00', 'ftxID'=> '37497435', 'channel'=> 'API', 'custID'=> '37497435', 'partnerCode'=> '67999', 'txnType'=> 'PAY', 'pymtType'=> $pymtType
		],
		'payload'=> [
			'common'=>[ 
				'apiRefNum'=> $apiRefNum, 'custRefNum'=> '627198739', 'valueDt'=> $valueDt, 'currencyCd'=> 'INR', 'currencyRate'=> '1.00', 'amount'=> $amount, 'purposeCd'=> 'MER', 'purposeCdRef'=> '', 'remarks'=> '', 'debitNarration'=> 'YESBANK'
			],
			'remitBlk'=> [
				'rmtrAcctNum'=> '010761900001695', 'rmtrName'=> $txnSendBy
			],
			'beneBlk'=> [
				'beneCode'=> '', 'beneName'=> $beneName, 'beneIFSC'=> $beneIFSC, 'beneAcctNum'=> $beneAcctNum
			]
		]
	]
];
$sendJsonData = json_encode($sendJsonData);
// $url = "https://uatskyway.yesbank.in/app/uat/APIBankingService/FTx/Payments/PayReq"; // Replace with your API URL
$url ="https://skyway.yesbank.in/app/live/APIBankingService/FTx/Payments/PayReq";
$headers = [
    'X-IBM-Client-Id:d995f0ff25aaffd25a38752311517652',
    'X-IBM-Client-Secret:348bb03020c910f6e0a8cc4be0cb96ef',
    'ftxID:37497435',
    'Content-Type:application/json'
];
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PORT , 443);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $sendJsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSLCERT, 'athtech.crt');
curl_setopt($ch, CURLOPT_SSLKEY, 'athtech.key');

// Execute cURL request
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo "cURL error: " . curl_error($ch);
} else {
    echo $response;
}
curl_close($ch);
?>