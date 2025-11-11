<?php
require 'config.php';
session_start();

// Redirect to login if user is not logged in
// if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit;
// }

$user_id = $_SESSION['user_id'];

// Handle delete cart item
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    $delete = mysqli_query($conn, "DELETE FROM `cart` WHERE `id` = '$cart_id' AND `userid` = '$user_id'");
    if ($delete) {
        echo '<script>window.location.assign("cart.php");</script>';
    } else {
        echo '<script>alert("Error deleting cart item.");</script>';
    }
}

include "header.php";
?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Cart</a>
				</div>
			</div>
		</div>
	</div>
</section>



        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Image</th>
                                            <th class="pro-title">Product Name</th>
                                            <!--<th class="pro-title">Size</th>-->
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($user_id!='')
                                        {
                                            $cart = mysqli_query($conn,"SELECT * FROM cart WHERE userid = '$user_id' ");
                                            while($fetchcart = mysqli_fetch_array($cart))
                                            {   $productid = $fetchcart['productid'];
                                                $pro = mysqli_query($conn,"SELECT * FROM product WHERE id = '$productid' ");
                                                $fetchpro = mysqli_fetch_array($pro);
                                            ?>
                                        <tr>
                                            <td class="pro-thumbnail">
                                                <?php 
                                                    $images = explode(",", $fetchpro['image']);
                                                    foreach($images as $img)
                                                    { ?>
                                                <a href="product-details.php?idpro=<?php echo base64_encode($fetchpro['id']); ?>"><img class="img-fluid" src="admin/image/<?php echo $img; ?>" alt="Product" /></a>
                                                <?php break; } ?>
                                            </td>
                                            <td class="pro-title"><a href="product-details.php?idpro=<?php echo base64_encode($fetchpro['id']); ?>"><?php echo $fetchpro['name']; ?></a></td>
                                             <td class="pro-price"><span>&#8377; <?php echo $fetchpro['sellprice']; ?></span></td>
                                            <td class="pro-quantity">
                                                 <?php echo $fetchcart['quantity']; ?>
                                            </td>
                                            <td class="pro-subtotal"><span>&#8377; <?php echo $fetchcart['price']; ?></span></td>
                                            <td class="pro-remove"><a href="cart.php?cart_id=<?php echo $fetchcart['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                       <?php } }
                                       else  
                            			{
                            				$total = 0;
                            				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
                            				$cart_data = json_decode($cookie_data, true);
                            				foreach($cart_data as $keys => $values)
                            				{
                            				    $productid = $values['item_id'];
                                                $pro = mysqli_query($conn,"SELECT * FROM product WHERE id = '$productid' ");
                                                $fetchpro = mysqli_fetch_array($pro);
                            			?>
                            				<tr>
                            					<td class="pro-title">
                            					    <?php 
                                                    $images = explode(",", $fetchpro['image']);
                                                    foreach($images as $img)
                                                    { ?>
                                                    <a href="product-details.php?idpro=<?php echo base64_encode($fetchpro['id']); ?>&ssid=<?php echo $fetchpro['subcategory2']; ?>&sid=<?php echo $fetchpro['subcategory']; ?>"><img class="img-fluid" src="admin/image/<?php echo $img; ?>" alt="Product" /></a>
                                                    <?php break; } ?>
                                                    </td>
                            					<td class="pro-title"><a href="product-details.php?idpro=<?php echo base64_encode($fetchpro['id']); ?>&ssid=<?php echo $fetchpro['subcategory2']; ?>&sid=<?php echo $fetchpro['subcategory']; ?>"><?php echo $values["item_name"]; ?></a></td>
                             					<td class="pro-title">₹ <?php echo number_format($values['item_price']); ?></td>
                            					<td class="pro-title"><?php echo $values['item_quantity']; ?></td>
                            					<td class="pro-title">₹ <?php echo number_format($values['item_quantity'] * $values['item_price'], 2);?></td>
                            					<td class="pro-title"><a href="cart.php?action=delete&id=<?php echo $values['item_id']; ?>&size=<?php echo $values['item_size']; ?>"><i class="fa fa-trash-o"></i></td>
                            				</tr>
                            			<?php	
                            					$total = $total + ($values['item_quantity'] * $values['item_price']);
                            				}
                            			}
                            		 
                            			?>
                            			</tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="cart-update">
                                    <a href="index.php" class="btn btn-sqr">Shop More</a>
                                      <?php if ($fetchpro > 0): ?>
                                <a href="checkout.php" class="btn btn-sqr">Proceed To Checkout</a>
                            <?php else: ?>
                                <button class="btn btn-sqr" style="background: gray; cursor: not-allowed;" disabled>Proceed To Checkout</button>
                                <p style="
                                    margin-top: 20px;
                                    color: #721c24;
                                    font-weight: bold;
                                    font-size: 16px;
                                    border: 2px solid #373c1e;
                                    border-radius: 10px;
                                    padding: 10px;
                                    text-align: center;">
                                    <a href="products?cat=MTU=" style="color: inherit; text-decoration: none;">
                                        Your cart is empty. Please add items to proceed.
                                    </a>
                                </p>
                            <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->



<?php include "footer.php" ?>