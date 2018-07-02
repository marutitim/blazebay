<?php
$title = "Manage Sale Offers";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";

$strinlist="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist.=",".$value;
}

$strquery=" and id in ($strinlist) ";



$strinlist_1="0";
foreach($_POST as $key => $value)
{
    if(stristr($key,"checkbox"))
        $strinlist_1.=",".$value;
}



$strquery=" and id in ($strinlist_1) ";

if(isset($_POST["remove"]))
{
    //var_dump($strinlist12);die();
    $query_msg_del="delete from " . $prev. "offers where user_id=".$this->session->userdata['logged_in']['user_id']." $strquery";
    $rs_del=mysql_query($query_msg_del);
    $msgdeleted=mysql_affected_rows();
    if($msgdeleted > 0)
    {
        $_SESSION['after_remove_msg']= 'Your Product deleted successfully.';
    } else {
        $_SESSION['err_msg'] = 'Your product not deleted successfully';
    }
}

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
    <h3 class="section-title"> <a href="javascript:void(0);"> Post Sale Offers </a></h3>
    <div id="msgReplies"></div>

    <?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="manage-sell-offers"> Manage Offers </a>  > Post Offer</h2><?php */?>
    <?php

    //$all_user_details="select * from " . $prev. "members where user_id=".$this->session->userdata['logged_in']['user_id'];
    //$user_details=mysql_fetch_array(mysql_query($all_user_details));
    //print_r($user_details);

    $sbq_gro="select * from " . $prev. "membership_plan where plan_id ='".$this->session->userdata['logged_in']["memtype"]."'";
    $sbrow_gro=$this->Site_model-> getcountRecods($sbq_gro);
    $mem_sell_offer = $sbrow_gro[0]["no_of_sell_offer"];

    //$mem_gro="select * from " . $prev. "offers where user_id ='".$_SESSION["user_id"]."' and approved ='yes' and expireson < NOW() ";

    $mem_gro="select * from " . $prev. "offers where user_id='".$this->session->userdata['logged_in']['user_id']."' and approved='yes' and expireson > NOW() ";
    $res=$this->Site_model-> getcountRecods($mem_gro);
    $sbsell_count=$res?count($this->Site_model-> getcountRecods($mem_gro)):0;

    if ($mem_sell_offer <= $sbsell_count )
    { ?>
        <div class="form-group">
            <label class="col-md-12 col-sm-12">  Posted - <font class='red'><?php echo $sbsell_count; ?></font>
                Maximum Allowed - <font class='red'><?php if($mem_sell_offer>10000){ echo "Unlimited";}else{ echo $mem_sell_offer.$_SESSION["memtype"];} ?></font>
            </label>
            <label class="col-md-12 col-sm-12">You Reached maximum limit of sell offer .Please Upgrade Your Membership plan  <span>*</span>
            </label>
        </div>
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

    }
    else
    {
        $count_p =$this->Site_model-> getcountRecods
        (" select * from ".$prev."products where approved='yes' and  uid =".$this->session->userdata['logged_in']['user_id']);
        $res=$count_p?count($count_p):0;
        //var_dump($count_p);
        if ($count_p == 0)
        { ?>
            <div class="form-group">
                <label class="col-md-3 col-sm-4">Please Add Product First <span>*</span></label>
                <a href="<?=base_url();?>post-product" >Click to Add Product</a>
            </div>
        <?php
        }
        else
        {
            ?>

            <form enctype="multipart/form-data" name="frmUser" id="formpostoffers" class="form-horizontal" method="post" action="">

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Choose Product: <font color="#FF0000">*</font></label>
                    <?php
                    //$res="select * from " . $prev. "products as p left join " . $prev. "offers as o ON o.prod_id=p.id where p.uid = '".$this->session->userdata['logged_in']['user_id']."' and p.approved='yes'";

                    $res = $this->Site_model-> getcountRecods(" SELECT * FROM  bt_products WHERE approved='yes' AND uid=".$this->session->userdata['logged_in']['user_id']."");
                    ?>

                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <select name="prod_id" onchange="prod_chng(this.value)" class="form-control  required" id='prod_id'>
                            <option  value="">Select Product</option>
                            <?php foreach ($res as $product_details) { ?>
                                <option value="<?=$product_details['id']; ?>" > <?=ucwords($product_details['title']);?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

      <span id="pricediv" style="display:none;">
       <div class="form-group">
           <label class="col-md-3 col-sm-4">Product Price:
           </label>
           <div class="col-md-9 col-sm-8 col-xs-12">
               <input type="text" name="price" id="priceid" class="form-control" value="" readonly>
           </div>
       </div>
   </span>

                <?php /*
    <div class="form-group">
      <label class="col-md-3 col-sm-4">Offer Price: <font color="#FF0000">*</font>
      </label>
      <div class="col-md-9 col-sm-8 col-xs-12">
          <input type="text" name="offer_price"  class="form-control">
      </div>
    </div>
    */?>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Offer Price: <font color="#FF0000">*</font></label>
                    <div class="col-sm-3 col-xs-12">
                        <select name="price_cur_id" class="form-control">
                            <option value="0">Select Currency</option>
                            <?php
                            $rs_query=$this->Site_model-> getcountRecods("Select * from " . $prev. "currencies where sbcur_status='1'" );
                            foreach($rs_query as $rs)
                            {
                                ?>
                                <option value="<?php echo $rs["sbcur_id"]; ?>"
                                    <?php //if( $rs["sbcur_id"]==$d['price_cur_id']){ echo "  selected "; }?> >
                                    <?php echo ' ('.$rs["sbcur_name"].')'; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <input name="offer_price" type="text" class="form-control" id="offer_price"  size="5" maxlength="30" placeholder="Enter Offer Price">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Product Offer Description:
                    </label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <textarea rows="5" name="description" class="form-control" placeholder="Enter Few Product Offer Description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Quantity: <font color="#FF0000">*</font>
                    </label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Keywords: <span>*</span>
                    </label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <input type="text" name="keywords"  class="form-control" placeholder="Enter Keywords" >
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Min Order: <font color="#FF0000">*</font>
                    </label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <input type="text" name="min_order"  class="form-control" placeholder="Enter Minimum Order">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4">Delivery Time: <font color="#FF0000">*</font>
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <input type="text" name="delivery_time"  class="form-control" placeholder="Enter Delivery Time">
                    </div>
                    <label class="col-md-3 col-sm-2">Days
                    </label>
                </div>

                <?php /*<div class="form-group">
        <label class="col-md-3 col-sm-4">Expires On: <span>*</span>
        </label>
        <div class="col-md-9 col-sm-8 col-xs-12">
            <input type="text" name="expireson"  class="datepicker" readonly="" >
        </div>
      </div> */?>

                <div class="form-group">
                    <label class="col-xs-3 col-sm-3">Expires On: <font color="#FF0000">*</font></label>
                    <div class="col-md-6 col-sm-6 col-xs-12 date">
                        <div class="input-group input-append date" id="datePicker">
                            <input type="text" name="expireson" id="expireson" readonly="" placeholder="Enter Expire date" class="datepicker form-control">


                            <?php /*?><input type="text" class="form-control" name="expireson" placeholder="Enter The Expired Date"/>
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span><?php */?>

                        </div>
                    </div>
                </div>

                <!--div class="input-group">
                    <label class="col-md-6 col-sm-4">Sell Offer Image</label>
                    <div class="col-md-6 col-sm-4">
                        <span class="btn btn-primary">
                            Browse&hellip; <input type="file"  name="fileToUpload" id="filesToUpload">
			</span>

		</div>
		< input type="text" class="form-control" style="border:0px;">
	</div>-->

                <div class="form-group">
                    <div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4 col-xs-12">
                        <input type="button" value="submit" class="btn btn-warning" onclick="formpostoffers()" name="sub">
                    </div>
                </div>
            </form>
        <?php
        } }
    ?>
</div>
</div>

</div></div></div>

</div>
</div>

</form>

</div>
</div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>
<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
<script>
    function  formpostoffers(){

        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#formpostoffers')[0]);

        $.ajax({
            url: base_url+"process_formpostoffers",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                //document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                //	window.location.href=base_url+"manage-sell-offers";
            },
            cache: false,
            contentType: false,
            processData: false
        });


    }

</script>
<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight:'TRUE',
        startDate: '-0d',
        autoclose: true,
    })
</script>

<script>
    function prod_chng(prodid){
        $.ajax({
            url: "<?php echo base_url();?>prod_price/"+prodid,
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




</script>


<script type="text/javascript">
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
                        prod_id: {
                            validators: {
                                notEmpty: {
                                    // prod_id: "required"
                                    message: 'Product field is required'
                                }
                            }
                        }
                        ,



                        offer_price: {
                            validators: {
                                notEmpty: {
                                    message: 'Product field is required'
                                }

                            }
                        }
                        ,
                        quantity: {
                            validators: {
                                notEmpty: {
                                    message: 'Quantity field is required'
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
                                ,
                            }
                        }
                        ,
                    }

                }
            );



        }
    );


</script>
</body>
</html>
