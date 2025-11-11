<?php
require'../config.php';
session_start();
if($_SESSION['user_id']!='')
{
   $uid=$_SESSION['user_id'];
    
}
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Payment Status</title>
  </head>
  <body>
      <?php

if($isValidChecksum == "TRUE") {
    	if (isset($_POST) && count($_POST)>0 )
	{ 
	    
	    
				?>
			
    <?php
	}
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
	       $txnid=$_POST['ORDERID'];
	      $order=$_POST['TXNID'];
		  


 
      $updtpoay="UPDATE payment SET paystatus='Success' , orderid='$order', orderstatus = 'Pending' WHERE txn_id='$txnid'";
    
     $updrtyt=mysqli_query($conn,$updtpoay);
    
     
        
          $select_user="SELECT * FROM payment WHERE txn_id='$txnid'";
        $selectid=mysqli_query($conn,$select_user);
        $users=mysqli_fetch_array($selectid);
          $user_id = $users['userid'];
        
        $updtorder="UPDATE tbl_order SET `status`='1' WHERE userid ='$user_id'";
        $updtorderquery=mysqli_query($conn,$updtorder);
        $dlt="DELETE FROM cart WHERE userid='$user_id' ";
          $dtquery=mysqli_query($conn,$dlt);  
           
        ?>
				<div class="container" style="margin-top:16%">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-6">
                             <div class="card">
                              <div class="card-header">
                              Payment Status
                              </div>
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $_POST['RESPMSG']; ?></h5>
                                <p class="card-text">Your <?php echo $_POST['RESPMSG']; ?>. your transaction id is <br><?php echo $_POST['TXNID']; ?>.</p>
                                <?php  $_SESSION['user_id']=$user_id;?>
                                <a href="../orders.php" class="btn btn-primary">Go to Homepage</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php

	}
	else {
	     $updtpoay="UPDATE payment SET paystatus='Failure' , orderid='$order' WHERE txn_id='$txnid'";
    
     $updrtyt=mysqli_query($conn,$updtpoay);
		?>
		        <div class="container" style="margin-top:16%">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-6">
                             <div class="card">
                              <div class="card-header">
                              Payment Status
                              </div>
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $_POST['RESPMSG']; ?></h5>
                                <p class="card-text">Your <?php echo $_POST['RESPMSG']; ?>. your transaction id is <br><?php echo $_POST['TXNID']; ?>.</p>
                                <?php  $_SESSION['user_id']=$user_id;?>
                                <a href="../index.php" class="btn btn-primary">Go to Homepage</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
		<?php
		
	}


	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>