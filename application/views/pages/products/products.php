<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.0/vegas.css" />
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
    <div class="mobile-hide">
<div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <?php include(APPPATH.'/views/pages/categories.php'); ?>
    </div>
</div><!-- /.side-menu -->

<!-- ================================== TOP NAVIGATION : END ================================== -->	            <div class="sidebar-module-container">


        <?php if(isset($selloffers)){ ?>
            <?php //include(APPPATH.'/views/pages/products/shopby.php'); ?>
        <?php } else {?>
    <div class="mobile-hide">
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
            <h3 class="section-title">Special Deals</h3>
            <?php  include(APPPATH.'/views/pages/home/hot-deals.php'); ?>
        </div><!-- /.sidebar-widget -->
    </div>
        <?php } ?>
    <div class="mobile-hide">
        <div class="sidebar-widget product-tag wow fadeInUp">
            <h3 class="section-title">Product tags</h3>
            <?php include(APPPATH.'/views/pages/home/product-tags.php'); ?>
        </div>
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
            <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Ofa maalum';} else {?>Special Offer<?php }?></h3>
            <?php include('pages/home/special-offers.php'); ?>
        </div><!-- /.sidebar-widget -->
        <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
            <h3 class="section-title"><?php if($languange=='Swahili'){ echo 'Mikataba ya kwanza';} else {?>Premium deals<?php }?></h3>
            <?php include(APPPATH.'/views/pages/products/Premium.php'); ?>
        </div>
    </div>

</div><!-- /.sidebar-module-container -->
</div><!-- /.sidebar -->
<div class='col-md-9'>
<!-- /.sidebar-widget -->
<!-- ========================================== SECTION – HERO ========================================= -->
<?php if(isset($selloffers) ||isset($saleproductsearchprice)|| isset($saleproductsearch) || isset($wholesell) || isset($wholesellsearch) || isset($wholesellsearchprice) ){ ?>
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
        function word_teaser($string, $count){
            $original_string = $string;
            $words = explode(' ', $original_string);

            if (count($words) > $count){
                $words = array_slice($words, 0, $count);
                $string = implode(' ', $words);
            }

            return $string;
        }
        $appendLink="";
if(isset($search)) {

    $qqq= "
      SELECT * ,p.id as pid
      FROM bt_products p
      JOIN bt_product_cats pc ON pc.offer_id = p.id
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE  m.suspended='N'  AND  p.approved = 'yes'  AND p.price <>0  AND p.price <>''  ";



    if ($search!='PAGE'){
        $qqq.= " AND p.title LIKE '%" . $search . "%' ";
         $qqq.= " ORDER BY p.id DESC  ";
        $name = 'Search Results for <span style="color: #df6d0d"> ' . $search . '</span>';
        $append = 'all/products/';
        $appendLink=$append;
    }else{
        $append = 'all/products/';
        $qqq.= "ORDER BY p.id DESC  ";
        $appendLink=$append;
    }


}
        else if(isset($industries)) {
    $append = 'all-products/';
    $appendLink=$append;
    $category_id    = $getcid;
    $category_name  = urldecode($getcategory);
    $append = $category_name."/".$category_id."/";


//    $where="group_id= '$category_id'";
//    $category_details= $this->Site_model->getDataById( $table = "bt_categories",$where);
//
//
//if(!empty($category_details)) {
//    $qqq = "
//      SELECT * ,p.id as pid
//      FROM bt_products p
//      RIGHT JOIN bt_product_cats pc ON pc.offer_id = p.id
//      RIGHT JOIN bt_members m ON m.user_id = p.uid
//      WHERE   m.suspended='N' AND  pc.cid IN(SELECT id FROM bt_categories WHERE group_id=".$category_id.") AND  p.approved = 'yes'
//      ORDER BY p.id DESC ";
//}else{
    $qqq = "
      SELECT * ,p.id as pid
      FROM bt_products p
      RIGHT JOIN bt_product_cats pc ON pc.offer_id = p.id
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE   m.suspended='N' AND  pc.cid IN(".$category_id.") AND  p.approved = 'yes' AND p.image <> '' AND p.price <>0  AND p.price <>''
      ORDER BY p.id DESC ";
//}
            $append = 'industry/'.$getcategory.'/'.$category_id.'/';
            $appendLink=$append;
      $name =$getcategory;
        }
else if(isset($selloffers)){

    $qqq ="SELECT p.*,p.id AS pid,p.price as product_price,o.title as offer_title,o.postedon as offer_postedon,o.expireson
as offer_expireson,o.offer_price
				FROM  bt_products as p
				JOIN  bt_offers as o ON p.id=o.prod_id
				JOIN bt_members AS m ON m.user_id =  p.uid

				WHERE  o.approved='yes' AND  m.suspended='N' AND p.price <>0  AND p.price <>'' AND  o.expireson > NOW()  ORDER BY id DESC";
    $append = "sale-offers/";
    $appendLink=$append;
}
else if(isset($buyoffers)){

    $qqq ="SELECT
	buy.*,m.*,buy.id as pid
FROM
	bt_offers_buy AS buy
JOIN bt_members AS m ON m.user_id =  buy.uid
WHERE
	buy.approved='yes' AND m.suspended='N'
AND buy.expireson > NOW()
ORDER BY
	id DESC";
    $append = "buy-offers/";
    $appendLink=$append;

}


else if(isset($company_name)){

            $qqq ="SELECT * ,p.id as pid
      FROM bt_products p
      JOIN bt_product_cats pc ON pc.offer_id = p.id
      JOIN bt_members m ON m.user_id = p.uid
      WHERE p.approved = 'yes' AND m.suspended='N'  AND p.price <>0  AND p.price <>'' AND m.user_id=".$company_id;
            $append ="supplier/".RemoveBadURLCharaters($name)."/".$company_id."/";
    $appendLink=$append;
        }
else if(isset($wholesell)){
$append = "wholesell/";
    $appendLink=$append;

$qqq = "SELECT
	*,
	p.id AS pid
FROM
	bt_products p
RIGHT JOIN bt_members m ON m.user_id = p.uid
WHERE
	m.suspended = 'N'
AND wholesale =1
AND p.approved = 'yes' AND p.price <>0  AND p.price <>''
ORDER BY
	p.id DESC ";

    $name='Wholesale Products';

        }
else if(isset($wholesellsearch)){
    $append = "wholesell-search/".$wholesalesearch."/";
    $appendLink=$append;

    $qqq = "SELECT
	*,
	p.id AS pid
FROM
	bt_products p
RIGHT JOIN bt_members m ON m.user_id = p.uid
WHERE
	m.suspended = 'N'
AND wholesale =1
AND p.approved = 'yes' AND p.price <>0  AND p.price <>'' AND p.title LIKE '%" . $wholesalesearch . "%'
ORDER BY
	p.id DESC ";

    $name='Search Results for <span style="color: #df6d0d"> ' . $wholesalesearch . '</span>';

}

else if(isset($wholesellsearchprice)){

        if($price=='lessthan'){
            $append = "wholesell/price-less-than/".$wholesalesearch."/";
            $name='Search results for <span style="color: #df6d0d">  price less than ' .' '. $wholesalesearch . '</span>';
        }else if ($price=='greaterthan'){
            $append = "wholesell/price-greater-than/".$wholesalesearch."/";
            $name='Search results for <span style="color: #df6d0d">  price greater than' .' '. $wholesalesearch . '</span>';
        }else{
            $append = "wholesell/";
            $name='Search results for <span style="color: #df6d0d"> ' . $wholesalesearch . '</span>';
        }

    $appendLink=$append;

    $qqq.= "SELECT
	*,
	p.id AS pid
FROM
	bt_products p
RIGHT JOIN bt_members m ON m.user_id = p.uid
WHERE
	m.suspended = 'N'
AND wholesale =1
AND p.approved = 'yes' AND p.price <>0  AND p.price <>'' AND  ";

    if($price=='lessthan'){



        if($this->session->userdata['currencyConvertion']['convertSymbol']=='USD') {

            $convertedamount = $wholesalesearch;

        }
        else if($this->session->userdata['currencyConvertion']['convertSymbol']=='NRCT') {
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = ($wholesalesearch * 10 )/ $exc_rate;


                    }
                }
            }
        }

        else{
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = $wholesalesearch / $exc_rate;


                    }
                }
            }
        }

        $qqq.="p.price < " . $convertedamount . "";
    } else{
        if($this->session->userdata['currencyConvertion']['convertSymbol']=='USD') {

            $convertedamount = $wholesalesearch;

        }
        else if($this->session->userdata['currencyConvertion']['convertSymbol']=='NRCT') {
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = ($wholesalesearch * 10 )/ $exc_rate;


                    }
                }
            }
        }

        else{
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = $wholesalesearch / $exc_rate;


                    }
                }
            }
        }
        $qqq.="p.price > " . $convertedamount . "";
    }
 $qqq.=" ORDER BY 	p.id DESC ";



}

else if(isset($productsearch)){
    $append = "all-products/".$wholesalesearch."/";
    $appendLink=$append;

    $qqq = "SELECT
	*,
	p.id AS pid
FROM
	bt_products p
RIGHT JOIN bt_members m ON m.user_id = p.uid
WHERE
	m.suspended = 'N'
AND wholesale =1
AND p.approved = 'yes' AND p.price <>0  AND p.price <>'' AND p.title LIKE '%" . $wholesalesearch . "%'
ORDER BY
	p.id DESC ";

    $name='Search Results for <span style="color: #df6d0d"> ' . $wholesalesearch . '</span>';

}

else if(isset($productsearchprice)){

    if($price=='lessthan'){
        $append = "all-products/price-less-than/".$wholesalesearch."/";
        $name='Search results for <span style="color: #df6d0d">  price less than ' .' '. $wholesalesearch . '</span>';
    }else if ($price=='greaterthan'){
        $append = "all-products/price-greater-than/".$wholesalesearch."/";
        $name='Search results for <span style="color: #df6d0d">  price greater than' .' '. $wholesalesearch . '</span>';
    }else{
        $append = "all-products/";
        $name='Search results for <span style="color: #df6d0d"> ' . $wholesalesearch . '</span>';
    }

    $appendLink=$append;

    $qqq.= "SELECT
	*,
	p.id AS pid
FROM
	bt_products p
RIGHT JOIN bt_members m ON m.user_id = p.uid
WHERE
	m.suspended = 'N'
AND wholesale =1
AND p.approved = 'yes' AND p.price <>0  AND p.price <>'' AND  ";

    if($price=='lessthan'){



        if($this->session->userdata['currencyConvertion']['convertSymbol']=='USD') {

            $convertedamount = $wholesalesearch;

        }
        else if($this->session->userdata['currencyConvertion']['convertSymbol']=='NRCT') {
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = ($wholesalesearch * 10 )/ $exc_rate;


                    }
                }
            }
        }

        else{
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = $wholesalesearch / $exc_rate;


                    }
                }
            }
        }

        $qqq.="p.price < " . $convertedamount . "";
    } else{
        if($this->session->userdata['currencyConvertion']['convertSymbol']=='USD') {

            $convertedamount = $wholesalesearch;

        }
        else if($this->session->userdata['currencyConvertion']['convertSymbol']=='NRCT') {
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = ($wholesalesearch * 10 )/ $exc_rate;


                    }
                }
            }
        }

        else{
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = $wholesalesearch / $exc_rate;


                    }
                }
            }
        }
        $qqq.="p.price > " . $convertedamount . "";
    }
    $qqq.=" ORDER BY 	p.id DESC ";



}

else if(isset($saleproductsearch)){
    $append = "sale-offers/".$wholesalesearch."/";
    $appendLink=$append;

    $qqq = "
	 SELECT p.*,p.id AS pid,p.price as product_price,o.title as offer_title,o.postedon as offer_postedon,o.expireson
as offer_expireson,o.offer_price
				FROM  bt_products as p
				JOIN  bt_offers as o ON p.id=o.prod_id

				WHERE  o.approved='yes' AND p.price <>0  AND p.price <>'' AND  o.expireson > NOW()  AND p.title LIKE '%" . $wholesalesearch . "%' ORDER BY id DESC";

    $name='Search Results for <span style="color: #df6d0d"> ' . $wholesalesearch . '</span>';

}

else if(isset($saleproductsearchprice)){

    if($price=='lessthan'){
        $append = "sale-offers/price-less-than/".$wholesalesearch."/";
        $name='Search results for <span style="color: #df6d0d">  price less than ' .' '. $wholesalesearch . '</span>';
    }else if ($price=='greaterthan'){
        $append = "sale-offers/price-greater-than/".$wholesalesearch."/";
        $name='Search results for <span style="color: #df6d0d">  price greater than' .' '. $wholesalesearch . '</span>';
    }else{
        $append = "sale-offers/";
        $name='Search results for <span style="color: #df6d0d"> ' . $wholesalesearch . '</span>';
    }

    $appendLink=$append;

    $qqq.= "
	 SELECT p.*,p.id AS pid,p.price as product_price,o.title as offer_title,o.postedon as offer_postedon,o.expireson
as offer_expireson,o.offer_price
				FROM  bt_products as p
				JOIN  bt_offers as o ON p.id=o.prod_id

				WHERE  o.approved='yes' AND p.price <>0  AND p.price <>'' AND  o.expireson > NOW()  AND ";

    if($price=='lessthan'){



        if($this->session->userdata['currencyConvertion']['convertSymbol']=='USD') {

            $convertedamount = $wholesalesearch;

        }
        else if($this->session->userdata['currencyConvertion']['convertSymbol']=='NRCT') {
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = ($wholesalesearch * 10 )/ $exc_rate;


                    }
                }
            }
        }

        else{
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = $wholesalesearch / $exc_rate;


                    }
                }
            }
        }

        $qqq.="p.price < " . $convertedamount . "";
    } else{
        if($this->session->userdata['currencyConvertion']['convertSymbol']=='USD') {

            $convertedamount = $wholesalesearch;

        }
        else if($this->session->userdata['currencyConvertion']['convertSymbol']=='NRCT') {
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = ($wholesalesearch * 10 )/ $exc_rate;


                    }
                }
            }
        }

        else{
            if ($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')) {
                if ($arr = json_decode($resp)) {
                    if ($exc_rate = $arr->value) {
                        $convertedamount = $wholesalesearch / $exc_rate;


                    }
                }
            }
        }
        $qqq.="p.price > " . $convertedamount . "";
    }
    $qqq.=" ORDER BY 	p.id DESC ";



}

else if(isset($getcid)){
    $category_id    = $getcid;

    $category_name  = urldecode($getcategory);
    $append = $category_name."/".$category_id."/";
    $appendLink=$append;

    $qqq = "
      SELECT * ,p.id as pid
      FROM bt_products p
      JOIN bt_product_cats pc ON pc.offer_id = p.id
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE   m.suspended='N' AND  pc.cid =".$category_id." AND  p.approved = 'yes' AND p.price <>0  AND p.price <>''
      ORDER BY p.id DESC ";

$name='Products IN '.$categoryName;
}
        else{
    $append = 'all/products/';
            $appendLink=$append;
    $qqq = "
      SELECT * ,p.id as pid
      FROM bt_products p
      JOIN bt_product_cats pc ON pc.offer_id = p.id
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE  m.suspended='N'  AND  p.approved = 'yes' AND p.price <>0  AND p.price <>''
      ORDER BY p.id DESC  ";
            $name='';
     }

        $url=explode("/",$appendLink);

        $firstitem=$url[0];




        require_once APPPATH.'libraries/ps_pagination.php';
        require_once APPPATH.'views/pages/aoth/external-conn.php';
        $pager = new PS_Pagination($dbh , $qqq, 12, 3, $append, base_url(),$Getpage);
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
<div class="row">

    <div class="col-md-6 text-left">
      <?=$name?> <?php if($name=="Wholesale")?>
</div>
        <div class=" col-md-6 text-right">
            <div class="lbl-cnt">
                <div class="input-group">
                    <div class="input-group-btn search-panel2">
                        <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept2">Filter by</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#contains">Contains</a></li>
                            <li><a href="#greather_than"> Price in <?=$this->session->userdata['currencyConvertion']['convertSymbol']?$this->session->userdata['currencyConvertion']['convertSymbol']:'KES'?> greater than ></a></li>
                            <li><a href="#less_than">Price in <?=$this->session->userdata['currencyConvertion']['convertSymbol']?$this->session->userdata['currencyConvertion']['convertSymbol']:'KES'?> less than < </a></li>
                            <li class="divider"></li>
                            <li><a href="#all">All products</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="search_param2" value="all" id="search_param2">
                    <input type="hidden" name="url-link"  id="url-link" value="<?=$appendLink?>">
                    <input type="text" class="form-control" id="all-products-search_param" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-primary"  onclick="return search2()" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
                </div>
            </div><!-- /.lbl-cnt -->

        </div>


</div>
        <div class="clearfix filters-container m-t-10">
            <div class="row">


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

                foreach ($details as $product) {
                    if(isset($buyoffers)){

                        $path="assets/uploadedimages/buyoffer/".$product['buyoffer_image'];
                    }else{
                        $path="assets/uploadedimages/".$product['image'];
                    }

                    if(file_exists($path))
                    {
                        $productLink = "product-details/" . RemoveBadURLCharaters($product['title']) . "/" . $product['pid'] . "/" . $product['uid'];
                        //$imageLink="assets/uploadedimages/".$product['image'];
                        $imageLink =base_url().$path;
                        $unit_id = $product['qty_unit'];
                        if($unit_id){
                            $where= "unit_id =$unit_id";

                            $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                            $unit = $get_units[0]['unit_name'];
                        }
                        ?>

        <div class="col-xs-6  col-sm-4 col-md-4 wow fadeInUp">
            <div class="products">


                <div class="product">
                    <div class="image">
                        <a href="<?=base_url() . $productLink ?>"><img class="newproductImages"
                                                                        src="<?=$imageLink ?>"
                                                                        alt="<?= ucfirst($product['title']) ?>"
                                ></a>
                    </div>

                    <div class="product-info">
                        <h3 class="name"><a href="<?=base_url() . $productLink ?>"><?=word_teaser(ucfirst(strtolower($product['title'])),4)?></a>
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>

                        <div class="product-price">
				<span class="price">
                                    <?php
                                    if($product['min_sell_price']!=0 && $product['min_sell_price']!=" " && $product['max_sell_price']!=" " && $product['min_sell_price']!=$product['max_sell_price']) {
                                        ?>
                                        <?=$currencySymbol?>. <?= number_format(number_format((float)$product['min_sell_price'] * $currencyRate, 2, '.', '')); ?> - <?= number_format(number_format((float)$product['max_sell_price'] * $currencyRate, 2, '.', ''));
                                    }else{ ?>
                                        <?=$currencySymbol?>. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));

                                    }
                                    ?>

                                </span>

<span
    class="price-before-discount"></span>
                            <span class="unit-measure"><?=$unit?></span>
                        </div><!-- /.product-price -->

                    </div><!-- /.product-info -->
                    <div class="cart clearfix animate-effect"  style="left: 30% !important;">
                        <div class="action">
                            <ul class="list-unstyled" >
                                <?php if(isset($wholesell)|| isset($wholesellsearch) || (isset($product['wholesale']) && $product['wholesale']==1)){ ?>
                                    <li class="lnk wishlist">
                                        <a data-toggle="tooltip" class="add-to-cart bt-warning" href="#" onclick="return buy(<?=$product['pid']?>,<?=$product['min_order']?>)" title="Start Ordering">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="lnk wishlist">
                                    <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return contactSupplier(<?=$product['pid']?>)" title="Contact Supplier">
                                        <i class="icon fa fa-envelope"></i>
                                    </a>
                                </li>


                                <li class="lnk">
                                    <a class="add-to-cart" href="#"  onclick="return compareProducts(<?=$product['pid']?>,<?=$product['uid']?>)" title="Add to Compare">
                                        <i class="fa fa-signal"></i>
                                    </a>
                                </li>

                                <li class="lnk wishlist">
                                    <a class="add-to-cart"  onclick="return wishlist(<?=$product['id']?>,<?=$product['pid']?>)"  href="#" title="Add to Favourite">
                                        <i class="icon fa fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.action -->
                    </div><!-- /.cart -->
                </div><!-- /.product -->

            </div><!-- /.products -->
        </div><!-- /.item -->

            <?php
            }
            }
            } else {

                if(!empty($header_search_string)) { ?>
                    No Results Found similar to <b> <?=$header_search_string; ?>  </b>
                <?php
                } ?>

                <?php if(!empty($category_name)) { ?>
                    No Results Found in category <b><?= $category_name; ?></b>
                <?php }
                if(!empty($company_name)) { ?>
                    No Results Found for <b><?= $company_name; ?></b>
                <?php }   if(!empty($search)) { ?>
                    No Results Found for <b><?= $search; ?></b>
                <?php }?>
                <?php    if(!empty($wholesellsearch)) { ?>
                No Results Found for <b><?=$wholesalesearch; ?></b>
            <?php }

            }?>
        </div><!-- /.row -->
        </div><!-- /.category-product -->

        </div><!-- /.tab-pane -->

        <div class="tab-pane "  id="list-container">
        <div class="category-product">
            <?php
            if(!empty($details)){
            foreach($details as $product){
            if(isset($buyoffers)){

                $path="assets/uploadedimages/buyoffer/".$product['buyoffer_image'];
            }else{
                $path="assets/uploadedimages/".$product['image'];
            }

            if(file_exists($path))
            {
            $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['pid']."/".$product['uid'];
            //$imageLink="assets/uploadedimages/".$product['image'];
            $imageLink=base_url().$path;
            $unit_id = $product['qty_unit'];
            if($unit_id){
                $where= "unit_id =$unit_id";

                $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                $unit = $get_units[0]['unit_name'];
            }
            ?>

        <div class="category-product-inner wow fadeInUp">
            <div class="products">
                <div class="product-list product">
                    <div class="row product-list-row">
                        <div class="col col-sm-4 col-lg-4">
                            <div class="product-image">
                                <div class="image">
                                    <a href="<?=base_url().$productLink ?>"><img class="newproductImages" src="<?=$imageLink?>"  alt="<?=$product['title']?>" alt="<?=$product['title']?>">
                                    </a>
                                </div>
                            </div><!-- /.product-image -->
                        </div><!-- /.col -->
                        <div class="col col-sm-8 col-lg-8">
                            <div class="product-info">
                                <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=ucfirst(strtolower($product['title']))?></a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="product-price">
					<span class="price">
					<?=$currencySymbol?>.<?=number_format(number_format((float)$product['price']* $currencyRate, 2, '.', ''));?></span>
                                    <span class="unit-measure"><?=$unit?></span>

                                </div><!-- /.product-price -->
                                <div class="description m-t-10"><?=$product['description']?></div>
                                <div class="cart clearfix animate-effect">
                                    <div class="action" style="float:left;">
                                        <ul class="list-unstyled">
                                            <?php if(isset($wholesell)|| isset($wholesellsearch) || (isset($product['wholesale']) && $product['wholesale']==1)){?>
                                                <li class="lnk wishlist">
                                                    <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return buy(<?=$product['pid']?>,<?=$product['min_order']?>)" title="Start Ordering">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <li class="lnk wishlist">
                                                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return contactSupplier(<?=$product['pid']?>)" title="Contact Supplier">
                                                    <i class="icon fa fa-envelope"></i>
                                                </a>
                                            </li>
                                            <li class="lnk">
                                                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return compareProducts(<?=$product['pid']?>,<?=$product['uid']?>)" title="Add to Compare">
                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="lnk wishlist">
                                                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return wishlist(<?=$product['pid']?>,<?=$product['uid']?>)" title="Add to Favourite">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div><!-- /.action -->
                                </div><!-- /.cart -->

                            </div><!-- /.product-info -->
                        </div><!-- /.col -->
                    </div><!-- /.product-list-row -->
                          </div><!-- /.product-list -->
            </div><!-- /.products -->
        </div><!-- /.category-product-inner -->

            <?php }
            }
            } else {

                if(!empty($header_search_string)) { ?>
                    No Results Found similar to <b> <?=$header_search_string; ?>  </b>
                <?php
                } ?>

                <?php if(!empty($category_name)) { ?>
                    No Results Found in category <b><?= $category_name; ?></b>
                <?php }
                if(!empty($company_name)) { ?>
                    No Results Found for <b><?= $company_name; ?></b>
                <?php } if(!empty($search)) { ?>
                    No Results Found for <b><?= $search; ?></b>
                <?php }
            }?>

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


<script src="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.0/vegas.min.js"></script>

<script>
    $("#wholesale-slider").vegas({
        slides: [
            { src: "<?=base_url()?>assets/images/Wholesale Banner1.jpg" },
            { src: "<?=base_url()?>assets/images/Wholesale Banner.jpg" },

        ],
        transition: 'fade',
        delay:15000,
        animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
    });

    $("#offer-slider").vegas({
        slides: [
            { src: "<?=base_url()?>assets/images/Sale offer1.jpg" },
            { src: "<?=base_url()?>assets/images/Sale Offer.jpg" }

        ],
        transition: 'fade',
        delay:15000,
        animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
    });

</script>


</body>
</html>