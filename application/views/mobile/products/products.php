<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>
</head>

<body>

<div id="main">

    <!-- LEFT SIDEBAR -->
    <div id="slide-out-left" class="side-nav">

        <!-- Form Search -->
        <div class="top-left-nav">
            <?php include(APPPATH.'/views/mobile/layout/search.php'); ?>
        </div>
        <!-- End Form Search -->

        <!-- App/Site Menu -->
        <div id="main-menu">
            <?php include(APPPATH.'/views/mobile/layout/nav.php'); ?>

        </div>



        <!-- End Site/App Menu -->

    </div>
    <!-- END LEFT SIDEBAR -->

    <!-- RIGHT SIDEBAR -->
    <div id="slide-out-right" class="side-nav">

        <?php include(APPPATH.'/views/mobile/layout/compare-blogs.php'); ?>

    </div>
    <!-- END RIGHT SIDEBAR -->

    <!-- MAIN PAGE -->
    <div id="page">

        <!-- FIXED Top Navbar -->
        <div class="top-navbar">
            <?php include(APPPATH.'/views/mobile/layout/top.php'); ?>
        </div>
        <!-- End FIXED Top Navbar -->


        <!-- CONTENT CONTAINER -->
        <div class="content-container">

        <h1 class="page-title animated fadeIn"><?=$name?> <?php if($name=="Wholesale")?></h1>
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

				WHERE  o.approved='yes' AND p.price <>0  AND p.price <>'' AND  o.expireson > NOW()  ORDER BY id DESC";
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
	buy.approved='yes'
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
$pager = new PS_Pagination($dbh , $qqq, 8, 3, $append, base_url(),$Getpage);
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
        <!-- Product navigation -->
        <div class="product-list-navigation animated fadeInRight">
            <div class="product-num"><span><?=count($details);?></span> Product(s) below in (<span><?=$TotalProduct_found;?></span>)</div>
            <div class="sorting-nav">
                <span class="label">Sort by</span>
                <div class="sorting-dropdown">
                    <select class="browser-default">
                        <option value="" selected>Latest</option>
                        <option value="">Popular</option>
                        <option value="">Cheapest</option>
                        <option value="">Most Expensive</option>
                        <option value="">High rating</option>
                        <option value="">Alphabet A-Z</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- End Product navigation -->

        <!-- Product List -->
        <ol class="product-list animated fadeInLeft">

        <?php


        if(!empty($details)) {

        foreach ($details as $product) {
        if(isset($buyoffers)){

            $path="assets/uploadedimages/buyoffer/".$product['buyoffer_image'];
        }else{
            $path="assets/uploadedimages/".$product['image'];
        }

//        if(file_exists($path))
//        {
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
            <li><!-- 1. Product Slider item -->
                <div class="thumb">

                    <a href="<?=base_url().$productLink ?>"><img class="newproductImages"  src=" <?=$imageLink?>" alt="<?=$product['title']?>"></a>
                </div>
                <div class="product-ctn">
                    <div class="product-name">
                        <a href="<?=base_url().$productLink ?>">
                            <?=wordtrimer(ucfirst(strtolower($product['title'])),2)?>
                        </a>
                    </div>

                    <div class="price">

                        <span class="price-current"> <?=$currencySymbol ?>. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));?></span>
                    </div>
                    <div class="rating">
                        <span class="unit-measure"><?=$unit?></span>
                    </div>
                </div>
            </li><!-- 1. End Product Slider item -->

        <?php
//        }
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

        </ol>
        <!-- End Product List -->

        <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

        <!-- Pagination -->
        <ul class="pagination">
            <?php
            if($pager->total_rows>12){
                echo  $pager->renderFullNav();
            }?>
        </ul>
        <!-- End Pagination -->

        </div>
        <!-- END CONTENT CONTAINER -->

        <!-- FOOTER -->
        <div class="footer">

            <!-- Footer main Section -->
            <?php include(APPPATH.'/views/mobile/layout/footer-bottom.php'); ?>
            <!-- End Copyright Section -->

        </div>
        <!-- End FOOTER -->

        <!-- Back to top Link -->
        <div id="to-top" class="main-bg"><i class="fa fa-long-arrow-up"></i></div>

    </div>
    <!-- END MAIN PAGE -->

</div><!-- #main -->

<?php include(APPPATH.'/views/mobile/layout/footer.php'); ?>

</body>
</html>