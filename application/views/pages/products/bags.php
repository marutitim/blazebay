
<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">

    <?php
    $qqq= "
      SELECT * ,p.id as pid
      FROM bt_products p
      JOIN bt_product_cats pc ON pc.offer_id = p.id
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE  m.suspended='N'  AND  p.approved = 'yes'  AND p.price <>0  AND p.price <>'' AND p.title LIKE '%bag%'  ORDER BY RAND()";


    $premium= $this->Site_model->execute($qqq);
    foreach($premium as $product){
        // if(file_exists("assets/uploadedimages/".$groupProducts['image'])){

        $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['pid']."/".$product['uid'];
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

                </div><!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=$product['title']?></a></h3>
                    <div class="rating rateit-small"></div>

                    <div class="product-price">
								<span class="price">
									 <?php
                                     if($product['min_sell_price']!=0 && $product['min_sell_price']!=" " && $product['max_sell_price']!=" " && $product['min_sell_price']!=$product['max_sell_price']) {
                                         ?>
                                         <?=$currencySymbol?>. <?= number_format(number_format((float)$product['min_sell_price'] * $currencyRate, 2, '.', '')); ?>    -  ksh. <?= number_format(number_format((float)$product['max_sell_price'] * $currencyRate, 2, '.', ''));
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

                            <button class="btn btn-primary cart-btn" onclick="return contactSupplier(<?=$product['pid']?>)" type="button">Contact Supplier</button>

                        </div>

                    </div><!-- /.action -->
                </div><!-- /.cart -->
            </div>
        </div>

    <?php  } ?>


</div><!-- /.sidebar-widget -->