<?php
$pagename = "addlocation";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
//=========== If Post for Update ===============

//========== Get Business Location =============
$prev="bt_";
$select_Q="select * from ".$prev."business where user_id=".$this->session->userdata['logged_in']['user_id']."";

$row_com_location= $this->Site_model->getcountRecods($select_Q);
if(!empty($row_com_location)){
    $num_com_location = count($row_com_location);
}else{
    $num_com_location =0;
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
                            <h3 class="section-title">Add Company Location</h3>
                            <?php //$flashMessage->display();?>

                            <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
                            <script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
                            <!--<div id="mid_side" style='padding-top:6px'>-->
                            <div id="msgReplies" ></div>
                            <form name="locform" method="post" action="#" id="locform">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="email2">Map Code :</label>
                                            <textarea required cols="50" id="editor_office2003" class="form-control" name="add_com_location" rows="10"><?php echo $row_com_location[0]['location'];?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="button" name="add_location" value="ADD LOCATION"  onclick="updatelocation()" class="btn btn-warning btn-big">
                                            <?php /*?><p> NOTE: Please write your code like
                  <span>< </span><span> iframe </span> <span>src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14736.<br>886239961716!2d88.43375449454065!3d22.570815281632097!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1471412238866" </span><span> width="200" height="120" frameborder="0" style="border:0" allowfullscreen</span> <span> /> < </span><span> /iframe></span>
                  </span>
                  </p>
                  	(Use Height=425,Width=350) <?php */?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 padding-none">
                                    <div class="form-group">
                                        <!--
                                        <code>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16335352.28401429!2d31.25457421596892!3d1.6702729549672093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182780d08350900f%3A0x403b0eb0a1976dd9!2sKenya!5e0!3m2!1sen!2sin!4v1471008540324" frameborder="0" class="company-map" allowfullscreen></iframe>
                                        </code>
                                        -->
                                        <div style="width: 100%">
                                            <iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $row_com_location[0]['location'];?>&output=embed"></iframe>
                                        </div>
                                        <?php /*?>(Use Height=425,Width=350) <?php */?>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php /*?>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="5"  >
          <tr>
            <td width="229" height="25"   valign="top"> Map Code </strong> *</font></div></td>
            <td valign="top"><strong>:</strong></td>
            <td width="1039" height="25">
              <textarea cols="50" id="editor_office2003" name="add_com_location" rows="10"><?php echo $row_com_location['location'];?></textarea>
            </td>
          </tr>
          <tr>
            <td width="229" height="25"  >&nbsp;</td>
            <td width="16">&nbsp; </td>
            <td height="25">
            <input type="submit" name="add_location" value="ADD LOCATION" class=button>
            (Use Height=425,Width=350)
            </td>
          </tr>
        </table>
        <?php */?>
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
    function updatelocation(){
        var formData = new FormData($('#locform')[0]);
        var base_url='<?php echo base_url();?>';
        $.ajax({
            url: base_url+"processmapLoc",
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
		