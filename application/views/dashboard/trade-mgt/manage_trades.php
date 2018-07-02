<?php

if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

// Update Payment Details:
if(isset($_POST['update_payment'])){

    $uid = $_POST['userid'];
    $paypal_email = $_POST['paypal_email'];

    $payarr = array(
        'payment_paypal_email' => $paypal_email,
        'payment_paypal_status'=>1,
    );
    $updt_payment = update_table_data($prev.'members',$payarr, "user_id = '$uid'" );
    if($updt_payment == "DONE"){
        $flashmsg->success("Payment Details Updated successfully");
    }else{
        $flashmsg->success("Payment Details Failed To Update");
    }
    header('location:'.base_url().'edit-profile/');
    die();}?>

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
<div class="container">
    <div class="col-md-10">
        <div class="featuredpro">
            <h3 class="section-title"> <a href="javascript:void(0);" > Manage Trade Show </a></h3>
            <?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="manage-trades"> My Trades </a> <!-- <span class="pull-right">Feedback Form</span>--></h2><?php */?>
            <div class="trades">
                <div class="clearfix"></div>
                <?php
                $prev="bt_";
                $sql = "select count(tradeshow_id) as tradeshow from ".$prev."tradeshow where user_id='".$this->session->userdata['logged_in']['user_id']."' and approved='Y' " ;

                $row= $this->Site_model->getcountRecods($sql);
                $rows = $row[0]['tradeshow'];

                // This is the number of results we want displayed per page
                $page_rows = 5;
                // This tells us the page number of our last page

                $last = ceil($rows/$page_rows);

                // This makes sure $last cannot be less than 1
                if($last < 1){
                    $last = 1;
                }
                // Establish the $pagenum variable
                $pagenum = 1;
                // Get pagenum from URL vars if it is present, else it is = 1
                if(isset($_GET['pn'])){
                    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                }
                // This makes sure the page number isn't below 1, or more than our $last page
                if ($pagenum < 1) {
                    $pagenum = 1;
                } else if ($pagenum > $last) {
                    $pagenum = $last;
                }
                // This sets the range of rows to query for the chosen $pagenum
                $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
                $textline1 = "Trades (<b>$rows</b>)";
                $textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
                // Establish the $paginationCtrls variable
                $paginationCtrls = '';

                ?>
                <!--h2 style="font-size:20px;"><?php echo $textline1; ?> Paged</h2-->

                <?php
                $sql ="select * from ".$prev."tradeshow where user_id='".$this->session->userdata['logged_in']['user_id']."' and approved='Y'  $limit ";

                $n= $this->Site_model->getcountRecods($sql);

                //$fairq = mysql_query("select * from ".$prev."tradeshow where user_id='".$_SESSION['user_id']."'  $limit ");

                //$n = mysql_num_rows($fairq);

                // If there is more than 1 page worth of results
                if($last != 1){
                    /* First we check if we are on page one. If we are then we don't need a link to
                       the previous page or the first page so we do nothing. If we aren't then we
                       generate links to the first page, and to the previous page. */
                    if ($pagenum > 1) {
                        $previous = $pagenum - 1;
                        $paginationCtrls .= '<a href="'.base_url().'manage-trades/'.$previous.'">Previous</a> &nbsp; &nbsp; ';
                        // Render clickable number links that should appear on the left of the target page number
                        for($i = $pagenum-4; $i < $pagenum; $i++){
                            if($i > 0){
                                $paginationCtrls .= '<a href="'.base_url().'manage-trades/'.$i.'">'.$i.'</a> &nbsp; ';
                            }
                        }
                    }
                    // Render the target page number, but without it being a link
                    $paginationCtrls .= ''.$pagenum.' &nbsp; ';
                    // Render clickable number links that should appear on the right of the target page number
                    for($i = $pagenum+1; $i <= $last; $i++){
                        $paginationCtrls .= '<a href="'.base_url().'manage-trades/'.$i.'">'.$i.'</a> &nbsp; ';
                        if($i >= $pagenum+4){
                            break;
                        }
                    }
                    // This does the same as above, only checking if we are on the last page, and then generating the "Next"
                    if ($pagenum != $last) {
                        $next = $pagenum + 1;
                        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.base_url().'manage-trades/'.$next.'">Next</a> ';
                    }
                }
                $list = '';
                if($n>0){
                    foreach($n as $key=>$fetfair){

                        $tradename =  RemoveBadURLChars($fetfair['tradeshow_name']);
                        ?>
                        <div class="tradebox">
                            <div class="trade_img" style="width: 24%"> <a href="<?php echo base_url();?>trade-details/<?php echo $tradename.'/'.$fetfair['tradeshow_id']?>">
                                    <?php if($fetfair['tradeshow_img']){
                                        $file = $fetfair['tradeshow_img'];
                                        $path= 'trade/';
                                        $image_thumb=base_url().'assets/'.$path.$file;
                                        ?>
                                        <img width="60" height="60" src="<?php echo $image_thumb;?>">
                                    <?php } else { ?>
                                        <img alt="" src="<?php echo base_url();?>assets/images/nopic.jpg" height="60" width="60" >
                                    <?php } ?>
                                </a> </div>
                            <div class="tradetext">
                                <h2><a href="<?php echo base_url();?>trade-details/<?php echo $tradename.'/'.$fetfair['tradeshow_id']?>"><?php echo ucwords($fetfair['tradeshow_name']);?></a></h2>

                                <div class="clearfix"></div>
                                <h4>Description:</h4>
                                <p><?php echo html_entity_decode($fetfair['description'])?></p>
                                <div class="clearfix"></div>
                                <h4>Venue: <span> <?php echo ucwords($fetfair['tradeshow_venue']);?> </span> </h4>
                                <div class="clearfix"></div>
                                <h4>Date: <span> <?php echo date('d-M-Y',strtotime($fetfair["tradeshow_date"]));?> </span></h4>
                                <div class="clearfix"></div>
                                <br>
                                <p>
                                    <a class="click-button" href="<?php echo base_url();?>trade-details/<?php echo $tradename.'/'.$fetfair['tradeshow_id']?>">Click here to view details</a>
                                    <a class="btn center btn-info btn-sm btn3d pull-right" href="<?php echo base_url();?>add-tradeshow/<?php echo $fetfair['tradeshow_id']; ?>">Edit</a>
                                <div class="clearfix"></div>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    <div>
                        <?php
                        if($rows > 5) {
                            ?>
                            <!--p><?php echo $textline2; ?></p-->
                            <p><?php echo $list; ?></p>
                            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
                        <?php } else { } ?>
                    </div>
                <?php } else {?>
                    <div class="alert alert-danger"> Sorry, You don't have any Trade show.</div>
                <?php } ?>

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
		