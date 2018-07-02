
<div class="sidebar-widget-body outer-top-xs">
<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
    <?php
    //$hotSellingProducts_details
    $list=array();
    for($i=0;$i<ceil(count($hotSellingProducts_details)/3);$i++){
        $list[]=array_slice($hotSellingProducts_details,$i*3,3);
    }

  //  var_dump($hotSellingProducts_details);die;
    foreach( $list as $section){

    ?>
<div class="item">
    <div class="products special-product">
        <?php foreach($section as $product){
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
        <div class="product">
            <div class="product-micro">
                <div class="row product-micro-row">
                    <div class="col col-xs-5">
                        <div class="product-image">
                            <div class="image">
                                <a href="<?=base_url().$productLink ?>">
                                    <img src="<?=$imageLink?>"  alt="<?=$product['title']?>">
                                </a>
                            </div><!-- /.image -->


                        </div><!-- /.product-image -->
                    </div><!-- /.col -->
                    <div class="col col-xs-7">
                        <div class="product-info">
                            <h3 class="name"><a href="<?=base_url().$productLink ?>"><?=ucfirst(strtolower($product['title']))?></a></h3>
<!--                            <div class="rating rateit-small"></div>-->
                            <div class="product-price">
				<span class="price">
					 <?php
                     if($product['min_sell_price']!=0 && $product['min_sell_price']!=" " && $product['max_sell_price']!=" " && $product['min_sell_price']!=$product['max_sell_price']) {
                         ?>
                         <?=$currencySymbol ?>. <?= number_format(number_format((float)$product['min_sell_price'] * $currencyRate, 2, '.', '')); ?> - <?= number_format(number_format((float)$product['max_sell_price'] * $currencyRate, 2, '.', ''));
                     }else{ ?>
                         <?=$currencySymbol ?>. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));

                     }
                     ?>

                </span>
                                <br>

                            </div><!-- /.product-price -->

                        </div>
                    </div><!-- /.col -->
                </div><!-- /.product-micro-row -->
            </div><!-- /.product-micro -->

        </div>
        <?php } ?>

    </div>
</div>

    <?php } ?>
</div>
</div><!-- /.sidebar-widget-body -->
