<?php include "header.php" ?>


<section class="inner-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb">
					<a href="index.php" class="hover">Home</a>
					<span>|</span>
					<a href="#">Profile</a>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <div class="myaccount-tab-menu nav" role="tablist">
                                            <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                                Dashboard</a>
                                            <!--<a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>-->
                                            <!--    Order Status</a>-->
                                            <a href="#address" data-bs-toggle="tab"><i class="fa fa-home"></i>
                                        Address</a>
                                            <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                                Details</a>
                                            <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                    <!-- My Account Tab Menu End -->

                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Dashboard</h5>
                                                    <div class="welcome">
                                                        <p>Hello, <strong><?php echo $fetchuser['name']; ?></strong></p>
                                                    </div>
                                                    <p class="mb-0">From your account dashboard. you can easily check &
                                                        view your recent orders, manage your shipping and billing addresses
                                                        and edit your password and account details.</p>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->

                                            <!-- Single Tab Content Start -->
                                            <!--<div class="tab-pane fade" id="orders" role="tabpanel">-->
                                            <!--    <div class="myaccount-content">-->
                                            <!--        <h5>Orders</h5>-->
                                            <!--        <div class="myaccount-table table-responsive text-center">-->
                                            <!--            <table class="table table-bordered">-->
                                            <!--                <thead class="thead-light">-->
                                            <!--                    <tr>-->
                                            <!--                        <th>Order</th>-->
                                            <!--                        <th>Date</th>-->
                                            <!--                        <th>Status</th>-->
                                            <!--                        <th>Total</th>-->
                                            <!--                        <th>Action</th>-->
                                            <!--                    </tr>-->
                                            <!--                </thead>-->
                                            <!--                <tbody>-->
                                            <!--                    <tr>-->
                                            <!--                        <td>1</td>-->
                                            <!--                        <td>Aug 22, 2018</td>-->
                                            <!--                        <td>Pending</td>-->
                                            <!--                        <td>&#8377; 3000</td>-->
                                            <!--                        <td><a href="#" class="btn btn-sqr">View</a>-->
                                            <!--                        </td>-->
                                            <!--                    </tr>-->
                                            <!--                    <tr>-->
                                            <!--                        <td>2</td>-->
                                            <!--                        <td>July 22, 2018</td>-->
                                            <!--                        <td>Approved</td>-->
                                            <!--                        <td>&#8377; 200</td>-->
                                            <!--                        <td><a href="#" class="btn btn-sqr">View</a>-->
                                            <!--                        </td>-->
                                            <!--                    </tr>-->
                                            <!--                    <tr>-->
                                            <!--                        <td>3</td>-->
                                            <!--                        <td>June 12, 2017</td>-->
                                            <!--                        <td>On Hold</td>-->
                                            <!--                        <td>&#8377; 990</td>-->
                                            <!--                        <td><a href="#" class="btn btn-sqr">View</a>-->
                                            <!--                        </td>-->
                                            <!--                    </tr>-->
                                            <!--                </tbody>-->
                                            <!--            </table>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!-- Single Tab Content End -->

                                                                                  <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Billing Address</h5>
                                            <div class="profile-add">
                                                <p><strong>Name:</strong> <?php echo $fetchuser['name']; ?></p>
                                                <p><strong>Email-id:</strong> <?php echo $fetchuser['email']; ?></p>
                                                <p><strong>Mobile Number:</strong> <?php echo $fetchuser['mobile']; ?></p>
                                                <p><strong>City:</strong> <?php echo $fetchuser['city']; ?></p>
                                                <p><strong>State:</strong> <?php echo $fetchuser['state']; ?></p>
                                                <p><strong>Zip:</strong> <?php echo $fetchuser['pincode']; ?></p> 

                                                <!--<a href="#" class="add-edit-btn">Edit Address</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Account Details</h5>
                                                    <div class="account-details-form">
                                                        <form action="#">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">First
                                                                            Name</label>
                                                                        <input type="text" id="first-name" value="<?php echo $fetchuser['name']; ?>" placeholder="Enter First Name" />
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                            	<div class="col-lg-6">
                                                            		<div class="single-input-item">
		                                                                <label for="display-name" class="required">Phone</label>
		                                                                <input type="text" id="display-name" value="<?php echo $fetchuser['mobile']; ?>" placeholder="Enter Phone No" />
		                                                            </div>
                                                            	</div>
                                                            	<div class="col-lg-6">
                                                            		 <div class="single-input-item">
		                                                                <label for="email" class="required">Email </label>
		                                                                <input type="email" id="email" value="<?php echo $fetchuser['email']; ?>" placeholder="Enter Email" />
		                                                            </div>
                                                            	</div>

                                                            	<!-- <div class="single-input-item">-->
	                                                            <!--    <label for="email" class="required">Address </label>-->
	                                                            <!--  	<textarea placeholder="Enter Address">-->
	                                                            <!--  	</textarea>-->
	                                                            <!--</div>-->

                                                            </div>
                                                            
                                                           
                                                            <!--<fieldset>-->
                                                            <!--    <legend>Password Change</legend>-->
                                                            <!--    <div class="single-input-item">-->
                                                            <!--        <label for="current-pwd" class="required">Current-->
                                                            <!--            Password</label>-->
                                                            <!--        <input type="password" id="current-pwd" placeholder="Current Password" />-->
                                                            <!--    </div>-->
                                                            <!--    <div class="row">-->
                                                            <!--        <div class="col-lg-6">-->
                                                            <!--            <div class="single-input-item">-->
                                                            <!--                <label for="new-pwd" class="required">New-->
                                                            <!--                    Password</label>-->
                                                            <!--                <input type="password" id="new-pwd" placeholder="New Password" />-->
                                                            <!--            </div>-->
                                                            <!--        </div>-->
                                                            <!--        <div class="col-lg-6">-->
                                                            <!--            <div class="single-input-item">-->
                                                            <!--                <label for="confirm-pwd" class="required">Confirm-->
                                                            <!--                    Password</label>-->
                                                            <!--                <input type="password" id="confirm-pwd" placeholder="Confirm Password" />-->
                                                            <!--            </div>-->
                                                            <!--        </div>-->
                                                            <!--    </div>-->
                                                            <!--</fieldset>-->
                                                            <!--<div class="single-input-item">-->
                                                            <!--	<button class="btn btn-sqr">Edit</button>-->

                                                            <!--    <button class="btn btn-sqr">Save</button>-->
                                                            <!--</div>-->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- Single Tab Content End -->
                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->



<?php include "footer.php" ?>
