<?php
$title = "Manage products";


if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";


//===== get login user Details:: Starts =====
if(isset($this->session->userdata['logged_in']['user_id'])){
    $logged_userid      = $this->session->userdata['logged_in']['user_id'];
    $logged_memtype     = $this->session->userdata['logged_in']["memtype"];
    $logged_user_id     = $this->session->userdata['logged_in']['user_id'];
    $logged_user_planid = $this->session->userdata['logged_in']['memtype'];

    $user_id              = $logged_userid;

}
//===== get login user Details:: Ends =====

//===== Showing Products : Type : Starts =======
$breadcrum_showingProducts = "";
if (isset($approved_products))
{
    $show_productType = $approved_products;

    if($show_productType == "y"){
        $breadcrum_showingProducts = "Products(Approved )";
    }else if($show_productType == "n"){
        $breadcrum_showingProducts = "Products (Not Approved)";
    }else if($show_productType == "ex"){
        $breadcrum_showingProducts = "Products (Expired)";
    }
}
//===== Showing Products : Type : Ends =======


$strinlist="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist.=",".$value;
}

$strquery=" and id in ($strinlist) ";

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
            <h3 class="section-title">
                <a href="manage-products"> Product Catalogs </a>
            </h3>

            <?php

            $config=$this->Site_model->execute("select * from " . $prev. "config");

            $sbq_gro="select * from " . $prev. "membership_plan where plan_id ='".$this->session->userdata['logged_in']["memtype"]."'";
            $sbrow_gro=$this->Site_model->execute($sbq_gro);

            /////////--------------getting information bout user's privious postings
            $sbq_off="select * from " . $prev. "products where uid=".$this->session->userdata['logged_in']['user_id']."  and approved='yes' and wholesale=1  and expireson > now() ORDER BY id DESC";
            $sbrow_gro=$this->Site_model->execute($sbq_off);
            $sbsell_count=count($sbrow_gro);


            // $sbq_off='select *,UNIX_TIMESTAMP(postedon) as sbposted, UNIX_TIMESTAMP(DATE_ADD(postedon,INTERVAL '.$config['expiry_sell'].' MONTH)) as sbexpiry from ' . $prev. 'products where uid='.$_SESSION['user_id']. " and expireson > now()";
            // echo $sbq_off;
            //  die();
            //$sbq_off="select * from " . $prev. "products where uid='".$_SESSION['user_id']."' and approved='yes' and expireson > NOW() ";



            if ($approved_products =='y') {
                $sql ="select * from " . $prev. "products where uid='".$this->session->userdata['logged_in']['user_id']."' and approved='yes' and wholesale='1' and expireson > NOW() ORDER BY id DESC";
            } else if ($approved_products=='ex') {
                $sql="select * from " . $prev. "products where uid=".$this->session->userdata['logged_in']['user_id']." and approved='yes' and wholesale='1' and expireson <= now() ORDER BY id DESC";
            } else if ($approved_products=='n') {
                $sql ="select * from " . $prev. "products where uid='".$this->session->userdata['logged_in']['user_id']."' and approved='no' and wholesale='1' ORDER BY id DESC ";
            }


            $sbrs_off = $sbrow_gro=$this->Site_model->execute($sql);
                ?>

                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >
                    <tr>
                        <td style="padding-left:10px;"><font class='normal'>Posted - <strong><font class='red'><?php echo $sbsell_count; ?></font></strong>
                                Maximum Allowed - <strong><font class='red'><?php if($sbrow_gro["no_of_products"]>10000){ echo "Unlimited";}else{ echo $sbrow_gro["no_of_products"];} ?></font></strong>
                        </td>
                    </tr>
                 </table>

                                <table class="table table-hover table-striped" id="data-table">
                                    <thead> <tr class="subtitle">
                                        <td width="10%" style="padding-left:10px;"> <input type="checkbox" name="check_all" value="yes" onClick="select_all();">
                                        </td>
                                        <td width="20%">Picture</td>
                                        <td width="20%">Title</td>
                                        <!--td>Images</td-->
                                        <td width="20%">Posted On</td>
                                        <td width="20%">Expired On</td>
                                        <td width="10%">Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php


                                    foreach($sbrs_off as $sbrow_off)
                                    {
                                        $product_link = "javascript:void(0);";
                                        if($sbrow_off["approved"]=="yes"){
                                            $product_link =base_url()."product-details/".RemoveBadURLCharaters($sbrow_off["title"]).'/'.$sbrow_off['id']."/".$sbrow_off['uid'];
                                        }
                                        $filename = $sbrow_off['image'] ;
                                        if(file_exists($filename) || $sbrow_off['image'] != '') {
                                            $pic = base_url().'assets/uploadedimages/'.$sbrow_off['image'] ;
                                        } else {
                                            $pic=base_url()."assets/images/nopic.jpg";
                                        }
                                        ?>
                                        <tr style="height:150px;">
                                            <td style="padding-left:10px;">

                                                <input name="checkbox<?php echo $sbrow_off["id"];?>" type="checkbox" id="checkbox<?php echo $sbrow_off["id"];?>" value="<?php echo $sbrow_off["id"];?>"></td>


                                            <td>

                                                <img style="max-width:100px;max-height:100px" src="<?php echo $pic ; ?>"  >

                                            </td>
                                            <td > <a href="<?=$product_link;?>" ><?php echo $sbrow_off["title"]; ?></td>
                                            <td > <?php echo $sbrow_off["postedon"] ; ?></td>
                                            <td >  <?php  if($sbrow_off["expireson"]=='0000-00-00'){

                                                    echo "N/A";

                                                }else{

                                                    echo date('d-M-Y H:i:s',strtotime($sbrow_off["expireson"]));

                                                } ?></td>
                                            <td >   <a href="<?php echo base_url();?>wholesale-product-edit/<?php echo $sbrow_off["id"]; ?>" >Edit</a></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    </tbody>

                                </table>




        </div>
    </div>

</div></div>

</div>
</div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>

</body>
</html>
