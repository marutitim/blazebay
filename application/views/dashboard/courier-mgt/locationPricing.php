<?php

$title = "Location Pricing";

if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

$prev="bt_";









if(isset($_POST['sub']))   //IF SOME FORM WAS POSTED DO VALIDATION

{





    // if(isset($_FILES['image'])){

    //     $errors= array();

    //     $file_name = $_FILES['image']['name'];

    //     $file_size =$_FILES['image']['size'];

    //     $file_tmp =$_FILES['image']['tmp_name'];

    //     $file_type=$_FILES['image']['type'];

    //     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));



    //     $expensions= array("jpeg","jpg","png");



    //     if(in_array($file_ext,$expensions)=== false){

    //        $errors[]="extension not allowed, please choose a JPEG or PNG file.";

    //     }



    //     if($file_size > 2097152){

    //        $errors[]='File size must be excately 2 MB';

    //     }



    //     if(empty($errors)==true){

    //        move_uploaded_file($file_tmp,"company_banner/".$file_name);

    //        //echo "Success";

    //     }else{

    //        //print_r($errors);

    //     }

    //  }



    $allow = array("jpg", "jpeg", "gif", "png");

    $todir = base_url().'assets/company_banner/';



    //move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"banners/".$_FILES["fileToUpload"]["name"]);

    //move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"company_banner/".$_FILES['fileToUpload']['name']);

    //echo "Success";

    //print_r($todir);exit;



    /* if ( !!$_FILES['fileToUpload']['tmp_name'] ) // is the file uploaded yet?

     {

       $info = explode('.', strtolower( $_FILES['fileToUpload']['name']) ); // whats the extension of the file



       if ( in_array( end($info), $allow) ) // is this file allowed

       {

         if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $todir . basename($_FILES['fileToUpload']['name'] ) ) )

         {

         //echo "success";

           //echo = "the file has been moved correctly";

         }

       }

       else

       {

       //echo "failure";

         //echo = "error this file ext is not allowed";

       }

     }

   $images = $_FILES["fileToUpload"]["name"] ;



  $uid=$_SESSION['user_id'];

     $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$uid;

     $c_id_1 = mysql_query($c_id);

     $c_id_2 = mysql_fetch_array($c_id_1);



     $update_query = "update `bt_business` set `banner_images`='".$images."' where `id`='".$c_id_2['id']."'";

    $r =  mysql_query($update_query);

*/



    if ($_FILES['fileToUpload']['tmp_name'] ) // is the file uploaded yet?

    {

        $info = explode('.', strtolower( $_FILES['fileToUpload']['name']) ); // whats the extension of the file



        if ( in_array( end($info), $allow) ) // is this file allowed

        {

            if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $todir . basename($_FILES['fileToUpload']['name'] ) ) )

            {

                $images = $_FILES["fileToUpload"]["name"] ;



                $uid=$_SESSION['user_id'];

                $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$uid;

                $c_id_1 = mysql_query($c_id);

                $c_id_2 = mysql_fetch_array($c_id_1);



                $update_query = "update `bt_business` set `banner_images`='".$images."' where `id`='".$c_id_2['id']."'";

                $r =  mysql_query($update_query);

            }

        }



    }else

    {

        $r = 0;

    }







    // if($_FILES[gallary_image][name]!="")

    // {



    //   $allowed_ext=array("jpg","jpeg","png","gif");



    //   $extension=explode('.',$_FILES["gallary_image"]["name"]);



    //   $ext=strtolower(end($extension));



    //   if(in_array($ext,$allowed_ext))

    //   {



    //    $newname=rand(10000,99999)."_".time().".".$ext;

    //    $loc="company_banner/".$newname;

    //    move_uploaded_file($_FILES["gallary_image"]["tmp_name"],"".$loc);



    //    $uid=$_SESSION['user_id'];

    //    $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$uid;

    //    $c_id_1 = mysql_query($c_id);

    //    $c_id_2 = mysql_fetch_array($c_id_1);



    //    $update_query = "update `bt_business` set `banner_images`='".$newname ."' where `id`='".$c_id_2['id']."'";

    //   $r =  mysql_query($update_query);

    //   }



    // }













//echo $update_query;



// $r = mysql_query($update_query);



//$new_user_id = mysql_insert_id();

    if($r){

        $_SESSION['after_post_msg'] = "Banner Successfully added".$images;

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

            <a href="<?php echo base_url();?>addlocation"  class="btn btn-warning float-right" >Add location</a><br>

            <div > <h3 class="section-title">Manage  Location Pricing</h3></div>

            <div id="msgReplies"></div>


            <?php
            $sbq_off = "select * from bt_location_pricing  where uid='" . $this->session->userdata['logged_in']['user_id'] . "' ORDER BY id DESC";
            $sbrs_offr = $this->Site_model->getcountRecods($sbq_off);
                ?>

                                <table class="table table-hover table-striped" id="data-table">
                                    <thead>
                                    <tr>
                                        <td >Start</td>
                                        <td  >End</td>

                                        <td  >Weight</td>
                                        <td  >Volume</td>
                                        <td  >Price</td>
                                        <td  >Duration(Days)</td>
                                        <td  >Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cnt=0;
                                    foreach ($sbrs_offr as $key=> $sbrow_off)
                                    {
                                        ?>
                                        <tr>

                                           <?php
                                            $source = "select country_name from bt_countries  where country_id='" . $sbrow_off["source"] . "'";
                                            $sourcercou = $this->Site_model->getcountRecods($source);

                                            $source = "select state_name,state_id from  bt_states  where state_id='" . $sbrow_off["source_state"] . "'";
                                            $sourcers = $this->Site_model->getcountRecods($source);

                                            $sourcer = "select city_name,city_id from  bt_cities  where `city_id`='" . $sbrow_off["source_city"] . "'";
                                            $sourcerc= $this->Site_model->getcountRecods($sourcer);
                                            ?>

                                            <td><?php echo $sourcerc[0]["city_name"]?$sourcerc[0]["city_name"]:$sourcers[0]["state_name"];?><?php echo ','.' '.$sourcercou[0]["country_name"]; ?></td>
                                            <?php
                                            $destr = "select country_name from bt_countries  where country_id='" . $sbrow_off["destination"] . "'";
                                            $destrcou = $this->Site_model->getcountRecods($destr);

                                            $dest = "select state_name,state_id from  bt_states  where state_id='" . $sbrow_off["dest_state"] . "'";
                                            $destrs = $this->Site_model->getcountRecods($dest);

                                            $dest = "select city_name,city_id from  bt_cities  where `city_id`='" . $sbrow_off["dest_city"] . "'";
                                            $destrc = $this->Site_model->getcountRecods($dest);
                                            ?>
                                            <td><?php echo $destrc[0]["city_name"]?$destrc[0]["city_name"]:$destrs[0]["state_name"];?><?php echo ','.' '.$destrcou[0]["country_name"]; ?></td>

                                            <td><?php
                                                echo  $sbrow_off["min_weight"].'-'. $sbrow_off["max_weight"]; ?></td>
                                            <td><?php
                                                echo $sbrow_off["min_volume"].'-'.$sbrow_off["max_volume"]; ?></td>
                                            <td><?php
                                                $qry = "select sbcur_name from bt_currencies  where sbcur_id='" . $sbrow_off["currency"] . "'";
                                                $res = $this->Site_model->getcountRecods($qry);
                                                echo $res[0]["sbcur_name"].' '.$sbrow_off["price"]; ?></td>
                                            <td><?php
                                                echo $sbrow_off["duration"]; ?></td>

                                            <td valign="top" ><a href="<?php echo base_url(); ?>edit-location-pricing/<?php echo $sbrow_off["id"]; ?>">Edit</a></td>
                                        </tr>
                                    <?php
                                    }?>
                                    </tbody>
                                </table>





        </div>




</div>
</div>
</div>

</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>

<link href="https://www.blazebay.com/datepicker/datepicker.css" rel="stylesheet" />
<script src="https://www.blazebay.com/datepicker/bootstrap-datepicker.js"></script>
<script>
    function removeRoute(){



        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this  route",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var baseUrl         = "<?php echo base_url();?>";
                    var Url         =  baseUrl+"delete_reoute";
                    var checkedValues=$('.activecheck:checkbox:checked');

                    $.post(Url,checkedValues, function(data){

                        if(data==1){
                            swal("success!", "The route has been deleted.", "success");
                            // location.reload();
                        }else{
                            swal("Error!", "Something went wrong", "error");
                        }
                    });


                } else {
                    swal("Cancelled", "The  route is safe :)", "error");
                }
            }
        );

    }

</script>
</body>
</html>
