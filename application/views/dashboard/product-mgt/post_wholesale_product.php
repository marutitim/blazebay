<?php
$title = "Post wholesaleproduct";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";


$wholesale_item=1;

//getting loggedIn User's details
$logged_userid      = $this->session->userdata['logged_in']['user_id'];
$logged_memtype     = $this->session->userdata['logged_in']["memtype"];
$logged_user_id     = $this->session->userdata['logged_in']['user_id'];
$logged_user_planid = $this->session->userdata['logged_in']['memtype'];

//defined Tables
$businessTable = $prev."business";

//get Business details
$business_id = 0;
$getBusinessDetails =$this->Site_model->getRowData($businessTable,"user_id = '$logged_user_id'  ");
if(!empty($getBusinessDetails)){
    $business_id = $getBusinessDetails[0]['id'];
}

//get all units for dropdown
$unit_master_table      = $prev."unit_master";
$where= "unit_id >0";

$getall_units= $this->Site_model->getDataById($unit_master_table,$where);

//resize image height , width
$resizeWidth = 200;
$resizeHeight = 150;
$resizeDir = 'multimage/img_100X100/';
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
<div class="containerr">
<div class="col-md-12" >
<div class="featuredpro">
<h3 class="section-title"><a href="javascript:void(0);">Post Wholesale Product</a></h3>

<?php
$logged_userid = $this->session->userdata['logged_in']['user_id'];

// Get Plan Details
$sbq_gro = "select * from " . $prev . "membership_plan where plan_id ='" . $logged_user_planid . "'";
$sbrow_gro =$this->Site_model->getcountRecods($sbq_gro);
$PLAN_ALLOWED_PRODUCTS_NO = $sbrow_gro[0]["no_of_products"];

$errcnt = 0;

/////////---getting config---------
$sbq_con = "select * from " . $prev . "config where id=1";
$sbrow_con = $this->Site_model->getcountRecods($sbq_con);

$sbq_gro = "select * from " . $prev . "privilage where privilage_id='" . $logged_user_planid. "'";
$sbrow_gro = $this->Site_model->getcountRecods($sbq_gro);

//--getting information bout user's privious postings
$sbq_off = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . " and approved ='yes' and expireson > now()";

$sbsell_count =count($this->Site_model->getcountRecods($sbq_off));
//////////////////////////////////---------------------------
// if( $sbsell_count >= $sbrow_gro["no_of_products"] )
// {
//  $msg="You have already posted maximum allowed product catalogs.";
// }

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


$showform = "";

if (count($_POST) > 0)
{
    //$cid_list = $_POST["cid"];
    //$cat_list = $_POST["category"];
    if (isset($_POST["cid"])){ $cid_list = $_POST["cid"]; } else { $cid_list = "";  }
    if (isset($_POST["category"])) { $cat_list = $_POST["category"];} else { $cat_list = ""; }
}
?>


<?php
//$sbq_gro = "select * from " . $prev . "membership_plan where plan_id ='" . $_SESSION["memtype"] . "'";
//$sbrow_gro = mysql_fetch_array(mysql_query($sbq_gro));
//$sbrow_gro["no_of_products"];
//Catalogs: Posted -  <?php echo $sbsell_count;
//Maximum Allowed -  <?php echo $sbrow_gro["no_of_products"];

//getting user's privious postings
$sbq_off = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'];
$sbsell_count = count($this->Site_model->getcountRecods($sbq_off));
$USER_POSTED_PRODUCTS = count($this->Site_model->getcountRecods($sbq_off)); // TOTAL POSTED PRODUCTS

$my_active_products_sql = "SELECT * FROM " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id']." AND approved = 'yes'";
$USER_ACTIVE_PRODUCTS = count($this->Site_model->getcountRecods($my_active_products_sql));

?>

<p>
    <?php
    // Display message
    //$msg->display();
    ?>
</p>

<p class="text-color-red">Product Maximum Allowed -  (<?php echo $PLAN_ALLOWED_PRODUCTS_NO;?>)</p>
<p class="text-color-red">
    Catalogs: Posted - (<?php echo $USER_POSTED_PRODUCTS;?>) ,&nbsp;&nbsp;
    Active Products : Posted - (<?php echo $USER_ACTIVE_PRODUCTS;?>)
</p>
<div id="msgReplies"></div>
<?php
//if ($sbsell_count >= $sbrow_gro["no_of_products"])
if($USER_POSTED_PRODUCTS >= ($PLAN_ALLOWED_PRODUCTS_NO))
{
    ?>
    <br>
    <h5><font color=red>You Have Exceeded Maximum Number Of Products.</font></h5>
    <h5>
        <a href="<?php echo base_url() . 'upgrade-membership'; ?>" ><font color="green">Please Upgrade Your Membership Plan</font></a>
    </h5>

<?php
}
else
{

    ?>
    <br>
    <form name="form123" id="form123" method="post" action="#"  enctype="multipart/form-data">
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
            <select class="col-sm-12 form-control zsr-pro-brand" id="cat_group" name="group">

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



        <td>Category <font color="#FF0000">*</font></td>

        <td>  <td>

            <select name="subctid" class="form-control select1" id="subcatdiv">  </select>

            <span id="elmcatError" class="errorMsg">&nbsp;</span>

        </td></td>


    <tr valign="top">
        <td align="left" colspan="2" > Title <font color="#FF0000">*</font></td>
        <td>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter Title" value="<?php echo $title; ?>" size="30" maxlength="160"><span id="elmtitleError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>

    <tr valign="top">
        <td align="left" colspan="2">Description  </td>
        <td valign="middle">
            <textarea cols="80" id="description2"  name="description" placeholder="Enter Description" id="description2" rows="5"></textarea>
            <input type="hidden" required="" id="description" class="form-control" name="description">

            <span id="elmdecError" class="errorMsg">&nbsp;</span>
        </td>

    </tr>
    <tr valign="top">
        <td align="left" colspan="2">Wholesale Price <font color="#FF0000">*</font></td>
        <td>

            <div class="row">

                <div class="col-sm-4">

                    <span>Quantity</span>
                    <input type="number" required="" id="product_qty" class="form-control" name="product_qty">

                </div>



                <div class="col-sm-4">

                    <span>Minimum Product Price</span>
                    <input type="number" required="" class="form-control"  id="minproduct_price" name="minproduct_price">

                </div>





                <div class="col-sm-4">


                    <span>Maximum Product Price</span>
                    <input type="number" required="" class="form-control"  id="maxproduct_price" name="maxproduct_price">


                </div>

            </div>

        </td>

    </tr>

    <tr valign="top">
        <td colspan="2">Minimum Order <font color="#FF0000">*</font></td>
        <td>

            <div class="row">

                <div class="col-sm-4">
                    <span>Minimum Order<font color="#FF0000">*</font></span>
                    <input name="min_order" class="form-control" placeholder="Enter Minimum Order" type="number" id="min_order" value="<?php echo $min_order; ?>"  maxlength="20">
                    <span id="elmminError" class="errorMsg">&nbsp;</span>

                </div>



                <div class="col-sm-4">

                    <span>Minimum Sell Price</span>
                    <input type="number" required="" readonly="" class="form-control" id="minwhole_sell_price" name="minwhole_sell_price">

                </div>





                <div class="col-sm-4">

                    <span>Maximum Sell Price</span>
                    <input type="number" required="" readonly="" class="form-control" id="maxwhole_sell_price" name="maxwhole_sell_price">

                </div>

            </div>



        </td>
    </tr>

    <tr valign="top">
        <td colspan="2"><label>Currency</label> <font color="#FF0000">*</font></td>
        <td>
            <div class="row">
                <div class="col-sm-4">

                    <select name="price_cur_id" id="price_cur_id" class="col-sm-12 form-control" >
                        <option value="">Select Currency</option>
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

                    <select name="product_units" id="product_units" class="col-sm-12 form-control" >

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

    <!-- <tr valign="top">
                                    <td colspan="2">Price <font color="#FF0000">*</font></td>
                                    <td>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Currency</label>
                                            <select name="price_cur_id" id="price_cur_id" class="col-sm-12 form-control1" >
                                                <option value="">Select Currency</option>
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
                                            <label>Product Price</label>
                                            <input name="price" id="price" type="number" value="<?=$supplier_price;?>"  maxlength="7" placeholder="Enter Price" class="col-sm-12 form-control1"  min="0";>

                                            <span id="elmpriceError" class="errorMsg">&nbsp;</span>
                                        </div>


                                        <div class="col-sm-4">
                                            <label>Sell Price</label>
                                            <input type="text" name="product_sell_price" id="product_sell_price" value="<?=$price; ?>" readonly="" placeholder="Product Price" class="col-sm-12 form-control1" >

                                        </div>
                                    </div>
                                    </td>
                                </tr> -->

    <tr valign="top">
        <td colspan="2">Type </td>
        <td>
            <input name="type" type="text" id="type" placeholder="Enter Type" value="<?php echo $type; ?>" class="form-control">
        </td>
    </tr>

    <tr valign="top">
        <td colspan="2">Features </td>
        <td>
            <textarea name="features2"  id="features2" placeholder="Enter Features" value="<?php echo $features; ?>" class="form-control" cols="50" rows="6" ></textarea>
            <input type="hidden" required="" id="features" class="form-control" name="features" value="<?php echo $features; ?>">
        </td>

    </tr>

    <tr valign="top">
        <td width="20%" colspan="2" >Samples Available <font color="#FF0000">*</font></td>
        <td>
            <select name="samples_available" id="samples_available" class="form-control" >
                <option value="">Please Select</option>
                <option value="yes" <?php echo ($samples_available == "yes") ? 'selected' : ''; ?>>Yes</option>
                <option value="no"                          <?php
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
                <option value="Used"                            <?php
                if ($product_status == "Used") {
                    echo "selected";
                }
                ?>>Used</option>
            </select>
            <span id="elmpstatusError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>

    <!--
                                <tr valign="top">
                                    <td width="20%" colspan="2" >Delivery Time <font color="#FF0000">*</font> </td>
                                    <td ><input name="delivery_time" id="delivery_time"  placeholder="Enter Delivery Time" class="form-control" style="width:30%;"  type="text" value="<?php echo $delivery_time; ?>" size="6">
                                        Days
                                        <span id="elmpdeliveryError" class="errorMsg">&nbsp;</span>
                                    </td>
                                </tr>
                                -->
    <!--
                                <tr valign="top">
                                    <td width="20%" colspan="2" >Payments
                                        Mode <font color="#FF0000">*</font></td>
                                    <td >
                                        <input  name="cash[]" type="checkbox"  value="cash" >
                                        Cash <br>
                                        <input  name="cash[]" type="checkbox"  value="cheque" >
                                        Cheque<br>

                                        <input  name="cash[]" type="checkbox"  value="credit">
                                        Credit card<br>

                                        <input  name="cash[]" type="checkbox"  value="bank">
                                        Bank transfer<br>

                                        <input  name="cash[]" type="checkbox"  value="loc">
                                        Letter of Credit<br>

                                        <input  name="cash[]" type="checkbox"  value="escrow">
                                        Escrow <br>
                                        Other:
                                        <input name="other_mode" type="text" id="other_mode" value="<?php //echo $other_mode; ?>">
                                        <span id="elmpcashError" class="errorMsg">&nbsp;</span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <td colspan="2">Shipping
                                        Cost  <font color="#FF0000">*</font> </td>


                                    <td>
                                        <input name="shipping_cost" type="text" id="shipping_cost"  placeholder="Enter Shipping Cost" class="form-control" value="<?php echo $shipping_cost; ?>" size="3">
                                        <label name="shipping_cost_crncy"  id="shipping_cost_crncy"   class="form-control" size="2"></label>
                                        <span id="elmpshippingError" class="errorMsg">&nbsp;</span>
                                    </td>
                                </tr>
                                -->
    <tr valign="top">
        <td> Expires on <br>
        </td>
        <td> </td>
        <td><input type="text" name="expireson" id="expireson" readonly placeholder="Enter Expire date" class="datepicker form-control">
            <span id="expiresonError" class="errorMsg">&nbsp;</span>
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

        <td colspan="2">Color </td>

        <td>

            <input name="color" type="text" id="color" placeholder="Enter color"  class="form-control">
            <p>  Please specify color separated by a comma. Appropriate color will lead

                more buyers to finding the exact product.</p>

        </td>

    </tr>
    <tr valign="top">

        <td colspan="2">Size </td>

        <td>

            <input name="size" type="text" id="size" placeholder="Enter size"  class="form-control">
            <p>  Please specify size separated by a comma. Appropriate size will lead

                more buyers to finding the exact product.</p>

        </td>

    </tr>
    <tr valign="top">
        <td colspan="2"> Picture </td>

        <td>

            <div class="input-group">
                <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    Browse&hellip; <input type="file" style="display: none;" name="fileToUpload" id="fileToUpload" multiple>
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

                                                    <span  id="filediv">
                                                    <input class="btn btn-warning btn-big" name="file[]" type="file" id="file"/>

                                                    <input type="button" id="add_more" class="btn btn-warning btn-big" value="Add More Files"/>
                                                    </span>
                    <!--input type="submit" value="Upload File" name="submit" id="upload" class="upload"/-->

                </label>
                <!--input type="text" class="form-control" style="border:0px;" readonly-->
            </div>
        </td>
    </tr>

    <tr><td colspan=3 ><hr size=1></td></tr>
    <tr valign="top">
        <td align="left" colspan="2" >&nbsp;</td>

        <td>

            <input name="submit"  type="submit" value="Post Now "  onClick="validate_form()" class="btn btn-warning btn-big float-right">

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
        }

    });
    tinymce.init({
        selector: '#features2',
        height: 50,
        init_instance_callback: function (editor) {
        editor.on('keyup', function (e) {
            $("#features").val(editor.getContent());
        });
    }
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {

        //$('#subcatdiv').css('display','block');

        $("#cat_group").change(function () {

            var groupid = $('#cat_group').val();

            //alert(groupid);



            $.ajax({

                url: "<?= base_url() ?>get/sub/subcat/" +groupid,

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


<script>

    function validate_form(){

        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#form123')[0]);
        $.ajax({
            url: base_url+"process_post_wholesale_product",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                window.location.href=base_url+"manage-wholesale-products";
            },
            cache: false,
            contentType: false,
            processData: false
        });

        event.preventDefault();

    }

    $("#form123").submit(function(e) {
        e.preventDefault();
    });
</script>
<script src="<?=base_url()?>assets/multimage/script.js"></script>


<link href="<?=base_url()?>datepicker/datepicker.css" rel="stylesheet" />

<script src="<?=base_url()?>datepicker/bootstrap-datepicker.js"></script>


<script>

    $('.datepicker').datepicker({

        format: 'dd-mm-yyyy',

        todayHighlight: 'TRUE',

        startDate: '-0d',

        autoclose: true,

    })



    function calpercentagemin(e)

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

            document.getElementById("minwhole_sell_price").value = nprice;

        }

        //alert(spval +' -- '+nprice);

    }

    function calpercentagemax(e)

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

            document.getElementById("maxwhole_sell_price").value = nprice;

        }

        //alert(spval +' -- '+nprice);

    }

</script>
</script>



<script>

$(function () {

    // $("#location").geocomplete({

    //     details: ".geo-details",

    //     detailsAttribute: "data-geo"

    // });



    $("#minproduct_price").on('keyup change',function(){



        /* if (/\D/g.test(this.value)){

         this.value = this.value.replace(/\D/g,'');

         }*/

        calpercentagemin(this);

    });
    $("#maxproduct_price").on('keyup change',function(){



        /* if (/\D/g.test(this.value)){

         this.value = this.value.replace(/\D/g,'');

         }*/

        calpercentagemax(this);

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


<script>

    $('.datepicker').datepicker({

        format: 'dd-mm-yyyy',

        todayHighlight: 'TRUE',

        startDate: '-0d',

        autoclose: true,

    })

</script>

</body>
</html>
