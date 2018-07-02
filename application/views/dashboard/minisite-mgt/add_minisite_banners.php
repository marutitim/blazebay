<?php
$title = "Add ministe banner";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
//defining variables
$logged_userid = "";
$business_id = "";
//defining used tables
$businessTable        = $prev."business";
$businessBannersTable = $prev."business_banners";
if(!empty($this->session->userdata['logged_in']['user_id']) ){
    $logged_userid = $this->session->userdata['logged_in']['user_id'];
    //get user's business data
    $getBusinessData = $this->Site_model->getRowData($businessTable,"user_id ='$logged_userid'");
    $getBusinessData=$getBusinessData[0];
    $business_id     = $getBusinessData['id'];
    $business_name   = $getBusinessData['company_name'];

    //get business banners
    $getBusinessBanners =$this->Site_model->getDataById($businessBannersTable,"business_id ='$business_id' ORDER BY banner_id DESC");

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
                    <div class="col-md-12">
                        <div class="featuredpro">
                            <h3 class="section-title">Minisite Banners</h3>
                            <?php //$flashmsg->display(); ?>
                            <form enctype="multipart/form-data" name="frmUser" id="minisite_banner" class="form-horizontal" method="post" action="#">

                                <div class="clearfix"></div>
                                <div class="form-group photo-sec">
                                    <label class="col-md-3 col-sm-4">Add Banner: <span>*</span></label>
                                    <div class="col-md-9 col-sm-8 col-xs-12">
                                        <div>
                                            <input type="file" name="fileToUpload" id="fileToUpload" class="col-md-8 col-sm-10" >
                                            <input type="button" class="btn btn-warning float-right" name="sub" value="Upload" onclick="update_mini_banner()">
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

                            <div class="form-group">
                                <h4 class="bnrlist-head">Banner List</h4>
                                <div class="table-responsive scroll_hidden ">
                                    <table id="banner_table" class="table table-bordered table-striped table-bordered table-hover display xshrtab" width="100%" border="0" align="center" cellspacing="1" cellpadding="4" >
                                        <thead>
                                        <tr>
                                            <th width="20px">Sl</th>
                                            <th width="">Banner Image</th>
                                            <th width="60px">Added On</th>
                                            <!-- <th width="60px">Status</th> -->
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($getBusinessBanners){
                                            $slno=1;
                                            foreach ($getBusinessBanners as $eachBanners) {
                                                $banner_id = $eachBanners['banner_id'];
                                                //banner images
                                                $banner_image = $eachBanners['banner_image'];
                                                $banner_path  = base_url()."assets/company_banner/".$banner_image;
                                                $banner_status ="In-Active";
                                                if($eachBanners['banner_status']== 'Y'){
                                                    $banner_status ="Active";
                                                }
                                                ?>
                                                <tr>
                                                    <td width=""><?php echo $slno;?></td>
                                                    <td width="">
                                                        <div>
                                                            <img src="<?php echo $banner_path;?>" alt="<?php echo $business_name;?>" style="width:200px;height:60px" class="img-responsive" />
                                                        </div>
                                                    </td>
                                                    <td><?php echo date('d-m-Y',$eachBanners['banner_addedon']);?></td>
                                                    <!-- <td><?php //echo $banner_status;?></td> -->
                                                    <td>
                                                        <?php  if($banner_status=='In-Active'){?>
                                                            <input type="button" style="background-color:#2873F0 !important" class="btn btn-warning " name="sub" value="<?php echo $banner_status;?>" onclick="setbunner(<?=$banner_id;?>)">
                                                        <?php } else{?>
                                                            <input type="button"  class="btn btn-warning " name="sub" value="<?php echo $banner_status;?>" onclick="setbunner(<?=$banner_id;?>)">
                                                        <?php }?>
                                                        <input type="button" class="btn btn-warning " name="sub" value="Delete" onclick="delet_banner(<?=$banner_id;?>)">
                                                    </td>
                                                </tr>
                                                <?php $slno++;
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
<script>
    function update_mini_banner(){

        if($("#fileToUpload").val()==""){
            $(".banner-error-msg").css('color','red');
            $(".banner-error-msg").html("Please Select a banner to upload.");
            return false;
        }else{
            var formData = new FormData($('#minisite_banner')[0]);
            var base_url='<?php echo base_url();?>';
            $.ajax({
                url: base_url+"process_min_banner",
                type: "POST",
                data: formData,
                async: false,
                success: function (msg) {
                    document.body.scrollTop = document.documentElement.scrollTop = 0;
                    $(".banner-error-msg").html(msg);
                    //window.location.href=base_url+"manage-wholesale-products";
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    }

    function setbunner(val){


        var base_url='<?php echo base_url();?>';
        $.ajax({
            url: base_url+"setbunner/"+val,
            type: "POST",
            data: val,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $(".banner-error-msg").html(msg);
                window.location.href=base_url+"minisite-banners";
            },
            cache: false,
            contentType: false,
            processData: false
        });

    }

    function delet_banner(val){

        var base_url='<?php echo base_url();?>';
        $.ajax({
            url: base_url+"delet_banner/"+ val,
            type: "POST",
            data: val,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $(".banner-error-msg").html(msg);
                window.location.href=base_url+"minisite-banners";
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#minisite_banner").submit(function(){
            if($("#fileToUpload").val()==""){
                $(".banner-error-msg").css('color','red');
                $(".banner-error-msg").html("Please Select a banner to upload.");
                return false;
            }else{
                return true;
            }
        });

        $('#banner_table').DataTable({
            //"order": [[ 0, "desc" ]]
        });
    });
</script>

</body>
</html>
		