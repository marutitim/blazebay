<?php

if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$where="id=1";
$SITE_SETTING_INFO= $this->Site_model->getDataById("bt_setting",$where);
$SITE_SETTING_INFO=$SITE_SETTING_INFO[0];

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
    <h3 class="section-title"> Order List </h3>


    <p>
        <?php
        // $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        // Display the messages

        // $msg->display();
        ?>
    </p>

    <div class="table-responsive scroll_hidden">
        <table class="table table-hover table-striped" id="data-table">
            <thead>
            <tr>
                <th width="7%">Sl</th>
                <th width="7%">Order Number</th>
                <th>Date</th>
                <th >Country [ state ] [ City ] </th>
                <th >Status</th>
                <th style="text-align:center" >Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php


            $SUPPLIER_ASSIGNED_SQL = "SELECT o.* FROM  bt_order as o
                          where o.customer_id ='".$this->session->userdata['logged_in']['user_id']."' ORDER BY o.order_id DESC";
            $supplier_order_qry= $this->Site_model->getcountRecods($SUPPLIER_ASSIGNED_SQL);
            // $supplier_order_qry = mysql_query($SUPPLIER_ASSIGNED_SQL);


                $sl_count=1;
                foreach($supplier_order_qry as $key=>$sorders)
                {
                    $ship_cityid = $sorders['shipping_city'];
                    $ship_cityname = "";
                    if(!empty($ship_cityid))
                    {
                        //$get_city_info = getRowData($prev.'cities',"city_name","city_id = '$ship_cityid'");

                        $where=" city_id = '$ship_cityid'";
                        $get_city_info= $this->Site_model->getDataById("bt_cities",$where);
                        $ship_cityname = $get_city_info[0]['city_name'];
                    }
                    $ship_stateid = $sorders['shipping_state_id'];
                    $ship_statename = "";
                    if(!empty($ship_stateid))
                    {
                        //$get_state_info = getRowData($prev.'states',"state_name","state_id = '$ship_stateid'");

                        $where="state_id = '$ship_stateid'";
                        $get_state_info= $this->Site_model->getDataById("bt_states",$where);
                        $ship_statename = $get_state_info[0]['state_name'];
                    }
                    $ship_countryid = $sorders['shipping_country_id'];
                    $ship_countryname = "";
                    if(!empty($ship_countryid))
                    {
                        //$get_country_info = getRowData($prev.'countries',"country_name","country_id = '$ship_countryid'");

                        $where="country_id = '$ship_countryid'";
                        $get_state_info= $this->Site_model->getDataById("bt_countries",$where);

                        $ship_countryname = $get_state_info[0]['country_name'];
                    }
                    $order_date   = $sorders['date_added'];
                    $buyer_status = $sorders['buyer_status'];
                    $buyer_order_number = $sorders['order_number'];

                    $order_sts_txt = "";
                    if($buyer_status == '0'){
                        $order_sts_txt= "Waiting for Admin Approval";
                    }
                    else if($buyer_status == '1'){
                        $order_sts_txt = "<b>Admin Approved.</b>";
                    }
                    else if($buyer_status == '2'){
                        $order_sts_txt = "<b>Approved</b> <br><span class='xshr-green'> [Payment done]</span><br>";
                    }

                    //          else if($buyer_status == '3'){
                    //            $order_sts_txt = "<b>Order Process</b>";
                    //          }
                    //          else if($buyer_status == '4') {
                    //            $order_sts_txt = "<b>Order on the way</b>";
                    //          }
                    //          else if($buyer_status == '5'){
                    //            $order_sts_txt = "<b>Order received</b>";
                    //          }

                    ?>

                    <tr>
                        <td valign="top" ><?php echo $sl_count;?></td>
                        <td valign="top" ><?php echo $sorders['order_number'];?></td>
                        <td valign="top" >
                            <?php echo date('M d, Y', strtotime($sorders['date_added']));?><br>
                            <?php echo date('h:i A', strtotime($sorders['date_added']));?>
                        </td>
                        <td valign="top" >
                            <?php echo $ship_countryname;?><br>
                            [ <?php echo $ship_statename;?> ]<br>
                            [ <?php echo $ship_cityname;?> ]
                        </td>
                        <td valign="top" >
                            <?php
                            echo $order_sts_txt;
                            if($buyer_status == 2) {?>
                                <a href="<?php echo base_url().'buyer-track-order/'.$sorders['order_number'];?>" class="tbtn">Track Order</a>
                            <?php } ?>
                        </td>

                        <td valign="top" >
                            <a href="<?php echo base_url().'view-buyer-order/'.$sorders['order_id'];?>" class="tbtn">View</a>

                            <?php
                            if($buyer_status == '1') {
                                $return_url = base_url().'buyer_order_payment';
                                $cancel_url = base_url().'buyer_order_payment';
                                $notify_url = base_url().'buyer_order_payment';
                                $paypal_url = '';
                                if($SITE_SETTING_INFO['pay_paypal_mode']=="SAND"){
                                    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                                }else{
                                    $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
                                }
                                ?>
                                <form action="<?php echo $paypal_url; ?>" method="post">
                                    <input type="hidden" name="amount" id="amount" value="<?=$sorders['total']?>"/>
                                    <input name="currency_code" type="hidden" value="USD">
                                    <input name="shipping" type="hidden" value="<?=$sorders['shipping_charge']?>">
                                    <input name="return" type="hidden" value="<?php echo $return_url; ?>">
                                    <input name="cancel_return" type="hidden" value="<?php echo $cancel_url; ?>">
                                    <input name="notify_url" type="hidden" value="<?php echo $notify_url; ?>">
                                    <input name="cmd" type="hidden" value="_xclick">
                                    <input name="business" type="hidden" value="<?=$SITE_SETTING_INFO['pay_paypal_business'];?>">
                                    <input name="item_name" type="hidden" value="Order Payment">
                                    <input name="no_note" type="hidden" value="1">
                                    <input type="hidden" name="no_shipping" value="1">
                                    <input name="lc" type="hidden" value="">
                                    <input type="hidden" name="rm" value="2">
                                    <input name="custom" type="hidden" value="<?=$sorders['order_id']?>">
                                    <input name="bn" type="hidden" value="PP-BuyNowBF">
                                    <!-- <input type="submit" class="singbnt" name="submit" value="Confirm and pay"><br /> -->
                                    <button class="tbtn" type="submit" id="pay_btn">Pay Now</button>
                                </form>
                            <?php
                            }
                            // For order tracking::
                            $order_id = $sorders['order_id'];

                            // $order_tracking_info =  getRowData($prev.'order_tracking','*',"buyer_order_number = '$buyer_order_number'");

                            $where="buyer_order_number = '$buyer_order_number'";
                            $order_tracking_info= $this->Site_model->getDataById("bt_order_tracking",$where);
                            if (!empty($order_tracking_info)) {
                                $order_tracking_info=$order_tracking_info[0];
            $common_tracking_number     = $order_tracking_info['tracking_number'];
            $track_buyer_order_status   = $order_tracking_info['buyer_order_status'];
            $track_courier_order_status = $order_tracking_info['courier_order_status'];
            $track_supplier_order_status= $order_tracking_info['supplier_order_status'];
            $track_courier_ordrnum      = $order_tracking_info['courier_order_number'];
            $track_supplier_ordrnum     = $order_tracking_info['supplier_order_number'];

            $BSC_trksts_arr = array($track_buyer_order_status,$track_supplier_order_status,$track_courier_order_status);

            $BSC_status_type1 = array('0','0','0'); // tracking not strated yet..
            if(serialize($BSC_trksts_arr) != serialize($BSC_status_type1)) {
                ?>
                <a href="<?= base_url().'buyer_track_order.php?tracking_number='.$common_tracking_number;?>" class="tbtn">View Tracking Details </a>
            <?php  } } ?>


                        </td>

                    </tr>

                    <?php
                    $sl_count++;
                }
                ?>

            </tbody>
        </table>
    </div>

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
<script type="text/javascript">
    //$(document).load(function(){ $('#country').trigger('change'); });
    var xhrSlctCity = <?php echo $city;?>;
    $(document).ready(function ()
    {
        $('#country').on('change', function () {
            var user_countryID = $(this).val();
            if (user_countryID)
            {
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: 'country_id=' + user_countryID,
                    dataType: 'json',
                    //success: function (rdata) {
                    //    $('#state').html(rdata);
                    //    $('#city').html('<option value="">Select state first</option>');
                    //}

                    success:function(rdata){
                        //var country_name = rdata['country_name'];
                        //alert(rdata);
                        console.log(rdata);
                        $('#state').html(rdata['item']);
                        $('#city').html('<option value="">Select state first</option>');
                        if (rdata['state_status'] == 0)
                        {
                            $('#state').addClass('hide');
                            $('#no_user_state').removeClass('hide');
                            $('#no_user_state').html('<select disabled required="" class="form-control"><option>No State</option></select>');

                        }
                        else {
                            //$('#user_state').removeClass('hide');
                            $('#state').removeClass('hide');
                            $('#no_user_state').addClass('hide');
                        }

                    },
                    complete: function(){
                        $('#state').trigger('change');
                        //$('#user_state').addClass('hide');
                    }
                });
            } else
            {
                $('#state').html('<option value="">Select country first</option>');
                $('#city').html('<option value="">Select state first</option>');
            }
        });

        $('#state').on('change', function () {
            var user_stateID = $(this).val();
            if (user_stateID)
            {
                var datastring = {'state_id':user_stateID,'selcity':xhrSlctCity};
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    //data: 'state_id=' + user_stateID,
                    data: datastring,
                    dataType: 'html',
                    success: function (rdata) {
                        $('#city').html(rdata);
                    }
                });
            }
        });

        $('#country').trigger('change');
    });
</script>
<script>
    function  process_payment(){

        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#process_payment')[0]);

        $.ajax({
            url: base_url+"process_payment",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                //document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#paypal").html(msg);
                //window.location.href=base_url+"manage-wholesale-products";
            },
            cache: false,
            contentType: false,
            processData: false
        });


    }
    function  updateProfile(){

        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#updateProfile')[0]);

        $.ajax({
            url: base_url+"process_edit_profile",
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
		