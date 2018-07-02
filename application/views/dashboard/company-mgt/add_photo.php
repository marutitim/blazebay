<?php

$pagename = "addphoto";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

$prev="bt_";




if(isset($_POST['sub']))   //IF SOME FORM WAS POSTED DO VALIDATION
{


    // if(isset($_FILES['image'])){
    //     $errors= array();
    //     $file_name = $_FILES['image']['name'];
    //     $file_size =$_FILES['image']['size'];
    //     $file_tmp =$_FILES['image']['tmp_name'];
    //     $file_type=$_FILES['image']['type'];
    //     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    //     $expensions= array("jpeg","jpg","png");

    //     if(in_array($file_ext,$expensions)=== false){
    //        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    //     }

    //     if($file_size > 2097152){
    //        $errors[]='File size must be excately 2 MB';
    //     }

    //     if(empty($errors)==true){
    //        move_uploaded_file($file_tmp,"company_banner/".$file_name);
    //        //echo "Success";
    //     }else{
    //        //print_r($errors);
    //     }
    //  }

    $allow = array("jpg", "jpeg", "gif", "png");
    $todir = base_url().'assets/company_banner/';

    //move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"banners/".$_FILES["fileToUpload"]["name"]);
    //move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"company_banner/".$_FILES['fileToUpload']['name']);
    //echo "Success";
    //print_r($todir);exit;

    /* if ( !!$_FILES['fileToUpload']['tmp_name'] ) // is the file uploaded yet?
     {
       $info = explode('.', strtolower( $_FILES['fileToUpload']['name']) ); // whats the extension of the file

       if ( in_array( end($info), $allow) ) // is this file allowed
       {
         if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $todir . basename($_FILES['fileToUpload']['name'] ) ) )
         {
         //echo "success";
           //echo = "the file has been moved correctly";
         }
       }
       else
       {
       //echo "failure";
         //echo = "error this file ext is not allowed";
       }
     }
   $images = $_FILES["fileToUpload"]["name"] ;

  $uid=$_SESSION['user_id'];
     $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$uid;
     $c_id_1 = mysql_query($c_id);
     $c_id_2 = mysql_fetch_array($c_id_1);

     $update_query = "update `bt_business` set `banner_images`='".$images."' where `id`='".$c_id_2['id']."'";
    $r =  mysql_query($update_query);
*/

    if ($_FILES['fileToUpload']['tmp_name'] ) // is the file uploaded yet?
    {
        $info = explode('.', strtolower( $_FILES['fileToUpload']['name']) ); // whats the extension of the file

        if ( in_array( end($info), $allow) ) // is this file allowed
        {
            if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $todir . basename($_FILES['fileToUpload']['name'] ) ) )
            {
                $images = $_FILES["fileToUpload"]["name"] ;

                $uid=$_SESSION['user_id'];
                $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$uid;
                $c_id_1 = mysql_query($c_id);
                $c_id_2 = mysql_fetch_array($c_id_1);

                $update_query = "update `bt_business` set `banner_images`='".$images."' where `id`='".$c_id_2['id']."'";
                $r =  mysql_query($update_query);
            }
        }

    }else
    {
        $r = 0;
    }



    // if($_FILES[gallary_image][name]!="")
    // {

    //   $allowed_ext=array("jpg","jpeg","png","gif");

    //   $extension=explode('.',$_FILES["gallary_image"]["name"]);

    //   $ext=strtolower(end($extension));

    //   if(in_array($ext,$allowed_ext))
    //   {

    //    $newname=rand(10000,99999)."_".time().".".$ext;
    //    $loc="company_banner/".$newname;
    //    move_uploaded_file($_FILES["gallary_image"]["tmp_name"],"".$loc);

    //    $uid=$_SESSION['user_id'];
    //    $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$uid;
    //    $c_id_1 = mysql_query($c_id);
    //    $c_id_2 = mysql_fetch_array($c_id_1);

    //    $update_query = "update `bt_business` set `banner_images`='".$newname ."' where `id`='".$c_id_2['id']."'";
    //   $r =  mysql_query($update_query);
    //   }

    // }






//echo $update_query;

// $r = mysql_query($update_query);

//$new_user_id = mysql_insert_id();
    if($r){
        $_SESSION['after_post_msg'] = "Banner Successfully added".$images;
    }

}
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
    <div class="col-md-10">

        <div class="featuredpro">
            <h3 class="section-title">Edit Company Banner</h3>

            <div id="msgReplies"></div>

            <?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="post-photo"> Add Company Banner Images </a> </h2><?php */?>
            <?php

            //$all_user_details="select * from " . $prev. "members where user_id=".$_SESSION['user_id'];
            //$user_details=mysql_fetch_array(mysql_query($all_user_details));
            //print_r($user_details);

            ?>

            <form enctype="multipart/form-data" name="frmUser" id="bannerform" class="form-horizontal" method="post" action="">

                <div class="clearfix"></div>

                <div class="form-group photo-sec">
                    <label class="col-md-3 col-sm-4">Add Photo: <span>*</span>
                    </label>
                    <div class="col-md-9 col-sm-8 col-xs-12">


                        <div class="col-md-2 col-sm-2 col-xs-12 pic-box">
                            <?php
                            $result_memberQ="SELECT * FROM ".$prev."business where user_id =".$this->session->userdata['logged_in']['user_id'];
                            $row_mem=$this->Site_model->getcountRecods($result_memberQ);


                            $banner_images = $row_mem[0]['banner_images'];

                            ?>



                            <?php if($banner_images==''){ ?>
                                <img src="<?=base_url()?>assets/uploadedimages/nopic.jpg" alt="company_logo">

                            <?php }else{
                                $file = $banner_images;
                                $path= 'assets/company_banner/';
                                $image_thumb=base_url().$path.$file;


                                ?>
                                <img  style="width:200px" src="<?=$image_thumb?>" alt="company_logo">
                            <?php } ?>

                        </div>

                        <?php if($banner_images==''){ ?>
                            <input type="file" required="required" name="fileToUpload" id="fileToUpload" class="col-md-10 col-sm-10" >
                        <?php }else{ ?>
                            <input type="file"  name="fileToUpload" id="fileToUpload" class="col-md-10 col-sm-10" >
                        <?php } ?>

                        <!--<input type="file" required="required" name="fileToUpload" id="fileToUpload" class="col-md-10 col-sm-10" >-->

                        <?php /*?><label class="btn btn-primary">

      </label><?php */?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4 col-xs-12">
                        <input type="button" class="btn btn-warning float-right"  onclick="addbanner();"  value="Save" name="sub">
                    </div>
                </div>
            </form>
            <div class="form-group">

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
<script>
    function addbanner(){
        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#bannerform')[0]);

        $.ajax({
            url: base_url+"process_post_banner",
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
		