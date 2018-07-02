<?php

$title = "Supplier Orderlist";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";

$updt_suppler_order_number=""; $updt_supplier_user_id="";
if(isset($this->session->userdata['logged_in']['user_id']) ){$updt_supplier_user_id = $this->session->userdata['logged_in']['user_id'];}



$sitelinks_wiz = array();
$userprev = "supplier_";
$sitelinks_wiz['url_home'] = base_url();
$sitelinks_wiz[$userprev."dashboard"] = base_url().'dashboard';
$sitelinks_wiz[$userprev."orderlist"] = base_url().'supplier_orderlist.php';


//p($sitelinks_wiz);
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


<h3 class="section-title"> <a href=""> Order List </a></h3>
<?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i>Order List</h2><?php */?>

<div id="messageReply" ></div>


<!---->
<div class="table-responsive scroll_hidden">
<table class="table table-hover table-striped" id="data-table">
<thead>
<tr>
    <th width="7%">Sl</th>
    <th width="7%">Order Number [Supplier]</th>
    <th>Date</th>
    <th >Price</th>
    <th >Country<br>[State]<br>[City]</th>
    <th style="text-align:center" >Current Status</th>
    <th style="text-align:center" >Action</th>

</tr>
</thead>
<tbody>
<?php
//$courier_order_qry=mysql_query("select * from ".$prev."order where courier_id =".$this->session->userdata['logged_in']['user_id']) ;

$SUPPLIER_ASSIGNED_SQL = "SELECT o.*,sp.* FROM bt_order as o
                JOIN bt_order_supplier as sp ON o.order_id = sp.order_id
                where sp.supplier_id =".$this->session->userdata['logged_in']['user_id']." and sp.status!='0' ORDER BY sp.sup_order_id DESC";
//echo $SUPPLIER_ASSIGNED_SQL;
$supplier_order_qry = $this->Site_model-> getcountRecods($SUPPLIER_ASSIGNED_SQL);


    $sl_count=1;
    foreach($supplier_order_qry as $sorders)
    {
        $ship_cityid = $sorders['shipping_city'];
        $ship_cityname = "";
        if(!empty($ship_cityid))
        {
            $get_city_info =$this->Site_model-> getRowData($prev.'cities',"city_id = '$ship_cityid'");
            $ship_cityname = $get_city_info[0]['city_name'];
        }

        $ship_stateid = $sorders['shipping_state_id'];
        $ship_statename = "";
        if(!empty($ship_stateid))
        {
            $get_state_info =$this->Site_model-> getRowData($prev.'states',"state_id = '$ship_stateid'");
            $ship_statename = $get_state_info[0]['state_name'];
        }
        $ship_countryid = $sorders['shipping_country_id'];
        $ship_countryname = "";
        if(!empty($ship_countryid))
        {
            $get_country_info =$this->Site_model->getRowData($prev.'countries',"country_id = '$ship_countryid'");
            $ship_countryname = $get_country_info[0]['country_name'];
        }
        $order_date = $sorders['date_added'];
        $supplier_order_number = $sorders['supplier_order_number'];

        $supplier_order_status = $sorders['status'];

        //----------------------------------------
        //p($sorders,1);
        $supplier_order_txtsts = "";
        $tracking_order_txtsts = '';
        $current_status_msg    = "";
        $SHOW_SUPPLIER_BUTTON  = "";

        $ORDER_BUYER_STATUS    = $sorders['buyer_status'];
        $ORDER_SUPPLIER_STATUS = $sorders['supplier_status'];
        $ORDER_COURIER_STATUS  = $sorders['courier_status'];

        $BSC_ord_trksts_arr = array($ORDER_BUYER_STATUS,$ORDER_SUPPLIER_STATUS,$ORDER_COURIER_STATUS);



        $BSC_ord_status_type1  = array('0','0','0');    // buyer quote to admin (B -> A)
        $BSC_ord_status_type2  = array('0','1','0');    // admin send  to  qoute supplier(A -> S)
        $BSC_ord_status_type3  = array('0','1','1');    // supplier send to order multi courier (S -> C)
        $BSC_ord_status_type4  = array('0','1','2');    // courier  quoted to supplier(C -> S)
        $BSC_ord_status_type5  = array('0','2','3');    // supplier accepted courier quote(S <-> C)
        $BSC_ord_status_type6  = array('0','3','3');    // supplier replied quote to admin (S -> A)
        $BSC_ord_status_type7  = array('1','3','3');    // admin send final quote to buyer(A -> B)
        $BSC_ord_status_type8  = array('2','3','3');    // buyer  accepted quote and paid to admin(B -> A)
        $BSC_ord_status_type9  = array('2','4','3');    // admin paid to supplier(A -> S)
        $BSC_ord_status_type10 = array('2','4','4');    // supplier paid to  courier (S -> C)
        $BSC_ord_status_type11 = array('3','4','4');    // Item Delivered to Buyer


        if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type2)) {

            $current_status_msg .="Fresh Quote";
            $SHOW_SUPPLIER_BUTTON ="SEND_COURIER_QUOTATION";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type3)){

            $current_status_msg .="Quotation Sent to Courier";
            $SHOW_SUPPLIER_BUTTON ="SEND_COURIER_QUOTATION";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type4)){

            $current_status_msg .="Courier Replied";
            $SHOW_SUPPLIER_BUTTON ="SEND_COURIER_QUOTATION";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type5)){

            $current_status_msg .="Courier Approved.<br> Send Quotation To Admin For Approval";
            $SHOW_SUPPLIER_BUTTON ="SEND_ADMIN_QUOTATION";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type6)){

            $current_status_msg .="Courier Approved.<br> Waiting for Admin Approval";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type7)){

            $current_status_msg .="Courier Approved.<br> Waiting for Buyer Approval";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type8)){

            $current_status_msg .="Courier Approved.<br> Buyer Approved.<br> Waiting for Payment";

        }else if(serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type9)){

            $current_status_msg .="Courier Approved.<br> Admin Paid.<br> Release Courier Payment .";
            $SHOW_SUPPLIER_BUTTON ="RELEASE_COURIER_PAYMENT";

        }
        else if( serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type10) )
        {

            $current_status_msg  .="Courier Paid.<br> Admin Paid.";
            $SHOW_SUPPLIER_BUTTON ="";

            $tracking_data    	    =$this->Site_model-> getRowData($prev.'order_tracking',"track_order_id = '$sorders[order_id]'");

            if($tracking_data){
                $BSC_t_s_array  = array($tracking_data[buyer_order_status],$tracking_data[supplier_order_status],$tracking_data[courier_order_status]);
            }
            else{
                $BSC_t_s_array  = array(0,0,0);
            }

            //==== TRACKING STATUS PATTERN
            $BSC_t_s_array1     = array('0','0','0');   // Payment Done by Supplier
            $BSC_t_s_array2     = array('0','1','0');   // Supplier confirmed (Item delivered to Courier)
            $BSC_t_s_array3     = array('0','1','1');   // Courier confirmed (Item received from Supplier)
            $BSC_t_s_array4     = array('0','1','2');   // Item on the way (Added Consignment number)
            $BSC_t_s_array5     = array('1','1','3');   // Buyer got the items
            $BSC_t_s_array6     = array('2','1','3');   // Buyer confirmed


            if( serialize($BSC_t_s_array) == serialize($BSC_t_s_array1) ){
                $tracking_order_txtsts	 = "Waiting for courier to pick up the items";
                $SHOW_SUPPLIER_BUTTON    ="COURIER_PAYMENT_DONE";
                $SHOW_TRACK_BUTTON       ='INSERT_COURIER_DETAILS';
            }
            elseif( serialize($BSC_t_s_array) == serialize($BSC_t_s_array2) ){
                $tracking_order_txtsts			= "Item delivered to Courier";
            }
            elseif( serialize($BSC_t_s_array) == serialize($BSC_t_s_array3) ){
                $tracking_order_txtsts			= "Courier confirmed (Item received from Supplier)";
            }
            elseif( serialize($BSC_t_s_array) == serialize($BSC_t_s_array4) ){
                $tracking_order_txtsts			= "Item on the way (Added Consignment number)";
            }
            elseif( serialize($BSC_t_s_array) == serialize($BSC_t_s_array5) ){
                $tracking_order_txtsts			= "Buyer got the items";
            }
            elseif( serialize($BSC_t_s_array) == serialize($BSC_t_s_array6) ){
                $tracking_order_txtsts			= "Buyer confirmed";
            }
            else{
                //===

            }



            $SHOW_SUPPLIER_BUTTON ="COURIER_PAYMENT_DONE";
            $check_order_trackdb_qu =$this->Site_model-> getcountRecods("SELECT * FROM ".$prev."order_tracking WHERE supplier_order_number ='$supplier_order_number'");
            //$check_order_trackdb_qu    = mysql_query($check_order_trackdb_sql);
            $check_order_trackdb_found = count($check_order_trackdb_qu);
            $track_supplier_ordr_sts ="";
            if($check_order_trackdb_found)
            {
                $check_order_trackdb_res =$check_order_trackdb_qu[0];
                $track_supplier_ordr_sts = $check_order_trackdb_res['supplier_order_status'];
                $order_tracking_number   = $check_order_trackdb_res['tracking_number'];
                // status will chnage depending on order tracking table
                if($track_supplier_ordr_sts == '0')
                {
                    //$supplier_order_txtsts .= "<br>( Waiting Courier to Pickup )";
                }
                else if($track_supplier_ordr_sts == '1')
                {
                    //$supplier_order_txtsts.= "<br><span style='color:green;'>( Order Dispatched To Courier.<br><span> Tracking Number:  ".$order_tracking_number." )</span>";
                }

            }


        }
        else if( serialize($BSC_ord_trksts_arr) == serialize($BSC_ord_status_type11)){
            $current_status_msg .="Item Delivered to Buyer.";
            $SHOW_SUPPLIER_BUTTON ="";

            $SHOW_SUPPLIER_BUTTON ="COURIER_PAYMENT_DONE";
            $check_order_trackdb_qu =$this->Site_model-> getcountRecods("SELECT * FROM ".$prev."order_tracking WHERE supplier_order_number ='$supplier_order_number'");
            //$check_order_trackdb_qu    = mysql_query($check_order_trackdb_sql);
            $check_order_trackdb_found = count($check_order_trackdb_qu);
            $track_supplier_ordr_sts ="";
            if($check_order_trackdb_found)
            {
                $check_order_trackdb_res = $check_order_trackdb_qu[0];
                $track_supplier_ordr_sts = $check_order_trackdb_res['supplier_order_status'];
                $order_tracking_number   = $check_order_trackdb_res['tracking_number'];
                // status will chnage depending on order tracking table
                if($track_supplier_ordr_sts == '0')
                {
                    //$supplier_order_txtsts .= "<br>( Waiting Courier to Pickup )";
                }
                else if($track_supplier_ordr_sts == '1')
                {
                    //$supplier_order_txtsts.= "<br><span style='color:green;'>( Order Dispatched To Courier.<br><span> Tracking Number:  ".$order_tracking_number." )</span>";
                }

            }

        }

        //------------------------------------------
        ?>

        <tr>
            <td valign="top" ><?php echo $sl_count;?></td>
            <td valign="top" ><?php echo $sorders['supplier_order_number'];?></td>
            <td valign="top" >
                <?php echo date('M d, Y', strtotime($sorders['assign_date']));?><br>
                <?php echo date('h:i A', strtotime($sorders['assign_date']));?>
            </td>
            <td><?php //echo $sorders['total'];?>
                <?php//=$_SESSION['currency_symbol'];?>
                <?php//=convertCurrency($_SESSION['from_currency'],$_SESSION['to_currency'],$sorders['total']);?>
            </td>

            <td valign="top" >
                <?php echo $ship_countryname;?> <br>
                [<?php echo $ship_statename;?>] <br>
                [<?php echo $ship_cityname;?>]
            </td>
            <!--     <td valign="top" style="text-align:center;">
      <?php //echo  $current_status_msg ;?>
      <hr>
      <?php //echo $tracking_order_txtsts;?>
    </td>-->
            <td valign="top" style="text-align:center;">
                <?php
                $ordData = $this->Site_model->getRowData($prev."order","order_id = ".$sorders['order_id']);
                //$supStatus = $ordData['supplier_status'];
                //$bStatus = $ordData['buyer_status'];
                $ordData=$ordData[0];
                $courierId = $ordData['for_courier_id'];

                $supOrdData =$this->Site_model-> getRowData($prev."order_supplier","supplier_id=".$this->session->userdata['logged_in']['user_id']." and order_id = ".$sorders['order_id']);
                $supOrdData= $supOrdData[0];
                $supStatus = $supOrdData['status'];
                $courStatus = $supOrdData['sup_courier_status'];
                $sup_order_id = $supOrdData['sup_order_id'];

                $courOrdData =$this->Site_model-> getRowData($prev."order_courier","courier_id=".$courierId." and order_id = ".$sorders['order_id']);
                $courOrdData=$courOrdData[0];
                $cour_order_id = $courOrdData['c_order_id'];

                if($supStatus == 1 ){
                    echo "<span> New Order Received</span><br>";
                    ?>
                    <form method="post" action="#" id="supplierStatus">
                        <select name="sup_status" class=''>
                            <option value=""> Select </option>
                            <option value="processing|<?php echo $sorders['order_id'];?>" > Order processing In progress </option>
                            <option value="dispatch|<?php echo $sorders['order_id'];?>"> Dispatch </option>
                        </select>
                        <input type="hidden" name="sup_order_id" value="<?php echo $sup_order_id;?>">
                        <input type="hidden" name="c_order_id" value="<?php echo $cour_order_id;?>">
                        <button type="button"  onclick="return postStatus()" >Go</button>
                    </form>
                <?php
                } if ($supStatus == 2 && $courStatus == 2) {
                    echo "<span>Order Processing in Progress</span><br>"; ?>
                    <form method="post" action="#" id="supplierStatus">
                        <select name="sup_status" class=''>
                            <option value=""> Select </option>
                            <option value="processing|<?php echo $sorders['order_id'];?>" > Order processing In progress </option>
                            <option value="dispatch|<?php echo $sorders['order_id'];?>"> Dispatch </option>
                        </select>
                        <input type="hidden" name="sup_order_id" value="<?php echo $sup_order_id;?>">
                        <input type="hidden" name="c_order_id" value="<?php echo $cour_order_id;?>">
                        <button type="button"  onclick="return postStatus()" >Go</button>
                    </form>
                <?php
                }
                else if ($supStatus == 3 && $courStatus == 3) {
                    echo "<span> Order Dispatched</span><br>";
                }
                else if ($supStatus == 3 && $courStatus == 4) {
                    echo "<span> Order On the way</span><br>";

                } else if ($supStatus == 3 && $courStatus == 5) {
                    echo "<span> Order Delivered</span><br>";
                }
                ?>

            </td>
            <td valign="top" >
                <a href="<?php echo base_url().'viewsupplier_quotation/'.$sorders['order_id'];?>" class="shrtbtn">View Order</a>


                <?php if($SHOW_SUPPLIER_BUTTON =="SEND_COURIER_QUOTATION"){ ?>

                    <a href="<?php echo base_url().'send_courier_quote.php?order_id='.$sorders['order_id'];?>" class="shrtbtn">Quote from Courier</a>

                <?php }else if($SHOW_SUPPLIER_BUTTON =="RELEASE_COURIER_PAYMENT"){ ?>

                    <a href="<?php echo base_url().'supplier_payto_courier.php?order_id='.$sorders['order_id'];?>" class="shrtbtn">Pay To Courier</a>
                <?php }else if($SHOW_SUPPLIER_BUTTON =="SEND_ADMIN_QUOTATION"){ ?>

                    <a href="<?php echo base_url().'send_courier_quote.php?order_id='.$sorders['order_id'];?>" class="shrtbtn">Quote Admin</a>

                    <!--
        <a href="<?php //echo base_url().'supplier_send_quote_to_admin.php?order_id='.$sorders['order_id'];?>" class="shrtbtn">Quote Admin</a>
      -->

                <?php }else if($SHOW_SUPPLIER_BUTTON =="COURIER_PAYMENT_DONE"){

                    $order_id = $sorders['order_id'];

                    if($SHOW_TRACK_BUTTON == 'INSERT_COURIER_DETAILS')
                    {
                        ?>
                        <button type="button" class="shrtheme shrtbtn " data-toggle="modal" data-target="#exampleModal" data-whatever="<?=$order_id;?>" data-whtsupordre="<?php echo $supplier_order_number;?>">Courier Details Insert</button>
                    <?php
                    }
                    else if($track_supplier_ordr_sts == '1' || $track_supplier_ordr_sts == '2')
                    {
                        ?>
                        <a href="javascript:void(0)" onclick="view_dispatch_details('<?=$supplier_order_number;?>')" data-toggle="modal" data-target="#view-track" class="shrtheme shrtbtn ">View Track Report</a>
                    <?php
                    }
                }
                ?>

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
<div id="view-track" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <form name="frm-modal" action="" method="post" onsubmit="return confirmmodsubmit();">
                <input type="hidden" name="order_id" id="sup_for_order_id" value="">
                <input type="hidden" name="for_supplier_order_number" id="for_supplier_order_number" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Courier Ref Number:</label>
                        <input type="text" class="form-control" id="courier_ref_num" name="courier_ref_num" required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Courier Picked by:</label>
                        <input type="text" class="form-control" id="courier_pickedby" name="courier_pickedby" required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Status Updated By:</label>
                        <input type="text" class="form-control" id="status_updated_by" name="status_updated_by" required="">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" id="sendnow_btn" data-nwmyoid="" name="supplier_update_courier" value="Send message" />
                </div>
            </form>

        </div>
    </div>
</div>


<script type="text/javascript">

    function postStatus(){

        var UrlRedirect="<?php echo base_url();?>processSupplierOrderStatus";
        var data = new FormData($('#supplierStatus')[0]);

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

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button    = $(event.relatedTarget);   // Button that triggered the modal
        var recipient = button.data('whatever');  // Extract info from data-* attributes
        var supordernum = button.data('whtsupordre');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('Order Number: ' + supordernum);
        $("#sup_for_order_id").val(recipient);
        $("#for_supplier_order_number").val(supordernum);
        //modal.find('.modal-body input[type=hidden]').val(recipient);
        //modal.find('.sendnow-btn button[type=button]').val(button.data(recipient));

    });

    function confirmmodsubmit()
    {
        var r = confirm("Do You want to Submit.\n You are Going To Confirm, Order Dispatched to Courier.");
        if(r){return true;}else{return false;}
    }

    function view_dispatch_details(idp)
    {
        var idp = idp;
        $.ajax({
            url:"<?='ajax.php'?>",
            type: 'POST',
            dataType: "json",
            data: {'supplier_idp': idp},
            success:function(data)
            {
                $('#view-track').html(data.item);
            }
        });
    }
</script>

<!--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<script type="text/javascript"  src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript"  src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
-->

<link rel="stylesheet" type="text/css" href="https://www.blazebay.com/assets/css/jquery-1.10.12.dataTables.min.css">
<script type="text/javascript"  src="https://www.blazebay.com/assets/js/jquery-1.10.12.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#example').DataTable({
            //"order": [[ 0, "desc" ]]
        });
    });
</script>
<!-- Modal ends -->

</body>
</html>
		