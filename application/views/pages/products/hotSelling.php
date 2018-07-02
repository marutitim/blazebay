<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/10/2018
 * Time: 12:30 PM
 */
?>
<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">

    <?php foreach($hotSellingProducts_details as $product){
    // if(file_exists("assets/uploadedimages/".$groupProducts['image'])){

    $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['id']."/".$product['uid'];
    //$imageLink="assets/uploadedimages/".$product['image'];

    $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];
        $unit="";
        $unit_id        = $product['qty_unit'];
        if($unit_id){
            $where= "unit_id =$unit_id";

            $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
            $unit        = $get_units[0]['unit_name'];
        }
    ?>
<div class="item">
    <div class="products">
        <div class="hot-deal-wrapper">
            <div class="image">
                <a href="<?=base_url().$productLink ?>"><img class="newproductImages" src="<?=$imageLink?>" alt=""></a>
            </div>
            <div class="sale-offer-tag"><span>35%<br>off</span></div>
            <div class="timing-wrapper">
                <div class="box-wrapper">
                    <div class="date box">
                        <span class="key">120</span>
                        <span class="value">Days</span>
                    </div>
                </div>

                <div class="box-wrapper">
                    <div class="hour box">
                        <span class="key">20</span>
                        <span class="value">HRS</span>
                    </div>
                </div>

                <div class="box-wrapper">
                    <div class="minutes box">
                        <span class="key">36</span>
                        <span class="value">MINS</span>
                    </div>
                </div>

                <div class="box-wrapper hidden-md">
                    <div class="seconds box">
                        <span class="key">60</span>
                        <span class="value">SEC</span>
                    </div>
                </div>
            </div>
        </div><!-- /.hot-deal-wrapper -->

        <div class="product-info text-left m-t-20">
            <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=$product['title']?></a></h3>
            <div class="rating rateit-small"></div>

            <div class="product-price">
								<span class="price">
									 <?php
                                     if($product['min_sell_price']!=0 && $product['min_sell_price']!=" " && $product['max_sell_price']!=" " && $product['min_sell_price']!=$product['max_sell_price']) {
                                         ?>
                                         <?=$currencySymbol?>. <?= number_format(number_format((float)$product['min_sell_price'] * $currencyRate, 2, '.', '')); ?>    -   <?=$currencySymbol?>. <?= number_format(number_format((float)$product['max_sell_price'] * $currencyRate, 2, '.', ''));
                                     }else{ ?>
                                         <?=$currencySymbol?>. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));

                                     }
                                     ?>
								</span>

                <span class="unit-measure"><?=$unit?></span>

            </div><!-- /.product-price -->

        </div><!-- /.product-info -->

        <div class="cart clearfix animate-effect">
            <div class="action">

                <div class="add-cart-button btn-group">

                    <button class="btn btn-primary cart-btn" onclick="return contactSupplier(<?=$product['id']?>)" type="button">Contact Supplier</button>

                </div>

            </div><!-- /.action -->
        </div><!-- /.cart -->
    </div>
</div>

    <?php  } ?>


</div><!-- /.sidebar-widget -->