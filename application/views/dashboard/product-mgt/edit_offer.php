<?php
$pagename = "postofferbuy";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";




$upro_catid="";
if(isset($id))
{
    $r=$this->Site_model-> getcountRecods("select * from  bt_offers WHERE id=" . $id."");
    $prod_id = $r[0]['prod_id'];
    $offerimage=$this->Site_model->getcountRecods("select image from  bt_products WHERE id=" . $prod_id."");
    $d=$r[0];
    // $upro_catid = $d['cat_id'];

}

//print_r($r);exit;
?><!DOCTYPE html>
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
    <div class="col-md-10">


        <div class="featuredpro">

            <h2> Manage Offers> Edit Offer</h2>
            <div id="msgReplies"></div>
            <?php /*?> <h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="manage-buy-offers"> Manage Offers </a> > Post Offer</h2><?php */?>
            <?php

            //$all_user_details="select * from " . $prev. "members where user_id=".$this->session->userdata['logged_in']['user_id'];
            //$user_details=mysql_fetch_array(mysql_query($all_user_details));
            //print_r($user_details);

            ?>
            <form enctype="multipart/form-data" name="frmUser" id="form_buy_postoffers" class="form-horizontal" method="post" action="#">

                <div class="form-group">
                    <?php
                    $count_post =$this->Site_model-> getcountRecods("select uid from " . $prev. "offers_buy where uid=".$this->session->userdata['logged_in']['user_id']);
                    $num_rows   =$count_post? count($count_post):0;

                    ?>

                </div>


                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Title: <font color="#FF0000">*</font></label>
                    <div class="col-md-9 col-sm-8 col-xs-12"><input name="title" class="form-control" type="text" id="title" value="<?php if(isset($d['title'])){ echo $d['title']; }?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Offer Description: <font color="#FF0000">*</font></label>
                    <div class="col-md-9 col-sm-8 col-xs-12"><textarea name='description' class="form-control"><?php if(isset($d['description'])){ echo $d['description']; }?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Quantity: <font color="#FF0000">*</font></label>
                    <div class="col-md-9 col-sm-8 col-xs-12"><input name="quantity" type="text" class="form-control" id="quantity" value="<?php if(isset($d['quantity'])){ echo  $d['quantity']; }?>" size="30" maxlength="40"></div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Keywords: <font color="#FF0000">*</font></label>
                    <div class="col-md-9 col-sm-8 col-xs-12"> <input name="keywords" type="text" class="form-control"  id="keywords" value="<?php if(isset($d['keywords'])){ echo  $d['keywords']; }?>" size="30" maxlength="40">
                        <div class="smalltext">Please specify a comma seperated list of keywords related to your product. Appropriate keywords will lead more buyers to find your products.</div>
                    </div>
                    <?php /* <div class="form-group">
        <label class="col-md-3 col-sm-4">Expires on:
        </label>
        <div class="col-md-9 col-sm-8 col-xs-12">
             <input type="text" name="expireson" id="expireson" readonly value='<?php echo $d['expireson'];?>' class="datepicker form-control">
        </div>
    </div> */?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 col-sm-3">Expires On:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12 date">
                        <!-- <div class="input-group input-append date" id="datePicker"> -->
                        <div class="input-group input-append date" id="">

                            <input type="text" name="expireson" id="expireson" readonly="" placeholder="Enter Expire date" class="datepicker form-control" value="<?php if(isset($d['expireson'])){echo $d['expireson'];}?>">

                            <!--
                            <input type="text" class="form-control datepicker margin-top" name="expireson" />
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            -->
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Offer Price: <font color="#FF0000">*</font></label>
                    <div class="col-sm-3 col-xs-12">
                        <select name="price_cur_id" class="form-control">
                            <option value="0">Select Currency</option>
                            <?php
                            $rs_query=$this->Site_model-> getcountRecods("Select * from " . $prev. "currencies where sbcur_status = '1'" );
                            foreach ($rs_query as $rs)
                            {
                                ?>
                                <option value="<?php echo $rs["sbcur_id"]; ?>"<?php if(isset($d['price_cur_id']) && $rs["sbcur_id"]==$d['price_cur_id']){ echo "selected ";}?>><?php echo $rs["sbcur_symbol"].' ('.$rs["sbcur_name"].')'; ?></option>
                            <?php } ?>
                        </select></div>
                    <div class="col-sm-6 col-xs-12">
                        <input name="price" type="text" class="form-control" id="price" value="<?php if(isset($d['offer_price'])){ echo $d['offer_price']; } ?>" size="5" maxlength="30">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Offer Image <br>(JPEG,JPG,PNG)</label>

                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="browse-img">
                            <?php if(isset($offerimage)){?>
                                <img src="<?php echo base_url().'assets/uploadedimages/'.$offerimage[0]['image'];?>" style="max-width: 250px;">
                            <?php } ?> </div>

                    </div>
                    <div class="clearfix"></div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 col-sm-4"></label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <a href="<?=base_url()?>manage-sell-offers"   class="btn btn-warning btn-big"> Back</a>
                        <input type="button" value="Update Offer" onclick="form_buy_postoffers()"  class="btn btn-primary btn-big" name="sub">
                    </div>
                </div>


            </form>


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
    function  form_buy_postoffers(){

        var base_url="<?php echo base_url();?>";
        var id="<?php echo $id;?>";
        var formData = new FormData($('#form_buy_postoffers')[0]);

        $.ajax({
            url: base_url+"process-update-form-sell-postoffers/"+id,
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                //document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                //window.location.href=base_url+"manage-wholesale-products";
            },
            cache: false,
            contentType: false,
            processData: false
        });


    }

</script>

<script>

    /*-
     jQuery(function() {
     var datepicker = $('input.datepicker');

     if (datepicker.length > 0) {
     datepicker.datepicker({
     format: "mm/dd/yyyy",
     startDate: new Date()
     });
     }
     });
     */

    $("#expireson").datepicker({
        minValue : 0 ,
        autoclose: true,
        //dateFormat: 'dd-mm-yy'
        dateFormat: 'dd-mm-yy'
    });

    /*
     $("#from_booking_date").datepicker({ dateFormat: 'dd-mm-yy' }).bind("change",function(){
     var minValue = $(this).val();
     minValue = $.datepicker.parseDate("dd-mm-yy", minValue);
     minValue.setDate(minValue.getDate()+1);
     $("#to_booking_date").datepicker( "option", "minDate", minValue );
     });
     */

    function prod_chng(prodid){
//alert(prodid);
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

    $(document).ready(function() {
//$('#subcatdiv').css('display','block');
        $("#maincat").change(function(){
            var catid = $('#maincat').val();
//alert(catid);

            $.ajax({
                url: "<?=base_url()?>fetsubcat.php?catid="+catid,
                type: "GET",
                data: catid,
                success: function (data) {
                    var result = $.trim(data);
                    //alert(result);
                    //$('#subcatdiv').html(data);
                    if(result == '<option value="">Choose a category</option>') {
                        //$('#subcatdiv').css('display','none');
                        //$('#subcatdiv').removeAttr('required');
                        $("#subcatdiv").empty();
                    }
                    else {
                        $('#subcatdiv').css('display','block');
                        $('#subcatdiv').attr('required','required');
                        $('#subcatdiv').html(data);
                    }

                }
            });
        });
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datePicker')
            .datepicker({
                autoclose: true,
                format: 'mm/dd/yyyy'
            })
            .on('changeDate', function(e) {
                // Revalidate the date field
                $('#frmUser').formValidation('revalidateField', 'expireson');
            });

        $("#frmUser").formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }
            ,
            fields: {

                ctid: {
                    validators: {
                        notEmpty: {
                            message: 'Category field is required'
                        },

                    }
                }
                ,

                title: {
                    validators: {
                        notEmpty: {
                            message: 'Title field is required'
                        },

                    }
                }
                ,
                description: {
                    validators: {
                        notEmpty: {
                            message: 'Description field is required'
                        },

                    }
                }
                ,
                quantity: {
                    validators: {
                        notEmpty: {
                            message: 'Quantity field is required'
                        },

                    }
                }
                ,


                keywords: {
                    validators: {
                        notEmpty: {
                            message: 'keywords field is required'
                        },

                    }
                }
                ,

                expireson: {
                    validators: {
                        notEmpty: {
                            message: 'The date is required'
                        },

                    }
                },

                price: {
                    validators: {
                        notEmpty: {
                            message: 'Price field is required'
                        },
                        regexp: {
                            regexp: /([0-9]+([,\.][0-9]+)?)+$/i,
                            message: 'The Price field only consists of numbers.'
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
                        ,
                    }
                }
                ,
            }
        });
    });
</script>



<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
</body>
</html>
