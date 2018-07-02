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
                        <table class="table table-striped table-bordered table-hover" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                            <tr>
                                <th style="text-align: left;" width="7%"><b>Page</b></th>
                                <th style="text-align: left;"><b>Position</b></th>
                                <th style="text-align: left;"><b>Dimensions in Pixels</b></th>
                                <th style="text-align: left;"><b>Size</b></th>
                                <th style="text-align: left;"><b>Amount / Per Month</b></th>
                            </tr>
                            </thead><tbody>
                            <tr>
                                <td>Home Page</td>
                                <td>Top Banner</td>
                                <td>147 X 90</td>
                                <td>50 Kb</td>
                                <td>56000</td>
                            </tr>
                            <tr>
                                <td>Product Page</td>
                                <td>Logo Banner Static(Top Right hand side)</td>
                                <td>450 X 60</td>
                                <td>50 Kb</td>
                                <td>78000</td>
                            </tr>
                            <tr>
                                <td>Home Page</td>
                                <td>Middle Banner</td>
                                <td>468 X 60</td>
                                <td>8 Kb</td>
                                <td>67000</td>
                            </tr>
                            </tbody></table>

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