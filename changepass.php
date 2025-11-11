<?php include "config.php";

   $phone=$_SESSION['mobile'];

if(isset($_POST['submitdone']))
{
    $newpass=$_POST['n_pw'];
    $confirmpass=$_POST['c_pw'];
    
    if($newpass == $confirmpass)
    {
        $updtpass=mysqli_query($conn,"UPDATE users SET password='$confirmpass' WHERE mobile='$phone'");
        if($updtpass)
        {
            $msg = "Password updated successfully";
             echo "<script>setTimeout(function(){ window.location = 'login.php'; },3000);</script>";
        }
        else
        {
            $msg1="Something went wrong, please try again";
        }
    }
    else
    {
        $msg1 = "New password and Confirm password does not match!";
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
                    <h4>Change Password</h4>
                    <center><span style="color:green"><u><?php if(isset($msg)){ echo $msg; } ?></u></span>
                        <span style="color:red"><u><?php if(isset($msg1)){ echo $msg1; } ?></u></span></center>
                    <form  method="post">
                        <div class="single-input-item">
                        	<label>New Password</label>
                            <input type="password" name="n_pw" placeholder="New Password" required />
                        </div>
                        <div class="single-input-item">
                        	<label>Confirm Password</label>
                            <input type="password" name="c_pw" placeholder="Confirm Password" required />
                        </div>
                        
                        
                        <div class="single-input-item">
                        	<div class="log-btn-box">
                            	<button class="login-btn" name="submitdone" type="submit">Change</button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
	</div>
</section>


<?php include "footer.php" ?>