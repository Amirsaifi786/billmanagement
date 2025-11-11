<?php include "header.php";

    $cms = mysqli_query($conn, "SELECT * FROM cmspages WHERE slug = 'refund-cancellation-policy' ");
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
			 <!-- <h1>Refund and Return Policy</h1>-->
    <!--<p>At Atharvk Technologies India Pvt Ltd, we strive to ensure customer satisfaction with every purchase. This Refund and Return Policy outlines the conditions under which returns and refunds are accepted.</p>-->

    <!--<h2>1. Eligibility for Returns</h2>-->
    <!--<p>Products may be eligible for return under the following conditions:</p>-->
    <!--<ul>-->
    <!--    <li>The product is damaged, defective, or not as described upon delivery.</li>-->
    <!--    <li>The product is unused, in its original packaging, and accompanied by all accessories and documentation.</li>-->
    <!--    <li>A return request is initiated within 7 days of receiving the product.</li>-->
    <!--</ul>-->

    <!--<h2>2. Non-Returnable Items</h2>-->
    <!--<p>The following items are not eligible for return:</p>-->
    <!--<ul>-->
    <!--    <li>Products that have been used or show signs of wear and tear.</li>-->
    <!--    <li>Custom-made or personalized items.</li>-->
    <!--    <li>Software, licenses, or downloadable products.</li>-->
    <!--</ul>-->

    <!--<h2>3. Return Process</h2>-->
    <!--<p>To initiate a return, please follow these steps:</p>-->
    <!--<ul>-->
    <!--    <li>Contact us at <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a> with your order details and the reason for the return.</li>-->
    <!--    <li>Our support team will review your request and provide return authorization if eligible.</li>-->
    <!--    <li>Ship the product to the address provided by our support team. Ensure it is securely packed to prevent damage during transit.</li>-->
    <!--</ul>-->

    <!--<h2>4. Refund Policy</h2>-->
    <!--<p>We do not entertain any requests for refunds. All purchases are final.</p>-->

    <!--<h2>5. Exchange Policy</h2>-->
    <!--<p>If you wish to exchange a product for a different model or variant, please contact our support team. Exchanges are subject to product availability and the return of the original item in acceptable condition.</p>-->

    <!--<h2>6. Shipping Costs</h2>-->
    <!--<p>Customers are responsible for return shipping costs unless the product was received in a damaged or defective condition, or the return is due to an error on our part.</p>-->

    <!--<h2>7. Cancellations</h2>-->
    <!--<p>Orders can be canceled before they are shipped. Once shipped, cancellations are not possible, and the return process must be followed instead.</p>-->

    <!--<h2>8. Contact Us</h2>-->
    <!--<p>If you have any questions or need assistance with a return or refund, please reach out to us:</p>-->
    <!--<p><strong>Address:</strong> Office No-14121A, 14th Floor, Gaur City Mall, Sector-4, Greater Noida West, Uttar Pradesh-201009</p>-->
    <!--<p><strong>Email Us:</strong> <a href="mailto:atharvk.service@gmail.com">atharvk.service@gmail.com</a></p>-->

    <!--<p>We value your trust and aim to make your experience with Atharvk Technologies India Pvt Ltd as smooth as possible.</p>-->

				</div>
			</div>
		</div>
	</div>
</section>

<?php include "footer.php" ?>
