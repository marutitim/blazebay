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
                        <div class="col-md-4">
                        <ul>
                            <li><a href="https://www.blazebay.com/about">About Us</a>
                            </li>
                            <li><a href="https://www.blazebay.com/login/">Sign in</a>
                            </li>
                            <li><a href="https://www.blazebay.com/signup">Signup</a>
                            </li>
                            <li><a href="https://www.blazebay.com/successStory">Why Blazebay.com</a>
                            </li>
                        </ul>
                        </div>
                        <div class="col-md-4"><b>Buy on blazebay.com</b>
                        <ul>
                            <li><a href="https://www.blazebay.com/all/categories">Categories</a>
                            </li>
                            <li><a href="https://www.blazebay.com/enquiry">Enquire</a>
                            </li>
                            <li><a href="https://www.blazebay.com/quotation">Ask for Quotation</a>
                            </li>
                            <li><a href="https://www.blazebay.com/">featured products</a>
                            </li>
                            <li><a href="https://www.blazebay.com/wholesell">Wholesale products</a>
                            </li>
                            <li><a href="https://www.blazebay.com/">Premium products</a>
                            </li>
                            <li><a href="https://www.blazebay.com/buy-offers">Buy Offers</a>
                            </li>
                            <li><a href="https://www.blazebay.com/sale-offers">Sell Offers</a>
                            </li>
                            <li><a href="https://www.blazebay.com/">Search By Country</a>
                            </li>
                            <li><a href="https://www.blazebay.com/">Premium Products</a>
                            </li>
                            <li><a href="https://www.blazebay.com/">Country search</a>
                            </li>
                        </ul>
                          </div>  <div class="col-md-4">
                        <b>Customer Service</b>
                        <ul>
                            <li><a href="https://blazebay.com/contact">Contact Us</a>
                            </li>
                            <li><a href="https://blazebay.com/sitehelp">Help Center</a>
                            </li>
                            <li><a href="https://blazebay.com/feedback">Feedback</a>
                            </li>
                            <li><a href="https://blazebay.com/privacyPolicy">Policies</a>
                            </li>
                            <li><a href="https://blazebay.com/report-abuse">Report Abuse</a>
                            </li>
                            <li><a href="https://blazebay.com/refundAndReturn">Submit a Dispute</a>
                            </li>
                        </ul>
                            </div><div class="col-md-4"><b>Sell on Blazebay.com</b>
                        <ul>
                            <li><a href="https://blazebay.com/manage-minisite/">Free Minisite</a>
                            </li>
                            <li><a href="https://blazebay.com/upgrade-membership/">Supplier Membership</a>
                            </li>
                            <li><a href="https://blazebay.com/learningCenter">Learning center</a>
                            </li>
                            <li><a href="https://blazebay.com/login">Trade Alerts</a>
                            </li>
                        </ul>
                        </div><div class="col-md-4"><b>Trade Services</b>
                        <ul>
                            <li><a href="https://blazebay.com/contact">Trade Security</a>
                            </li>
                            <li><a href="https://blazebay.com/sitehelp">Secure payments</a>
                            </li>
                            <li><a href="https://blazebay.com/feedback">BUsiness Identity</a>
                            </li>
                            <li><a href="https://blazebay.com/privacyPolicy">Logistics Services</a>
                            </li>
                        </ul>
                        </div><div class="col-md-4"><b>Trade Services</b>
                        <ul>
                            <li><a href="https://blazebay.com/contact">Trade Shows</a>
                            </li>
                        </ul>
                            </div>
</body>
</html>

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