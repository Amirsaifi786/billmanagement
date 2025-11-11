<?php 
 
 require'../config.php';
require('../razorpay-php-master/Razorpay.php');

use Razorpay\Api\Api;
 $user = ($_SESSION['user_id']);
// print_r($_POST);
 if(isset($_POST) && !empty($_POST)){
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $razorpay_signature = $_POST['razorpay_signature']; 
    

                    
                    $keyId = "rzp_live_VXhZQlCj8JZjKl";
                    $keySecret = "jbt6bxoiDYU4BXjqNnZsCicr";
                    $api = new Api($keyId, $keySecret);
                    
                    
                    $payments = '';
                     $payments = $api->order->fetch($razorpay_order_id)->payments();
                    
                    $randvoucher = date('YmdHis').rand(11111111,99999999);
                    $status = $payments['items'][0]['status'];
                    // $price = $payments['items'][0]['amount'];
                    $txnid = $payments['items'][0]['id'];
                    $payment_method = $payments['items'][0]['method'];
                     
                     $selectexistinsertdata = mysqli_query($conn,"SELECT * FROM tbl_order WHERE userid='$user' AND status='Pending' ORDER BY id DESC");
                     if(mysqli_num_rows($selectexistinsertdata)>0)
                     {
                        $fetchalreadyinserted = mysqli_fetch_array($selectexistinsertdata);
                        if($fetchalreadyinserted['orderid'] == $razorpay_order_id)
                        {
                            $uamount=$fetchalreadyinserted['amount']; 
                            
                             if($status=='captured')
                             {
                                   $update = mysqli_query($conn,"UPDATE tbl_order SET status='Success', payment_method='$payment_method' WHERE orderid='$razorpay_order_id'");
                                   
                             }
                             else if($status=='failed')
                             {
                                  $update = mysqli_query($conn,"UPDATE tbl_order SET status='Failure',  payment_method='$payment_method', txnid='$txnid' WHERE orderid='$razorpay_order_id'");
                             }
                             else
                             {
                                 $status='Pending';
                                    $update = mysqli_query($conn,"UPDATE tbl_order SET status='Pending',  txnid='$txnid' WHERE orderid='$razorpay_order_id'");
                             }
                        } 
                        else
                         {
                             $status='failed';
                                $update = mysqli_query($conn,"UPDATE tbl_order SET status='Failure', payment_method='$payment_method', txnid='$txnid' WHERE orderid='$razorpay_order_id'");
                         }
                     }
                    
  
        // echo "<script>setTimeout(function(){ window.location = 'https://www.healfate.com/payStatus'; },2000);</script>";
 

 ?>
<form id="redirectForm" method="POST" action="../orders.php">
         <input type="hidden" name="status" value="<?php echo $status; ?>">
 </form>

<script type="text/javascript">
    document.getElementById('redirectForm').submit();
</script>
<?php
}
?>