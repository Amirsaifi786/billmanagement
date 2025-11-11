<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Cashfree - Signature Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body onload="document.frm1.submit()">


<?php 

  $appid = $_SESSION['appid'];
  $orderid = $_SESSION['orderid'];
  $amount = $_SESSION['orderamount'];
  $curremcy = $_SESSION['currency'];
  $note = $_SESSION['Note'];
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $phone = $_SESSION['phone'];
  $return = $_SESSION['return'];
  $notify = $_SESSION['notify'];

 
$mode = "TEST"; //<------------ Change to TEST for test server, PROD for production

extract($_POST);
  $secretKey = "TEST4359433d0755aef06ad413b08f878a3025f9f149";
  $postData = array( 
  "appId" => $appid, 
  "orderId" => $orderid, 
  "orderAmount" => $amount, 
  "orderCurrency" => $curremcy, 
  "orderNote" => $note, 
  "customerName" => $name, 
  "customerPhone" => $phone, 
  "customerEmail" => $email,
  "returnUrl" => $return, 
  "notifyUrl" => $notify,
);
ksort($postData);
$signatureData = "";
foreach ($postData as $key => $value){
    $signatureData .= $key.$value;
}
$signature = hash_hmac('sha256', $signatureData, $secretKey,true);
$signature = base64_encode($signature);

if ($mode == "TEST") {
  $url = "https://www.cashfree.com/checkout/post/submit";
} else {
  $url = "https://test.cashfree.com/billpay/checkout/post/submit";
}

 ?>
 
 
  <form action="<?php echo $url; ?>" name="frm1" method="post">
      <p>Please wait.......</p>
      <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
      <input type="hidden" name="orderNote" value='<?php echo $note; ?>'/>
      <input type="hidden" name="orderCurrency" value='<?php echo $curremcy; ?>'/>
      <input type="hidden" name="customerName" value='<?php echo $name; ?>'/>
      <input type="hidden" name="customerEmail" value='<?php echo $email; ?>'/>
      <input type="hidden" name="customerPhone" value='<?php echo $phone; ?>'/>
      <input type="hidden" name="orderAmount" value='<?php echo $amount; ?>'/>
      <input type ="hidden" name="notifyUrl" value='<?php echo $notify; ?>'/>
      <input type ="hidden" name="returnUrl" value='<?php echo $return; ?>'/>
      <input type="hidden" name="appId" value='2884456a717c4bc71a8c88a284544882'/>
      <input type="hidden" name="orderId" value='<?php echo $orderid; ?>'/>
  </form>
</body>
</html>
