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
                    <div class="col-md-12 sign-in" style="margin-bottom:3%;">
                        <form enctype="multipart/form-data" name="resetPassword" id="resetPassword" class="form-horizontal" method="post" action="#">

                            <div class="form-group">

                                <div class="col-sm-6 col-xs-12">

                                    <label class="control-label" for="recipient-name">New Password : <font color="#FF0000">*</font> </label>

                                    <input name="sbnew_pwd" class="form-control" type="password" id="newpassword2">(Password length should be greater than 5, it should consist minimum an alphabetical character and a number)

                                </div>

                            </div>







                            <div class="form-group">

                                <div class="col-sm-6 col-xs-12">

                                    <label class="control-label" for="recipient-name">Confirm Password : <font color="#FF0000">*</font> </label>

                                    <input name="con_pwd" class="form-control" type="password" id="con_pwd">

                                </div>



                            </div>

                            <div class="clearfix"></div>



                            <div class="form-group">

                                <div class="col-sm-6 col-xs-12">

                                    <input type="button" name="Submit2" value="Change Password" onclick="reset_pwd();" class="btn btn-primary btn-big">

                                </div>





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


        function reset_pwd(){
            var base_url="<?php echo base_url();?>";
            var token="<?php echo $token;?>";
            var formData = new FormData($('#resetPassword')[0]);
            var newp = $('#resetPassword').find('input[name="sbnew_pwd"]').val();
            var conf = $('#resetPassword').find('input[name="con_pwd newpassword2"]').val();
            if(newp==""){
                new Noty({
                    type: 'error',
                    timeout: 1000,
                    text     : 'Oops!.Please enter new password',
                    container: '.ErrorMessage'
                }).show();
            }else if(conf==""){
                new Noty({
                    type: 'error',
                    timeout: 1000,
                    text     : 'Oops!.Please enter confirm password',
                    container: '.ErrorMessage'
                }).show();
            } else {
                $.ajax({
                    url: base_url + "process_forgot_change_password/" + token,
                    type: "POST",
                    data: formData,
                    async: false,
                    success: function (msg) {
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        $(".ErrorMessage").html(msg);
                        setTimeout(base_url, 1000)

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });

                e.preventDefault();
            }
        }
    </script>

</body>
</html>