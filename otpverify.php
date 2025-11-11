<?php  include('header.php');  
  
session_start();
if(isset($_POST['register']))
{
    $rno=base64_decode($_REQUEST['otp']);
    $urno=$_POST['otpvalue'];

    if($urno!='')
    {
        if(!strcmp($rno,$urno))
        {
              $name=base64_decode($_REQUEST['name']);
              $email=base64_decode($_REQUEST['email']);
              $phone=base64_decode($_REQUEST['mobile']);
              $password=base64_decode($_REQUEST['password']);
            date_default_timezone_set('Asia/Calcutta'); 
                    $date= date("d-m-Y"); // time in India
                    
                    date_default_timezone_set('Asia/Calcutta'); 
                    $timestamp= date("d-m-Y H:i:s"); // time in India
            //For admin if he want to know who is register
          
                  $insertuser="INSERT INTO `users`(`name`, `email`, `password`, `mobile`, `insert_datetime`) VALUES ('$name','$email','$password','$phone','$date')";
        
                $insertQuery=mysqli_query($conn,$insertuser);
                
                $selectlastid = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC LIMIT 1");
                $fetchid = mysqli_fetch_array($selectlastid);
                $lastid = $fetchid['id'];
                
                
                $successmessage="Thank you, Registration Successfull please wait.. ";
               
              
                $_SESSION['uid']=$lastid;
                        
                     
                        echo "<script>setTimeout(function(){ window.location = 'index.php'; },1000);</script>";
                        // header('location:home.php');
            
            
            
            
        }
        else
        {
            $msg1="Alert ! Invalid OTP";
        }
    }
    else
    {
        $msg1="Warning ! Please Enter OTP";
    }

}



?>

      





<section class="register-page">
	<div class="overlay">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				 <div class="login-reg-form-wrap">
	 				<i class="fa fa-users"></i>
                    <h4>Verify Details</h4>
                    <form action="#" method="post">
                        <span style="color : green"><?php if(isset($successmessage)){ echo $successmessage; } ?></span> 
                        <div class="single-input-item">
                        	<label>Otp Here</label>
                            <input type="text" placeholder="OTP Here" name="otpvalue"  />
                            <span style="color:red"><?php if(isset($msg1)){ echo $msg1;} ?></span>
                        </div>
                       
                      
                        <div class="single-input-item">
                        	<div class="log-btn-box">
                        	    <!--<p style="text-align:left">Already have an account ?<a href="login.php" style="color:red"> Login Here</a></p>-->
                            	<button class="login-btn" id="submitbtn"  type="submit" name="register">Verify</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script>
        function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	var password = $('#password').val().trim();
	if (password.length < 6) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Weak (should be atleast 6 characters.)").css("color","red");
    $('#submitbtn').attr('disabled', true);
	} else {
		if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('strong-password');
			$('#password-strength-status').html("Strong").css("color","green");
			    $('#submitbtn').removeAttr('disabled');

		}
		else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)").css("color","#cf6113");
    $('#submitbtn').attr('disabled', true);

		}
	}
}
    </script>
    
      <script>
   $(document).ready(function () {
       $("#confirmpassword").keyup(function(){
       var password = $("#password").val();
         var confirmPassword = $("#confirmpassword").val();
        if (password != confirmPassword)
 
            $("#CheckPasswordMatch").html("Passwords does not match!").css("color","red");
    $('#submitbtn').prop('disabled', true);

        else
             $("#CheckPasswordMatch").html("Passwords match.").css("color","green");
            
    });
    });
    
   
    </script>