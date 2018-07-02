<?php
$title = "Add ministe Logo";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
//defining variables
$logged_userid = "";
$business_id = "";
//defining used tables
$businessTable = $prev."business";
$business_logo_dir = 'assets/uploadedimages/';
if(!empty( $this->session->userdata['logged_in']['user_id']) ){
    $logged_userid = $this->session->userdata['logged_in']['user_id'];
    //get user's business data
    $getBusinessData =$this->Site_model->getRowData($businessTable,"user_id ='$logged_userid'");
    $getBusinessData=$getBusinessData[0];
    $business_id     = $getBusinessData['id'];
    $business_name   = $getBusinessData['company_name'];
    //business/company logo


    if(file_exists($business_logo_dir.$getBusinessData['company_logo'])){
        $business_logopath =$business_logo_dir.$getBusinessData['company_logo'];

    }else{
        $business_logopath =base_url() . 'assets/images/nopic.jpg';
    }
}




//======== Update Company logo :: starts =========
if(isset($_POST['update_company_logo']))
{
    $allowed_file = array("jpg", "jpeg", "gif", "png");
    $upload_dir = $business_logo_dir;

    //is the file uploaded yet?
    if ($_FILES['fileToUpload']['tmp_name'] )
    {
        $uploaded_filename = $_FILES['fileToUpload']['name'];

        $ext_info = explode('.', strtolower( $uploaded_filename) );
        $extension = end($ext_info);
        //checks if this file allowed
        if ( in_array($extension, $allowed_file) )
        {
            $timestmp = time();
            //new file name
            $tmp_name = "BLOGO".$business_id.rand('100','999').'_';
            $newfile_name = $tmp_name.$timestmp.'.'.$extension;
            //upload file
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_dir.$newfile_name ) )
            {
                $logo_data = array('company_logo' => $newfile_name );
                $updted = update_table_data($businessTable, $logo_data,"id='$business_id'");

                if($updted == "DONE"){
                    $flashmsg->success("Logo Updated successfully.");
                }else{
                    $flashmsg->error("Failed to Upload due to some issues.");
                }
            }
        }else{
            //if file type not allowed
            $flashmsg->error("Uploaded File Format Not Allowed.");
        }
    }

    header("location:".base_url()."company-logo/");die();
}
//======== Upload Company logo ::   Ends =========


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
                <div class="container">
                    <div class="col-md-12">
                        <div class="featuredpro">
                            <h3 class="section-title">Company Logo</h3>

                            <form enctype="multipart/form-data" name="minisite_bannerlogo" id="minisite_bannerlogo" class="form-horizontal" method="post" action="#">

                                <div class="clearfix" id="msgReplies"></div>

                                <div class="form-group photo-sec">
                                    <div class="col-md-3">
                                        <img src="<?php echo base_url().$business_logopath;?>" alt="<?php echo $business_name;?>" >
                                    </div>
                                    <div class="col-md-9 col-sm-8 col-xs-12">
                                        <div>
                                            <input type="file" name="fileToUpload" id="fileToUpload" class="col-md-8 col-sm-10" >
                                            <input type="button" class="btn btn-warning float-right" onclick="update_logo()" name="update_company_logo" value="Upload">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="banner-error-msg "></div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                  <div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4 col-xs-12">
                                    <input type="submit" class="btn btn-warning float-right" name="sub">
                                  </div>
                                </div> -->
                            </form>

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
<script>
    function update_logo(){
        var formData = new FormData($('#minisite_bannerlogo')[0]);
        var base_url='<?php echo base_url();?>';
        var business_id='<?php echo $business_id;?>';
        $.ajax({
            url: base_url+"process_mini_logo/"+business_id,
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                //window.location.href=base_url+"manage-wholesale-products";
            },
            cache: false,
            contentType: false,
            processData: false
        });

    }
</script>

</body>
</html>
		