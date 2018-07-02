<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');
    include'bussinessData.php';
    if (file_exists("assets/uploadedimages/".$busi_data[0]['company_logo']) && $busi_data[0]['company_logo']!='') {
        $minisite_logo ='https://www.blazebay.com/assets/uploadedimages/'.$busi_data[0]['company_logo'];
    }else {

        $minisite_logo ='https://www.blazebay.com/assets/company_banner/BB-logo.png';
    }
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

                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-lightbox="image-1" data-title="Gallery" href="assets/images/products/p8.jpg">
                                                <img class="img-responsive" alt="" src="<?=$minisite_logo?>" data-echo="<?=$minisite_logo?>" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->


                                    </div><!-- /.single-product-slider -->


                                </div><!-- /.single-product-gallery -->
                                <?php echo html_entity_decode($busidata_biz['business_info']['companyprofile']); ?>
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name"><?=$busidata_biz['business_info']['company_name'];?></h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">

                                    <div class="description-container m-t-20">
                                        <table class="content-table">
                                            <tbody><tr data-role="companyBusinessType">
                                                <th class="col-title" data-spm-anchor-id="a2700.icbuShop.coge4f9797.i0.238e6d59xpDG1V">
                                                    Business Type:
                                                </th>
                                                <td class="col-value">
                                                    <?=$busidata_biz['busitype_name'];?>                          </td>
                                                <td class="col-verify">
                        <span class="company-verified-icon icon-onsite" title="Indicates information has been verified onsite by a certification specialist">
                    <i class="ui2-icon ui2-icon-checkmark verified-icon"></i>Verified</span>
                                                </td>
                                            </tr>
                                            <tr data-role="companyLocation">
                                                <th class="col-title">
                                                    Location:
                                                </th>
                                                <td class="col-value">
                                                    Shanghai, China (Mainland)                            </td>
                                                <td class="col-verify">
                        <span class="company-verified-icon icon-onsite" title="Indicates information has been verified onsite by a certification specialist">
                    <i class="ui2-icon ui2-icon-checkmark verified-icon"></i>Verified</span>
                                                </td>
                                            </tr>
                                            <tr data-role="supplierMainProducts">
                                                <th class="col-title">
                                                    Main Products:
                                                </th>
                                                <td class="col-value">
                                                    <?=$busidata_biz['few_mainproducts'];?>
                                                </td>
                                                <td class="col-verify">
                                                </td>
                                            </tr>
                                            <tr data-role="companyNumberOfEmployees">
                                                <th class="col-title">
                                                    Total Employees:
                                                </th>
                                                <td class="col-value">
                                                    <?php // echo $busidata_biz['total_employees'];?>  People


                                                </td>
                                                <td class="col-verify">
                                                </td>
                                            </tr>
                                            <tr data-role="supplierTotalAnnualSalesVolume">
                                                <th class="col-title">
                                                    Total Annual Revenue:
                                                </th>
                                                <td class="col-value">
                                                    <?php
                                                    if(!empty($busidata_biz['business_info']['anual_revenue'])){
                                                        echo $busidata_biz['business_info']['anual_revenue'];
                                                    }else{ echo "N/A";}
                                                    ?>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr data-role="companyEstablishedYear">
                                                <th class="col-title">
                                                    Year Established:
                                                </th>
                                                <td class="col-value">
                                                    <a href="#" target="_blank" data-domdot="id:25854">
                                                        <?=$busidata_biz['yearEstablishedOn'];?>                   </a>
                                                </td>
                                                <td class="col-verify">
                        <span class="company-verified-icon icon-onsite" title="Indicates information has been verified onsite by a certification specialist">
                    <i class="ui2-icon ui2-icon-checkmark verified-icon"></i>Verified</span>
                                                </td>
                                            </tr>
                                            <tr data-role="companyMainMarket">
                                                <th class="col-title">
                                                    Top 3 Markets:
                                                </th>
                                                <td class="col-value">
                                                    <a class="market-item" href="javascript:;" data-domdot="id:25855">
                                                        <span class="">South America</span>
                                                        <span>30.00%</span>
                                                    </a>
                                                    <a class="market-item" href="javascript:;" data-domdot="id:25855">
                                                        <span class="">South Asia</span>
                                                        <span>20.00%</span>
                                                    </a>
                                                    <a class="market-item" href="javascript:;" data-domdot="id:25855">
                                                        <span class="">Eastern Europe</span>
                                                        <span>20.00%</span>
                                                    </a>
                                                </td>
                                                <td class="col-verify">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">

                                                </td>
                                                <td class="icon-col">
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </div><!-- /.description-container -->









                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>





                </div>


            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">



        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->
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
<!-- For demo purposes – can be removed on production : End -->



</body>
</html>
