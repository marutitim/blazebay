<div class="checkout-progress-sidebar ">
    <div class="panel-group">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">Order Summary</h4>
            </div>


            <div class="clearfix cart-total">

                <div class="pull-left"><img   class="newproductImages" src="<?="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image']?>"></div>

                <div class="pull-left">

                    <h3 class="name"><a href="<?=base_url()?>product-details/<?=$productDetails[0]['title']?>/<?=$productDetails[0]['id']?>/<?=$productDetails[0]['uid']?>"><?=$productDetails[0]['title']?></a></h3>
                    <div class="price"><b>Price: </b><?php echo $currencySymbol ?>.<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '');?></div>
                    <span class="text"><b>Qty :</b></span><span class='price'><span class="orderqty"><?=$qty?></span></span><br>
                    <?php
                    if(!empty($productDetails[0]['color'])) {
                    $color = explode(',', $productDetails[0]['color']);
                    $colorarray = explode(',', implode(',', $color));
                    ?>
                    <span class="text"><b>Color :</b></span><span class="ordercolor"><?=$colorarray[0]?></span><br>
                    <?php } ?>
                    <?php if(!empty($productDetails[0]['size'])){
                    $size=explode(',',$productDetails[0]['size']);
                    $sizearray=explode(',',implode(', ',$size));
                    ?>
                    <span class="text"><b>Size :</b></span><span class="ordersize"><?=$sizearray[0]?></span><br>
                    <?php } ?>
                    <div id="order-commentest"></div>

                    <span class="text shipping-amt" ><br><b>Shipping :</b></span><span class='shipping-amount'></span>
                    <span class="text"><b>Sub Total :</b></span><span class='price'><span class="subtotal-sam">
                           <?php echo $currencySymbol ?>.<?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?></span></span><br>
                    <hr class="style9">
                    <span class="text"><b>Grand Total :</b></span><span class='price'><span class="grandtotal-sam2">
                  <?php echo $currencySymbol ?>.<?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?> </span></span>
                    <input type="hidden" class="shipping-hidden" id="shipping-hidden" value="" />

                    <input type="hidden" class="grandtotalsummary" value="<?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?>"/>


                </div>
                       </div><!-- /.cart-total-->

            <div class="clearfix"></div>

            <a href="#" class="btn btn-upper btn-primary btn-block m-t-20">Save Order</a>



        </div>
    </div>
</div>
    