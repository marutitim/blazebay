<!DOCTYPE html>
<html lang="en-US">
<head>

    <link href="<?php echo base_url();?>assets2/css/core.css" rel="stylesheet" type="text/css" />
    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>
    <style>

        [type="radio"]:not(:checked), [type="radio"]:checked {
            position: relative !important;
            visibility: visible !important;
            left:0px !important;
        }
        .footer {
            position: static !important;;
        }
    </style>
</head>

<body>

<div id="main">

<!-- LEFT SIDEBAR -->
<div id="slide-out-left" class="side-nav">

    <!-- Form Search -->
    <div class="top-left-nav">
        <?php include(APPPATH.'/views/mobile/layout/search.php'); ?>
    </div>
    <!-- End Form Search -->

    <!-- App/Site Menu -->
    <div id="main-menu">
        <?php include(APPPATH.'/views/mobile/layout/nav.php'); ?>

    </div>




    <!-- End Site/App Menu -->

</div>
<!-- END LEFT SIDEBAR -->

<!-- RIGHT SIDEBAR -->
<div id="slide-out-right" class="side-nav">

    <?php include(APPPATH.'/views/mobile/layout/compare-blogs.php'); ?>

</div>
<!-- END RIGHT SIDEBAR -->

<!-- MAIN PAGE -->
<div id="page">

<!-- FIXED Top Navbar -->
<div class="top-navbar">
    <?php include(APPPATH.'/views/mobile/layout/top.php'); ?>
</div>
<!-- End FIXED Top Navbar -->


<!-- End Featured Slider -->


    <!-- CONTENT CONTAINER -->
    <div class="content-container">

        <h1 class="page-title">Order History</h1>

        <!-- Order history navigation -->
        <div class="order-history-nav">
            <select class="browser-default">
                <option value="">Last 15 days</option>
                <option value="">Last 30 days</option>
                <option value="">Last 6 month</option>
                <option value="">Order on 2016</option>
                <option value="" selected>Orders on 2018</option>
                <option value="">Order on 2017</option>
            </select>
        </div>
        <!-- End Order history navigation -->

        <!-- Order history listing (collapsible) -->
        <ul class="collapsible order-history" data-collapsible="accordion">
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

                $order_id=$sorders['order_id'];
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

                $id = $order_id;
                $order_pdetails = $this->Site_model->getRowData($prev.'order_product','order_id = '.$order_id);
                $proId=$order_pdetails[0]['product_id'];

                $Product_details = $this->Site_model->getRowData($prev.'products','id = '.$proId);

            ?>
            <li>
                <div class="collapsible-header">
                    <span class="indicator fa fa-caret-right"></span>
                    <div class="order-status">
                        Done <span class="fa fa-check"></span>
                    </div>
                    <div class="order-no">
                        <span class="block bold">Order # <a href="#"><?php echo $sorders['order_number'];?></a></span>
                        <span class="block text-small">Ordered at <?php echo date('M d, Y', strtotime($sorders['date_added']));?></span>
                    </div>
                </div>
                <div class="collapsible-body">
                    <ol>
                        <li>
                            <div class="thumb">
                                <img src="<?=base_url()."assets/uploadedimages/".$Product_details[0]['image']?>" alt="">
                            </div>
                            <div class="ctn">
                                <h3><?=$order_pdetails[0]['name']?></h3>
                                <span>Qty</span> <?=$order_pdetails[0]['quantity']?>
                                <p><a href="#" class="track-order">Track Order</a></p>
                            </div>
                        </li>

                    </ol>
                </div>
            </li>
            <?php
            }
            // For order tracking::
            $order_id = $sorders['order_id'];

            // $order_tracking_info =  getRowData($prev.'order_tracking','*',"buyer_order_number = '$buyer_order_number'");

            $where="buyer_order_number = '$buyer_order_number'";
            $order_tracking_info= $this->Site_model->getDataById("bt_order_tracking",$where);
            if (!empty($order_tracking_info)) {
                $order_tracking_info = $order_tracking_info[0];
                $common_tracking_number = $order_tracking_info['tracking_number'];
                $track_buyer_order_status = $order_tracking_info['buyer_order_status'];
                $track_courier_order_status = $order_tracking_info['courier_order_status'];
                $track_supplier_order_status = $order_tracking_info['supplier_order_status'];
                $track_courier_ordrnum = $order_tracking_info['courier_order_number'];
                $track_supplier_ordrnum = $order_tracking_info['supplier_order_number'];

                $BSC_trksts_arr = array($track_buyer_order_status, $track_supplier_order_status, $track_courier_order_status);

                $BSC_status_type1 = array('0', '0', '0'); // tracking not strated yet..
            }

            ?>
        </ul>
        <!-- End Order history listing -->

    </div>
    <!-- END CONTENT CONTAINER -->



<!-- FOOTER -->
<div class="footer">

    <!-- Footer main Section -->
    <?php include(APPPATH.'/views/mobile/layout/footer-bottom.php'); ?>
    <!-- End Copyright Section -->

</div>
<!-- End FOOTER -->

<!-- Back to top Link -->
<div id="to-top" class="main-bg"><i class="fa fa-long-arrow-up"></i></div>

</div>
<!-- END MAIN PAGE -->

</div><!-- #main -->

<?php include(APPPATH.'/views/mobile/layout/footer.php'); ?>


<script>
    function userLogin() {

        var username= $("#username").val();
        var password=$("#password").val();

        if(username==""){
            new Noty({
                type: 'error',
                timeout: 500,
                text     : 'Please enter your username or email',
                container: '.usernameerror'
            }).show();

        }
        else if(password==""){
            new Noty({
                type: 'error',
                timeout: 500,
                text     : 'Please enter your password',
                container: '.passworderr'
            }).show();

        }else{


            var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
            var RedirectUrl="<?php echo base_url().'login' ;?>";
            var userUrl="<?php echo base_url().'dashboard' ;?>";
            $.ajax({
                type: "POST",
                url: ctrlUrl,
                data:({
                    username: username,
                    password: password
                }),
                cache
                    :
                    false,
                success
                    :
                    function (data) {

                        //alert(data);
                        if (data ==10) {
                            new Noty({
                                type: 'warning',
                                timeout: 3000,
                                text     : 'Your account is not activated',
                                container: '.invalidLogin'
                            }).show();
                            //window.location.href=RedirectUrl;
                        }
                        else if (data==1||data==2||data==3||data==4){

                            new Noty({
                                type: 'info',
                                timeout:3000,
                                text     : 'Success',
                                container: '.invalidLogin'
                            }).show();

                            window.location=userUrl;
                        }
                        else{
                            new Noty({
                                type: 'error',
                                timeout: 30000,
                                text     : 'Oops!.Invalid Credentials',
                                container: '.invalidLogin'
                            }).show();

                            window.location.reload;
                        }
                    }
            });
        }
    }
    $(document).ready(function(){
        $('input[name="usertype"]').click(function() {
            if($('input[name="usertype"]:checked')) {
                if($(this).attr('value') == 1) {
                    $('#company-floorarea').hide();
                    $('#signup-fieldsnot-forcourier').hide();
                }else if($(this).attr('value') == 2) {
                    $('#company-floorarea').show();
                    $('#signup-fieldsnot-forcourier').show();

                }else if($(this).attr('value') == 4) {
                    $('#company-floorarea').show();
                    $('#signup-fieldsnot-forcourier').hide();

                }
            }
            //$("#company-floor-areaid").attr('style','display: block');
        });
    });
    function checkAvailability() {
        var base_url="<?php echo base_url();?>";
        $("#loaderIcon").show();
        jQuery.ajax({
            url: base_url+"checkusername_availability",
            data:'username='+$("#username").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }

    function checkEmailAvailability() {
        //$("#loaderIcon1").show();
        var base_url="<?php echo base_url();?>";
        jQuery.ajax({
            url: base_url+"checkEmailAvailability",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status1").html(data);
                //$("#loaderIcon1").hide();
            },
            error:function (){}
        });
    }
    function register(){



        var base_url="<?php echo base_url();?>";

        var data =$('#signup_form').serialize()
        $.ajax({
            url: base_url+"processsignup",
            data:data,
            type: "POST",
            success:function(response){
                var data=JSON.parse(response);
                var msg=data.msg;
                var code=data.code;

                if(code==1){

                    new Noty({
                        type: 'info',
                        timeout: 100000,
                        text     : msg,
                        container: '.register-msg'
                    }).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    setTimeout(function () {
                        location.href=base_url+"login";
                    }, 4000);
                }
                else if(code==2){
                    new Noty({
                        type: 'error',
                        timeout: 100000,
                        text     : msg,
                        container: '.register-msg'
                    }).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
                else{

                    new Noty({
                        type: 'error',
                        timeout: 100000,
                        text     : msg,
                        container: '.register-msg'
                    }).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
            },
            error:function (){}
        });

    }
</script>

</body>
</html>