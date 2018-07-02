<?php
$pagename = "my_received_enquiries";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
//$flashmsg = new \Plasticbrain\FlashMessages\FlashMessages();

//===== get login user Details:: Starts =====
if(isset($this->session->userdata['logged_in']['user_id'])){

    $logged_user_id       = $this->session->userdata['logged_in']['user_id'];
    $logged_user_usertype = $this->session->userdata['logged_in']['usertype'];
    $logged_user_memtype  =$this->session->userdata['logged_in']['memtype'];

    $user_id = $logged_userid = $logged_user_id;

}
//===== get login user Details:: Ends =====


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="Blazebay Ecommerce">
    <meta name="robots" content="all">
    <title><?=$name?></title>
    <link rel="shortcut icon" type="image/x-icon" href="https://www.blazebay.com/assets/images/logo/FAV_8521497874673.png" />
    <?php include( APPPATH.'views/dashboard/head.php'); ?>


</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <?php include( APPPATH.'views/dashboard/header.php'); ?>

</header>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="clearfix filters-container m-t-10">
            <!-- Button mobile view to collapse sidebar menu -->
            <?php include( APPPATH.'views/dashboard/breadcrum.php'); ?>
        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="">
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">


                    <!-- User -->
                    <?php include APPPATH.'views/dashboard/myaccount/profile.php'; ?>
                    <!-- End User -->


                    <!--- Sidemenu -->
                    <?php include APPPATH.'views/dashboard/side-menu.php'; ?>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <div class="col-md-12">
                    <?php // $flashmsg->display(); ?>
                    <div class="featuredpro">
                        <div class="displayMessage"></div>
                        <div class="col-md-12">


                            <div class="featuredpro">

                                <h3 class="section-title"> <a href="JavaScript:void(0);" >Compose new Message</a></h3>


                                <div id="msgReplies" ></div>

                                <!--Container Section1 -->

                                <div class="">

                                    <div id="amazingcarousel-container-1" >

                                        <form  name="" id="replymsg" class="form-horizontal" method="post" action="" >

                                            <div class="form-group">

                                                <label class="col-md-3 col-sm-4">To: <span>*</span></label>

                                                <div class="col-md-9 col-sm-8 col-xs-12">

                                                    <div class="ui-widget">

                                                        <input  required="" type="email" name="receiver" id="receiver" class="form-control" value="" >

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label class="col-md-3 col-sm-4">Subject: <span>*</span>

                                                </label>

                                                <div class="col-md-9 col-sm-8 col-xs-12">


                                                    <input  required="" type="text" name="subject"  id="subject" class="form-control" value=" " >


                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label class="col-md-3 col-sm-4">Message Description: <span>*</span>

                                                </label>

                                                <div class="col-md-12">

                                                    <textarea rows="5" name="description" class="form-control"  id="description" required=""></textarea>

                                                </div>

                                            </div>



                                            <div class="form-group">

                                                <div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4 col-xs-12">
                                                    <a href="<?=base_url()?>enquiries-received" class="btn btn-warning">Back</a>
                                                    <input type="button" value="Submit Message" onClick="return sendreply()" class="btn btn-primary" name="sub">

                                                </div>

                                            </div>

                                            <div class="clear"></div>

                                        </form>

                                    </div>


                                </div>

                            </div>

                        </div>



                    </div>
                </div>

            </div>

            </form>

        </div>
    </div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>


<script src="<?=base_url()?>assets2/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?=base_url()?>assets2/tinymce/js/tinymce/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: '#messagesent',
        height: 50

    });
    tinymce.init({
        selector: '#description',
        height: 50,
        theme: 'modern',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    function sendreply(){
        var base_url="<?php echo base_url();?>";
        var contactmessage=tinyMCE.get('description').getContent();
        var reply_id=$('#reply-id').val();
        var message=$('#message').val();
        var subject=$('#subject').val();
        var receiver=$('#receiver').val();
        var customerId=$('#customerId').val();
        if(contactmessage=== undefined || contactmessage.length == 0){
            new Noty({
                type: 'error',
                timeout: 30000,
                text     : 'Oops!.Please enter a  message',
                container: '.displayMessage'
            }).show();
            $("html, body").animate({scrollTop: 0}, "slow");
        }
        else {
            $.ajax({
                url: base_url + "newmessage",
                type: "POST",
                data: {message: contactmessage,subject: subject,to:receiver},
                dataType: "json",
                success: function (msg) {
                    if (msg == 1) {
                        new Noty({
                            type: 'info',
                            timeout: 30000,
                            text: 'Success,message sent successfully',
                            container: '.displayMessage'
                        }).show();
                        $("html, body").animate({scrollTop: 0}, "slow");

                    } else {
                        new Noty({
                            type: 'error',
                            timeout: 30000,
                            text: 'Error! something went wrong,we are resolving it shortly',
                            container: '.displayMessage'
                        }).show();
                    }
                }
            });

        }
    }
</script>
</body>
</html>
