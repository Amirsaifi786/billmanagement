<?php
include "config.php";
include "header.php";

if(isset($_POST['checkmobile']))
{
    $mobile = $_POST['mobile'];  
   
    if($mobile!='' )
    {
        $select123="SELECT * FROM `users` WHERE mobile='$mobile' ";
        $queryselect=mysqli_query($conn,$select123);
        $numrow1=mysqli_num_rows($queryselect);
        if($numrow1>0)
        {
            $tmpid="1707166988985101071";
    		$entityid="1701166971697357742";
    		$senderId="ALLSPK"; 
    		$otp=mt_rand(100000,999999);
    		$message ="Use $otp as OTP to login on your All Spikes account.";
    		$message = urlencode($message);
            
            $_SESSION['otp'] = $otp;
            $_SESSION['mobile'] = $mobile;
    	 
     
    		$curl = curl_init();
                
    		curl_setopt_array($curl, array(
    			CURLOPT_URL => "http://103.119.220.54/api/SmsApi/SendSingleApi?UserID=Tushar1biz&Password=kemy4737KE&SenderID=$senderId&Phno=$mobile&Msg=$message&EntityID=$entityid&TemplateID=$tmpid",
    			CURLOPT_RETURNTRANSFER => true,
    			CURLOPT_ENCODING => "",
    			CURLOPT_MAXREDIRS => 10,
    			CURLOPT_TIMEOUT => 30,
    			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    			CURLOPT_CUSTOMREQUEST => "GET",
    			CURLOPT_HTTPHEADER => array(
    				"Cache-Control: no-cache"
    			),
    		));
    
    		$response = curl_exec($curl);
    		$err = curl_error($curl);
    
    		curl_close($curl);
    
    		if ($err) {
    
    			$msg1 = "Alert ! Something went wrong, Please try again";
    		} else {
    
    
    			$msg  = "Success ! Otp Send Successfully on your Mobile Number";
    			echo "<script>setTimeout(function(){ window.location = 'otpforget.php?mobile=".base64_encode($mobile)."&otp=".base64_encode($otp)."'; },2000);</script>";
    		}
        }
        else
        {
            $msg1 = "Please enter correct mobile number.";
        }
    }

}



?>

<section class="login-page">
	<div class="overlay">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				 <div class="login-reg-form-wrap">
	 				<i class="fa fa-refresh"></i>
                    <h4>Forgot Password</h4>
                    <center><span style="color:green"><u><?php if(isset($msg)){ echo $msg; } ?></u></span>
                        <span style="color:red"><u><?php if(isset($msg1)){ echo $msg1; } ?></u></span></center>
                    <form  method="post">
                        <div class="single-input-item">
                        	<label> Enter Mobile Number:</label>
                            <input type="text" name="mobile" placeholder="Enter Mobile No. here." required />
                        </div>
                        
                        
                        <div class="single-input-item">
                        	<div class="log-btn-box">
                            	<button class="login-btn" name="checkmobile" type="submit">Continue </button>
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