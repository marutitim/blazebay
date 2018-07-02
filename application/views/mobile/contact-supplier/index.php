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

<html lang="en-US">
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-modal.min.css"/>

    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>



    <style>

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

        <h1 class="page-title">Contact Supplier</h1>
    <div class="panel-group checkout-steps" id="accordion" >

        <!-- checkout-step-01  -->
        <div class="panel panel-default checkout-step-01">
            <div class="displayMessage"></div>
            <!-- panel-heading -->
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class=" <?php if(isset($supplierData[0]['message'])){ echo 'collapsed';}?>" data-parent="#accordion" href="#collapseOne">
                        <span></span>Contact  <b style="color:#ff7878"><?=$productData[0]['company_name'];?></b>

                    </a>
                </h4>
            </div>
            <!-- panel-heading -->
            <?php include('contact-supplier.php'); ?>
        </div>




    </div><!-- /.checkout-steps -->



</div>
        <!-- END CONTENT CONTAINER -->



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

<script src="<?php echo base_url();?>assets/js/bootstrap-modal.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-modalmanager.min.js"></script>

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

    function modalcancel(){
        RedirectUrl="<?=base_url()?>";
        window.location.href=RedirectUrl;
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