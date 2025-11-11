<?php
include "header.php";

$orderid = base64_decode($_REQUEST['oid']);
$selectorders = mysqli_query($conn, "SELECT * FROM payment WHERE txn_id='$orderid'");
$fetch = mysqli_fetch_array($selectorders);
$prod = $fetch['productid'];
$mysqli_product = mysqli_query($conn, "SELECT * FROM product WHERE id='$prod'");
$product = mysqli_fetch_array($mysqli_product);

$selectorders12 = mysqli_query($conn, "SELECT  SUM(totalprice) as totalprice, SUM(totalpricewithgst) as totalpricewithgst FROM payment WHERE txn_id='$orderid'");
$row = mysqli_fetch_array($selectorders12);

?>


<section class="inner-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb">
                    <a href="index.php" class="hover">Home</a>
                    <span>|</span>
                    <a href="#">Order Details</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="order-detail">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8"><?php
                                    $selectorders1 = mysqli_query($conn, "SELECT * FROM payment WHERE txn_id='$orderid'");
                                    while ($fetch1 = mysqli_fetch_array($selectorders1)) {

                                        $proid = $fetch1['productid'];
                                        $mysqli_product = mysqli_query($conn, "SELECT * FROM product WHERE id='$proid'");
                                        $fetch23 = mysqli_fetch_array($mysqli_product);
                                    ?>
                    <div class="or-d-flex">
                        <div class="box1">
                            <?php
                                        $image = explode(",", $fetch23['image']);
                                        foreach ($image as $img) { ?>
                                <img src="admin/image/<?php echo $img; ?>">
                            <?php break;
                                        } ?>
                        </div>
                        <div class="box2">
                            <h2><?php echo $fetch1['productname']; ?></h2>
                            <h3>Qty. : <?php echo $fetch1['quantity']; ?></h3>
                            <div>
                                <!--<h4>HST1169</h4>-->
                                <h4>Rs. <?php echo $fetch1['totalprice']; ?> /-</h4>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php } ?>


                <div class="row">

                    <div class="col-lg-12">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Track Parcel
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="accordion-table">
                                            <table class="table">
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Item Subtotal</th>
                                                    <th>Status</th>
                                                    <th>Order Date</th>
                                                    <th>View Order</th>
                                                </tr>

                                                <tr>
                                                    <td>#<?php echo $fetch['txn_id']; ?></td>
                                                    <td>Rs. <?php echo $row['totalprice']; ?> /-</td>
                                                    <td><?php echo $fetch['orderstatus']; ?></td>
                                                    <td><?php $date = $fetch['date'];

                                                        echo date("j F, Y | h:i A", strtotime($date)); ?></td>
                                                    <td><a href="download-pdf.php?oid=<?php echo $fetch['txn_id']; ?>" target="_blank">View</a></td>
                                                </tr>
                                            </table>
                                        </div>


                                        <div class="accordion-table">
                                            <h3>Order Tracking</h3>
                                            <table class="table">
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>

                                                <tr>
                                                    <td><?php $date = $fetch['date'];

                                                        echo date("j F, Y | h:i A", strtotime($date)); ?></td>
                                                    <td>Pending</td>
                                                </tr>
                                                <?php
                                                $selectstatus = mysqli_query($conn, "SELECT * FROM orderstatus WHERE txn_id='$orderid'");
                                                while ($order = mysqli_fetch_assoc($selectstatus)) { ?>
                                                    <tr>
                                                        <td><?php $date = $order['date'];

                                                            echo date("j F, Y | h:i A", strtotime($date)); ?></td>
                                                        <td><?php echo $order['status']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="order-detail-content">
                            <h2>MRP Price</h2>
                            <h3>Rs. <?php echo $row['totalpricewithgst']; ?> /-</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="order-detail-content">
                            <h2>Shipping</h2>
                            <h3>Rs. <?php echo $row['totalprice']; ?> /-</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="order-detail-content">
                            <h2>Discounts</h2>
                            <h3>Rs. <?php echo $row['totalpricewithgst'] - $row['totalprice']; ?> /-</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="order-detail-content">
                            <h2>Order Total</h2>
                            <h3>Rs. <?php echo $row['totalprice']; ?> /-</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include "footer.php" ?>