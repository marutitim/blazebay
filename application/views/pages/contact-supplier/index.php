<?php

if(isset($this->session->userdata['logged_in']['user_id'])){
    $user_id=$this->session->userdata['logged_in']['user_id'];
    $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
    $memD= $this->Site_model->getDataById( 'bt_members', $where );
    $product=$productData[0]['id'];

    $qry="SELECT * FROM `bt_enquiry` WHERE `prod_id` = $product AND `user_id` = ".$this->session->userdata['logged_in']['user_id']."

    ORDER BY id DESC limit 1";
    $replydata =$this->Site_model->execute($qry);

    $supplierId=$replydata[0]['receiver_id'];
    if($supplierId!="") {
        $qry = "SELECT * FROM `bt_enquiry` WHERE `prod_id` = $product AND `user_id` = " . $supplierId . "  AND receiver_id=" . $this->session->userdata['logged_in']['user_id'] . "
    ORDER BY id DESC limit 1";
        $supplierData = $this->Site_model->execute($qry);
    }
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
<div class="col-md-12">

    <div class="panel-group checkout-steps" id="accordion">

        <!-- checkout-step-01  -->
        <div class="panel panel-default checkout-step-01">
            <div class="displayMessage"></div>
            <!-- panel-heading -->
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class=" <?php if(isset($supplierData[0]['message'])){ echo 'collapsed';}?>" data-parent="#accordion" href="#collapseOne">
                        <span>1</span>Contact  <b style="color:#ff7878"><?=$productData[0]['company_name'];?></b>
                        <b style="color:#ff7878;float:right;margin-right: 5%;margin-top: 0.5%;"><button onclick="return minisite()" class="btn btn-primary"><i class="fa fa-globe" style="color:#ffffff"></i> Visit Minisite</button></b>
                    </a>
                </h4>
            </div>
            <!-- panel-heading -->
            <?php include('contact-supplier.php'); ?>
        </div>


        <?php
        if(!empty($replydata)){
            if($replydata[0]['msg_read']==0 ||$replydata[0]['msg_read']==1 ){?>
        <!-- checkout-step-02  -->
        <div class="panel panel-default checkout-step-02">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse"  class="<?php if(isset($supplierData[0]['message'])){ echo 'collapse';}?> collapseTwo" data-parent="#accordion" href="#collapseTwo">
                        <span>2</span>Supplier Response
                    </a>
                </h4>
            </div>
            <?php include('supplier-response.php'); ?>
        </div>
        <!-- checkout-step-02  -->
            <?php }   if($supplierData[0]['message']!="" ){ ?>
        <!-- checkout-step-03  -->
        <div class="panel panel-default checkout-step-03">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed collapseThree" data-parent="#accordion" href="#collapseThree">
                        <span>3</span>Negotiate with Supplier
                    </a>
                </h4>
            </div>
            <?php include('negotiate-with-supplier.php'); ?>
        </div>
        <!-- checkout-step-03  -->


        <!-- checkout-step-05  -->
        <div class="panel panel-default checkout-step-05">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="collapsed collapseFive" data-parent="#accordion" href="#collapseFive">
                        <span>4</span>Order Online
                    </a>
                </h4>
            </div>
            <?php include('order-online.php'); ?>
        </div>
        <!-- checkout-step-05  -->

        <?php } }?>

    </div><!-- /.checkout-steps -->
</div>
<div class="col-md-4">
    <!-- checkout-progress-sidebar -->
    <?php

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
<script src="<?=base_url()?>assets2/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?=base_url()?>assets2/tinymce/js/tinymce/tinymce.min.js"></script>

<script>tinymce.init({
        selector: 'textarea',
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

    <!-- For demo purposes – can be removed on production -->


    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <?php include(APPPATH.'/views/layout/footer.php'); ?>


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
               $('#loginp').modal('show');
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