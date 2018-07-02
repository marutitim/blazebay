
<div id="collapseOne" class="panel-collapse collapse in">

    <!-- panel-body  -->
    <div class="panel-body">
        <div class="row">

            <!-- review -->
            <div class="col-md-12 col-sm-12">
                <div id="qty-dialog"></div>
                <table id="cart" class="table table-hover table-condensed" style="height:10% !important;">
                    <thead>
                    <tr>

                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:30%" class="text-center">Subtotal</th>
                        <th ></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-4 hidden-xs"><img style="width:150px !important;"
                                                                     src="<?="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image']?>"
                                                                     alt="<?=$productDetails[0]['title'];?>"  class="img-responsive"/></div>
                                <div class="col-sm-6">
                                    <?=$productDetails[0]['title'];?>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price"><b></b><?php echo $currencySymbol ?>.<?=number_format((float)$productDetails[0]['price']*
                                $currencyRate, 2, '.', '')?></td>

                        <input type="hidden"  id="orderprice" value="<?=number_format((float)$productDetails[0]['price']*$currencyRate, 2, '.', '')?>"/>
                        <td data-th="Quantity">
                            <input type="number" style="width:50px"  id="quantity" min="<?=$qty?>"
                                   max="1000000"  onchange="return calcorder(this.value,'<?=$productDetails[0]['id']?>')"
                                   value="<?=$qty;?>">
                        </td>


                        <td data-th="Subtotal"  class="text-center"><div class="subtotal">
                                <?php echo $currencySymbol ?>.<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>
                            </div></td>

                    </tr>
                    </tbody>

                </table>
                <?php  if(!empty($productDetails[0]['color']) || !empty($productDetails[0]['size'])){?>
                <hr class="style9">
               <b>Other Specific details</b> <br>
             <?php
                if(!empty($productDetails[0]['color'])) {
                    $color = explode(',', $productDetails[0]['color']);
                    $colorarray = explode(',', implode(',', $color));
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            Select Color:
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="color-dropdown" name="color">
                                <?php
                                for ($i = 0; $i <= count($colorarray); $i++) {

                                    ?>
                                    <option
                                        value="<?php echo trim($color[$i]); ?>"><?php echo trim($colorarray[$i]); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                <?php
                }
            if(!empty($productDetails[0]['size'])){
                $size=explode(',',$productDetails[0]['size']);
                $sizearray=explode(',',implode(', ',$size));

                ?>
                <br><br><div class="row">
                    <div class="col-md-3">
                        Select size:
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" id="size-dropdown" name="size">
                            <?php
                            for($i=0;$i<=count($sizearray);$i++){

                                ?>
                                <option  value="<?php echo trim($sizearray[$i]);?>"><?php echo trim($sizearray[$i]);?></option>
                            <?php
                            }
                            ?>
                        </select>

                </div>
                </div>
          <?php }  } ?>
                <br><br><div class="row">
                    <div class="col-md-3">
                        Extra  details for the order
                    </div>
                    <div class="col-md-9">
                <textarea name="order-more-details" id="order-more-details"></textarea>
                    </div>
                </div>
            </div>
            <!-- review-->


        </div>
    </div>
    <!-- panel-body  -->
<!--    <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue " onclick="return tabselector('tab1','tab2')">Continue</button>-->

</div><!-- row -->