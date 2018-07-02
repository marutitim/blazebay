<?php
$where="id= '$product_id'";
$productDetails= $this->Site_model->getDataById( $table = "bt_products", $where );
if(isset($this->session->userdata['logged_in']['user_id'])){
    $user_id=$this->session->userdata['logged_in']['user_id'];
    $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
    $memD= $this->Site_model->getDataById( 'bt_members', $where );
}

?>
<!DOCTYPE html>

<html lang="en-US">
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-modal.min.css"/>

    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>



    <style>
        [type="radio"]:not(:checked) + label:before {
            border-radius: 50%;
            border: 0px solid #5a5a5a !important;
        }
        [type="radio"] + label:before, [type="radio"] + label:after {
             margin: 4px !important;
             width: 16px !important;
             height: 16px !important;

        }
        [type="radio"]:checked + label:after {
            border: 2px solid #ffffff !important;
            background-color: #ffffff !important;
        }
        [type="radio"]:not(:checked), [type="radio"]:checked {
            position: relative !important;
            visibility: visible !important;
            left:0px !important;
        }
        .footer {
            position: static !important;;
        }
        .mce-flow-layout-item.mce-last {
            margin-right: 2px;
            display: none !important;
        }
        a {
            color: #0378AD;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div id="main">

    <!-- LEFT SIDEBAR -->
    <div id="slide-out-left" class="side-nav">

        <!-- Form Search -->
        <div class="top-left-nav">
            <?php include(APPPATH.'/views/mobile/layout/search.php'); ?>
        </div>
        <!-- End Form Search -->

        <!-- App/Site Menu -->
        <div id="main-menu">
            <?php include(APPPATH.'/views/mobile/layout/nav.php'); ?>

        </div>




        <!-- End Site/App Menu -->

    </div>
    <!-- END LEFT SIDEBAR -->

    <!-- RIGHT SIDEBAR -->
    <div id="slide-out-right" class="side-nav">

        <?php include(APPPATH.'/views/mobile/layout/compare-blogs.php'); ?>

    </div>
    <!-- END RIGHT SIDEBAR -->

    <!-- MAIN PAGE -->
    <div id="page">

        <!-- FIXED Top Navbar -->
        <div class="top-navbar">
            <?php include(APPPATH.'/views/mobile/layout/top.php'); ?>
        </div>
        <!-- End FIXED Top Navbar -->


        <!-- End Featured Slider -->

        <!-- CONTENT CONTAINER -->
        <div class="content-container">

        <h1 class="page-title">Checkout</h1>




        <!-- END Summary of total payment payment -->

        <!-- Cart Item Summary -->
        <div class="page-block checkout-shipping-block">

            <h2 class="block-title">
                <span>Item Summary</span>
            </h2>
            <div id="qty-dialog"></div>
            <!-- Cart Item List -->
            <ol class="cart-item">

                <li><!-- Cart Item #1 -->
                    <div class="thumb">
                        <img  src="<?="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image']?>"
                              alt="<?=$productDetails[0]['title'];?>"  class="img-responsive"/>
                    </div>
                    <div class="cart-delete">
                        <a href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                    <div class="cart-detail">
                        <h3 class="product-name"><a href="product.html"> <?=$productDetails[0]['title'];?></a></h3>
                        <div class="price">
                            <span>Price</span> <?php echo $currencySymbol ?>.<?=number_format((float)$productDetails[0]['price']*
                                $currencyRate, 2, '.', '')?>
                        </div>
                        <input type="hidden"  id="orderprice" value="<?=number_format((float)$productDetails[0]['price']*$currencyRate, 2, '.', '')?>"/>
                        <div class="qty">
                            <span>Qty</span>  <input type="number" style="width:50px"  id="quantity" min="<?=$qty?>"
                                                     max="1000000"  onchange="return calcorder(this.value,'<?=$productDetails[0]['id']?>')"
                                                     value="<?=$qty;?>">
                        </div>
                    </div>
                </li><!-- End Cart Item #1 -->



            </ol>
            <!-- End Cart Item List -->

        </div>
        <!-- END Item Cart Summary -->
        <!-- Coupon & Promo Section -->
        <div class="page-block checkout-shipping-block">

            <h2 class="block-title">
                <span>Contact Information</span>
            </h2>

            <div class="col-md-4 ">
                <form class="register-form" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input" value="<?php  echo $memD[0]['firstname'];?> <?php  echo ' '.$memD[0]['lastname'];?>" id="exampleInputName" placeholder="">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form class="register-form" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Your Email <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input" value="<?php echo $memD[0]['email'];?>" id="email" placeholder="">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form class="register-form" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputTitle">Phone <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $memD[0]['phone'];?>" id="phone-number" placeholder="">

                    </div>
                </form>
            </div>
        </div>
        <!-- END Coupon & Promo Section -->
        <!-- Coupon & Promo Section -->
        <div class="page-block checkout-shipping-block">

            <h2 class="block-title">
                <span>Shipping Information</span>
            </h2>


            <div class="row edit-margin">

                <div class="col-sm-6" >
                    <input type="radio" id="blazebay" class="modeofshipping" onchange="return setmethod('blazebay')"
                           value="blazebay" name="method" checked> <label class="control-label" for="recipient-name"> &nbsp;<b> Use courier services</b>
                    </label>
                </div>
                <div class="col-sm-6" ><input type="radio" id="self" class="modeofshipping"   onchange="return setmethod('self')"
                                              value="self" name="method" ><label class="control-label" for="recipient-name">&nbsp;<b>
                            Pick  from  supplier</b> </label>
                </div>
            </div>

            <div class="row edit-margin" id="blazebay-means">


                <input type="text" class="form-control unicase-form-control text-input" value="" id="phone-number" placeholder="shipping location">

                <div class="col-md-12 ">
                        <form class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Shipping Address <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="exampleInputComments"><?php echo $memD[0]['street'];?></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- END Coupon & Promo Section -->


        <!-- Summary of total payment payment (Collapsible) -->
        <ul class="collapsible payment-summary" data-collapsible="accordion">
            <li>
                <div class="collapsible-header">
                    <span class="fa fa-caret-right"></span>
                    <div class="summary-item">
                        <span class="desc bold">Payment Total</span>
                        <span class="value bold">ksh.  <?=ceil(number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty);?></span>
                    </div>
                </div>
                <div class="collapsible-body">
                    <!--                    <div class="summary-item">-->
                    <!--                        <span class="desc">Shopping Total</span>-->
                    <!--                        <span class="value">ksh. 172.90</span>-->
                    <!--                    </div>-->
                    <!--                    <div class="summary-item">-->
                    <!--                        <span class="desc">Shipping Cost</span>-->
                    <!--                        <span class="value">ksh. 182.90</span>-->
                    <!--                    </div>-->
                    <!--                    <div class="summary-item">-->
                    <!--                        <span class="desc">Handling Fee</span>-->
                    <!--                        <span class="value">Free</span>-->
                    <!--                    </div>-->
                    <!--                    <div class="summary-item">-->
                    <!--                        <span class="desc">Voucher & Promo</span>-->
                    <!--                        <span class="value">Free</span>-->
                    <!--                    </div>-->
                </div>
            </li>
        </ul>

        <!-- Payment Method Section -->
        <div class="page-block checkout-shipping-block">

            <h2 class="block-title">
                <span>Payment Method</span>
            </h2>
            <div class="row">

                <div class="col-sm-4" >
                    <input type="radio" id="blazebay" class="modeofshipping"  onchange="return setcheked(1)"
                           value="blazebay" name="method" checked> <label class="control-label" for="recipient-name">Mpesa <img src="<?=base_url()?>assets/images/payments/5.png" alt="">
                    </label>
                </div>
                <div class="col-sm-6" ><input type="radio" id="self" class="modeofshipping"  onchange="return setcheked(4)"
                                              value="self" name="method" ><label class="control-label" for="recipient-name"> Card <img src="<?=base_url()?>assets/images/payments/3.png" alt="">
                        <img src="<?=base_url()?>assets/images/payments/4.png" alt=""></label>
                </div>
                <div class="col-sm-6" ><input type="radio" id="self" class="modeofshipping" onchange="return setcheked(3)"
                                              value="self" name="method" ><label class="control-label" for="recipient-name">NURUCOIN <img src="<?=base_url()?>assets/images/payments/2.png" alt=""></label>
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
                    <div id="nurucoin" style="display:none"></div>
                    <div id="card" style="background-color: #f0f8ff;padding: 10px; display:none">

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
        <!-- END Payment Method Section -->



        </div>
        <!-- END CONTENT CONTAINER -->

    <div id="loginm" class="modal fade" aria-hidden="true" style="margin-top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 15%">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">

                    <div class="hr-line-dashed"></div>
                    <div class="row">

                        <div class="col-sm-12 ">
                            <form method="post"  action="">
                                <div class="row">

                                    <div class="col-sm-12 col-xs-12 homemodal-invalidLogin">

                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <div class="col-sm-12 col-xs-12 homemodal-username-invalidLogin"></div>
                                        <div class="form-group">

                                            <input name="username"  id="modal-homeusername" required="" class="form-control" placeholder="Enter Username/ Email" type="text"></div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="col-sm-12 col-xs-12 homemodal-password-invalidLogin"></div>

                                        <input name="password" id="modal-homepassword" class="form-control" required="" placeholder="Enter Password" type="password"> </div>
                                </div>

                                <div class="col s12 ">
                                    <div class="col s6">
                                        <button class="btn btn-upper blazecolor btn-block" type="button"   onclick="return modallogin()">Login</button>

                                    </div>
                                    <div class="col s6"> <button class="btn btn-upper blazecolor2 btn-block" type="button"   onclick="return modalcancel2()">Cancel</button></div>

                                    <div class="col 12">
                                        <br><a href="<?php echo base_url();?>forgot-password" target="_blank">Forgot password?</a></div>

                                    <div class="col s12"><small>Dont have an account?</small><a href="<?php echo base_url();?>register" target="_blank">&nbsp;Register</a></div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
        <!-- FOOTER -->
        <div class="footer">

            <!-- Footer main Section -->
            <?php include(APPPATH.'/views/mobile/layout/footer-bottom.php'); ?>
            <!-- End Copyright Section -->

        </div>
        <!-- End FOOTER -->

        <!-- Back to top Link -->
        <div id="to-top" class="main-bg"><i class="fa fa-long-arrow-up"></i></div>

    </div>
    <!-- END MAIN PAGE -->

</div><!-- #main -->

<?php include(APPPATH.'/views/mobile/layout/footer.php'); ?>



<script src="<?=base_url()?>assets2/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?=base_url()?>assets2/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="<?=base_url()?>assets/js/stripe.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-modal.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-modalmanager.min.js"></script>

<script>tinymce.init({
        selector: '#textarea',
        height: 50,
        theme: 'modern',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

</script>
<script>

function modalcancel2(){
    RedirectUrl="<?=base_url()?>";
    window.location.href=RedirectUrl;
}
function calcorder(id,productId){


    var  price = $('#orderprice').val();
    var  shippingamount = $('#shipping-hidden').val();
    var  qty = id;
    var minqty='<?php echo $qty ?>';
    if(qty > minqty){
        qty =qty;
    }else{
        //console.log(qty < minqty)

        $('#quantity').val(minqty);
        new Noty({
            type: 'info',
            timeout: 10000,
            text     : 'Product minimum order quantity is '+'<?php echo $qty ?>',
            container: '#qty-dialog'
        }).show();
        qty =minqty
    }

    totalprice = price*qty;
    var grandtt=0+totalprice + +shippingamount;
    var currencysymbol='<?php echo $currencySymbol ?>';

    $('.subtotal').html(currencysymbol+' '+ Math.ceil(totalprice.toFixed()));
    $('.subtotal-sam').html(currencysymbol+' '+ Math.ceil(totalprice.toFixed()));
    $('.grandtotal-sam').html( Math.ceil(totalprice.toFixed()));
    $('.grandtotal-sam2').html(currencysymbol+' '+ Math.ceil(totalprice.toFixed()));
    $('.grandtotalsummary').val( Math.ceil(totalprice.toFixed()));

    $('.orderqty').html(qty);
    $('#paymentAmount').val( Math.ceil(totalprice.toFixed()));



    var Url="<?php echo base_url().'temporders' ;?>";
    data={
        qty:qty,
        productId:productId
    };
    $.post(Url,data,function(data){},'json');

}

function checkuserfirst() {

    var user='<?php echo $user_id?>';
    if (user=='' || user== null) {
        $('#loginm').modal('show');
    }else{
        var quantity= '<?php echo  $productqty ? $productqty :$product_minimum_qty ;?>';
        var productId='<?php echo $product_id ;?>';

    }
}
function getTotalamount(){
    var amount=$('.grandtotalsummary').val();
    var shipping=$('#shipping-hidden').val();
    var grandtotal = +amount + +shipping;
    var currencyinUSD='<?=$currencyRate?>';
    var paypalamount=grandtotal/currencyinUSD;

    return paypalamount.toFixed(2);
}

function getCouriors(){
    var country = $('#country').val();
    var state = $('#state').val();
    var city = $('#city').val();
    var productId="<?php echo $product_id;?>";
    var  qty = $('#quantity').val();

    var shippingstmodes =$("#shipping-mode").find(":selected").val();


    if(country!="" && state!="" && city!="" ){

        var dataPost= {
            'country': country,
            'state': state,
            'city': city,
            'productId': productId,
            'qty': qty,
            'shippingstmodes': shippingstmodes
        }
        $.ajax({
            type:'POST',
            url:"<?=base_url()?>fetcuriors",
            data:dataPost,
            dataType: 'html',
            success: function (data) {

                var result = JSON.parse(data);
                if(result.price===0 && result.curier_id===0){

                    new Noty({
                        type: 'info',
                        timeout: 3000,
                        text     : 'No couriers available on this route you have selected',
                        container: '#shipings-msg-dialog'
                    }).show();

                    $('.collapseFive').click(function () {return false;});
                    $('.shipping-amt').hide();
                    $('.shipping-amount').hide();
                    calcorder(qty,productId)
                } else {

                    $('.collapseFive').unbind('click');

                    var total = $('#orderprice').val();
                    var priceandquantity = total * qty

                    var grandtotal = +priceandquantity + +result.price;
                    var currencysymbol='<?php echo $currencySymbol ?>';
                    $('.shipping-amt').show();
                    $('.shipping-amount').show();
                    $('.shipping-amount').html(result.price);
                    $('#shipping-hidden').val(result.price);
                    $('.subtotal-sam').html(currencysymbol +' ' + priceandquantity.toFixed());
                    $('.grandtotal-sam2').html(currencysymbol+' ' + grandtotal.toFixed());
                    $('.grandtotal-sam').html( Math.ceil(grandtotal.toFixed()));
                    $('.grandtotalsummary').val( Math.ceil(totalprice.toFixed()));
                    $('#shippingcourier_id').val(result.curier_id);
                    $('#shippingamount').val(result.price);
                    $('#curiername').val(result.company_name);

                    $('#totalproductprice').val(priceandquantity.toFixed());
                    $('#totalAmount').val( Math.ceil(grandtotal.toFixed()));
                    $('#paymentAmount').val( Math.ceil(grandtotal.toFixed()));




                }
            }
        });

    }else{
        new Noty({
            type: 'info',
            timeout: 2000,
            text     : 'No couriers available on this route you have selected',
            container: '#shiping-msg-dialog'
        }).show();
    }

}
function setmethod(method){
    if(method=='self') {
        $('.collapseFive').unbind('click');
        $("#blazebay-means").hide();
    }else{
        $("#blazebay-means").show();
    }

}

function veryfyMpesa(){
    var base_url="<?php echo base_url();?>";
    var ctr_url="<?php echo base_url();?>validateMpesa";
    var mcode=$('#mpesacode').val();
    $('#mpesacodesent').val(mcode);




    var data = new FormData($('#orderForm')[0]);
    var mpesacode = $('#mpesacode').val();
    if(mpesacode==""){
        new Noty({
            type: 'error',
            timeout: 2000,
            text     : 'Please enter MPESA code',
            container: '#mpesaerrors'
        }).show();
    }else{
        $.ajax({
            url: ctr_url,
            type: "POST",
            data: data,
            async: false,
            success: function (msg) {
                if(msg==0){
                    new Noty({
                        type: 'error',
                        timeout: 2000,
                        text     : 'Verification failed,Please try again',
                        container: '#mpesaerrors'
                    }).show();
                } else{

                    var SuccessMsg="Your Order Placed Successfully.Your Order Number is"+ " "+ msg;
                    new Noty({
                        type: 'success',
                        timeout: 50000,
                        text     :SuccessMsg ,
                        container: '#mpesaerrors'
                    }).show();
                    setTimeout(function () {
                        location.href=base_url+"buyer-orderlist/";
                    }, 8000);

                }

            },
            cache: false,
            contentType: false,
            processData: false
        });

    }
}

function tabselector(prevtab,nexttab){
    $('#'+prevtab).collapse('hide');
    $('#'+nexttab).collapse('show');
}

function extracustomerdetails(){
    var url="<?php echo base_url();?>gextracustomerdetails";
    var productId="<?=$productDetails[0]['id']?>";
    $.ajax({
        url: url,
        type: "POST",
        async: false,
        data: {productId:productId},
        success: function (data) {
            if (data !=0) {
                $('#order-commentest').show();
                $('#order-commentest').html(data);
            } else {
                $('#order-commentest').hide();
            }
        }
    });
}
</script>
<script>
    function userLogin() {

        var username= $("#username").val();
        var password=$("#password").val();

        if(username==""){
            new Noty({
                type: 'error',
                timeout: 500,
                text     : 'Please enter your username or email',
                container: '.usernameerror'
            }).show();

        }
        else if(password==""){
            new Noty({
                type: 'error',
                timeout: 500,
                text     : 'Please enter your password',
                container: '.passworderr'
            }).show();

        }else{


            var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
            var RedirectUrl="<?php echo base_url().'login' ;?>";
            var userUrl="<?php echo base_url().'dashboard' ;?>";
            $.ajax({
                type: "POST",
                url: ctrlUrl,
                data:({
                    username: username,
                    password: password
                }),
                cache
                    :
                    false,
                success
                    :
                    function (data) {

                        //alert(data);
                        if (data ==10) {
                            new Noty({
                                type: 'warning',
                                timeout: 3000,
                                text     : 'Your account is not activated',
                                container: '.invalidLogin'
                            }).show();
                            //window.location.href=RedirectUrl;
                        }
                        else if (data==1||data==2||data==3||data==4){

                            new Noty({
                                type: 'info',
                                timeout:3000,
                                text     : 'Success',
                                container: '.invalidLogin'
                            }).show();

                            window.location=userUrl;
                        }
                        else{
                            new Noty({
                                type: 'error',
                                timeout: 30000,
                                text     : 'Oops!.Invalid Credentials',
                                container: '.invalidLogin'
                            }).show();

                            window.location.reload;
                        }
                    }
            });
        }
    }
    $(document).ready(function(){
        $('input[name="usertype"]').click(function() {
            if($('input[name="usertype"]:checked')) {
                if($(this).attr('value') == 1) {
                    $('#company-floorarea').hide();
                    $('#signup-fieldsnot-forcourier').hide();
                }else if($(this).attr('value') == 2) {
                    $('#company-floorarea').show();
                    $('#signup-fieldsnot-forcourier').show();

                }else if($(this).attr('value') == 4) {
                    $('#company-floorarea').show();
                    $('#signup-fieldsnot-forcourier').hide();

                }
            }
            //$("#company-floor-areaid").attr('style','display: block');
        });
    });
    function checkAvailability() {
        var base_url="<?php echo base_url();?>";
        $("#loaderIcon").show();
        jQuery.ajax({
            url: base_url+"checkusername_availability",
            data:'username='+$("#username").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }

    function checkEmailAvailability() {
        //$("#loaderIcon1").show();
        var base_url="<?php echo base_url();?>";
        jQuery.ajax({
            url: base_url+"checkEmailAvailability",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status1").html(data);
                //$("#loaderIcon1").hide();
            },
            error:function (){}
        });
    }
    function register(){



        var base_url="<?php echo base_url();?>";

        var data =$('#signup_form').serialize()
        $.ajax({
            url: base_url+"processsignup",
            data:data,
            type: "POST",
            success:function(response){
                var data=JSON.parse(response);
                var msg=data.msg;
                var code=data.code;

                if(code==1){

                    new Noty({
                        type: 'info',
                        timeout: 100000,
                        text     : msg,
                        container: '.register-msg'
                    }).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    setTimeout(function () {
                        location.href=base_url+"login";
                    }, 4000);
                }
                else if(code==2){
                    new Noty({
                        type: 'error',
                        timeout: 100000,
                        text     : msg,
                        container: '.register-msg'
                    }).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
                else{

                    new Noty({
                        type: 'error',
                        timeout: 100000,
                        text     : msg,
                        container: '.register-msg'
                    }).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
            },
            error:function (){}
        });

    }
</script>

<script>
    $(document).ready(function(){

        $("#login-modal-button").click(function(e) {
            e.preventDefault();
            var username= $("#modal-username").val();
            var password=$("#modal-password").val();

            if(username==""){
                new Noty({
                    type: 'error',
                    timeout: 6000,
                    text     : 'Please enter your username or email',
                    container: '.modal-username-invalidLogin'
                }).show();

            }
            else if(password==""){
                new Noty({
                    type: 'error',
                    timeout: 6000,
                    text     : 'Please enter your password',
                    container: '.modal-password-invalidLogin'
                }).show();

            }else{


                var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
                var RedirectUrl="<?php echo base_url().'login' ;?>";
                var userUrl="<?php echo base_url().'dashboard' ;?>";

                $.ajax({
                    type: "POST",
                    url: ctrlUrl,
                    data:({
                        username: username,
                        password: password
                    }),
                    cache
                        :
                        false,
                    success
                        :
                        function (data) {

                            //alert(data);
                            if (data ==10) {
                                new Noty({
                                    type: 'warning',
                                    timeout: 60000,
                                    text     : 'Your account is not approved',
                                    container: '.modal-invalidLogin'
                                }).show();
                                //window.location.href=RedirectUrl;
                            }
                            else if (data==1||data==2||data==3||data==4){
                                new Noty({
                                    type: 'success',
                                    timeout: 100000,
                                    text     : 'Success',
                                    container: '.modal-invalidLogin'
                                }).show();
                                $('#loginm').modal('toggle');
                                window.location.reload();
                            }
                            else{
                                new Noty({
                                    type: 'error',
                                    timeout: 60000,
                                    text     : 'Oops!.Invalid Credentials',
                                    container: '.modal-invalidLogin'
                                }).show();

                                window.location.reload;
                            }
                        }
                });
            }
        });

        checkuserfirst();

        var replymsg="<?=$replydata[0]['message']?>";
        if(replymsg!=""){
            $('.collapseTwo').unbind('click');
            $('.collapseThree').unbind('click');
            $('.collapseFive').unbind('click');
        }else {
            $('.collapseTwo').click(function () {
                return false;
            });
            $('.collapseThree').click(function () {
                return false;
            });
            $('.collapseFive').click(function () {
                return false;
            });
        }

    });
    function checkuserfirst() {



        var user='<?php echo $user_id?>';


        if (user=='' || user== null) {

            $('#loginm').modal('show');
        }else{
            var quantity= '<?php echo  $productqty ? $productqty :$product_minimum_qty ;?>';
            var productId='<?php echo $product_id ;?>';

        }
    }

    function sendNegoreply(){
        var base_url="<?php echo base_url();?>";
        var contactmessage=tinyMCE.get('description').getContent();
        var reply_id=$('#reply-id').val();
        var message=$('#message').val();
        var subject=$('#subject').val();
        var customerId=$('#customerId').val();
        if(contactmessage=== undefined || contactmessage.length == 0){
            new Noty({
                type: 'error',
                timeout: 30000,
                text     : 'Oops!.Please enter a reply message',
                container: '.displaynegoMessage'
            }).show();

        }
        else {
            var replyId='<?=$supplierData[0]['id']?>';
            $.ajax({
                url: base_url + "processreplymsg",
                type: "POST",
                data: {replyId:replyId,message: contactmessage,subject: subject},
                dataType: "json",
                success: function (msg) {
                    if (msg == 1) {
                        new Noty({
                            type: 'info',
                            timeout: 30000,
                            text: 'Success,reply sent successfully',
                            container: '.displaynegoMessage'
                        }).show();
                        $("html, body").animate({scrollTop: 0}, "slow");

                    } else {
                        new Noty({
                            type: 'error',
                            timeout: 30000,
                            text: 'Error! something went wrong,we are resolving it shortly',
                            container: '.displaynegoMessage'
                        }).show();
                    }
                }
            });

        }
    }
</script>

</body>
</html>