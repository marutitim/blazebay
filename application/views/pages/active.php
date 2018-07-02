
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
        <div class="container-fluid">
            <?php include(APPPATH.'/views/layout/mainheader.php'); ?>
        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container-fluid">
            <?php include(APPPATH.'/views/layout/menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="body-content">
        <div class="container-fluid">
            <div class="contact-page">
                <div class="row">
                    <div class="col-md-12 alert alert-success">
                        Congratulations
                    </div>
      </div>
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