<?php include "config.php"; 
$ssid="";
   if (isset($_GET['cat'])) {
    $ssid = base64_decode($_GET['cat']);
    $selectproduct = mysqli_query($conn, "SELECT * FROM product WHERE category = '$ssid' AND status = '1' ORDER BY RAND() limit 15 ");
}


 require'header.php';
 

  
?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index" class="hover">Home</a>
						<span>|</span>
					 <?php $subdas = mysqli_query($conn,"SELECT name FROM category WHERE id = '$ssid' AND status = '1' ");
				        $fetchsubdas = mysqli_fetch_array($subdas);
				         ?>
					<a href="javascript:void(0);"  class="hover"><?php echo $fetchsubdas['name']; ?></a>
						<?php  ?>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products-sec">
	<div class="container">
	 <div class="row">


		<div class="col-lg-12 col-md-12 col-12">
			<div class="products-main">
				
				<div class="row g-2 " id="product-container">

					<div class="col-lg-12">
						<div class="products-title">
						    <?php
						    	$listdata = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE subcategory = '$sid' AND id='$ssid' AND status = '1' ");
                                $fetchdata=mysqli_fetch_array($listdata);
                                
                            ?>
							<h2><?php echo $fetchdata['name']; ?></h2>
						</div>
					</div>
                        <?php 
                            while($fetchproduct = mysqli_fetch_array($selectproduct))
                            { ?>
        					<div class="col-lg-3 col-md-6 col-6">
        						  <!-- product single item start -->
                                    <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fat['id']; ?>&sid=<?php echo $fet['id']; ?>">
                                      <div class="product-item products">
                                          <div class="product-thumb">
                                              <?php 
                                                $image = explode(",",$fetchproduct['image']);
                                                foreach($image as $img)
                                                { ?>
                                              <img src="admin/image/<?php echo $img; ?>" alt="product thumb">
                                              <?php break; } ?><?php
                                                     $saveamount=$fetchproduct['mrp'] - $fetchproduct['sellprice'];
                                                    $countper = $saveamount/$fetchproduct['mrp'];
                                                    $lastpercent = $countper*100; ?>
                                               <div class="ribbon">
                                                  <span>Flat <?php echo ceil($lastpercent); ?>% Off</span>
                                              </div>
                                          </div>
                                          <div class="product-content">
                                              <div class="name">
                                                  <h2>
                                                    <?php 
                                                    $f=$fetchproduct['name'];
                                                
                                                  if(strlen($f)>22){
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
                                          </div>    
                                      </div>
                                    </a>
                                    <!-- product single item end -->
        					</div>
        					  
        
                        <?php } ?>

				 
                          
		

				</div>
				 <div id="loader">
                        <span>Loading...</span>
                    </div>
			</div>
		</div>

		</div>
	</div>
</section>
<script>
    $(document).ready(function() {
        let page = 2;
        let loading = false;
        let noMoreProducts = false;

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500 && !noMoreProducts) {
                if (!loading) {
                    loading = true;
                    $('#loader').show();

                    $.ajax({
                        url: 'product_load_ajax.php',
                        type: 'GET',
                        data: {
                            page: page
                        },
                        success: function(response) {
                            if (response) {
                                $('#product-container').append(response);
                                page++;
                            } else {
                                $('#loader').text('No more products to load');
                                noMoreProducts = true;
                            }
                        },
                        complete: function() {
                            $('#loader').hide();
                            loading = false;
                        }
                    });
                }
            }
        });
    });
    </script>


<?php include "footer.php" ?>
 
 