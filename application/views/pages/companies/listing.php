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
<div class="body-content outer-top-xs">
<div class='container'>
<div class='row'>
<div class='col-md-3 sidebar'>
    <!-- ================================== TOP NAVIGATION ================================== -->
    <div class="side-menu animate-dropdown outer-bottom-xs">
        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
        <?php include(APPPATH.'/views/pages/categories.php'); ?>
    </div><!-- /.side-menu -->
    <!-- ================================== TOP NAVIGATION : END ================================== -->	            <div class="sidebar-module-container">
        <?php if(isset($selloffers)){ ?>
            <?php include(APPPATH.'/views/pages/products/shopby.php'); ?>
        <?php } else {?>
            <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                <h3 class="section-title">Special Deals</h3>
                <?php  include(APPPATH.'/views/pages/home/hot-deals.php'); ?>
            </div><!-- /.sidebar-widget -->
        <?php } ?>
        <!-- ============================================== SPECIAL DEALS : END ============================================== -->

    </div><!-- /.sidebar-module-container -->
</div><!-- /.sidebar -->
<div class='col-md-9'>
<!-- ========================================== SECTION – HERO ========================================= -->
<?php if(isset($selloffers)){ ?>
    <?php include(APPPATH.'/views/pages/products/offer-banner.php'); ?>
<?php }?>





<!-- ========================================= SECTION – HERO : END ========================================= -->
<div class="clearfix filters-container m-t-10">
    <div class="row">

        <?php
        function getThumbImagePath($filename, $path, $pictype = NULL) {
            $fullpath =base_url()."assets/uploadedimages/".$filename;
            return $fullpath;
        }

        if(!empty($header_search_string)) {
            $q_string = $q_string . " b.`company_name` LIKE '%$header_search_string%' ";

        }

        $append = 'suppliers-per-country/'.$country."/";
        $qqq = "
		SELECT *
		FROM bt_business b
    JOIN bt_members m ON m.user_id=b.user_id
		WHERE
      m.suspended='N' AND m.usertype=2 AND m.country=$country  AND b.`company_name` <>'' ";

        if(!empty($q_string)) {
            $qqq = $qqq . " AND (" . $q_string . ")";
        }else{
            $qqq = $qqq . " ORDER BY b.`company_name` ASC ";
        }
            $name='Companies From '.$countryName;

        require_once APPPATH.'libraries/ps_pagination.php';
        require_once APPPATH.'views/pages/aoth/external-conn.php';
        $pager = new PS_Pagination($dbh , $qqq, 9, 5, $append, base_url(),$Getpage);
        //The paginate() function returns a mysql result set for the current page
        $res = $pager->paginate();


        $details=array();
        if($res) {
            $TotalProduct_found = mysqli_num_rows(mysqli_query($dbh, $qqq));
            while ($row =mysqli_fetch_array($res)) {
                $details[] =$row;
            }
        }

        ?>

        <h2 class="section-title" style="text-align:center;"><?=$name?></h2>
        <div class="col col-sm-6 col-md-2">
            <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active">
                        <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
                    </li>
                    <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
            </div><!-- /.filter-tabs -->
        </div><!-- /.col -->
        <div class="col col-sm-12 col-md-6">

        </div><!-- /.col -->
        <div class="col col-sm-6 col-md-4 text-right">
            <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                    <?php
                    if($pager->total_rows>12){
                        echo  $pager->renderFullNav();
                    }?>
                </ul><!-- /.list-inline -->
            </div><!-- /.pagination-container -->		</div><!-- /.col -->
    </div><!-- /.row -->
</div>
<div class="search-result-container ">
<div id="myTabContent" class="tab-content category-list">
    <div class="tab-pane active " id="grid-container">
        <div class="category-product">
            <div class="row">

                <?php
                if(!empty($details)) {

                    foreach ($details as $val) {
if(file_exists("assets/uploadedimages/".$val['company_logo']) && $val['company_logo']!=""){
                        $productLink =RemoveBadURLCharaters(urlencode($val['company_name'])) .'/' . $val['user_id'];
                        $imageLink ='https://www.blazebay.com/assets/uploadedimages/'.$val["company_logo"];
                        ?>
                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                            <div class="products">


                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="<?=base_url() . $productLink ?>"><img class="newproductImages"
                                                                                            src="<?= $imageLink ?>"
                                                                                            alt="<?= $val['company_name'] ?>"
                                                                                            alt="<?= $val['company_name'] ?>"></a>
                                        </div>
                                        <!-- /.image -->


                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="<?= base_url() . $productLink ?>"><?= $val['company_name'] ?></a>
                                        </h3>



                                    </div>

                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div><!-- /.item -->
                    <?php
                    }
					}
                } else {
 ?>
                        No Results Found From <b> <?=$countryName; ?>  </b>
                    <?php
                    } ?>

            </div><!-- /.row -->
        </div><!-- /.category-product -->

    </div><!-- /.tab-pane -->

    <div class="tab-pane "  id="list-container">
        <div class="category-product">

            <?php
            if(!empty($details)){
                foreach($details as $val){
					if(file_exists("assets/uploadedimages/".$val['company_logo']) && $val['company_logo']!=""){
						
                    $productLink =RemoveBadURLCharaters(urlencode($val['company_name'])) .'/' . $val['user_id'];

                    $imageLink ='https://www.blazebay.com/assets/uploadedimages/'.$val["company_logo"];
                    ?>
                    <div class="category-product-inner wow fadeInUp">
                        <div class="products">
                            <div class="product-list product">
                                <div class="row product-list-row">
                                    <div class="col col-sm-4 col-lg-4">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="<?=base_url().$productLink ?>"><img class="newproductImages" src="<?=$imageLink?>"  alt="<?=$val['company_name']?>" alt="<?=$product['title']?>"></a>

                                            </div>
                                        </div><!-- /.product-image -->
                                    </div><!-- /.col -->
                                    <div class="col col-sm-8 col-lg-8">
                                        <div class="product-info">
                                            <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=$val['company_name']?></a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price">

                                            </div><!-- /.product-price -->
                                            <div class="description m-t-10"><?=$val['companyprofile']?></div>

                                        </div><!-- /.product-info -->
                                    </div><!-- /.col -->
                                </div><!-- /.product-list-row -->
                                    </div><!-- /.product-list -->
                        </div><!-- /.products -->
                    </div><!-- /.category-product-inner -->
                <?php }
				}
            } else {

                 ?>
                    No Results Found From <b> <?=$header_search_string; ?>  </b>
                <?php
                }
            ?>

        </div><!-- /.category-product -->
    </div><!-- /.tab-pane #list-container -->
</div><!-- /.tab-content -->
<div class="clearfix filters-container">

    <div class="text-right">
        <div class="pagination-container">
            <ul class="list-inline list-unstyled">
                <?php
                if($pager->total_rows>12){
                    echo  $pager->renderFullNav();
                }?>
            </ul><!-- /.list-inline -->
        </div><!-- /.pagination-container -->						    </div><!-- /.text-right -->

</div><!-- /.filters-container -->

</div><!-- /.search-result-container -->

</div><!-- /.col -->
</div><!-- /.row -->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->

</div><!-- /.logo-slider-inner -->

</div><!-- /.logo-slider -->


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





</body>
</html>