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
<div class="ErrorMessage"></div>


                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in" style="margin-bottom:3%;">
                        <form method="post" id="send_email_frm" name="send_email_frm" action="">

                            <div class="row">

                                <div class="col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label class="control-label" for="recipient-name">Email Address(registered) : <font color="#FF0000">*</font></label>

                                        <input type="text" name="email" id="email" onkeyup="return  checkemail()" class="form-control" placeholder="Enter Email">

                                    </div>

                                </div>




                                <div class="col-sm-6 col-xs-6 margin-top1">

                                    <button type="button" class="btn btn-primary width-full" onclick="resetPwd()">Send</button>

                                </div>

                                <div class="col-sm-6 col-xs-6 margin-top1">

                                    <a href="<?php echo base_url();?>login" class="btn btn-warning width-full">Cancel</a>

                                </div>

                                <div class="col-sm-12 col-xs-12 margin-top1"><font color="#FF0000">*</font> Field are mandatory</div>

                            </div>

                        </form>

                    </div>

            </div><!-- /.sigin-in-->
              </div>
        </div>
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

        <script type="text/javascript">

            function resetPwd(){
                var baseUrl      = "<?php echo base_url();?>";
                var Url         =  baseUrl+"process_forgot_password";
                var email = $('#send_email_frm').find('input[name="email"]').val();
                if(email==""){
                    new Noty({
                        type: 'error',
                        timeout: 1000,
                        text     : 'Oops!.Please enter your Email',
                        container: '.ErrorMessage'
                    }).show();
                }else{
                    postVar={
                        'email':email
                      }
                    $.post(Url,postVar, function(data){
                        swal("Sent!", "Please check your email to reset your password", "success")
                        location.replace('<?=base_url()?>login');

                    });
                }

            }


        </script>

</body>
</html>