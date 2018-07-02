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


            <div class="checkout-box faq-page">
                <div class="row">

                        <h2 class="heading-title"><?=$name?></h2>
                        <div class="col-md-12">
                            <div class="contact_section col-md-6">
                                <h3>Address</h3>
                                <div class="col-md-12">
                                    <ul class="contact-address">
                                        <li>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <p>Blazebay Ltd,
                                                Panesar's Centre,1st Floor, Mombasa Road,
                                                P.O. Box 65159 - 00618, Ruaraka,
                                                Nairobi, Kenya. </p>
                                            <div class="class"></div>
                                        </li>
                                        <div class="class"></div>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <p>+254-741-403-640<br>
                                            </p>
                                            <div class="class"></div>
                                        </li>
                                        <div class="class"></div>
                                        <li>
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <p><a href="mailto:info@blazebay.com">info@blazebay.com</a></p>
                                            <div class="class"></div>
                                        </li>
                                        <div class="class"></div>
                                    </ul>


                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.375994831082!2d36.85090183046051!3d-1.3246974360982229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1194d3624c31%3A0xc8c301056c9b0d56!2sPanesars+Kenya+Ltd!5e0!3m2!1ssw!2ske!4v1499929568039" style="border:0" allowfullscreen="" width="450" height="450" frameborder="0"></iframe>

                                </div>
                                <div class="class"></div>

                            </div>
                            <div class="contact_form col-md-6">
                                <h3>Contact Form</h3>
                                <div class="row">
                                    <div id="contactresponsemsg"></div>
                                    <form name="contactForm" id="contactForm" method="post" action="" novalidate="novalidate" class="fv-form fv-form-bootstrap">


                                        <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="email2">Company Name:</label>
                                                <input name="company_name" placeholder="Company name" id="email2" class="form-control" data-fv-field="company_name" type="text"><i style="display: none;" class="form-control-feedback" data-fv-icon-for="company_name"></i>
                                                <p style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="company_name" data-fv-result="NOT_VALIDATED">Company Name is required</p></div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="email2">Your Name:</label>
                                                <input name="fname" placeholder="Name" id="email2" class="form-control" data-fv-field="fname" type="text"><i style="display: none;" class="form-control-feedback" data-fv-icon-for="fname"></i>
                                                <p style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="fname" data-fv-result="NOT_VALIDATED">Full Name is required.</p></div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="email2">E-mail ID:</label>
                                                <input placeholder="Enter email" name="email" id="email2" class="form-control" data-fv-field="email" type="text"><i style="display: none;" class="form-control-feedback" data-fv-icon-for="email"></i>
                                                <p style="display: none;" class="help-block" data-fv-validator="emailAddress" data-fv-for="email" data-fv-result="NOT_VALIDATED">Invalid email address</p><p style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="email" data-fv-result="NOT_VALIDATED">The email field is required</p></div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="email2">Phone / Mobile No.</label>
                                                <input placeholder="Enter mobile"  maxlength="15" name="mobile" id="email2" class="form-control" data-fv-field="mobile" type="text"><i style="display: none;" class="form-control-feedback" data-fv-icon-for="mobile"></i>
                                                <p style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="mobile" data-fv-result="NOT_VALIDATED">Your mobile number is required.</p></div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="email2">Subject:</label>
                                                <select name="subject" class="form-control " >
                                                    <option value="General Enquiry">General Enquiry</option>
                                                    <option value="Sales Enquiry">Sales Enquiry</option>
                                                    <option value="Support Enquiry"> Support Enquiry</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="email2">Message:</label>
                                                <textarea style="max-width:100%;" name="comment" id="comment" rows="5" class="form-control" data-fv-field="comment"></textarea><i style="display: none;" class="form-control-feedback" data-fv-icon-for="comment"></i>
                                                <p style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="comment" data-fv-result="NOT_VALIDATED">Message is required.</p></div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <input name="sbmt" value="Send"  onclick="return contactUs();" class="btn btn-warning btn-big" type="button">
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
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
            $(".changecolor").switchstylesheet( { seperator:"color"} );
            $('.show-theme-options').click(function(){
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function() {
            $('.show-theme-options').delay(2000).trigger('click');
        });
        function contactUs(){
            var url="<?php echo base_url();?>processContact";
            var pageRedirect="<?php echo base_url();?>";
            var data = new FormData($('#contactForm')[0]);
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                async: false,
                success: function (data) {

                    if(data==1){
                        $("#contactresponsemsg").html('<div class="alert alert-success alert-dismissable"><i class="fa  fa-check"></i><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Success,your Inquiry Sent successfully</b></div>');

                    }else{
                        $("#contactresponsemsg").html('<div class="alert alert-danger alert-dismissable"><i class="fa  fa-check"></i><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error occured</b></div>');

                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    </script>


</body>
</html>