<ol class="category-list">

    <?php
    $mobile=array_slice($ProductsOffers, 0, 4);
    foreach( $mobile as $product){
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
            <li><!-- Category list item #1 -->
                <div class="thumb">
                    <a href="<?=base_url().$productLink ?>"><img class="newproductImages"  src=" <?=$imageLink?>" alt="<?=$product['title']?>"></a>
                </div>
                <div class="category-ctn">
                    <div class="cat-name">
                        <a href="<?=base_url().$productLink ?>">
                            <?=wordtrimer(ucfirst(strtolower($product['title'])),2)?>
                        </a>
                    </div>
                    <div class="cat-desc">
                        <?=$currencySymbol ?>.
                        <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));?>
                        <span class="unit-measure"><?=$unit?></span>
                    </div>
                </div>
            </li><!-- End Category list item #1 -->


        <?php
        }
    } ?>
</ol>