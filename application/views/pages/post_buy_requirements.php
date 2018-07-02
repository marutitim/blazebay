
<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');
    if(isset($this->session->userdata['logged_in']['user_id'])){
        $user_id=$this->session->userdata['logged_in']['user_id'];
        $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
        $memD= $this->Site_model->getDataById( 'bt_members', $where );
    }
    ?>

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
            <div class="contact-page">
                <div class="row">
<div class="post-msg alert alert-success" style="display: none">Success</div>
                    <form  class="form-box form-box2" name="post_enquiry_form" id="post_enquiry_form" enctype="multipart/form-data" action="" method="post">
                    <div class="col-md-9 contact-form">
                        <div class="col-md-12 contact-title">
                            <h4>Post Buy Requirements</h4>
                        </div>
                        <div class="col-md-4 ">

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input" value="<?=$memD[0]['firstname']?$memD[0]['firstname']:'';?>  <?=$memD[0]['lastname']?$memD[0]['lastname']:'';?>" id="name" name="name" placeholder="">

                                </div>

                        </div>
                        <div class="col-md-4">

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                    <input type="email" class="form-control unicase-form-control text-input" value="<?=$memD[0]['email']?$memD[0]['email']:'';?>"   id="email" name="email" placeholder="">
                                </div>

                        </div>

                        <div class="col-md-4">

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputTitle">Phone <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input" id="phone"value="<?=$memD[0]['phone']?$memD[0]['phone']:'';?>"  name="phone" placeholder="">
                                </div>

                        </div>
                        <div class="col-md-12">

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputComments">Keyword of Products You are looking for <span>*</span></label>
                                    <textarea class="form-control unicase-form-control" id="product" name="product" ></textarea><br/>

                                    <input type="file" name="file" id="file">

                                </div>

                        </div>

                        <div class="col-md-12">

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputComments">Other Details <span>*</span></label>

                                    <input type="text" class="form-control unicase-form-control text-input" name="port" id="port" placeholder="Preferred Port"><br/>

                                    <input type="text" class="form-control unicase-form-control text-input"  name="amount" id="exampleInputTitle" placeholder="Preferred Unit Price in USD"><br/>

                                    <input type="text" class="form-control unicase-form-control text-input" name="payment" id="exampleInputTitle" placeholder="Payment Method">

                                </div>

                        </div>


                        <div class="col-md-12 outer-bottom-small m-t-20">
                            <button type="button" class="btn-upper btn btn-primary checkout-page-button" onclick="return postInquiry()">Post Requirements</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-3 contact-info">
                        <div class="contact-title">
                            <h4>Information</h4>
                        </div>
                        <div class="clearfix address">
                            <span class="contact-i"><i class="fa fa-map-marker"></i></span>
		<span class="contact-span">Blazebay Ltd, Panesar's Centre,1st Floor, Mombasa Road, P.O. Box 65159 - 00618, Ruaraka, Nairobi, Kenya.
              </span>
                        </div>
                        <div class="clearfix phone-no">
                            <span class="contact-i"><i class="fa fa-mobile"></i></span>
                            <span class="contact-span">+(254) 741 403 640</span>
                        </div>
                        <div class="clearfix email">
                            <span class="contact-i"><i class="fa fa-envelope"></i></span>
                            <span class="contact-span"><a href="#">support@blazebay.com</a></span>
                        </div>
                    </div>			</div><!-- /.contact-page -->
            <div class="col-md-12">

                <?php include(APPPATH.'/views/pages/premium-brands.php'); ?>
            </div>
            </div>
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
    <script type="text/javascript">
        $(document).ready(function(){

        });
        function postInquiry(){

            var user='<?php echo $user_id?>';
            if (user=='' || user== null) {
                $('#loginp').modal('show');
            }else{
                var base_url="<?php echo base_url();?>";
                var data =$('#post_enquiry_form').serialize()
                jQuery.ajax({
                    url: base_url+"postInquiry",
                    data:data,
                    type: "POST",
                    success:function(data){
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        $(".post-msg").show();
                    },
                    error:function (){}
                });



            }



        }

    </script>



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
    </script>


</body>
</html>