<?php include "header.php" ;
    $cms = mysqli_query($conn, "SELECT * FROM cmspages WHERE slug = 'terms-conditions' ");
      $cmspage = mysqli_fetch_array($cms);

?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Terms & Condition</a>
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
       
				

				</div>
			</div>
		</div>
	</div>
</section>

<?php include "footer.php" ?>
