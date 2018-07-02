<!DOCTYPE html>
<html lang="en-US">
<head>

    <link href="<?php echo base_url();?>assets2/css/core.css" rel="stylesheet" type="text/css" />
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

        <h1 class="page-title"><?=$name?></h1>
        <?php
        $where = "user_id='" . $this->session->userdata['logged_in']['user_id'] . "'";
        $loggedUser_details= $this->Site_model->getDataById( 'bt_members', $where );
        $logged_user_lastlogin = $loggedUser_details[0] ['lastlogin'];
        ?>



        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){ ?>




            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-product-hunt"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Products</h4>

                        <div class="widget-chart-1">

                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"> <?=count($product_count)?> </h2>
                                <p class="text-muted">Total Products</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-th-list"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Orders </h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">

                                <h2 class="m-b-0"><?=$order_count?count($order_count):0?></h2>
                                <p class="text-muted m-b-25">Total Orders</p>
                            </div>

                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                       data-bgColor="#FFE6BA" value="80"
                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                       data-thickness=".15"/>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0">  <?=$enquiry_count?count($enquiry_count):0?> </h2>
                                <p class="text-muted">Total Enquiries</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="text-center card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>
                        <div>

                            <h4 class="header-title m-t-0 m-b-30">My Profile</h4>

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Last Login :</strong> <span class="m-l-15"><?=date('d-M-Y', strtotime($logged_user_lastlogin));?></span></p>

                                <p class="text-muted font-13"><strong>Password:</strong><span class="m-l-15">To change your existing password <a href="#">Click Here</a></span></p>


                            </div>

                        </div>

                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Tradeshow</h4>

                        <div class="widget-chart-1">

                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"> <?=$trade_count?count($trade_count):0?></h2>
                                <p class="text-muted">Tradeshow</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Transaction </h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <h2 class="m-b-0"> 0 </h2>
                                <p class="text-muted m-b-25">Total Transactions</p>
                            </div>

                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">CRM</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                       data-bgColor="#FFE6BA" value="80"
                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                       data-thickness=".15"/>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"> 4 </h2>
                                <p class="text-muted">Total Notifications</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="text-center card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>
                        <div>

                            <h4 class="header-title m-t-0 m-b-30">Need Help</h4>

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Frequently Asked Questions: </strong> <span class="m-l-15"><a href="#">FAQ/Help</a></span></p>

                                <p class="text-muted font-13"><strong>For BlazeBay: </strong><span class="m-l-15"><a href="#">Site Help</a></span></p>


                            </div>

                        </div>

                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        <?php } ?>
        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){ ?>

            <div class="row">


                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-shopping-basket"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Orders </h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">

                                <h2 class="m-b-0"><?=$order_count?count($order_count):0?> </h2>
                                <p class="text-muted m-b-25">Total Orders</p>
                            </div>

                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-phone"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">

                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"> <?=$enquiry_count?count($enquiry_count):0?> </h2>
                                <p class="text-muted">Total Enquiries</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="text-center card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>
                        <div>

                            <h4 class="header-title m-t-0 m-b-30">My Profile</h4>

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Last Login :</strong> <span class="m-l-15">
                                <?=date('d-M-Y', strtotime($logged_user_lastlogin));?></span></p>

                                <p class="text-muted font-13"><strong>Password:</strong><span class="m-l-15">To change your existing password <a href="<?=base_url()?>change-password">Click Here</a></span></p>


                            </div>

                        </div>

                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-heartbeat"></i>
                            </a>

                        </div>

                        <h4 class="header-title m-t-0 m-b-30">My favourites</h4>

                        <div class="widget-chart-1">
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"> 2 </h2>
                                <p class="text-muted">total favourites</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->


                <div class="col-lg-3 col-md-6">
                    <div class="text-center card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                        </div>
                        <div>

                            <h4 class="header-title m-t-0 m-b-30">Need Help</h4>

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Frequently Asked Questions: </strong> <span class="m-l-15"><a href="<?=base_url()?>faq">FAQ/Help</a></span></p>

                                <p class="text-muted font-13"><strong>For BlazeBay: </strong><span class="m-l-15"><a href="<?=base_url()?>site-help">Site Help</a></span></p>


                            </div>

                        </div>

                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->
        <?php } ?>



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

</body>
</html>