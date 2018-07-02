<div class="checkout-progress-sidebar ">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">Order Summary</h4>
            </div>

            <div class="clearfix cart-total">

                <div class="pull-left"><img   class="newproductImages" src="<?="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image']?>"></div>
                <div class="pull-right">

                    <h3 class="name"><a href="<?=base_url()?>product-details/<?=$productDetails[0]['title']?>/<?=$productDetails[0]['id']?>/<?=$productDetails[0]['uid']?>"><?=$productDetails[0]['title']?></a></h3>
                    <div class="price"><b>Price: </b><?php echo $currencySymbol ?>.<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '');?></div>
                    <span class="text"><b>Qty :</b></span><span class='price'><span class="orderqty"><?=$qty?></span></span>
                    <span class="text shipping-amt" ><br><b>Shipping :</b></span><span class='shipping-amount'></span><br>
                    <span class="text"><b>Sub Total :</b></span><span class='price'><span class="subtotal-sam">
                           <?php echo $currencySymbol ?>.<?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?></span></span><br>
                    <span class="text"><b>Grand Total :</b></span><span class='price'><span class="grandtotal-sam2">
                  <?php echo $currencySymbol ?>.<?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?> </span></span>
                    <input type="hidden" class="shipping-hidden" id="shipping-hidden" value="" />
                    <input type="hidden" class="grandtotalsummary" value="<?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?>"/>


                </div>
                       </div><!-- /.cart-total-->





        </div>
    </div>
</div>
    