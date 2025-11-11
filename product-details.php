<?php include "config.php"; 
include "header.php";

 
    if(isset($_GET['ssid'])   && isset($_GET['sid']))
    {
        $ssid = $_GET['ssid'];
        $sid = $_GET['sid'];
        
        $selectproduct = mysqli_query($conn,"SELECT * FROM product WHERE subcategory2 = '$ssid' AND subcategory='$sid' AND status = '1' ORDER BY RAND() ");
        
    }

    if(isset($_GET['idpro']))
    {
        $id = base64_decode($_GET['idpro']);
        $selectpro = mysqli_query($conn,"SELECT * FROM product WHERE id = '$id' AND status = '1' ");
        $fetchpro = mysqli_fetch_array($selectpro);
    }
    
    
    
    
    
// add to cart

if(isset($_POST['add_to_cart']))
{
    
    if($_SESSION['user_id']!='')
    {
    // print_r($_POST);print_r($_SESSION);die;
        
        $proid = $_POST['productid'];
        $quantity = $_POST['quantity'];
        $size = $_POST['size'];
        $date = $_POST['date'];
        $userid = $_POST['userid'];
        $totalstock = $_POST['avail_stock'];
        $price = $_POST['price'];
        $mrp = $_POST['mrp'];
        
        
               
            $totalprice = $price * $quantity;
            
            
            $totalmrp = $mrp * $quantity;
                
           
              
            
            $selectcardtabkle=mysqli_query($conn,"SELECT * FROM cart WHERE userid='$userid' AND productid='$proid'  ");
            $numdata=mysqli_num_rows($selectcardtabkle);
            
            $selectcarttable=mysqli_query($conn,"SELECT * FROM cart WHERE userid='$userid' AND productid='$proid'  ");
            $fetchold=mysqli_fetch_array($selectcarttable);
            
            $numdatatab=mysqli_num_rows($selectcarttable);
             
            if($numdata=='0')
            {
                 
                    $insertcart=mysqli_query($conn,"INSERT INTO cart (`userid`, `productid`, `size`, `quantity`, `price`, `mrp`, `date`)
                    VALUES('$userid','$proid','$size','$quantity','$totalprice','$totalmrp','$date')");
                    if($insertcart)
                    {
                        $msg = '<center><div class="alert alert-success" role="alert" style="width:40%">
                      Success ! Your Product added to cart.
                    </div></center>';
                      echo "<script>setTimeout(function(){ window.location = 'cart.php'; },1000);</script>";
                    }
                    else
                    {
                      $msg = '<center><div class="alert alert-primary" role="alert" style="width:40%">
                      Alert ! Something went wrong, Please try again..
                    </div></center>';
                    }
                 
                
            }
            else if($numdatatab>='1')
            {
                $oldquantity = $fetchold['quantity'];
                
                $oldsize = $fetchold['size'];
               
                $totalquantity = $oldquantity + $quantity;
                
                $oldprice = $fetchold['price'];
                
                $newprice = $oldprice + ($price * $quantity);
                
                $oldmrp = $fetchold['mrp'];
                
                $newmrp = $oldmrp + ($mrp * $quantity);
                        
                      
                        $insertcart=mysqli_query($conn,"UPDATE cart SET `quantity`='$totalquantity', `price`='$newprice',
                        `mrp`='$newmrp', `date`='$date' WHERE userid='$userid' AND productid='$proid' AND size='$oldsize' ");
                        if($insertcart)
                        {
                            $msg = '<center><div class="alert alert-success" role="alert" style="width:40%">
                          Success ! Your Product added to cart.
                        </div></center>';
                          echo "<script>setTimeout(function(){ window.location = 'cart.php'; },1000);</script>";
                        }
                        else
                        {
                           $msg = '<center><div class="alert alert-primary" role="alert" style="width:40%">
                          Alert ! Something went wrong, Please try again..
                        </div></center>';
                        }
                    
                }
            
            
         
    
    }
    else
    {
        ?>
        <script>
            window.location.assign('login.php');
        </script>
        <?php
    }
   
   
    
    
    
}


// add to cart close
    
?>

<style>
    .ratings i{
        color:#ffe000;
    }
    
  
</style>
<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
						<a href="index.php" class="hover">Home</a>
						<span>|</span>
					 <?php $subdas = mysqli_query($conn,"SELECT * FROM subcategory WHERE id = '$sid' AND status = '1' ");
				        while($fetchsubdas = mysqli_fetch_array($subdas))
				        { ?>
					<a href="category.php?idcat=<?php echo $fetchsubdas['id']; ?>"  class="hover"><?php echo $fetchsubdas['name']; ?></a>
						<?php } ?>
					<span>|</span>
					 <?php $subdas1 = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE id = '$ssid' AND status = '1' ");
				        while($fetchsubdas1 = mysqli_fetch_array($subdas1))
				        { ?>
					<a href="products.php?ssid=<?php echo $fetchsubdas1['id']; ?>&sid=<?php echo $sid; ?>"  class="hover"><?php echo $fetchsubdas1['name']; ?></a>
						<?php } ?>
						<span>|</span>
					 <?php $subdas = mysqli_query($conn,"SELECT * FROM product WHERE id = '$id' AND status = '1' ");
				        while($fetchsubdas = mysqli_fetch_array($subdas))
				        { ?>
					<a href="javascript:void(0);"  class="hover"><?php echo $fetchsubdas['name']; ?></a>
						<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>



        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding pb-0">
            <div class="container">
                <div class="row">
                    <?php echo $msg; ?>
                    <!-- product details wrapper start -->
                    <div class="col-lg-12 order-1 order-lg-2">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                              <div class="col-lg-6">

                            <div class="product-large-slider">
                                 <?php $image = explode(",",$fetchpro['image']);
                                        foreach($image as $img){ ?>
                                <div class="main-img-box">
                                   
                                    <img src="admin/image/<?php echo $img; ?>" alt="product-details" style="width: 600px;display: inline-block;height: 350px;object-fit: contain;"/>
                                    <a href="admin/image/<?php echo $img; ?>" class="fa fa-expand" data-fancybox="gallery"></a>
                                   
                                </div>
                              <?php } ?>
                            </div>

                            <div class="pro-nav slick-row-10 slick-arrow-style">
                                 <?php $image = explode(",",$fetchpro['image']);
                                        foreach($image as $img){ ?>
                                <div class="pro-nav-thumb">
                                    
                                    <img src="admin/image/<?php echo $img; ?>" alt="product-details" style="height: 100px;object-fit: contain;" />
                                   
                                </div>
                                   <?php } ?>
                            </div>
                        </div>
                          

                                <div class="col-lg-6">
                                    <div class="product-details-des">
                                        <h3 class="product-name"><?php echo $fetchpro['name']; ?></h3>
                                        <span><?php echo $fetchpro['size']; ?></span>
                                          <?php $rating =  $fetchpro['rating']; ?>
                                    
                                    <div class="ratings d-flex">
                                        <?php
                                        if($rating<=1) {
                                        ?>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <?php } elseif($rating<=2) { ?>

                                        <i class="fa fa-star"></i>              
                                        <i class="fa fa-star-half-o"></i> 
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                                 <?php } elseif($rating<=3) { ?>
                                        <i class="fa fa-star"></i>
                                        
                                        <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>  
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                             <?php } elseif($rating<=4) { ?> 
                                             
                                        <i class="fa fa-star"></i>
                                        
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>  
                                            <i class="fa fa-star-o"></i>
                                             <?php } elseif($rating<=4.9) { ?>
                                             
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star-half-o"></i> 
                                          
                                             <?php } elseif($rating==5) { ?>
                                             
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i>  
                                            <?php } ?>
                                        <span>(<?php echo $rating; ?> Star Ratings)</span>
                                    </div><br>
                                        <div class="price-box">
                                            <span class="price-regular">&#8377; <?php echo $fetchpro['sellprice']; ?>.00 /-</span>&nbsp;&nbsp;&nbsp;
                                            <span class="price-old"><del>&#8377; <?php echo $fetchpro['mrp']; ?>.00 /-</del></span>
                                            
                                        </div>
                                         <?php
                                             $saveamount=$fetchpro['mrp'] - $fetchpro['sellprice'];
                                            $countper = $saveamount/$fetchpro['mrp'];
                                            $lastpercent = $countper*100; ?><br>
                                        <span>
                                            Saved Amount : &#8377; <?php echo $saveamount; ?>.00 /-  
                                        </span>
                                        <span style="color:#064606">
                                            (Flat <?php echo ceil($lastpercent); ?>% Offer)
                                        </span><br>
                                         
                                        <div class="availability">
                                            <!--<i class="fa fa-check-circle"></i>-->
                                            <!--<span><?php echo $fetchpro['stock']; ?> in stock</span>-->
                                        </div>
                                        <div class="pro-desc">
                                            <?php echo $fetchpro['title']; ?>
                                        </div> 
                                        <form method="POST" <?php if($_SESSION['user_id']==''){ echo 'action="cart.php"'; } ?>>
                                      
                                     
                                        <div>
                                        
                                        <span style="color:red"><?php if(isset($msg1)){ echo $msg1; } ?></span>
                                        </div>
                                       
                                        <table class="table table-bordered group-product-table">
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>
                                                        <div class="pro-qty"><input type="text" name="quantity" value="1"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                                <input type="hidden" name="avail_stock" id="availablestock" value=""> 
                                                <input type="hidden" name="productid" value="<?php echo $fetchpro['id']; ?>"> 
                                                <input type="hidden" name="date" value="<?php echo date('d-m-Y'); ?>">
                                                <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
                                                <input type="hidden" name="price" value="<?php echo $fetchpro['sellprice']; ?>">
                                                <input type="hidden" name="mrp" value="<?php echo $fetchpro['mrp']; ?>">
                                                <input type="hidden" name="name" value="<?php echo $fetchpro['name']; ?>">
                                        
                                         <div class="quantity-cart-box d-flex align-items-center">
                                            <div class="action_link">
                                         
                                                <button type="submit" id="submitbtn" name="add_to_cart" class="btn btn-cart2" >Add To Cart</button>
                                               
                                            </div>
                                        </div>
                                         </form>
                                        <div class="like-icon">
                                            <a class="facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?=$metaurl?>" title="facebook"><i class="fa fa-facebook"></i> facebook</a>
                                       <a class="google" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $fetchpro['name']; ?> <?php echo $metaurl?>" title="Whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                                       <a class="twitter" target="_blank" href="https://twitter.com/share?text=<?php echo $fetchpro['name']; ?>&url=<?php echo $metaurl?>" title="Twitter"><i class="fa fa-twitter"></i> Tweet</a>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details inner end -->

                        <!-- product details reviews start -->
                         <!-- product details reviews end -->
                    </div>
                    <!-- product details wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
        

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
        
        
        <script>
        $(document).ready(function(){
   
            $('#stockselect').on("change",function () {
                var stockselect = $(this).val();
                var prdid = <?php echo $fetchpro['id']; ?>;
                // alert(prdid);
                 $.ajax({
                    url: "find.php",
                    type: "POST",
                    data: {stockselect:stockselect,
                    prdid:prdid},
                    cache:false,
                    success: function (response) { 
                        $("#availablestock").val(response);
                        if(response<1)
                        {
                            $('#errordata').html('Out of Stock').css('color','red');
                            $('#submitbtn').attr('disabled', true);
                        }
                        else if(response<10)
                        {
                            $('#errordata').html('Last few remaining! only ' + response + ' left').css('color','#bb4609');
                             $('#submitbtn').removeAttr('disabled', true);

                        }
                        else if(response>10)
                        {
                            $('#errordata').html('Available Stock').css('color','green');
                             $('#submitbtn').removeAttr('disabled', true);
                        }
                    },
                });
            }); 
        
        });
        </script>
       

<?php include "footer.php" ?>
 