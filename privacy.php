<?php include "header.php";

    $cms = mysqli_query($conn, "SELECT * FROM cmspages WHERE slug = 'privacy-policy' ");
      $cmspage = mysqli_fetch_array($cms);
?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Privacy Policy</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="privacy-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="policy-box">
				          <h1 class="text-center new_color"><?php  echo $cmspage['title'];?></h1>
                                <?php  echo $cmspage['description'];?>
				    
                                				    		<!--<h1>Privacy Policy</h1>-->
                                  <!--  <p>Atharvk Technologies India Pvt Ltd ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your information when you use our services and website.</p>-->
                                
                                  <!--  <h2>1. Information We Collect</h2>-->
                                  <!--  <p>We may collect the following types of information:</p>-->
                                  <!--  <ul>-->
                                  <!--      <li><strong>Personal Information:</strong> Name, email address, phone number, and billing information provided during registration or purchase.</li>-->
                                  <!--      <li><strong>Non-Personal Information:</strong> Browser type, operating system, IP address, and usage data collected automatically.</li>-->
                                  <!--  </ul>-->
                                
                                  <!--  <h2>2. How We Use Your Information</h2>-->
                                  <!--  <p>Your information is used to:</p>-->
                                  <!--  <ul>-->
                                  <!--      <li>Process orders and provide customer support.</li>-->
                                  <!--      <li>Improve our website and services.</li>-->
                                  <!--      <li>Send updates, offers, and promotional emails (you can opt out anytime).</li>-->
                                  <!--      <li>Comply with legal requirements.</li>-->
                                  <!--  </ul>-->
                                
                                  <!--  <h2>3. Sharing Your Information</h2>-->
                                  <!--  <p>We do not sell, trade, or rent your personal information to others. However, we may share your information with third parties in the following cases:</p>-->
                                  <!--  <ul>-->
                                  <!--      <li>With service providers who assist us in delivering our services.</li>-->
                                  <!--      <li>To comply with legal obligations or protect our rights.</li>-->
                                  <!--      <li>In the event of a merger, acquisition, or sale of assets, where your information may be transferred to the new entity.</li>-->
                                  <!--  </ul>-->
                                
                                  <!--  <h2>4. Cookies and Tracking Technologies</h2>-->
                                  <!--  <p>We use cookies to enhance your browsing experience. Cookies help us understand how you interact with our website and improve its functionality. You can disable cookies through your browser settings, but some features of the website may not function properly.</p>-->
                                
                                  <!--  <h2>5. Data Security</h2>-->
                                  <!--  <p>We implement appropriate technical and organizational measures to protect your information from unauthorized access, disclosure, alteration, or destruction. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>-->
                                
                                  <!--  <h2>6. Third-Party Links</h2>-->
                                  <!--  <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those websites. Please review their privacy policies before providing any personal information.</p>-->
                                
                                  <!--  <h2>7. Your Rights</h2>-->
                                  <!--  <p>You have the right to:</p>-->
                                  <!--  <ul>-->
                                  <!--      <li>Access, update, or delete your personal information.</li>-->
                                  <!--      <li>Opt out of receiving promotional communications.</li>-->
                                  <!--      <li>Withdraw consent where processing is based on consent.</li>-->
                                  <!--  </ul>-->
                                  <!--  <p>To exercise these rights, contact us at <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a>.</p>-->
                                
                                  <!--  <h2>8. Retention of Information</h2>-->
                                  <!--  <p>We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required by law.</p>-->
                                
                                  <!--  <h2>9. Children’s Privacy</h2>-->
                                  <!--  <p>Our services are not directed at individuals under the age of 18. We do not knowingly collect personal information from children. If we discover that a child has provided us with personal information, we will delete it immediately.</p>-->
                                
                                  <!--  <h2>10. Changes to This Privacy Policy</h2>-->
                                  <!--  <p>We reserve the right to update this Privacy Policy at any time. Any changes will be effective immediately upon posting on this page. Please check this page regularly for updates.</p>-->
                                
                                  <!--  <h2>11. Contact Us</h2>-->
                                  <!--  <p>If you have any questions or concerns about this Privacy Policy, please contact us:</p>-->
                                  <!--  <p><strong>Address:</strong> Office No-14121A, 14th Floor, Gaur City Mall, Sector-4, Greater Noida West, Uttar Pradesh-201009</p>-->
                                  <!--  <p><strong>Email Us:</strong> <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a></p>-->
                                
                                  <!--  <p>Thank you for trusting Atharvk Technologies India Pvt Ltd. We value your privacy and strive to protect your personal information.</p>-->


				</div>
			</div>
		</div>
	</div>
</section>

<?php include "footer.php" ?>
