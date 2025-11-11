<?php 
include "header.php"; 

    if(isset($_GET['idcat']))
    {
         $sid = $_GET['idcat'];
        $ssid = $_GET['ssid'];
     
        $selectproduct = mysqli_query($conn,"SELECT * FROM product WHERE subcategory='$sid' AND status = '1' ");
        
    }

?>


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
					<a href="javascript:void(0);"  class="hover"><?php echo $fetchsubdas1['name']; ?></a>
						<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products-sec">
	<div class="container">
	 <div class="row">

		<div class="col-lg-3 col-md-3 col-12">
			<div class="products-sidebar">
				<div class="pro-sidebar-box">
				    <?php $sub = mysqli_query($conn,"SELECT * FROM subcategory WHERE id = '$sid' AND status = '1' ");
				        while($fetchsub = mysqli_fetch_array($sub))
				        { ?>
					<h2><?php echo $fetchsub['name']; ?></h2>
					<?php }
					    $list = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE subcategory = '$sid' AND status = '1' ");
					    while($fetchlist = mysqli_fetch_array($list))
					    { ?>
					<a href="products.php?ssid=<?php echo $fetchlist['id']; ?>&sid=<?php echo $fetchlist['subcategory']; ?>"><?php echo $fetchlist['name']; ?></a>
					<?php } ?>
				 
				</div>
			</div>
		</div>

		<div class="col-lg-9 col-md-9 col-12">
			<div class="products-main">
				
				<div class="row g-2 ">

					<div class="col-lg-12">
						<div class="products-title">
						    <?php
						    	$listdata = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE subcategory = '$sid' AND id='$ssid' AND status = '1' ");
                                $fetchdata=mysqli_fetch_array($listdata);
                                
                                 // breandcum
                                    $cat1 = mysqli_query($conn,"SELECT * FROM subcategory WHERE status = '1' AND id='$sid' ");
                                    $fet=mysqli_fetch_array($cat1);
                                    
                                    $cat2 = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE status = '1' AND id='$ssid' ");
                                    $fat=mysqli_fetch_array($cat2);
                            ?>
							<h2><?php echo $fetchdata['name']; ?></h2>
						</div>
					</div>
                <?php 
                    while($fetchproduct = mysqli_fetch_array($selectproduct))
                    { ?>
					<div class="col-lg-4 col-md-6 col-6">
						  <!-- product single item start -->
                            <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fetchproduct['subcategory2']; ?>&sid=<?php echo $fetchproduct['subcategory']; ?>">
                              <div class="product-item products">
                                  <div class="product-thumb">
                                      <?php 
                                        $image = explode(",",$fetchproduct['image']);
                                        foreach($image as $img)
                                        { ?>
                                      <img src="admin/image/<?php echo $img; ?>" alt="product thumb">
                                      <?php break; } ?>
                                      <!--<div class="wish">-->
                                      <!--  <a href="#">-->
                                      <!--	    <i class="fa fa-heart"></i>-->
                                      <!--	</a>-->
                                      <!--</div>-->
                                  </div>
                                  <div class="product-content">
                                      <div class="name">
                                          <h2>
                                           <?php 
                                        
                                          if(strlen($fetchproduct['name'])>22){
                                                echo $text=substr($fetchproduct['name'],0,22)."...";
                                          }else{
                                              echo   $text=$fetchproduct['name'];
                                          }
                                          ?>
                                          </h2>
                                      </div>
                                      <div class="price">
                                          <div>
                                            <span class="sale">&#8377 <?php echo $fetchproduct['sellprice']; ?>.00</span>
                                            <span class="real">&#8377 <?php echo $fetchproduct['mrp']; ?>.00</span>
                                          </div>
                                      </div>
                                      <?php
                                             $saveamount=$fetchproduct['mrp'] - $fetchproduct['sellprice'];
                                            $countper = $saveamount/$fetchproduct['mrp'];
                                            $lastpercent = $countper*100; ?>
                                       <div class="delivery">
                                          <h4>Flat <?php echo ceil($lastpercent); ?>% Off</h4>
                                      </div>
                                  </div>    
                              </div>
                            </a>
                            <!-- product single item end -->
					</div>
                <?php } ?>

				 


		

				</div>


			</div>
		</div>

		</div>
	</div>
</section>


<?php include "footer.php" ?>