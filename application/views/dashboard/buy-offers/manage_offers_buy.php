<?php
$pagename = "managebuyoffers";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
$strinlist_2="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist_2.=",".$value;
}

$strquery=" and id in ($strinlist_2) ";
if(isset($_POST["Submit2"]))
{
    $query_msg_del="delete from " . $prev. "offers_buy where uid=".$_SESSION['user_id']." $strquery";
    $rs_del=mysql_query($query_msg_del);
    $msgdeleted=mysql_affected_rows();
    if($msgdeleted > 0)
    {
        $_SESSION['after_remove_msg']= 'Your Product deleted successfully.';
    } else {
        $_SESSION['err_msg'] = 'Your product not deleted successfully';
    }
}

//=============================================

$strinlist="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist.=",".$value;
}

$strquery=" and id in ($strinlist) ";
if(isset($_POST["Submit"]))
{
    $query_msg_del="delete from " . $prev. "offers_buy where uid=".$_SESSION['user_id']." $strquery";
    $rs_del=mysql_query($query_msg_del);
    $msgdeleted=mysql_affected_rows();
    if($msgdeleted > 0)
    {
        $_SESSION['after_remove_msg']= 'Your Product deleted successfully.';
    } else {
        $_SESSION['err_msg'] = 'Your product not deleted successfully';
    }
}



//=============================================

$strinlist_1="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist_1.=",".$value;
}

$strquery=" and id in ($strinlist_1) ";
if(isset($_POST["remove"]))
{
    $query_msg_del="delete from " . $prev. "offers_buy where uid=".$_SESSION['user_id']." $strquery";
    $rs_del=mysql_query($query_msg_del);
    $msgdeleted=mysql_affected_rows();
    if($msgdeleted > 0)
    {
        $_SESSION['after_remove_msg']= 'Your Product deleted successfully.';
    } else {
        $_SESSION['err_msg'] = 'Your product not deleted successfully';
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
<div class="containerr">
<div class="col-md-10">
<?php
/////////--------------getting information bout user's privious postings
$sbq_off="select * from " . $prev. "offers_buy where uid=".$this->session->userdata['logged_in']['user_id']." and approved='yes' and expireson > NOW() limit 0,5" ;
$res=$this->Site_model->getcountRecods($sbq_off);
if(!empty($res)) {
    $sbsell_count = count($this->Site_model-> getcountRecods($sbq_off));

}


$sbrs_off=$this->Site_model-> getcountRecods($sbq_off);
if (!empty($sbrs_off))
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >

        <tr>
            <td class="text-color-red">Posted - <strong><font class='red'><?php echo $sbsell_count; ?></font></strong>
                Maximum Allowed - <strong><font class='red'><?php if($sbrow_gro["no_of_buy_offer"]>10000){ echo "Unlimited";}else{ echo $sbrow_gro["no_of_buy_offer"];} ?></font></strong>
            </td>
        </tr>
        <tr>
            <td valign="top"> </td>
        </tr>
        <tr>
            <td valign="top">
                <form name="form2" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="manage-product">
                        <tr class="subtitle">
                            <td width="10%">
                                <input type="checkbox" name="check_all" value="yes" onClick="select_all();">                              </td>
                            <td width="20%">Title</td>
                            <td width="20%">Images</td>
                            <td width="20%">Posted On</td>
                            <td width="20%">Expires On</td>
                            <td width="10%"><b></b></td>
                        </tr>
                        <?php

                        foreach($sbrs_off as $sbrow_off)
                        {
                            //print_r($sbrow_off);
                            $sbq_off_img="select * from " . $prev. "offer_buy_images where offer_id=".$sbrow_off['id'];
                            $sbno_of_images=count($this->Site_model-> getcountRecods($sbq_off_img));
                            if($sbrow_off["buyoffer_image"]!='') {
                                $file_count=file_exists('assets/uploadedimages/buyoffer/'.$sbrow_off["buyoffer_image"]);
                                if ($file_count!='') {
                                    $file = $sbrow_off["buyoffer_image"];
                                    $path= 'assets/uploadedimages/buyoffer/';
                                    $image_thumb=base_url().$path.$file;
                                    //$img_path='uploadedimages/buyoffer/'.$sbrow_off["buyoffer_image"] ;
                                }else {
                                    $image_thumb=base_url().'assets/images/nopic.jpg';
                                }
                            } else {
                                $image_thumb=base_url().'assets/images/nopic.jpg';
                            }
                            ?>
                            <tr>
                                <td ><input name="checkbox<?php echo $sbrow_off["id"];?>" class="whochecked" type="checkbox" id="checkbox<?php echo $sbrow_off["id"];?>" value="<?php echo $sbrow_off["id"];?>"></td>
                                <td valign="" ><?php echo $sbrow_off["title"]; ?></td>
                                <td valign="top" ><img src="<?php echo $image_thumb ?>" height="50" width="50" /></td>
                                <td valign="" ><?php echo date('d-M-Y H:i:s',strtotime($sbrow_off["postedon"]));?></td>
                                <td valign="" ><?php echo date('d-M-Y H:i:s',strtotime($sbrow_off["expireson"]))?></td>
                                <td valign="" ><a href="<?php echo base_url(); ?>post-buy-offers/<?php echo $sbrow_off["id"]; ?>">Edit</a></td>
                            </tr>
                        <?php
                        }
                        $count=count($sbrs_off);
                        if ($count > 5) { ?>

                            <tr style="margin:0px 0px; padding:0px 0px;">
                                <td colspan="6"><a href="my_buy_offers_list.php?approved_buy_offers=y"><button class="btn center btn-info btn-sm btn3d view-all" type="button">More.</button></a>
                                </td>
                            </tr>

                        <?php }
                        ?>

                        <tr><td colspan=6 ><hr size=1></td></tr>
                        <tr>
                            <td colspan="6" align=right> <input type="hidden" name="cnt" value="<?php echo $cnt; ?>">
                                <input type="button"  onClick="return removeofferproduct()" name="Submit" value="Remove" class="btn btn-warning btn-big"> </td>
                        </tr>
                    </table>
                </form></td>
        </tr>
    </table>
<?php } else { ?>
    <tr>
        <td colspan="6">
            <div class="alert alert-danger alert-dismissable" style="text-align:center;">No Latest Buy Offer Details.</div>
        </td>
    </tr>
<?php } ?>

<?php
$sbq_exproff1="select * from " . $prev. "offers_buy where uid ='".$this->session->userdata['logged_in']["user_id"]."' and approved ='yes' and expireson < NOW() limit 0,5";
$fetsbq_exproff1 = $this->Site_model-> getcountRecods($sbq_exproff1);

$res=$this->Site_model->getcountRecods($sbq_exproff1);
if(!empty($res)) {
    $sbsell_count = count($this->Site_model-> getcountRecods($sbq_exproff1));

}
if (!empty($fetsbq_exproff1))
{
    ?>

    <strong>Buy Offers (Expired)</strong>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >

        <tr>
            <td valign="top"> <p>To remove an offer
                    just click the check box and click the remove button
                    below.</font></p></td>
        </tr>
        <tr>
            <td valign="top"><form name="form3" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="manage-product">
                        <tr class="subtitle">
                            <td width="20%">
                                <input type="checkbox" name="check_all" value="yes" onClick="select_all2();">
                            </td>
                            <td width="20%">Title</td>
                            <td width="20%">Images</td>
                            <td width="20%">Posted On</td>
                            <td width="20%">Expired On</td>
                            <td><b></b></td>
                        </tr>
                        <?php

                        foreach($fetsbq_exproff1 as $sbrow_off)
                        {
                            //$cnt++;
                            $sbq_off_img="select * from " . $prev. "offer_images where offer_id=".$sbrow_off['id'];
                            $sbno_of_images=count($this->Site_model-> getcountRecods($sbq_off_img));
                            if($sbrow_off["buyoffer_image"]!='') {
                                $file_count=file_exists('assets/uploadedimages/'.$sbrow_off["buyoffer_image"]);
                                if ($file_count!='') {
                                    $img_path='assets/uploadedimages/'.$sbrow_off["buyoffer_image"] ;
                                }else {
                                    $img_path='assets/images/nopic.jpg';
                                }
                            } else {
                                $img_path='assets/images/nopic.jpg';
                            }
                            ?>
                            <tr>
                                <td ><input name="checkbox<?php echo $sbrow_off["id"];?>" type="checkbox" id="checkbox<?php echo $sbrow_off["id"];?>" value="<?php echo $sbrow_off["id"];?>"></td>
                                <td valign="" ><?php echo $sbrow_off["title"]; ?></td>
                                <td valign="top" ><img src="<?php echo $img_path ?>" height="50" width="50" /></td>
                                <td valign="" ><?php echo date('d-M-Y H:i:s',strtotime($sbrow_off["postedon"]));?></td>
                                <td valign="" ><?php echo date('d-M-Y H:i:s',strtotime($sbrow_off["expireson"]))?></td>
                                <td valign="" ><a href="<?php echo base_url(); ?>post-buy-offers/<?php echo $sbrow_off["id"]; ?>">Edit</a></td>
                            </tr>
                        <?php
                        }
                        $count=count($sbrs_off);
                        if ($count > 5) { ?>

                            <tr style="margin:0px 0px; padding:0px 0px;">
                                <td colspan="6"><a href="my_buy_offers_list.php?approved_buy_offers=y"><button class="btn center btn-info btn-sm btn3d view-all" type="button">More.</button></a>
                                </td>
                            </tr>

                        <?php }
                        ?>

                        <tr><td colspan=6><hr size=1></td></tr>
                        <tr>
                            <td colspan="6" align=center> <input type="hidden" name="cnt" value="<?php echo $cnt; ?>">
                                <input type="submit" name="Submit2" value="Relist" class="btn btn-warning btn-big">
                            </td>
                        </tr>
                    </table>
                </form></td>
        </tr>
    </table>
<?php } else { ?>
    <tr>
        <td colspan="6">
            <div class="alert alert-danger alert-dismissable" style="text-align:center;">No Expired Buy Offer Details.</div>
        </td>
    </tr>
<?php } ?>













<?php
$sbq_off="select * from " . $prev. "offers_buy where uid=".$this->session->userdata['logged_in']['user_id']." and approved='no' order by postedon desc limit 0,5";


$res=$this->Site_model->getcountRecods($sbq_off);
if(!empty($res)) {
    $sbsell_count = count($this->Site_model-> getcountRecods($sbq_off));

}
$sbrs_off=$this->Site_model-> getcountRecods($sbq_off);
if (!empty($sbrs_off))
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >
        <tr>
            <td style="padding-left:10px;"><font class='normal'>Buy Offers(Unapproved) - <strong><font class='red'><?php echo $sbsell_count; ?></font></strong>
            </td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td valign="top"><form name="form4" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="manage-product">
                        <tr class="subtitle">
                            <td width="10%" style="padding-left:10px;"> <input type="checkbox" name="check_all" value="yes" onClick="select_all3();">
                            </td>

                            <td width="20%">Title</td>
                            <td width="20%">Posted On</td>
                            <td width="20%">Expired On</td>

                        </tr>
                        <?php

                        foreach($sbrs_off as $sbrow_off)
                        {

                            ?>
                            <tr>

                                <td style="padding-left:10px;">
                                    <input name="checkbox<?php echo $sbrow_off["id"];?>" class="whochecked" type="checkbox" id="checkbox<?php echo $sbrow_off["id"];?>" value="<?php echo $sbrow_off["id"];?>"></td>

                                <td valign="top" ><?php echo $sbrow_off["title"]; ?></td>

                                <td valign="top" ><font class='normal'><?php echo date('d-M-Y H:i:s',strtotime($sbrow_off["postedon"]));?></td>
                                <td valign="top" ><font class='normal'><?php echo date('d-M-Y H:i:s',strtotime($sbrow_off["expireson"]));?></td>

                            </tr>
                        <?php
                        }
                        $count=count($sbrs_off);
                        if ($count > 5) { ?>

                            <tr style="margin:0px 0px; padding:0px 0px;">
                                <td colspan="6"><a href="my_buy_offers_list.php?approved_buy_offers=y"><button class="btn center btn-info btn-sm btn3d view-all" type="button">More.</button></a>
                                </td>
                            </tr>

                        <?php }
                        ?>

                        <tr>
                            <td colspan="6" style="padding-left:10px;" align=right><hr sie=1> <input type="hidden" name="cnt" value="<?php echo $cnt; ?>">
                                <input type="button" onClick="return removeofferproduct()" name="remove" value="Remove" class="btn btn-warning btn-big">
                            </td>
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






</div>
</div>

</div></div></div>
<script language="JavaScript">


    function removeofferproduct(){

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
                    var Url         =  baseUrl+"delete_offerproduct";
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
        for (var i=0;i<document.form2.elements.length;i++)
        {
            var e =document. form2.elements[i];
            if ((e.name != 'check_all') && (e.type=='checkbox'))
            {
                e.checked = document.form2.check_all.checked;
            }
        }

    }

    function select_all2()
    {
        for (var i=0;i<document.form3.elements.length;i++)
        {
            var e =document. form3.elements[i];
            if ((e.name != 'check_all') && (e.type=='checkbox'))
            {
                e.checked = document.form3.check_all.checked;
            }
        }

    }
    function select_all3()
    {
        for (var i=0;i<document.form4.elements.length;i++)
        {
            var e =document. form4.elements[i];
            if ((e.name != 'check_all') && (e.type=='checkbox'))
            {
                e.checked = document.form4.check_all.checked;
            }
        }

    }
    //-->
</script>

</div>
</div>

</form>

</div>
</div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>

</body>
</html>
		