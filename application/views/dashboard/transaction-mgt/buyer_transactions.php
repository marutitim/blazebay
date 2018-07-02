<?php
$pagename = "buyer_transaction_page";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

//===== Loggod User Details :: Starts =====
$logged_userid = "";
if(isset($this->session->userdata['logged_in']['user_id'])){
    $logged_userid = $this->session->userdata['logged_in']['user_id'];
}
//===== Loggod User Details :: Ends =====

//$logged_userid=(isset($_SESSION['user_id']))?($_SESSION['user_id']):("0");
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

                <div class="table-responsive scroll_hidden">
                    <table class="table table-hover table-striped" id="data-table">
                            <thead>
                        <tr>
                            <th width="">Sl</th>
                            <th>Transaction Id</th>
                            <th>Date</th>
                            <th>Order Number</th>
                            <th>Type</th>
                            <th>Payment Status</th>
                            <th class="im-text-right">Amount</th>
                            <th class="im-text-right">CR/DB</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //  $get_transaction_info = getTableData($prev.'payments',"*","order_user_id = '$logged_userid' ORDER BY payment_id DESC",TRUE);
                        $where="order_user_id = '$logged_userid' ORDER BY payment_id DESC";
                        $get_transaction_info= $this->Site_model->getDataById("bt_payments",$where);

                            foreach($get_transaction_info as $trans){
                                ?>
                                <tr>
                                    <td valign="top"><?=$trans['payment_id'];?></td>
                                    <!-- <td valign="top"><a href="view_details.php?id=<?=$trans['payment_id']; ?>"><?=$trans['payment_id'];?></a></td> -->
                                    <td valign="top"><a href="<?php echo base_url();?>buyertransactionsview_details.php?id=<?=$trans['payment_id']; ?>"> <?=$trans['txn_id'];?></a>
                                    </td>
                                    <td valign="top">
                                        <div><?=date('M d, Y',strtotime($trans['payment_date']));?></div>
                                        <div><?=date('h:i A',strtotime($trans['payment_date']));?></div>
                                    </td>
                                    <td valign="top"><?=$trans['order_number'];?></td>
                                    <td valign="top"><?=$trans['payment_for'];?></td>
                                    <td valign="top"><?=$trans['payment_status'];?></td>
                                    <td valign="top" class="im-text-right">
                                        <!-- <$trans['currency_code']$trans['payment_gross']; -->
                                        <?=$trans['currency_code']?><?=$trans['payment_gross']?>
                                    </td>
                                    <td valign="top" class="im-text-right"><?=$trans['order_trans_type'];?></td>

                                </tr>
                            <?php
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

</body>
</html>
