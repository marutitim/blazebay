<?php
$title = "Manage Sale Offers";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";

$strinlist="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist.=",".$value;
}

$strquery=" and id in ($strinlist) ";



$strinlist_1="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist_1.=",".$value;
}



$strquery=" and id in ($strinlist_1) ";

if(isset($_POST["remove"]))
{
    //var_dump($strinlist12);die();
    $query_msg_del="delete from " . $prev. "offers where user_id=".$this->session->userdata['logged_in']['user_id']." $strquery";
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
<div class="col-md-12">

<div class="featuredpro">
<h3 class="section-title"> <a href="JavaScript:void(0);"> Manage Sale Offers  </a></h3>
<?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> Manage Sale Offers </h2><?php */?>

<?php
if(isset($msg)) echo $msg;

$config=$this->Site_model-> getcountRecods("select * from " . $prev. "config");

//$sbq_gro="select * from " . $prev. "privilage where privilage_id='".$_SESSION["memtype"]."'";
$sbq_gro="select * from " . $prev. "membership_plan where plan_id ='".$this->session->userdata['logged_in']["memtype"]."'";
$sbrow_gro=$this->Site_model-> getcountRecods($sbq_gro);
$sbrow_gro=$sbrow_gro[0];
/////////--------------getting information bout user's privious postings
$sbq_off="select * from " . $prev. "offers where user_id='".$this->session->userdata['logged_in']['user_id']."' and approved='yes' and expireson > NOW() ORDER  BY id DESC  limit 5";
$sbsell_count=count($this->Site_model-> getcountRecods($sbq_off));


/*$sbq_off='select *,UNIX_TIMESTAMP(postedon) as sbposted, UNIX_TIMESTAMP(DATE_ADD(postedon,INTERVAL '.$config["expiry_sell"].' MONTH)) as sbexpiry from ' . $prev. 'offers where uid='.$this->session->userdata['logged_in']['user_id']." and DATE_ADD(postedon,INTERVAL ".$config["expiry_sell"]." MONTH) > NOW()"; */
$sbrs_off=$this->Site_model-> getcountRecods($sbq_off);

    ?>


    <strong>Sell Offers</strong>

<table class="table table-hover table-striped" id="data-table">
    <thead>
                        <tr class="subtitle">
                            <td width="10%"  style="padding-left:10px;">
                                <input type="checkbox" name="check_all" value="yes" onClick="select_all();">
                            </td>
                            <td >Title</td>
                            <td >Posted On</td>
                            <td >Expires On</td>
                            <td width="10%">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt=0;
                            foreach($sbrs_off as $key=>$sbrow_off )
                            {
                                $cnt++;
                                $sbq_off_img="select * from " . $prev. "offer_images where offer_id=".$sbrow_off['id'];
                                $res=$this->Site_model-> getcountRecods($sbq_off_img);
                                if(!empty($res)){
                                    $sbno_of_images=count($this->Site_model-> getcountRecods($sbq_off_img));
                                }else{
                                    $sbno_of_images=0;
                                }
                                ?>
                                <tr>
                                    <td  style="padding-left:10px;"><input name="checkbox<?php echo $sbrow_off["id"];?>" type="checkbox" id="checkbox<?php echo $sbrow_off["id"];?>" value="<?php echo $sbrow_off["id"];?>"></td>
                                    <td valign="top" ><?php
                                        $prod_title = $this->Site_model-> getcountRecods("select * from ".$prev."products where id='".$sbrow_off['prod_id']."'");
                                        //echo "select title from ".$prev."products where id='".$sbrow_off['prod_id']."'"; die;
                                        $proname = RemoveBadURLChars(strtolower($prod_title[0]["title"]));
                                        ?>
                                        <a href="<?php echo base_url(); ?>product-details/<?php echo $proname.'/'.$sbrow_off["prod_id"].'/'.$sbrow_off["user_id"]; ?>" target="_blank">
                                            <?php echo $prod_title[0]['title']; ?>
                                        </a>
                                    </td>

                                    <td valign="top"><?php echo date('d-M-Y',strtotime($sbrow_off["postedon"]));?></td>
                                    <td valign="top"><?php echo date('d-M-Y',strtotime($sbrow_off["expireson"]));?></td>
                                    <td valign="top"><a href="<?php echo base_url(); ?>edit-offer-products/<?php echo $sbrow_off["id"]; ?>">Edit</a></td>
                                </tr>
                            <?php
                            } ?>

    </tbody>
                    </table>

<?php
// $sbq_off='select *,UNIX_TIMESTAMP(postedon) as sbposted, UNIX_TIMESTAMP(DATE_ADD(postedon,INTERVAL '.$config["expiry_sell"].' MONTH)) as sbexpiry from ' . $prev. 'offers where uid='.$this->session->userdata['logged_in']['user_id'].' and DATE_ADD(postedon,INTERVAL '.$config['expiry_sell'].' MONTH) <= NOW()';
// $sbq_off;
// $sbrs_off=mysql_query($sbq_off);

$sbq_exproff="select * from bt_offers where user_id ='".$this->session->userdata['logged_in']["user_id"]."' and approved ='yes' and expireson < NOW() ORDER BY id DESC  limit 0,5 ";
$fetsbq_exproff = $this->Site_model-> getcountRecods($sbq_exproff);
    ?>


    <strong>Sell Offers (Expired)</strong>


    <table class="table table-hover table-striped" id="data-table">
        <thead>
        <tr>
            <td valign="top"><form name="form3" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                        <tr class="subtitle">
                            <td width="28"  style="padding-left:10px;">
                                <input type="checkbox" name="check_all" value="yes" onClick="select_all2();">
                            </td>
                            <td width="118">Title</td>
                            <td width="248">Posted On</td>
                            <td width="179">Expired On</td>
                            <td width="188"><b></b></td>
                        </tr>
        </thead>
        <tbody>
        <?php
                        foreach($fetsbq_exproff as $sbrowexp_off )
                        // print_r($sbrowexp_off);
                        {

                        ?>

                        <tr>
                            <td  style="padding-left:10px;"><input name="checkbox<?php echo $sbrowexp_off["id"];?>" type="checkbox" id="checkbox<?php echo $sbrowexp_off["id"];?>" value="<?php echo $sbrowexp_off["id"];?>"></td>
                            <td valign="top"><?php
                                $prod_title =$this->Site_model-> getcountRecods("select * from  bt_products where id='".$sbrowexp_off['prod_id']."'");
                                ?>


                                <?php echo $prod_title[0]['title']; ?>

                            </td>
                            <input type='hidden' value="<?php echo $prod_title["title"]; ?>">
                            <td valign="top"><?php echo date('d-M-Y',strtotime($sbrowexp_off["postedon"]));?></td>
                            <td valign="top"><?php echo date('d-M-Y',strtotime($sbrowexp_off["expireson"]));?></td>
                            <td valign="top"><a href="<?php echo base_url(); ?>edit-offer-products/<?php echo $sbrowexp_off["id"]; ?>">Edit</a></td>

<?php } ?>
        </tbody>
    </table>



<script language="JavaScript">
    //<!--
    function select_all()
    {
        //alert('jjj');
        for (var i=0;i<document.form2.elements.length;i++)
        {
            var e =document.form2.elements[i];
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

<script language="javascript">
    //<!--
    function formValidate(form) {
        if(form.add_desc.value == "") {
            alert('Please enter description.');
            return false;
        }
        return true;
    }
    //-->

</script>
</div>
</div>

</div></div></div>

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
