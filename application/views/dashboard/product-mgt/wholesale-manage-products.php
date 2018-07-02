<?php
$title = "Manage wholesaleproduct";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";


if (isset($_POST["Submit"]))
{
    //print_r($_POST);
    $strinlist = "0";
    foreach ($_POST as $key => $value)
    {
        if (stristr($key, "checkbox")){ $strinlist .= "," . $value;}
    }

    $strquery = " and id in ($strinlist) ";
    //echo $strquery;die;

    if (isset($_POST["Submit"]) && $strinlist != "0")
    {
        $query_msg_del = "delete from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . " $strquery";
        $rs_del = mysql_query($query_msg_del);
        $msgdeleted = mysql_affected_rows();

        if ($msgdeleted > 0)  {
            $msg->success("Your Product deleted successfully.");
            header("location:".base_url()."manage-products"); die();
        } else {
            $msg->error("Failed to The Delete Product!");
            header("location:".base_url()."manage-products"); die();
        }
    } else  {
        $msg->error("Please Select Product First!");
        header("location:".base_url()."manage-products"); die();
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

    <style>
        .container-section1 button {
            margin: 0px auto 13px !important;
            text-align: center;
        }
        hr {
            margin-bottom: 1px !important;
            margin-top: -14px !important;
        }
        .head_normal{

            color='black';
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
<div class="clearfix filters-container m-t-2">
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
<h3 class="section-title">Manage Wholesale Products
    <a href="<?php echo base_url();?>post-wholesale-product/" class="" ><span class="btn btn-warning btn-big pull-right" style="margin:0;padding:5px;">Add New</span></a>
</h3>
<?php //$msg->display();?>

<!--<div id="mid_side" style='padding-top:6px'>-->
<?php
//$config = mysql_fetch_array(mysql_query("select * from " . $prev . "config"));

$sbq_gro = "select * from ".$prev."membership_plan where plan_id ='".$this->session->userdata['logged_in']["memtype"]."'";
$sbrow_gro = $this->Site_model-> getcountRecods($sbq_gro);
$sbrow_gro=$sbrow_gro[0];

/////////--------------getting information bout user's privious postings
$sbq_off = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . "  and approved='yes' and wholesale='1' and expireson > now() ORDER BY id DESC";
$sbsell_count=null;
$sbsell= $this->Site_model-> getcountRecods($sbq_off);
if(!empty($sbsell)){
    $sbsell_count = count($sbsell);

}

$sbq_off = "select * from " . $prev . "products where uid='" . $this->session->userdata['logged_in']['user_id'] . "' and approved='yes' and wholesale='1' and expireson > NOW() ORDER BY id DESC limit 0,5";
$sbrs_offr = $this->Site_model-> getcountRecods($sbq_off);
if(!empty($sbrs_offr)){
    $sbrs_offc = count($sbrs_offr);

}

if ($sbrs_offc>0)
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
            <td style="padding-left:10px;"><font size='4' color='black';>Posted - <strong><font class='red'><?php echo $sbsell_count; ?></font></strong>
                Maximum Allowed - <strong><font class='red'><?php
                        if ($sbrow_gro["no_of_products"] > 10000) {
                            echo "Unlimited";
                        } else {
                            echo $sbrow_gro["no_of_products"];
                        }
                        ?></font></strong>
            </td>
        </tr>
        <tr>
            <td valign="top" style="padding-left:10px;"> </td>
        </tr>
        <tr>
            <td valign="top">
                <form name="form1" method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="manage-product">
                        <tr class="subtitle">
                            <td width="10%" style="padding-left:10px;"> <input type="checkbox" name="check_all" value="yes" onClick="select_all();"></td>
                            <td width="10%">Picture</td>
                            <td width="20%">Title</td>
                            <!--td>Images</td-->
                            <td width="20%">Posted On</td>
                            <!-- <td width="20%">Expired On</td> -->
                            <td width="10%">Action</td>
                        </tr>

                        <?php
                        $cnt=0;

                        //print_r($sbrs_offr);
                        foreach ($sbrs_offr as $key=>$sbrow_off)
                        {
                            $cnt++;
                            $filename = $sbrow_off['image'];


                            if (file_exists('assets/uploadedimages/'.$filename))
                            {
                                $file = $sbrow_off['image'];

                                $image_thumb = base_url().'assets/uploadedimages/'.$filename;
                            }
                            else {
                                $image_thumb = base_url() . "assets/images/nopic.jpg";
                            }

                            //echo  $image_thumb = 'assets/uploadedimages/'.$filename;

                            ?>

                            <tr>
                                <td style="padding-left:10px;">
                                    <input name="checkbox<?php echo $sbrow_off["id"]; ?>" type="checkbox" class="activecheckboxproducts" id="checkbox<?php echo $sbrow_off["id"]; ?>" value="<?php echo $sbrow_off["id"]; ?>" class="form1-checkbox">
                                </td>
                                <td>
                                    <img src="<?php echo  $image_thumb; ?>" class="productImages"  >
                                </td>
                                <?php $proname = RemoveBadURLChars(strtolower($sbrow_off["title"])); ?>

                                <td valign="top" >
                                    <a href="<?php echo base_url(); ?>wholesale/product-details/<?php echo $proname . '/' . $sbrow_off["id"]; ?>/<?php echo $sbrow_off["uid"]; ?>" target="_blank"><?php echo ucwords($sbrow_off["title"]); ?></a>
                                </td>
                                <!--td> (<a href="view_images_product.php&id=<?php echo $sbrow_off["id"]; ?>" target="_blank"><?php echo $sbno_of_images; ?></a>)</td-->
                                <!--<td valign="top" ><font class='normal'><?php //echo sb_date($sbrow_off["postedon"]);  ?></td>-->

                                <td valign="top" ><font class='normal'><?php echo date('d-M-Y', strtotime($sbrow_off["postedon"])); ?></td>
                                <!-- <td valign="top" ><font class='normal'>
                                            <?php /*
                                            if ($sbrow_off["expireson"] == '0000-00-00') {
                                                echo "N/A";
                                            } else {
                                                echo date('d-M-Y', strtotime($sbrow_off["expireson"]));
                                            } */
                                ?>
                                        </td> -->
                                <td valign="top" >
                                    <a href="<?=base_url();?>wholesale-product-edit/<?php echo $sbrow_off["id"]; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php
                        }
                        // $count = mysql_num_rows($sbrs_off);
                        // echo "string";
                        // echo $sbsell_count;die();
                        if ($sbsell_count > 5)
                        {
                            ?>

                            <tr style="margin:0px 0px; padding:0px 0px;">
                                <td colspan="6"><a href="<?=base_url();?>my_wholesale_products_list/y">
                                        <button class="btn center btn-info btn-sm btn3d view-all" type="button">More.</button></a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                        <tr>
                            <!--<td colspan="6" style="padding-left:10px;" align=right>
                                        <hr sie=1>
                                        <input type="hidden" name="cnt" value="<?php //echo $cnt; ?>">
                                        <input type="button" name="remove" value="Remove"  onClick="removeactiveproduct()" class="btn btn-warning btn-big">
                                    </td>-->
                        </tr>
                    </table>

                </form>
            </td>
        </tr>
    </table>
<?php
}
else
{
    ?>
    <tr>
        <td colspan="6">
            <div class="alert alert-danger alert-dismissable" style="text-align:center;">
                No Active Products Details.</div>
        </td>
    </tr>

<?php
}
?>




<?php

//$sbq_off = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . " and approved='yes' and wholesale=0 and expireson <= now() limit 0,5";

$sbq_off1 = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . " and approved='yes' and wholesale='1' and expireson <= now() ORDER BY id DESC";

$res=$this->Site_model-> getcountRecods($sbq_off1);
if(!empty($res)){
    $sbsell_count =count($this->Site_model-> getcountRecods($sbq_off1));
}else{
    $sbsell_count =0;
}
// $sbq_off='select *,UNIX_TIMESTAMP(postedon) as sbposted, UNIX_TIMESTAMP(DATE_ADD(postedon,INTERVAL '.$config['expiry_sell'].' MONTH)) as sbexpiry from ' . $prev. 'products where uid='.$this->session->userdata['logged_in']['user_id']. " and expireson <= now()";
$sbq_off = "select * from " . $prev . "products where uid='" . $this->session->userdata['logged_in']['user_id'] . "' and approved='yes' and wholesale='1' and expireson <= NOW() ORDER BY id DESC";
$sbrs_off = $this->Site_model-> getcountRecods($sbq_off);
//echo $sbq_off;
if (!empty($sbrs_off))
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >
        <tr>
            <td style="padding-left:10px;"><font size='4' color='black';>Product (Expired) - <strong><font class='red'><?php echo $sbsell_count; ?></font></strong>
            </td>
        </tr>
        <tr>
            <!--td valign="top" style="padding-left:10px;"> <p><font class='normal'>To remove a product
                catalog just click the check box and click the remove
                button below.</font></p></td-->
        </tr>
        <tr>
            <td valign="top"><form name="form2" method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="manage-product">
                        <tr class="subtitle">
                            <td width="10%" style="padding-left:10px;"> <input type="checkbox" id="" name="check_all" value="yes" onClick="select_all1();">
                            </td>
                            <td width="20%">Picture</td>
                            <td width="20%">Title</td>
                            <!--td>Images</td-->
                            <td width="20%">Posted On</td>
                            <!-- <td width="20%">Expired On</td> -->
                            <td width="10%">Action</td>
                        </tr>
                        <?php
                        $cnt=0;


                        foreach ($sbrs_off as $key=>$sbrow_off) {
                            //print_r($sbrow_off);
                            //echo "-chandan";
                            $filename = $sbrow_off['image'];
                            if (file_exists('assets/uploadedimages/'.$filename)) {
                                //$pic = 'uploadedimages/'.$sbrow_off['image'] ;
                                $file = $sbrow_off['image'];
                                $path = 'assets/uploadedimages/';
                                $image_thumb = base_url() . $path . $file;
                            } else {
                                $image_thumb = base_url() . "assets/images/nopic.jpg";
                            }
                            /* $img="select * from " . $prev. "product_images where offer_id=".$sbrow_off['id'];
                              $im=mysql_query($img);
                              $images=mysql_num_rows($im);
                              if($images)
                              {
                              $pic1=mysql_fetch_array($im);
                              $pic = $pic1["image_url"];
                              echo $pic;
                              if(!file_exists($pic))
                              $pic="images/nopic.jpg";
                              }
                              else
                              {
                              $pic="images/nopic.jpg";
                              } */
                            ?>
                            <tr>

                                <td style="padding-left:10px;">
                                    <input name="checkbox<?php echo $sbrow_off["id"]; ?>" type="checkbox"  class="whol_active_checkbox"
                                           id="checkbox<?php echo $sbrow_off["id"]; ?>" value="<?php echo $sbrow_off["id"]; ?>"></td>
                                <td>
                                    <img src="<?php echo $image_thumb; ?>" class="productImages"  >

                                </td>
                                <td valign="top"><?php echo ucwords($sbrow_off["title"]); ?></td>
                                <!--td> (<a href="view_images_product.php&id=<?php echo $sbrow_off["id"]; ?>" target="_blank"><?php echo $sbno_of_images; ?></a>)</td-->
                                <!--<td valign="top" ><font class='normal'><?php //echo sb_date($sbrow_off["sbposted"]); ?></td>-->
                                <td valign="top" ><font class='normal'><?php echo date('d-M-Y', strtotime($sbrow_off["postedon"])); ?></td>
                                <!--
                            <td valign="top" ><font class='normal'><?php //echo date('d-M-Y', strtotime($sbrow_off["expireson"])); ?></td>
                            -->
                                <td valign="top" ><a href="<?php echo base_url(); ?>edit-product/<?php echo $sbrow_off["id"]; ?>">Edit</a></td>
                            </tr>
                        <?php
                        }
                        $count = count($sbrow_off);
                        if ($sbsell_count > 5) {
                            ?>

                            <tr style="margin:0px 0px; padding:0px 0px;">
                                <td colspan="6"><a href="<?=base_url();?>my_wholesale_products_list/n"><button class="btn center btn-info btn-sm btn3d view-all" type="button">More.</button></a>
                                </td>
                            </tr>

                        <?php } ?>

                        <tr>
                            <!--<td colspan="6" style="padding-left:10px;" align=right><hr sie=1> <input type="hidden" name="cnt" value="<?php //echo $cnt; ?>">
                                <input type="button" name="Submit" value="Remove"  onClick="removeexpiredproduct()" class="btn btn-warning btn-big">
                            </td>-->
                        </tr>
                        </tr>
                    </table>

                </form></td>
        </tr>
    </table>
<?php } else { ?>
    <tr>
        <td colspan="6">
            <div class="alert alert-danger alert-dismissable" style="text-align:center;">No Expired Products Details.</div>
        </td>
    </tr>
<?php } ?>
<?php
$sbq_off = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . " and approved='no' and wholesale=1 ORDER BY id DESC limit 0,5";

$sbq_off1 = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'] . " and approved='no' and wholesale=1 ORDER BY id DESC ";
$sbsell_count=null;
if (!empty($sbrs_off)) {
    $sbsell_count =count($this->Site_model-> getcountRecods($sbq_off1));
}
// $sbq_off='select *,UNIX_TIMESTAMP(postedon) as sbposted, UNIX_TIMESTAMP(DATE_ADD(postedon,INTERVAL '.$config['expiry_sell'].' MONTH)) as sbexpiry from ' . $prev. 'products where uid='.$this->session->userdata['logged_in']['user_id']. " and expireson <= now()";
$sbq_off = "select * from " . $prev . "products where uid='" . $this->session->userdata['logged_in']['user_id'] . "' and approved='no' and wholesale=1 ORDER BY id DESC  ";

$sbrs_off = $this->Site_model-> getcountRecods($sbq_off);
if (!empty($sbrs_off)) {
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >
        <tr>
            <td style="padding-left:10px;"><font size='4' color='black';>Product (Unapproved) - <strong><font class='red'><?php echo $sbsell_count; ?></font></strong>
            </td>
        </tr>
        <tr>
            <!--td valign="top" style="padding-left:10px;"> <p><font class='normal'>To remove a product
                catalog just click the check box and click the remove
                button below.</font></p></td-->
        </tr>
        <tr>
            <td valign="top"><form name="form3" method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="manage-product">
                        <tr class="subtitle">
                            <td width="10%" style="padding-left:10px;"> <input type="checkbox" id="check_all" name="check_all" value="yes" onClick="select_all2();">
                            </td>
                            <td width="20%">Picture</td>
                            <td width="30%">Title</td>
                            <!--td>Images</td-->
                            <td width="20%">Posted On</td>
                            <!-- <td width="10%">Expired On</td> -->

                        </tr>
                        <?php
                        foreach ($sbrs_off as $key=>$sbrow_off) {
                            $filename = $sbrow_off['image'];
                            if (file_exists($filename) || $sbrow_off['image'] != '') {
                                //$pic = 'uploadedimages/'.$sbrow_off['image'] ;
                                $file = $sbrow_off['image'];
                                $path = 'assets/uploadedimages/';
                                $image_thumb = base_url() . $path . $file;
                            } else {
                                $image_thumb = base_url() . "assets/images/nopic.jpg";
                            }
                            ?>
                            <tr>

                                <td style="padding-left:10px;">
                                    <input name="checkbox<?php echo $sbrow_off["id"]; ?>" type="checkbox" class="whochecked" id="checkbox<?php echo $sbrow_off["id"]; ?>" value="<?php echo $sbrow_off["id"]; ?>"></td>
                                <td>
                                    <img src="<?php echo $image_thumb; ?>" class="productImages">

                                </td>
                                <td valign="top" ><?php echo ucwords($sbrow_off["title"]); ?></td>
                                <!--td> (<a href="view_images_product.php&id=<?php echo $sbrow_off["id"]; ?>" target="_blank"><?php echo $sbno_of_images; ?></a>)</td-->
                                <td valign="top" ><font class='normal'><?php echo date('d-M-Y', strtotime($sbrow_off["postedon"])); ?></td>
                                <!--
                                                    <td valign="top" ><font class='normal'><?php //echo date('d-M-Y', strtotime($sbrow_off["expireson"])); ?></td>
                                                    -->

                            </tr>
                        <?php
                        }
                        $count = count($sbrs_off);
                        if ($sbsell_count > 5) {
                            ?>

                            <tr style="margin:0px 0px; padding:0px 0px;">
                                <td colspan="6"><a href="<?=base_url();?>my_wholesale_products_list/n"><button class="btn center btn-info btn-sm btn3d view-all" type="button">More.</button></a>
                                </td>
                            </tr>

                        <?php }
                        ?>




                        <tr>
                            <!--<td colspan="6" style="padding-left:10px;" align="right"><hr sie=1> <input type="hidden" name="cnt" value="<?php //echo $cnt; ?>">
                                                    <input type="button" name="Submit" value="remove" onClick="removeproduct()" class="btn btn-warning btn-big">
                                                </td>-->
                        </tr>
                    </table>

                </form></td>
        </tr>
    </table>
<?php } else { ?>
    <tr>
        <td colspan="6">
            <div class="alert alert-danger alert-dismissable" style="text-align:center;">No Inactive Products Details.</div>
        </td>
    </tr>
<?php } ?>



<p><font class='normal'>To remove a product
        catalog just click the check box and click the remove
        button below.</font></p>

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
<script language="JavaScript">
    function removeactiveproduct(){
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this  file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var baseUrl         = "<?php echo base_url();?>";
                    var Url         =  baseUrl+"delete_product";
                    var checkedValues=$('.activecheckboxproducts:checkbox:checked');

                    $.post(Url,checkedValues, function(data){

                        if(data==1){
                            swal("success!", "The has been deleted.", "success");
                            location.reload();
                        }else{
                            swal("Error!", "Something went wrong", "error");
                        }
                    });


                } else {
                    swal("Cancelled", "The record is safe :)", "success");
                }
            }
        );

    }


    function removeexpiredproduct(){
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this  file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var baseUrl         = "<?php echo base_url();?>";
                    var Url         =  baseUrl+"delete_product";
                    var checkedValues=$('.whol_active_checkbox:checkbox:checked');

                    $.post(Url,checkedValues, function(data){

                        if(data==1){
                            swal("success!", "The has been deleted.", "success");
                            location.reload();
                        }else{
                            swal("Error!", "Something went wrong", "error");
                        }
                    });


                } else {
                    swal("Cancelled", "The record is safe :)", "success");
                }
            }
        );

    }

    function removeproduct(){

        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this  file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var baseUrl         = "<?php echo base_url();?>";
                    var Url         =  baseUrl+"delete_product";
                    var checkedValues=$('.whochecked:checkbox:checked');

                    $.post(Url,checkedValues, function(data){

                        if(data==1){
                            swal("success!", "The has been deleted.", "success");
                            location.reload();
                        }else{
                            swal("Error!", "Something went wrong", "error");
                        }
                    });


                } else {
                    swal("Cancelled", "The record is safe :)", "success");
                }
            }
        );

    }

    function select_all()
    {

        for (var i = 0; i < document.form1.elements.length; i++)
        {
            var e = document.form1.elements[i];
            if ((e.name != 'check_all') && (e.type == 'checkbox'))
            {
                e.checked = document.form1.check_all.checked;
            }
        }

    }
    function select_all1()
    {

        for (var i = 0; i < document.form2.elements.length; i++)
        {
            var e = document.form2.elements[i];
            if ((e.name != 'check_all') && (e.type == 'checkbox'))
            {
                e.checked = document.form2.check_all.checked;
            }
        }

    }
    function select_all2()
    {

        for (var i = 0; i < document.form3.elements.length; i++)
        {
            var e = document.form3.elements[i];
            if ((e.name != 'check_all') && (e.type == 'checkbox'))
            {
                e.checked = document.form3.check_all.checked;
            }
        }

    }


    //-->
    /*
     $(document).ready(function(){
     //alert("READY");
     $("input[type=checkbox].form1-checkbox").on('click',function(){
     alert("CHCEKED");

     });
     //if($('.coupon_question').is(":checked"))
     });
     */

</script>

<script language="javascript">
    //<!--


    function formValidate(form) {
        if (form.add_desc.value == "") {
            alert('Please enter description.');
            return false;
        }
        return true;
    }
    //-->

</script>
</body>
</html>
