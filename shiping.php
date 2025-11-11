<?php include "header.php";

    $cms = mysqli_query($conn, "SELECT * FROM cmspages WHERE slug = 'shipping-policy' ");
      $cmspage = mysqli_fetch_array($cms);
?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Refund & Return Policy</a>
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
		 <!--<h1>Shipping Policy</h1>-->
   <!-- <p>At Atharvk Technologies India Pvt Ltd, we are committed to delivering your orders promptly and efficiently. This Shipping Policy outlines our shipping terms and procedures to ensure transparency and a smooth experience for our customers.</p>-->

   <!-- <h2>1. Shipping Locations</h2>-->
   <!-- <p>We ship our products to most locations within India. Currently, we do not offer international shipping. Please contact us for specific delivery availability to your area.</p>-->

   <!-- <h2>2. Processing Time</h2>-->
   <!-- <p>Orders are processed within 1-2 business days from the date of order placement. Orders placed after 3 PM or on weekends and holidays will be processed on the next business day.</p>-->

   <!-- <h2>3. Shipping Methods and Delivery Time</h2>-->
   <!-- <p>We offer the following shipping methods:</p>-->
   <!-- <ul>-->
   <!--     <li><strong>Standard Shipping:</strong> Delivery within 5-7 business days.</li>-->
   <!--     <li><strong>Express Shipping:</strong> The order will be delivered within 2-5 business days.</li>-->
   <!-- </ul>-->
   <!-- <p>Delivery times may vary depending on your location and external factors such as weather conditions or courier service delays.</p>-->

   <!-- <h2>4. Shipping Charges</h2>-->
   <!-- <p>Shipping charges are calculated at checkout based on the delivery location and the selected shipping method. Any applicable charges will be displayed before finalizing your order.</p>-->

   <!-- <h2>5. Order Tracking</h2>-->
   <!-- <p>Once your order is shipped, you will receive a tracking number via email or SMS. You can use this tracking number to monitor the status of your shipment on the courier's website.</p>-->

   <!-- <h2>6. Undeliverable Packages</h2>-->
   <!-- <p>If a package is undeliverable due to an incorrect address provided by the customer or refusal to accept the delivery, the customer will be responsible for any additional shipping fees incurred for redelivery.</p>-->

   <!-- <h2>7. Damaged or Lost Shipments</h2>-->
   <!-- <p>We take utmost care in packaging your order to prevent damage during transit. However, if your order arrives damaged or is lost during shipping, please contact us immediately at <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a>. Provide your order details and any relevant photographs of the damaged package to assist in resolving the issue.</p>-->

   <!-- <h2>8. Cancellation and Changes</h2>-->
   <!-- <p>Orders can be canceled or modified before they are shipped. Once the order has been shipped, cancellation or changes will not be possible. For assistance, contact us at <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a>.</p>-->

   <!-- <h2>9. Contact Us</h2>-->
   <!-- <p>If you have any questions or concerns regarding our Shipping Policy, please reach out to us:</p>-->
   <!-- <p><strong>Address:</strong> Office No-14121A, 14th Floor, Gaur City Mall, Sector-4, Greater Noida West, Uttar Pradesh-201009</p>-->
   <!-- <p><strong>Email Us:</strong> <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a></p>-->

   <!-- <p>We appreciate your trust in Atharvk Technologies India Pvt Ltd and strive to deliver your orders with care and efficiency.</p>-->

		</div>
			</div>
		</div>
	</div>
</section>

<?php include "footer.php" ?>
