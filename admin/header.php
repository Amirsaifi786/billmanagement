<?php 

    require'config.php';
    require'session_check.php';
 ?>
<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/images/av-logo.png">
    <title>Admin | Atharvk Technologies India Pvt Ltd</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/uppy.min.css">
    <link rel="stylesheet" href="css/jquery.steps.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="fonts/boxicons.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light sticky-top bg-white">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
           
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                  <?php $pic = mysqli_query($conn,"SELECT * FROM admin_login WHERE id = '$user_id' ");
                  $fetchpic = mysqli_fetch_array($pic);
                  ?>
                <img src="image/<?php echo $fetchpic['profile']; ?>" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="profile.php">Profile</a>
              <a class="dropdown-item" href="password.php">Password</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="index.php">
              <img src="../assets/images/av-logo.png" width="40px">
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="index.php" class="nav-link" style="border-top: 1px solid #6b6f742e;">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Products</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
              
            <li class="nav-item w-100">
              <a class="nav-link" href="category.php">
                <i class="bx bxs-category"></i>
                <span class="ml-3 item-text">Category</span>
              </a>
            </li>
            
            <li class="nav-item dropdown">
              <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-menu fe-16"></i>
                <span class="ml-3 item-text">Sub-Category</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="subcategory1.php"><span class="ml-1 item-text">Sub-category 1</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="subcategory2.php"><span class="ml-1 item-text">Sub-category 2</span>
                  </a>
                </li>
              </ul>
            </li>
           
           
           <li class="nav-item dropdown">
              <a href="#ui-elements1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-menu fe-16"></i>
                <span class="ml-3 item-text">Product</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements1">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="products.php"><span class="ml-1 item-text">Add Single Product</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="notapprove.php"><span class="ml-1 item-text">Add Bulk Product </span>
                  </a>
                </li>
                
              </ul>
            </li>
              
            <li class="nav-item w-100">
              <a class="nav-link" href="orders.php">
                <i class="fe fe-shopping-cart fe-16"></i>
                <span class="ml-3 item-text">Manage Orders</span>
              </a>
            </li>
                 
   
                 
                <li class="nav-item dropdown">
              <a href="#ui-elements12" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-menu fe-16"></i>
                <span class="ml-3 item-text">Slider</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements12">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="banner.php"><span class="ml-1 item-text">Slider</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="sliderbanner.php"><span class="ml-1 item-text">Banner</span>
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="testimonials.php">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Testimonials</span>
              </a>
            </li>
            
          
            
             <li class="nav-item w-100">
              <a class="nav-link" href="brands.php">
                <i class="fe fe-cpu fe-16"></i>
                <span class="ml-3 item-text">Brands</span>
              </a>
            </li>
                
          </ul>
               <li class="nav-item w-100">
              <a class="nav-link" href="cms.php">
                <i class="fe fe-cpu fe-16"></i>
                <span class="ml-3 item-text">Cms Pages</span>
              </a>
            </li>
                
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Account</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
             
             <li class="nav-item w-100">
              <a class="nav-link" href="profile.php">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Profile</span>
              </a>
            </li> 
           <li class="nav-item w-100">
              <a class="nav-link" href="password.php">
                <i class="fe fe-key fe-16"></i>
                <span class="ml-3 item-text">Manage Password</span>
              </a>
            </li> 
          </ul>
           
          <div class="btn-box w-100 mt-4 mb-1">
            <a href="logout.php"  class="btn mb-2 btn-primary btn-lg btn-block">
              <i class="fe fe-log-out fe-12 mx-2"></i><span class="small">Logout</span>
            </a>
          </div>
        </nav>
      </aside>

      