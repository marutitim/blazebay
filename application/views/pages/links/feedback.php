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
                        <p style=" width:350px; float:left; margin:0 2% 0 0">
                            <img src="https://www.blazebay.com/Uploads/ckfinder/userfiles/images/about-us-img.jpg" style="width:350px;height:215px;" /></p>
                        <p style="text-align: justify;">
                            Blazebay<span background-color:="" bitstream="" font-size:="" new="" text-align:="" times="">.com is Africa&#39;s first virtual Int</span><span background-color:="" bitstream="" font-size:="" new="" text-align:="" times="">egrat</span><span background-color:="" bitstream="" font-size:="" new="" text-align:="" times="">ed trade platform. We serve millions of buyers and suppliers Globally with millions of commodities</span>. Blazebay is a subsidiary of Churchblaze group limited, a Kenyan-owned group of Technology Companies incorporated in Kenya in September 2014 under Certificate of Incorporation Number CPR/2014/160218</p>
                        <p style="text-align: justify;">
                            &nbsp;</p>
                        <p style="text-align: center;">
                            <span style="font-size:22px;"><em><strong><span style="color:#0099cc;">Our</span> <span style="color:#ffa500;">Mission</span></strong></em></span></p>
                        <p style="text-align: justify;">
                            To make business easier anywhere and everywhere and to change the way business is done in the present world giving tools which are necessary to the suppliers in order to reach a global audience for their commodities and also by making it quickly and efficiently for buyers to find commodities and suppliers.</p>
                        <p style="text-align: justify;">
                            &nbsp;</p>
                        <p style="text-align: justify;">
                            &nbsp;</p>
                        <p style="text-align: justify;">
                            &nbsp;</p>
                        <p style="text-align: justify;">
                            <em><span style="font-size:22px;"><strong><span style="color:#0099cc;">Our</span><span style="color:#ffa500;"> vision</span></strong></span></em></p>
                        <p style="text-align: justify;">
                            Mission to perfect e-business.</p>
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