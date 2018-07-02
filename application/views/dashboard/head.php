<?php
function RemoveBadURLChars($str) {
    return mb_strtoupper(preg_replace("/[^0-9a-zA-Z]+/", "-", $str));
}
$orderNo=2;

?>
<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/blue.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/rateit.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-select.min.css">


<link rel="stylesheet" href="<?php echo base_url();?>assets2/plugins/morris/morris.css">



<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


<!-- DASHBOARD CSS AND JS - START -->

<link href="<?php echo base_url();?>assets2/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets2/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets2/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets2/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets2/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets2/css/responsive.css" rel="stylesheet" type="text/css" />



<script src="<?php echo base_url();?>assets2/js/modernizr.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<script src="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<style>
    .productImages {
        max-width:50px !important;
        max-height:50px !important;
        min-width:50px !important;
        min-height:50px !important;

    }
    body.swal2-shown { overflow-y: none !important; }
    .searchtoggle{
        background:transparent !important;
    }
    body .ui-autocomplete {
        font-family to all
    background:#f6f6f6 !important;
    }
    .ui-menu .ui-menu-item a.ui-state-hover,
    .ui-menu .ui-menu-item a.ui-state-active {
        background:#f6f6f6 !important;
    }

    body .ui-autocomplete .ui-menu-item .ui-state-focus {
        background:#f6f6f6 !important;
    }
    .search-title-results{
        font-family: Montserrat;
        text-transform: capitalize !important;
        font-weight: bold;
        margin-left: 3%;

    }
    .unit-measure {
        color: #d3d3d3;
        font-weight: 400;
        line-height: 30px;
        font-size: 14px;
    }
    body {
        font-family: Montserrat !important;

    }
    .newproductImages {
        max-width:200px !important;
        max-height:200px !important;
        min-width:200px !important;
        min-height:200px !important;

    }
    .side-menu {
       margin-left: 0px !important;

    }
    .content-page .content {
        padding: 0px !important;

    }
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        cursor: not-allowed;
        background-color: #eee;
        opacity: 1;
        margin-bottom: 10px !important;
    }
    .form-control {
        width: 100% !important;
        margin-bottom: 10px;
    }
</style>

<?php include( APPPATH.'/views/layout/head.php'); ?>
<!-- DASHBOARD CSS AND JS - END -->