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
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>

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
<div class="col-md-8">
    <?php if(isset($code) && $code==0){?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh snap!</strong> An error occurred on payment,please try again.
        </div>
    <?php } ?>
    <div class="panel-group checkout-steps" id="accordion">

        <!-- checkout-step-01  -->
        <div class="panel panel-default checkout-step-01">

            <!-- panel-heading -->
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="" id="tab1" data-parent="#accordion" href="#collapseOne">
                        <span>1</span>Order Review
                    </a>
                </h4>
            </div>
            <!-- panel-heading -->
            <?php include('order-review.php'); ?>
        </div>
        <!-- checkout-step-01  -->

        <!-- checkout-step-02  -->
        <div class="panel panel-default checkout-step-02">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed"  id="tab2" data-parent="#accordion" href="#collapseTwo">
                        <span>2</span>Your Information
                    </a>
                </h4>
            </div>
            <?php include('customer-info.php'); ?>
        </div>
        <!-- checkout-step-02  -->

        <!-- checkout-step-03  -->
        <div class="panel panel-default checkout-step-03">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed" id="tab3" data-parent="#accordion" href="#collapseThree">
                        <span>3</span>Shipping Information
                    </a>
                </h4>
            </div>
            <?php include('shipping-details.php'); ?>
        </div>
        <!-- checkout-step-03  -->


        <!-- checkout-step-05  -->
        <div class="panel panel-default checkout-step-05">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed collapseFive" id="tab3"  data-parent="#accordion" href="#collapseFive">
                        <span>4</span>Payment Information
                    </a>
                </h4>
            </div>
            <?php include('payments.php'); ?>
        </div>
        <!-- checkout-step-05  -->



    </div><!-- /.checkout-steps -->
</div>
<div class="col-md-4">
    <!-- checkout-progress-sidebar -->
    <?php include('order-summary.php');
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
    <input type="hidden"  name="productcurrency" value="<?php echo $currencySymbol ?>"/>
    <input type="hidden"  name="transactId" id="transactId" value="" />
    <input type="hidden"  name="paymode" id="paymode" value="" />
        <input type="hidden"  name="callbackUrl" id="callbackUrl" value="<?=$_SERVER['REQUEST_URI']?>" />
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
<script src="<?=base_url()?>assets2/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?=base_url()?>assets2/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="<?=base_url()?>assets/js/stripe.js."></script>



<script>
    tinymce.init({
        selector: '#order-more-details',
        init_instance_callback: function (editor) {
            editor.on('mouseleave ', function (e) {
              var productId="<?=$productDetails[0]['id']?>";
             var url="<?=base_url()?>postextraordersdetails";
             var deatils=editor.getContent();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {details:deatils,productId:productId},
                    async: false,
                    success: function (data) {
                        extracustomerdetails()
                    }
                });
            });
        },
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
    function minisite(){
        var minisite='https://'+'<?=strtolower($productData[0]["minisite_prefix"])?>' +'.blazebay.com';
        window.open(minisite,'_blank');
    }
</script>
<script>
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
            $('#loginp').modal('show');
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
        $(document).ready(function(){
            extracustomerdetails();
            $('.shipping-amt').hide();

            $('.collapseFive').click(function () {return false;});
//            var id = $('#accordion .in').parent().attr("id");
//            if(id=='collapseTwo'){
//                var phone= $("#phone-number").val();
//                if(phone==""){
//                    alert('number cannot be empty')
//                }
//            }
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
                                        container: '.invalidLogin'
                                    }).show();
                                    $('#loginp').modal('toggle');
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
            $('#nurucoin').hide();
            $('#paypal').hide();
            $('#card').hide();

            $('#color-dropdown').on('change',function(){
                $('.ordercolor').html('<span class="ordercolor">'+this.value +'</span>');
                $('#customercolor').val(this.value);
            });
            $('#size-dropdown').on('change',function(){
             $('.ordersize').html('<span class="ordersize">'+this.value +'</span>');
             $('#customersize').val(this.value);

            });

            $('#shipping-mode').on('change',function(){
                var country = $('#country').val();
                var state = $('#state').val();
                var city = $('#city').val();
                if(country!="" && state!="" && city!=""){
                    getCouriors()
                }
            });

            var base_url='<?php echo base_url();?>';
            $('#country').on('change',function(){
                var country = $('#country').val();
                var state = $('#state').val();
                var city = $('#city').val();
                if(country!="" && state!="" && city!=""){
                    getCouriors()
                }
                shr_last_valid_selection = $(this).val();

                var datastring={'multiple':'multiselect','multi_country_id':shr_last_valid_selection}
                $.ajax({
                    type:'POST',
                    url:base_url+"fetstates",
                    data:datastring,
                    dataType: 'html',
                    success: function (data) {

                        var result = $.trim(data);

                        if (result == '<option value="">Select States</option>') {

                            $("#state").empty();

                        } else {

                            $("#state").empty();

                            $('#state').css('display', 'block');
                            $('#state').html(data);

                        }



                    }
                });
            });




            $('#state').on('change',function(){

                var state = $('#state').val();
                var country = $('#country').val();
                var city = $('#city').val();
                if(country!="" && state!="" && city!=""){
                    getCouriors()
                }
                var datastring={'multiple':'multiselect','multi_country_id':state}
                $.ajax({
                    type:'POST',
                    url:base_url+"fetcities",
                    data:datastring,
                    dataType: 'html',
                    success: function (data) {

                        var result = $.trim(data);

                        if (result == '<option value="">Select Cities</option>') {

                            $("#city").empty();

                        } else {
                            $("#city").empty();

                            $('#city').css('display', 'block');
                            $('#city').html(data);

                        }



                    }
                });
            });


            $('#city').on('change',function(){

              getCouriors();


            });
        });




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