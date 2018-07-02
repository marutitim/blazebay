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
                        <div class="blazebay_kpertxt" style="text-align: justify;">
                            <p>
                                Online shopping is easy, simple and quick. You might enjoy the comfort and convenience of ordering or buying your favorite products in a few clicks or taps. However, sometimes when your order arrives, you may realize that the product isn&rsquo;t exactly what you ordered. It may not be of the right size or color, or in rare cases you might find that it is defective or damaged. What do you do now? This is where the Blazebay product Free &amp; Easy Returns process makes your life easier.&nbsp;Returns accepted within 3 days, only for damaged or wrong products.</p>
                            <p>
                                <span style="font-size:16px;"><strong style="font-size: 16px;color: #fd7f1b;">How it works</strong></span></p>
                            <p>
                                This simple guide will help you understand how the Blazebay product Free &amp; Easy Returns process works, making your shopping and returns experience smooth and convenient.</p>
                            <p align="center" style="background: #f4f8ff; color: #4972b6; padding: 15px 0; border: solid 1px #d5e5ff; border-radius: 3px; margin: 30px 0;
    display: block;">
                                <span style="font-size:18px;"><strong>Create a return request &nbsp; &nbsp;- &nbsp; &nbsp;Verification process &nbsp; &nbsp;- &nbsp; &nbsp;Keep everything ready</strong></span></p>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <span><strong style="font-size: 16px;color: #fd7f1b;">Here is how the Blazebay product Free &amp; Easy Returns process works;</strong></span></p>
                                    <p>
                                        1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Log in to Blazebay and go to your Orders list tab. Tap or click on Return to create a request</p>
                                    <p>
                                        2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Depending on the kind of product you wish to return, your return request may have to undergo a verification &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;process</p>
                                    <p>
                                        3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Following verification, you will be required to confirm your decision based on the category of product ordered. Three options are available:</p>
                                    <ul>
                                        <li>
                                            Exchange: Your order will be exchanged for a new identical product of a different size or color</li>
                                        <li>
                                            Replace: The product in your order will be replaced with an identical product in case it is damaged (broken or spoiled) or defective (has a functional problem that causes it not to work) or is not as described</li>
                                        <li>
                                            Refund: If the product of your choice is unavailable in your preferred size or color or model, or if it is out of stock, you may decide that you want your money back. In this scenario, you may choose Refund to have your money returned to you (See Step 6)</li>
                                    </ul>
                                    <p>
                                        4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Keep ready all the requisite items necessary for a smooth returns process &mdash; including invoice, original packaging, price tags, freebies, accessories, etc.</p>
                                    <p>
                                        5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pickup and Delivery of your order will be scheduled in case of exchanges and replacements</p>
                                    <p>
                                        6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Refund will be initiated and processed if applicable</p>
                                    <p>
                                        7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your request will be fulfilled according to Blazebay&rsquo;s product Free &amp; Easy Returns guarantee</p>

                                </div>
                                <div class="col-md-6">
                                    <!--<img src="<?php echo base_url();?>assets/images/bb-fnr.jpg" style="border: 0;padding: 0; min-width: 100%;" />
										--></div>
                            </div>
                        </div>
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