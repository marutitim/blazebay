
<!DOCTYPE html>
<html lang="en">
<head>
<?php

include('layout/head.php'); ?>

</head>
<body class="cnt-home">

<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

<!-- ============================================== TOP MENU ============================================== -->
<!--    --><?php // include('layout/top.php'); ?>
<!-- ============================================== TOP MENU : END ============================================== -->
<div class="main-header">
    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->

    <div class="container">
        <?php include('layout/mainheader.php'); ?>
    </div><!-- /.container -->

</div><!-- /.main-header -->

<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">

    <div class="container">


            <?php include('layout/menu.php'); ?>
   <!-- /.container-class -->

    </div>

</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
<div class="container">
<div class="row">
<!-- ============================================== SIDEBAR ============================================== -->
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <div class="mobile-hide">
<!-- ================================== TOP NAVIGATION ================================== -->
        <?php
        if ($this->agent->is_mobile())
        {
            echo " ";
        }

        else
        {
        ?>
<div class="side-menu animate-dropdown outer-bottom-xs">
<div class="head"><i class="icon fa fa-align-justify fa-fw"></i> <?php if($languange=='Swahili'){ echo 'Makundi';} else {?>Categories<?php } ?></div>
    <?php include('pages/categories.php'); ?>
<!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
   <?php } ?>
    </div>
<!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="mobile-hide">
            <?php


            if ($this->agent->is_mobile())
            {
                echo " ";
            }

            else
            {
            ?>

            <div class="home-banner outer-bottom-xs">

    <?php include('pages/home/app-add.php'); ?>
</div>

    <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Biashara';} else {?>Tradeshows<?php }?></h3>
        <?php include(APPPATH.'/views/pages/home/tradeshows.php'); ?>
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ==============================================

<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
<h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Mikataba  Shwari';} else {?>Hot deals<?php }?></h3>
    <?php include('pages/home/hot-deals.php'); ?>
</div>
<!-- ============================================== HOT DEALS: END ============================================== -->


<!-- ============================================== SPECIAL OFFER ============================================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
<h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Ofa maalum';} else {?>Special Offer<?php }?></h3>
    <?php include('pages/home/special-offers.php'); ?>
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Vitambulisho vya bidhaa';} else {?>Product tags<?php }?></h3>
    <?php include('pages/home/product-tags.php'); ?>
</div><!-- /.sidebar-widget -->
<!-- ============================================== PRODUCT TAGS : END ============================================== -->
<!-- ============================================== SPECIAL DEALS ============================================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
<h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Mikataba maalum';} else {?>SPECIAL OFFER<?php }?></h3>
    <?php include('pages/home/hot-deals.php'); ?>
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL DEALS : END ============================================== -->
<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Majarida';} else {?>Newsletters<?php }?></h3>
    <?php include('pages/home/newsletter.php'); ?>

</div><!-- /.sidebar-widget -->
<!-- ============================================== NEWSLETTER: END ============================================== -->
    <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Mikataba ya kwanza';} else {?>Premium deals<?php }?></h3>
        <?php include(APPPATH.'/views/pages/products/Premium.php'); ?>
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ==============================================

   <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Ujenzi';} else {?>Building and Constructions<?php }?></h3>
        <?php include(APPPATH.'/views/pages/products/Building.php'); ?>
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ==============================================

 <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Samani za nyumbani';} else {?>Home furniture<?php }?></h3>
        <?php include(APPPATH.'/views/pages/products/furniture.php'); ?>
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ==============================================

 <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
        <h3 class="section-title">Bags</h3>
        <?php include(APPPATH.'/views/pages/products/bags.php'); ?>
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ==============================================

<!-- ============================================== Testimonials============================================== -->
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
    <?php include('pages/home/customer-feedback.php'); ?>
</div>
<?php } ?>
    </div>


</div><!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->

<!-- ============================================== CONTENT ============================================== -->
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
<!-- ========================================== SECTION – HERO ========================================= -->

<div id="hero">
    <?php include('pages/home/slider.php'); ?>
</div>

<!-- ========================================= SECTION – HERO : END ========================================= -->
<div class="slider-bottom-mobile"></div>
<!-- ============================================== INFO BOXES ============================================== -->
<div class="info-boxes wow fadeInUp">
    <?php include('pages/home/slider-bottom.php'); ?>
</div><!-- /.info-boxes -->
<!-- ============================================== INFO BOXES : END ============================================== -->
<!-- ============================================== featured ============================================== -->
    <section class="section featured-product wow fadeInUp">
        <h3 class="section-title"> Featured products</h3>
        <?php include('pages/home/new-products.php'); ?>
    </section><!-- /.section -->
<!-- ============================================== Sfeatured: END ============================================== -->
<!-- ============================================== banners ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
    <?php include('pages/home/first-banner.php'); ?>
</div><!-- /.wide-banners -->

<!-- ============================================== banners:end ============================================== -->

<div class="best-deal wow fadeInUp outer-bottom-xs">
    <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Bidhaa za jumla(<span style="text-transform: lowercase;color:#ff7878"> Ununuzi wa Moja kwa moja kutoka kwa Wauzaji</span>)';} else {?> Wholesale products(<span style="text-transform: capitalize;color:#ff7878"> Direct Product Purchases from the Supplier</span>)<?php }?>
    </h3>
    <?php include('pages/home/best-seller.php'); ?>
</div><!-- /.sidebar-widget -->
<!-- ============================================== Wholesale : END ============================================== -->

    <div class="best-deal wow fadeInUp outer-bottom-xs">
        <h3 class="section-title">Products Under<span style="color:#ff7878"> <?=$currencySymbol.' '?> <?=number_format(number_format((float)9.9157*$currencyRate, 0, '.', ''))?></span></h3>
        <?php include('pages/home/products-under-1000.php'); ?>
    </div><!-- /.sidebar-widget -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->
<!-- ============================================== FEATURED PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
<h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Bidhaa zilizojitokeza ';} else {?> New Products<?php }?></h3>
    <?php include('pages/home/featured-products.php'); ?>
</section><!-- /.section -->
<!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

    <!-- ============================================== WIDE PRODUCTS ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
    <?php include('pages/home/second-banner.php'); ?>
</div><!-- /.wide-banners -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->

    <div class="best-deal wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Viatu';} else {?> Shoes<?php }?> </h3>
        <?php include('pages/home/apparel-products.php'); ?>
    </div><!-- /.sidebar-widget -->


    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
<section class="section wow fadeInUp new-arriavls">
<h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Ufikiaji Mpya';} else {?> New Arrivals<?php }?> </h3>
    <?php include('pages/home/new-arrivals.php'); ?>
</section><!-- /.section -->

    <!-- ============================================== BEST SELLER : END ============================================== -->

    <div class="best-deal wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Vitu vya nyumba';} else {?> Households products<?php }?> </h3>
        <?php include('pages/home/home-products.php'); ?>
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== BEST SELLER : END ============================================== -->
    <!-- ============================================== BEST SELLER : END ============================================== -->

    <div class="best-deal wow fadeInUp outer-bottom-xs">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Mashine';} else {?> Machines<?php }?> </h3>
        <?php include('pages/home/Machines.php'); ?>
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== BEST SELLER : END ============================================== -->

    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
    <!-- ============================================== BLOG SLIDER ============================================== -->
    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
        <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Matukio ya karibuni kutoka kwenye blogu';} else {?>latest from  the blog<?php }?></h3>
        <?php include('pages/home/blog.php'); ?>
    </section><!-- /.section -->
    <!-- ============================================== BLOG SLIDER : END ============================================== -->

</div><!-- /.homebanner-holder -->
<!-- ============================================== CONTENT : END ============================================== -->
</div><!-- /.row -->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div class="checkout-box faq-page">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-title">Our Trusted Partners</h2>
                <?php include(APPPATH.'/views/pages/premium-brands.php'); ?>
            </div>
        </div><!-- /.row -->
    </div><!-- /.checkout-box -->

    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->




<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">


    <?php include('layout/footerbottom.php'); ?>
    <?php include('layout/copyright.php'); ?>

</footer>
<!-- ============================================================= FOOTER : END============================================================= -->


<!-- For demo purposes – can be removed on production -->


<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<?php include('layout/footer.php'); ?>





</body>
</html>