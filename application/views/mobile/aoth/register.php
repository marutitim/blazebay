<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>
    <style>

        [type="radio"]:not(:checked), [type="radio"]:checked {
            position: relative !important;
            visibility: visible !important;
            left:0px !important;
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

            <!-- Login Section -->
            <div class="page-block margin-bottom">

                <form class="register-form outer-top-xs"  enctype="multipart/form-data" name="frmUser" id="signup_form" method="post" role="form">

                    <div class="register-msg"></div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">First name<span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" name="firstname" id="firstname" >
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12"> <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Last name<span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" name="lastname" id="lastname" >
                        </div></div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" name="email" id="email" >
                        </div></div>

                    <div class="col-sm-6 col-xs-12"> <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                            <input type="text"  class="form-control unicase-form-control text-input" name="phone" id="phone" >
                        </div></div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Username <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" name="username" id="username" >
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12"><div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" name="password" id="password" >
                        </div></div> <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input"  name="cpassword" id="cpassword" >
                        </div>
                    </div>
                    <!-- ../End -->
                    <div class="company-floorarea" id="company-floorarea" style="display:none;">

                        <!-- Starts -->
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label" for="recipient-name">Company Name :

                                </label>
                                <input type="text" id="companyname" name="companyname"  class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label" for="recipient-name">Company Email:

                                </label>
                                <input type="text" id="companyemail" name="companyemail"  class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <!-- Starts -->
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label" for="recipient-name">Company Mobile : </label>
                                <input type="text" id="companyphone" name="companyphone"
                                       class="form-control" data-fv-stringlength="true" data-fv-stringlength-min="10"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label" for="recipient-name">Company Address: <font color="#FF0000">*
                                    </font>
                                </label>
                                <textarea id="address1" rows="2" cols="60" name="address1"   class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Starts -->
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="recipient-name">Preferable Category:
                                    <font color="#FF0000">*</font>
                                </label>
                                <select class="form-control" name="preferable_cat" id="preferable_cat" >
                                    <option value=''>Select Business Category</option>
                                    <?php
                                    $query_business_cat = $this->Site_model->getcountRecods("SELECT cat_name, id, pid FROM bt_categories
                     WHERE status = 'Y' AND pid != 0 ORDER BY cat_name ASC");
                                    foreach($query_business_cat as $key=>$cat) {
                                        ?>
                                        <option value="<?=$cat['id'] ?>" ><?= $cat['cat_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="" id="signup-fieldsnot-forcourier" style="display:none;">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="recipient-name">Enter Minisite Url:<font color="#FF0000">*</font></label>
                                <div class=" miniurl-box">
                                    <input type="text" name="minisite_custom_url" value="" id="minisite_custom_url"   class="form-control"  autocomplete="off">

                                    <span class="zds-msite-span">.blazebay.com</span>
                                </div>

                                <p id="mcustom_urlresult" class="zsr-sgnup-murl"></p>
                            </div>

                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="minisite-url">&nbsp;</label>
                                <div>
                                    <div>[ Minisite url will not change in future.]</div>
                                    <span>[ Example: <font color="grey">mysite</font>.blazebay.com ,Please Add your url like: mysite, site44 etc only ]</span>
                                    <span>Only AlphaNumeric Character Allowed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -->
                    <div class="col-sm-12 col-xs-12">
                        <div class="radio outer-xs">
                            <label style="padding: 10px;">
                                <input type="radio" name="usertype" id="optionsRadios2" value="1" checked> Buyer
                            </label>
                            <label style="padding: 10px;">
                                <input type="radio" name="usertype"  id="optionsRadios2" value="2"> Supplier
                            </label>
                            <label style="padding: 10px;">
                                <input type="radio" name="usertype" id="optionsRadios2" value="4"> Courier
                            </label>
                            <a href="<?=base_url()?>termsAndConditions" target="_blank" class="forgot-password pull-right">Terms and Conditions</a>
                        </div></div>
                    <div class="col-sm-12 col-xs-12">
                        <button type="button" onclick="return register()" class="btn-upper btn blazecolor checkout-page-button">Sign Up</button>
                    </div>
                </form>
            </div>
            <!-- End Login Section -->

            <div class="line"></div>


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