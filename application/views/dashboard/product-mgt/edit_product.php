<?php
$title ="Edit Product";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";

// For flash message
//$flash_msg = new \Plasticbrain\FlashMessages\FlashMessages();
//admin Percent value on Product price
@$ADMIN_PERCENTAGE = $_SESSION['SETTING_ADMIN_PERCENT'];
// Usertype Checking

$dateTypeYMD = date('Ymd');
//get all units for dropdown
$unit_master_table      = $prev."unit_master";
$where= "unit_id >0";

$getall_units= $this->Site_model->getDataById($unit_master_table,$where);

?><!DOCTYPE html>
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
<div class="featuredpro">
<div id="msgReplies"></div>

<h2> Product Catalogs > Edit Product</h2>
<?php
/////////---getting config---------
$sbq_con = 'select * from ' . $prev . 'config where id=1';
$sbrow_con =$this->Site_model-> getcountRecods($sbq_con);

$sbq_gro = "select * from " . $prev . "privilage where privilage_id='" . $this->session->userdata['logged_in']["memtype"] . "'";
$sbrow_gro =$this->Site_model-> getcountRecods($sbq_gro);

$errcnt = 0;

//else {      // original was

//////////////////////////////////---------------------------
if (!isset($productId) && !is_numeric($productId)) {
    $msg = "No such offer found.";
}
$id =$productId;
$sbq_offq = "select * from ".$prev."products where id=$id and uid=" . $this->session->userdata['logged_in']['user_id'];

$sbrow_off =$this->Site_model-> getcountRecods($sbq_offq);
// print_r($sbrow_off);
//	die($sbq_off);
//$sbrow_off = mysql_fetch_array(mysql_query($sbq_off)); // ORIGINAL
//$product_sbq_sql = mysql_query($sbq_off);
//$sbrow_off = mysql_fetch_array($product_sbq_sql);

//if (!$sbrow_off)
if (count($sbrow_off) == 0)
{
    $_SESSION['err_msg'] = "<font color=red>Invalid access, denied.</font>";
    $REDIRECT_TO_DASHBOARD = base_url().'dashboard';
    $flash_msg->error("Invalid access, denied.");
    ?>
    <script type="text/javascript">
        window.location = "<?php echo $REDIRECT_TO_DASHBOARD;?>";
    </script>
<?php

}
//print_r($sbrow_off);
//	$cid_list='';
//	$cat_list='';
$sbrow_off=$sbrow_off[0];
$title = $sbrow_off['title'];
$description = $sbrow_off['description'];
$quantity = $sbrow_off['quantity'];
$keywords = $sbrow_off['keywords'];
$location = $sbrow_off['location'];
$min_order = $sbrow_off['min_order'];
$price_cur_id = $sbrow_off['price_cur_id'];
$min_price = $sbrow_off['min_price'];
$max_price = $sbrow_off['max_price'];
$min_sell_price = $sbrow_off['min_sell_price'];
$max_sell_price = $sbrow_off['max_sell_price'];
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
$weight= $sbrow_off['quality'];
$qty_unit= $sbrow_off['qty_unit'];


$sbq_off_cat = "select * from " . $prev . "product_cats where offer_id=$id";
//$sbrs_off_cat = mysql_query($sbq_off_cat);
$sbrow_offs =$this->Site_model-> getcountRecods($sbq_off_cat);

$cat_list = "";
$cid_list = "";
if(!empty($sbrow_offs)) {
    foreach ($sbrow_offs as $key => $sbrow_off_cat) {
        //	$cat_id=$rs["cat".$i];
        // $rs_t = mysql_query();
        $rs_t = $this->Site_model->getcountRecods("Select * from " . $prev . "categories  where id =" . $sbrow_off_cat["cid"]);
        if (!empty($rs_t)) {
            $rs_t = $rs_t[0];
            $cat_path = $rs_t["cat_name"];
            //$par = mysql_query("select * from " . $prev . "categories where id=" . $rs_t["pid"]);
            $par = $this->Site_model->getcountRecods("select * from " . $prev . "categories where id=" . $rs_t["pid"]);
            foreach ($par as $parent) {
                $cat_path = $parent["cat_name"] . ">" . $cat_path;
                // $par = mysql_query("select * from " . $prev . "categories where id=" . $parent["pid"]);
                $par = $this->Site_model->getcountRecods("select * from " . $prev . "categories where id=" . $parent["pid"]);
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
}
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
<form name="edit_product" method="post" action="#" id="edit_product" enctype="multipart/form-data">


<table width="100%" border="0" align="center" cellpadding="2" cellspacing="5">

<?php
//echo "select cid from " . $prev. "product_cats where offer_id=".$id;
//$procat = mysql_query("select cid from " . $prev . "product_cats where offer_id=" . $id);
$fetcat = $this->Site_model->getcountRecods("select cid from " . $prev . "product_cats where offer_id=" . $id);
$fetcat = $fetcat[0];
if(!empty($fetcat)) {
    $cat = $fetcat['cid'];
//echo "select id,pid from " . $prev. "categories where id=".$cat;
$chkparent = $this->Site_model->getcountRecods("select id,pid from " . $prev . "categories where id=" . $cat);
$chkparent = $chkparent[0];
$chkparent['pid'];
if ($chkparent['pid'] == '0') {
    $parent = $chkparent['id'];
} else {
    $parent = $chkparent['pid'];
    $subcat = $chkparent['id'];
}
}
    ?>
    <!--new added-->
    <tr>
        <td>Group Head <font color="#FF0000">*</font></td>

        <td></td>

        <td>
            <select class="col-sm-12 form-control zsr-pro-brand" id="cat_group" name="ctid">

                <?php
                $qry="SELECT group_id,group_name FROM bt_categorie_group";
                $groupDropdown= $this->Site_model->execute($qry );
                if($groupDropdown){

                    foreach ($groupDropdown as $eachgroup) {?>

                        <option value="<?php echo $eachgroup['group_id'];?>" <?php if ($cat == $eachgroup['group_id']){ echo "selected";} ?> ><?php echo $eachgroup['group_name'];?></option>

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



    <tr valign="top">
        <td align="left"> Title</strong> <font style=" color:#FF0000;"> * </font></td>
        <td></td>
        <td>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter Title" value="<?php echo $title; ?>" size="30" maxlength="40"><span id="elmtitleError" class="errorMsg">&nbsp;</span>

        </td>
    </tr>
    <tr valign="top">
        <td align="left" > Description</strong></td>
        <td></td>
        <td valign="middle">

            <textarea cols="120" id="description2"  name="description" placeholder="Enter Description" id="description2" rows="5"><?=$description; ?></textarea>
            <input type="hidden" required="" id="description" class="form-control" name="description">

        </td>
    </tr>
    <tr valign="top">
        <td align="left" > Quantity</strong> <font style=" color:#FF0000;"> * </font></td>
        <td></td>
        <td>
            <input name="quantity" type="text"  class="form-control" placeholder="Enter Quantity" id="quantity" value="<?php echo $quantity; ?>" size="30" maxlength="40">
            </font>&nbsp; <span id="elmquanError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">
        <td align="left" > Keywords <font style=" color:#FF0000;"> * </font><br>
            <?php /*?></strong></font><font class="smalltext">(Max <strong><?php echo $sbrow_gro["productcatalogs_post"]; ?></strong><?php echo ($sbrow_gro["productcatalogs_post"] > 1) ? ' keywords' : ' keyword'; ?>)</font>
                                </strong><?php */?></td>
        <td></td>
        <td><input name="keywords" type="text"  class="form-control" placeholder="Enter Keyword" id="keywords" value="<?php echo $keywords; ?>" size="30" maxlength="40">
            <br> Please specify a comma seperated list
            of keywords related to your product. Appropriate keywords will lead
            more buyers to find your products.
            <span id="elmkeyError" class="errorMsg">&nbsp;</span></td>
        </td>
    </tr>
    <tr valign="top">
        <td>Place of Origin</td>
        <td width="6"> </td>
        <td>
            <input name="origin" type="text" placeholder="Enter Place of Origin" class="form-control" id="origin" value="<?php echo $origin; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Material</td>
        <td width="6"> </td>
        <td>
            <input name="material" type="text" placeholder="Enter Material" class="form-control" id="material" value="<?php echo $material; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Function</td>
        <td width="6"> </td>
        <td>
            <input name="function" type="text"  placeholder="Enter Function" class="form-control" id="function" value="<?php echo $function; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Brand Name</td>
        <td width="6"> </td>
        <td>
            <input name="brand_name" type="text" placeholder="Enter Brand Name" class="form-control" id="brand_name" value="<?php echo $brand_name; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Quality(in %)</td>
        <td width="6"> </td>
        <td>
            <input name="quality" type="text" placeholder="Enter Quality" class="form-control" id="quality" value="<?php echo $quality; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Compatible Brand</td>
        <td width="6"> </td>
        <td>
            <input name="cbrand_name" type="text" placeholder="Enter Compatible Brand"  class="form-control" id="cbrand_name" value="<?php echo $cbrand_name; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Model Number</td>
        <td width="6"> </td>
        <td>
            <input name="model_number" type="text" placeholder="Enter Model Number" class="form-control" id="model_number" value="<?php echo $model_number; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Color</td>
        <td width="6"> </td>
        <td>
            <input name="color" type="text" placeholder="Enter Color" class="form-control" id="color" value="<?php echo $color; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Type</td>
        <td width="6"> </td>
        <td>
            <input name="type" type="text" placeholder="Enter Type" class="form-control" id="type" value="<?php echo $type; ?>">
        </td>
    </tr>
    <tr valign="top">
        <td  >Features</td>
        <td width="6"> </td>
        <td>
            <textarea name="features2"  id="features2" placeholder="Enter Features" value="<?php echo $features; ?>" class="form-control" cols="50" rows="6" ><?php echo $features; ?></textarea>
            <input type="hidden" required="" id="features" class="form-control" name="features" value="<?php echo $features; ?>">
        </td>

    </tr>
    <tr valign="top">
        <td  > <div > Location <font style=" color:#FF0000;"> * </font></div></td>
        <td></td>
        <td>
            <input name="location" type="text" placeholder="Enter Location" class="form-control" id="location" value="<?php echo $location; ?>">
            <span id="elmlocError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">
        <td> <div> Minimum  Order <font style=" color:#FF0000;"> * </font></div></td>
        <td></td>
        <td>
            <input name="min_order" type="text"  placeholder="Enter Minimum Order" class="form-control" id="min_order" value="<?php echo $min_order; ?>" maxlength="20"><span id="elmminError" class="errorMsg">&nbsp;</span>
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
        <td  > <div > Price  </div> </td>
        <td></td>
        <td>
            <!--
                                <select name="price_cur_id" id="price_cur_id" class="form-control">
                                    <option value="">Select Currency</option>
                                    <?php
            $rs_query = $this->Site_model-> getcountRecods("Select * from " . $prev . "currencies");
            // echo "Select * from " . $prev . "currencies";
            foreach ($rs_query as $rs) {
                ?>
                                        <option value="<?php echo $rs["sbcur_id"]; ?>"
                                        <?php
                if ($rs["sbcur_id"] == $price_cur_id) {
                    echo "  selected ";
                }
                ?>

                                                ><?php echo $rs["sbcur_name"]; ?></option>
                                                <?php
            }
            ?>
                                </select>
                                &nbsp;&nbsp;
                                <span id="elmprice_curError" class="errorMsg">&nbsp;</span>
                                <input name="price" type="text" placeholder="Enter Price" class="form-control" id="price" value="<?php //echo floor($price); ?>" size="5" maxlength="30">
                                <span id="elmpriceError" class="errorMsg">&nbsp;</span>
                                -->
            <div class="row">
                <div class="col-sm-4">
                    <label>Currency</label>
                    <select name="price_cur_id" id="price_cur_id" class="col-sm-12 form-control" >
                        <option value="">Select Currency</option>
                        <?php
                        $rs_query =$this->Site_model-> getcountRecods("Select * from " . $prev . "currencies where sbcur_status = '1'");
                        foreach($rs_query as $rs) {
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
                    <input name="minprice" id="minprice" type="text" value="<?=$min_price;?>" size="5" maxlength="30"
                           placeholder="Enter Price" class="col-sm-12 form-control"  >

                    <span id="elmpriceError" class="errorMsg">&nbsp;</span>
                </div>
                <div class="col-sm-4">
                    <label>Maximum Product Price</label>
                    <input name="maxprice" id="maxprice" type="text" value="<?=$max_price;?>" size="5" maxlength="30"
                           placeholder="Enter Price" class="col-sm-12 form-control"  >

                    <span id="elmpriceError" class="errorMsg">&nbsp;</span>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">

                </div>

                <div class="col-sm-4">

                    <label>Minimum Sell Price</label>
                    <input type="text" name="minproduct_sell_price" id="minproduct_sell_price"
                           value="<?=$min_sell_price; ?>" readonly="" placeholder="Product Price" class="col-sm-12 form-control" >

                </div>


                <div class="col-sm-4">
                    <label>Maximum Sell Price</label>
                    <input type="text" name="maxproduct_sell_price" id="maxproduct_sell_price" value="<?=$max_sell_price; ?>" readonly=""
                           placeholder="Product Price" class="col-sm-12 form-control" >

                </div>
            </div>

        </td>
    </tr>

    <tr valign="top">
        <td width="20%"  > <div > Unit<font style=" color:#FF0000;"> * </font></div> </td>
        <td></td>
        <td >

            <div class="col-sm-12">

                <select  name="product_units" id="product_units" class="col-sm-12 form-control" >
                    <option value="">-- Select Unit --</option>
                    <?php

                    if($getall_units){

                        foreach ($getall_units as $key => $eachUnits) { ?>



                            <option value="<?php echo $eachUnits['unit_id'];?>"  <?php if($eachUnits['unit_id']==$qty_unit){ echo 'selected';}?>><?php echo $eachUnits['unit_name'];?> </option>



                        <?php }

                    } ?>
                </select>
                &nbsp;&nbsp;
                <span id="elmprice_curError" class="errorMsg">&nbsp;</span>
            </div>

            <span id="elmsampleError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>
    <tr valign="top">
        <td width="20%"  > <div > Samples
                Available <font style=" color:#FF0000;"> * </font></div> </td>
        <td></td>
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
                Status <font style=" color:#FF0000;"> * </font></div> </td>
        <td></td>
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
                Time <font style=" color:#FF0000;"> * </font></div> </td>
        <td></td>
        <td ><input name="delivery_time" placeholder="Enter Delivery Time" class="form-control" type="text" value="1<?php //echo $delivery_time; ?>" size="6">
            Days
            <span id="elmpdeliveryError" class="errorMsg">&nbsp;</span>
        </td>
    </tr>


    <!-- <tr valign="top">
                            <td width="20%"  > <div > Payments
                                    Mode </div></td>
                            <td><font style=" color:#FF0000;">*</td>
                            <td ><font class="normal">
                                <input  name="cash" type="checkbox" id="cash" value="yes"
                                <?php
    if (strstr($payment_mode, 'cash')) {
        echo "  checked ";
    }
    ?>>
                                Cash <br>
                                <input  name="cheque" type="checkbox" id="cheque" value="yes"
                                <?php
    if (strstr($payment_mode, 'cheque')) {
        echo "  checked ";
    }
    ?>>
                                Cheque<br>

                                <input  name="credit" type="checkbox" id="credit" value="yes"
                                <?php
    if (strstr($payment_mode, 'credit')) {
        echo "  checked ";
    }
    ?>>
                                Credit card<br>

                                <input  name="bank" type="checkbox" id="bank" value="yes"
                                <?php
    if (strstr($payment_mode, 'bank')) {
        echo "  checked ";
    }
    ?>>
                                Bank transfer<br>

                                <input  name="loc" type="checkbox" id="loc" value="yes"
                                <?php
    if (strstr($payment_mode, 'loc')) {
        echo "  checked ";
    }
    ?>>
                                Letter of Credit<br>

                                <input  name="escrow" type="checkbox" id="escrow" value="yes"
                                <?php
    if (strstr($payment_mode, 'escrow')) {
        echo "  checked ";
    }
    ?>>
                                Escrow <br>
                                Other:
                                <input name="other_mode" type="text" id="other_mode" value="<?php echo $other_mode; ?>">
                            </td>
                        </tr> -->


    <!--
                        <tr valign="top">
                            <td > Shipping
                                Cost  </td>
                            <td><font style=" color:#FF0000;">*</td>
                            <td>
                                <input name="shipping_cost" type="text" placeholder="Enter Shipping Cost" class="form-control" id="shipping_cost" value="<?php //echo $shipping_cost; ?>" size="5"><span id="elmpshippingError" class="errorMsg">&nbsp;</span>
                            </td>
                        </tr>
                        -->
    <tr valign="top">
        <td> Expires on<br>
        </td>
        <td> </td>
        <td><input type="text"  name="expireson" placeholder="Enter Expire Date" value="<?php echo $expireson; ?>" class="datepicker form-control">
        </td>
    </tr>
    <tr valign="top">
        <td  > Picture</td>
        <td> </td>
        <?php
        $id =$productId;
        $sbq_offq = "select image from ".$prev."products where id=$id and uid=" . $this->session->userdata['logged_in']['user_id'];

        $sbrow_img =$this->Site_model-> getcountRecods($sbq_offq);


        $image = $sbrow_img[0]['image'];

        if ($image != '')
        {
            $file_count = file_exists("assets/uploadedimages/".$image);
            //if ($file_count != '' && $image != '')
            if ($file_count != '')
            {
                //$img_path = $image;
                $file = $image;
                $path = 'assets/uploadedimages/';
                $image_thumb = base_url() .$path . $file;
            }
            else
            {
                $image_thumb =  base_url() . 'assets/images/nopic.jpg';
            }
        }
        else
        {
            $image_thumb =  base_url() . 'assets/images/nopic.jpg';
        }


        //echo  $image_thumb;exit;
        ?>
        <td>
            <input name="fileToUpload" class="btn btn-warning btn-big" type="file" id="fileToUpload" ><span></span>
            <img src="<?php echo $image_thumb ?>" style='width:50px;height:50px; margin:1% 0 0 0'>

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
                <!-- OLD CODES
                                    First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 200KB.
                                    <hr/>
                                    <div id="filediv"><input class="btn btn-warning btn-big" name="file[]" type="file" id="file"/></div><br/>
                                    <?php /*
                                    //echo $ff = "select * from " . $prev. "product_images where uid=" .$sbrow_off['uid']." and offer_id=".$sbrow_off['id'] ;
                                    $sbq_con = mysql_query("select * from " . $prev . "product_images where offer_id=" . $sbrow_off['id']);
                                    while ($sbrow_con = mysql_fetch_array($sbq_con)) {
                                        $file_count = file_exists('multimage/' . $sbrow_con['img_url']);
                                        if ($file_count && $sbrow_con['img_url'] != '') {
                                            $img_path = 'multimage/' . $sbrow_con['img_url'];
                                        } else {
                                            $img_path = 'images/nopic.jpg';
                                        }
                                        ?>
                                        <img src="<?php echo  base_url() . $img_path; ?>" style='width:50px;height:50px'>
                                    <?php } */ ?>
                                    <input type="button" id="add_more" class="btn btn-warning btn-big" value="Add More Files"/>

                                    -->
                <!--input type="submit" value="Upload File" name="submit" id="upload" class="upload"/-->

                <div class="col-lg-12 margin-tp-20">
                    <?php
                    $productImageTable = $prev."product_images";
                    $productId = $productId;
                    $getMultiImages = $this->Site_model-> getDataById($productImageTable, "offer_id='$productId' AND default_img='0'", TRUE);

                    if($getMultiImages){
                        foreach ($getMultiImages as $eachMultiImg) {
                            $multiImageId = $eachMultiImg['id'];
                            if (file_exists('assets/multimage/'.$eachMultiImg['img_url'])) {
                                $img_path = base_url().'assets/multimage/'.$eachMultiImg['img_url'];
                            } else {
                                $img_path = base_url(). 'assets/images/nopic.jpg';
                            } ?>

                            <div class="cross-sec" id="multiImgBox-<?php echo $multiImageId;?>" >
                                <img src="<?php echo  $img_path; ?>" style='width:50px;height:50px; float:left;' class="" data-multimg="<?php echo $multiImageId;?>" >
                                <i class="fa fa-times-circle cross rmv-proMulti-img" data-multimg="<?php echo $multiImageId;?>" aria-hidden="true" ></i>
                                <div class="clear"></div>
                            </div>

                        <?php
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

    <tr><td colspan=3 ><hr size=1></td></tr>
    <tr valign="top">
        <td align="right">&nbsp;</td>
        <td><a href="<?=base_url()?>manage-products"   class="btn btn-warning btn-big"> Back</a></td>
        <td></td><td></td>
        <td><input name="submit" class="btn btn-primary btn-big"  type="button" value="Update " onclick="update_productform();" class="button">
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
<style>

    .cross{    float: left;
        margin: -0.5% 0 0 -8.5%;
        position: relative;}
    .cross-sec{     float: left;
        margin: 0 2% 0 0 ;
        position: relative;}

    #filediv{     margin: 1% 0;}
    .margin-tp-20{ margin:2% 0;}

</style>
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

                    if(retn=="success"){

                        $('#'+imgBx).remove();

                    }

                },

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

<script type="text/javascript">

    function update_productform(){
        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#edit_product')[0]);
        $.ajax({
            url: base_url+"process_edit_featured_product",
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

        // e.preventDefault();

    }



</script>

<!-- -->

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

    $(document).ready(function () {

        $("#price_cur_id").change(function () {

            var tt = $("#price_cur_id option:selected").text();

            $("#shipping_cost_crncy").html(tt);

        });

    });

</script>

<script>

// JQFormValidation.js

/*

 * Shorthand for $(document).ready( function() {...} )

 * Run once the DOM tree is contructed.

 */

$(function () {

    // Set initial focus

    //$('#price_cur_id').focus();



    // Bind "submit" event handler to form

    $('#validation').on('submit', function () {

        var $form = $(this);

        // return false would prevent default submission

        return isSelected($form.find('#group_name_id'), "Please Select Group Head!",

            $form.find('#elmgroupError'))

        && isNotEmpty($form.find('#subcatdiv'), "Please Select Category!",

            $form.find('#elmcatError'))

        && isNotEmpty($form.find('#title'), "Please enter your Title!",

            $form.find('#elmtitleError'))



        && isNumeric($form.find('#quantity'), "Please enter your valid Quantity!",

            $form.find('#elmquanError'))

        && isNotEmpty($form.find('#keywords'), "Please enter a Keyword!",

            $form.find('#elmkeyError'))

        && isNumeric($form.find('#min_order'), "Please enter a valid minimum order!",

            $form.find('#elmminError'))

        && isSelected($form.find('#price_cur_id'), "Please enter a currency!",

            $form.find('#elmprice_curError'))

        && isNotEmpty($form.find('#price'), "Please enter a valid Price!",

            $form.find('#elmpriceError'))

        && isNotEmpty($form.find('#product_sell_price'), "Please enter a valid Price!",

            $form.find('#elmpriceError'))

        && isSelected($form.find('#samples_available'), "Please enter a sample!",

            $form.find('#elmsampleError'))

        && isSelected($form.find('#product_status'), "Please enter a status!",

            $form.find('#elmpstatusError'))

        && isNumeric($form.find('#delivery_time'), "Please enter a Delivery Time!",

            $form.find('#elmpdeliveryError'))

        && isNumeric($form.find('#shipping_cost'), "Please enter a Shipping Cost!",

            $form.find('#elmpshippingError'))

        && isSelected($form.find('#product_units'), "Please Select Unit!",

            $form.find('#elmproductunitError'))

            // && isNotEmpty($form.find('#expireson'), "Please enter a expireson Cost!",

            //    $form.find('#expiresonError'))

            //&& isChecked($form.find('[name="cash[]"]:checked'), "Please check a Payment Mode!",

            //        $form.find('#elmpcashError'))

            //&& isChecked($form.find('[name="cash[]"]:checked'), "Please check a Payment Mode!",

            //        $form.find('#elmpcashError'))

        && isNumeric($form.find('#quantity'), "Please enter a Shipping Cost!",

            $form.find('#elmpshippingError')) ;

    });



    // Bind "click" event handler to "reset" button

    $('#btnReset').on('click', function () {

        $('.errorBox').removeClass('errorBox');  // remove the error styling

        $('span[id$="Error"]').html('');  // id ends with "Error", remove contents

        $('.form-control').focus();  // Set focus element

        $('.nice-select').focus();  // Set focus element

    });

});



/*

 * Helper function, to be called after validation, to show or clear

 *   existing error message, and to set focus to the input element

 *   for correcting error.

 * If isValid is false, show the errMsg on errElm, and place the

 *   focus on the inputElm for correcting the error.

 * Else, clear previous errMsg on errElm, if any.

 *

 * @param isValid (boolean): flag indicating the result of validation

 * @param errMsg (string)(optional): error message

 * @param errElm (jQuery object)(optional): if isValid is false, show errMsg;

 else, clear.

 * @param inputElm (jQuery object)(optional): set focus to this element,

 *        if isValid is false

 */

function postValidate(isValid, errMsg, errElm, inputElm) {

    if (!isValid) {

        // Show errMsg on errElm, if provided.

        if (errElm !== undefined && errElm !== null

            && errMsg !== undefined && errMsg !== null) {

            errElm.html(errMsg);

        }

        // Set focus on Input Element for correcting error, if provided.

        if (inputElm !== undefined && inputElm !== null) {

            inputElm.addClass("errorBox");  // Add class for styling

            inputElm.focus();

        }

    } else {

        // Clear previous error message on errElm, if provided.

        if (errElm !== undefined && errElm !== null) {

            errElm.html('');

        }

        if (inputElm !== undefined && inputElm !== null) {

            inputElm.removeClass("errorBox");

        }

    }

}



/*

 * Validate that input value is not empty.

 *

 * @param inputElm (jQuery object): input element

 * @param errMsg (string): error message

 * @param errElm (jQuery object): element to place error message

 */

function isNotEmpty(inputElm, errMsg, errElm) {

    var isValid = (inputElm.val().trim() !== "");

    postValidate(isValid, errMsg, errElm, inputElm);

    return isValid;

}



/* Validate that input value contains one or more digits */

function isNumeric(inputElm, errMsg, errElm) {

    var isValid = (inputElm.val().trim().match(/^\d+$/) !== null);

    postValidate(isValid, errMsg, errElm, inputElm);

    return isValid;

}



/* Validate that input value contains only one or more letters */





/* Validate that input value contains one or more digits or letters */





/* Validate that input value length is between minLength and maxLength */





// Validate that input value is a valid email address





/*

 * Validate that a selection is made (not default of "") in <select> input

 *

 * @param selectElm (jQuery object): the <select> element

 */

function isSelected(selectElm, errMsg, errElm) {

    // You need to set the default value of <select>'s <option> to "".

    var isValid = (selectElm.val() !== "");   // value in selected <option>

    postValidate(isValid, errMsg, errElm, selectElm);

    return isValid;

}



/*

 * Validate that one of the checkboxes or radio buttons is checked.

 * Checkbox and radio are based on name attribute, not id.

 *

 * @param inputElms (jQuery object): "checked" checkboxes or radio

 */

function isChecked(inputElms, errMsg, errElm) {

    var isChecked = inputElms.length > 0;

    postValidate(isChecked, errMsg, errElm, null);  // no focus element

    return isChecked;

}



// Validate password, 6-8 characters of [a-zA-Z0-9_]

function isValidPassword(inputElm, errMsg, errElm) {

    var isValid = (inputElm.val().trim().match(/^\w{6,8}$/) !== null);

    postValidate(isValid, errMsg, errElm, inputElm);

    return isValid;

}



// Verify password.

function verifyPassword(pwElm, pwVerifiedElm, errMsg, errElm) {

    var isTheSame = (pwElm.val() === pwVerifiedElm.val());

    postValidate(isTheSame, errMsg, errElm, pwVerifiedElm);

    return isTheSame;

}





$(document).ready(function () {

    //$('#subcatdiv').css('display','block');

    $("#group_name_id").change(function () {

        var groupid = $('#group_name_id').val();

        //alert(groupid);



        $.ajax({

            url: "<?= base_url() ?>fetsubcat.php?groupid=" + groupid,

            type: "GET",

            data: groupid,

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

<link href="<?php echo base_url(); ?>datepicker/datepicker.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>datepicker/bootstrap-datepicker.js"></script>



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


<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
</body>
</html>
