
<?php
$languange=$this->session->userdata['site_lang']?$this->session->userdata['site_lang']:'English';
function RemoveBadURLCharaters($str) {
    return preg_replace("/[^0-9a-zA-Z]+/", "-", ucfirst(strtolower($str)));
}
function random_gen($length){

    $random= "";

    $char_list = "ABCDEFGHJKLMNPQRSTUVWXYZ";
    $char_list .= "23456789";
    $char_list .= dechex(round(microtime(TRUE)));
    for($i = 0; $i < $length; $i++) {

        $random .= substr($char_list,(rand()%(strlen($char_list))), 1);

    }

    return $random;

}
$rnum =random_gen(7);
$c_pay_number = strtoupper('B'.$rnum);
$currencyRate=$this->session->userdata['currencyConvertion']['convertAmount']?$this->session->userdata['currencyConvertion']['convertAmount']:100.85;
$currencySymbol=$this->session->userdata['currencyConvertion']['convertSymbol']?$this->session->userdata['currencyConvertion']['convertSymbol']:'KSH';
?>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="Timothy Maruti">

<title><?php echo $title;?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>/assets/logo/FAV_8521497874673.png" />
<meta name="keywords" content="Blazebay Wholesale,Bulk,blazebay,online shopping,Ecommerce, blazebay, m.blazebay, blazebay,smart phones, online shopping,
 clothes, bag, hair, laptop, home, shoes, smart watch, phones, hair, handbags, product reviews, blazebay" />
<meta name="description" content="Blazebay is the best  Online Shopping platform for all quality ,affordable Wholesale/bulk  products for smart-phones, electronics,fashion,
	shoes, home and living, TV ,Home appliances and Furniture|Contact supplier and Order start ordering" />

<meta name="robots" content="all">

<!-- facebook -->
<meta property="og:site_name" content="<?=$title?$title:'Blazebay International Ltd'?>">
<meta property="og:url" content="<?=$url?$url:'https://blazebay.com'?>">
<meta property="og:title" content="<?=$title?$title:'Blazebay'?>">
<meta property="og:image" content="<?=$image?$image:base_url().'/assets/logo/FAV_8521497874673.png'?>">
<meta property="og:image:url" content="<?=$image?$image:base_url().'/assets/logo/FAV_8521497874673.png'?>" />
<meta property="og:description" content="Blazebay is the largest e-commerce platform in Africa offering a wholesale market
with thousands of different products globally. Blazebay is a platform that has opened up the African e-commerce market
 to the rest of the world since its inception in 2015.Blazebay  offers the best price on smartphones, electronics,dress,shirt,
 shoes, home and living, TV  ,Home appliances and Furniture,Contact supplier and Order Now">


<meta property="og:type" content="product">


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
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<script src="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/noty/lib/noty.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/noty/lib/themes/mint.css">
<link rel="stylesheet" href="<?=base_url()?>assets2/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://blazebay.com/assets/css/font-awesome.css">
<!-- Icons/Glyphs -->
<link rel="stylesheet" href="https://www.blazebay.com/assets/css/font-awesome.css">



<!-- Fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<style>
    .content-page {
        background-color: aliceblue !important;
    }
    .product .cart {
        left: 29%; !important;
    }
    hr.style9 {
        border-top: 1px dashed #8c8b8b;
        border-bottom: 1px dashed #fff;
        border-width: 1px 0 0 0;
        border-radius: 20px;
    }
    @media only screen and (min-width: 800px) {
        .newproductImages {
            max-width:200px !important;
            max-height:200px !important;
            min-width:200px !important;
            min-height:200px !important;

        }
        #wrapper{
            display: none;
        }
    }
    @media only screen and (max-width: 800px) {
        .newproductImages {
            max-width:120px !important;
            max-height:120px !important;
            min-width:120px !important;
            min-height:120px !important;

        }
        .slider-bottom-mobile {
            margin-top: 30px;
        }
        .img-responsive-mobile{
            height: 180px !important;
        }

    }

    .tradesecurity {
        max-width:300px !important;
        max-height:300px !important;
        min-width:300px !important;
        min-height:300px !important;

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
    .mce-flow-layout-item.mce-last {
        margin-right: 2px;
        display: none !important;
    }

</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117115629-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-117115629-1');
</script>
<script type="text/javascript">
//    if (screen.width <= 800) {
//        window.location.href="https://m.blazebay.com/";
//    }
</script>

<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="https://v2.zopim.com/?5orRA4VYvtL2ebreH4iNzqHzdD5HkAGe";z.t=+new Date;$.
            type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
