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
<div class="containerr">
    <div class="col-md-12">

        <div class="featuredpro text-center">
            <h3 class="section-title"> <a href="#"> Change Password  </a></h3>
            <?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i> <a href="change-password"> Change Password </a> </h2><?php */?>
            <div class="b2b">
                <div id="mid_side" style='padding-top:6px'>
                    <?php
                    //include "logincheck.php";
                    $errcnt=0;

                    if(count($_POST) <> 0)
                    {
                        if(!get_magic_quotes_gpc())
                        {
                            $sbcurrent_pwd=str_replace("$","\$",addslashes($_REQUEST["sbcurrent_pwd"]));
                            $sbnew_pwd=str_replace("$","\$",addslashes($_REQUEST["sbnew_pwd"]));
                            $sbre_pwd=str_replace("$","\$",addslashes($_REQUEST["sbre_pwd"]));
                        }
                        else
                        {
                            $sbcurrent_pwd=str_replace("$","\$",$_REQUEST["sbcurrent_pwd"]);
                            $sbnew_pwd=str_replace("$","\$",$_REQUEST["sbnew_pwd"]);
                            $sbre_pwd=str_replace("$","\$",$_REQUEST["sbre_pwd"]);
                        }
                        /*if(strlen(trim($_REQUEST["sbcurrent_pwd"])) == 0 )
                        {
                            $errs[$errcnt]="Please specify Current Password.";
                               $errcnt++;
                        }
                        else
                        {
                            $rs0=mysql_fetch_array(mysql_query("Select * from " . $prev. "members
                            where user_id=".$_SESSION['user_id']. " and password='".md5($sbcurrent_pwd)."'"));

                            /*echo "Select * from " . $prev. "members
                            where user_id=".$_SESSION['user_id']. " and password='".md5($sbcurrent_pwd)."'"; die;*/

                        /*	$curentpwd = md5($_REQUEST["sbcurrent_pwd"]);
                            if (!($rs0["password"] === $curentpwd))
                            {
                            $errs[$errcnt]="Password COULD NOT be changed because old password was incorrect.";
                               $errcnt++;
                            }
                        }
                        /*if(strlen(trim($_REQUEST["sbnew_pwd"])) == 0 )
                        {
                            $errs[$errcnt]="Please specify New Password.";
                               $errcnt++;
                        }
                        if($sbnew_pwd<>$sbre_pwd)
                        {
                            $errs[$errcnt]="Retyped Password does not match to the New Password";
                               $errcnt++;
                        } */

                        //if($errcnt==0)
                        //{
                        $sbnew_pwd = md5($_REQUEST["sbnew_pwd"]);
                        mysql_query("Update " . $prev. "members SET password='$sbnew_pwd' where user_id=".$_SESSION['user_id']);
                        //echo "Update " . $prev. "members SET password='$sbnew_pwd' where user_id=".$_SESSION['user_id']; die;
                        if(mysql_affected_rows()>0)
                        {
                            $msg = "Password has been changed successfully";
                            $_SESSION['after_post_msg'] = "Password has been changed successfully";
                            //header("Location: ?mode=personal_confirm_mem&errmsg=".urlencode("Password has been changed"));
                            //die();
                        }
                        else
                        {
                            $_SESSION['after_post_msg'] = "Password has been changed successfully";
                            //header("Location: personal_confirm_mem.php?err=changepassword&errmsg=".urlencode("Sorry, some error occurred and unable to change the password."));
                            //die();
                        }

                        //}
                    }

                    function main()
                    {
                        global $prev,$db;
                        global $errs, $errcnt;
                        if  (count($_POST)>0)
                        {

                            if ( $errcnt<>0 )
                            {
                                ?>
                                <div id="b2b_right">
                                    <div class="b2b_right_all">
                                        <div id="b2b_right_top">
                                            <strong></strong>
                                        </div>
                                        <div id="b2b_right_body">
                                            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
                                                <tr>
                                                    <td colspan="2"><strong>&nbsp;Your Request cannot be processed due
                                                            to following Reasons</strong></td>
                                                </tr>
                                                <tr height="10">
                                                    <td colspan="2"></td>
                                                </tr>
                                                <?php

                                                for ($i=0;$i<$errcnt;$i++)
                                                {
                                                    ?>
                                                    <tr valign="top">
                                                        <td width="6%">&nbsp;<?php echo $i+1;?></td>
                                                        <td width="94%"><?php echo  $errs[$i]; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                        <div id="b2b_right_btm"></div>
                                    </div>
                                </div>
                            <?php

                            }

                        }
                        ?>
                        <div id="b2b_right">
                            <div class="b2b_right_all text-center">

                                <div id="b2b_right_body">
                                    <div id="msgReplies"></div>
                                    <form enctype="multipart/form-data" name="changePassword" id="changePassword" class="form-horizontal" method="post" action="#">


                                        <div class="form-group">
                                            <div class="col-sm-6 col-xs-12">
                                                <label class="control-label" for="recipient-name">Current Password : <font color="#FF0000">*</font> </label>
                                                <input name="sbcurrent_pwd" class="form-control" type="password" id="currpassword2" value="">
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="col-sm-6 col-xs-12">
                                                <label class="control-label" for="recipient-name">New Password : <font color="#FF0000">*</font> </label>
                                                <input name="sbnew_pwd" class="form-control" type="password" id="newpassword2">(Password length should be greater than 5, it should consist minimum an alphabetical character and a number)
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="col-sm-6 col-xs-12">
                                                <label class="control-label" for="recipient-name">Confirm Password : <font color="#FF0000">*</font> </label>
                                                <input name="con_pwd" class="form-control" type="password" id="con_pwd">
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <div class="col-sm-6 col-xs-12">
                                                <input type="button" name="Submit2" value="Change Password" onclick="change_pwd();" class="btn btn-primary btn-big">
                                            </div>


                                        </div>
                                    </form>
                                </div>
                                <div id="b2b_right_btm"></div>
                            </div>
                        </div>
                    <?php
                    } main();

                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
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
    function change_pwd(){
        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#changePassword')[0]);

        $.ajax({
            url: base_url+"process_change_password",
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

        e.preventDefault();

    }
    $(document).ready(function () {
        $("#frmUser").formValidation({

            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }
            ,
            fields: {
                sbcurrent_pwd: {
                    validators: {
                        notEmpty: {
                            message: 'Current password field is required'
                        },
                        regexp: {
                            regexp: /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/i,
                            message: 'The password should consist of alphabetical characters and numbers only'
                        },
                        remote: {
                            message: 'This is not a current password',
                            url: '<?php echo base_url(); ?>ajax_newpass.php',
                            type: 'POST'
                        }

                    }
                }
                ,

                sbnew_pwd: {
                    validators: {
                        notEmpty: {
                            message: 'New password field is required'
                        },
                        regexp: {
                            regexp: /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/i,
                            message: 'The password should consist of alphabetical characters and numbers only'
                        }
                    }
                }
                ,
                sbre_pwd: {
                    validators: {
                        notEmpty: {
                            message: 'Please retype password'
                        },
                        regexp: {
                            regexp: /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/i,
                            message: 'The password should consist of alphabetical characters and numbers only'
                        }
                        ,
                        identical: {
                            field: 'sbnew_pwd',
                            message: 'The "New Password" and "Confirm Password" fields are not the same'
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


</body>
</html>
		