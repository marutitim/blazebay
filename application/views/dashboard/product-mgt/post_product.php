<?php
$pagename = "postproduct";

if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
//include ("logincheck.php");

//for flash messages
//$FlashMessages = new \Plasticbrain\FlashMessages\FlashMessages();




//current page link
$current_page_link = base_url()."post-product/";
//$current_page_link = base_url()."post_product_new.php/";
// Getting admin percentage
$ADMIN_PERCENTAGE=10;
//@$ADMIN_PERCENTAGE = $_SESSION['SETTING_ADMIN_PERCENT'];

//getting loggedIn User's details
$logged_userid      = $this->session->userdata['logged_in']['user_id'];
$logged_memtype     = $this->session->userdata['logged_in']["memtype"];
$logged_user_id     = $this->session->userdata['logged_in']['user_id'];
$logged_user_planid = $this->session->userdata['logged_in']['memtype'];

//defining tables
$prev="bt_";
$product_table          = $prev."products";
$product_images_table   = $prev."product_images";
$product_cats_table     = $prev."product_cats";
$business_table         = $prev."business";
$unit_master_table      = $prev."unit_master";
$membership_plan_table  = $prev."membership_plan";
$masterBrandTable       = $prev."master_brands";

//resize image height , width
$resizeWidth = 200;
$resizeHeight = 150;
$resizeDir = 'multimage/img_100X100/';

//getting logged on user details
$where ="user_id = '".$logged_userid."'";

$user_details= $this->Site_model->getDataById( 'bt_members',$where);
//getting business Details
$where ="user_id ='$logged_userid'";
$businessDetails= $this->Site_model->getDataById($business_table,$where);
$businessId      = $businessDetails[0]['id'];
//get all units for dropdown
$where= "unit_id >0";

$getall_units= $this->Site_model->getDataById($unit_master_table,$where);
//get all Brands

$where = "brand_status ='Y' ORDER BY brand_name ASC";

$getall_brands= $this->Site_model->getDataById($masterBrandTable,$where);
//p($getall_brands);

//get previous products Count
$count_preposted_productsq ="SELECT * FROM $product_table WHERE uid ='$logged_userid'";
$count_preposted_products= $this->Site_model->getcountRecods($count_preposted_productsq);
//get user's posted active products count
$Qcount_posted_active_products = "SELECT * FROM $product_table WHERE uid ='$logged_userid' AND approved ='yes'";

$count_posted_active_products= $this->Site_model->getcountRecods($Qcount_posted_active_products);
//$USER_ACTIVE_PRODUCTS

//get supplier member's plan details
$where ="plan_id ='$logged_user_planid'";

$get_plan_Details= $this->Site_model->getDataById($membership_plan_table,$where);
if($get_plan_Details){
    $PLAN_ALLOWED_PRODUCTS_NO = $get_plan_Details[0]["no_of_products"];
    $allowed_to_postproduct   = $PLAN_ALLOWED_PRODUCTS_NO;
}


//====== when a product posted :: Starts =======


/////////---getting config---------

$where = " id=1";

$sbrow_con= $this->Site_model->getDataById("bt_config",$where);


//$sbq_gro = "select * from " . $prev . "privilage where privilage_id='" . $_SESSION["memtype"] . "'";

$where="privilage_id='" . $this->session->userdata['logged_in']["memtype"] . "'";
$sbrow_grores= $this->Site_model->getDataById("bt_privilage",$where);

//$sbrow_gro = mysql_fetch_array(mysql_query($sbq_gro));


$sbrow_gro=$sbrow_grores[0];


$cid_list = '';

$cat_list = '';

$title = '';

$description = '';

$origin = '';

$quantity = '';

$keywords = '';

$location = '';

$min_order = '';

$price_cur_id = '';

$price = '';

$product_sell_price ="";

$supplier_price="";

$samples_available = 'no';

$product_status = 'New';

$delivery_time = '';

$payment_mode = '';

$other_mode = '';

$shipping_cost = '';

$material = '';

$function = '';

$brand_name = '';

$quality = '';

$cbrand_name = '';

$model_number = '';

$color = '';

$type = '';

$features = '';

//====== when a product posted :: Ends =======
$title="Post Product";
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
    <style>
        .form-control {
            width: 100% !important;

        }
    </style>
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
<div class="containerr">
<div class="col-md-12">
<div class="modal-backdrop fade in" id="loadDiv" style="display: none;">
    <div class="ajaxLoadCss" style="margin-left: 656px;margin-top: 200px; background-color:transparent !important">
        <img src="<?php echo base_url()?>assets/img/ajaxLoad2.gif" /></div>
</div>
<div class="featuredpro">
<h3 class="section-title"><a href="javascript:void(0);">Post Product </a></h3>
<p>  <?php //$FlashMessages->display(); ?> </p>
<p class="text-color-red">Product Maximum Allowed -  (<?php echo $allowed_to_postproduct;?>)</p>
<p class="text-color-red">
    Catalogs: Posted - (<?php echo $count_preposted_products? count($count_preposted_products):0;?>) ,&nbsp;&nbsp;
    Active Products : Posted - (<?php echo $count_posted_active_products ? count($count_posted_active_products):0;?>)
</p>
<div id="msgReplies"></div>
<?php

if(!empty($num)){
    $num=count($count_preposted_products);
}else{
    $num=0;
}
if($num > $allowed_to_postproduct)
{
    ?>
    <br>
    <h5><font color="red">You Have Exceeded Maximum Number Of Products.</font></h5>
    <h5>
        <a href="<?php echo base_url() . 'upgrade-membership'; ?>" ><font color="green">Please Upgrade Your Membership Plan</font></a>
    </h5>
<?php
}
else
{

    ?>
    <br>

    <form name="submit_products_form" method="post" action="#" id="submit_products_form" enctype="multipart/form-data">
    <?php
    /*
    if (isset($_SESSION['after_post_msg']) && $_SESSION['after_post_msg'] != '')
    { ?>

        <div class="alert alert-success alert-dismissable" style="text-align:center;"><?php echo $_SESSION['after_post_msg']; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button></div>

        <?php
        unset($_SESSION['after_post_msg']);
    }
    */
    ?>

    <?php if (isset($_SESSION['err_msg']) && $_SESSION['err_msg'] != '') { ?>
        <div class="alert alert-danger alert-dismissable" style="text-align:center;"><?php echo $_SESSION['err_msg']; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button></div>

        <?php
        unset($_SESSION['err_msg']);
    }
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="5" >
    <tr>
        <td colspan="3">
        </td>
    </tr>

    <tr>
        <td>Group Head <font color="#FF0000">*</font></td>
        <td></td>
        <td>
            <select class="form-control zsr-pro-brand" id="cat_group" name="group">

                <?php
                $qry="SELECT group_id,group_name FROM bt_categorie_group";
                $groupDropdown= $this->Site_model->execute($qry );
                if($groupDropdown){

                    foreach ($groupDropdown as $eachgroup) {?>

                        <option value="<?php echo $eachgroup['group_id'];?>"><?php echo $eachgroup['group_name'];?></option>

                    <?php } ?>

                    <option value="others">Others</option>

                <?php } ?>

            </select>
            <span id="elmgroupError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr>
        <td>Category <font color="#FF0000">*</font></td>
        <td>  <td>

            <select name="subctid" class="form-control select1" id="subcatdiv">  </select>

            <span id="elmcatError" class="errorMsg">&nbsp;</span>

        </td></td>
        <td>
            <?php
            /*$qry="SELECT id,cat_name FROM bt_categories where pid='0' and status='Y' ORDER BY cat_name";
            $categoryDropdown= $this->Site_model->getcategoryDropdown($qry );
                if ($categoryDropdown) {
                if (isset ( $_POST ["subctid"] )) {
                    $selectcat = $_POST ["subctid"];
               } else {
                   $selectcat = "";
              }
                $js = 'class="form-control" id="subctid" name="subctid" ';
               echo form_dropdown ( 'subctid', $categoryDropdown, $selectcat, $js );
                }*/
            ?>
            <span id="elmcatError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>


    <tr valign="top">
        <td align="left" colspan="2" > Title <font color="#FF0000">*</font></td>
        <td>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter Title"  size="30" maxlength="40"><span id="elmtitleError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>

    <tr valign="top">
        <td align="left" colspan="2">Description  </td>
        <td valign="middle">
            <textarea cols="120" class="form-control"  name="description2" placeholder="Enter Description" id="description2" rows="5"></textarea>

            <input type="hidden" required="" id="description" class="form-control" name="description">
            <span id="elmdecError" class="errorMsg">&nbsp;</span>
        </td>

    </tr>
    <tr valign="top">
        <td align="left" colspan="2"> Quantity <font color="#FF0000">*</font></td>
        <td>
            <input name="quantity" type="number"  class="form-control" placeholder="Enter Quantity" id="quantity" value="<?php echo $quantity; ?>" size="30" maxlength="40">
            </font> &nbsp;
            <span id="elmquanError" class="errorMsg">&nbsp;</span>
        </td>

    </tr>
    <tr valign="top">
        <td align="left" colspan="2">Keywords
            <font class="smalltext"><font color="#FF0000">*</font></td>
        <td><input name="keywords" type="text" class="form-control"  placeholder="Enter Keyword" id="keywords" value="<?php echo $keywords; ?>" size="30" maxlength="40">
            <p>  Please specify a comma seperated list
                of keywords related to your product. Appropriate keywords will lead
                more buyers to find your products.</p><span id="elmkeyError" class="errorMsg">&nbsp;</span></td>
    </tr>

    <tr valign="top">
        <td colspan="2">Place of Origin </td>
        <td>
            <input name="origin" type="text" id="origin"  placeholder="Enter Place of Origin" value="<?php echo $origin; ?>" class="form-control">
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2">Material </td>
        <td>
            <input name="material" type="text" placeholder="Enter Material" class="form-control" id="material" value="<?php echo $material; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2">Function </td>
        <td>
            <input name="function" class="form-control" placeholder="Enter Function" type="text" id="function" value="<?php echo $function; ?>">
        </td>
    </tr>
    <!--
                                <tr valign="top">
                                    <td colspan="2">Brand Name </td>
                                    <td>
                                        <input name="brand_name" type="text" id="brand_name"  placeholder="Enter Brand Name" class="form-control" value="<?php //echo $brand_name; ?>">
                                    </td>
                                </tr>
                                -->

    <input name="brand_name" type="hidden" value="" />

    <tr valign="top">
        <td colspan="2">Brand Name </td>
        <td>
            <div class="row">
                <div class="col-sm-4">
                    <select class="form-control zsr-pro-brand" name="product_brand">
                        <?php
                        if($getall_brands){
                            foreach ($getall_brands as $eachBrands) {?>
                                <option value="<?php echo $eachBrands['brand_id'];?>"><?php echo $eachBrands['brand_name'];?></option>
                            <?php } ?>
                            <option value="others">Others</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4 zsr-pro-brand-othr" style="display:none;">
                    <input class="col-sm-12 form-control1 " id="brand-othr-inptid" name="other_brand" value="" placeholder="Enter Brand Name" />
                </div>
                <span id="eror_brand_msg" class="errorMsg">&nbsp;</span>
                <div class="clearfix">
                </div>
            </div>
        </td>
    </tr>

    <tr valign="top">
        <td colspan="2">Compatible Brand </td>
        <td>
            <input name="cbrand_name" type="text" id="cbrand_name" placeholder="Enter Compatible Brand" class="form-control" value="<?php echo $cbrand_name; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2" >Model Number </td>
        <td>
            <input name="model_number" type="text" placeholder="Enter Model Number" class="form-control" id="model_number" value="<?php echo $model_number; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2">Color </td>
        <td>
            <input name="color" type="text" id="color" placeholder="Enter Color" value="<?php echo $color; ?>" class="form-control">
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2">Type </td>
        <td>
            <input name="type" type="text" id="type" placeholder="Enter Type" value="<?php echo $type; ?>" class="form-control">
        </td>
    </tr>
    <tr valign="top">


        <td colspan="2">Location <font color="#FF0000">*</font></td>
        <td>

            <input type="text" name="location" id="location" class="location form-control" placeholder="Enter Location" value="<?php echo $location; ?>" required="">


            <!-- <input type="text" name="location" id="pac-input" class="pac-input form-control" placeholder="Enter Location" value="<?php echo $location; ?>" required=""> -->



            <span id="elmlocError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2">Features </td>
        <td>
            <textarea name="features2"  id="features2" placeholder="Enter Features" value="<?php echo $features; ?>" class="form-control" cols="50" rows="6" ></textarea>
            <input type="hidden" required="" id="features" class="form-control"  value="<?php echo $features; ?>"  name="features">
        </td>

    </tr>
    <tr valign="top">
        <td colspan="2">Minimum Order <font color="#FF0000">*</font></td>
        <td>
            <input name="min_order" class="form-control" placeholder="Enter Minimum Order" type="number" id="min_order" value="<?php echo $min_order; ?>"  maxlength="20">
            <span id="elmminError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">

        <td colspan="2">Weight(Kg) <font color="#FF0000">*</font></td>

        <td>

            <input name="weight" class="form-control" placeholder="Enter product weight" type="text" id="weight"   maxlength="20">

            <span id="elmminError" class="errorMsg">&nbsp;</span>

        </td>

    </tr>
    <tr valign="top">
        <td colspan="2">Price <font color="#FF0000">*</font></td>
        <td>
            <div class="row">
                <div class="col-sm-4">
                    <label>Currency</label>
                    <select name="price_cur_id" id="price_cur_id" class="form-control" >
                        <option value="">-- Select Currency --</option>
                        <?php
                        $rs_query = $this->Site_model->getcountRecods("Select * from " . $prev . "currencies where sbcur_status = '1'");
                        foreach ($rs_query as $rs) {
                            ?>
                            <option value="<?php echo $rs["sbcur_id"]; ?>"
                                <?php
                                if ($rs["sbcur_id"] == $price_cur_id) {
                                    echo "  selected ";
                                }
                                ?>><?php echo $rs["sbcur_name"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    &nbsp;&nbsp;
                    <span id="elmprice_curError" class="errorMsg">&nbsp;</span>
                </div>

                <div class="col-sm-4">

                    <!--

                                                <input name="price" class="form-control" placeholder="Enter Price" type="text" id="price" value="<?php //echo $price; ?>" size="5" maxlength="30">

                                                -->

                    <label>Minimum Product Price</label>



                    <input name="minprice" id="minprice" type="number" value="<?=$supplier_price;?>"  maxlength="10" placeholder="Enter minimum price" class="form-control"  min="0" >

                    <span id="elmpriceError" class="errorMsg">&nbsp;</span>

                </div>


                <div class="col-sm-4">

                    <!--

                                                <input name="price" class="form-control" placeholder="Enter Price" type="text" id="price" value="<?php //echo $price; ?>" size="5" maxlength="30">

                                                -->

                    <label>Maximum Product Price</label>

                    <!--<input name="price" id="price" type="text" value="<?=$supplier_price;?>"  maxlength="7" placeholder="Enter Price" class="col-sm-12 form-control1"  min="0";>



                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"



                                                -->

                    <input name="maxprice" id="maxprice" type="number" value="<?=$supplier_price;?>"  maxlength="10" placeholder="Enter maximum price" class="form-control"  min="0" >

                    <span id="elmpriceError" class="errorMsg">&nbsp;</span>

                </div>

                <div class="col-sm-4">

                    <label>Minimum  Sell Price</label>

                    <input type="number" name="minproduct_sell_price" id="minproduct_sell_price" value="<?=$price; ?>" readonly=""
                           placeholder="Product Price" class="form-control" >



                </div>
                <div class="col-sm-4">
                    <label>Maximum Sell Price</label>
                    <input type="number" name="maxproduct_sell_price" id="maxproduct_sell_price" value="<?=$price; ?>"
                           readonly="" placeholder="Product Price" class="form-control" >

                </div>

                <div class="col-sm-4">
                    <label>Unit</label>
                    <select name="product_units" id="product_units" class="form-control" >

                        <option value="">-- Select Unit --</option>

                        <?php

                        if($getall_units){

                            foreach ($getall_units as $key => $eachUnits) { ?>



                                <option value="<?php echo $eachUnits['unit_id'];?>" ><?php echo $eachUnits['unit_name'];?> </option>



                            <?php }

                        } ?>

                    </select>

                    &nbsp;&nbsp;

                    <span id="elmproductunitError" class="errorMsg">&nbsp;</span>

                </div>
            </div>
        </td>
    </tr>

    <tr valign="top">
        <td width="20%" colspan="2" >Samples Available <font color="#FF0000">*</font></td>
        <td>
            <select name="samples_available" id="samples_available" class="form-control" >
                <option value="">Please Select</option>
                <option value="yes" <?php echo ($samples_available == "yes") ? 'selected' : ''; ?>>Yes</option>
                <option value="no" 							<?php
                if ($samples_available == "no") {
                    echo "selected";
                }
                ?>>No</option>
            </select>
            <span id="elmsampleError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">
        <td width="20%" colspan="2" >Product Status <font color="#FF0000">*</font></td>
        <td>
            <select name='product_status' id="product_status" class="form-control">
                <option value="">Please select</option>
                <option value="New"
                    <?php
                    if ($product_status == "New") {
                        echo "selected";
                    }
                    ?>>New</option>
                <option value="Used" 							<?php
                if ($product_status == "Used") {
                    echo "selected";
                }
                ?>>Used</option>
            </select>
            <span id="elmpstatusError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>

    <tr valign="top">
        <td> Expires on <br>
        </td>
        <td> </td>
        <td><input type="text" name="expireson" id="expireson" readonly placeholder="Enter Expire date" class="datepicker form-control">
            <span id="expiresonError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2"> Picture </td>

        <td>

            <div class="input-group">
                <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    Browse&hellip; <input type="file"  name="fileToUpload" id="fileToUpload" >
                                                </span>
                </label>

            </div>
        </td>
    </tr>
    <tr valign="top">
        <td colspan="2"> Slider Images </td>
        <td>
            <div class="input-group">
                <label class="input-group-btn">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                    <script src="https://www.blazebay.com/assets/multimage/script.js"></script>
                    <form enctype="multipart/form-data" action="" method="post">

                                                    <span  id="filediv">
                                                    <input class="btn btn-warning btn-big" name="file[]" type="file" id="file"/>
                                                    <input type="button" id="add_more" class="btn btn-warning btn-big" value="Add More Files"/>
                                                    </span>
                        <!--input type="submit" value="Upload File" name="submit" id="upload" class="upload"/-->
                    </form>
                </label>
                <!--input type="text" class="form-control" style="border:0px;" readonly-->
            </div>
        </td>
    </tr>

    <tr><td colspan=3 ><hr size=1></td></tr>
    <tr valign="top">
        <td align="left" colspan="2" >&nbsp;</td>

        <td>

            <input name="submit"  type="button" value="Post Now "  onclick="submit_products();"class="btn btn-warning btn-big float-right" id="post_product_btn" >

        </td>
    </tr>
    </table></td>
    </tr>
    </table>
    </form>
<?php } ?>

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
        selector: '#description2',
        height: 50,
        init_instance_callback: function (editor) {
        editor.on('keyup', function (e) {
            $("#description").val(editor.getContent());
        });

    });
    tinymce.init({
        selector: '#features2',
        height: 50,
        init_instance_callback: function (editor) {
            editor.on('keyup', function (e) {
                $("#features").val(editor.getContent());
            });
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {

        //$('#subcatdiv').css('display','block');

        $("#cat_group").change(function () {

            var groupid = $('#cat_group').val();

            //alert(groupid);



            $.ajax({

                url: "<?php echo base_url();?>get/sub/subcat/" +groupid,

                type: "GET",
                success: function (data) {

                    var result = $.trim(data);

                    //alert(result);

                    console.log(data);

                    //$('#subcatdiv').html(data);

                    if (result == '<option value="">Choose a category</option>') {

                        //$('#subcatdiv').css('display','none');

                        //$('#subcatdiv').removeAttr('required');

                        $("#subcatdiv").empty();

                    } else {

                        $("#subcatdiv").empty();

                        $('#subcatdiv').css('display', 'block');

                        //$('#subcatdiv').attr('required','required');

                        $('#subcatdiv').html(data);

                    }



                }

            });

        });
    });

    function submit_products(){
        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#submit_products_form')[0]);
        $("#loadDiv").show();
        $.ajax({
            url: base_url+"process_post_product",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                $("#loadDiv").hide();
            },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();

    }

    function calpercentgemin(e)
    {
        var pcnt=<?php echo 5;?>;
        var nprice=0;
        var spval= e.value;   //alert(spval);

        if(spval == 'NaN' || spval == "") {
            spval = 0.00;
            document.getElementById("minproduct_sell_price").value = spval.toFixed(2);
        } else {
            spval = parseFloat(spval);
            pcnt = parseFloat(pcnt);
            var pcnt_rs = parseFloat( parseFloat( spval*pcnt )/100 );
            nprice = parseFloat(spval + pcnt_rs);
            //nprice = Math.ceil(nprice);
            //document.getElementById("product_sell_price").value = nprice.toFixed(2);
            document.getElementById("minproduct_sell_price").value = nprice;
        }
        //alert(spval +' -- '+nprice);
    }

    function calpercentgemax(e)

    {

        var pcnt=<?php echo 5;?>;

        var nprice=0;

        var spval= e.value;   //alert(spval);



        if(spval == 'NaN' || spval == "") {

            spval = 0.00;

            document.getElementById("maxproduct_sell_price").value = spval.toFixed(2);

        } else {

            spval = parseFloat(spval);

            pcnt = parseFloat(pcnt);

            var pcnt_rs = parseFloat( parseFloat( spval*pcnt )/100 );

            nprice = parseFloat(spval + pcnt_rs);

            //nprice = Math.ceil(nprice);

            //document.getElementById("product_sell_price").value = nprice.toFixed(2);

            document.getElementById("maxproduct_sell_price").value = nprice;

        }

        //alert(spval +' -- '+nprice);

    }
</script>
<!-- -->
<script>
    $(document).ready(function () {


        $(".zsr-pro-brand").on('change',function(){

            var optval = $(this).val();

            if(optval=="others"){

                $(".zsr-pro-brand-othr").css('display','block');

            }else{

                $(".zsr-pro-brand-othr").css('display','none');

            }

        });

        $("#post_product_btn").on('click', function(){

            var seloptval = $(".zsr-pro-brand").val();

            $("#eror_brand_msg").html("");

            if(seloptval=="others"){

                var other_inpt = $("#brand-othr-inptid").val();

                if(other_inpt =="" || other_inpt == " "){

                    $("#eror_brand_msg").html("Please Enter Brand Name");

                    return false;

                }

            }

        });

    });



</script>
<script>
    $(function () {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    //if( log ) alert(log);
                }

            });
        });

    });
</script>

<script language="javascript">
    function add_category()
    {
        if (document.form123.cats.value != 0)
        {
            var id = document.form123.cats.selectedIndex;
            //////-------checking duplicate category
            var cid_list = document.form123.cid.value.split(";");
            var cnt = 0;
            var posted = "no";
            while (cnt < cid_list.length)
            {
                if (cid_list[cnt] == document.form123.cats.value)
                {
                    posted = "yes";
                }
                cnt++;
            }
            if (posted == "yes")
            {
                alert('This category is already in the list');
                return false;
            }
            //////-------end checking duplicate category
            //////-------checking max no. of categories

            var sblength;
            if (document.form123.category.value == "")
                sblength = 0;
            else
                sblength = cid_list.length
            if ( sblength >= <?php echo $sbrow_gro["no_of_products"];?>)
            {
                alert("You can't choose more than <?php echo ($allowed_to_postproduct == 1) ? $allowed_to_postproduct . ' category' : $allowed_to_postproduct . ' categories'; ?>");
                return false;
            }
            //////-------checking max no. of categories

            if (document.form123.category.value == "")
            {
                document.form123.cid.value = document.form123.cats.value;
                document.form123.category.value = document.form123.cats.options[id].text;
                document.form123.category.focus();
                document.form123.cats.selectedIndex = 0;
            } else
            {

                document.form123.cid.value = document.form123.cid.value + ";" + document.form123.cats.value;
                document.form123.category.value = document.form123.category.value + ";" + document.form123.cats.options[id].text;
                document.form123.category.focus();
                document.form123.cats.selectedIndex = 0;
            }
        } else
        {
            alert('Choose a Category to add');
        }
    }

    function remove_category()
    {
        window.document.form123.category.value = "";
        var s1 = window.document.form123.category.value;
        var s2 = s1.split(";");
        var i = 0;
        var id = document.form123.cats.selectedIndex;
        var s3 = document.form123.cats.options[id].text;

        var id_list = document.form123.cid.value;
        var id_split = id_list.split(";");
        var rem_id = document.form123.cats.value;

        window.document.form123.category.value = "";
        window.document.form123.cid.value = "";

        while (i < s2.length)
        {
            //alert('Checking '+s2[i]+' nnn  with'+s3+' mm');
            if (s3 == s2[i])
            {
                //continue;
                //	alert('Removing'+s3);
            } else
            {
                if (document.form123.category.value == "")
                {
                    document.form123.category.value = s2[i];
                } else
                {
                    document.form123.category.value = document.form123.category.value + ";" + s2[i];
                }

            }
            if (rem_id == id_split[i])
            {
                //continue;
                //	alert('Removing'+s3);
            } else
            {
                if (document.form123.cid.value == "")
                {
                    document.form123.cid.value = id_split[i];
                } else
                {
                    document.form123.cid.value = document.form123.cid.value + ";" + id_split[i];
                }

            }
            i++;
        }
        //window.document.form123.related.value="";
        //window.document.form123.rel_id.value="";
    }
</script>


<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: 'TRUE',
        startDate: '-0d',
        autoclose: true,
    })
</script>

<script>
    $(function () {
        // $("#location").geocomplete({
        //     details: ".geo-details",
        //     detailsAttribute: "data-geo"
        // });

        $("#minprice").on('keyup change',function(){

            /* if (/\D/g.test(this.value)){
             this.value = this.value.replace(/\D/g,'');
             }*/
            calpercentgemin(this);
        });
        $("#maxprice").on('keyup change',function(){



            /* if (/\D/g.test(this.value)){

             this.value = this.value.replace(/\D/g,'');

             }*/

            calpercentgemax(this);

        });

        // function isNumberKey(evt)
        // {
        //     var charCode = (evt.which) ? evt.which : evt.keyCode;
        //     if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
        //         this.value = this.value.replace(/\D/g,'');
        //         //return false;
        //     }
        //     return true;
        // }
    });
</script>
<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
</body>
</html>
