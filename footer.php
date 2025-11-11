 <?php require 'config.php';
    $contact = mysqli_query($conn, "SELECT * FROM admin_login");
    $fetchcontact = mysqli_fetch_array($contact);
    ?> <!-- footer area start -->
 <footer>

     <div class="footer-widget-area">
         <div class="container">
             <div class="row mtn-30">

                 <div class="col-lg-3 col-sm-6">
                     <div class="footer-widget-item mt-30">
                         <h6 class="widget-title">Useful Links</h6>
                         <ul class="usefull-links">
                             <li><a href="index">Home</a></li>
                             <li><a href="about">About Us</a></li>
                             <li><a href="contact">Contact Us</a></li>
                             <li><a href="#">Site Map</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-3 col-sm-6">
                     <div class="footer-widget-item mt-30">
                         <h6 class="widget-title">Policies</h6>
                         <ul class="usefull-links">
                             <li><a href="privacy">Privacy Policy</a></li>
                             <li><a href="terms">Terms & Conditions</a></li>
                             <li><a href="refund">Refund and return Policy</a></li>
                             <li><a href="shiping">Shipping Policy</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-2 col-sm-6">
                     <div class="footer-widget-item mt-30">
                         <h6 class="widget-title">My Account</h6>
                         <?php
                            if (isset($_SESSION['user_id'])) {

                            ?>
                             <ul class="usefull-links">
                                 <li><a href="logout">Log Out</a></li>
                                 <li><a href="profile">Profile</a></li>
                                 <li><a href="cart">Cart</a></li>
                                 <!--<li><a href="orders">Orders</a></li>-->
                             </ul>
                         <?php } else { ?>
                             <ul class="usefull-links">
                                 <li><a href="login">Log In</a></li>
                                 <li><a href="login">Profile</a></li>
                                 <li><a href="cart">Cart</a></li>
                                 <!--<li><a href="login">Orders</a></li>-->
                             </ul>
                         <?php } ?>
                     </div>
                 </div>

                 <div class="col-lg-4 col-sm-6">
                     <div class="footer-widget-item contact mt-30">
                         <h6 class="widget-title">Contact Info</h6>
                         <div>
                             <div class="f-add">
                                 <p><strong>Address:</strong> <?php echo $fetchcontact['address']; ?></p>
                             </div>
                             <div class="f-add">
                                 <p><strong>Email Us:</strong> <?php echo $fetchcontact['webmail']; ?></p>
                             </div>
                             <div class="f-add">
                                 <p><strong>Call Us:</strong> <?php echo $fetchcontact['mobile']; ?></p>
                             </div>
                         </div>
                     </div>

                     <div class="f-social">
                         <span>Social Links... </span>
                         <a href="<?php echo $fetchcontact['fb']; ?>" target="_blank" class="fa fa-facebook-square"></a>
                         <a href="<?php echo $fetchcontact['insta']; ?>" target="_blank" class="fa fa-instagram"></a>
                         <a href="<?php echo $fetchcontact['youtube']; ?>" target="_blank" class="fa fa-youtube-play"></a>
                     </div>
                 </div>

             </div>
         </div>
     </div>
     <div class="footer-bottom-area text-center">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <p class="copyright">
                     <p class="copy-text">Copyright © 2025 Purepixel Innovations Pvt Ltd | All Rights Reserved </p>
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- footer area end -->


 <!-- JS
============================================ -->

 <!-- Modernizer JS -->
 <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
 <!-- jQuery JS -->
 <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
 <!-- Bootstrap JS -->
 <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
 <!-- slick Slider JS -->
 <script src="assets/js/plugins/slick.min.js"></script>
 <!-- Countdown JS -->
 <script src="assets/js/plugins/countdown.min.js"></script>
 <!-- Nice Select JS -->
 <script src="assets/js/plugins/nice-select.min.js"></script>
 <!-- jquery UI JS -->
 <script src="assets/js/plugins/jqueryui.min.js"></script>
 <!-- Image zoom JS -->
 <script src="assets/js/plugins/image-zoom.min.js"></script>
 <!-- image loaded js -->
 <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
 <!-- masonry  -->
 <script src="assets/js/plugins/masonry.pkgd.min.js"></script>
 <!-- mailchimp active js -->
 <script src="assets/js/plugins/ajaxchimp.js"></script>
 <!-- contact form dynamic js -->
 <script src="assets/js/plugins/ajax-mail.js"></script>
 <!-- google map api -->
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
 <!-- google map active js -->
 <script src="assets/js/plugins/google-map.js"></script>
 <script src="assets/swiper/swiper-bundle.min.js"></script>
 <!-- Fancbox -->
 <script src='assets/fancybox/jquery.fancybox.min.js'></script>
 <script src='assets/fancybox/jquery.fancybox-media.js'></script>
 <!-- Main JS -->
 <script src="assets/js/main.js"></script>
 <!-- Start of Tawk.to Script-->
 <!-- <script type="text/javascript">-->
 <!--var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->
 <!--(function(){-->
 <!--var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->
 <!--s1.async=true;-->
 <!--s1.src='https://embed.tawk.to/63b9667f47425128790c2c55/1gm63gp1c';-->
 <!--s1.charset='UTF-8';-->
 <!--s1.setAttribute('crossorigin','*');-->
 <!--s0.parentNode.insertBefore(s1,s0);-->
 <!--})();-->
 <!--</script> -->
 <!--End of Tawk.to Script -->
 </body>

 </html>