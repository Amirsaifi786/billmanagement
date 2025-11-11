<?php include "config.php";

 session_start();
if(isset($_POST['save']))
{
$rno=$_SESSION['otp'];
$urno=$_POST['otp_value'];

    if($rno==$urno)
    { 
        $phone=$_SESSION['mobile'];  
        
            $successmessage="Success ! Verify Successfull...";
           
           echo "<script>setTimeout(function(){ window.location = 'changepass.php'; },2000);</script>";
                
         
    }
    else
    {
        $errormessage="Invalid OTP, Please try again";
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
                    <h4>Verify Using OTP</h4>
                    <center><span style="color:green"><u><?php if(isset($successmessage)){ echo $successmessage; } ?></u></span>
                        <span style="color:red"><u><?php if(isset($errormessage)){ echo $errormessage; } ?></u></span></center>
                    <form  method="post">
                        <div class="single-input-item">
                        	<label>OTP Here</label>
                            <input type="password" name="otp_value" placeholder="OTP Here" required />
                        </div>
                      
                        
                        
                        <div class="single-input-item">
                        	<div class="log-btn-box">
                            	<button class="login-btn" name="save" type="submit">Change</button>
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