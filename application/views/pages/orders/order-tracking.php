<?php
$prev="bt_";

if (!empty($tracking_number)) {



    $tracking_number = trim($tracking_number);


    $order_details = $this->Site_model->getRowData($prev . 'order', 'order_number = "' . $tracking_number . '"');
    $order_details=$order_details[0];


    $buyer_order_date = $order_details['date_added'];

    $buyer_order_date = date("jS F, Y", strtotime($buyer_order_date));



//    $approx_ship_date			= $tracking_details['consignment_date'];

//    $approx_ship_date			= date("jS F, Y", strtotime($approx_ship_date));



    $ship_phone = $order_details['shipping_phone'];

    if ($ship_phone == "") {

        $ship_phone = "N/A";

    }



    // Courier Company Details::

    $qry = " SELECT oc.courier_order_number,mb.company_name,mb.address1,mb.company_logo, mb.about , mb.phone, mb.website  FROM
	".$prev."order_courier as oc   JOIN " .$prev ."business as mb  ON oc.courier_id  = mb.user_id  JOIN " . $prev . "order odr ON oc.order_id  = odr.order_id WHERE
	odr.order_number  = '$tracking_number'";
    $courier_details =$this->Site_model->execute($qry);


    $courier_details=$courier_details[0];

    // Company Profile picture

    $company_logoimg =base_url() . 'assets/uploadedimages/';

    if (!empty($courier_details['company_logo'])) {



        $company_logoimg_vpath = $company_logoimg . $courier_details['company_logo'];

        $company_logoimg_apath = 'assets/uploadedimages/'. $courier_details['company_logo'];

        if (!file_exists($company_logoimg_apath)) {

            $company_logoimg_vpath = base_url(). "assets/images/nopic.jpg";

        }

    } else {

        $company_logoimg_vpath =base_url()."assets/images/nopic.jpg";

    }



    // Currency

    $cur =$this->Site_model->execute("select * from " . $prev . "currencies where sbcur_status= '1'");
    $cur=$cur[0];
    $currency_symbol = $cur['sbcur_symbol'];

}



?><!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <?php include(APPPATH.'/views/layout/mainheader.php'); ?>
        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <?php include(APPPATH.'/views/layout/menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="body-content">
        <div class="container">
            <div class="track-order-page">
                <div class="row">
                    <?php  if(empty($tracking_number)){?>
                    <div class="col-md-12">
                        <h2 class="heading-title">Track your Order</h2>
                        <span class="title-tag inner-top-ss">Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the confirmation email you should have received. </span>
                        <form class="register-form outer-top-xs" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleOrderId1">Order ID</label>
                                <input type="text" class="form-control unicase-form-control text-input" id="exampleOrderId1" >
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleBillingEmail1">Billing Email</label>
                                <input type="email" class="form-control unicase-form-control text-input" id="exampleBillingEmail1" >
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Track</button>
                        </form>
                    </div>
                <?php } else {?>

                        <div class="col-md-10">

                        <div class="featuredpro">

                        <h2><i aria-hidden="true" class="fa"></i> Order Details</h2>

                        <div class="">

                        <div class="order-details-section">

                            <div class="col-md-6" style="padding-left:0px;">

                                <div class="border-right">

                                    <p>

                                        <i class="fa fa-truck" aria-hidden="true"></i> Tracking ID:  <?php echo $tracking_number; ?>

                                    </p>

                                    <p>

                                        <i class="fa fa-calendar-o" aria-hidden="true"></i> Order Date:  <?php echo $buyer_order_date; ?>

                                    </p>

                                    <p>

                                        <i class="fa fa-money" aria-hidden="true"></i> Amount Paid:

                                        <span><i class="fa fa-check" aria-hidden="true"></i><?php echo 'KSH.'.' '; ?><?php echo $order_details['total'] ?> </span>

                                    </p>







                                </div>

                            </div>

                            <div class="col-md-6">

                                <h3>

                                    <?php echo $order_details['shipping_firstname'] . ' ' . $order_details['shipping_lastname']; ?>

                                </h3>

                                <p>

                                    <i class="fa fa-phone" aria-hidden="true"></i> :  <?php echo $ship_phone; ?>

                                </p>

                                <p>

                                    <i class="fa fa-map-marker" aria-hidden="true"></i> :  <?php echo $order_details['shipping_address_1']; ?>,

                                    <?php echo $order_details['shipping_city']; ?>,
                                    <?php echo $order_details['shipping_country']; ?>

                                </p>



                            </div>



                        </div>





                        <div class="clear"></div>







                        <div class="clear"></div>



                        <div class="col-md-12" style="padding-left:0px; padding-top:25px;">

                            <h3>COURIER COMPANY DETAILS</h3>



                            <div class="row">

                                <div class="col-md-2">

                                    <img src="<?= $company_logoimg_vpath; ?>" alt="<?= $courier_details['company_name']; ?>" height="100">

                                </div>

                                <div class="col-md-10" style="padding-left:0px;">

                                    <p><b><?= $courier_details['company_name']; ?></b></p>

                                    <p>&nbsp;</p>

                                    <p>Address : <?= $courier_details['address1']; ?></p>

                                    <p>Phone : <?= $courier_details['phone']; ?></p>

                                    <p>Website : <?= $courier_details['website']; ?></p>

                                </div>

                            </div>

                        </div>



                        <div class="col-md-12" style="padding-left:0px; padding-top:25px;">

                        <h3>Tracking Status</h3>



                        <?php

                        $order_id = $order_details['order_id'];



                        $supOrdAllData = $this->Site_model->getRowData($prev . "order_supplier", "order_id = " . $order_id);

                        foreach ($supOrdAllData as $supOrdData) {

                        $supData =$this->Site_model->getRowData($prev . "business",  "user_id = " . $supOrdData['supplier_id']);
                        $supData= $supData[0];
                        ?>



                        <b><?php echo $supData['company_name']; ?></b>

                        <?php

                        $ordProdAllData =$this->Site_model->getRowData($prev . "order_product",  "order_id = " . $order_id . " AND supplier_id = " . $supOrdData['supplier_id']);

                        foreach ($ordProdAllData as $prodData) {

                            ?>

                            <p>----<?php echo $prodData['name']; ?></p>

                        <?php } ?>

                        <div class="row" style="font-size:18px; text-align:center;">

                        <?php if ($supOrdData['status'] == 1 && $supOrdData['sup_courier_status'] == 1) { ?>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Approved, Payment Done</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order Process</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Dispatched</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order On The Way</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <!--<i class="fa fa-long-arrow-right" aria-hidden="true"></i>-->

                                    <p>Delivered</p>

                                </div>

                            </div>

                        <?php } if ($supOrdData['status'] == 2 && $supOrdData['sup_courier_status'] == 2) { ?>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Approved, Payment Done</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order Processing</p>

                                </div>

                            </div>

                            <div class="col-md-2">



                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order On The Way</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <!--<i class="fa fa-long-arrow-right" aria-hidden="true"></i>-->

                                    <p>Delivered</p>

                                </div>

                            </div>

                        <?php }  if ($supOrdData['status'] == 3 && $supOrdData['sup_courier_status'] == 3) { ?>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Approved, Payment Done</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order Processing</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Dispatched</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order On The Way</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-circle-o" aria-hidden="true"></i>

                                    <!--<i class="fa fa-long-arrow-right" aria-hidden="true"></i>-->

                                    <p>Delivered</p>

                                </div>

                            </div>

                        <?php } if ($supOrdData['status'] == 3  && $supOrdData['sup_courier_status'] == 4) { ?>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Approved, Payment Done</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order Process</p>

                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Dispatched</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order On The Way</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="NotDoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <!--<i class="fa fa-long-arrow-right" aria-hidden="true"></i>-->

                                    <p>Delivered</p>

                                </div>

                            </div>

                        <?php }  if ($supOrdData['status'] == 3  && $supOrdData['sup_courier_status'] == 5) { ?>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Approved, Payment Done</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order Process</p>

                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Dispatched</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    <p>Order On The Way</p>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="DoneTRACK">

                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                    <!--<i class="fa fa-long-arrow-right" aria-hidden="true"></i>-->

                                    <p>Delivered</p>

                                </div>

                            </div>

                        <?php }

                        echo "</div><br>";



                        } ?>







                        </div>

                        </div>

                        </div>





                        </div>





                        </div>



                        <style>

                            .DoneTRACK{

                                color: #2f9e03 !important;

                                font-size:35px;

                                text-align:center;

                            }

                            div.DoneTRACK p{

                                font-size:18px;

                                color: #2f9e03 !important;

                            }



                            .NotDoneTRACK{

                                color:#afb0ae !important;

                                font-size:35px;

                                text-align:center;

                            }

                            div.NotDoneTRACK p{

                                font-size:18px;

                                color: #afb0ae !important;

                            }

                        </style>

                    <?php } ?>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->

             </div><!-- /.body-content -->

    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">


        <?php include(APPPATH.'/views/layout/footerbottom.php'); ?>
        <?php include(APPPATH.'/views/layout/copyright.php'); ?>

    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->


    <!-- For demo purposes – can be removed on production -->


    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <?php include(APPPATH.'/views/layout/footer.php'); ?>


    <script>
        $(document).ready(function(){
            $(".changecolor").switchstylesheet( { seperator:"color"} );
            $('.show-theme-options').click(function(){
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function() {
            $('.show-theme-options').delay(2000).trigger('click');
        });
    </script>


</body>
</html>