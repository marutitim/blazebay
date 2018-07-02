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
        .select-wrapper input.select-dropdown {
            position: relative;
            cursor: pointer;
            background-color: transparent;
            border: none;
             border-bottom: 0px solid #ffffff;
            outline: none;
            height: 3rem;
            line-height: 3rem;
            width: 100%;
            font-size: 1rem;
            margin: 0 0 15px 0;
            padding: 0;
            display: block;
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

<h1 class="page-title"><?=$name?></h1>
<div class="featuredpro">

<?php //$flashmsg->display();?>

<?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="edit-profile"> Edit Personal Profile </a> </h2><?php */?>

<?php
// FOR COURIER UPLOAD CODE
if (isset($_POST['upload']) && $_POST['upload'] == "Upload") {  //IF SOME FORM WAS POSTED DO VALIDATION
    $COURIER_DOC_ID = $_POST['user_doc_id1'];
    $COURIER_DOC_TITLE = $_POST['user_doc_title1'];
    if ($_FILES["user_doc_upload1"]["name"] != '') {
        $COURIER_UPLD_DOC = $_FILES["user_doc_upload1"]["name"];
    } else {
        $COURIER_UPLD_DOC = '';
    }
    if ($COURIER_UPLD_DOC != "") {
        $UPLD_allowed_ext = array("jpg", "jpeg", "png", "gif");

        $UPLD_extension = explode('.', $COURIER_UPLD_DOC);

        $ext = strtolower(end($UPLD_extension));

        if (in_array($ext, $UPLD_allowed_ext)) {
            $docsnewname = time() . "." . $ext;
            $loc = "uploadedcourier_documents/" . $docsnewname;
            move_uploaded_file($_FILES["user_doc_upload1"]["tmp_name"], $loc);

            if ($COURIER_DOC_ID != "") {
                $courier_sql_bn = "UPDATE " . $prev . "courier_details SET doc_title='" . $COURIER_DOC_TITLE . "' ,courier_id='" . $_SESSION['user_id'] . "' ,doc_path='" . $docsnewname . "' WHERE details_id='" . $COURIER_DOC_ID . "'";

                mysql_query($courier_sql_bn);
            } else {
                $courier_sql_bn = "INSERT INTO " . $prev . "courier_details (doc_title ,courier_id,doc_path) VALUES('" . $COURIER_DOC_TITLE . "','" . $_SESSION['user_id'] . "','" . $docsnewname . "')";

                mysql_query($courier_sql_bn);
            }
        }
    }
}
// COURIER DOC UPLOAD :: ENDS HERE

$errcnt = 0;

//if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
if (count($_POST) > 0 && isset($_POST['submit']) && $_POST['submit'] == "Update") {  //IF SOME FORM WAS POSTED DO VALIDATION
    $firstname = str_replace("$", "\$", $_REQUEST["firstname"]);
    $lastname = str_replace("$", "\$", $_REQUEST["lastname"]);
    $street = str_replace("$", "\$", $_REQUEST["street"]);
    $city = str_replace("$", "\$", $_REQUEST["city"]);
    $phone = str_replace("$", "\$", $_REQUEST["phone"]);
    $fax = str_replace("$", "\$", $_REQUEST["fax"]);
    $mobile = str_replace("$", "\$", $_REQUEST["mobile"]);
    $email = str_replace("$", "\$", $_REQUEST["email"]);
    $zip_code = str_replace("$", "\$", $_REQUEST["zip_code"]);
    $address = str_replace("$", "\$", $_REQUEST["address"]);

    $state = str_replace("$", "\$", $_REQUEST["state"]);
    $country = str_replace("$", "\$", $_REQUEST["country"]);

    /*                         * ****************FOR Courier********************** */
    if ($_SESSION['usertype'] == '4') {
        $owner_name = str_replace("$", "\$", $_REQUEST["owner_name"]);
        $op_area = implode(",", $_REQUEST['oper_area']);
    } else {
        $owner_name = '';
        $op_area = '';
    }
    /*                         * ****************FOR Courier********************** */

    $phone_no = "";
    if (strlen(trim($phone)) <> 0) {
        $phone_no .= $phone;
    }

    $fax_no = "";
    if (strlen(trim($fax)) <> 0) {
        $fax_no .= $fax;
    }
    $fax_no .= "-";


    if (strlen(trim($firstname)) == 0) {
        $errs[$errcnt] = "Firstname must be provided";
        $errcnt++;
    } elseif (preg_match("/[;<>&]/", $_REQUEST["firstname"])) {
        $errs[$errcnt] = "Firstname can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if (strlen(trim($lastname)) == 0) {
        $errs[$errcnt] = "Lastname must be provided";
        $errcnt++;
    } elseif (preg_match("/[;<>&]/", $_REQUEST["lastname"])) {
        $errs[$errcnt] = "Lastname can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if (strlen(trim($street)) == 0) {
        $errs[$errcnt] = "Street must be provided";
        $errcnt++;
    } elseif (preg_match("/[;<>&]/", $_REQUEST["street"])) {
        $errs[$errcnt] = "Street can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if (strlen(trim($city)) == 0) {
        $errs[$errcnt] = "City must be provided";
        $errcnt++;
    } elseif (preg_match("/[;<>&]/", $_REQUEST["city"])) {
        $errs[$errcnt] = "City can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if (strlen(trim($zip_code)) == 0) {
        $errs[$errcnt] = "Zip/Postal Code must be provided";
        $errcnt++;
    } elseif (preg_match("/[;<>&]/", $_REQUEST["zip_code"])) {
        $errs[$errcnt] = "Zip/Postal Code can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }


    if (preg_match("/[;<>&]/", $phone_no)) {
        $errs[$errcnt] = "Phone No. can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if (preg_match("/[;<>&]/", $fax_no)) {
        $errs[$errcnt] = "Fax can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if (preg_match("/[;<>&]/", $mobile)) {
        $errs[$errcnt] = "Mobile can not have any special character (e.g. & ; < >)";
        $errcnt++;
    }

    if ($errcnt == 0) {
        $suspended = "no";
        $config = mysql_fetch_array(mysql_query("select * from " . $prev . "config"));

        if ($config["mem_approval"] == "admin") {
            $suspended = "no";
        }

        $query_update = "update `" . $prev . "members` set
                            firstname='$firstname' ,
                            lastname='$lastname' ,
                            street='$street' ,
                            city='$city' ,
                            state='$state' ,
                            country='$country' ,
                            zip='$zip_code' ,
                            phone='$phone_no',
                            fax='$fax_no' ,
                            email='$email',
                            mobile='$mobile',
                            owner_name='$owner_name',
                            oper_area = '$op_area',
                            address='$address'
                            where user_id=" . $_SESSION['user_id'];

        if ($_FILES["user_img"]["name"] != '') {
            $userimg = $_FILES["user_img"]["name"];
        } else {
            $userimg = '';
        }

        $rs_update = mysql_query($query_update);

        if ($rs_update) {
            if ($userimg != "") {
                $allowed_ext = array("jpg", "jpeg", "png", "gif");

                $extension = explode('.', $userimg);

                $ext = strtolower(end($extension));

                if (in_array($ext, $allowed_ext)) {

                    $newname = time() . "." . $ext;
                    $loc = "uploadedimages/" . $newname;
                    move_uploaded_file($_FILES["user_img"]["tmp_name"], $loc);
                    $sql_bn = "UPDATE " . $prev . "members SET user_img='" . $newname . "' WHERE user_id='" . $_SESSION['user_id'] . "'";
                    mysql_query($sql_bn);
                }
            }


            $msg = "Records has been updated successfully";
        }
    }
}

//$mem = mysql_fetch_array(mysql_query("select * from " . $prev . "members where user_id=" . $_SESSION['user_id']));
$where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
$memD= $this->Site_model->getDataById( 'bt_members', $where );

//print_r($memD);
//IF SOME FORM WAS POSTED DO VALIDATION
if (!empty($memD)){
    $mem=$memD[0];
    $firstname = $mem["firstname"];
    $lastname = $mem["lastname"];
    $street = $mem["street"];
    $city = $mem["city"];
    $state = $mem["state"];
    $country = $mem["country"];
    $zip_code = $mem["zip"];
    $usertype = $mem["usertype"];
    $user_img = $mem["user_img"];
    /*                         * ************FOR COURIER********************* */
    if ($this->session->userdata['logged_in']['usertype'] == '4') {
        $owner_name = $mem["owner_name"];
        $oper_area1 = explode(',', $mem['oper_area']);
    } else {
        $owner_name = '';
        $oper_area1 = '';
    }
    /*                         * ************FOR COURIER********************* */
    $address = $mem["address"];

    $phone = "";
    $phone_arr = explode("-", $mem["phone"]);
//if(count
    if (!empty($phone_arr[0])) {
        $phone = $phone_arr[0];
    }
    if (!empty($phone_arr[1])) {
        $phone1 = $phone_arr[1];
    }
    if (!empty($phone_arr[2])) {
        $phone2 = $phone_arr[2];
    }

    $fax_arr = explode("-", $mem["fax"]);
    if (!empty($fax_arr[0])) {
        $fax = $fax_arr[0];
    }
    if (!empty($fax_arr[1])) {
        $fax1 = $fax_arr[1];
    }
    if (!empty($fax_arr[2])) {
        $fax2 = $fax_arr[2];
    }
    $mobile = $mem["mobile"];
    $email = $mem["email"];
    $other_state = $mem["state"];
} else {
    echo "<p>&nbsp;</p><p>&nbsp;</p><br><br><br><div align='center'><font class='normal'>Member Not Found. Click <a href='index.php' >here</a> to continue</font></div><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
    return;
}
if (count($_POST) > 0) {

    if ($errcnt <> 0) {
        ?>


        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
            <tr>
                <td colspan="2"><strong>&nbsp;Your Request cannot be processed due
                        to following Reasons </td>
            </tr>
            <tr height="10">
                <td colspan="2"></td>
            </tr>
            <?php
            for ($i = 0; $i < $errcnt; $i++) {
                ?>
                <tr valign="top">
                    <td width="6%">&nbsp;<?php echo $i + 1; ?></td>
                    <td width="94%"><?php echo $errs[$i]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>


    <?php
    }
}
?>

<?php if (!empty($msg) && $msg != '') { ?>
    <div class="alert alert-success"><i class="fa fa-check"></i><?php echo $msg; ?><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a></div>
<?php } ?>

<div id="msgReplies"></div>
<form name="form1" method="post" action="#" id="updateProfile" enctype="multipart/form-data">

<div class="row edit-margin">

    <div class="form-group ">
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">First Name : <font color="#FF0000">*</font> </label>
            <input name="firstname" class="form-control" type="text"  value="<?php echo $firstname; ?>" size="30" maxlength="30">
        </div>

        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Last Name : <font color="#FF0000">*</font> </label>
            <input name="lastname" type="text" class="form-control"  value="<?php echo $lastname; ?>" size="30" maxlength="30">
        </div>

        <input name="owner_name" type="hidden" class="form-control"  value="<?php echo $firstname; ?>" size="30" maxlength="30">

    </div>
</div>



<div class="row edit-margin">

    <div class="form-group ">
        <?php if ($this->session->userdata['logged_in']['usertype'] == '4') { ?>
            <div class="col-sm-6 col-xs-12">
                <label class="control-label" for="recipient-name">Owner Name : <font color="#FF0000">*</font> </label>
                <input name="owner_name" class="form-control" type="text"  value="<?php echo $owner_name; ?>" size="30" maxlength="30">
            </div>

        <?php } ?>


        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Street : <font color="#FF0000">*</font> </label>
            <input type="text" class="form-control"  size="30" maxlength="30" name="street" value="<?php echo $street; ?>" >
        </div>




    </div>
</div>
<!---->
<div class="row edit-margin">
    <div class="form-group ">
        <div class="col-sm-6 col-xs-12">

            <label class="control-label" for="recipient-name">Country : <font color="#FF0000">*</font> </label>
            <div >
                <?php
                //
                $qry="SELECT country_id,country_name FROM bt_countries WHERE country_id>0 ORDER BY country_name ASC";
                $countryDropdown= $this->Site_model->getcountryDropdown($qry );

                if ($countryDropdown) {
                    if (isset ( $_POST ["country"] )) {
                        $select = $_POST ["country"];
                    } else {
                        $select = "";
                    }
                    $js = 'class="form-control" id="country" name="country" ';
                    echo form_dropdown ( 'country', $countryDropdown, $select, $js );
                }
                ?>
            </div>

            <?php


            //echo get_data_dropdown($prev . 'countries', 'country_id', 'country_name', '', $country, 'country', 'country', 'required', '', '', '')
            ?>
        </div>

        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">State : <font color="#FF0000">*</font> </label>
            <div id="state_list">
                <?php
                //echo get_data_dropdown($prev . 'states', 'state_id', 'state_name', '', $state, 'state', 'state', 'required', '', '', '');

                $qry="SELECT state_id,state_name FROM bt_states";
                $stateDropdown= $this->Site_model->getstatesDropdown($qry );

                //print_r($stateDropdown);
                if ($stateDropdown) {
                    if (isset ( $_POST ["state"] )) {
                        $selectstate = $_POST ["state"];
                    } else {
                        $selectstate = "";
                    }
                    $js = 'class="form-control" id="state" name="state" ';
                    echo form_dropdown ( 'state', $stateDropdown, $selectstate, $js );
                }
                ?>
                <span name="no_user_state" id="no_user_state" required="" class="form-control padding_none hide"></span>
            </div>
        </div>

    </div>
</div>
<!---->
<div class="row edit-margin">
    <div class="form-group ">
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">City : <font color="#FF0000">*</font> </label>
            <!--
                                    <input type="text" class="form-control"  size="30" maxlength="30" name="city"  value="<?php echo $city; ?>" >
                                -->

            <?php
            //echo get_data_dropdown($prev . 'cities', 'city_id', 'city_name', '', $city, 'city', 'city', 'required', '', '', '')
            $qry="SELECT city_id,city_name FROM bt_cities";
            $cityDropdown= $this->Site_model->getcityDropdown($qry );

            //print_r($stateDropdown);
            if ($cityDropdown) {
                if (isset ( $_POST ["state"] )) {
                    $selectcity = $_POST ["state"];
                } else {
                    $selectcity = "";
                }
                $js = 'class="form-control" id="state" name="city" ';
                echo form_dropdown ( 'state', $cityDropdown, $selectcity, $js );
            }
            ?>
        </div>

        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Zip/Postal Code : <font color="#FF0000">*</font> </label>
            <input name="zip_code" class="form-control" type="text"  id="zip_code"  value="<?php echo $zip_code; ?>" size="30" maxlength="30" >
        </div>

    </div>
</div>

<div class="row edit-margin">
    <div class="form-group">
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Email : <font color="#FF0000">*</font> </label>
            <input type="text" class="form-control" name="email"  size="30"  required=""   value="<?php echo $email; ?>" >
        </div>
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Phone : <font color="#FF0000">*</font> </label>
            <input name="phone-no" class="form-control" type="text"  id="phone"  value="<?php echo $phone; ?>" size="" maxlength="" >

        </div>
    </div>
</div>

<div class="row edit-margin">
    <div class="form-group">
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Fax :
                <!--
                <label class="control-label" for="recipient-name">Country Code </label> -->
                <input name="fax" class="form-control" type="text"  id="fax"   value="<?php if (!empty($fax)) {  echo $fax; } ?>" >
        </div>
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Mobile : <font color="#FF0000">*</font> </label>
            <input type="text" class="form-control" name="mobile"  size="30" maxlength="30"   value="<?php echo $mobile; ?>" >
        </div>
    </div>
</div>

<div class="row edit-margin">
    <div class="form-group ">
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Address : </label>
            <textarea name="address" class="form-control" rows="5" cols="30"><?php echo $address; ?></textarea>
        </div>
        <div class="col-sm-6 col-xs-12">
            <label class="control-label" for="recipient-name">Profile Image :</label>
            <?php
            if ($mem["user_img"]) {
                ?>
                <img src="https://www.blazebay.com/assets/uploadedimages/<?php echo $mem["user_img"]; ?>" style='width:50px;height:50px' />
            <?php } else {?>
                <img src="https://www.blazebay.com/assets/uploadedimages/avatar.jpg" style='width:50px;height:50px' />
            <?php } ?>
            <input type="file" name="user_img">
        </div>
    </div>
</div>

<?php
/**********ONLY APPEARS FOR COURIER**************** */

if ($this->session->userdata['logged_in']['usertype'] == '4') {
    ?>
    <div class="row edit-margin">
        <div class="form-group">

            <div class="col-sm-6 col-xs-12">
                <label class="control-label" for="recipient-name">Operational Area : </label>
                <select multiple class="form-control" name="oper_area[]">
                    <?php
                    // $areas = mysql_query("select city_name,city_id from " . $prev . "cities where status='1'");
                    $where="status='1'";
                    $areas= $this->Site_model->getDataById( 'bt_cities', $where );

                    foreach($areas as $key=>$fetoparea) {
                        ?>
                        <option value="<?php echo $fetoparea['city_id']; ?>"<?php
                        if (in_array($fetoparea['city_id'], $oper_area1)) {
                            echo "selected";
                        }
                        ?>><?php echo ucwords($fetoparea['city_name']); ?></option>
                    <?php } ?>
                    <?php /* <option value="saab">Saab</option>
                                              <option value="opel">Opel</option>
                                              <option value="audi">Audi</option> */ ?>
                </select>

            </div>
        </div>
    </div>
<?php
}
/******ONLY APPEARS FOR COURIER********* */
?>

<div class="row edit-margin">

    <div class="form-group ">

        <div class="col-sm-6 col-xs-12">

            <input name="submit" class="btn btn-warning btn-big"  type="button" onclick="updateProfile()" value="Update" class="button">

        </div>

    </div>

</div>

<div class="row edit-margin">

    <div class="form-group ">

        <div class="col-sm-12 col-xs-12">
            <?php

            //Used for PAyment Info

            if ($this->session->userdata['logged_in']['usertype'] == '4' || $this->session->userdata['logged_in']['usertype'] == '2') {



            $paypal_email = $mem["payment_paypal_email"];

            $paypal_payment_status = $mem["payment_paypal_status"];

            $paypal_status_txt="";

            if($paypal_payment_status == 1){

                $paypal_status_txt = "<span style='color:green;'>Approved</span>";

            }else if($paypal_payment_status == 0){

                $paypal_status_txt = "<span style='color:red;'></span>";

            }



            ?>

            <!-- USED FOR PAYMENT INFO -->

            <hr>

            <h3 class="section-title">

                <a href="javascript:void(0);" style="text-align:center;">Payment Details::</a>

            </h3>



            <form name="frm_payment_details" action="#" method="post"  id="process_payment" enctype="multipart/form-data">



                <input name="userid" type="hidden" value="<?=$mem['user_id'];?>" class="form-control" >

                <div class="row edit-margin">

                    <div class="form-group ">

                        <div class="col-sm-6 col-xs-12">

                            <label class="control-label" for="paypal_email">Paypal Email<font color="#FF0000">*</font> </label>

                            <input name="paypal_email" type="text" value="<?=$paypal_email;?>" class="form-control" >

                            <p id="paypal"><?=$paypal_status_txt;?></p>

                        </div>

                    </div>

                </div>



                <div class="row edit-margin">

                    <div class="form-group ">

                        <div class="col-sm-6 col-xs-12">

                            <input name="update_payment" class="btn btn-warning btn-big"  type="button" onclick="process_payment()" value="Update Payment" class="button">

                        </div>

                    </div>

                </div>


            </form>
        </div>

    </div>

</div>
    <!-- USED FOR PAYMENT INFO ENDS -->

<?php

}

?>





</div>



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