<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 11:21 AM
 */
?>
<div class="sidebar-widget-body outer-top-xs">
    <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
        <?php
        //var_dump($bestsellerProducts);die;
        $list=array();
        for($i=0;$i<ceil(count($productsUnder1000)/2);$i++){
            $list[]=array_slice($productsUnder1000,$i*2,2);
        }

        foreach( $list as $section){

            $unit_id        = $product['qty_unit'];
            if($unit_id){
                $where= "unit_id =$unit_id";

                $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                $unit        = $get_units[0]['unit_name'];
            }
            ?>
            <div class="item">
                <div class="products best-product">
                    <?php
                    foreach($section as $product){
                        if(file_exists("assets/uploadedimages/".$product['image']) && $product['image'] !=""){
                            $productLink="wholesale/product-details/".RemoveBadURLCharaters($product['title'])."/". $product['id']."/".$product['uid'];
                            //$imageLink="assets/uploadedimages/".$product['image'];
                            $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];
                            ?>
                            <div class="product">
                                <div class="product-micro">
                                    <div class="product-micro-row">
                                        <div >
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="<?=base_url().$productLink ?>">
                                                        <img   class="newproductImages" src="<?=$imageLink?>" alt="<?=$product['title']?>">
                                                    </a>
                                                </div><!-- /.image -->



                                            </div><!-- /.product-image -->
                                            <div class="product-info text-left" style="padding-top:2%;">
                                                <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=wordtrimer(ucfirst(strtolower($product['title'])),4)?></a></h3>
                                                <!--                <div class="rating rateit-small"></div>-->
                                                <div class="description"></div>

                                                <div class="product-price">
                                                    <span class="price">
                                                         <?php
                                                         if($product['min_sell_price']!=0 && $product['min_sell_price']!=" " && $product['max_sell_price']!=" " && $product['min_sell_price']!=$product['max_sell_price']) {
                                                             ?>
                                                             <?=$currencySymbol ?>. <?= number_format(number_format((float)$product['min_sell_price'] * $currencyRate, 2, '.', '')); ?>    -  <?= number_format(number_format((float)$product['max_sell_price'] * $currencyRate, 2, '.', ''));
                                                         }else{ ?>
                                                             <?=$currencySymbol ?>. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));

                                                         }

                                                         ?>

                                                    </span>
                                                    <span class="unit-measure"><?=$unit?></span>

                                                </div><!-- /.product-price -->

                                            </div><!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <?php include(APPPATH.'/views/pages/cart-wishlist-compare.php'); ?>
                                            </div><!-- /.cart -->
                                        </div><!-- /.col -->


                                    </div><!-- /.product-micro-row -->
                                </div><!-- /.product-micro -->

                            </div>

                        <?php }} ?>
                </div>
            </div>
        <?php

        } ?>
    </div>
</div><!-- /.sidebar-widget-body -->
