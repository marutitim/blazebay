<!DOCTYPE html>
<html lang="en">
<head>

<?php


include(APPPATH.'/views/layout/head.php');
include'bussinessData.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.0/vegas.css" />
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


    <?php
	include('slider.php'); ?>


<!-- ========================================= SECTION – HERO : END ========================================= -->



    <?php include('product-listing.php'); ?>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.0/vegas.min.js"></script>

    <script>
	//var sliderdata="<?php  $minisite_bannerlist?>";
	//console.log(sliderdata);
    $("#minisite-sliders").vegas({
        slides: [
		  <?php  if(!empty($minisite_bannerlist)){ foreach($minisite_bannerlist as $slides) { ?>
            { src: "https://www.blazebay.com/assets/company_banner/<?=$slides['banner_image']?>" },
		  <?php } } else{ ?>
		   { src: "https://www.blazebay.com/assets/minisite/defaultImages/defaultBanners.jpg" },
		  <?php } ?>
        ],
        transition: 'fade',
        animation: 'random'
    });
</script>


</body>
</html>
