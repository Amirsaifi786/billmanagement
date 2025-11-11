<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include "config.php";
    
    session_start();
    
     if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        echo "<script>setTimeout(function(){ window.location = 'index.php'; }, 10);</script>";
        }  
    
    
    if(isset($_POST['login']))
    {
    $username = $_POST['mobile'];
    $pass = $_POST['password'];
    
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");
    
    if($username!='' && $pass!='')
    {
        $select123="SELECT * FROM `users` WHERE mobile = '$username' AND password = '$pass'";
        $queryselect=mysqli_query($conn,$select123);
        $numrow1=mysqli_num_rows($queryselect);
        if($numrow1>0)
        {
            $fetch2=mysqli_fetch_array($queryselect);
            if($fetch2['status']=='Active')
            {
              
                $_SESSION['user_id']=$fetch2['id'];
                
                
             
            
                $msg='Success ! Login Successfull.Please Wait';
                echo "<script>setTimeout(function(){ window.location = 'index.php'; },1000);</script>";
            
            }
            else
            {
                 $msg1='Alert ! You are block please contact to admin';
            }
            
        }
        else
        {
            $msg1='Alert ! Please enter correct username and password';
            
        }
    }
    else
    {
           $msg1='Alert ! Please enter username and password..';
    }
}

include "header.php";


?>

<section class="login-page">
	<div class="overlay">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				 <div class="login-reg-form-wrap">
	 				<i class="fa fa-sign-in"></i>
                    <h4>User Login</h4>
                    <center><span style="color:green"><?php if(isset($msg)){ echo $msg; } ?></span>
                        <span style="color:red"><?php if(isset($msg1)){ echo $msg1; } ?></span></center>
                    <form  method="post">
                        <div class="single-input-item">
                        	<label>Username (Mobile Number)</label>
                            <input type="mobile" name="mobile" placeholder="Enter Mobile Number" required />
                        </div>
                        <div class="single-input-item">
                        	<label>Password</label>
                            <input type="password" name="password" placeholder="Enter Password" required />
                        </div>
                        <!--<div class="single-input-item">-->
                        <!--    <div class="login-reg-form-meta">-->
                        <!--        <a href="forget-password.php" class="forget-pwd">Forget Password?</a>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="single-input-item">
                        	<div class="log-btn-box">
                            	<button class="login-btn" name="login" type="submit">Login</button>
                            </div>
                        	    <p style="text-align:left">New User ?<a href="register.php" style="color:red"> Register Here</a></p>

                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
	</div>
</section>


<?php include "footer.php" ?>