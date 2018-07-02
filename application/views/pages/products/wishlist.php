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
                        <?php if(!empty($wishlist)){?>
                        <div class="table-responsive">

                            <table class="table compare-table inner-top-vs">
                                <tr>
                                    <th>Products</th>
                                    <?php foreach($wishlist as $wish){
                                        $where=" id = '" . $wish['fev_product_id'] . "'";
                                        $rs_product= $this->Site_model->getDataById( 'bt_products', $where );
                                        $productLink="product-details/".RemoveBadURLCharaters($rs_product[0]['title'])."/".$rs_product[0]['id']."/".$rs_product[0]['uid'];
                                        //$imageLink="assets/uploadedimages/".$product['image'];

                                        $imageLink="https://www.blazebay.com/assets/uploadedimages/".$rs_product[0]['image'];
                                        ?>
                                    <td>
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="<?=$productLink?>">
                                                        <img class="newproductImages" alt="<?=$rs_product[0]['title']?>" src="<?=$imageLink?>">
                                                    </a>
                                                </div>

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="<?=$productLink?>"><?=$rs_product[0]['title']?></a></h3>

                                                    <div class="action">
                                                        <a class="lnk btn btn-primary" href="#" onclick="return buy(<?=$rs_product[0]['id']?>,<?=$rs_product[0]['min_order']?>)">Order Now </a>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                      <?php }?>

                                </tr>

                                <tr>
                                    <th>Price</th>
                                    <?php foreach($wishlist as $wish){
                                        $where=" id = '" . $wish['fev_product_id'] . "'";
                                        $rs_product= $this->Site_model->getDataById( 'bt_products', $where );

                                        ?>
                                    <td>
                                        <div class="product-price">
                                            <span class="price"><?=$currencySymbol?>. <?=number_format((float)$rs_product[0]['price']* $currencyRate, 2, '.', '');?></span>
<!--                                            <span class="price-before-discount">ksh.500.00</span>-->
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <?php foreach($wishlist as $wish){
                                        $where=" id = '" . $wish['fev_product_id'] . "'";
                                        $rs_product= $this->Site_model->getDataById( 'bt_products', $where );

                                        ?>
                                    <td><p class="text"><?=$rs_product[0]['description']?><p></td>
                                    <?php } ?>
                                </tr>

                                <tr>
                                    <th>Availability</th>
                                    <?php foreach($wishlist as $wish){
                                        $where=" id = '" . $wish['fev_product_id'] . "'";
                                        $rs_product= $this->Site_model->getDataById( 'bt_products', $where );

                                        ?>
                                    <td><p class="in-stock"><?=$rs_product[0]['quantity']?> In Stock</p></td>
                                    <?php } ?>
                                         </tr>

                                <tr >
                                    <th>Remove</th>
                                    <?php foreach($wishlist as $wish){
                                        $where=" id = '" . $wish['fev_product_id'] . "'";
                                        $rs_product= $this->Site_model->getDataById( 'bt_products', $where );

                                        ?>
                                    <td class='text-center'><a href="#" onclick=" return removeWishlist(<?=$wish['fev_id']?>)" class="remove-icon"><i class="fa fa-times"></i></a></td>
                                    <?php } ?>
                                      </tr>
                            </table>
                        </div>
                        <?php } else {?>
                            <div class="alert alert-info" role="alert">
                                No wishlist items found
                            </div>
                        <?php } ?>
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