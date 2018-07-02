<?php
$pagename = "my_received_enquiries";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
//$flashmsg = new \Plasticbrain\FlashMessages\FlashMessages();

//===== get login user Details:: Starts =====
if(isset($this->session->userdata['logged_in']['user_id'])){

    $logged_user_id       = $this->session->userdata['logged_in']['user_id'];

    $logged_user_usertype = $this->session->userdata['logged_in']['usertype'];

    $logged_user_memtype  =$this->session->userdata['logged_in']['memtype'];

    $user_id = $logged_userid = $logged_user_id;

}
//===== get login user Details:: Ends =====

//======= Defines Table ========
$messagesTable = $prev . "messages";
$memberTable   = $prev . "members";
$enquiryTable  = $prev . "enquiry";
$orderTable    = $prev . "order";

//get my received enquiries.


$getEnquiries_received = $this->Site_model->get_enqreceived($logged_user_id );

$getEnquiries_sent     =$this->Site_model->get_enquiryData_sent($logged_user_id );
//p($getEnquiries_sent);
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
<div class="container2">
    <div class="col-md-12">
        <?php //$flashmsg->display(); ?>
        <div class="featuredpro">
            <h3 class="section-title"> <a href="JavaScript:void(0);" >Enquiries Sent</a></h3>

            <!--Container Section1 -->
            <div class="">
                <div id="amazingcarousel-container-1" >
                    <div class="">
                        <h5 class="" style="padding-left:10px; ">Sent Enquiries:</h5>
                        <?php
                        if ($getEnquiries_sent) { ?>

                            <form action="show_messages.php" method="post" name="form3" id="form3">
                                <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">

                                    <tr class="subtitle" >
                                        <td width="10" style="padding-left:10px;" ><b>Sl.</b>
                                            <!-- <input type="checkbox" name="check_all" value="yes" onClick="select_all();"> -->
                                        </td>
                                        <td style="width:200px"><b>Subject</b></td>
                                        <td style="width:180px"><b>To User</b></td>
                                        <td style="width:250px"><b>To Email</b></td>
                                        <td><b>Message</b></td>
                                    </tr>

                                    <?php
                                    $count=0;
                                    foreach ($getEnquiries_sent as $received) {
                                        $enquiry_id = $received['id'];
                                        $count++;
                                        ?>

                                        <tr class='mtr'>
                                            <td width="10" style="padding-left:10px;" ><?php echo $count;?>
                                                <!-- <div align="right">
                              <input name="checkbox<?php echo $enquiry_id;?>" id="checkbox<?php echo $enquiry_id;?>" type="checkbox" id="checkbox<?php echo $enquiry_id;?>" value="<?php echo $enquiry_id;?>" >
                              <input type="hidden" name="spam1" id="spam1"/>
                            </div> -->
                                            </td>

                                            <td valign="top" ><?php echo $received['subject'];?></td>
                                            <td valign="top" >
                                                <?php
                                                if(!empty($received['member_id'])){
                                                    echo $received['member_firstname'].' '.$received['member_lastname'];
                                                }else{
                                                    echo "Unknown";
                                                }
                                                ?>
                                            </td>
                                            <td valign="top"><?php echo $received['email'];?></td>
                                            <td valign="top"><?php echo $received['message'];?></td>
                                        </tr>

                                    <?php } ?>

                                </table>
                            </form>

                        <?php } else { ?>

                            <div class="alert alert-danger alert-dismissable" style="text-align:center;" > No Sent Message. </div>

                        <?php } ?>
                    </div>
                </div>

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
