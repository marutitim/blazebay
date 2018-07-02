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

            <!-- Login Section -->
            <div class="page-block margin-bottom">
                <form method="post"   class="register-form outer-top-xs" role="form">
                <div class="invalidLogin"></div>
                <div class="col-sm-12 col-xs-12 passworderr"></div>
                <div class="col-sm-12 col-xs-12 usernameerror"></div>
                <span class="block semibold margin-bottom_low">Already member? Login</span>
                <div class="input-field">
                    <input type="text"  name="username" id="username">
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input type="password" id="password">
                    <label for="passwd">Password</label>
                </div>
                <button class="btn blazecolor margin-bottom_low" onclick="return userLogin()" type="button">Login</button>
                <a href="<?php echo base_url() ?>forgot-password">Forgot password</a>
                    </form>
            </div>
            <!-- End Login Section -->

            <div class="line"></div>

            <!-- Register Section -->
            <div class="page-block">
                <span class="block semibold">Not registered yet? Register</span>
                <p>Creating an account on blazebay will help you get the latest deals ,offers and many more instantly.If you are a supplier
                    Blazebay will open new market for your business.
                </p>
                <a href="<?php echo base_url() ?>register" class="btn blazecolor2 block">register</a>
            </div>
            <!-- End Register Section -->

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
</script>

</body>
</html>