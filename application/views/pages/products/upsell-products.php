<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 12:19 PM
 */
?>
<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

    <?php

    if(!empty($relatedproducts)){
        foreach($relatedproducts as $product){
            if(file_exists("assets/uploadedimages/".$product['image']) && $product['image'] !="") {
            $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['id']."/".$product['uid'];
            //$imageLink="assets/uploadedimages/".$product['image'];

            $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];

            $unit_id        = $product['qty_unit'];
            $unit="";
            if($unit_id){
                $where= "unit_id =$unit_id";

                $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                $unit        = $get_units[0]['unit_name'];
            }

                ?>
                <div class="item item-carousel">
                    <div class="products">

                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="<?= base_url() . $productLink ?>"><img class="newproductImages"
                                                                                    src="<?= $imageLink ?>" alt=""></a>
                                </div>
                                <!-- /.image -->

                                <!--                            <div class="tag sale"><span>sale</span></div>-->
                            </div>
                            <!-- /.product-image -->


                            <div class="product-info text-left">
                                <h3 class="name"><a
                                        href="<?= base_url() . $productLink ?>"><?= ucfirst(strtolower($product['title'])) ?></a>
                                </h3>
                                <!--                            <div class="rating rateit-small"></div>-->
                                <div class="description"></div>

                                <div class="product-price">
				<span class="price">
					<?= $currencySymbol ?>
                    .<?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', '')); ?>			</span>
                                    <span class="unit-measure"><?= $unit ?></span>

                                </div>
                                <!-- /.product-price -->

                            </div>
                            <!-- /.product-info -->
                            <div class="cart clearfix animate-effect">
                                <?php include(APPPATH . '/views/pages/cart-wishlist-compare.php'); ?>
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
    }else{
        ?>
        <div class="alert alert-info" role="alert">
            No related products listed  for now
        </div>
    <?php
    }
    ?>
</div><!-- /.home-owl-carousel -->
