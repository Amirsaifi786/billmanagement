<?php include "header.php" ?>
<div class="container-fluid p-0">
    <img src="assets/photo/banner2.jpg" class="d-block w-100">
</div>



<!-- product gallery area start -->
<section class="product-gallery section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h3 class="title">New Products</h3>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="product-carousel--4 slick-row-5 slick-arrow-style">

                    <?php

                    $selectallproduct = mysqli_query($conn, "SELECT * FROM product WHERE status='1' ORDER BY id DESC LIMIT 20");
                    while ($fetchproduct = mysqli_fetch_array($selectallproduct)) {

                    ?>
                        <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fetchproduct['subcategory2']; ?>&sid=<?php echo $fetchproduct['subcategory']; ?>">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <?php
                                    $image = explode(",", $fetchproduct['image']);
                                    foreach ($image as $img) { ?>
                                        <img src="admin/image/<?php echo $img; ?>" alt="product thumb">
                                    <?php break;
                                    } ?>
                                    <?php
                                    $saveamount = $fetchproduct['mrp'] - $fetchproduct['sellprice'];
                                    $countper = $saveamount / $fetchproduct['mrp'];
                                    $lastpercent = $countper * 100; ?>

                                </div>
                                <div class="product-content">

                                    <div class="name">
                                        <h2>
                                            <?php
                                            $f = $fetchproduct['name'];

                                            if (strlen($f) > 17) {
                                                echo $text = substr($fetchproduct['name'], 0, 20) . "...";
                                            } else {
                                                echo   $text = $fetchproduct['name'];
                                            }
                                            ?>
                                        </h2>
                                        <span>
                                            <?= $fetchproduct['size']; ?>
                                        </span>
                                    </div>
                                    <div class="price">
                                        <div>
                                            <span class="sale">&#8377 <?php echo $fetchproduct['sellprice']; ?>.00</span>
                                            <span class="real">&#8377 <?php echo $fetchproduct['mrp']; ?>.00</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>






<!-- product gallery area start -->
<section class="product-gallery section-padding">
    <div class="container">
        <!-- <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h3 class="title">Latest Product</h3>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg-12">
                <div class="product-carousel--4 slick-row-5 slick-arrow-style">

                    <?php
                    $selectallproduct = mysqli_query($conn, "SELECT * FROM product WHERE status='1' ORDER BY  RAND() LIMIT 10");
                    while ($fetchproduct = mysqli_fetch_array($selectallproduct)) { ?>
                        <!-- product single item start -->
                        <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fetchproduct['subcategory2']; ?>&sid=<?php echo $fetchproduct['subcategory']; ?>">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <?php
                                    $image = explode(",", $fetchproduct['image']);
                                    foreach ($image as $img) { ?>
                                        <img src="admin/image/<?php echo $img; ?>" alt="product thumb">
                                    <?php break;
                                    } ?>
                                    <?php
                                    $saveamount = $fetchproduct['mrp'] - $fetchproduct['sellprice'];
                                    $countper = $saveamount / $fetchproduct['mrp'];
                                    $lastpercent = $countper * 100; ?>
                                    <div class="ribbon">
                                        <span>Flat <?php echo ceil($lastpercent); ?>% Off</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <!--  <div class="btns"> 
                                        <a href="#"><i class="fa fa-heart"></i> Wishlist</a>
                                        <a href="#"><i class="fa fa-shopping-bag"></i> Add To Cart</a>
                                      </div> -->
                                    <div class="name">
                                        <h2>
                                            <?php
                                            $f = $fetchproduct['name'];

                                            if (strlen($f) > 17) {
                                                echo $text = substr($fetchproduct['name'], 0, 20) . "...";
                                            } else {
                                                echo   $text = $fetchproduct['name'];
                                            }
                                            ?>
                                        </h2>
                                        <span>
                                            <?= $fetchproduct['size']; ?>
                                        </span>
                                    </div>
                                    <div class="price">
                                        <div>
                                            <span class="sale">&#8377 <?php echo $fetchproduct['sellprice']; ?>.00</span>
                                            <span class="real">&#8377 <?php echo $fetchproduct['mrp']; ?>.00</span>
                                        </div>
                                        <!--  <div>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half"></i>
                                            <span class="review">4.8</span>
                                          </div> -->
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- product single item end -->
                    <?php } ?>



                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-gallery  " style="border:1px solid #ffc107f3">
    <img src="assets/photo/banner1.jpg" style="width:100%">
</section>
<section class="product-gallery section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h3 class="title">Latest Products</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product-carousel--4 slick-row-5 slick-arrow-style">

                    <?php
                    $selectallproduct = mysqli_query($conn, "SELECT * FROM product WHERE status='1' ORDER BY  RAND() LIMIT 10");
                    while ($fetchproduct = mysqli_fetch_array($selectallproduct)) { ?>
                        <!-- product single item start -->
                        <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fetchproduct['subcategory2']; ?>&sid=<?php echo $fetchproduct['subcategory']; ?>">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <?php
                                    $image = explode(",", $fetchproduct['image']);
                                    foreach ($image as $img) { ?>
                                        <img src="admin/image/<?php echo $img; ?>" alt="product thumb">
                                    <?php break;
                                    } ?>
                                    <?php
                                    $saveamount = $fetchproduct['mrp'] - $fetchproduct['sellprice'];
                                    $countper = $saveamount / $fetchproduct['mrp'];
                                    $lastpercent = $countper * 100; ?>
                                    <div class="ribbon">
                                        <span>Flat <?php echo ceil($lastpercent); ?>% Off</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <!--  <div class="btns"> 
                                        <a href="#"><i class="fa fa-heart"></i> Wishlist</a>
                                        <a href="#"><i class="fa fa-shopping-bag"></i> Add To Cart</a>
                                      </div> -->
                                    <div class="name">
                                        <h2>
                                            <?php
                                            $f = $fetchproduct['name'];

                                            if (strlen($f) > 17) {
                                                echo $text = substr($fetchproduct['name'], 0, 20) . "...";
                                            } else {
                                                echo   $text = $fetchproduct['name'];
                                            }
                                            ?>
                                        </h2>
                                        <span>
                                            <?= $fetchproduct['size']; ?>
                                        </span>
                                    </div>
                                    <div class="price">
                                        <div>
                                            <span class="sale">&#8377 <?php echo $fetchproduct['sellprice']; ?>.00</span>
                                            <span class="real">&#8377 <?php echo $fetchproduct['mrp']; ?>.00</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                        <!-- product single item end -->
                    <?php } ?>



                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-gallery section-padding">
    <div class="container">
        <!--<div class="row">-->
        <!--    <div class="col-12">-->
        <!--        <div class="section-title text-center">-->
        <!--            <h3 class="title">Fresh Items</h3>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="row">
            <div class="col-lg-12">
                <div class="product-carousel--4 slick-row-5 slick-arrow-style">

                    <?php
                    $selectallproduct = mysqli_query($conn, "SELECT * FROM product WHERE status='1' ORDER BY  RAND() LIMIT 10");
                    while ($fetchproduct = mysqli_fetch_array($selectallproduct)) { ?>
                        <!-- product single item start -->
                        <a href="product-details.php?idpro=<?php echo base64_encode($fetchproduct['id']); ?>&ssid=<?php echo $fetchproduct['subcategory2']; ?>&sid=<?php echo $fetchproduct['subcategory']; ?>">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <?php
                                    $image = explode(",", $fetchproduct['image']);
                                    foreach ($image as $img) { ?>
                                        <img src="admin/image/<?php echo $img; ?>" alt="product thumb">
                                    <?php break;
                                    } ?>
                                    <?php
                                    $saveamount = $fetchproduct['mrp'] - $fetchproduct['sellprice'];
                                    $countper = $saveamount / $fetchproduct['mrp'];
                                    $lastpercent = $countper * 100; ?>
                                    <div class="ribbon">
                                        <span>Flat <?php echo ceil($lastpercent); ?>% Off</span>
                                    </div>
                                </div>
                                <div class="product-content">

                                    <div class="name">
                                        <h2>
                                            <?php
                                            $f = $fetchproduct['name'];

                                            if (strlen($f) > 17) {
                                                echo $text = substr($fetchproduct['name'], 0, 20) . "...";
                                            } else {
                                                echo   $text = $fetchproduct['name'];
                                            }
                                            ?>
                                        </h2>
                                        <span>
                                            <?= $fetchproduct['size']; ?>
                                        </span>
                                    </div>
                                    <div class="price">
                                        <div>
                                            <span class="sale">&#8377 <?php echo $fetchproduct['sellprice']; ?>.00</span>
                                            <span class="real">&#8377 <?php echo $fetchproduct['mrp']; ?>.00</span>
                                        </div>
                                        <!--  <div>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half"></i>
                                            <span class="review">4.8</span>
                                          </div> -->
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- product single item end -->
                    <?php } ?>



                </div>
            </div>
        </div>
    </div>
</section>
<div class="ul-inner-page-container my-0">
    <section class="ul-about">
        <div class="row row-cols-md-2 row-cols-1 align-items-center ul-bs-row">
            <!-- txt --> <!-- img -->

            <div class="col col-md-6">
                <div class="ul-about-txt">
                    <span class="ul-section-sub-title">About us</span>
                    <h2 class="ul-section-title">Purepixel Innovations</h2>
                    <p> Purepixel Innovations Pvt Ltd is a trusted name in the world of computer parts and accessories. Established with a mission to deliver high-quality IT solutions, we cater to a diverse range of customers—from individual tech enthusiasts to large-scale enterprises.</p>
                    <p>Our commitment lies in providing cutting-edge products and exceptional customer service.</p>
                    <p> With an extensive range of computer components, peripherals, and accessories, we ensure that every product meets the highest industry standards.</p>
                    <p>At Purepixel Innovations, we pride ourselves on innovation, reliability, and customer satisfaction. Our team of experts is dedicated to understanding your needs and delivering tailored solutions that empower your technological journey.</p>
                    <p>Join us as we continue to drive progress in the IT world with passion, precision, and a focus on excellence.</p>
                    Premium Quality | Affordable Fashion</strong>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="ul-about-img">
                    <img src=" assets/photo/about.jpg" alt="About Image">
                </div>
            </div>


        </div>
    </section>
</div>
<section class="ul-reviews overflow-hidden">
    <div class="ul-section-heading text-center justify-content-center">
        <div>
            <!--<span class="ul-section-sub-title">Customer Reviews</span>-->
            <h2 class="ul-section-title">Product Reviews</h2>
            <!--<p class="ul-reviews-heading-descr">Our references are very valuable, the result of a great effort...</p>-->
        </div>
    </div>

    <!-- slider -->
    <div class="ul-reviews-slider swiper">
        <div class="swiper-wrapper">
            <!-- single review -->
            <div class="swiper-slide">
                <div class="ul-review">
                    <div class="review-card-header">
                        <img src="https://i.pravatar.cc/70?img=64" class="review-avatar" alt="Reviewer">
                        <div class="review-meta">
                            <h4 class="review-name">Akesh</h4>
                            <div class="review-stars">
                                ★★★★☆
                            </div>
                        </div>
                    </div>


                    <p class="ul-review-descr">Purchased a multi-plug extension board — solid build, compact design, and safely handles all my devices. Highly recommended.</p>
                    <div class="ul-review-bottom">


                        <!-- icon -->
                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                    </div>
                </div>
            </div>

            <!-- single review -->
            <div class="swiper-slide">
                <div class="ul-review">
                    <div class="review-card-header">
                        <img src="https://i.pravatar.cc/70?img=58" class="review-avatar" alt="Reviewer">
                        <div class="review-meta">
                            <h4 class="review-name">Sharyansh</h4>
                            <div class="review-stars">
                                ★★★★☆
                            </div>
                        </div>
                    </div>

                    <p class="ul-review-descr">Amazing product! Exceptional craftsmanship with vibrant colors that pop. A must-have for anyone who values both style and comfort.</p>
                    <div class="ul-review-bottom">


                        <!-- icon -->
                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                    </div>
                </div>
            </div>

            <!-- single review -->
            <div class="swiper-slide">
                <div class="ul-review">
                    <div class="review-card-header">
                        <img src="https://i.pravatar.cc/70?img=66" class="review-avatar" alt="Reviewer">
                        <div class="review-meta">
                            <h4 class="review-name">Abhishek</h4>
                            <div class="review-stars">
                                ★★★★★
                            </div>
                        </div>
                    </div>

                    <p class="ul-review-descr">Exceeded expectations! The fabric feels premium, and the design is flawless. Perfect addition to my wardrobe—will definitely buy again.</p>
                    <div class="ul-review-bottom">


                        <!-- icon -->
                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                    </div>
                </div>
            </div>

            <!-- single review -->
            <div class="swiper-slide">
                <div class="ul-review">
                    <div class="review-card-header">
                        <img src="https://i.pravatar.cc/70?img=61" class="review-avatar" alt="Reviewer">
                        <div class="review-meta">
                            <h4 class="review-name">Ajay</h4>
                            <div class="review-stars">
                                ★★★★☆
                            </div>
                        </div>
                    </div>

                    <p class="ul-review-descr">Received my LED flood lights within 3 days. Super bright, energy-efficient, and easy to install. Will definitely order again.</p>
                    <div class="ul-review-bottom">


                        <!-- icon -->
                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                    </div>
                </div>
            </div>


            <!-- single review -->
            <div class="swiper-slide">
                <div class="ul-review">
                    <div class="review-card-header">
                        <img src="https://i.pravatar.cc/70?img=69" class="review-avatar" alt="Reviewer">
                        <div class="review-meta">
                            <h4 class="review-name">Laxdeep</h4>
                            <div class="review-stars">
                                ★★★★★
                            </div>
                        </div>
                    </div>

                    <p class="ul-review-descr">Always creative, always fresh! Purepixel Innovations truly understands how to make every bouquet memorable and unique.</p>
                    <div class="ul-review-bottom">

                        <!-- icon -->
                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
<!-- REVIEWS SECTION END -->

<section class="bg-light electronics-subscribe-box text-center p-5" style="
                                            border:2px solid rgb(216 216 216);
                                            border-radius:10px;
                                            margin:50px;
                                            padding:5px;
                        
                                                             ">
    <div class="row align-items-center col-md-12">

        <div class="col-md-6">
            <h2 class="fw-bold mb-3">⚡ Your Weekly Charge of Electric Deals </h2>
            <p class="text-muted mb-4 " style="color:#93a992;font-size:20px;">
                <strong>
                    Subscribe to our newsletter and stay updated with the latest in electrical and electronic innovations, industry trends, exclusive deals, and expert tips. We promise not to spam!
                </strong>
            </p>

            <form action="#" method="POST" class="row g-2">
                <div class="col-12 col-sm-8">
                    <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Enter your email address" required>
                </div>
                <div class="col-12 col-sm-4">
                    <button type="submit" class="btn btn-sqr btn-lg w-100 p-3 rounded-pill">Subscribe</button>
                </div>
            </form>

            <small class="text-muted d-block mt-3">We respect your privacy. Unsubscribe anytime.</small>
        </div>
        <div class="col-md-6">
            <img src="assets/photo/newsletter.jpg" alt="Subscribe" class="img-fluid rounded shadow" style="width:100%;">
        </div>
    </div>
</section>










<?php include "footer.php" ?>