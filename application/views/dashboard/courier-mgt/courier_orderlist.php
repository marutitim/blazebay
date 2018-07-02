<?php
$pagename = "courier_orderlist";

if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
//$msg = new \Plasticbrain\FlashMessages\FlashMessages();

//Usertype Checking


//get Logged user Information
if(isset($this->session->userdata['logged_in']['user_id'])){
    $logged_user_id 	= $this->session->userdata['logged_in']['user_id'];
    $logged_user_type 	= $this->session->userdata['logged_in']['usertype'];
}

//defined used tables
$prev="bt_";
$orderTable 		= $prev."order";
$orderCourierTable 	= $prev."order_courier";
$orderSupplierTable = $prev."order_supplier";
$businessTable 		= $prev."business";



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
        <div class="featuredpro">
            <h3 class="section-title">Order List</h3>
            <div  id="messageReply"  style="text-align:center;" ></div>
            <!---->
            <div class="table-responsive scroll_hidden">
                <table class="table table-hover table-striped" id="data-table">
                    <thead>
                    <tr >
                        <th style="text-align:center;">Sl</th>
                        <th width="">Order Number [Courier]</th>
                        <th>Date</th>
                        <th width=""> Country<br>[state]<br>[City]</th>
                        <th style="text-align:center">Status</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $COURIER_ASSIGNED_SQL = "SELECT o.*, cr.*
									FROM
									".$prev."order as o
									JOIN ".$prev."order_courier as cr ON o.order_id = cr.order_id
									where
										cr.courier_id =".$logged_user_id ." and cr.status !='0'
										ORDER BY cr.c_order_id DESC
									";

                    //echo $COURIER_ASSIGNED_SQL;
                    $courier_order_qry= $this->Site_model->getcountRecods($COURIER_ASSIGNED_SQL);
                    //$courier_order_qry			= mysql_query($COURIER_ASSIGNED_SQL);
                    $tracking_info				= "";


                        foreach($courier_order_qry as $key=>$corders){
                            //main order id
                            $main_order_id = $corders['order_id'];
                            // City Data
                            $ship_cityid 			= $corders['shipping_city'];
                            $ship_cityname 			= "";
                            if(!empty($ship_cityid)){
                                $where 		= "city_id = '$ship_cityid'";
                                $get_city_info= $this->Site_model->getDataById( 'bt_cities', $where );
                                $get_city_info=$get_city_info[0];
                                $ship_cityname 		= $get_city_info['city_name'];
                            }
                            //state data
                            $ship_stateid 		= $corders['shipping_state_id'];
                            $ship_statename 		= "";
                            if(!empty($ship_stateid)){
                                $where 	="state_id = '$ship_stateid'";
                                $get_state_info= $this->Site_model->getDataById( 'bt_states', $where );
                                $get_state_info=$get_state_info[0];
                                $ship_statename 	= $get_state_info['state_name'];
                            }
                            //country Data
                            $ship_countryid 		= $corders['shipping_country_id'];
                            $ship_countryname 	= "";
                            if(!empty($ship_countryid)){
                                $where 	= "country_id = '$ship_countryid'";
                                $get_country_info= $this->Site_model->getDataById( 'bt_countries', $where );
                                $get_country_info=$get_country_info[0];
                                $ship_countryname 	= $get_country_info['country_name'];
                            }

                            $order_date 			= $corders['date_added'];
                            $courier_order_status 	= $corders['status'];
                            $courier_order_numberr 	= $corders['courier_order_number'];
                            $cou_sup_status 		= $corders['sup_accept'];
                            $order_number           = $corders['order_number'];


                            $courier_order_txtsts 	= "";
                            //------
                            $buyer_status 			= $corders['buyer_status'];
                            $supplier_status 		= $corders['supplier_status'];
                            //$courier_status 		= $corders['courier_status'];
                            $courier_status 		= $corders['status']; // NOTE: status should be taken from 'order_courier' table
                            $BSC_o_s_array           = array($buyer_status,$supplier_status,$courier_status);

                            //------

                            ?>
                            <tr>
                                <td valign="top"><?php echo $sl_count;?></td>
                                <td valign="top"><?php echo $corders['courier_order_number'];?></td>
                                <td valign="top">
                                    <?php echo date('M d, Y', strtotime($corders['assign_date']));?>
                                </td>
                                <td valign="top">
                                    <?php echo $ship_countryname;?><br>
                                    [ <?php echo $ship_statename;?> ]<br>
                                    [ <?php echo $ship_cityname;?> ]
                                </td>
                                <td valign="top">
                                    <?php

                                    //==== get assigned supplier Details :: Starts ====
                                    $getSupplierData_cond = " WHERE  sp.order_id ='$main_order_id'";
                                    $getSupplierData_slct = "SELECT sp.*,b.company_name  FROM ";
                                    $getSupplierData_from = $orderSupplierTable." as sp
																			JOIN ".$businessTable." as b ON b.user_id = sp.supplier_id";

                                    //$getSupplierData = getTableData($getSupplierData_slct.$getSupplierData_from.$getSupplierData_cond);

                                    $getSupplierData= $this->Site_model->getcountRecods($getSupplierData_slct.$getSupplierData_from.$getSupplierData_cond);
                                    //$getSupplierData = getTableData($orderSupplierTable,"*",$getSupplierData, TRUE);
                                    //p($getSupplierData);

                                    if($getSupplierData){
                                        $suppCount =0;
                                        foreach ($getSupplierData as $eachSupplier) {
                                            $sup_courier_status = $eachSupplier['sup_courier_status'];
                                            $sup_company_name   = $eachSupplier['company_name'];
                                            $sup_order_id   	= $eachSupplier['sup_order_id'];
                                            //get Supplier Courier Order Status
                                            $sup_courier_order_txtsts = "";
                                            if($sup_courier_status == '1'){
                                                $sup_courier_order_txtsts = "Waiting for Pickup";
                                            }else if($sup_courier_status == '2'){
                                                $sup_courier_order_txtsts = "Received From Seller";
                                            }else if($sup_courier_status == '3'){
                                                $sup_courier_order_txtsts = "Received From Seller";
                                            }else if($sup_courier_status == '4'){
                                                $sup_courier_order_txtsts = "On the Way";
                                            }
                                            else if($sup_courier_status == '5'){
                                                $sup_courier_order_txtsts = "Delivered";
                                            }

                                            $firstbox_noborder = "";
                                            if($suppCount==0){
                                                $firstbox_noborder = "border-top:0px;";
                                            }
                                            ?>

                                            <div class="ecstrck-box ecstrck-theme " style="<?php echo $firstbox_noborder;?>">

                                                <label><span class="supp-company"><?php echo $sup_company_name;?></span>: (<?php echo $sup_courier_order_txtsts;?>)</label>

                                                <?php
                                                if($sup_courier_status =='2' || $sup_courier_status == '3'|| $sup_courier_status == '4'){ ?>

                                                    <form action="" name="form_courier_status"  id="form_courier_status"  method="post">
                                                        <input type="hidden" name="order_id" value="<?php echo $corders['order_id'];?>">
                                                        <input type="hidden" name="order_cou_id" value="<?php echo $corders['c_order_id'];?>" >
                                                        <input type="hidden" name="sup_order_id" value="<?php echo $sup_order_id;?>" >

                                                        <select name="order_status" >
                                                            <option value=""> -- Select --</option>
                                                            <option value="4">On The Way</option>
                                                            <option value="5">Delivered</option>
                                                        </select>
                                                        <input type="button" onclick="return postStatus()"  name="update_order_status" Value="Go" >
                                                    </form>

                                                <?php
                                                } ?>
                                                <!-- <hr class="supp-sts-spliter"> -->
                                            </div>


                                            <?php
                                            $suppCount++;
                                        }
                                    }
                                    //==== get assigned supplier Details :: Ends ====

                                    ?>
                                </td>
                                <td valign="top">
                                    <a href="<?php echo base_url().'courier-view-quotation/'.$corders['order_id'];?>/" class="shrtbtn">	View </a>

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
</div>


</div>
</div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>

<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
<script>
    function postStatus(){

        var UrlRedirect="<?php echo base_url();?>processCourierOrderStatus";
        var data = new FormData($('#form_courier_status')[0]);

        $.ajax({
            url: UrlRedirect,
            type: "POST",
            data: data,
            async: false,
            success: function (msg) {
                if(msg==1){
                    $("#messageReply").html('<div class="alert alert-success alert-dismissable"><i class="fa  fa-check"></i><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Success,the Order status has been updated</b></div>');
                }else{
                    $("#messageReply").html('<div class="mpesaresponse alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>An error occured,try again later</strong></div>');

                }

            },
            cache: false,
            contentType: false,
            processData: false
        });


    }

    $('#consignment_date').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: 'TRUE',
        startDate: '-0d',
        autoclose: true,
    })

    $('#s_d_date').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: 'TRUE',
        startDate: '-0d',
        autoclose: true,
    })

    $('#cus_d_date').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: 'TRUE',
        startDate: '-0d',
        autoclose: true,
    })
</script>

<script type="text/javascript">
    $('.submit_report').on('click', function (event) {
        var element = $('#' + this.id);
        $('#cou_reference').val(element.attr('data-courier-ref-number'));
        $('#cou_mainoid').val(element.attr('data-courier-main-oid'));

    });

    $('.submit_report_buyer').on('click', function (event) {
        var element = $('#' + this.id);
        $('#cou_reference_buyer').val(element.attr('data-courier-ref-number'));
        $('#cou_mainoid_buyer').val(element.attr('data-courier-main-oid'));

    });

    $('.submit_report_tracking').on('click', function (event) {
        var element = $('#' + this.id);
        //alert(element.attr('data-courier-main-oid'));
        $('#cou_reference_T').val(element.attr('data-courier-ref-number'));
        $('#cou_mainoid_T').val(element.attr('data-courier-main-oid'));
        $('#buyer_ref_number_T').val(element.attr('data-buyer-ref-number'));

    });


    $('.view_report').on('click', function (event) {
        var element = $('#' + this.id);
        var idp = (element.attr('data-courier-ref-number'));
        var idmoid = (element.attr('data-courier-main-oid'));
        // alert(idp+' '+idmoid);

        $.ajax({
            url:"<?='ajax.php'?>",
            type: 'POST',
            dataType: "json",
            data: {'courier_ord_num': idp,'courier_mord_id':idmoid},
            success:function(data)
            {
                $('#view_report1').html(data.item);
            }
        });
    });
</script>

</body>
</html>
