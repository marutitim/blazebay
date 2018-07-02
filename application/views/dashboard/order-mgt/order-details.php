<?php
$pagename = "viewbuyer_orderdetails";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}



$id="";$supplier_order_id="";$supplier_order_status="";$supplier_order_quoted_price="";$supplier_order_quoted_date="";$supplier_order_quoted_by="";$supplier_order_txtsts="";
if (isset($order_id) && !empty($order_id))
{
    $prev="bt_";
    $id = $order_id;
    $order_details = $this->Site_model->getRowData($prev.'order','order_id = '.$order_id);

    $user_id = $order_details[0]['customer_id'];
    $user_details = $this->Site_model->getRowData($prev.'members','user_id = '.$user_id);

    $order_shipping_city_info = $this->Site_model->getRowData($prev.'cities',"city_id = '".$order_details[0]['shipping_city']."'");
    $order_shipping_city_name = $order_shipping_city_info[0]['city_name'];

    $order_shipping_country_info = $this->Site_model->getRowData($prev.'countries',"country_id = '".$order_details[0]['shipping_country_id']."'");
    $order_shipping_country_name = $order_shipping_country_info[0]['country_name'];



    //$company_details = $this->Site_model->getRowData($prev.'business','*','user_id = '.$user_id);

    //$supplier_Street="";$supplier_fname="";$supplier_lname="";$supplier_Street="";$supplier_zipcode=""
    $get_supplier_sql = "SELECT * FROM ".$prev."order_supplier WHERE order_id=".$id;

    $get_supplier_found =$this->Site_model->getcountRecods($get_supplier_sql);
    // $get_supplier_found = mysql_num_rows($get_supplier_qu);
    if($get_supplier_found)
    {
        $get_supplier= $get_supplier_found[0];
        $supplier_id = $get_supplier['supplier_id'];

        $supplier_info  = $this->Site_model->getRowData($prev.'members','user_id = '.$supplier_id);
        $supplier_info=$supplier_info[0];
        $supplier_fname = $supplier_info['firstname'];
        $supplier_lname = $supplier_info['lastname'];
        $supplier_Street= $supplier_info['street'];
        $supplier_City= $supplier_info['city'];
        $supplier_zipcode= $supplier_info['zip'];
        $supplier_phone= $supplier_info['phone'];

        $supplier_company_details = $this->Site_model->getRowData($prev.'business','user_id = '.$supplier_id);

    }

    $order_txtsts ="";
    $order_details=$order_details[0];
    if($order_details['buyer_status'] == '0')
    {
        $order_txtsts = "Waiting for Admin Approval";
    }
    else if($order_details['buyer_status'] == '1')
    {
        //$order_txtsts = "Waiting for Buyer Approval";
        $order_txtsts = "<b>Admin Replied.</b>";
    }
    else if($order_details['buyer_status'] == '2')
    {
        //$order_txtsts = "Approved";
        $order_txtsts = "Approved <br><span class='xshr-green'> [Payment done]</span>";
    }
    else if($order_details['buyer_status'] == '3')
    {
        //$order_txtsts = "Cancelled";
        $order_txtsts = "Item Delivered";
    }
    else if($order_details['buyer_status'] == '4')
    {
        //$order_txtsts = "Delivered";
        $order_txtsts = "Buyer Cancelled";
    }else if($buyer_status == '5'){
        $order_txtsts = "Requoted";
    }

    // get payment details::

}
else
{
    header('Location: '.base_url().'buyer_orderlist.php' );
    die();
}

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

        <div class="purchase-order">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Order No: <?= $order_details['order_number']; ?></h3>

                    <?php /*?> <p><?//= $company_details['address1'] ?></p><?php */?>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                    <!--<h3>Order No: <?= $order_details['order_number']; ?></h3>-->
                    <h3>Order Date: <?= date('M d, Y', strtotime($order_details['date_added'])) ?></h3>

                </div>
                <div class="clear"></div>
            </div>
            <div class="inner-row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 order-box">
                    <h5>VENDOR</h5>
                    <?php
                    if($get_supplier_found)
                    {
                        ?>
                        <h6>Name : <?php echo ucwords($supplier_fname.' '.$supplier_lname);?>&nbsp;</h6>
                        <h6>Company name : &nbsp;<?php echo ucwords($supplier_company_details[0]['company_name']);?></h6>
                        <h6>Street Address : <?php echo $supplier_Street;?>&nbsp;</h6>
                        <h6>City : &nbsp;<?php echo ucwords($supplier_City);?></h6>
                        <h6>Pincode : &nbsp;<?php echo $supplier_zipcode;?></h6>
                        <h6>Phone : <?php echo $supplier_phone;?></h6>
                    <?php
                    }
                    else
                    {
                        ?>
                        <h6>Name : <b>Waiting</b></h6>
                        <h6>Company name : &nbsp;</h6>
                        <h6>Street Address : </h6>
                        <h6>City : &nbsp;</h6>
                        <h6>Pincode : &nbsp;</h6>
                        <h6>Phone : </h6>
                    <?php
                    }
                    ?>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 order-box">
                    <h5>SHIP TO</h5>
                    <h6>Name : <?= ucwords($order_details['shipping_firstname']); ?>&nbsp;<?= ucwords($order_details['shipping_lastname']); ?></h6>

                    <h6>Street Address : <?= $order_details['shipping_address_1'] ?>&nbsp;</h6>
                    <h6>Country : <?= ucwords($order_shipping_country_name); ?>&nbsp;</h6>
                    <h6>City : <?= $order_shipping_city_name; ?>&nbsp;</h6>
                    <h6>Pincode : <?= $order_details['shipping_postcode'] ?>&nbsp;</h6>
                    <h6>Phone : <?= $order_details['shipping_phone'] ?>&nbsp;</h6>

                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="order-form">
            <table>
                <tr>
                    <th width="20px">SL</th>
                    <th width="70px">PHOTO</th>
                    <th>ITEM</th>
                    <th>QTY</th>
                    <th class="im-text-right">UNIT PRICE</th>
                    <th class="im-text-right">PRICE</th>
                </tr>
                <?php
                $gp_product_total = 0;
                $getprod_sql = "SELECT p.*,op.product_id as ordered_pid,op.price as ordered_pprice,op.quantity as ordered_pqty,op.total as ordered_ptotal
                        FROM ".$prev."products as p
                        JOIN ".$prev."order_product as op ON p.id = op.product_id
                        WHERE op.order_id = '$id'";

                //$get_product_details = getTableData($prev.'order_product', "*","order_id = '$id'");
                //  $get_product_qry 	= mysql_query($getprod_sql);
                $get_product_qry = $this->Site_model->getcountRecods($getprod_sql);

                $get_product_found= count($get_product_qry);
                $currency_symbol="$";
                if($get_product_found)
                {

                    $curq = "select * from ".$prev ."currencies where sbcur_status= '1'";
                    $cur = $this->Site_model->getcountRecods($curq);

                    $currency_symbol = $cur[0]['sbcur_symbol'];

                    $gp_count = 1;

                    if(!empty($get_product_qry)){
                        foreach($get_product_qry as $getpro_details)
                        {

                            $cur = "select * from ".$prev ."currencies where sbcur_status= '1' AND sbcur_id=".$getpro_details['price_cur_id']."";
                            $cur = $this->Site_model->getcountRecods($curq);
                            $currency_symbol = $cur[0]['sbcur_symbol'];
                            $gp_product_total = $gp_product_total + $getpro_details['ordered_ptotal'];
                            $wsale_product = "";
                            if($getpro_details['wholesale']=='1'){$wsale_product="( Wholesale Product )";}

                            ?>
                            <tr>
                                <td><?php echo $gp_count;?></td>
                                <td>
                                    <img src="<?=base_url();?>assets/uploadedimages/<?=$getpro_details['image'];?>" style="width:60px;height:60px;" >
                                </td>
                                <td><?php echo $getpro_details['title']?>
                                    <p class="xhr-shwptype"><?=$wsale_product;?></p>
                                </td>
                                <!--<td><?php //echo $getpro_details['description']?></td>-->
                                <td><?php echo $getpro_details['ordered_pqty'];?></td>
                                <td class="im-text-right"><?php echo 'KSH';?>
                                    <?php
                                    if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
                                        if($arr = json_decode($resp)){
                                            if($exc_rate = $arr->value){
                                                $price = ceil($getpro_details['ordered_pprice'] * $exc_rate);
                                                $currency = 'KES';

                                            }
                                        }
                                    }

                                    echo $price;
                                    ?></td>
                                <td class="im-text-right"><?php echo 'KSH';?>
                                    <?php echo $price * $getpro_details['ordered_pqty'];?></td>
                            </tr>
                            <?php
                            $gp_count++;
                        }
                    }
                }
                ?>
            </table>
            <div class="clear"></div>
        </div>
        <div class="purchase-order">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!--
                  <ul>
                    <li>1. Please send two copies of your invoice.</li>
                    <li>2. Enter this order in accordance with the prices, terms, delivery method, and specifications listed above.</li>
                    <li>3. Please notify us immediately if you are unable to ship as specified.</li>
                    <li>4. send all correspondence to: <br>
                      Name <br>
                      Address <br>
                      Pin Code <br>
                      Phone</li>
                  </ul>
                  -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                <form method="post" name="frm_place_quote" action="">
                    <h6>Product Price : (<?php echo 'KSH';?>)<input name="product_price" type="text" value="" readonly="" class="im-text-right" /></h6>

                    <h6>Shipping Price : (<?php echo 'KSH';?>)
                        <input name="shipping_charge" type="text" value="<?=$order_details['shipping_charge'];?>" readonly="" class="im-text-right" /></h6>
                    <?php
                    $grand_total = ($order_details['total']);
                    ?>

                    <h6>Grand Total : (<?php echo 'KSH';?>)<input name="grand_total" type="text" value="<?=$grand_total;?>" readonly="" class="im-text-right" /></h6>

                    <!--
        <h6>Aspected Total : (<?php echo 'KSH';?>)
          <input name="grand_total" type="text" placeholder="" value="0.00" readonly="" />
        </h6>
        -->
                    <!--<h6 >Order Status : <span style="font-weight:bold;"><?php echo $order_txtsts;?></span> </h6>-->

                    <div class="clear"> </div>
                    <!--
                    <input name="quote_date" value="" type="text" placeholder="Date" class="border-none" />
                    -->

                    <!--
                    <div class="clear"></div>
                    <button name="submit_quote" type="submit" class="btn center btn-info btn-sm btn3d view-all margin-top2">Submit</button>
                    <input name="submit_quote" type="submit" value="Submit" class="btn center btn-info btn-sm btn3d view-all margin-top2">-->

                </form>
            </div>
            <div class="clear"></div>
            <p class="text-center">
                <a href="<?=base_url();?>buyer-orderlist" ><button class="btn">Back</button></a>
            </p>
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

</body>
</html>
