
<!DOCTYPE html>
<html lang="en-US" xmlns="http://www.w3.org/1999/html">
<head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-modal.min.css"/>
    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>


</head>

<body>

<div id="main">

<!-- LEFT SIDEBAR -->
<div id="slide-out-left" class="side-nav">

    <!-- Form Search -->
    <div class="top-left-nav">
        <?php include(APPPATH.'/views/mobile/layout/search.php'); ?>
    </div>
    <!-- End Form Search -->

    <!-- App/Site Menu -->
    <div id="main-menu">
        <?php include(APPPATH.'/views/mobile/layout/nav.php'); ?>

    </div>



    <!-- End Site/App Menu -->

</div>
<!-- END LEFT SIDEBAR -->

<!-- RIGHT SIDEBAR -->
<div id="slide-out-right" class="side-nav">

    <?php include(APPPATH.'/views/mobile/layout/compare-blogs.php'); ?>

</div>
<!-- END RIGHT SIDEBAR -->

<!-- MAIN PAGE -->
<div id="page">

<!-- FIXED Top Navbar -->
<div class="top-navbar">
    <?php include(APPPATH.'/views/mobile/layout/top.php'); ?>
</div>
<!-- End FIXED Top Navbar -->


<!-- Featured Slider -->
<div class="featured-slider animated fadeInRight">


    <?php include(APPPATH.'/views/mobile/home/slider.php'); ?>

</div>
<!-- End Featured Slider -->

<!-- CONTENT CONTAINER -->
<div class="content-container animated fadeInUp">

    <!-- Product (Static) Section -->
    <div class="page-block margin-bottom">

        <h2 class="block-title">
            <span>New products</span>
            <a href="#" class="list-all">
                <i class="fa fa-th-list"></i>
            </a>
        </h2>

        <?php include(APPPATH.'/views/mobile/home/new-products.php'); ?>

        <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

    </div>


    <!-- Modal Structure -->
    <div id="postremodal" class="modal">
        <div class="modal-content">
            <h4>login to proceed</h4>
            <p>

            <form method="post"  action="">
            <input name="username" id="modal-username" required="" class="form-control" placeholder="Enter Username/ Email" type="text">
            <input name="password" id="modal-password" class="form-control" required="" placeholder="Enter Password" type="password"></p>
            </form>
        </div>
        <div class="modal-footer">
            <div class="col-sm-4"><button class="btn btn-upper btn-primary btn-block" type="button"  id="login-modal-button">Login</button></div>

            <div class="col-sm-3"><a href="<?php echo base_url();?>forgot-password" target="_blank">Forgot password?</a></div>

            <div class="col-sm-5"><small>Dont have an account?</small><a href="<?php echo base_url();?>register" target="_blank">&nbsp;Register</a></div>

        </div>
    </div>




    <div class="page-block margin-bottom">

        <h2 class="block-title">
            <span>Wholesale Products</span><!-- <span> tag to make blue border on this text only -->
            <a href="#" class="list-all">
                <i class="fa fa-th-list"></i>
            </a>
        </h2>

        <!-- Category Listing -->

        <?php include(APPPATH.'/views/mobile/home/wholesale-products.php'); ?>
        <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

    </div>
    <!-- End Category Section -->

    <div class="page-block margin-bottom">

        <h2 class="block-title">
            <span>Top Categories</span><!-- <span> tag to make blue border on this text only -->
            <a href="#" class="list-all">
                <i class="fa fa-th-list"></i>
            </a>
        </h2>

        <!-- Category Listing -->

        <?php include(APPPATH.'/views/mobile/home/top-categories.php'); ?>
        <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

    </div>
    <!-- End Category Section -->
<!-- Product (Static) Section -->
<div class="page-block margin-bottom">

    <h2 class="block-title">
        <span>Featured products</span>
        <a href="#" class="list-all">
            <i class="fa fa-th-list"></i>
        </a>
    </h2>

    <?php include(APPPATH.'/views/mobile/home/featured-products.php'); ?>

    <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

</div>
<!-- End Product (Static) Section -->

    <!-- Product (Static) Section -->
    <div class="page-block margin-bottom">

        <h2 class="block-title">
            <span>Clearance Sale</span>
            <a href="#" class="list-all">
                <i class="fa fa-th-list"></i>
            </a>
        </h2>

        <?php include(APPPATH.'/views/mobile/home/offers.php'); ?>

        <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

    </div>
    <!-- End Product (Static) Section -->
    <!-- END CONTENT CONTAINER -->
    <!-- End Product (Static) Section -->
    <?php include(APPPATH.'/views/mobile/home/post-requirements.php'); ?>
    <!-- Category Section -->
    <div class="page-block margin-bottom">

        <h2 class="block-title">
            <span>Our Trusted Partners</span><!-- <span> tag to make blue border on this text only -->
            <a href="#" class="list-all">
                <i class="fa fa-th-list"></i>
            </a>
        </h2>

        <!-- Category Listing -->

        <?php include(APPPATH.'/views/mobile/home/trusted-patners.php'); ?>
        <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

    </div>

</div>


<!-- FOOTER -->
<div class="footer">

    <!-- Footer main Section -->
    <?php include(APPPATH.'/views/mobile/layout/footer-bottom.php'); ?>
    <!-- End Copyright Section -->

</div>
<!-- End FOOTER -->

<!-- Back to top Link -->
<div id="to-top" class="main-bg"><i class="fa fa-long-arrow-up"></i></div>

</div>
<!-- END MAIN PAGE -->

</div><!-- #main -->
<!-- Modal Trigger -->


<?php include(APPPATH.'/views/mobile/layout/footer.php'); ?>

<script src="<?php echo base_url();?>assets/js/bootstrap-modal.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-modalmanager.min.js"></script>



</body>
</html>