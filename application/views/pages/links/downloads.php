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
                        <div class="row">

                            <div >
                                <label>Download Buyer Manual</label>


                                <button class="dwnld-btn" data-dwnfile="buyer_manual">Download</button>
                                <div class="clear"></div>
                            </div>
                            <div>
                                <label>Download Courier Manual </label>

                                <button class="dwnld-btn" data-dwnfile="courier_manual">Download</button>
                                <div class="clear"></div>
                            </div>
                            <div>
                                <label>Download Supplier Manual </label>

                                <button class="dwnld-btn" data-dwnfile="supplier_manual">Download</button>
                                <div class="clear"></div>
                            </div>
                                </div>

                            <div class="xdatabx" id="xdatabxid" style="display:none">
                                <p>Please Enter Your Email Address to Download</p>
                                <span class="dwnld-errmsgbx"></span>
                                <form action="<?php echo base_url();?>/downloads/" method="post" id="form-userdetails">
                                    <input name="useremail" value="" class="dwnld-inputbx" id="useremail" type="email">

                                    <input name="dwnldfile" value="" id="inptdwnldfile" type="hidden">
                                    <input name="download" value="submit" id="" type="submit">
                                </form>
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