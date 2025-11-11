<?php  include('header.php');  

    
session_start();

 if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
echo "<script>setTimeout(function(){ window.location = 'index.php'; }, 10);</script>";
}  

if(isset($_POST['register']))
{
     
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
     date_default_timezone_set('Asia/Kolkata');
$date = date('m/d/Y h:i:s a', time());
         $number = mysqli_query($conn,"SELECT * FROM users WHERE mobile = '$mobile' ");
        $num = mysqli_num_rows($number);
     
    $msg='';
    
    if(empty($name))
    {
        $msg1 = 'Alert ! Name is required';
        
     }else if(empty($mobile))
    {
         $msg2 = 'Alert ! Mobile No. is required';
          
    }else if(empty($email))
    {
         $msg3 = ' Alert ! Email-Id is required';
          
    }
    else if(empty($password))
    {
         $msg4 = 'Alert ! Please enter Password';
      
    }
    else if(strlen($mobile) != 10)
    {
       $msg2 = 'Alert ! Mobile No. Should be 10 Digit';

    }
    else if($num>=1)
    {
       $msg2 = 'Mobile Number already exists, Please try again with a different number.';
    }
    else
    {
         
                     $insertuser="INSERT INTO `users`(`name`, `email`, `password`, `mobile`, `insert_datetime`) VALUES ('$name','$email','$password','$mobile','$date')";
        
                $insertQuery=mysqli_query($conn,$insertuser);
                
                $selectlastid = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC LIMIT 1");
                $fetchid = mysqli_fetch_array($selectlastid);
                $lastid = $fetchid['id'];
                
                
                $successmessage="Thank you, Registration Successfull please wait.. ";
               
              
                $_SESSION['user_id']=$lastid;
                        
                     
                        echo "<script>setTimeout(function(){ window.location = 'index.php'; },1000);</script>";

		
 
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
                    <h4>Create Account</h4>
                    <form action="#" method="post">
                        <span style="color:green"><?php if(isset($successmessage)){ echo $successmessage; } ?></span>
                               <span style="color:red"><?php if(isset($msg1)){ echo $msg1; } ?></span>
                               <span style="color:red"><?php if(isset($msg11)){ echo $msg11; } ?></span>
                        <div class="single-input-item">
                        	<label>Full Name</label>
                            <input type="text" placeholder="Enter Name" name="name"  />
                            <span style="color:red"><?php if(isset($msg1)){ echo $msg1;} ?></span>
                        </div>
                       
                		 <div class="single-input-item">
                        	<label>Phone No</label>
                            <input type="tel" placeholder="Enter Phone " name="mobile"  />
                            <span style="color:red"><?php if(isset($msg2)){ echo $msg2;} ?></span>
                        </div>
                        
                        

                        
                        
            		 <div class="single-input-item">
                    	<label>Email Id</label>
                        <input type="email" placeholder="Enter Email" name="email"  />
                        <span style="color:red"><?php if(isset($msg3)){ echo $msg3;} ?></span>
                    </div>
                         

                         
                       
                   
                    <div class="single-input-item">
                    	<label>Password</label>
                        <input type="password" id="password" onkeyup="checkPasswordStrength();" placeholder="Enter Password" name="password"  />
                        
                    </div>
              
                
                <span style="color:red"><?php if(isset($msg4)){ echo $msg4;} ?></span>
                 <div id="password-strength-status"></div>
              
                        
                      
                        <div class="single-input-item">
                        	<div class="log-btn-box">
                        	    <p style="text-align:left">Already have an account ?<a href="login.php" style="color:red"> Login Here</a></p>
                            	<button class="login-btn" id="submitbtn"  type="submit" name="register">Register</button>
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