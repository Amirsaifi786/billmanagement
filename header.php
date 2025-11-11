<?php 
require'config.php';
require'session_check.php';
 
    $selectquery=mysqli_query($conn,"SELECT * FROM admin_login WHERE status='1'");
    $admin=mysqli_fetch_array($selectquery);
 
 
    if(isset($_POST['searchnow'])){
        $searchitem=$_POST['search'];
         header('location:product-search?searchitem='.$searchitem);
    }

    if(isset($_GET['idpro'])){
        $id = base64_decode($_GET['idpro']);
        $selectpro = mysqli_query($conn,"SELECT * FROM product WHERE id = '$id' AND status = '1' ");
        $fetchpro = mysqli_fetch_array($selectpro);
    }
    
    $images = explode(",",$fetchpro['image']);
    foreach($images as $image){
        $img=$image;
        break;
    }
        

    $metaimage="https://atharvktechnologies.com/admin/image/".$img;
    $meta_title="Pureplxel Innovations Pvt Ltd";

    $url= "https://".$_SERVER['HTTP_HOST'];      
    $metaurl=$url.$_SERVER['REQUEST_URI']; 

 
?>
<!doctype html>
<html class="no-js" lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pureplxel Innovations Pvt Ltd</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <meta property="og:title" content="<?php echo $meta_title?>"/>
	<meta property="og:image" content="<?php echo $metaimage?>"/>
	<meta property="og:url" content="<?php echo $metaurl?>"/>
	<meta property="og:site_name" content="<?php echo $url?>"/>
	
	
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/av-logo.png">

    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="assets/css/plugins/jqueryui.min.css">
     <link rel="stylesheet" href="assets/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/swiper/swiper-bundle.min.css">
    <!-- main style css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z608TCNVQ3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Z608TCNVQ3');
</script>
</head>

<body>
    <!-- Start Header Area -->
    <header class="header-area header-style__3">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block ">
            
            <!-- header middle area start -->
            <div class="header-middle-area">
                <div class="container">
                    <div class="row align-items-center position-relative">
                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo-2">
                                <a href="index">
                                    <img src="assets/images/av-logo.png" class="dh-logo" style="height:80px">                                    
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- mini cart area start -->
                        <div class="col-lg-10">
                            <div class="header-right">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end align-items-center">
                                       <li class="search-wrapper-inner">
                                            <form action="" method="POST">
                                                <div class="search">
                                                   
                                                   
                                                    <input class="search-input header_search_btn" type="text" name="search" placeholder="Search Here you want">
                                                     <button type="submit" name="searchnow" class="search-btn overlay_arrow"><i class="fa fa-arrow-right"  id="searchbutton"></i></button>
                                                     <span class="fa fa-search"></span>
                                                </div>
                                            </form>
                                        </li>
                                        

                                        <li class="mini-cart-wrap">
                                            
                                           <a href="cart" class="login-dropdown">
                                               <button class="h-log-btn">
                                               <i class="fa fa-shopping-cart" style="color:#fff"></i>
                                               </button>
                                               </a>
                                          
                                        </li>

                                        <!--<li class="mini-cart-wrap">-->
                                        <!--   <a href="#">-->
                                        <!--    <i class="fa fa-heart"></i>-->
                                        <!--    </a>-->
                                        <!--</li>-->


                                        <li class="mini-cart-wrap">
                                           <div class="login-dropdown">
                                            
                                                <?php
                                                if(isset($_SESSION['user_id']))
                                                {
                                                    $selectuser=mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
                                                    $fetchuser=mysqli_fetch_array($selectuser);
                                                      ?>
                                                      <button class="h-log-btn">
                                               <i class="fa fa-sign-in" aria-hidden="true"></i> Logout
                                            </button>
                                            <div class="login-content">
                                               <a href="logout" class="flex">
                                                   <span>Welcome <?php echo $fetchuser['name']; ?> </span>
                                                   <span class="c-span">Sign Out</span>
                                               </a>
                                                  <a href="profile">My Profile</a>
                                              <!--<a href="orders">Order Status</a>-->
                                              <a href="terms">Terms & Conditions</a>
                                              <a href="privacy">Privacy Policy</a>
                                              
                                            </div>
                                               <?php } else { ?>
                                               <button class="h-log-btn">
                                               <i class="fa fa-sign-in" aria-hidden="true"></i> Sign-In/Sign-Up
                                            </button>
                                            <div class="login-content">
                                                <a href="register" class="flex">
                                                   <span>New Customer ? </span>
                                                   <span class="c-span">Sign Up</span>
                                               </a>
                                                    <a href="login">My Profile</a>
                                              <!--<a href="login">Orders </a>-->
                                              <a href="terms">Terms & Conditions</a>
                                              <a href="privacy">Pivacy Policy</a>
                                              
                                            </div>
                                               <?php } ?>
                                               
                                           
                                          </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->
                    </div>
                </div>
            </div>
            <!-- header middle area end -->

            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- main menu area start -->
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                             <li class="position-static"><a href="index">Home</a>    </li>
                                             <li class="position-static"><a href="about">About</a>    </li>
                                    <?php 
                                        $cat = mysqli_query($conn,"SELECT * FROM category WHERE status = '1' ");
                                        while($fetchhcat = mysqli_fetch_array($cat))
                                        {
                                            ?>
                                            <li class="position-static"><a href="products?cat=<?php echo base64_encode($fetchhcat['id']); ?>"><?php echo $fetchhcat['name']; ?></a>
                                               
                                            </li>
                                    <?php } ?>
                                             
                                             <li class="position-static"><a href="contact">Contact</a>    </li>
                                            <!--<li><a href="#" class="dh-view-btn">View All</a></li>-->
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                            <!-- main menu area end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="index">
                                    <img src="assets/images/av-logo.png" class="mh-logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->

        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-close"></i>
                </div>

                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form method="POST">
                            <input type="text" autofocus list="browsers" id="search2" name="search" autocomplete="off" placeholder="Search Here...">
                             
                            <button type="submit" name="searchnow" class="search-btn"><i class="fa fa-search"  id="searchbutton2"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">

                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <!--  Category-drop start -->   
                                <li><a href="index">Home</a></li>
                                <?php 
                                        $cat1 = mysqli_query($conn,"SELECT * FROM category WHERE status = '1' ");
                                       $I=1;
                                        while($fetchhcat1 = mysqli_fetch_array($cat1))
                                        {
                                            ?>
                            <li>
                                       
                                    <a href="products?cat=<?php echo base64_encode($fetchhcat1['id']); ?>">
                                        <?php echo $fetchhcat1['name']; ?>  
                                    </a>
                                    
                                </li>  <?php $I++;  } ?>

                                <!--  Category-drop End -->
                                <?php
                                if(isset($_SESSION['user_id']))
                                { 
                                    ?>
                                <li><a href="profile">Profile</a></li>
                                <li><a href="cart">Cart</a></li>
                                <li><a href="orders">Order</a></li>
                                <?php } else { ?>
                                <li><a href="login">Profile</a></li>
                                <li><a href="cart">Cart</a></li>
                                <!--<li><a href="login">Order</a></li>-->
                                <?php } ?>
                                
                                <li><a href="about">About Us</a></li>
                                <li><a href="contact">Contact Us</a></li>
                                <li><a href="terms">Terms & Conditions</a></li>
                                <li><a href="privacy">Privacy Policy</a></li>
                                <li><a href="refund">Refund & Cancellation</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

          

      
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->
    </header>
    <!-- end Header Area -->


    <!-- offcanvas search form start -->
    <div class="offcanvas-search-wrapper">
        <div class="offcanvas-search-inner">
            <div class="offcanvas-close">
                <i class="fa fa-close"></i>
            </div>
            <div class="container">
                <div class="offcanvas-search-box">
                    <form class="d-flex bdr-bottom w-100">
                        <input type="text" placeholder="Search entire storage here...">
                        <button class="search-btn"><i class="fa fa-search"></i>search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas search form end -->

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Main JS -->
  
<script>
$(document).ready(function() {

    $("#searchbutton").on('click',function() {
        var start = $("#search").val(); 
          if(start!='')
        {
            window.location.assign('submit?track='+start);
        }
        
        
    });
});
</script>
  
  <script>
$(document).ready(function() {

    $("#searchbutton2").on('click',function() {
        var start = $("#search2").val(); 
          if(start!='')
        {
            window.location.assign('submit?track='+start);
        }
        
        
    });
});
</script>