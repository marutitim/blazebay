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
                       <div class="col-md-4"> <p style=" width:350px; float:left; margin:0 2% 0 0">
                            <img src="<?=base_url()?>Uploads/ckfinder/userfiles/images/about-us-img.jpg" style="width:350px;height:215px;" /></p>
							</div>
							<div class="col-md-8">
                        <p style="text-align: justify;">
                            <span style="color:#0099cc;">Blaze</span><span style="color:#ffa500;">bay.com</span> is the largest e-commerce platform in Africa offering a wholesale market with thousands of different 
							products globally. Blazebay is a platform that has opened up the African e-commerce market to the rest of the  
							world since its inception in 2015. Blazebay  was formed to help small medium enterprises engage in manufacturing 
							and trading.
							</p>
                        
                        <p style="text-align: justify;">
                            <span style="font-size:22px;"><em><strong><span style="color:#0099cc;">Our</span> <span style="color:#ffa500;">Mission</span></strong></em></span></p>
                        <p style="text-align: justify;">
                            Making business easier anywhere and everywhere.</p>
                     
                        <p style="text-align: justify;">
                            <em><span style="font-size:22px;"><strong><span style="color:#0099cc;">Our</span><span style="color:#ffa500;"> vision</span></strong></span></em></p>
                        <p style="text-align: justify;">
                            To be the leading ecommerce tool for intra-Africa trade globally</p>
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