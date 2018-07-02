<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 10:58 AM
 */
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
        <!-- ============================================================= LOGO ============================================================= -->
        <div class="logo">
            <?php include('logo.php'); ?>
        </div><!-- /.logo -->
        <!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

    <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
        <!-- /.contact-row -->
        <!-- ============================================================= SEARCH AREA ============================================================= -->
        <?php include('search.php'); ?>
        <!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
        <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
        <?php
        if ($this->agent->is_mobile())
        {
            echo " ";
        }

        else
        {
        ?>
        <div class="mobile-hide">
        <?php include('shopping-cart.php'); ?>
            </div>
        <?php } ?>
        <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
</div><!-- /.row -->
