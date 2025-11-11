<?php include "header.php";

 

// if(isset($_POST['']))
// {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $subject = $_POST['subject'];
//     $address = $_POST['message'];
    
//     $mobileregex = "/^[6-9][0-9]{9}$/" ;  
//     $msg='';
    
//     if(strlen($phone) != 10)
//     {
//         ?>
//               <script>
//                   alert('Mobile Number Should be  10 Digit');
//                     window.location.assign('index.php')
//               </script>
//                 <?php
       
//     }
//     else
//     {
          
        
//             $email2="info@velcasystems.com";
//             $email1="webflowindia@gmail.com";
//             $message="name : $name <br> Email : $email <br> Contact : $phone <br> Subject : $subject <br> Message : $address ";
//             $topsubject="Customer Enquiry";
            
            
            
//             require_once "phpmailer/PHPMailerAutoload.php";
//             $mail = new PHPMailer(true);
//                     //Enable SMTP debugging.
//                     $mail->SMTPDebug = 3;                               
//                     //Set PHPMailer to use SMTP.
//                     $mail->isSMTP();            
//                     //Set SMTP host name                          
//                     $mail->Host = "mail.velcasystems.com";
//                     //Set this to true if SMTP host requires authentication to send email
//                     $mail->SMTPAuth = true;                          
//                     //Provide username and password     
//                     $mail->Username = "info@velcasystems.com";                 
//                     $mail->Password = "velcasystems2022@";                           
//                     //If SMTP requires TLS encryption then set it
//                     $mail->SMTPSecure = "tls";                           
//                     //Set TCP port to connect to
//                     $mail->Port = 587;
//                     $mail->From = "info@velcasystems.com";
//                     $mail->FromName = "Velca Systems";
//                     $mail->addAddress($email1);
//                     $mail->addBcc($email2);
//                     $mail->isHTML(true);
//                     $mail->Subject = $topsubject;
//                     $mail->Body = $message;
//             //$mail->AltBody = "This is the plain text version of the email content";
//             try
//             {
//                 $mail->send();
//                 ?>
//               <script>
//                   alert('Thank you for contacting us. We will be in touch with you very soon.');
//               </script>
//                 <?php
//                 header("Location:$referer");
//             }
//             catch (Exception $e)
//             {
//                 ?>
//                 <script>
//                   alert('Something went wrong, Please try again');
//               </script>
             
//                 <?php
//             }
//         }
// }

  
?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</section>


    <!-- contact area start -->
        <div class="contact-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-message">
                            <h4 class="contact-title">Get In Touch</h4>
                            <form id="contact-form" action="#" method="post" class="contact-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="first_name" placeholder="Name *" type="text" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="phone" placeholder="Phone *" type="text" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="email_address" placeholder="Email *" type="text" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="contact_subject" placeholder="Subject *" type="text">
                                    </div>
                                    <div class="col-12">
                                        <div class="contact2-textarea text-center">
                                            <textarea placeholder="Message *" name="message" class="form-control2" required=""></textarea>
                                        </div>
                                        <div class="contact-btn">
                                            <button class="btn btn-sqr" type="submit">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <?php 
                                $contact = mysqli_query($conn,"SELECT * FROM admin_login");
                                $fetchcontact = mysqli_fetch_array($contact);
                                ?>
                            <h4 class="contact-title">Contact Us</h4>
                          	<ul>
                                <li><i class="fa fa-fax"></i> Address : <?php echo $fetchcontact['address']; ?></li>
                                <li><i class="fa fa-envelope-o"></i> E-mail: <?php echo $fetchcontact['webmail']; ?></li>
                                <li><i class="fa fa-phone"></i> +91-<?php echo $fetchcontact['mobile']; ?></li>
                            </ul>
                          <!--   <div class="working-time">
                                <h6>Working Hours</h6>
                                <p><span>Monday – Saturday:</span>08AM – 22PM</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area end -->
    </main>


<?php include "footer.php" ?>