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
            <div > <h3 class="section-title">Add  Location Pricing</h3></div>

            <div id="msgReplies"></div>


            <form name="locationfrm" method="post" action="#" id="locationfrm" enctype="multipart/form-data">
                <div class="row edit-margin">
                    <div class="col-sm-3" > </div>
                    <div class="col-sm-4" >
                        <fieldset>
                            <legend>Select Transport Mode:</legend>
                            <input type="radio" id="land"  value="land" name="mode" checked>

                            <label class="control-label" for="recipient-name">By Land<font color="#FF0000">*</font> </label>
                            <input type="radio" id="air"  value="air" name="mode" >
                            <label class="control-label" for="recipient-name">By Air <font color="#FF0000">*</font> </label>

                            <input type="radio" id="sea"  value="sea" name="mode" >
                            <label class="control-label" for="recipient-name">By Sea<font color="#FF0000">*</font> </label>



                        </fieldset>
                    </div>
                </div>
                <div class="row edit-margin" id="vehicles">
                    <div class="col-sm-3" > </div>
                    <div class="col-sm-4" >
                        <select id="means" class="form-control" name="means">
                            <option value="motorbike">Motorbike</option>
                            <option value="pickup">Pickup</option>
                            <option value="canter">Canter</option>


                        </select>
                    </div>
                </div>


                <div class="row edit-margin">

                    <div class="col-sm-6 col-xs-12">
                        <label class="control-label" for="recipient-name">Origin country : <font color="#FF0000">*</font> </label>
                        <select id="sourceCountry" class="form-control" name="sourceCountry">
                            <?php
                            $qry="SELECT country_id,country_name FROM bt_countries
								ORDER BY country_name ASC";
                            $courireDropdown= $this->Site_model->getcountRecods($qry );
                            foreach($courireDropdown as $rs) {
                                ?>
                                <option value="<?php echo $rs["country_id"]; ?>"><?php echo $rs["country_name"]; ?></option>
                            <?php
                            }
                            ?>


                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label class="control-label" for="recipient-name">Destined country : <font color="#FF0000">*</font> </label>
                        <select id="destCountry" class="form-control" name="destCountry">
                            <?php
                            $qry="SELECT country_id,country_name FROM bt_countries
								ORDER BY country_name ASC";
                            $courireDropdown= $this->Site_model->getcountRecods($qry );
                            foreach($courireDropdown as $rs) {
                                ?>
                                <option value="<?php echo $rs["country_id"]; ?>"><?php echo $rs["country_name"]; ?></option>
                            <?php
                            }
                            ?>


                        </select>
                    </div>

                </div>

                <div class="row edit-margin">

                    <div class="col-sm-6 col-xs-12">
                        <label class="control-label" for="recipient-name">Source state : <font color="#FF0000">*</font> </label>
                        <select name="sourcestate" class="form-control select1" id="sourcestate">  </select>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label class="control-label" for="recipient-name">Destined state : <font color="#FF0000">*</font> </label>
                        <select name="deststate" class="form-control select1" id="deststate">  </select>
                    </div>

                </div>

                <div class="row edit-margin">

                    <div class="col-sm-6 col-xs-12">
                        <label class="control-label" for="recipient-name">Origin City : <font color="#FF0000">*</font> </label>
                        <select name="sourcecities" class="form-control select1" id="sourcecities">  </select>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label class="control-label" for="recipient-name">Destined City : <font color="#FF0000">*</font> </label>
                        <select name="destcities" class="form-control select1" id="destcities">  </select>
                    </div>

                </div>

                <div class="row edit-margin">

                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Currency : <font color="#FF0000">*</font> </label>
                        <div >
                            <select name="currency" id="currency" class="col-sm-12 form-contro1" >
                                <option value="">Select Currency</option>
                                <?php
                                $rs_query =$this->Site_model-> getcountRecods("Select * from " . $prev . "currencies where sbcur_status = '1'");
                                foreach($rs_query as $rs) {
                                    ?>
                                    <option value="<?php echo $rs["sbcur_id"]; ?>"
                                        <?php
                                        if ($rs["sbcur_id"] == $price_cur_id) {
                                            echo "  selected ";
                                        }
                                        ?>><?php echo $rs["sbcur_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Min. KM : <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control"   id="mindistanceKm" name="mindistanceKm" />
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Max. KM : <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control"   id="maxdistanceKm" name="maxdistanceKm" />
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Min. Weight(Kg) : <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control"  id="minweight"  name="minweight"/>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Max. Weight(Kg) : <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control"  id="maxweight"  name="maxweight"/>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Min Volume(M<sup>2</sup>): <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control" id="minvolume" name="minvolume"/>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Max Volume(M<sup>2</sup>): <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control" id="maxvolume" name="maxvolume"/>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Price: <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control"  id="cprice" name="cprice"/>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Price(+ Commission): <font color="#FF0000">*</font> </label>
                        <input type="text" class="form-control"  id="price" name="price"/>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Duration(Days) <font color="#FF0000">*</font> </label>

                        <input type="text" class="form-control"  id="duration" name="duration" />
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label" for="recipient-name">Other Details<font color="#FF0000">*</font> </label>

                        <textarea rows="4" cols="50" class="form-control" name="other">
                        </textarea>
                    </div>


                    <div class="col-sm-12 col-xs-12">

                        <input name="update_payment" class="btn btn-warning btn-big"  type="button" onclick="return cancell()" value="Cancel" class="button">
                        <input name="update_payment" class="btn "  style="background-color:#2873f0;color:#ffffff;" type="button" onclick="return addPricing()" value="Save Details" class="button">

                    </div>

                </div>


            </form>

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

$(document).ready(function() {
    $('input[type=radio][name=mode]').change(function() {
        if (this.value == 'sea') {
            $("#vehicles").hide();
        }
        else if (this.value == 'air') {
            $("#vehicles").hide();
        }else{
            $("#vehicles").show();
        }

    });

});
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

function  addPricing(){

    var base_url="<?php echo base_url();?>";
    var formData = new FormData($('#locationfrm')[0]);

    $.ajax({
        url: base_url+"process_location_pricing",
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
