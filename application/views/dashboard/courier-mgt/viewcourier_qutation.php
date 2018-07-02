<?php
$pagename = "viewcourier_quotation_page";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

// defined tables
$prev="bt_";
$orderSupplierTable = $prev."order_supplier";
$businessTable      = $prev."business";


$id="";$courier_order_id="";$courier_order_status="";$courier_order_quoted_price="";$courier_order_quoted_date="";$courier_order_quoted_by="";


if (isset($order_id) && !empty($order_id))
{
    $id = $order_id;
    $main_order_id = $id;

    //$order_details = getRowData('bt_order','*','order_id = '.$id);
    $where="order_id = '".$id."'";
    $order_details= $this->Site_model->getDataById( 'bt_order', $where );

    $order_details=$order_details[0];
    $user_id = $order_details['customer_id'];
    //$user_details = getRowData('bt_members','*','user_id = '.$user_id);

    $where="user_id = '$user_id'";
    $user_details= $this->Site_model->getDataById( 'bt_members', $where );


    $ship_city_name ="";
    if($order_details['shipping_city'] !="")
    { $ship_city_id = $order_details['shipping_city'];
        //$ship_city_name = getValue($prev.'cities',"city_name","city_id = '$ship_city_id'");

        $where="city_id = '$ship_city_id'";
        $ship_city_name= $this->Site_model->getDataById( 'bt_cities', $where );
        $ship_city_name=$ship_city_name[0]['city_name'];

    }
    $ship_state_name="";
    if($order_details['shipping_state_id'] !="")
    {
        $ship_state_id = $order_details['shipping_state_id'];
        // $ship_state_name = getValue($prev.'states',"state_name","state_id = '$ship_state_id'");

        $where="state_id = '$ship_state_id'";
        $ship_state_name= $this->Site_model->getDataById( 'bt_states', $where );
        $ship_state_name=$ship_state_name[0];
        $ship_state_name=$ship_state_name['state_name'];

    }


    // LOGGON USER DETAILS::
    $logged_user_id = $this->session->userdata['logged_in']['user_id'];
    $logged_user_details =$this->Site_model-> getRowData($prev.'members','user_id = '.$logged_user_id);
    $company_details =$this->Site_model-> getRowData($prev.'business','user_id = '.$logged_user_id);
    $company_details=$company_details[0];

    // Supplier Details::
    $supplier_Street="";$supplier_fname="";$supplier_lname="";$supplier_Street="";
    $get_supplier_sql = "SELECT * FROM ".$prev."order_supplier WHERE order_id=".$id;

    $get_supplier_found =$this->Site_model-> getcountRecods($get_supplier_sql);
    if($get_supplier_found)
    {
        $get_supplier =$get_supplier_found[0];
        $supplier_id  = $get_supplier['supplier_id'];

        $supplier_info  =$this->Site_model-> getRowData($prev.'members','user_id = '.$supplier_id);
        $supplier_info=$supplier_info[0];
        $supplier_fname = $supplier_info['firstname'];
        $supplier_lname = $supplier_info['lastname'];
        $supplier_Street= $supplier_info['street'];

        $supplier_company_details =$this->Site_model-> getRowData($prev.'business','user_id = '.$supplier_id);
        $supplier_company_details=$supplier_company_details[0];
    }

    $courier_order_details =$this->Site_model->getRowData($prev.'order_courier','order_id = '.$id);
    $courier_order_details=$courier_order_details[0];
    $courier_order_id = $courier_order_details['c_order_id'];
    $courier_order_status = $courier_order_details['status'];
    $courier_order_quoted_price = $courier_order_details['courier_price'];
    $courier_order_quoted_date = $courier_order_details['quoted_date'];
    $courier_order_quoted_by = $courier_order_details['quoted_by'];

    $courier_order_txtsts ="";
    // if( $courier_order_status == '0')
    // {
    //   $courier_order_txtsts = "Opened";
    // }
    // else if($courier_order_status == '1')
    // {
    //   $courier_order_txtsts = "Waiting For Approve";
    // }
    // else if($courier_order_status == '2')
    // {
    //   $courier_order_txtsts = "Approved";
    // }
    // else if($courier_order_status == '3')
    // {
    //   $courier_order_txtsts = "Disapproved";
    // }
    //print_r($supplier_company_details);

    // Currency
    $cur ="select * from ".$prev ."currencies where sbcur_status= '1'";


    $curr =$this->Site_model-> getcountRecods($cur);
    $currency_symbol = $curr[0]['sbcur_symbol'];
    //==== get assigned supplier Details :: Starts ====
    $getSupplierData_cond = " WHERE sp.order_id ='$main_order_id'";
    $getSupplierData_slct = " SELECT sp.*,b.company_name   FROM ";
    $getSupplierData_from = $orderSupplierTable." as sp
                JOIN ".$businessTable." as b ON b.user_id = sp.supplier_id";

    $getSupplierData =$this->Site_model-> getcountRecods($getSupplierData_slct.$getSupplierData_from.$getSupplierData_cond);
    //$getSupplierData = getTableData($getSupplierData_from, $getSupplierData_slct, $getSupplierData_cond, TRUE);
    //p($getSupplierData);
}
else
{
    header('Location: '.base_url().'courier-orderlist/' );
    die;
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


        <div class="purchase-order">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h2><?= ucwords($company_details['company_name']); ?></h2>
                <!--<h3>Company Slogan</h3>-->
                <p><?= ucwords($company_details['address1']); ?></p>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                <h3>Order Details ::</h3>
                <h3>Date: <?= date('M d, Y', strtotime($courier_order_details['assign_date'])) ?></h3>
                <!--<h3>Courier Order No: <?//= $courier_order_details['courier_order_number'] ?></h3>-->
                <p>Courier Order No: <?= $courier_order_details['courier_order_number'] ?></p>
            </div>

            <div class="clear"></div>
            <div class="inner-row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 order-box">
                    <h5>VENDOR</h5>

                    <?php
                    if($get_supplier_found)
                    {
                        ?>
                        <h6>Name : <?=ucwords($supplier_fname.' '.$supplier_lname);?></h6>
                        <h6>Company name : <?= ucwords($supplier_company_details['company_name']);?>&nbsp;</h6>
                        <h6>Street Address : <?= ucwords($supplier_company_details['address1']); ?>&nbsp;</h6>
                        <h6>State : <?=ucwords($supplier_company_details['state']);?>&nbsp;</h6>
                        <h6>City : <?= ucwords($supplier_company_details['city']);?>&nbsp;</h6>
                        <h6>Pincode : <?= $supplier_company_details['zip'] ?>&nbsp;</h6>
                        <h6>Phone : <?= $supplier_company_details['phone']; ?></h6>
                    <?php
                    }else{ ?>
                        <h6>Name :  Waiting</h6>
                        <h6>Company name : &nbsp;</h6>
                        <h6>Street Address : &nbsp;</h6>
                        <h6>State : &nbsp;</h6>
                        <h6>City : &nbsp;</h6>
                        <h6>Pincode : &nbsp;</h6>
                        <h6>Phone : </h6>
                    <?php } ?>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 order-box">
                    <h5>SHIP TO</h5>
                    <h6>Name : <?= ucwords($order_details['shipping_firstname']);?>&nbsp;<?= ucwords($order_details['shipping_lastname']);?></h6>
                    <h6>&nbsp;</h6>
                    <h6>Street Address : <?= ucwords($order_details['shipping_address_1']); ?>&nbsp;</h6>
                    <h6>State : <?=$ship_state_name;?>&nbsp;</h6>
                    <h6>City : <?= $ship_city_name;?>&nbsp;</h6>
                    <h6>Pincode : <?= $order_details['shipping_postcode'] ?>&nbsp;</h6>
                    <h6>Phone : <?= $order_details['shipping_phone'] ?>&nbsp;</h6>
                    <!--<h6>Customer ID : <?//= $user_details['user_id'] ?>&nbsp;</h6>-->
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
                    <!--<th>DESCRIPTION</th>-->
                    <!--<th>UNIT PRICE</th>
                    <th>GRAND TOTAL</th>-->

                </tr>
                <?php

                if($getSupplierData)
                {
                    foreach ($getSupplierData as $eachSupplier) {
                        $supplier_id = $eachSupplier['supplier_id'];

                        ?>
                        <tr>
                            <td colspan="5">
                                <div class="pro-company-heading text-left">
                                    <label>Supplier :: </label>&nbsp; <?php echo strtoupper($eachSupplier['company_name']);?>
                                    <div></div>
                                </div>

                            </td>
                        </tr>
                        <?php
                        //==== getting product Details :: starts ============
                        $getprod_sql = "SELECT p.*,op.product_id as ordered_pid,op.price as ordered_pprice,op.quantity as ordered_pqty,op.total as ordered_ptotal
                            FROM ".$prev."products as p
                            JOIN ".$prev."order_product as op ON p.id = op.product_id
                            WHERE p.uid = '$supplier_id'";

                        //$get_product_details = getTableData($prev.'order_product', "*","order_id = '$id'");

                        $get_product_qry =$this->Site_model-> getcountRecods($getprod_sql);
                        // $get_product_qry 	= mysql_query($getprod_sql);
                        $get_product_found 	= count($get_product_qry);
                        if($get_product_found)
                        {
                            $gp_count = 1;
                            foreach($get_product_qry as $key=>$getpro_details)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $gp_count;?></td>
                                    <td>
                                        <img src="<?=base_url();?>assets/uploadedimages/<?=$getpro_details['image'];?>" style="width:60px;height:60px;" >
                                    </td>
                                    <td><?php echo $getpro_details['title']?></td>
                                    <td><?php echo $getpro_details['ordered_pqty']?></td>
                                    <!--<td><?php //echo $getpro_details['description']?></td>-->
                                    <!--<td><?php //echo $getpro_details['ordered_pprice']?></td>
                <td><?php //echo $getpro_details['ordered_ptotal']?></td>-->
                                </tr>
                                <?php
                                $gp_count++;
                            }
                        }
                        //==== getting product Details :: Ends ============
                    }
                }
                ?>

            </table>
            <div class="clear"></div>
        </div>
        <!--
        <div class="purchase-order">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right"></div>
          <div class="clear"></div>
        </div>
        -->
        <div class="text-center">
            <a href="<?=base_url();?>courier-orderlist/"><button class="btn">Back</button></a>
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

$("#cprice").on('keyup change',function(){
    calpercentgemin(this);

});

function calpercentgemin(e)

{

    var pcnt=<?php echo 5;?>;

    var nprice=0;

    var spval= e.value;   //alert(spval);



    if(spval == 'NaN' || spval == "") {

        spval = 0.00;

        document.getElementById("price").value = spval.toFixed(2);

    } else {

        spval = parseFloat(spval);

        pcnt = parseFloat(pcnt);

        var pcnt_rs = parseFloat( parseFloat( spval*pcnt )/100 );

        nprice = parseFloat(spval + pcnt_rs);

        document.getElementById("price").value = nprice;

    }


}

var base_url='<?php echo base_url();?>';

function  cancell(){
    var redirect_url="<?php echo base_url();?>locations-pricing";
    window.location.href=redirect_url;
}
$('#sourceCountry').on('change',function(){
    var loc_countryID = $(this).val();
    //alert(loc_countryID);

    if (loc_countryID)
    {
        shr_last_valid_selection = $(this).val();
        if(loc_countryID != "")
        {
            var datastring={'multiple':'multiselect','multi_country_id':loc_countryID}
            $.ajax({
                type:'POST',
                url:base_url+"fetstates",
                data:datastring,
                dataType: 'html',
                success: function (data) {

                    var result = $.trim(data);

                    if (result == '<option value="">Select States</option>') {

                        $("#sourcestate").empty();

                    } else {

                        $("#sourcestate").empty();

                        $('#sourcestate').css('display', 'block');
                        $('#sourcestate').html(data);

                    }



                }
            });
        }
    }
    else
    {
        $(this).val(shr_last_valid_selection);
        $('#loc_country_msg').html('You can only choose 2!');
    }



});


$('#destCountry').on('change',function(){
    var loc_countryID = $(this).val();
    //alert(loc_countryID);

    if (loc_countryID)
    {
        shr_last_valid_selection = $(this).val();
        if(loc_countryID != "")
        {
            var datastring={'multiple':'multiselect','multi_country_id':loc_countryID}
            $.ajax({
                type:'POST',
                url:base_url+"fetstates",
                data:datastring,
                dataType: 'html',
                success: function (data) {

                    var result = $.trim(data);

                    if (result == '<option value="">Select States</option>') {

                        $("#deststate").empty();

                    } else {

                        $("#deststate").empty();

                        $('#deststate').css('display', 'block');
                        $('#deststate').html(data);

                    }



                }
            });
        }
    }
    else
    {
        $(this).val(shr_last_valid_selection);
        $('#loc_country_msg').html('You can only choose 2!');
    }



});


$('#sourcestate').on('change',function(){

    var loc_countryID = $(this).val();

    if (loc_countryID)
    {
        shr_last_valid_selection = $(this).val();
        if(loc_countryID != "")
        {
            var datastring={'multiple':'multiselect','multi_country_id':loc_countryID}
            $.ajax({
                type:'POST',
                url:base_url+"fetcities",
                data:datastring,
                dataType: 'html',
                success: function (data) {

                    var result = $.trim(data);

                    if (result == '<option value="">Select Cities</option>') {

                        $("#sourcecities").empty();

                    } else {

                        $("#sourcecities").empty();

                        $('#sourcecities').css('display', 'block');
                        $('#sourcecities').html(data);

                    }



                }
            });
        }
    }
    else
    {
        $(this).val(shr_last_valid_selection);
        $('#loc_country_msg').html('You can only choose 2!');
    }



});

$('#deststate').on('change',function(){
    var loc_countryID = $(this).val();
    //alert(loc_countryID);

    if (loc_countryID)
    {
        shr_last_valid_selection = $(this).val();
        if(loc_countryID != "")
        {
            var datastring={'multiple':'multiselect','multi_country_id':loc_countryID}
            $.ajax({
                type:'POST',
                url:base_url+"fetcities",
                data:datastring,
                dataType: 'html',
                success: function (data) {

                    var result = $.trim(data);

                    if (result == '<option value="">Select Cities</option>') {

                        $("#destcities").empty();

                    } else {

                        $("#destcities").empty();

                        $('#destcities').css('display', 'block');
                        $('#destcities').html(data);

                    }



                }
            });
        }
    }
    else
    {
        $(this).val(shr_last_valid_selection);
        $('#loc_country_msg').html('You can only choose 2!');
    }



});

$('#destcities').on('change',function(){

    var sourceCountry = $('#sourceCountry').val();
    var destCountry = $('#destCountry').val();
    var sourcecities =$('#sourcecities').val();
    var destcities =$('#destcities').val();

    var datastring={'sourceCountry':sourceCountry,
        'destCountry':destCountry,
        'sourcecities':sourcecities,
        'destcities':destcities
    }

    var url="<?php echo base_url();?>getdistanceInKms";
    $.ajax({
        type:'POST',
        url:url,
        data:datastring,
        dataType: 'html',
        success: function (data) {
            var result = $.trim(data);
            $('#mindistanceKm').val(result);



        }
    });
});


function  editPricing(){

    var base_url="<?php echo base_url();?>";
    var formData = new FormData($('#locationfrm')[0]);

    $.ajax({
        url: base_url+"procees_edit_location_pricing",
        type: "POST",
        data: formData,
        async: false,
        success: function (msg) {
            $("#msgReplies").html(msg);
            window.location.href=base_url+"locations-pricing";
        },
        cache: false,
        contentType: false,
        processData: false
    });
}
</script>

</body>
</html>
