<?php
$append = 'all-secured-products/';
$qqq = "
      SELECT * ,p.id as pid
      FROM bt_products p
      JOIN bt_product_cats pc ON pc.offer_id = p.id
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE  m.suspended='N'  AND  p.approved = 'yes'
      ORDER BY p.id DESC  ";
$name='';
require_once APPPATH.'libraries/ps_pagination.php';
require_once APPPATH.'views/pages/aoth/external-conn.php';
$pager = new PS_Pagination($dbh , $qqq, 4, 5, $append, base_url(),$Getpage);
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
        //$imageLink="assets/uploadedimages/".$product['image'];
        $imageLink = "https://www.blazebay.com/assets/uploadedimages/" . $product['image'];
        $unit_id = $product['qty_unit'];
        if($unit_id){
            $where= "unit_id =$unit_id";

            $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
            $unit = $get_units[0]['unit_name'];
        }
        ?>
<div class="col-sm-6 col-md-3 wow fadeInUp">
    <div class="products">


        <div class="product">
            <div class="product-image">
                <div class="image">
                    <a href="<?= base_url() . $productLink ?>"><img class="newproductImages"
                                                                    src="<?= $imageLink ?>"
                                                                    alt="<?= ucfirst($product['title']) ?>"
                                                                    alt="<?= $product['title'] ?>"></a>
                </div>
                <!-- /.image -->

                <!--                            <div class="tag new"><span>new</span></div>-->
            </div>
            <!-- /.product-image -->


            <div class="product-info text-left">
                <h3 class="name"><a href="<?=base_url() . $productLink ?>"><?=ucfirst(strtolower($product['title']))?></a>
                </h3>

                <!--                            <div class="rating rateit-small"></div>-->
                <div class="description"></div>

                <div class="product-price">
                                <span class="price">
                                    <?php
                                    if($product['min_sell_price']!=0 && $product['min_sell_price']!=" " && $product['max_sell_price']!=" " && $product['min_sell_price']!=$product['max_sell_price']) {
                                        ?>
                                        ksh. <?= number_format(number_format((float)$product['min_sell_price'] * $currencyRate, 2, '.', '')); ?>    -  ksh. <?= number_format(number_format((float)$product['max_sell_price'] * $currencyRate, 2, '.', ''));
                                    }else{ ?>
                                        ksh. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));

                                    }
                                    ?>

                                </span>
                                <span
                                    class="price-before-discount"></span>
                    <span class="unit-measure"><?=$unit?></span>
                </div>
                <!-- /.product-price -->

            </div>
            <!-- /.product-info -->
            <div class="cart clearfix animate-effect">
                <div class="action">
                    <ul class="list-unstyled">

                        <li class="lnk wishlist">
                            <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return contactSupplier(<?=$product['uid']?>)" title="Contact Supplier">
                                <i class="icon fa fa-envelope"></i>
                            </a>
                        </li>

                        <li class="lnk wishlist">
                            <a class="add-to-cart" href="#" onclick="return wishlist(<?=$product['pid']?>,<?=$product['uid']?>)" title="Wishlist">
                                <i class="icon fa fa-heart"></i>
                            </a>
                        </li>

                        <li class="lnk">
                            <a class="add-to-cart" href="#"  onclick="return compareProducts(<?=$product['pid']?>,<?=$product['uid']?>)"title="Compare">
                                <i class="fa fa-signal"></i>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.action -->

            </div>
            <!-- /.cart -->
        </div>
        <!-- /.product -->

    </div>
</div><!-- /.item -->
<?php } ?>
</div><!-- /.row -->
</div><!-- /.category-product -->

</div><!-- /.tab-pane -->

<div class="tab-pane "  id="list-container">
<div class="category-product">

    <?php foreach($productsWithTradeSecurity as $product){
        $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['pid']."/".$product['uid'];
        //$imageLink="assets/uploadedimages/".$product['image'];
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
                                    <a href="<?=base_url().$productLink ?>"><img class="newproductImages" src="<?=$imageLink?>"  alt="<?=$product['title']?>" alt="<?=$product['title']?>"></a>

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
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="lnk wishlist">
                                                    <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return contactSupplier(<?=$product['uid']?>)" title="Contact Supplier">
                                                        <i class="icon fa fa-envelope"></i>
                                                    </a>
                                                </li>

                                                <li class="lnk wishlist">
                                                    <a class="add-to-cart" href="#" onclick="return wishlist(<?=$product['pid']?>,<?=$product['uid']?>)" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>

                                                <li class="lnk">
                                                    <a class="add-to-cart" href="#"  onclick="return compareProducts(<?=$product['id']?>,<?=$product['uid']?>)"title="Compare">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /.action -->

                                    </div>
                                </div><!-- /.cart -->

                            </div><!-- /.product-info -->
                        </div><!-- /.col -->
                    </div><!-- /.product-list-row -->
                    <!--            <div class="tag new"><span>new</span></div>  -->
                </div><!-- /.product-list -->
            </div><!-- /.products -->
        </div><!-- /.category-product-inner -->

    <?php } ?>



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