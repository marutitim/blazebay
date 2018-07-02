<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <?php include(APPPATH.'/views/layout/mainheader.php'); ?>
        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <?php include(APPPATH.'/views/layout/menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
<div class="body-content">
<div class="container">


<div class="checkout-box faq-page">
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
                <span>1</span> How do I place an order?
            </a>
        </h4>
    </div>
    <!-- panel-heading -->

    <div id="collapseOne" class="panel-collapse collapse in">

        <!-- panel-body  -->
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
        <!-- panel-body  -->

    </div><!-- row -->
</div>
<!-- checkout-step-01  -->
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
    <div class="panel-heading">
        <h4 class="unicase-checkout-title">
            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                <span>2</span> How do I pay on blazebay?
            </a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
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
<!-- checkout-step-02  -->

<!-- checkout-step-03  -->
<div class="panel panel-default checkout-step-03">
    <div class="panel-heading">
        <h4 class="unicase-checkout-title">
            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                <span>3</span>Are there any hidden costs or charges if I order from Blazebay?
            </a>
        </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
        <div class="panel-body">
            <p>
                <span style="color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(255, 255, 255);">There are no hidden costs or charges when you order from Blazebay. All costs are 100% visible at the end of the checkout process</span></p>

        </div>
    </div>
</div>
<!-- checkout-step-03  -->

<!-- checkout-step-04  -->
<div class="panel panel-default checkout-step-04">
    <div class="panel-heading">
        <h4 class="unicase-checkout-title">
            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
                <span>4</span>How can I track my order?
            </a>
        </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
        <div class="panel-body">
            <p>
                <span style="color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(255, 255, 255);">We will send you regular updates about the status of your order via emails and calls. After your order has left our warehouse and is on its way to you, you can also track its status by entering your tracking number on&nbsp;</span><a href="https://tracking.blazebay.com/package/tracking" style="box-sizing: border-box; background-color: rgb(255, 255, 255); color: rgb(102, 102, 102); text-decoration-line: none; transition: all 0.2s linear 0s; font-family: Roboto, sans-serif; font-size: 13px; text-align: justify; outline: none !important;">https://tracking.blazebay.com/package/tracking</a></p>

        </div>
    </div>
</div>
<!-- checkout-step-04  -->

<!-- checkout-step-05  -->
<div class="panel panel-default checkout-step-05">
    <div class="panel-heading">
        <h4 class="unicase-checkout-title">
            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFive">
                <span>5</span>Are all products on Blazebay original and genuine?
            </a>
        </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse">
        <div class="panel-body">
            <p style="">
                Yes. We are committed to offering our customers only 100% genuine and original products. We also take all necessary actions to ensure this: any seller found to be selling non-genuine products is immediately delisted from Blazebay.</p>
            <p style="">
                <em style="box-sizing: border-box;">Please send an email to&nbsp;</em><strong style="box-sizing: border-box;">support@blazebay.com</strong><em style="box-sizing: border-box;">&nbsp;if you think a product listed on our website does not meet these standards</em></p>

        </div>
    </div>
</div>


</div><!-- /.checkout-steps -->
</div>
</div><!-- /.row -->
</div><!-- /.checkout-box -->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

    <?php include(APPPATH.'/views/pages/premium-brands.php'); ?>
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div>



<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">


    <?php include(APPPATH.'/views/layout/footerbottom.php'); ?>
    <?php include(APPPATH.'/views/layout/copyright.php'); ?>

</footer>
<!-- ============================================================= FOOTER : END============================================================= -->


<!-- For demo purposes – can be removed on production -->


<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<?php include(APPPATH.'/views/layout/footer.php'); ?>


<script>
    $(document).ready(function(){
        $(".changecolor").switchstylesheet( { seperator:"color"} );
        $('.show-theme-options').click(function(){
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });
</script>


</body>
</html>