<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>
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

                                    <button type="button" class="btn blazecolor width-full" onclick="resetPwd()">Send</button>

                                </div>


                                <div class="col-sm-12 col-xs-12 margin-top1"><font color="#FF0000">*</font> Field are mandatory</div>

                            </div>

                        </form>

                    </div>

                </div><!-- /.sigin-in-->
            </div>

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