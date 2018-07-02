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
                <div class="col-md-12">

                <div class="featuredpro">
                <h3 class="section-title"> <a href="javascript:void(0);">Post Trade show</a></h3>
                <div id="msgReplies"></div>

                <?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="manage-trades"> Manage Trade show </a>  > Post Trade show </h2><?php */?>
                <?php

                //$all_user_details="select * from " . $prev. "members where user_id=".$_SESSION['user_id'];
                //$user_details=mysql_fetch_array(mysql_query($all_user_details));
                //print_r($user_details);
                $prev="bt_";
                $sbq_gro="select * from " . $prev. "membership_plan where plan_id ='".$this->session->userdata['logged_in']["memtype"]."'";

                $sbrow_gro= $this->Site_model->getcountRecods($sbq_gro);
                //$sbrow_gro=mysql_fetch_array(mysql_query($sbq_gro));
                $sbrow_gro=$sbrow_gro[0];
                $mem_sell_offer = $sbrow_gro["no_of_trade_alerts"];

                $mem_gro="select * from " . $prev. "tradeshow where user_id ='".$this->session->userdata['logged_in']["user_id"]."' and approved ='Y' and enddate < NOW() ";
                $sbsell_count= $this->Site_model->getcountRecods($mem_gro);
                $sbsell_count=$sbsell_count?count($sbsell_count):0;
                $sbsell_count;
                if ($mem_sell_offer <= $sbsell_count ) { ?>

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12">  Posted - <font class='red'><?php echo $sbsell_count; ?></font>
                            Maximum Allowed - <font class='red'><?php if($mem_sell_offer>10000){ echo "Unlimited";}else{ echo $mem_sell_offer;} ?></font>    </label>

                        <label class="col-md-12 col-sm-12">You Reached maximum limit of sell offer .Please Upgrade Your Membership plan  <span>*</span>
                        </label>

                    </div>

                <?php } else {


                    ?>

                    <form enctype="multipart/form-data" name="frmUser" class="form_blazebaytradeshows" class="form-horizontal" method="post" action="#">

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Show Name: <span style="color:red;"> * </span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <input type="text" name="tradeshow_name" value="<?php if(isset($d['tradeshow_name'])){ echo $d['tradeshow_name']; }?>" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Show Description: <span style="color:red;"> * </span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <textarea rows="5" name="description" class="form-control"><?php if(isset($d['description'])){ echo $d['description']; }?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Starts On:
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">

                            <input type="text" name="tradeshow_date" readonly="" placeholder="Enter Start date" class="datepicker form-control expireson">

                            <?php /*?><input type="text" name="tradeshow_date" id="tradeshow_date"  class="form-control input-group " value="<?php if(isset($d['tradeshow_date'])) {echo $d['tradeshow_date']; }?>"><?php */?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Expires On:
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">

                            <input type="text" name="expireson" readonly="" placeholder="Enter Expire date" class="datepicker form-control expireson">

                            <?php /*?><input type="text" name="enddate" id="enddate"  class="form-control input-group" value="<?php if(isset($d['enddate'])){ echo $d['enddate']; }?>"><?php */?>
                        </div>
                    </div>

                    <?php
                    $query ="SELECT * FROM " . $prev. "countries WHERE status = 1 ORDER BY country_name ASC";

                    $rowCountr= $this->Site_model->getcountRecods($query);
                    $rowCount = count($rowCountr);
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Country: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select name="country" id="country" class="form-control">
                                <option value="0">Select Country</option>
                                <?php
                                if($rowCount > 0){
                                    foreach($rowCountr as $key=>$row){ ?>

                                        <option value="<?php echo $row['country_id']; ?>" <?php if(isset($d['country_id']) && $row['country_id']==$d['country_id']){echo "selected"; } ?> > <?php echo $row['country_name']; ?> </option>
                                    <?php     }
                                }else{
                                    echo '<option value="">Country not available</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <?php
                    $query ="SELECT * FROM " . $prev. "states WHERE status = 1 ORDER BY state_name ASC";

                    $rowCountR= $this->Site_model->getcountRecods($query);
                    $rowCount = COUNT($rowCountR);
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">State: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select name="state" id="state" class="form-control">
                                <option value="0">Select State</option>
                                <?php
                                if($rowCount > 0){
                                    foreach($rowCountR as $key=>$row){
                                        ?>
                                        <option value="<?php echo $row['state_id']; ?>" <?php if(isset($d['state_id']) && $row['state_id']==$d['state_id']){echo "selected"; } ?> > <?php echo $row['state_name']; ?> </option>
                                    <?php
                                    }
                                }else{
                                    echo '<option value="">State not available</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <?php
                    $query ="SELECT * FROM " . $prev. "cities WHERE status = 1 ORDER BY city_name ASC";

                    $rowCountRe= $this->Site_model->getcountRecods($query);
                    $rowCount = count($rowCountRe);
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">City: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select name="city" id="city" class="form-control">
                                <option value="0">Select City</option>
                                <?php
                                if($rowCount > 0){
                                    foreach($rowCountRe as $key=>$row){
                                        ?>
                                        <option value="<?php echo $row['city_id']; ?>" <?php if(isset($d['cityid']) && $row['city_id']==$d['cityid']){echo "selected"; } ?> > <?php echo $row['city_name']; ?> </option>
                                    <?php
                                    }
                                }else{
                                    echo '<option value="">City not available</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Venue: <span style="color:red;"> * </span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <input type="text" name="tradeshow_venue" value="<?php if(isset($d['tradeshow_venue'])){ echo $d['tradeshow_venue']; }?>" required class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Frequency: <span style="color:red;"> * </span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-6">
                            <select name="frq_period" class="form-control">
                                <option value="" >Select Time</option>
                                <option value="A"<?php if(isset($d['frq_period']) && $d['frq_period']=='A'){echo "selected"; }?>>Annual</option>
                                <option value="T"<?php if(isset($d['frq_period']) && $d['frq_period']=='T'){echo "selected"; }?>>Twice a year</option>
                                <option value="B"<?php if(isset($d['frq_period']) && $d['frq_period']=='B'){echo "selected"; }?>>Biennial</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Open To: <span style="color:red;"> * </span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-6">
                            <select name="open_to" class="form-control">
                                <option value="">Please select</option>
                                <option value="T"<?php if(isset($d['open_to']) && $d['open_to']=='T'){echo "selected"; }?> >Trade visitors</option>
                                <option value="G"<?php if(isset($d['open_to']) && $d['open_to']=='G'){echo "selected"; }?>>General public</option>
                                <option value="TG"<?php if(isset($d['open_to']) && $d['open_to']=='TG'){echo "selected"; }?>>Trade visitors & General public  </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Show Website: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <input type="text" name="show_website" value="<?php if(isset($d['show_website'])){ echo $d['show_website']; }?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Categories: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select class="form-control" name="category[]" id="category"  multiple>
                                <?php
                                $busi_cat1 = explode(",", $d['category']);

                                $cat_query = "select * from ".$prev."categories where status='Y' order by cat_name";

                                $rowCountRes= $this->Site_model->getcountRecods($cat_query);
                                foreach ($rowCountRes as $key=>$fet_cat) {
                                    ?>
                                    <option value="<?php echo $fet_cat['id']; ?>"<?php
                                    if (in_array($fet_cat['id'], $busi_cat1)) {
                                        echo "selected";
                                    }?>><?php echo ucwords($fet_cat['cat_name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Visitor Profile: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <textarea rows="5" name="visitor_profile" class="form-control"><?php if(isset($d['visitor_profile'])){ echo $d['visitor_profile']; }?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Product Profile: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <textarea rows="5" name="product_profile" class="form-control"><?php if(isset($d['product_profile'])){ echo $d['product_profile']; }?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Last Fair Report: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <textarea rows="5" name="lastfair_report" class="form-control"><?php if(isset($d['lastfair_report'])){ echo $d['lastfair_report']; }?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Official Hotels: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <textarea rows="5" name="official_hotels" class="form-control"><?php if(isset($d['official_hotels'])){ echo $d['official_hotels']; }?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Official Airlines: <span>*</span>
                        </label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <textarea rows="5" name="official_airlines" class="form-control"><?php if(isset($d['official_airlines'])){ echo $d['official_airlines']; }?></textarea>
                        </div>
                    </div>


                    <?php /*<div class="input-group">
        <label class="col-md-6 col-sm-4">Tradeshow Logo</label>
        <div class="col-md-6 col-sm-4">
        <?php if($d['tradeshow_img'] && file_exists('./trade/'.$d['tradeshow_img'])){?>
        <img width="60" height="60" src="<?php echo base_url();?>viewimage.php?src=<?php echo base_url().'trade/'.$d['tradeshow_img']?>">
        <?php } ?>
            <span class="btn btn-primary">
                Browse&hellip; <input type="file"  name="eventlogo" id="filesToUpload">
            </span>

        </div>
        <!--input type="text" class="form-control" style="border:0px;"-->
    </div> */?>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4">Tradeshow Logo</label>

                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="browse-img">
                                <?php if(!isset($d['tradeshow_img'])){?>
                                    <img  style="width:200px" src="<?=base_url()?>assets/images/nopic.jpg" >
                                <?php }else if(isset($d['tradeshow_img'])) {
                                    $file = $d['tradeshow_img'];
                                    $path= 'assests/trade/';
                                    $image_thumb=base_url().$path.$file;
                                    ?>
                                    <img src="<?php echo $image_thumb;?>">
                                <?php } ?>
                            </div>
                            <div class="input-group">

                                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        <input type="file" name="eventlogo" >
                    </span>
                                </label>
                                <input type="text" class="form-control" style="border:0px;" readonly>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <?php /*<label class="input-group-btn">

                <span class="btn btn-primary">
                        Browse&hellip; <input type="file" style="display: none;" name="eventlogo" id="filesToUpload" multiple>
                </span>
                </label>
                <input type="text" class="form-control" style="border:0px;" readonly> */?>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4 col-xs-12">
                            <input type="button" class="btn btn-warning" name="sub"  onclick="return form_tradeshows()" value="Submit">
                        </div>
                    </div>
                    </form>
                <?php
                }
                ?>
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
<script>

    function form_tradeshows(){
        var base_url="<?php echo base_url();?>";
        var data = new FormData($('.form_blazebaytradeshows')[0]);

        $.ajax({
            url: base_url+"process_tradeshows",
            type: "POST",
            data: data,
            async: false,
            success: function (msg) {
                $("#msgReplies").html(msg);
            },
            cache: false,
            contentType: false,
            processData: false
        });


    }

</script>




<script>
    $( function() {
        $("#enddate").datepicker({ dateFormat: 'dd-mm-yy'});
        $("#tradeshow_date").datepicker({  minDate: 0,dateFormat: 'dd-mm-yy'}).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("dd-mm-yy", minValue);
            minValue.setDate(minValue.getDate());
            $("#enddate").datepicker( "option", "minDate", minValue );
        })
    } );
</script>




<script>
    function prod_chng(prodid){

        var data='prodid=' + prodid;
        $.ajax({
            url: "<?=base_url()?>prod_price.php",
            type: "GET",
            data: data,
            cache: false,
            success: function (data) {
                $("#priceid").val(data);
                $("#pricediv").show();
            }
        });

        return false;
    }



    // jQuery(function() {
    //   var datepicker = $('input.datepicker');

    //   if (datepicker.length > 0) {
    //     datepicker.datepicker({
    //       format: "mm/dd/yyyy",
    //       startDate: new Date()
    //     });
    //   }
    // });



    $(document).ready(function () {

        $("#frmUser").formValidation({

            // addOns: {
            //   reCaptcha2: {
            //     element: 'captchaContainercompany',
            //     theme: 'light',
            //     siteKey: '6LejEhkTAAAAAMjASQZs014Em6CgNKBn-28zAx3I',
            //     language: 'en',
            //     message: 'The captcha is not valid'
            //   }
            // }
            // ,



            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }
            ,
            fields: {
                tradeshow_name: {
                    validators: {
                        notEmpty: {
                            // prod_id: "required"
                            message: 'Trade show field is required'
                        }
                    }
                }
                ,

                open_to: {
                    validators: {
                        notEmpty: {
                            message: 'Open to field is required'
                        }

                    }
                }
                ,

                frq_period: {
                    validators: {
                        notEmpty: {
                            message: 'Frequency field is required'
                        }

                    }
                }
                ,

                description: {
                    validators: {
                        notEmpty: {
                            message: 'Description field is required'
                        }

                    }
                }
                ,

                tradeshow_venue: {
                    validators: {
                        notEmpty: {
                            message: 'Venue field is required'
                        }
                    }
                }
                ,

                min_order: {
                    validators: {
                        notEmpty: {
                            message: 'Min Order field is required'
                        }
                    }
                }
                ,
                delivery_time: {
                    validators: {
                        notEmpty: {
                            message: 'Delivery time field is required'
                        }
                    }
                }
                ,


                message: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The message field is required'
                        }

                    }
                }

            }

        });
    });


</script>
<!--
<script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });

});
</script> -->




<script type="text/javascript">
    $(document).ready(function(){
        $('#country').on('change',function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:'POST',
                    url:'<?=base_url()?>getCountry',
                    data:'country_id='+countryID,
                    success:function(html){
                        $('#state').html(html);
                        $('#city').html('<option value="">Select state first</option>');
                    }
                });
            }else{
                $('#state').html('<option value="">Select country first</option>');
                $('#city').html('<option value="">Select state first</option>');
            }
        });

        $('#state').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                $.ajax({
                    type:'POST',
                    url:'<?=base_url()?>getstate',
                    data:'state_id='+stateID,
                    success:function(html){
                        $('#city').html(html);
                    }
                });
            }else{
                $('#city').html('<option value="">Select state first</option>');
            }
        });
    });
</script>



<script>
    $(".expireson").datepicker({
        minValue : 0 ,
        autoclose: true,
        //dateFormat: 'dd-mm-yy'
        dateFormat: 'dd-mm-yy'
    });
</script>



<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>

</body>
</html>
		