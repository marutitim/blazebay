<?php
$pagename = "courierlocation";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
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
                <h2><i aria-hidden="true" class="fa"> <img src="<?php echo base_url() ?>assets/images/FEATURED-PRODUCTS_ICON.png"></i> <a href="edit-profile"> Edit Location </a> </h2>

                <?php
                // FOR COURIER CODE
                $msg ="";
                if(isset($_POST['updatelocation']) && $_POST['updatelocation'] == "Update" )
                {

                    $LOC_COUNTRY_ARR= $_POST['location_country'];
                    $LOC_STATE_ARR	= $_POST['location_state'];
                    //print_r($LOC_COUNTRY_ARR);

                    if($LOC_COUNTRY_ARR  !="" && $LOC_STATE_ARR !="")
                    {

                        // FOR COUNTRY ENTRY
                        $DELETE_COUNTRY_SQL = "DELETE FROM ".$prev."courier_country WHERE courier_id = '".$_SESSION['user_id']."'";
                        mysql_query($DELETE_COUNTRY_SQL);

                        foreach($LOC_COUNTRY_ARR as $key => $value)
                        {
                            $LOC_COUNTRY_ID = $value;
                            $ADD_COUNTRY_SQL = "INSERT INTO ".$prev."courier_country (courier_id,country_id) VALUES('".$_SESSION['user_id']."','".$LOC_COUNTRY_ID."')";
                            $DONE_COUNTRY = mysql_query($ADD_COUNTRY_SQL);

                        }

                        // FOR STATE ENTRY

                        $DELETE_STATE_SQL = "DELETE FROM ".$prev."courier_state WHERE courier_id = '".$_SESSION['user_id']."'";
                        mysql_query($DELETE_STATE_SQL);

                        foreach($LOC_STATE_ARR as $key => $value)
                        {
                            $LOC_STATE_ID = $value;
                            //echo $LOC_STATE_ID."<br>";
                            if(strlen($value)==0){	continue;}
                            if($value == 0)
                            {
                                //$ALL_STATE_
                                //$ADD_STATE_SQL = "INSERT INTO ".$prev."courier_state (courier_id,state_id) VALUES('".$_SESSION['user_id']."','".$LOC_STATE_ID."')";
                                //$DONE_STATE = mysql_query($ADD_STATE_SQL);
                            }
                            if($value !== 0)
                            {
                                $ADD_STATE_SQL = "INSERT INTO ".$prev."courier_state (courier_id,state_id) VALUES('".$_SESSION['user_id']."','".$LOC_STATE_ID."')";
                                $DONE_STATE = mysql_query($ADD_STATE_SQL);
                            }

                        }

                    }
                    /*
                    $LOC_COUNTRY_ID	= $_POST['location_country'];
                    $LOC_STATE_ID	= $_POST['location_state'];
                    $LOC_CITY_ID	= $_POST['location_city'];

                    if($LOC_COUNTRY_ID  !="" && $LOC_STATE_ID !="" && $LOC_CITY_ID!="")
                    {
                        $LOC_COUNTRY_ID	= trim($LOC_COUNTRY_ID);
                        $LOC_STATE_ID	= trim($LOC_STATE_ID);
                        $LOC_CITY_ID	= trim($LOC_CITY_ID);

                        $DELETE_COUNTRY_SQL = "DELETE FROM ".$prev."courier_country WHERE courier_id = '".$_SESSION['user_id']."'";
                        mysql_query($DELETE_COUNTRY_SQL);
                        $DELETE_STATE_SQL = "DELETE FROM ".$prev."courier_state WHERE courier_id = '".$_SESSION['user_id']."'";
                        mysql_query($DELETE_STATE_SQL);
                        $DELETE_CITY_SQL = "DELETE FROM ".$prev."courier_city WHERE courier_id = '".$_SESSION['user_id']."'";
                        mysql_query($DELETE_CITY_SQL);

                        $ADD_COUNTRY_SQL = "INSERT INTO ".$prev."courier_country (courier_id,country_id) VALUES('".$_SESSION['user_id']."','".$LOC_COUNTRY_ID."')";
                        $DONE_COUNTRY = mysql_query($ADD_COUNTRY_SQL);

                        $ADD_STATE_SQL = "INSERT INTO ".$prev."courier_state (courier_id,state_id) VALUES('".$_SESSION['user_id']."','".$LOC_STATE_ID."')";
                        $DONE_STATE = mysql_query($ADD_STATE_SQL);

                        $ADD_CITY_SQL = "INSERT INTO ".$prev."courier_city (courier_id,city_id) VALUES('".$_SESSION['user_id']."','".$LOC_CITY_ID."')";
                        $DONE_CITY = mysql_query($ADD_CITY_SQL);
                        if($DONE_STATE ==1 && $DONE_COUNTRY ==1 && $DONE_CITY == 1)	{ $msg = "Updated";}

                    }
                    */


                }
                // COURIER DOC UPLOAD :: ENDS HERE
                ?>



                <?php if(!empty($msg) && $msg!=''){?>
                    <div class="alert alert-success"><i class="fa fa-check"></i><?php echo $msg ;?></div>
                <?php } ?>

                <form name="form1" method="post" action="" onSubmit="" enctype="multipart/form-data">

                    <style>
                        .courier-loc-err{ color: red;}
                    </style>
                    <div class="row edit-margin">
                        <div class="form-group ">
                            <div class="col-sm-6 col-xs-12">
                                <label class="control-label" for="recipient-name">Select Country : <font color="#FF0000">*</font> </label>
                                <span class="courier-loc-err" id="loc_country_msg"></span>
                                <?php
                                $qry="SELECT country_id,country_name FROM  bt_countries WHERE status ='1' ORDER BY country_name ASC";
                                $countryDropdown= $this->Site_model->getcountryDropdown($qry);

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

                            <div class="col-sm-6 col-xs-12">
                                <div class="" id="loc_state_container">

                                    <div class="loc_state_box" id="">
                                        <label class="control-label" for="recipient-name">Select State : <font color="#FF0000">*</font> </label>
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

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    /*********************ONLY APPEARS FOR COURIER******************************/

                    if($this->session->userdata['logged_in']['usertype']=='4') {?>

                    <?php }
                    /*********************ONLY APPEARS FOR COURIER******************************/
                    ?>



                    <div class="clearfix"></div>

                    <div class="row edit-margin">
                        <div class="form-group float-right">
                            <div class="col-sm-12 col-xs-12">
                                <input name="updatelocation" class="btn btn-warning btn-big float-right col-sm-12"  type="submit" value="Update" >
                            </div>
                        </div>
                    </div>
                </form>




                <hr>
                <h5>Selected State Country </h5>
                <div class="edit-margin">
                    <div class="form-group ">
                        <table class="manage-product">
                            <thead>
                            <tr>
                                <th width="50%">State</th>
                                <th width="50%">Under Country</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            //$FETCH_COURIER_LOCS_QRY = mysql_query( "select * from " . $prev. "courier_country where courier_id=".$_SESSION['user_id'] );
                            $COURIER_DOCS_ROWID1 = "";$COURIER_DOCS_TITLE1="";$COURIER_DOCS_PATH1="";

                            $FETCH_LOCS_QRY="select * from  " . $prev. "courier_state WHERE courier_id=".$this->session->userdata['logged_in']['user_id'] ;

                            $FETCH_LOCS_QRYr= $this->Site_model->getcountRecods($FETCH_LOCS_QRY );

                            $LOC_COUNT = 0;
                            $ALL_STATE_ARR = array();


                            if(count($FETCH_LOCS_QRYr))
                            {
                                foreach($FETCH_LOCS_QRYr as $key=> $SROW)
                                {
                                    $LOC_ROW_ID   = $SROW['id'];
                                    $LOC_STATE_ID = $SROW['state_id'];

                                    $GET_STATE_INFO ="SELECT  * FROM  bt_states WHERE state_id = '$LOC_STATE_ID'";
                                    $FETCH_LOCS_QRYr= $this->Site_model->getcountRecods($GET_STATE_INFO );
                                    $GET_STATE_INFO=$FETCH_LOCS_QRYr[0];
                                    $GET_STATE_NAME = $GET_STATE_INFO['state_name'];
                                    $GET_STATE_CID  = $GET_STATE_INFO['country_id'];

                                    $qry=" SELECT  * FROM  bt_countries WHERE country_id = '$GET_STATE_CID'";
                                    $GET_COUNTRY_INFO= $this->Site_model->getcountRecods($qry );
                                    $GET_COUNTRY_INFO=$GET_COUNTRY_INFO[0];
                                    $GET_COUNTRY_NAME = $GET_COUNTRY_INFO['country_name'];
                                    //$TMP_ARR = array();
                                    $TMP_ARR = array(
                                        'STATE_ID' 		=> $LOC_STATE_ID,
                                        'STATE_NAME'	=> $GET_STATE_NAME,
                                        'COUNTRY_ID'	=> $GET_STATE_CID,
                                        'COUNTRY_NAME'	=> $GET_COUNTRY_NAME,
                                    );
                                    $ALL_STATE_ARR[] = $TMP_ARR;


                                    $LOC_COUNT++;
                                }
                            }

                            // GET ALL STATE COUNTRY
                            $COUNTRYLOC_QRY = "select * from " . $prev. "courier_country where courier_id=".$this->session->userdata['logged_in']['user_id']." AND allstate=1 ";

                            $GET_COUNTRY_INFOr= $this->Site_model->getcountRecods($COUNTRYLOC_QRY );
                            if(!empty($GET_COUNTRY_INFOr))
                            {

                                foreach( $GET_COUNTRY_INFOr as $key=>$LOCROW)
                                {
                                    $CNTLOC_ROW_ID   = $LOCROW['country_id'];

                                    $STATELOC_QU ="select * from " . $prev. "states where country_id=".$CNTLOC_ROW_ID;

                                    $STATELOC_QUr= $this->Site_model->getcountRecods($STATELOC_QU );

                                    foreach($STATELOC_QUr  as $key=>$SLOCROW)
                                    {
                                        $STATE_COUNTRY_ID  = $SLOCROW['country_id'];

                                        $CINFO_QRY = $this->Site_model-> getRowData($prev.'countries',"country_id = '$STATE_COUNTRY_ID'");
                                        $CINFO_NAME = $CINFO_QRY[0]['country_name'];


                                        $SINFO_QRY = $this->Site_model-> getRowData($prev.'states',"country_id = '$STATE_COUNTRY_ID'");
                                        $SINFO_NAME = $SINFO_QRY[0]['state_name'];
                                        $SINFO_ID  = $SINFO_QRY[0]['state_id'];

                                        $TMP_ARR = array(
                                            'STATE_ID' 		=> $SINFO_ID,
                                            'STATE_NAME'	=> $SINFO_NAME,
                                            'COUNTRY_ID'	=> $CNTLOC_ROW_ID,
                                            'COUNTRY_NAME'	=> $CINFO_NAME,
                                        );
                                        $ALL_STATE_ARR[] = $TMP_ARR;


                                        $LOC_COUNT++;
                                    }
                                }
                            }

                            ?>

                            <?php
                            foreach($ALL_STATE_ARR as $SLIST)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $SLIST['STATE_NAME'];?></td>
                                    <td><?php echo $SLIST['COUNTRY_NAME'];?></td>
                                </tr>
                            <?php
                            }
                            ?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <!--- For upload other documents ends-->

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
<SCRIPT >

    var shr_last_valid_selection = null;
    $('#location_country').on('change',function(){
        var loc_countryID = $(this).val();
        //alert(loc_countryID);

        if (loc_countryID.length < 3)
        {
            shr_last_valid_selection = $(this).val();
            if(loc_countryID != "")
            {
                var datastring={'multiple':'multiselect','multi_country_id':loc_countryID}
                $.ajax({
                    type:'POST',
                    url:'ajax.php',
                    data:datastring,
                    dataType: 'html',
                    success:function(rdata){
                        $('#loc_state_container').html("");
                        $('#loc_state_container').html(rdata);
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


    //<!--
    function validate(form)
    {

        if ( form.firstname.value == "" ) {
            alert('Please specify Firstname!');
            form.firstname.focus();
            return false;
        }
        if(form.firstname.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from Firstname (e.g. &  < >)");
            form.firstname.focus();
            return(false);
        }
        if ( form.lastname.value == "" ) {
            alert('Please specify Lastname!');
            form.lastname.focus();
            return false;
        }
        if(form.lastname.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from Lastname (e.g. &  < >)");
            form.lastname.focus();
            return(false);
        }

        if ( form.street.value == "" ) {
            alert('Please specify Street!');
            form.street.focus();
            return false;
        }
        if(form.street.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from Street (e.g. &  < >)");
            form.street.focus();
            return(false);
        }

        if ( form.city.value == "" ) {
            alert('Please specify City!');
            form.city.focus();
            return false;
        }
        if(form.city.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from City(e.g. &  < >)");
            form.city.focus();
            return(false);
        }
        if ( (form.state.selectedIndex == 0 ) && (form.other_state.value == "") ) {
            alert('Please specify State!');
            form.state.focus();
            return false;
        }
        if(form.other_state.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from State(e.g. &  < >)");
            form.other_state.focus();
            return(false);
        }
        if ( form.zip_code.value == "" ) {
            alert('Please specify Zip/Postal Code!');
            form.zip_code.focus();
            return false;
        }
        if(form.zip_code.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from Zip/Postal Code (e.g. &  < >)");
            form.zip_code.focus();
            return(false);
        }
        if ( form.country.selectedIndex == 0 ) {
            alert('Please choose a Country!');
            form.country.focus();
            return false;
        }
        return true;
    }
    // -->
</SCRIPT>

</body>
</html>
