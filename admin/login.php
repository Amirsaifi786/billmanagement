<?php
require'config.php';

 
if(isset($_POST['submit']))

{

    $user=$_POST['email'];

    $pass=$_POST['password'];

    

    if($user!='' && $pass!='')

    {

         $sql_login="SELECT * FROM `admin_login` WHERE `email`='$user' AND `password`='$pass' ";

        

        $select_query=mysqli_query($conn,$sql_login);

            if (mysqli_num_rows($select_query)>=1) 

            {

                     $fetch=mysqli_fetch_array($select_query);
                    
                    if($fetch['status']=='1')
                    {
                          $_SESSION['users']=$fetch['id'];
            
                           $successmessage='Success ! Login Successfull';
                          
                          echo '<script>setTimeout(function() { window.location.href="index.php"} ,1000);</script>';
        
                    }
                    else
                    {
                         $errormessage='Alert !  Your account is block, please contact to admin..'; 
                    }
            }
           

            else

            {

                 $errormessage='Alert !  Invalid username and password please try again..'; 
            //   echo '<script>setTimeout(function() { window.location.href="index.php"} ,2000);</script>';


            }

    }

    else

    {
             $errormessage='Alert !  Please enter username and password'; 
      


    }

}
?>

<!doctype html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/images/av-logo.png">
    <title>Atharvk Technologies India Pvt Ltd</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
        .success{
            
        }
    </style>
  </head>
  <body class="light ">
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <div class="col-lg-6 d-none d-lg-flex">
        </div> <!-- ./col -->
        <div class="col-lg-6">
          <div class="w-50 mx-auto">
            <form class="mx-auto text-center" method="POST">
              <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="index.php">
                <img src="../assets/images/av-logo.png" style="height:70px">
              </a><hr>
              <h1 class="h6 mb-3">Admin Panel</h1>
              <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
              </div>
              <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" placeholder="Password" required="">
              </div>
            <span id="success" style="color:green"><?php if(isset($successmessage)){ echo $successmessage; } ?></span>
            <span id="success" style="color:red"><?php if(isset($errormessage)){ echo $errormessage; } ?></span>
              <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Let me in</button>
            </form>
          </div> <!-- .card -->
        </div> <!-- ./col -->
      </div> <!-- .row -->
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>

<!-- Mirrored from technext.github.io/tinydash/auth-login-half.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Nov 2022 08:53:33 GMT -->
</html>
</body>
</html>