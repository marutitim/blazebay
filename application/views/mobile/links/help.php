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

        <div class="row">
        <div class="col-md-12">
        <h2 class="heading-title"><?=$name?></h2>
        <span class="title-tag">Last Updated on May 02, 2018</span>
        <div class="panel-group checkout-steps" id="accordion">
        <!-- checkout-step-01  -->
        <div class="panel panel-default checkout-step-01">

            <!-- panel-heading -->
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                        <span>1</span> How do I manage my Company Profile?
                    </a>
                </h4>
            </div>
            <!-- panel-heading -->

            <div id="collapseOne" class="panel-collapse collapse in">

                <!-- panel-body  -->
                <div class="panel-body">
                    <p style="">
                        Edit your Company Profile on www.blazebay.com, please do the following:</p>
                    <p style="">
                        1.&nbsp;&nbsp;&nbsp;&nbsp; Sign in to My Blazebay:&nbsp;<a href="https://login.blazebay.com/" style="box-sizing: border-box; background-color: transparent; color: rgb(102, 102, 102); text-decoration-line: none; transition: all 0.2s linear 0s; outline: none !important;">https://login.blazebay.com/</a></p>
                    <p style="">
                        2.&nbsp;&nbsp;&nbsp;&nbsp; Click on &ldquo;My Blazebay&rdquo; and on the dropdown, click on &ldquo;My account&rdquo;.</p>
                    <p style="">
                        3.&nbsp;&nbsp;&nbsp;&nbsp; Click &quot;Edit Company info&quot; in the &ldquo;My Company&rdquo; section</p>
                    <p style="">
                        4.&nbsp;&nbsp;&nbsp;&nbsp; Complete the form with the required information</p>
                    <p style="">
                        5.&nbsp;&nbsp;&nbsp;&nbsp; Click &quot; Update Info&quot; to update</p>
                    <p style="">
                        &nbsp;Upon approval, your Company Profile will be updated online within 24 hours.</p>

                </div>
                <!-- panel-body  -->

            </div><!-- row -->
        </div>
        <!-- checkout-step-01  -->
        <!-- checkout-step-02  -->
        <div class="panel panel-default checkout-step-02">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                        <span>2</span> How do I Manage a Minisite?
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p style="">
                        To add a Minisite, please do the following:</p>
                    <p style="">
                        1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sign in to My Blazebay:&nbsp;<a href="https://login.blazebay.com/" style="box-sizing: border-box; background-color: transparent; color: rgb(102, 102, 102); text-decoration-line: none; transition: all 0.2s linear 0s; outline: none !important;">https://login.blazebay.com/</a></p>
                    <p style="">
                        2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Click &quot;Minisite manager&quot; in the &ldquo;My Company&rdquo; section</p>
                    <p style="">
                        3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From the displayed page, click on &ldquo;Company overview&rdquo; and add information needed, and then click on &ldquo;update&rdquo; to update.</p>
                    <p style="">
                        4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Click on &ldquo;industrial certification&rdquo; and add data, then click on &ldquo;update certification&rdquo; to update.</p>
                    <p style="">
                        5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Click on &ldquo;Minisite&rdquo; to make sure the view updated Minisite.</p>

                </div>
            </div>
        </div>
        <!-- checkout-step-02  -->

        <!-- checkout-step-03  -->
        <div class="panel panel-default checkout-step-03">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                        <span>3</span>Do I need an account to shop on blazebay?
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                                    <span style="color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; background-color:
	rgb(255, 255, 255);">YES, you do, just sign up and you will be OK to shop.</span></p>
                </div>
            </div>
        </div>
        <!-- checkout-step-03  -->

        <!-- checkout-step-04  -->
        <div class="panel panel-default checkout-step-04">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
                        <span>4</span>Why my company information hasn’t been changed after 24 hours?
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        <span style="color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(255, 255, 255);">The system will take 24 hours for the review your company information to be done and after being approved, it will again take up to 24 hours for the new information to be displayed on your Minisite. Please wait for some more time and your patience would be highly appreciated.</span></p>
                    <p>
                </div>
            </div>
        </div>
        <!-- checkout-step-04  -->

        <!-- checkout-step-05  -->
        <div class="panel panel-default checkout-step-05">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFive">
                        <span>5</span>Why is my product(s) not being displayed on Blazebay.com?
                    </a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <p style="">
                        Please make sure that you enter all required information with asterisk (*) and all the information you try to submit is in English.</p>
                    <p style="">
                        Adjust accordingly by following the error message in the submitting page.</p>
                    <p style="">
                        If you are still unable to post the products, for Supplier member, please specify your issue on how you have tried and what happens as well as the system and browser your computer uses. Send us an email directly to support@blazebay.com.</p>

                </div>
            </div>
        </div>
        <!-- checkout-step-05  -->

        <!-- checkout-step-06  -->
        <div class="panel panel-default checkout-step-06">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSix">
                        <span>6</span> How do I place an order?
                    </a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
                <div class="panel-body">
                    <p style="">
                        Shopping on blazebay is very easy! Once you have found the product you want to buy, just follow the steps below:</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Click on add this product to cart</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Click on cart at the top right corner</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Enter your shipping/billing information</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Choose your preferred payment option</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Click on &#39;Confirm order&#39; to proceed to the payment portal and complete your order</p>
                    <p style="">
                        Once your order is placed, we will either automatically confirm it by notifying you via email, or we will call you for confirmation in case we need more details. Please note that this confirmation is a mandatory step before we ship your order. In case you have a doubt about whether the confirmation was done or not, do not hesitate to contact us.</p>

                </div>
            </div>
        </div>
        <!-- checkout-step-06  -->

        <!-- checkout-step-07  -->
        <div class="panel panel-default checkout-step-07">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSeven">
                        <span>7</span>How do I pay on blazebay?
                    </a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse">
                <div class="panel-body">
                    <p style="">
                        You can choose from the different payment methods available on Blazebay. Please find below the list of available payment methods</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Credit card</p>
                    <p style="">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Debit card</p>
                    <p style="">
                        You can find the payment methods during the final step of checkout in detail. Do not hesitate to contact our Customer Service for more information.</p>

                </div>
            </div>
        </div>
        <!-- checkout-step-07  -->

        <!-- checkout-step-08  -->
        <div class="panel panel-default checkout-step-08">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseEight">
                        <span>8</span>Are there any hidden costs or charges if I order from Blazebay?
                    </a>
                </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        <span style="color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(255, 255, 255);">There are no hidden costs or charges when you order from Blazebay. All costs are 100% visible at the end of the checkout process</span></p>

                </div>
            </div>
        </div>
        <!-- checkout-step-08  -->

        <!-- checkout-step-09  -->
        <div class="panel panel-default checkout-step-09">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseNine">
                        <span>9</span>  How can I track my order?
                    </a>
                </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        <span style="color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(255, 255, 255);">We will send you regular updates about the status of your order via emails and calls. After your order has left our warehouse and is on its way to you, you can also track its status by entering your tracking number on&nbsp;</span><a href="https://tracking.blazebay.com/package/tracking" style="box-sizing: border-box; background-color: rgb(255, 255, 255); color: rgb(102, 102, 102); text-decoration-line: none; transition: all 0.2s linear 0s; font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; outline: none !important;">https://tracking.blazebay.com/package/tracking</a></p>

                </div>
            </div>
        </div>
        <div class="panel panel-default checkout-step-10">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTen">
                        <span>10</span>  Are all products on Blazebay original and genuine?
                    </a>
                </h4>
            </div>
            <div id="collapseTen" class="panel-collapse collapse">
                <div class="panel-body">
                    <p style="">
                        Yes. We are committed to offering our customers only 100% genuine and original products. We also take all necessary actions to ensure this: any seller found to be selling non-genuine products is immediately delisted from Blazebay.</p>
                    <p style="">
                        <em style="box-sizing: border-box;">Please send an email to&nbsp;</em><strong style="box-sizing: border-box;">support@blazebay.com</strong><em style="box-sizing: border-box;">&nbsp;if you think a product listed on our website does not meet these standards</em></p>

                </div>
            </div>
        </div>
        <!-- checkout-step-09  -->

        </div><!-- /.checkout-steps -->
        </div>
        </div><!-- /.row -->
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