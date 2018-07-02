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

    <link rel="stylesheet" href="<?=base_url()?>assets2/plugins/morris/morris.css">

    <?php include( 'head.php'); ?>


    <!-- DASHBOARD CSS AND JS - END -->

</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <?php include('header.php'); ?>

</header>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
<div class="container">
<div class="clearfix filters-container m-t-10">
    <!-- Button mobile view to collapse sidebar menu -->
    <?php include('breadcrum.php'); ?>
</div>
<!-- Top Bar End -->

<!-- ========== Left Sidebar Start ========== -->
<div class="">
<div class="left side-menu">
<div class="sidebar-inner slimscrollleft">



    <?php include 'myaccount/profile.php'; ?>
<!--- Sidemenu -->
<?php include 'side-menu.php'; ?>
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

    <?php include 'contents.php'; ?>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include 'footer.php'; ?>
<!--Morris Chart-->
<script src="<?=base_url()?>assets2/plugins/morris/morris.min.js"></script>
<script src="<?=base_url()?>assets2/plugins/raphael/raphael-min.js"></script>
</body>
</html>
		