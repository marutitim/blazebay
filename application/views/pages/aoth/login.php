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

</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="body-content">
        <div class="container">

            <div class="sign-in-page">
                <div class="row">

                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <?php include('login-section.php'); ?>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <?php include('register.php'); ?>

                    </div>
                    <!-- create a new account -->			</div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">

                <?php include(APPPATH.'/views/pages/premium-brands.php'); ?>
            </div><!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div>



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


    <script>
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