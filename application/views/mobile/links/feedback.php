<!DOCTYPE html>
<html lang="en-US">
<head>
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


        <!-- End Featured Slider -->

        <!-- CONTENT CONTAINER -->
        <div class="content-container">

            <h1 class="page-title">Contact</h1>

            <p>
            <address>
                <span class="bold block">Blazebay Ltd,</span>
                Panesar's Centre,1st Floor, Mombasa Road, <br />P.O. Box 65159 - 00618, Ruaraka, Nairobi, Kenya. <br />
                <abbr title="Phone">P:</abbr> +254-741-403-640
            </address>
            <address>
                <span class="semibold block">BlazeBay Support</span>
                <a href="mailto:#">support@blazebay.com</a>
            </address>
            </p>

            <div class="input-field with-icon">
				<span class="icon">
					<i class="fa fa-user"></i>
				</span>
                <input type="text" name="name" id="name">
                <label for="name">Name</label>
            </div>

            <div class="input-field with-icon">
				<span class="icon">
					<i class="fa fa-envelope"></i>
				</span>
                <input type="text" name="email" id="email">
                <label for="email">Email</label>
            </div>

            <div class="input-field with-icon">
				<span class="icon">
					<i class="fa fa-phone"></i>
				</span>
                <input type="text" id="phone">
                <label for="phone">Phone</label>
            </div>

            <div class="input-field with-icon">
				<span class="icon">
					<i class="fa fa-map-marker"></i>
				</span>
                <input type="text" name="city" id="city">
                <label for="city">City</label>
            </div>

            <div class="input-field with-icon">
				<span class="icon">
					<i class="fa fa-comment"></i>
				</span>
                <textarea name="message" id="message" class="materialize-textarea"></textarea>
                <label for="message">Message</label>
            </div>

            <div class="button-field">
                <button type="button" name="submit" class="btn blue block margin-bottom">Send</button>
            </div>

        </div>
        <!-- END CONTENT CONTAINER -->



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

<?php include(APPPATH.'/views/mobile/layout/footer.php'); ?>

</body>
</html>