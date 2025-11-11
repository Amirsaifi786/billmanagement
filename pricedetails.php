<?php
require'config.php';
ob_start();
require'session_check.php'; 
session_start();

     $grandtotal = $_SESSION['totalprice'];
    
    $dltolditm=mysqli_query($conn,"DELETE FROM payment WHERE userid='$user_id' AND paystatus='Failure'");

    if(isset($_REQUEST['pincode']))
    {
        $pincode = base64_decode($_REQUEST['pincode']);
        $location = mysqli_query($conn,"SELECT * FROM location WHERE pincode = '$pincode' ");
        $fetchlocation = mysqli_fetch_array($location);
        $deliverycharge = $fetchlocation['deliverycharges'];
    }
  
 
    $selectold = mysqli_query($conn,"SELECT * FROM cart WHERE userid='$user_id'");
    $tn=mysqli_num_rows($selectold);
    if($tn>0)
    {
        $dlt=mysqli_query($conn,"DELETE FROM tbl_order WHERE userid='$user_id'");
        while($rowcart=mysqli_fetch_array($selectold))
        {
              $product_id=$rowcart['productid'];
              $mrp=$rowcart['mrp']; 
              $quantity=$rowcart['quantity']; 
              $size=$rowcart['size']; 
    
            $sqlselct=mysqli_query($conn,"SELECT * FROM product WHERE id='$product_id'");
            $fetchpro=mysqli_fetch_array($sqlselct);
            $productprice=$fetchpro['sellprice']; 
                       $gst=($productprice*18)/100;
                      $showpricesell = $gst + $productprice;
            $prdtname=$fetchpro['name'];
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
    
    
             $insertorder="INSERT INTO tbl_order(`userid`, `productid`,`productname`, `sellprice`, `mrptotal`, `quantity`,`size` , `datetime`) 
              VALUES('$user_id','$product_id','$prdtname','$productprice','$mrp','$quantity','$size','$timestamp')";
             $mysql_insrt_query=mysqli_query($conn,$insertorder);
    
        }
    }
    
    
    
    $selectuser="SELECT * FROM users WHERE id='$user_id'";
    $queryus=mysqli_query($conn,$selectuser);
    $fetchuser=mysqli_fetch_assoc($queryus);
    $user_name=$fetchuser['name'];
    $user_mobile=$fetchuser['mobile'];
    
    $user_email=$fetchuser['email'];
     
    
    $select_data=mysqli_query($conn,"SELECT * FROM tbl_order WHERE userid='$user_id' AND status='0'");
    $txnId=rand(11111111,99999999);
    
    while($fetch_dat=mysqli_fetch_array($select_data))
    {
        $product_id=$fetch_dat['productid'];
        $quantity=$fetch_dat['quantity'];
        $sellprice=$fetch_dat['sellprice'];
        $mrptotal=$fetch_dat['mrptotal'];
        $prdtnameas=$fetch_dat['productname'];
        $size = $fetch_dat['size'];
        date_default_timezone_set('Asia/Kolkata');
        $todaydate = date("Y-m-d H:i:s");
        $sellpricetotal=$sellprice*$quantity; 
        $mrpnewtotal=$mrptotal*$quantity; 
    
    $totalamntgrand = $sellpricetotal;
    
         $insertpayment="INSERT INTO payment ( `productid`,`productname`,`size`, `userid`, `quantity`, `price`, `gstprice`, `totalprice`,  `totalpricewithgst`, `paymentmethod`, 
        `txn_id`, `date`, `paystatus`)VALUES('$product_id','$prdtnameas','$size','$user_id','$quantity','$sellprice','$deliverycharge','$sellpricetotal', '$mrpnewtotal','PayTm','$txnId','$todaydate','Failure')";
 
       $insrtdtaquery=mysqli_query($conn,$insertpayment);
       
    }    
  
$appId='2884456a717c4bc71a8c88a284544882';
$Secret ='TEST4359433d0755aef06ad413b08f878a3025f9f149';

if(isset($_POST['paynow']))
{
    $appid=$_POST['appId'];
    $orderId=$_POST['orderId'];
    $orderAmount=$_POST['orderAmount'];
    $orderCurrency=$_POST['orderCurrency'];
    $orderNote=$_POST['orderNote'];
    $customerName=$_POST['customerName'];
    $customerEmail=$_POST['customerEmail'];
    $customerPhone=$_POST['customerPhone'];
    $returnUrl=$_POST['returnUrl'];
    $notifyUrl=$_POST['notifyUrl']; 
    
    $_SESSION['appid']=$appid;
    $_SESSION['orderid']=$orderId;
    $_SESSION['orderamount']=$orderAmount;
    $_SESSION['currency']=$orderCurrency;
    $_SESSION['Note']=$orderNote;
    $_SESSION['name']=$customerName;
    $_SESSION['email']=$customerEmail;
    $_SESSION['phone']=$customerPhone;
    $_SESSION['return']=$returnUrl;
    $_SESSION['notify']=$notifyUrl; 
    
    header('location:request.php');
}
 

require'header.php'; 
?>

        
        
        
        <section class="inner-top">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12">
        				<div class="breadcrumb">
        					<a href="index.php" class="hover">Home</a>
        					<span>|</span>
        					<a href="#">Price Details</a>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        
               
            
            <?php 
                                            
                $cartdata = mysqli_query($conn,"SELECT SUM(price) as totalprice, SUM(mrp) as totalmrp,id FROM cart WHERE userid = '$user_id' ");
                $fetchcartdata = mysqli_fetch_array($cartdata);
                
                $totalprice = $fetchcartdata['totalprice'];
                $totalmrp = $fetchcartdata['totalmrp'];
                
                $discount = $totalmrp - $totalprice;
                
                
                ?>
                    <!-- Order Summary Details -->
        <div class="checkout-page-wrapper section-padding ">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-6 ">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                      
                                        <tbody>
                                            <tr>
                                                <td>Cart Total</td>
                                                <td>&#8377; <?php echo $totalmrp; ?></td>
                                            </tr>
                                           
                                            <tr>
                                                <td class="dis">Discount (-)</td>
                                                <td class="dis">&#8377; <?php echo $discount; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>&#8377; <?php echo $totalprice; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            
                                            <tr>
                                                <td class="dis">Delivery Charge (+)</td>
                                                <td class="dis">&#8377; 0</td>
                                            </tr>
                                             
                                            <tr>
                                                <td>Total Amount (Inc. GST)</td>
                                                <td>&#8377; <?php echo $totalprice; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                              <form method="POST" action="payments/pay.php">
                                
                                <input name="userid" type="hidden" value="<?=$user_id;?>">
                                <input name="amount" type="hidden" value="<?=$totalprice;?>">
                                <input name="cartid" type="hidden" value="<?=$fetchcartdata['id'];?>">

                                <button type="submit" id="paynow" class="login-btn" value="Pay">Pay Now</button>
                                <br> 
                                <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php require'footer.php'; ?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var payNowButton = document.getElementById('payNow');

    payNowButton.addEventListener('click', function() {
   // alert('tet');//
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'payments/pay';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'price';
        input.value = "<?=$fetchcartdata['id'];?>";

        form.appendChild(input);
        document.body.appendChild(form);

        form.submit();
    });
});
</script>