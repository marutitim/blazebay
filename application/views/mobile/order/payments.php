<div id="collapseFive" class="panel-collapse collapse">
    <div class="panel-body">
        <div class="row">

            <!-- guest-login -->
            <div class="col-md-4">

        <div class="radio">
            <label><input type="radio"  onchange="return setcheked(1)"  checked name="optradio">Mpesa <img src="<?=base_url()?>assets/images/payments/5.png" alt=""></label>
        </div>
        <div class="radio">
            <label><input type="radio"  onchange="return setcheked(4)"  name="optradio">Card
                <img src="<?=base_url()?>assets/images/payments/3.png" alt="">
                <img src="<?=base_url()?>assets/images/payments/4.png" alt=""></label>
        </div>
<!--        <div class="radio">-->
<!--            <label><input type="radio"  onchange="return setcheked(2)"  name="optradio">Paypal <img src="--><?//=base_url()?><!--assets/images/payments/1.png" alt=""></label>-->
<!--        </div>-->
        <div class="radio">
            <label><input type="radio"  onchange="return setcheked(3)"  name="optradio">NURUCOIN <img src="<?=base_url()?>assets/images/payments/2.png" alt=""></label>
        </div>

            </div>

        <div class="col-md-6">
            <div id="mpesaerrors"></div>
            <div id="mpesaerrors" style="display:none;"class="text-danger"></div>
            <div class="mpesa" id="mpesa">
                <div class="mpesaresponse"></div>
                <ol>
                    <li>Go to your MPESA menu</li>
                    <li>Navigate To Lipa Na MPESA and select Pay Bill Option</li>
                    <!--<li>Enter Paybill Number <strong >695916</strong></li>-->
                    <li>Enter Paybill Number <strong >190853</strong>
                    <li>Use account number <strong ><span class="Mpesa-Account"><?=$c_pay_number?></span></strong></li>
                    <li class="mpesacash">Enter Amount <strong ><span class="grandtotal-sam">
                     <?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?>
                            </span></strong></li>
                    <li>Enter Your MPESA PIN and Send</li>
                    <!--<li>The Account name for Confirmation is <strong >BLAZEBAY INTERNATIONAL LTD</strong></li>-->
                    <li>The Account name for Confirmation is <strong >CHURCHBLAZE GROUP LIMITED</strong></li>
                    <li class="col-xs-12 col-fit">
                        <div class="col-xs-12 col-fit clearfix">
                            Once you receive the MPESA confirmation, enter the code below and then submit.
                        </div>

                    </li>
                    <div class="clearfix"></div>
                </ol>
                <div class="row">
                <div class="col-md-8">
                    <input class="form-control" type="text" name="mpesacode" id="mpesacode" minlength="10" maxlength="15" placeholder="MPESA Code">


                </div>
                    <div class="col-md-4"><button type="button" onclick="return veryfyMpesa();" class="btn" style="background-color:#2873f0;color:#ffffff;">
                        Submit
                    </button></div>
                   </div>
            </div>

            <div id="paypal"></div>
            <div id="nurucoin"></div>
            <div id="card" style="background-color: #f0f8ff;padding: 10px;">

                <?php if(isset($code) && $code==0){?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> An error occurred on payment,please try again.
                    </div>
                <?php } ?>
                <form action="<?=base_url()?>orderCardPayment" method="post" id="payment-form">

                    <div class="form-row">

                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <input type="hidden" id="p_key" name="p_key" value="pk_test_g6do5S237ekq10r65BnxO6S0">
                        <div id="card-element" style="background: #fff">
                            <!-- A Stripe Element will be inserted here. -->
                            <h5 class="text-center text-success">
                                <i class="fa fa-spinner fa-spin"></i> Connecting to secure gateway
                            </h5>
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" class="signal-red" role="alert"></div>
                    </div>
                    <input type="hidden"  name="productId" value="<?=$productDetails[0]['id']?>"/>
                    <input type="hidden"  name="customercolor" value="<?php echo $color ? $color:'';?>"/>
                    <input type="hidden"  name="customersize" value="<?php echo $size ? $size:'';?>"/>
                    <input type="hidden"  id="productqty" name="qty" value="<?php echo $qty;?>"/>
                    <input type="hidden"  name="shipping" id="shippingcourier_id" value=""/>
                    <input type="hidden"  id="shippingamount" class="shippingamount" name="shippingamount" value=""/>
                    <input type="hidden"  name="productprice" value="<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>"/>
                    <input type="hidden"  name="totalproductprice" value="<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>"/>
                    <input type="hidden"  id="totalAmount" name="totalAmount" value=""/>
                    <input type="hidden"  name="productcurrency" value="<?php echo $currencySymbol ?>"/>
                    <input type="hidden"  name="transactId" id="transactId" value="" />
                    <input type="hidden"  name="paymode" id="paymode" value="" />
                    <input type="hidden"  name="mpesacode" id="mpesacodesent" value="" />
                    <input type="hidden"  name="paymentAmount" id="paymentAmount" value="<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>" />
                    <input type="hidden"  name="MpesaAccount" id="MpesaAccount" value="<?=$c_pay_number?>" />
                    <input type="hidden"  name="callbackUrl" id="callbackUrl" value="<?=$_SERVER['REQUEST_URI']?>" />
                    <input type="hidden"  name="curiername" value=""/>
                    <input type="hidden" id="shipping_firstname" name="first-name" value="<?=$mem[0]['firstname'];?>"/>
                    <input type="hidden"  id="shipping_lastname" name="last-name" value="<?=$mem[0]['lastname'];?>"/>
                    <input type="hidden"  name="shipping_postcode"  value="<?=$mem[0]['address'];?>"/>
                    <input type="hidden"  name="shipping_state"  value="<?=$mem[0]['country'];?>"/>
                    <input type="hidden"  name="address"  value="<?=$mem[0]['address'];?>"/>
                    <input type="hidden"  name="city"  name="city" value="<?=$mem[0]['city'];?>"/>
                    <input type="hidden"   name="zip" value="<?=$mem[0]['zip'];?>"/>
                    <input type="hidden"   name="phone-number" value="<?=$mem[0]['phone'];?>"/>
                    <input type="hidden"   name="email" value="<?=$mem[0]['email'];?>"/>
                    <input type="hidden"  name="state" name="state" value="<?=$mem[0]['state'];?>"/>
                    <input type="hidden"    name="country" value="<?=$mem[0]['country'];?>"/>
                    <input type="hidden"   name="country_id" value="<?=$mem[0]['country'];?>"/>
                    <input type="hidden"   name="shipping_state_id" value="<?=$mem[0]['country'];?>"/>


                    <input type="hidden"  id="productname" name="productname" value="<?=$productDetails[0]['title'];?>"/>

                    <div class="row pl-10">
                        <div class="col-xs-12 mt-5 form-group">
                            <button class="form-control btn btn-primary submit-button" type="submit" id="submit-button" >Pay »</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

</div>
        