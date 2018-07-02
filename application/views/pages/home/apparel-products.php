
        <?php
        /**
         * Created by PhpStorm.
         * User: developer
         * Date: 5/9/2018
         * Time: 11:21 AM
         */
        ?>
        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" style="margin-left: 1%">

            <?php
            $qqq= "
      SELECT *
      FROM bt_products p
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE  m.suspended='N'  AND  p.approved = 'yes'  AND p.price <>0  AND p.price <>'' AND p.title LIKE '%shoes%'  ORDER BY RAND()";
            $shoes= $this->Site_model->execute($qqq);
            foreach($shoes as $product){
                if(file_exists("assets/uploadedimages/".$product['image']) && $product['image'] !=""){

                    $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['id']."/".$product['uid'];
                    //$imageLink="assets/uploadedimages/".$product['image'];
                    $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];
                    $unit_id        = $product['qty_unit'];
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
                                        <a href="<?=base_url().$productLink ?>"><img class="newproductImages"  src=" <?=$imageLink?>" alt="<?=$product['title']?>"></a>
                                    </div><!-- /.image -->


                                </div><!-- /.product-image -->


                                <div class="product-info text-left">
                                    <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=ucfirst(strtolower($product['title']))?></a></h3>
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
                                    <div class="action" style="float:left;">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <!--            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Buy">-->
                                                <!--                <i class="fa fa-shopping-cart"></i>-->
                                                <!--            </button>-->
                                                <!--            <button class="btn btn-primary cart-btn" type="button">Buy</button>-->

                                            </li>

                                            <li class="lnk wishlist">
                                                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return contactSupplier(<?=$product['id']?>)" title="Contact Supplier">
                                                    <i class="icon fa fa-envelope"></i>
                                                </a>
                                            </li>
                                            <li class="lnk">
                                                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return compareProducts(<?=$product['id']?>,<?=$product['uid']?>)" title="Compare">
                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="lnk wishlist">
                                                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return wishlist(<?=$product['id']?>,<?=$product['uid']?>)" title="Wishlist">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div><!-- /.action -->

                                </div><!-- /.cart -->
                            </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div><!-- /.item -->
                <?php }
            } ?>
        </div><!-- /.home-owl-carousel -->
