<?php include "header.php"; 

 
if(isset($_GET['searchitem']))
{
    $searchitem=$_GET['searchitem'];
    $selectproduct1=mysqli_query($conn,"SELECT * FROM `product` WHERE status='1' AND `name` LIKE '%$searchitem%' ");
}

  
if(isset($_GET['newarrival']))
{
    $new = $_GET['newarrival']; 
    $rating = $_GET['rating'];
    $gender = $_GET['gender'];
     
    $selectproduct1 = mysqli_query($conn,"SELECT * FROM `product` WHERE status='1' AND `name` LIKE '%$searchitem%'  $rating $gender $new  ");
    
}
  else if(isset($_GET['rating']))
    {
        $rating = $_GET['rating'];
           $gender = $_GET['gender'];
        $selectproduct1 = mysqli_query($conn,"SELECT * FROM `product` WHERE status='1' AND `name` LIKE '%$searchitem%'  $rating $gender");
         
    }
 else if(isset($_GET['gender']))
    {
         $gender=$_GET['gender'];
         
        $selectproduct1 = mysqli_query($conn, "SELECT * FROM product WHERE  status = '1' AND  `name` LIKE '%$searchitem%'  $gender ");
    }

?>



<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Search Results</a>
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
<form method="GET"  >
    
    <input type="hidden" value="<?php echo $searchitem; ?>" name="searchitem">
    
                        

                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        
                        <h6 class="sidebar-title">New Arrivals</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY id DESC LIMIT 18"<?php if($_GET['newarrival']=='ORDER BY id DESC LIMIT 18'){echo 'checked';} ?> onchange="this.form.submit()" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Latest Arrivals</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY rating DESC LIMIT 6"<?php if($_GET['newarrival']=='ORDER BY rating DESC LIMIT 6'){echo 'checked';} ?> onchange="this.form.submit()" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Best Sellers</label>
                                    </div>
                                </li>
                                 
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->

                   

                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h6 class="sidebar-title">Prices</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                             
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY sellprice DESC"<?php if($_GET['newarrival']=='ORDER BY sellprice DESC'){echo 'checked';} ?> onchange="this.form.submit()"  id="customCheck10">
                                        <label class="custom-control-label" for="customCheck10">Low To High</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY sellprice ASC"<?php if($_GET['newarrival']=='ORDER BY sellprice ASC'){echo 'checked';} ?> onchange="this.form.submit()"  id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">High To Low</label>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->
                    
                    
                     <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h6 class="sidebar-title">Category</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                             
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="gender" value="AND gender = 'male'"<?php if($_GET['gender']=="AND gender = 'male'"){echo 'checked';} ?> onchange="this.form.submit()"  id="customCheck12">
                                        <label class="custom-control-label" for="customCheck12">Male</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="gender" value="AND gender = 'female'"<?php if($_GET['gender']=="AND gender = 'female'"){echo 'checked';} ?> onchange="this.form.submit()"  id="customCheck13">
                                        <label class="custom-control-label" for="customCheck13">Female</label>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->
                    
                    

                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h6 class="sidebar-title">Ratings</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating = '1'"<?php if($_GET['rating']=="AND rating = '1'"){echo 'checked';} ?> onchange="this.form.submit()" onchange="this.form.submit()" id="customCheck14">
                                        <label class="custom-control-label" for="customCheck14">
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating <= '2'"<?php if($_GET['rating']=="AND rating <= '2'"){echo 'checked';} ?> onchange="this.form.submit()"  onchange="this.form.submit()" id="customCheck15">
                                        <label class="custom-control-label" for="customCheck15">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating <= '3'"<?php if($_GET['rating']=="AND rating <= '3'"){echo 'checked';} ?> onchange="this.form.submit()" value="3" onchange="this.form.submit()" id="customCheck16">
                                        <label class="custom-control-label" for="customCheck16">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating <= '4'"<?php if($_GET['rating']=="AND rating <= '4'"){echo 'checked';} ?> onchange="this.form.submit()" onchange="this.form.submit()" id="customCheck55">
                                        <label class="custom-control-label" for="customCheck55">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input"  name="rating" value="AND rating <= '5'"<?php if($_GET['rating']=="AND rating <= '5'"){echo 'checked';} ?> onchange="this.form.submit()" onchange="this.form.submit()" id="customCheck164">
                                        <label class="custom-control-label" for="customCheck164">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->

                    <!-- single sidebar start -->
                    <!--<div class="sidebar-single">-->
                    <!--    <h6 class="sidebar-title">Gender</h6>-->
                    <!--    <div class="sidebar-body">-->
                    <!--        <ul class="checkbox-container search-list">-->
                    <!--            <li>-->
                    <!--                <div class="custom-control custom-checkbox">-->
                    <!--                    <input type="radio" name="gender" value="AND prdtype = 'men'"<?php if($_GET['gender']=="AND prdtype = 'men'"){echo 'checked';} ?> onchange="this.form.submit()" class="custom-control-input" id="customCheck17">-->
                    <!--                    <label class="custom-control-label" for="customCheck17">Men</label>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <div class="custom-control custom-checkbox">-->
                    <!--                    <input type="radio" name="gender" value="AND prdtype = 'women'"<?php if($_GET['gender']=="AND prdtype = 'women'"){echo 'checked';} ?> onchange="this.form.submit()" class="custom-control-input" id="customCheck18">-->
                    <!--                    <label class="custom-control-label" for="customCheck18">Women</label>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <div class="custom-control custom-checkbox">-->
                    <!--                    <input type="radio" name="gender" value="AND prdtype = 'kids'"<?php if($_GET['gender']=="AND prdtype = 'kids'"){echo 'checked';} ?> onchange="this.form.submit()" class="custom-control-input" id="customCheck19">-->
                    <!--                    <label class="custom-control-label" for="customCheck19">Kids</label>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--        </ul>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- single sidebar end -->
<a href="product-search.php?searchitem=<?php echo $searchitem; ?>" style="margin-left: 98px;" class="apply-filter-btn">Clear Filters</a>


</form>
                </div>
		</div>

		<div class="col-lg-9 col-md-9 col-12">
			<div class="products-main">
				
				<div class="row g-2 ">
				      <div class="col-lg-12">
                            <a data-bs-toggle="offcanvas" class="mob-filter-btn" href="#mobile-filter" role="button">
                                <i class="fa fa-filter"> Filters</i>
                            </a>
                        </div>

				 
                <?php 
                        while($fetchproduct = mysqli_fetch_array($selectproduct1))
                        { ?>
                     
					<div class="col-lg-4 col-md-6 col-6">
						  <!-- product single item start -->
                            <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fetchproduct['subcategory2']; ?> &sid=<?php echo $fetchproduct['subcategory']; ?>">
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
</section>


<!--  Mobile Filters -->


<div class="offcanvas offcanvas-start" tabindex="-1" id="mobile-filter" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
   <div class="col-lg-3 col-md-3 col-12">
		      <div class="products-sidebar">
<form method="GET">
    <input type="hidden" value="<?php echo $ssid; ?>" name="ssid">
    <input type="hidden" value="<?php echo $sid; ?>" name="sid">
                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h6 class="sidebar-title">New Arrivals</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY id DESC LIMIT 18"<?php if($_GET['newarrival']=='ORDER BY id DESC LIMIT 18'){echo 'checked';} ?> onchange="this.form.submit()" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Latest Arrivals</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY rating DESC LIMIT 6"<?php if($_GET['newarrival']=='ORDER BY rating DESC LIMIT 6'){echo 'checked';} ?> onchange="this.form.submit()" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Best Sellers</label>
                                    </div>
                                </li>
                                 
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->

                   

                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h6 class="sidebar-title">Prices</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                             
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY mrp DESC"<?php if($_GET['newarrival']=='ORDER BY mrp DESC'){echo 'checked';} ?> onchange="this.form.submit()"  id="customCheck10">
                                        <label class="custom-control-label" for="customCheck10">High To Low</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="newarrival" value="ORDER BY mrp ASC"<?php if($_GET['newarrival']=='ORDER BY mrp ASC'){echo 'checked';} ?> onchange="this.form.submit()"  id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">Low To High</label>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->

                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h6 class="sidebar-title">Ratings</h6>
                        <div class="sidebar-body">
                            <ul class="checkbox-container search-list">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating = '1'"<?php if($_GET['rating']=="AND rating = '1'"){echo 'checked';} ?> onchange="this.form.submit()" onchange="this.form.submit()" id="customCheck14">
                                        <label class="custom-control-label" for="customCheck14">
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating <= '2'"<?php if($_GET['rating']=="AND rating <= '2'"){echo 'checked';} ?> onchange="this.form.submit()"  onchange="this.form.submit()" id="customCheck15">
                                        <label class="custom-control-label" for="customCheck15">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating <= '3'"<?php if($_GET['rating']=="AND rating <= '3'"){echo 'checked';} ?> onchange="this.form.submit()" value="3" onchange="this.form.submit()" id="customCheck16">
                                        <label class="custom-control-label" for="customCheck16">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="rating" value="AND rating <= '4'"<?php if($_GET['rating']=="AND rating <= '4'"){echo 'checked';} ?> onchange="this.form.submit()" onchange="this.form.submit()" id="customCheck55">
                                        <label class="custom-control-label" for="customCheck55">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input"  name="rating" value="AND rating <= '5'"<?php if($_GET['rating']=="AND rating <= '5'"){echo 'checked';} ?> onchange="this.form.submit()" onchange="this.form.submit()" id="customCheck164">
                                        <label class="custom-control-label" for="customCheck164">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar end -->

                    <!-- single sidebar start -->
                    <!--<div class="sidebar-single">-->
                    <!--    <h6 class="sidebar-title">Gender</h6>-->
                    <!--    <div class="sidebar-body">-->
                    <!--        <ul class="checkbox-container search-list">-->
                    <!--            <li>-->
                    <!--                <div class="custom-control custom-checkbox">-->
                    <!--                    <input type="radio" name="gender" value="AND prdtype = 'men'"<?php if($_GET['gender']=="AND prdtype = 'men'"){echo 'checked';} ?> onchange="this.form.submit()" class="custom-control-input" id="customCheck17">-->
                    <!--                    <label class="custom-control-label" for="customCheck17">Men</label>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <div class="custom-control custom-checkbox">-->
                    <!--                    <input type="radio" name="gender" value="AND prdtype = 'women'"<?php if($_GET['gender']=="AND prdtype = 'women'"){echo 'checked';} ?> onchange="this.form.submit()" class="custom-control-input" id="customCheck18">-->
                    <!--                    <label class="custom-control-label" for="customCheck18">Women</label>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <div class="custom-control custom-checkbox">-->
                    <!--                    <input type="radio" name="gender" value="AND prdtype = 'kids'"<?php if($_GET['gender']=="AND prdtype = 'kids'"){echo 'checked';} ?> onchange="this.form.submit()" class="custom-control-input" id="customCheck19">-->
                    <!--                    <label class="custom-control-label" for="customCheck19">Kids</label>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--        </ul>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- single sidebar end -->

                    <!--<a href="#" class="apply-filter-btn">Apply Filters</a>-->
                </form>
            </div>
		</div>
</div>


<?php include "footer.php" ?>