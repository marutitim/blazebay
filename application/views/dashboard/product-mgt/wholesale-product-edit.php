<?php
$title ="Edit Wholesaleproduct";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";


$ADMIN_PERCENTAGE =10;
$dateTypeYMD = date('Ymd');

if(isset($id) && $id !=""){
    $product_id = $id;
    $wholesale_pricelist =$this->Site_model-> getDataById($prev.'wholesale_product_price',"bt_w_product_id='$product_id'",TRUE);

}
$unit_master_table      = $prev."unit_master";
$where= "unit_id >0";

$getall_units= $this->Site_model->getDataById($unit_master_table,$where);

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
    <style>
        .form-control {
            width: 100% !important;

        }
    </style>

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
<div class="col-md-12">
<div class="col-md-12">

<div class="featuredpro">
<?php //$flash_msg->display(); ?>

<h2><i aria-hidden="true" class="fa"> <img src="<?php echo base_url();?>assets/images/FEATURED-PRODUCTS_ICON.png"></i> Product Catalogs > Edit Product</h2>
<?php
/////////---getting config---------
$sbq_con = 'select * from ' . $prev . 'config where id=1';
$sbrow_con = $this->Site_model->getcountRecods($sbq_con);

$sbq_gro = "select * from " . $prev . "privilage where privilage_id='" . $this->session->userdata['logged_in']["memtype"] . "'";
$sbrow_gro = $this->Site_model->getcountRecods($sbq_gro);

$errcnt = 0;

//else {      // original was

//////////////////////////////////---------------------------
if (!isset($id) && !is_numeric($id)) {
    $msg = "No such offer found.";
}
$id = $id;
$sbq_off = "select * from ".$prev."products where id=$id and uid=" . $this->session->userdata['logged_in']['user_id'];

//	die($sbq_off);
//$sbrow_off = mysql_fetch_array(mysql_query($sbq_off)); // ORIGINAL
//$product_sbq_sql = mysql_query($sbq_off);
$product_sbq_sql = $this->Site_model->getcountRecods($sbq_off);

//if (!$sbrow_off)
if (empty($product_sbq_sql))
{
    $_SESSION['err_msg'] = "<font color=red>Invalid access, denied.</font>";
    $REDIRECT_TO_DASHBOARD =  base_url().'dashboard';
    $msg->error("Invalid access, denied.");
    ?>
    <script type="text/javascript">
        window.location = "<?php echo $REDIRECT_TO_DASHBOARD;?>";
    </script>
<?php

}
$sbrow_off=$product_sbq_sql[0];


//print_r($sbrow_off);
//	$cid_list='';
//	$cat_list='';
$title = $sbrow_off['title'];
$description = $sbrow_off['description'];
$quantity = $sbrow_off['quantity'];
$keywords = $sbrow_off['keywords'];
$location = $sbrow_off['location'];
$min_order = $sbrow_off['min_order'];
$price_cur_id = $sbrow_off['price_cur_id'];
$price = $sbrow_off['price'];
$supplier_price = $sbrow_off['supplier_price'];
$min_price = $sbrow_off['min_price'];
$max_price = $sbrow_off['max_price'];
$min_sell_price = $sbrow_off['min_sell_price'];
$max_sell_price = $sbrow_off['max_sell_price'];
//$quantity = $sbrow_off['quantity'];

$samples_available = $sbrow_off['samples_available'];
$product_status = $sbrow_off['product_status'];
$delivery_time = $sbrow_off['delivery_time'];
$payment_mode = $sbrow_off['payment_mode'];
$other_mode = $sbrow_off['other_mode'];
$shipping_cost = $sbrow_off['shipping_cost'];

$origin = $sbrow_off['origin'];
$material = $sbrow_off['material'];
$function = $sbrow_off['function'];
$brand_name = $sbrow_off['brand_name'];
$quality = $sbrow_off['quality'];
$cbrand_name = $sbrow_off['cbrand_name'];
$model_number = $sbrow_off['model_number'];
$color = $sbrow_off['color'];
$type = $sbrow_off['type'];
$featured = $sbrow_off['featured'];
$image = $sbrow_off['image'];
$expireson = $sbrow_off['expireson'];
$weight = $sbrow_off['quality'];
$size = $sbrow_off['size'];
$qty_unit= $sbrow_off['qty_unit'];


$sbq_off_cat = "select * from " . $prev . "product_cats where offer_id=$id";
$sbrs_off_cat = $this->Site_model->getcountRecods($sbq_off_cat);

$cat_list = "";
$cid_list = "";
foreach ($sbrs_off_cat as $sbrow_off_cat) {
    //	$cat_id=$rs["cat".$i];
    if($sbrow_off_cat["cid"]=""){
        $rs_t = $this->Site_model->getcountRecods("Select * from " . $prev . "categories  where id =" . $sbrow_off_cat["cid"]);
    }
    $rs_t=$rs_t[0];
    if (!empty($rs_t )) {
        $cat_path = $rs_t["cat_name"];
        if($rs_t["pid"]=""){
            $par = $this->Site_model->getcountRecods("select * from " . $prev . "categories where id=" . $rs_t["pid"]);
        }
        foreach($par as $parent) {
            $cat_path = $parent["cat_name"] . ">" . $cat_path;
            if($parent["pid"]=""){
                $par = $this->Site_model->getcountRecods("select * from " . $prev . "categories where id=" . $parent["pid"]);
            }
        }
        if ($cat_list == "") {

            $cat_list = $cat_path;
            $cid_list = $rs_t["id"];
        } else {
            $cat_list .= ";" . $cat_path;
            $cid_list .= ";" . $rs_t["id"];
        }
    }
}
//}  // else part original

if (isset($msg)) {
    echo "<p >" . $msg . "</p> <div class='clearfix'></div>";
}



if (count($_POST) > 0) {
    //$cid_list = $_POST["cid"];
    //$cat_list = $_POST["category"];
    $cid_list ="";$cat_list="";
    if(isset($_POST["cid"]))  {  $cid_list = $_POST["cid"];   }
    if(isset($_POST["category"])){  $cat_list = $_POST["category"];     }

    if ($errcnt <> 0) {
        ?>
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
            <tr>
                <td colspan="2"><?php $_SESSION['err_msg'] = 'Your request cannot be processed due to following
	      reasons.' ?></td>
            </tr>
            <tr height="10">
                <td colspan="2"></td>
            </tr>
            <?php
            for ($i = 0; $i < $errcnt; $i++) {
                ?>
                <tr valign="top">
                    <td width="6%">&nbsp;<?php echo $i + 1; ?></td>
                    <td width="94%"><?php echo $errs[$i]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

    <?php
    }
}

if (1)
{
    ?>
    <form name="updateform" method="post" action="#" id="updateform" enctype="multipart/form-data">

    <?php
    if (isset($_SESSION['after_post_msg']) && $_SESSION['after_post_msg'] != '')
    {
        ?>
        <div class="alert alert-success alert-dismissable" style="text-align:center;">
            <?php echo $_SESSION['after_post_msg']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        </div>

        <?php
        unset($_SESSION['after_post_msg']);
    }
    ?>

    <div id="msgReplies" ></div>

    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="5" >

    <?php
    //echo "select cid from " . $prev. "product_cats where offer_id=".$id;
    $fetcat = $this->Site_model->getcountRecods("select cid from " . $prev . "product_cats where offer_id=" . $id);
    $fetcat =$fetcat[0];
    $cat = $fetcat['cid'];
    if($cat!=""){
        //echo "select id,pid from " . $prev. "categories where id=".$cat;
        $chkparent = $this->Site_model->getcountRecods("select id,pid from " . $prev . "categories where id=" . $cat);
        $chkparent=$chkparent[0];
        $chkparent['pid'];
        if ($chkparent['pid'] == '0') {
            $parent = $chkparent['id'];
        } else {
            $parent = $chkparent['pid'];
            $subcat = $chkparent['id'];
        }
    }
    ?>
    <tr>

        <td>Group Head<font color="#FF0000">*</font></td>

        <td></td>

        <td>
            <select class="col-sm-12 form-control zsr-pro-brand" id="ctid" name="ctid">

                <?php
                $qry="SELECT group_id,group_name FROM bt_categorie_group";
                $groupDropdown= $this->Site_model->execute($qry );
                if($groupDropdown){

                    foreach ($groupDropdown as $eachgroup) {?>

                        <option value="<?php echo $eachgroup['group_id'];?>" <?php
                        if($eachgroup['group_id']==$cat){ echo "selected";}
                        ?>><?php echo $eachgroup['group_name'];?></option>

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
    </tr>
    <!-- new added ands-->

    <tr valign="top">
        <td align="left"> Title</strong></td>
        <td><font style=" color:#FF0000;"> * </font></td>
        <td>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter Title" value="<?php echo $title; ?>" size="30" maxlength="40"><span id="elmtitleError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr  >
        <td align="left" > Description</strong></td>
        <td></td>
        <td valign="middle">

            <textarea cols="80" id="description2" name="description2" rows="10"><?= $description; ?></textarea>
            <input type="hidden" required="" id="description" class="form-control" name="description">
        </td>
    </tr>

    <tr>
        <td align="left" colspan="2">Wholesale Price <font color="#FF0000">*</font></td>
        <td>

            <div class="row">

                <div class="col-sm-4">

                    <span>Quantity</span>
                    <input type="text" required="" id="product_qty" class="form-control"  value="<?=$quantity;?>" name="product_qty">

                </div>




                <div class="col-sm-4">

                    <span>Minimum Product Price</span>
                    <input type="text" required="" class="form-control" value="<?=$min_price;?>"  id="minprice" name="minproduct_price">

                </div>





                <div class="col-sm-4">



                    <span>Maximum Product Price</span>
                    <input type="text" required="" class="form-control"  id="maxprice" value="<?=$max_price;?>" name="maxproduct_price">


                </div>

            </div>

        </td>

    </tr>


    <tr valign="top">
        <td colspan="2"></td>

        <td>

            <div class="row">

                <div class="col-sm-4">
                    <span>Minimum Order<font color="#FF0000">*</font></span>
                    <input name="min_order" type="text"  placeholder="Enter Minimum Order" class="form-control" id="min_order" value="<?php echo $min_order; ?>" maxlength="20"><span id="elmminError" class="errorMsg">&nbsp;</span>


                </div>

                <div class="col-sm-4">

                    <span>Minimum Sell Price</span>
                    <input type="text" required="" readonly="" value="<?php echo $min_sell_price; ?>"  class="form-control" id="minwhole_sell_price" name="minwhole_sell_price">

                </div>





                <div class="col-sm-4">

                    <span>Maximum Sell Price</span>
                    <input type="text" required="" readonly="" class="form-control" value="<?php echo $max_sell_price; ?>" id="maxwhole_sell_price" name="maxwhole_sell_price">

                </div>

            </div>



        </td>
    </tr>


    <tr valign="top">
        <td colspan="2">Unit </td>
        <td>
            <div class="col-sm-8">

                <select name="product_units" id="product_units" class="col-sm-12 form-control" >

                    <option value="">-- Select Unit --</option>

                    <?php

                    if($getall_units){

                        foreach ($getall_units as $key => $eachUnits) { ?>



                            <option value="<?php echo $eachUnits['unit_id'];?>"  <?php if($eachUnits['unit_id']==$qty_unit){ echo 'selected';}?>><?php echo $eachUnits['unit_name'];?> </option>



                        <?php }

                    } ?>

                </select>

                &nbsp;&nbsp;

                <span id="elmproductunitError" class="errorMsg">&nbsp;</span>

            </div>


        </td>
    </tr>

    <tr valign="top">
        <td colspan="2">Currency </td>
        <td>
            <div class="row">
                <div class="col-sm-8">

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

                </div>

            </div>
        </td>
    </tr>


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
        <td width="20%"  > <div > Samples
                Available </div></td>
        <td><font style=" color:#FF0000;">*</td>
        <td >
            <select name="samples_available" id="samples_available" class="form-control" id="samples_available">
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
        <td width="20%"  > <div > Product
                Status </div></td>
        <td><font style=" color:#FF0000;">*</td>
        <td >
            <select name='product_status' class="form-control" id="product_status">
                <option value="New" 							<?php
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


    <tr valign="top" style="display: none;">
        <td width="20%"  > <div > Delivery
                Time </div></td>
        <td><font style=" color:#FF0000;">*</td>
        <td ><input name="delivery_time" placeholder="Enter Delivery Time" class="form-control" type="text" value="1<?php //echo $delivery_time; ?>" size="6">
            Days
            <span id="elmpdeliveryError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>


    <tr valign="top">
        <td> Expires on<br>
        </td>
        <td> </td>
        <td><input type="text"  name="expireson" placeholder="Enter Expire Date" value="<?php echo $expireson; ?>" class="datepicker form-control">
        </td>
    </tr>
    <tr valign="top">

        <td colspan="2">Weight(Kg) <font color="#FF0000">*</font></td>

        <td>

            <input name="weight" class="form-control" placeholder="Enter product weight" type="text" id="weight"  value="<?php echo $weight; ?>" maxlength="20">

            <span id="elmminError" class="errorMsg">&nbsp;</span>

        </td>

    </tr>
    <tr valign="top">

        <td colspan="2">Color </td>

        <td>

            <input name="color" type="text" id="color" placeholder="Enter color"  value="<?php echo $color; ?>" class="form-control">
            <p>  Please specify color separated by a comma. Appropriate color will lead

                more buyers to finding the exact product.</p>

        </td>

    </tr>
    <tr valign="top">

        <td colspan="2">Size </td>

        <td>

            <input name="size" type="text" id="size" placeholder="Enter size"  value="<?php echo $size; ?>" class="form-control">
            <p>  Please specify size separated by a comma. Appropriate size will lead

                more buyers to finding the exact product.</p>

        </td>

    </tr>
    <tr valign="top">
        <td  > Picture</td>
        <td> </td>
        <?php
        $image_thumb=base_url() . 'assets/images/nopic.jpg';
        if ($image != '')
        {
            $file_count = file_exists("assets/uploadedimages/" . $image);
            //if ($file_count != '' && $image != '')
            if ($file_count != '')
            {
                //$img_path = $image;
                $file = $image;
                $path = 'assets/uploadedimages/';
                $image_thumb =  base_url() .$path. $file;
            }
        }
        else
        {
            $image_thumb =  base_url() . 'assets/images/nopic.jpg';
        }
        ?>
        <td>
            <input name="fileToUpload" class="btn btn-warning btn-big" type="file" id="fileToUpload" ><span></span>
            <img src="<?php echo $image_thumb; ?>" style='width:50px;height:50px'>

            </input>
            <input type="hidden"  name="change_image" id="change_image" value="<?php echo $image; ?>" class="form-control" style="border:0px;" readonly>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;"> Slider images</td>
        <td> </td>
        <td>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="<?php echo base_url()?>assets/multimage/script.js"></script>
            <form enctype="multipart/form-data" action="" method="post">

                <div class="col-lg-12 margin-tp-20">
                    <?php
                    $productImageTable = $prev."product_images";
                    $productId = $sbrow_off['id'];
                    $getMultiImages = $this->Site_model-> getDataById($productImageTable, "offer_id='$productId' AND default_img='0'", TRUE);

                    if($getMultiImages){
                        foreach ($getMultiImages as $eachMultiImg) {
                            $multiImageId = $eachMultiImg['id'];
                            $file_count = file_exists('assets/multimage/'.$eachMultiImg['img_url']);
                            if ($file_count && $eachMultiImg['img_url'] != '') {
                                $img_path = base_url() . 'assets/multimage/' . $eachMultiImg['img_url'];
                                ?>

                                <div class="cross-sec" id="multiImgBox-<?php echo $multiImageId; ?>">
                                    <img src="<?php echo $img_path; ?>" style='width:50px;height:50px; float:left;'
                                         class="" data-multimg="<?php echo $multiImageId; ?>">
                                    <i class="fa fa-times-circle cross rmv-proMulti-img"
                                       data-multimg="<?php echo $multiImageId; ?>" aria-hidden="true"></i>

                                    <div class="clear"></div>
                                </div>

                            <?php
                            }
                        }
                    }else{  } ?>

                </div>
                <?php

                if(!$getMultiImages){ ?>
                    <div id="filediv">
                        <input class="btn btn-warning btn-big" name="file" type="file" id="file"/>
                    </div>
                <?php } ?>


                <p>First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 200KB.</p>


                <input type="button" id="add_more" class="btn btn-warning btn-big" value="Add More Files"/>



            </form>
        </td>
    </tr>
    <!--   <tr><td colspan=3 ><hr size=1></td></tr>
       -->
    <tr valign="top">
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="submit" class="btn btn-primary btn-big"  type="button" onclick="update_form()" value="Update " class="button">
            <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
        </td>
    </tr>
    </table></td>
    </tr>
    </table>
    </form>
<?php }
?>
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



<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
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
<script>
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: 'TRUE',
    startDate: '-0d',
    autoclose: true,
})


$(document).ready(function () {


    $("#ctid").change(function () {

        var groupid = $('#ctid').val();

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

    $("#price").on('keyup change',function(){
        calpercentge(this);
    });

    //used to remove multi Images
    $(".rmv-proMulti-img").on("click" ,function(e){

        var Obj = $(this);

        var pimg = Obj.attr("data-multimg");

        var imgBx = "multiImgBox-"+pimg;

        var purl = "<?php echo base_url();?>removeImage";

        $.ajax({

            url: purl,

            type: "POST",

            data: {'img':pimg,'multi':'removeMultiImg'},

            dataType: "json",

            success: function (retn) {

                if(retn){

                    $('#'+imgBx).remove();

                }

            },

        });

    });



    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper);
        });
        $('.multi-field .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });

    $(".cls_product_price").on('keyup blur',function(){
        //calpercentge(this);
        var texp = $(this).val();
        //console.log(texp);
        var s_price = return_calpercentge(texp);
        //wal(s_price);
        $(this).nextAll('input').first().val(s_price);

    });

});

function return_calpercentge(val)
{

    var pcnt=<?php echo $ADMIN_PERCENTAGE;?>;
    var nprice=0;
    var spval= val;   //alert(spval);

    if(spval == 'NaN' || spval == "") {
        spval = 0.00;
        return(spval);
        // document.getElementById("product_sell_price").value = spval.toFixed(2);
    } else {
        spval = parseFloat(spval);
        pcnt = parseFloat(pcnt);
        var pcnt_rs = parseFloat( parseFloat( spval*pcnt )/100 );
        nprice = parseFloat(spval + pcnt_rs);
        //nprice = Math.ceil(nprice);
        return(nprice);
        //document.getElementById("product_sell_price").value = nprice.toFixed(2);
    }
    //alert(spval +' -- '+nprice);
}
function update_form(){

    var base_url="<?php echo base_url();?>";
    var formData = new FormData($('#updateform')[0]);

    $.ajax({
        url: base_url+"process_edit_wholesale_product",
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

function calpercentge(e)
{

    var pcnt=<?php echo 5;?>;
    var nprice=0;
    var spval= e.value;   //alert(spval);

    if(spval == 'NaN' || spval == "") {
        spval = 0.00;
        document.getElementById("product_sell_price").value = spval.toFixed(2);
    } else {
        spval = parseFloat(spval);
        pcnt = parseFloat(pcnt);
        var pcnt_rs = parseFloat( parseFloat( spval*pcnt )/100 );
        nprice = parseFloat(spval + pcnt_rs);
        nprice = Math.ceil(nprice);
        document.getElementById("product_sell_price").value = nprice.toFixed(2);
    }
    //alert(spval +' -- '+nprice);
}


</script>
<script>

    $('.datepicker').datepicker({

        format: 'dd-mm-yyyy',

        todayHighlight: 'TRUE',

        startDate: '-0d',

        autoclose: true,

    })
    function calpercentgemin(e)

    {

        var pcnt=<?php echo 5;?>;

        var nprice=0;

        var spval= e.value;   //alert(spval);



        if(spval == 'NaN' || spval == "") {

            spval = 0.00;

            document.getElementById("minwhole_sell_price").value = spval.toFixed(2);

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

    function calpercentgemax(e)

    {

        var pcnt=<?php echo 5;?>;

        var nprice=0;

        var spval= e.value;   //alert(spval);



        if(spval == 'NaN' || spval == "") {

            spval = 0.00;

            document.getElementById("maxwhole_sell_price").value = spval.toFixed(2);

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



<script>

    $(function () {

        // $("#location").geocomplete({

        //     details: ".geo-details",

        //     detailsAttribute: "data-geo"

        // });



        $("#minprice").on('keyup change',function(){



            /*  if (/\D/g.test(this.value)){

             this.value = this.value.replace(/\D/g,'');

             }*/

            calpercentgemin(this);

        });

        $("#maxprice").on('keyup change',function(){



            /*  if (/\D/g.test(this.value)){

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
</body>
</html>
