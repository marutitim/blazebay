    <?php

    if(!empty($relatedproducts)){
    foreach($relatedproducts as $product){
   // if(file_exists("assets/uploadedimages/".$product['image']) && $product['image'] !=""){

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
    //}
    }} else {
        ?>
        <div class="alert alert-info" role="alert">
            No related products listed  for now
        </div>
    <?php
    } ?>
</ol>