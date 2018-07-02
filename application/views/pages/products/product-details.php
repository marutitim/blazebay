<!DOCTYPE html>
<html lang="en">
<head>

    <?php

    include(APPPATH.'/views/layout/head.php');?>

    <style>
        .product-share {
            text-align: center;
            margin: 0 0 20px 0;
        }
        .product-share a.fb {
            background: #3b5998;
        }
        .product-share a.tw {
            background: #55acee;
        }
        .product-share a.gplus {
            background: #dd4b39;
        }
        .product-share a.pint {
            background: #bd081c;
        }
        .product-share a {
            border-radius: 50%;
            display: inline-block;
            margin: 0 3px;
            font-size: 22px;
            line-height: 43px;
            width: 40px;
            height: 40px;
            color: #fff;
            text-decoration: none;
        }
        .fa-facebook-f:before, .fa-facebook:before {
            content: "\f09a";
        }
        .fa-twitter:before {
            content: "\f099";
        }

        .fa-google-plus:before {
            content: "\f0d5";
        }
        .fa-pinterest:before {
            content: "\f0d2";
        }
    </style>
</head>

<body class="cnt-home">

<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <?php  include(APPPATH.'/views/layout/mainheader.php'); ?>
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class='container'>
<div class='row single-product'>
<div class='col-md-3 sidebar'>

    <div class="sidebar-module-container">
        <?php
        if ($this->agent->is_mobile())
        {
            echo " ";
        }

        else
        {
        ?>
        <div class="home-banner outer-top-n">
            <?php include(APPPATH.'/views/pages/home/app-add.php'); ?>
        </div>



        <!-- ============================================== HOT DEALS ============================================== -->
        <div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
            <h3 class="section-title">hot deals</h3>
            <?php include(APPPATH.'/views/pages/products/hotSelling.php'); ?>
        </div>
        <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ==============================================

<!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
            <h3 class="section-title">Newsletters</h3>
            <?php include(APPPATH.'/views/pages/home/newsletter.php'); ?><!-- /.sidebar-widget-body -->
        </div><!-- /.sidebar-widget -->
        <!-- ============================================== NEWSLETTER: END ============================================== -->

        <!-- ============================================== Testimonials: END ============================================== -->
<?php } ?>


    </div>
</div><!-- /.sidebar -->

<div class='col-md-9'>
<div class="detail-block">
<div class="row  wow fadeInUp">

<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="row">
        <div class="product-item-holder size-big single-product-gallery small-gallery">
            <?php

            $defaultImage="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image'];

            if(isset($offerType) && $offerType=='Buyoffer'){
                $defaultImage="https://www.blazebay.com/assets/uploadedimages/buyoffer/".$productDetails[0]['image'];

            }else{
                $defaultImage="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image'];
            }
            ?>
            <div id="owl-single-product">
                <div class="single-product-gallery-item" id="slide1">
                    <a data-lightbox="image-1" data-title="Gallery" href="assets/images/products/p8.jpg">
                        <img class="img-responsive" alt="" src="<?=$defaultImage?>" data-echo="<?=$defaultImage?>" />
                    </a>
                </div><!-- /.single-product-gallery-item -->


                <?php foreach($productImages as $key=> $images) {
                    $imageLink = "https://www.blazebay.com/assets/multimage/" . $images['img_url'];
                    if (file_exists("assets/multimage/" . $images['img_url'])) {
                        ?>
                        <div class="single-product-gallery-item" id="<?= $images['id'] ?>">
                            <a data-lightbox="image-<?= $key ?>" data-title="Gallery" href="<?= $imageLink ?>">
                                <img class="img-responsive" alt="" src="<?= $imageLink ?>"
                                     data-echo="<?= $imageLink ?>"/>
                            </a>
                        </div>

                        <!-- /.single-product-gallery-item -->
                        <!-- /.single-product-gallery-item -->
                    <?php
                    }
                } ?>


            </div><!-- /.single-product-slider -->


            <div class="single-product-gallery-thumbs gallery-thumbs">

                <div id="owl-single-product-thumbnails">
                    <div class="item">
                        <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                            <img class="img-responsive" width="85" alt="" src="<?=$defaultImage?>"
                                 data-echo="<?=$defaultImage?>" />
                        </a>
                    </div>

                    <?php foreach($productImages as $key=> $images) {
                        $imageLink = "https://www.blazebay.com/assets/multimage/" . $images['img_url'];
                        if (file_exists("assets/multimage/" . $images['img_url'])) {
                            ?>
                            <div class="item">
                                <a class="horizontal-thumb" data-target="#owl-single-product"
                                   data-slide="<?=$images['id'] ?>" href="#<?= $images['id'] ?>">
                                    <img class="img-responsive" width="85" alt="" src="<?= $imageLink ?>"
                                         data-echo="<?= $imageLink ?>"/>
                                </a>
                            </div>
                        <?php
                        }
                    } ?>

                </div><!-- /#owl-single-product-thumbnails -->



            </div><!-- /.gallery-thumbs -->

        </div>
    </div>

    <!-- /.single-product-gallery -->
</div>
<!-- /.gallery-holder -->
<div class='col-sm-6 col-md-7 product-info-block'>
    <div class="product-info">
        <h1 class="name"><?=ucfirst(strtolower($productDetails[0]['title']))?></h1>

        <div class="rating-reviews m-t-20">
            <div class="row">
                <div class="col-sm-3">
                    <div class="rating rateit-small"></div>
                </div>
                <div class="col-sm-8">
                    <div class="reviews">
                        <a href="#" class="lnk">(13 Reviews)</a>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.rating-reviews -->

        <div class="stock-container info-container m-t-10">
            <div class="row">
                <div class="col-sm-2">
                    <div class="stock-box">
                        <span class="label">Availability :</span>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="stock-box">
                        <span class="value"> In Stock</span>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.stock-container -->

        <div class="description-container m-t-20">
            <b>Supplier:</b>&nbsp;&nbsp;<?=$productDetails[0]['company_name']?><br/>
            <?php
            if(!empty($productDetails[0]['city']) && !empty($productDetails[0]['country'])) {
                $city = $productDetails[0]['city'];
                $where = "city_id =$city";
                $cityData = $this->Site_model->getDataById("bt_cities", $where);

                $country = $productDetails[0]['country'];
                $where = "country_id =$country";
                $countryData = $this->Site_model->getDataById("bt_countries", $where);
                ?>
                <b>Location:</b>&nbsp;&nbsp;<?=$cityData[0]['city_name']?> , <?=$countryData[0]['country_name']?><br/>
            <?php
            }
            ?>
            <b>Supplier ability:&nbsp;&nbsp;</b><?=$productDetails[0]['quantity']?><br/>
            <b>Min. Order:</b>&nbsp;&nbsp; <?=$productDetails[0]['min_order']?>
            <?php
            $unit_id        = $productDetails[0]['qty_unit'];
            $unit="";
            if($unit_id){
                $where= "unit_id =$unit_id";

                $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                $unit        = $get_units[0]['unit_name'];
            }
            ?>

        </div><!-- /.description-container -->
        <div class="price-container info-container m-t-20">
            <div class="row">
                <div class="col-sm-12">
                    <div class="price-box">
                        <span class="price">
                          <?php
                          $price=$productDetails[0]['price'];
                          $pricemax=$productDetails[0]['max_sell_price'];
                          if($price > 0 && $price < 1){
                              echo $currencySymbol.' '.number_format($productDetails[0]['price'] * $currencyRate, 2, '.', ''); ;

                          } else {
                              if ($productDetails[0]['min_sell_price'] != " " && $productDetails[0]['max_sell_price'] != " " &&
                                  $productDetails[0]['min_sell_price'] != $productDetails[0]['max_sell_price']
                              ) {
                                  ?>
                                  <?= $currencySymbol ?>. <?= number_format(number_format((float)$productDetails[0]['min_sell_price'] * $currencyRate, 2, '.', '')); ?> - <?= number_format(number_format((float)$productDetails[0]['max_sell_price'] * $currencyRate, 2, '.', ''));
                              } else {
                                  ?>
                                  <?= $currencySymbol ?>. <?= number_format(number_format((float)$productDetails[0]['price'] * $currencyRate, 2, '.', ''));

                              }
                          }
                          ?>
                            <?=$unit?>
                        </span>

                    </div>
                    <div class="price-box">

                    </div>

                </div>
            </div>
        </div>

<!--        <div class="price-container info-container m-t-20">-->
<!--            <div class="row">-->
<!--                <div class="col-sm-12">-->
<!--                    <div class="price-box">-->
<!--                        <span class="price">-->
<!--                          --><?php
//                         $price=$productDetails[0]['price'];
//                          $pricemax=$productDetails[0]['max_sell_price'];
//                          if($price > 0 && $price < 1){
//                              echo $currencySymbol.' '.number_format($productDetails[0]['price'] * $currencyRate, 2, '.', ''); ;
//
//                          } else {
//                              if ($productDetails[0]['min_sell_price'] != " " && $productDetails[0]['max_sell_price'] != " " &&
//                                  $productDetails[0]['min_sell_price'] != $productDetails[0]['max_sell_price']
//                              ) {
//                                  ?>
<!--                                  --><?//= $currencySymbol ?><!--. --><?//= number_format(number_format((float)$productDetails[0]['min_sell_price'] * $currencyRate, 2, '.', '')); ?><!-- - --><?//= number_format(number_format((float)$productDetails[0]['max_sell_price'] * $currencyRate, 2, '.', ''));
//                              } else {
//                                  ?>
<!--                                  --><?//= $currencySymbol ?><!--. --><?//= number_format(number_format((float)$productDetails[0]['price'] * $currencyRate, 2, '.', ''));
//
//                              }
//                          }
//                          ?>
<!--                            --><?//=$unit?>
<!--                        </span>-->
<!---->
<!--                    </div>-->
<!--                    <div class="price-box">-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-12">-->
<!---->
<!--                    <div class="favorite-button m-t-10">-->
<!---->
<!--                        --><?php //include(APPPATH.'/views/pages/products/action-buttons.php'); ?>
<!--                    </div>-->
<!--                    <br><br>-->
<!--                    --><?php //if((!empty($productDetails[0]['color']) && $producttype=='wholesale' ) || $productDetails[0]['wholesale']==1){
//                        $color=explode(',',$productDetails[0]['color']);
//                        $colorarray=explode(',',implode(',',$color));
//
//                        ?>
<!--                        <div class="row">-->
<!--                            <div class="col-md-3">-->
<!--                                Select Color:-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <select class="form-control" id="color" name="color">-->
<!--                                    --><?php
//                                    for($i=0;$i<=count($colorarray);$i++){
//
//                                        ?>
<!--                                        <option  value="--><?php //echo trim($color[$i]);?><!--">--><?php //echo trim($colorarray[$i]);?><!--</option>-->
<!--                                    --><?php
//                                    }
//                                    ?>
<!--                                </select>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                    --><?php //}?>
<!--                    <div class="favorite-button m-t-10">-->
<!--                        --><?php
//                        if((!empty($productDetails[0]['size']) && $producttype=='wholesale' ) || $productDetails[0]['wholesale']==1){
//                            $size=explode(',',$productDetails[0]['size']);
//                            $sizearray=explode(',',implode(', ',$size));
//                            ?>
<!--                            <div class="row">-->
<!--                                <div class="col-md-3">-->
<!--                                    Select size:-->
<!--                                </div>-->
<!--                                <div class="col-md-8">-->
<!--                                    <select class="form-control" id="size" name="size">-->
<!--                                        --><?php
//                                        for($i=0;$i<=count($sizearray);$i++){
//
//                                            ?>
<!--                                            <option  value="--><?php //echo trim($sizearray[$i]);?><!--">--><?php //echo trim($sizearray[$i]);?><!--</option>-->
<!--                                        --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div><!-- /.row -->
<!--        </div><!-- /.price-container -->

        <div class="quantity-container info-container">
            <div class="row">
<!--                --><?php //if($producttype=='wholesale' || $productDetails[0]['wholesale']==1) {?>
<!--                <div class="col-sm-2 text-right">-->
<!--                    <span class="label">Qty :</span>-->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-2">-->
                    <input type="hidden"  class="form-control" style="width: 100px;"  id="itemp_qty" min="<?=$productDetails[0]['min_order']?>" value="<?=$productDetails[0]['min_order']?>"
                           max="1000000"    value="<?=$productDetails[0]['min_order']; ?>">
<!--                </div>-->
<!--                <br><br><br><br>-->
<!--                --><?php //} ?>
                <div class="col-sm-12">
                    <?php if($producttype=='wholesale'||$productDetails[0]['wholesale']==1) {?>
                        <a href="#" onclick="return makeOrder('<?=$productId;?>')" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> Start Ordering</a>
                    <?php } ?>
                    <a href="#" onclick="return contactSupplier('<?=$productId;?>')" class="btn"><i class="fa fa-envelope inner-right-vs"></i> Contact Supplier</a>

                </div>
                <br><br>
                <div class="product-share" style="float: left;margin-top: 15px">
                    <?php
                    $actual_link ="https://www.blazebay.com/".$_SERVER['REQUEST_URI'];
                    ?>
                    <a href="https://facebook.com/sharer.php?u=<?=$actual_link?>"  target="_blank" class="fb"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?=$actual_link?>" target="_blank" class="tw"><i class="fa fa-twitter"></i></a>
                    <a href="https://plus.google.com/share?url=<?=$actual_link?>" target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a>
                    <a href="http://pinterest.com/pin/create/button/?url="<?=$actual_link?> target="_blank" class="pint"><i class="fa fa-pinterest"></i></a>
                </div>
            </div><!-- /.row -->
        </div>
        <!-- /.quantity-container -->






    </div><!-- /.product-info -->
</div><!-- /.col-sm-7 -->
</div><!-- /.row -->
</div>

<div class="product-tabs inner-bottom-xs  wow fadeInUp">
<div class="row">
<div class="col-sm-4">
    <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
        <li class="active"><a data-toggle="tab" href="#description">Product Details</a></li>
        <li><a data-toggle="tab" href="#review">Product Reviews</a></li>
        <li><a data-toggle="tab" href="#tags">Company Profile</a></li>
    </ul><!-- /.nav-tabs #product-tabs -->
</div>
<div class="col-sm-8">

    <div class="tab-content">

        <div id="description" class="tab-pane in active">
            <div class="product-tab">
                <p class="text"><?=html_entity_decode($productDetails[0]['description'])?></p>
            </div>
        </div><!-- /.tab-pane -->

        <div id="review" class="tab-pane">
            <div class="product-tab">



                <h4 class="title">Write your own review</h4>
                <div class="review-table">
                    <?php
                    if($rating_stats[0]['total']){
                        ?>
                        <div class="col-md-12 rating-part-left text-center">
                            <h1><?= number_format($rating_stats[0]['avg'],1) ?></h1>
                            <?php
                            $product_rating = $rating_stats[0]['avg'];
                            for($i=1; $i<=5; $i++){
                                if($i > $product_rating){
                                    ?>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php
                                }
                                else{
                                    ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                <?php
                                }
                            }
                            ?>
                            <p>Average Rating</p>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $total = $rating_stats[0]['total'];
                            $stars = $rating_stats[0]['five_star'];
                            $percentage = (($stars/$total)*100).'%';
                            ?>
                            <div class="progress-bar-section">
                                <p><?= $stars ?></p>
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?= $percentage ?>;"></div>
                                </div>
                                <i class="fa fa-star" aria-hidden="true"></i><br>
                                <span>5</span>
                            </div>
                            <?php
                            $stars = $rating_stats[0]['four_star'];
                            $percentage = (($stars/$total)*100).'%';
                            ?>
                            <div class="progress-bar-section">
                                <p><?= $stars ?></p>
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?= $percentage ?>;"></div>
                                </div>
                                <i class="fa fa-star" aria-hidden="true"></i><br>
                                <span>4</span>
                            </div>
                            <?php
                            $stars = $rating_stats[0]['three_star'];
                            $percentage = (($stars/$total)*100).'%';
                            ?>
                            <div class="progress-bar-section">
                                <p><?= $stars ?></p>
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?= $percentage ?>;"></div>
                                </div>
                                <i class="fa fa-star" aria-hidden="true"></i><br>
                                <span>3</span>
                            </div>
                            <?php
                            $stars =  $rating_stats[0]['two_star'];
                            $percentage = (($stars/$total)*100).'%';
                            ?>
                            <div class="progress-bar-section">
                                <p><?= $stars ?></p>
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?= $percentage ?>;"></div>
                                </div>
                                <i class="fa fa-star" aria-hidden="true"></i><br>
                                <span>2</span>
                            </div>
                            <?php
                            $stars = $rating_stats[0]['one_star'];
                            $percentage = (($stars/$total)*100).'%';
                            ?>
                            <div class="progress-bar-section">
                                <p><?= $stars ?></p>
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?= $percentage ?>;"></div>
                                </div>
                                <i class="fa fa-star" aria-hidden="true"></i><br>
                                <span>1</span>
                            </div>

                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-12">
                        <h4>Rate product</h4>

                    </div>
                </div><!-- /.review-table -->

                <div class="product-add-review">

                    <div class="review-form">
                        <div class="form-container">
                            <form id="review-form">
                                <div class="form-group">
                                    <label for="email">Rate:</label>
														<span class="starRating">
															<input id="rating5" name="review_rating" value="5" type="radio">
															<label for="rating5">5</label>
															<input id="rating4" name="review_rating" value="4" type="radio">
															<label for="rating4">4</label>
															<input id="rating3" name="review_rating" value="3" type="radio">
															<label for="rating3">3</label>
															<input id="rating2" name="review_rating" value="2" type="radio">
															<label for="rating2">2</label>
															<input id="rating1" name="review_rating" value="1" type="radio">
															<label for="rating1">1</label>
														</span>
                                </div>
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" name="review_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Message:</label>
                                    <textarea name="review_opinion" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="product_id" value="--><?=$productId; ?><!--">
                                <input type="hidden" id="user-id" name="user_id" value="--><?=isset($this->session->userdata['logged_in']['user_id'])?$this->session->userdata['logged_in']['user_id']:0; ?><!--">
                                <button type="button" id="submit-review" class="btn btn-primary">Submit</button>
                            </form>
                        </div><!-- /.form-container -->
                    </div><!-- /.review-form -->

                </div><!-- /.product-add-review -->
                <!--                        <div class="product-reviews">-->
                <!--                            <h4 class="title">Customer Reviews</h4>-->
                <!---->
                <!--                            <div class="reviews">-->
                <!--                                <div class="review">-->
                <!--                                    <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>-->
                <!--                                    <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>-->
                <!--                                </div>-->
                <!---->
                <!--                            </div><!-- /.reviews -->
                <!--                        </div><!-- /.product-reviews -->

            </div><!-- /.product-tab -->
        </div><!-- /.tab-pane -->

        <div id="tags" class="tab-pane" style="background-color: aliceblue !important">
            <div class="product-tag">
                <table class="product-details">
                    <?php
                    $business_details=$productDetails[0];
                    if(!empty($business_details['company_name']) ){ ?>
                        <tr>
                            <td><b>Company</b>&nbsp;&nbsp;</td>
                            <td >
                                <?php
                                if(!empty($business_details['company_name']) ){echo ucwords($business_details['company_name']);}
                                else{ echo "N/A"; }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['services']) ){ ?>
                        <tr>
                            <td><b>Services</b></td>
                            <td><?php
                                if(!empty($business_details['services']) ){echo ucwords($business_details['services']);}
                                else{ echo "N/A"; }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['website']) ){ ?>
                        <tr>
                            <td><b>Website</b></td>
                            <td>
                                <?php
                                if(!empty($business_details['website']) ){echo ucwords($business_details['website']);}
                                else{ echo "N/A"; }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php if(!empty($business_details['address1']) ){ ?>
                        <tr>
                            <td><b>Address</b></td>
                            <td><?php
                                if(!empty($business_details['address1']) ){echo $business_details['address1'];}
                                else{ echo "N/A"; }
                                ?></td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['location']) ){ ?>
                        <tr>
                            <td><b>Location </b></td>
                            <td><?php
                                if(!empty($business_details['location']) ){echo ucwords($business_details['location']);}
                                else{ echo "N/A"; }
                                ?></td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['year_established']) ){ ?>
                        <tr>
                            <td><b>Year Of Establishment:</b>  </td>
                            <td><?php
                                if(!empty($business_details['year_established']) ){echo ucwords($business_details['year_established']);}
                                else{ echo "N/A"; }
                                ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <hr class="style9">
                    <?php if(!empty($business_details['about']) ){ ?>
                        <div   style="background-color: aliceblue !important">
                            <b>Overview</b>
                            <p>
                                <?php
                                if(!empty($business_details['about']) ){echo strip_tags(html_entity_decode($business_details['about']));}
                                else{ echo $business_details['product_company_name']; }
                                ?>
                            </p>

                        </div>
                    <?php } ?>
                    <div   style="background-color: aliceblue !important">
                        <a href="<?='https://'.$business_details['minisite_prefix'].'.blazebay.com'?>" target="_blank"  class="btn btn-primary">View Company Minisite</a>
                    <br><br></div>



            </div><!-- /.product-tab -->
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.product-tabs -->

<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Related products</h3>

    <?php  include(APPPATH.'/views/pages/products/upsell-products.php'); ?>
</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

</div><!-- /.col -->
<div class="clearfix"></div>
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
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->

</div><!-- /#top-banner-and-menu -->


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
<script type="text/javascript">
    var base_url='<?=base_url()?>';
    function checkStatus() {
        $.ajax({
            url:base_url+"getStatus",
            type:"POST",
            data:{"uid": <?=$productDetails[0]['uid']?>},
            success:function(data){
                $("#checkIfOnline").html(data);
                if(data!="Offline") {
                    $("#openchatBox").attr("data-email","no");
                    $("#receiver").val(<?php echo $productDetails[0]['uid']; ?>);
                }
                if(data=="Offline") {
                    $("#openchatBox").attr("data-email","yes");
                    $("#receiver").val(<?php echo $productDetails[0]['uid']; ?>);
                }
                setTimeout(function(){ return checkStatus(); },2000);
            }
        });
    }

    function checkMsg() {
        $.ajax({
            url:base_url+"getMessage",
            type:"POST",
            data:{"supplier":<?php echo $productDetails[0]['uid']; ?>},
            success:function(data){
                $("#wall").html(data);
                var wl    = $('#wall');
                var height = wl[0].scrollHeight;
                wl.scrollTop(height);
                setTimeout(function(){ return checkMsg(); },2000);
            }
        });
    }
    $(document).ready(function () { return checkStatus() });
    $(document).ready(function () { return checkMsg() });

    $("#openchatBox").click(function(){
        if($("#blazeChatBox").hasClass("hide")) {
            $("#blazeChatBox").removeClass("hide");
        }else{
            $("#blazeChatBox").addClass("hide");
        }
    });

    function sendMsg() {
        $.ajax({
            url:base_url+"getMessage",
            type:"POST",
            data:{
                "session":$("#session").val(),
                "sender":$("#sender").val(),
                "receiver":$("#receiver").val(),
                "enquiryFor": "<?php echo $productDetails[0]['title']; ?>",
                "content":$("#msg").val(),
                "supplier":<?php echo $productDetails[0]['uid']; ?>
            },
            success:function(data) {
                $("#msg").val("");
            }
        });
    }

    $("#msg").keypress(function(e){
        if(e.keyCode===13){
            $.ajax({
                url:base_url+"getMessage",
                type:"POST",
                data:{
                    "session":$("#session").val(),
                    "sender":$("#sender").val(),
                    "receiver":$("#receiver").val(),
                    "content":$("#msg").val(),
                    "supplier":<?php echo $productDetails[0]['uid']; ?>
                },
                success:function(data) {
                    $("#msg").val("");
                }
            });
        }
    });
</script>
<script>
    // Can also be used with $(document).ready()
    $(document).ready(function () {

        $('#submit-review').click(function(){
            var isLoggedIn ='<?=$this->session->userdata['logged_in']['user_id'];?>';

            if(!isLoggedIn){
                swal({
                        title: "Log in first!",
                        text: "You need to login to continue.",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Log In",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $('#loginp').modal('show');
                        }
                    }
                );

            }
            else{
                var rating = $('input[name=review_rating]:checked').val();
                if(!rating){
                    alert('Please select the rating to cotinue');
                    return;
                }
                var data = $('#review-form').serialize();
                var base_url = "<?= base_url(); ?>";
                var userId = $("#user-id").val();

                jQuery.ajax({
                    url: base_url+"ajax/submit_review",
                    data:data+'&user_id='+userId,
                    type: "POST",
                    success:function(response){
                        if(response === '1'){
                            $('#review-msg').html('<div class="alert alert-success"><strong>Success!</strong> Your review has been submitted.</div>');
                        }
                        else{
                            $('#review-msg').html('<div class="alert alert-warning"><strong>Sorry!</strong> Your review could not been submitted.</div>');
                        }
                        console.log(response);
                    },
                    error:function (request, status, error){
                        console.log(request.responseText);
                    }
                });
            }
        });

        $(".go_to_reviews").click(function(){
            $('.nav-tabs a[href="#reviews"]').tab('show');

        });



    });
</script>
<!-- //FlexSlider-->



</body>
</html>