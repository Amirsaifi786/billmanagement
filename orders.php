<?php include "header.php";

$orders = mysqli_query($conn,"SELECT * FROM payment WHERE userid = '$user_id' AND paystatus='Success'   ORDER BY id DESC  ");
$num=mysqli_num_rows($orders);

?>


<section class="inner-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb">
                    <a href="index.php" class="hover">Home</a>
                    <span>|</span>
                    <a href="#">Order</a>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="order2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="order2-title">
                    <h2>My Orders <span>(Displaying <?php echo $num; ?> Orders)</span></h2>
                </div>
<?php 
 
        while($fetchorders = mysqli_fetch_array($orders))
            {  
                $proid=$fetchorders['productid'];
                $mysqli_product=mysqli_query($conn,"SELECT * FROM product WHERE id='$proid'");
                $fetch=mysqli_fetch_array($mysqli_product);
            ?>
                <div class="order2-flex mt-4">
                    <div class="box1">
                        <h4 class="mb-3">Order Status : <?php echo $fetchorders['orderstatus']; ?></h4>
                         <?php 
                                        $image = explode(",",$fetch['image']);
                                        foreach($image as $img)
                                        { ?>
                                      <img src="admin/image/<?php echo $img; ?>">
                                      <?php break; } ?>
                        <!--<img src="assets/images/p1.jpg">-->
                    </div>
                    <div class="box2">
                        <div>
                            <h3>Order Number</h3>
                            <h4>#<?php echo $fetchorders['txn_id']; ?></h4>
                        </div>
                        <div>
                            <h3>Order Date / Time</h3>
                            <h4><?php $date = $fetchorders['date']; 
                            
                            echo date("j F, Y | h:i A", strtotime($date)); ?></h4>
                        </div>
                        <div>
                            <a href="order-details.php?oid=<?php echo base64_encode($fetchorders['txn_id']); ?>" class="order2-btn">View Order</a>
                        </div>
                    </div>
                </div><hr>
                <?php } ?>
            </div>
        </div>
    </div>
</section>



<?php include "footer.php" ?>