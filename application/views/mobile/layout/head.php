<?php
$languange=$this->session->userdata['site_lang']?$this->session->userdata['site_lang']:'English';
function RemoveBadURLCharaters($str) {
    return preg_replace("/[^0-9a-zA-Z]+/", "-", ucfirst(strtolower($str)));
}

function wordtrimer($string, $count){
    $original_string = $string;
    $words = explode(' ', $original_string);

    if (count($words) > $count){
        $words = array_slice($words, 0, $count);
        $string = implode(' ', $words);
    }

    return $string;
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
<title><?=$title?></title>
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

<meta property="og:description" content="Blazebay is the largest e-commerce platform in Africa offering a wholesale market
with thousands of different products globally. Blazebay is a platform that has opened up the African e-commerce market
 to the rest of the world since its inception in 2015.Blazebay  offers the best price on smartphones, electronics,dress,shirt,
 shoes, home and living, TV  ,Home appliances and Furniture,Contact supplier and Order Now">


<meta property="og:type" content="product">
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="x-ua-compatible">
<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="yes" name="apple-touch-fullscreen">
<script src="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">
<link rel="stylesheet" href="<?php echo base_url();?>assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/noty/lib/noty.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/noty/lib/themes/mint.css">
<link rel="stylesheet" href="<?=base_url()?>assets2/datatables.net-bs/css/dataTables.bootstrap.min.css">

<?php
if ($this->agent->is_mobile('iphone'))
{
    ?>
    <style>

        .newproductImages {
            max-width: 100px !important;
            max-height: 100px !important;
            min-width: 100px !important;
            min-height: 100px !important;
            padding: 10px;
            margin-top: 30px;
            margin-left: 30px !important;
        }
        .iphone{
            width:180px !important;
        }
    </style>
<?php
}
elseif ($this->agent->is_mobile())
{
    ?>
    <style>

        .newproductImages {
            max-width:150px !important;
            max-height:150px !important;
            min-width:150px !important;
            min-height:150px !important;
            padding: 30px;
            margin-left: 10px;

        }

    </style>
<?php
}
?>
<style>
  .blazecolor{
      background-color: #2c5fb2 !important;
  }

  .blazecolor2{
      background-color: #c05a05 !important;
  }
    .ui-widget.ui-widget-content {
        border: 1px solid #c5c5c5;
        z-index: 100000;
    }
    body .ui-autocomplete {
        font-family: Montserrat;
        background: #f6f6f6 !important;
    }
    .ui-widget-content a {
        color: #333333;
        text-decoration: none !important;
    }

</style>
<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="https://v2.zopim.com/?5orRA4VYvtL2ebreH4iNzqHzdD5HkAGe";z.t=+new Date;$.
            type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->