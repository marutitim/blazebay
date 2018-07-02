<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');
    include'bussinessData.php';
    ?>

</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include('top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->

    <div class="main-header">
        <div class="container" >

            <?php include('logo.php'); ?>

        </div><!-- /.container -->

    </div><!-- /.main-header -->


    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">

            <?php include('menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->

<!-- ============================================== HEADER : END ============================================== -->

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">


                    <div class="contact-page">
                        <div class="row">


                            <div class="col-md-8 contact-form">
                                <div class="col-md-12 contact-title">
                                    <h4>Contact Form</h4>
                                </div>
                                <div class="col-md-4 ">
                                    <form class="register-form" role="form">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form class="register-form" role="form">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form class="register-form" role="form">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                                            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="Title">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <form class="register-form" role="form">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
                                            <textarea class="form-control unicase-form-control" id="exampleInputComments"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12 outer-bottom-small m-t-20">
                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>
                                </div>
                            </div>
                            <div class="col-md-4 contact-info">
                                <div class="contact-title">
                                    <h4>Information</h4>
                                </div>
                                <div class="clearfix address">
                                    <span class="contact-i"><i class="fa fa-map-marker"></i></span>
		<span class="contact-span"><?php  echo $business_data[0]['address1'].' '.$business_data[0]['zip'].' '.$business_data[0]['country'] ?>
              </span>
                                </div>
                                <div class="clearfix phone-no">
                                    <span class="contact-i"><i class="fa fa-mobile"></i></span>
                                    <span class="contact-span"><?php  echo $business_data[0]['mobile']?></span>
                                </div>
                                <div class="clearfix email">
                                    <span class="contact-i"><i class="fa fa-envelope"></i></span>
                                    <span class="contact-span"><a href="#"><?php  echo $business_data[0]['email']?></a></span>
                                </div>
                            </div>			</div><!-- /.contact-page -->
                    </div><!-- /.row

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                </div>

            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">



        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

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
<!-- For demo purposes – can be removed on production : End -->



</body>
</html>
