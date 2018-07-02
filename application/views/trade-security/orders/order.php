<?php
$where="id='$product_id'";
$productDetails= $this->Site_model->getDataById( $table = "bt_products", $where );


if(isset($this->session->userdata['logged_in']['user_id'])){
    $user_id=$this->session->userdata['logged_in']['user_id'];
    $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
    $memD= $this->Site_model->getDataById( 'bt_members', $where );
}else{
    $user_id='';
    $where="user_id=1310";
    $memD= $this->Site_model->getDataById( 'bt_members', $where );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>
	 <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <?php include(APPPATH.'/views/layout/mainheader.php'); ?>
        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <?php include(APPPATH.'/views/layout/menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
<div class="body-content">
<div class="container">
<div class="checkout-box ">
<div class="row">
<div class="col-md-12">

    <div class="panel-group checkout-steps" id="accordion">
        <!-- checkout-step-01  -->
        <div class="panel panel-default checkout-step-01">

            <!-- panel-heading -->
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                        <span>1</span>Contract
                    </a>
                </h4>
            </div>
            <!-- panel-heading -->
            <?php include('contract.php'); ?>
            <!-- row -->

        </div>
        <!-- checkout-step-01  -->

        <!-- checkout-step-03  -->
        <div class="panel panel-default checkout-step-02">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed collapseTwo" data-parent="#accordion" href="#collapseTwo">
                        <span>2</span>Payments
                    </a>
                </h4>
            </div>

            <?php include('payments.php'); ?>
        </div>
        <!-- checkout-step-03  -->


        <!-- checkout-step-05  -->
        <div class="panel panel-default checkout-step-03">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed collapseThree" data-parent="#accordion" href="#collapseThree">
                        <span>3</span>Customer Reviews
                    </a>
                </h4>
            </div>
            <?php include('order-customer-review.php'); ?>

        </div>
        <!-- checkout-step-05  -->



    </div><!-- /.checkout-steps -->
</div>
<div class="col-md-0">
    <!-- checkout-progress-sidebar -->
    <?php
     //include('order-summary.php');
    $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
    $mem= $this->Site_model->getDataById( 'bt_members', $where );
    //print_r($mem);
    ?>
    <!-- checkout-progress-sidebar -->
    <form name="orderForm" id="orderForm" action="#" method="post">
    <input type="hidden"  name="productId" value="<?=$productDetails[0]['id']?>"/>
    <input type="hidden"  name="customercolor" value="<?php echo $color ? $color:'';?>"/>
    <input type="hidden"  name="customersize" value="<?php echo $size ? $size:'';?>"/>
    <input type="hidden"  id="productqty" name="qty" value="<?php echo $qty;?>"/>
    <input type="hidden"  name="shipping" id="shippingcourier_id" value=""/>
    <input type="hidden"  id="shippingamount" class="shippingamount" name="shippingamount" value=""/>
    <input type="hidden"  name="productprice" value="<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>"/>
    <input type="hidden"  name="totalproductprice" value="<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>"/>
    <input type="hidden"  id="totalAmount" name="totalAmount" value=""/>
    <input type="hidden"  name="productcurrency" value="Ksh"/>
    <input type="hidden"  name="transactId" id="transactId" value="" />
    <input type="hidden"  name="paymode" id="paymode" value="" />
    <input type="hidden"  name="mpesacode" id="mpesacodesent" value="" />
    <input type="hidden"  name="paymentAmount" id="paymentAmount" value="<?=number_format((float)$productDetails[0]['price']* $currencyRate, 2, '.', '')*$qty;?>" />
    <input type="hidden"  name="MpesaAccount" id="MpesaAccount" value="<?=$c_pay_number?>" />

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


    </form>
</div>
</div><!-- /.row -->
</div><!-- /.checkout-box -->
</div><!-- /.container -->
</div><!-- /.body-content -->
<!-- ==

    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">


        <?php include(APPPATH.'/views/layout/footerbottom.php'); ?>
        <?php include(APPPATH.'/views/layout/copyright.php'); ?>

    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->


    <!-- For demo purposes – can be removed on production -->


    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <?php include(APPPATH.'/views/layout/footer.php'); ?>
<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>

    <script>


        $( document ).ready(function() {

            $('.collapseTwo').click(function () {
                return false;
            });
            $('.collapseThree').click(function () {
                return false;
            });

        });
        function checkFileuploaded(){

            var email=$("#supplier-email").val();
            if(email!="") {
                checkQouteAvailability()
                if (document.getElementById("contractUploadFile").files.length == 0) {
                    $("#agreement2").show();
                    $('.collapseTwo').click(function () {
                        return false;
                    });
                    $('.collapseThree').click(function () {
                        return false;
                    });
                } else {
                    $("#agreement2").hide();
                    $('.collapseTwo').unbind('click');
                    $('.collapseThree').unbind('click');
                }
            }
        }
        function checkQouteAvailability() {
      var quote_no=$("#qoute_number").val();
            if(quote_no=""){
                $("#quoteserror").show();
                $('.collapseTwo').click(function () {
                    return false;
                });
                $('.collapseThree').click(function () {
                    return false;
                });
            }else {
            var base_url = "<?php echo base_url();?>";
                if(document.getElementById("contractUploadFile").files.length ==0){
                    $("#agreement2").show();
                    $('.collapseTwo').click(function () {
                        return false;
                    });
                    $('.collapseThree').click(function () {
                        return false;
                    });
                }else{
                    $("#agreement2").hide();
                }


                $("#loaderIcon").show();
            jQuery.ajax({
                url: base_url + "checkQouteAvailability",
                data: 'qoute_no=' +$("#qoute_number").val(),
                type: "POST",
                success: function (data) {

                    if (data == 0) {
                        $("#quoteserror2").show();
                        $("#loaderIcon").hide();
                        $('.collapseTwo').click(function () {
                            return false;
                        });
                        $('.collapseThree').click(function () {
                            return false;
                        });
                        $('#products-id').val("");
                        $('#produsts-data').html("");
                    } else {
                        var results=JSON.parse(data);
                        $("#quoteserror").hide();
                        $("#quoteserror2").hide();

                        var product_data=results[0].product_number;

                        $("#products-id").val(product_data);

                        $("#total-order-amount").val(results[0].product_price),
                        $('.collapseTwo').unbind('click');
                        $('.collapseThree').unbind('click');
                        $("#user-availability-status").hide();
                        $("#user-availability-status2").show();
                        $("#loaderIcon").hide();
                        agreedProducts(results[0].qnty,results[0].product_price)
                    }

                },
                error: function () {
                }
            });
        }
        }

        function agreedProducts(qty,price) {
            var product_id=$('#products-id').val();
            if(product_id=""){
                $('#produsts-data').html(" ");
            }else{
                var base_url="<?php echo base_url();?>";
                jQuery.ajax({
                    url: base_url+"agreedProducts",
                    data:{product_id: $('#products-id').val(),product_price:price,product_qty:qty},
                    type: "POST",
                    success:function(data){
                     $('#produsts-data').html(data);
                    },
                    error:function (){}
                });
            }

        }
        function checkbalance(paid_amount){

            var order_amount=$('#total-order-amount').val();
            var bal=order_amount-paid_amount;

            $("#agreed_balance").val('ksh'+' '+ Math.ceil(bal.toFixed()));
        }

        function calagreedcorder(){
            var  agreed_price = $('#agreed_price').val();
            var  agreed_qty = $('#agreed_qty').val();


            totalprice = agreed_qty*agreed_price;
            var subtotal=0+totalprice;

            $("#total-order-amount").val('ksh'+' '+ Math.ceil(subtotal.toFixed()));
            $('#agreed_subtotal').val('ksh'+' '+ Math.ceil(subtotal.toFixed()));
              }
        function checkSupplierAvailability() {


            var base_url="<?php echo base_url();?>";
            $("#loaderIcon").show();
            jQuery.ajax({
                url: base_url+"checksupplierEmailAvailability",
                data:'email='+$("#supplier-email").val(),
                type: "POST",
                success:function(data){
                    if(data==0){
                        $("#user-availability-status").show();
                        $("#user-availability-status2").hide();
                        $("#loaderIcon").hide();
                        $('.collapseTwo').click(function () {return false;});
                        $('.collapseThree').click(function () {return false;});
                    }else{
                        $('.collapseTwo').unbind('click');
                        $('.collapseThree').unbind('click');
                        $("#user-availability-status").hide();
                        $("#user-availability-status2").show();
                        $("#loaderIcon").hide();
                    }

                },
                error:function (){}
            });
        }

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            startDate: '-0d',
            autoclose: true
        })


		
		 function getTotalamount(){
             var amount=$('#initial-payment').val();
             var order_amount=$('#total-order-amount').val();
             var total="";
             if(amount==""){
                 total=order_amount;
             }else{
                 total=amount;
             }
            var currencyinUSD='<?=$currencyRate?>';
            var paypalamount=total/currencyinUSD;

            return paypalamount.toFixed(2);
        }
		  paypal.Button.render({
            env:'production',// 'production', // Or 'sandbox',

            commit: true, // Show a 'Pay Now' button

            style: {
                color: 'gold',
                size: 'large'
            },
            client: {
                sandbox: 'Afi_hd56pLSO9jrdBdikdD5tsNwTvvrsAeom8FaKD9sUbCtzDWgN1uAVpxANV5wRsVbFOB8BtRB-we6N',
                production: 'AWZHYW4npfqwmgk-PEnL4TSNvJbhW0dT9QL1Eo5npQbhBOPTo1o9aVOdqNlxd-ZXsZDs6bjs90SMIjgN'
            },

            commit: true, // Show a 'Pay Now' button

            payment: function (data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {

                                amount: {total:getTotalamount(), currency: 'USD'}
                            }
                        ]
                    }
                });
            },


            onAuthorize: function (data, actions) {
                return actions.payment.execute().then(function (payment) {
                    if (payment.state==="approved") {
                        console.log(payment)
                        var tranId=payment.Id;
                        $("#transactId").val(tranId);
                        $("#paymode").val("Paypal");
                        var base_url="<?php echo base_url();?>";
                        var formData = new FormData($('#orderForm')[0]);

                        $.ajax({
                            url: base_url+"processMakeanOrder",
                            type: "POST",
                            data: formData,
                            async: false,
                            success: function (msg) {
                                location.href=base_url+"buyer-orderlist/";
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });

                        e.preventDefault();
                    }
                });
            },

            onCancel: function (data, actions) {
                $('#paypal-error').removeClass('hidden');
            },

            onError: function (err) {
                $('#paypal-error').removeClass('hidden');
            }

        }, '#paypal');

    </script>


</body>
</html>