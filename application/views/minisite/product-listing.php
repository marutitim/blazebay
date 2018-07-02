<?php

$append ='m/';
$name='';
$prev="bt_";

function word_teaser($string, $count){
    $original_string = $string;
    $words = explode(' ', $original_string);

    if (count($words) > $count){
        $words = array_slice($words, 0, $count);
        $string = implode(' ', $words);
    }

    return $string;
}
if(isset($active) && $active=='category'){
    $qqq = "SELECT p.*,p.id as pid
                FROM ".$prev."products as p
                JOIN ".$prev."product_cats as pc ON p.id=pc.offer_id
                JOIN ".$prev."categories as c ON c.id = pc.cid
                WHERE p.approved ='yes' AND pc.cid='".$catId."' and p.uid=$seller_id AND p.image!='' GROUP BY p.id ORDER BY p.id DESC";
}else {
    $qqq = "
      SELECT * ,p.id as pid
      FROM bt_products p

      WHERE  uid='$seller_id' AND approved='yes'  ORDER BY id DESC";
}

$mvpath= "https://".$_SERVER['SERVER_NAME'] . "/";
require_once APPPATH.'libraries/ps_pagination.php';
require_once APPPATH.'views/pages/aoth/external-conn.php';
$pager = new PS_Pagination($dbh , $qqq, 9, 5, $append, $mvpath,$Getpage);
//The paginate() function returns a mysql result set for the current page
$res = $pager->paginate();


$productsWithTradeSecurity=array();
if($res) {
    $TotalProduct_found = mysqli_num_rows(mysqli_query($dbh, $qqq));
    while ($row =mysqli_fetch_array($res)) {
        $productsWithTradeSecurity[] =$row;
    }
} ?>
<?php include('product-filters.php'); ?>

<div class="search-result-container ">
<div id="myTabContent" class="tab-content category-list">


<div class="tab-pane active " id="grid-container">
<div class="category-product">
<div class="row" >


    <?php
    $unit="";
    foreach($productsWithTradeSecurity as $product){
        $productLink = "product-details/" . RemoveBadURLCharaters($product['title']) . "/" . $product['pid'] . "/" . $product['uid'];
    if(file_exists("assets/uploadedimages/".$product['image'])){
        //$imageLink="assets/uploadedimages/".$product['image'];
        $imageLink = "https://www.blazebay.com/assets/uploadedimages/" . $product['image'];
        $unit_id = $product['qty_unit'];
        if($unit_id){
            $where= "unit_id =$unit_id";

            $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
            $unit = $get_units[0]['unit_name'];
        }
        ?>
<div class="col-sm-6 col-md-4 wow fadeInUp">
    <div class="products">


        <div class="product">
            <div class="product-image">
                <div class="image">
                    <a href="<?= base_url() . $productLink ?>"><img class="tradesecurity"
                                                                    src="<?= $imageLink ?>"
                                                                    alt="<?= ucfirst($product['title']) ?>"
                                                                    alt="<?= $product['title'] ?>"></a>
                </div>
                <!-- /.image -->

                <!--                            <div class="tag new"><span>new</span></div>-->
            </div>
            <!-- /.product-image -->


            <div class="product-info text-left">
                <h3 class="name"><a href="<?=base_url() . $productLink ?>"><?=word_teaser(ucfirst(strtolower($product['title'])),4)?></a>
                </h3>

                <!--                            <div class="rating rateit-small"></div>-->
                <div class="description"></div>

                <div class="product-price">
                                <span class="price">
                                   ksh. <?=number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', '')); ?>	</span>
                                <span
                                    class="price-before-discount"></span>
                    <span class="unit-measure"><?=$unit?></span>
                </div>
                <!-- /.product-price -->

            </div>
            <!-- /.product-info -->
            <div class="cart clearfix animate-effect">
                <?php include(APPPATH.'/views/pages/cart-wishlist-compare.php'); ?>
                <!-- /.action -->
            </div>
            <!-- /.cart -->
        </div>
        <!-- /.product -->

    </div>
</div><!-- /.item -->
<?php } }?>
</div><!-- /.row -->
</div><!-- /.category-product -->

</div><!-- /.tab-pane -->

<div class="tab-pane "  id="list-container">
<div class="category-product">

    <?php foreach($productsWithTradeSecurity as $product){
        $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['pid']."/".$product['uid'];
        //$imageLink="assets/uploadedimages/".$product['image'];
    if(file_exists("assets/uploadedimages/".$product['image'])){
        $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];
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
                                    <a href="<?=base_url().$productLink ?>"><img class="tradesecurity" src="<?=$imageLink?>"  alt="<?=$product['title']?>" alt="<?=$product['title']?>"></a>

                                </div>
                            </div><!-- /.product-image -->
                        </div><!-- /.col -->
                        <div class="col col-sm-8 col-lg-8">
                            <div class="product-info">
                                <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=ucfirst(strtolower($product['title']))?></a></h3>
                                <!--                        <div class="rating rateit-small"></div>-->
                                <div class="product-price">
					<span class="price">
						ksh.<?=number_format(number_format((float)$product['price']* $currencyRate, 2, '.', ''));?></span>
                                    <span class="unit-measure"><?=$unit?></span>

                                </div><!-- /.product-price -->
                                <div class="description m-t-10"><?=$product['description']?></div>
                                <div class="cart clearfix animate-effect">
                                    <?php include(APPPATH.'/views/pages/cart-wishlist-compare.php'); ?>
                                </div><!-- /.cart -->

                            </div><!-- /.product-info -->
                        </div><!-- /.col -->
                    </div><!-- /.product-list-row -->
                    <!--            <div class="tag new"><span>new</span></div>  -->
                </div><!-- /.product-list -->
            </div><!-- /.products -->
        </div><!-- /.category-product-inner -->

    <?php } }?>



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

</div>