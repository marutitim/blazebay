
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
                        <?php if($color!=""&&$size!==""){ ?>
                            <th style="width:14%" class="text-center">Size</th>
                            <th style="width:22%" class="text-center">Color</th>
                        <?php }  ?>
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
                        <td data-th="Price"><b></b>ksh.<?=number_format((float)$productDetails[0]['price']*
                                $currencyRate, 2, '.', '')?></td>

                        <input type="hidden"  id="orderprice" value="<?=number_format((float)$productDetails[0]['price']*$currencyRate, 2, '.', '')?>"/>
                        <td data-th="Quantity">
                            <input type="number"   id="quantity" min="<?=$qty?>" value="<?=$qty?>"
                                   max="1000000"  onchange="return calcorder(this.value,
                                '<?=$productDetails[0]['id']?>')"
                                   value="<?=$qty; ?>">
                        </td>
                        <?php if($color!="" && $size!==""){ ?>
                            <td  class="text-center">

                                <?php echo $size ;?>
                            </td>
                            <td  class="text-center">
                                <?php echo $color;?>
                            </td>
                        <?php } ?>

                        <td data-th="Subtotal"  class="text-center"><div class="subtotal">
                                ksh.<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>
                            </div></td>

                    </tr>
                    </tbody>

                </table>

            </div>
            <!-- review-->

        </div>
    </div>
    <!-- panel-body  -->

</div><!-- row -->