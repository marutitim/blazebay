<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php
    include(APPPATH.'/views/mobile/layout/head.php'); ?>
    <style>
        .product-share a.whatsup {
            background: #25d366;
        }
        .fa-twitter:before {
            content: "\f099";
        }
    </style>
</head>

<body>

<div id="main">

    <!-- LEFT SIDEBAR -->
    <div id="slide-out-left" class="side-nav">

        <!-- Form Search -->
        <div class="top-left-nav">
            <?php include(APPPATH.'/views/mobile/layout/search.php'); ?>
        </div>
        <!-- End Form Search -->

        <!-- App/Site Menu -->
        <div id="main-menu">
            <?php include(APPPATH.'/views/mobile/layout/nav.php'); ?>

        </div>



        <!-- End Site/App Menu -->

    </div>
    <!-- END LEFT SIDEBAR -->

    <!-- RIGHT SIDEBAR -->
    <div id="slide-out-right" class="side-nav">

        <?php include(APPPATH.'/views/mobile/layout/compare-blogs.php'); ?>

    </div>
    <!-- END RIGHT SIDEBAR -->

    <!-- MAIN PAGE -->
    <div id="page">

        <!-- FIXED Top Navbar -->
        <div class="top-navbar">
            <?php include(APPPATH.'/views/mobile/layout/top.php'); ?>
        </div>
        <!-- End FIXED Top Navbar -->





        <!-- CONTENT CONTAINER -->
        <div class="content-container">

        <!-- Product Header -->
        <div class="content-header">

            <div class="breadcrumbs animated fadeIn"><!-- Product breadcrumb -->
                <?php include(APPPATH.'/views/mobile/layout/breadcrum.php'); ?>
            </div><!-- End Product breadcrumb -->

            <h2 class="product-title animated fadeIn"><?=$productDetails[0]['title']?></h2><!-- Product title -->

            <!-- Product thumbnail slider -->
            <!-- Product thumbnail slider -->
            <ul class="product-slider animated fadeInRight"><!-- Single thumbnail -->

                <?php

                $defaultImage="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image'];

                if(isset($offerType) && $offerType=='Buyoffer'){
                    $defaultImage="https://www.blazebay.com/assets/uploadedimages/buyoffer/".$productDetails[0]['image'];

                }else{
                    $defaultImage="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]['image'];
                }?>
                <li>
                    <a class="fullscreen-icon swipebox" href="<?=$defaultImage?>" title="<?=$productDetails[0]['title']?>">
                        <i class="fa fa-expand"></i>
                    </a>
                    <img src="<?=$defaultImage?>" alt="<?=$productDetails[0]['title']?>" />
                </li>

                <?php
                if(!empty($productImages)) {
                    foreach ($productImages as $key => $images) {
                        if(file_exists("assets/multimage/" . $images['img_url'])){
                        $imageLink = "https://www.blazebay.com/assets/multimage/" . $images['img_url'];
                        ?>
                        <li>
                            <a class="fullscreen-icon swipebox" href="<?= $imageLink ?>"
                               title="<?= ucfirst(strtolower($productDetails[0]['title'])) ?>">
                                <i class="fa fa-expand"></i>
                            </a>
                            <img src="<?= $imageLink ?>" alt="<?= ucfirst(strtolower($productDetails[0]['title'])) ?>"/>
                        </li>
                    <?php
                    }}
                } ?>
            </ul><!-- End single thumbnail -->
            <div class="slick-thumbs"><!-- Small thumb indicator -->
                <ul>
                    <li>
                        <img src="<?=$defaultImage?>" alt="<?=$productDetails[0]['title']?>" />
                    </li>

                    <?php
                    if(!empty($productImages)) {
                        foreach ($productImages as $key => $images) {
                            if (file_exists("assets/multimage/" . $images['img_url'])) {
                                $imageLink = "https://www.blazebay.com/assets/multimage/" . $images['img_url'];
                                ?>
                                <li>
                                    <img src="<?= $imageLink ?>"
                                         alt="<?= ucfirst(strtolower($productDetails[0]['title'])) ?>"/>
                                </li>
                            <?php
                            }
                        }
                    }?>
                </ul>
            </div><!-- End small thumb indicator -->
            <!-- End Product thumbnail slider -->



            <!-- End Product thumbnail slider -->

            <!-- You can also use static thumbnail (without slider) via HTML tag below
            ---------------------------------------------------
            <div class="big-thumb">
                <img src="images/1.jpg" alt="">
            </div>
            -------------------------------------------------
            -->

            <!-- Product meta -->
            <div class="product-meta animated fadeInUp">
                <div class="rating">
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <?php
                if(!empty($productDetails[0]['city']) && !empty($productDetails[0]['country'])) {
                    $city = $productDetails[0]['city'];
                    $where = "city_id =$city";
                    $cityData = $this->Site_model->getDataById("bt_cities", $where);

                    $country = $productDetails[0]['country'];
                    $where = "country_id =$country";
                    $countryData = $this->Site_model->getDataById("bt_countries", $where);
                    ?>
                    <b>Location:</b>&nbsp;&nbsp;<?=$cityData[0]['city_name']?> , <?=$countryData[0]['country_name']?><br/>
                <?php
                }
                ?>
                <b>Supplier ability:&nbsp;&nbsp;</b><?=$productDetails[0]['quantity']?><br/>
                <b>Min. Order:</b>&nbsp;&nbsp; <?=$productDetails[0]['min_order']?>
                <?php
                $unit_id        = $productDetails[0]['qty_unit'];
                $unit="";
                if($unit_id){
                    $where= "unit_id =$unit_id";

                    $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                    $unit        = $get_units[0]['unit_name'];
                }
                ?>
                <div class="price"><?= $currencySymbol ?>. <?= number_format(number_format((float)$productDetails[0]['price'] * $currencyRate, 2, '.', ''));?>
                    <?=$unit?>
                </div>
                <!-- Beside .in-stock class, you can also use .out-of-stock class -->
                <div class="availability in-stock">
                    In Stock
                </div>
            </div>
            <!-- End Product meta -->

        </div>
        <!-- End Product Header -->

        <!-- Product tabs -->
        <div class="product-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#detail">Detail</a></li>
                <li class="tab"><a href="#review">Review</a></li>
                <li class="tab"><a href="#company">Company details</a></li>
            </ul>
        </div>
        <!-- End Product tabs -->

        <!-- Product content -->
        <div class="product-content">

            <!-- Product detail tabs -->
            <div class="tab-content" id="detail">
                <p><?=html_entity_decode($productDetails[0]['description'])?></p>
            </div>
            <!-- End Product detail tabs -->

            <!-- Product review list tabs -->
            <div class="tab-content" id="review">

                <ol class="product-review-list">
                    <li>
                        <div class="review-idty">
                            <div class="name">
                                Blazebay Customer
                            </div>
                            <div class="product-rating">
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <div class="review-ctn">
                            awesome product
                        </div>
                    </li>
                    <li>
                        <div class="review-idty">
                            <div class="name">
                                BlazeBay customer
                            </div>
                            <div class="product-rating">
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <div class="review-ctn">
                            The product has come softly, thank you.
                        </div>
                    </li>
                </ol>
            </div>
            <!-- End Product review list tabs -->
            <div class="tab-content" id="company">
                <table class="product-details">
                    <?php
                    $business_details=$productDetails[0];
                    if(!empty($business_details['company_name']) ){ ?>
                        <tr>
                            <td><b>Company</b>&nbsp;&nbsp;</td>
                            <td >
                                <?php
                                if(!empty($business_details['company_name']) ){echo ucwords($business_details['company_name']);}
                                else{ echo "N/A"; }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['services']) ){ ?>
                        <tr>
                            <td><b>Services</b></td>
                            <td><?php
                                if(!empty($business_details['services']) ){echo ucwords($business_details['services']);}
                                else{ echo "N/A"; }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['website']) ){ ?>
                        <tr>
                            <td><b>Website</b></td>
                            <td>
                                <?php
                                if(!empty($business_details['website']) ){echo ucwords($business_details['website']);}
                                else{ echo "N/A"; }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php if(!empty($business_details['address1']) ){ ?>
                        <tr>
                            <td><b>Address</b></td>
                            <td><?php
                                if(!empty($business_details['address1']) ){echo $business_details['address1'];}
                                else{ echo "N/A"; }
                                ?></td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['location']) ){ ?>
                        <tr>
                            <td><b>Location </b></td>
                            <td><?php
                                if(!empty($business_details['location']) ){echo ucwords($business_details['location']);}
                                else{ echo "N/A"; }
                                ?></td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($business_details['year_established']) ){ ?>
                        <tr>
                            <td><b>Year Of Establishment:</b>  </td>
                            <td><?php
                                if(!empty($business_details['year_established']) ){echo ucwords($business_details['year_established']);}
                                else{ echo "N/A"; }
                                ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <hr class="style9">
                <?php if(!empty($business_details['about']) ){ ?>
                    <div   style="background-color: aliceblue !important">
                        <b>Overview</b>
                        <p>
                            <?php
                            if(!empty($business_details['about']) ){echo strip_tags(html_entity_decode($business_details['about']));}
                            else{ echo $business_details['product_company_name']; }
                            ?>
                        </p>

                    </div>
                <?php } ?>
            </div>

        </div>
        <!-- End Product content -->

        <!-- Product navigation -->
        <div class="product-action margin-bottom">
            <input type="hidden"  class="form-control" style="width: 100px;"  id="itemp_qty" min="<?=$productDetails[0]['min_order']?>" value="<?=$productDetails[0]['min_order']?>"
                   max="1000000"    value="<?=$productDetails[0]['min_order']; ?>">
            <?php if($producttype=='wholesale'||$productDetails[0]['wholesale']==1) {?>
                <a href="#"  class="btn  btn-block  blazecolor margin-bottom_low" onclick="return makeOrder('<?=$productId;?>')"><i class="fa fa-shopping-cart inner-right-vs"></i> Start Ordering</a>
            <?php } ?>
            <a href="#"   class="btn  blazecolor2 btn-block" onclick="return contactSupplier('<?=$productId;?>')" ><i class="fa fa-envelope inner-right-vs"></i> Contact Supplier</a>

        </div>
        <!-- End Product navigation -->

        <!-- Product share -->
        <div class="product-share">
            <?php
            $actual_link ="https://www.blazebay.com/".$_SERVER['REQUEST_URI'];
            ?>
            <a href="whatsapp://send?text=<?=$actual_link?>" data-action="share/whatsapp/share"  target="_blank" class="whatsup"><i class="fa fa-whatsapp"></i></a>
            <a href="https://facebook.com/sharer.php?u=<?=$actual_link?>"  target="_blank" class="fb"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?=$actual_link?>" target="_blank" class="tw"><i class="fa fa-twitter"></i></a>
            <a href="https://plus.google.com/share?url=<?=$actual_link?>" target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a>
            <a href="http://pinterest.com/pin/create/button/?url="<?=$actual_link?> target="_blank" class="pint"><i class="fa fa-pinterest"></i></a>
        </div>


        <!-- End Product share -->

        <div class="line"></div>

        <!-- Related product section -->
        <div class="page-block">

            <h2 class="block-title">
                <span>Products You may like also</span>
            </h2>

            <ol class="product-list-slider">

                <?php include(APPPATH.'/views/mobile/products/upsell-products.php'); ?>
            </ol>

            <div class="clear"></div><!-- Use this class (.clear) to clearing float -->

        </div>
        <!-- End Related product section -->

        </div>

        <!-- END CONTENT CONTAINER -->


        <!-- FOOTER -->
        <div class="footer">

            <!-- Footer main Section -->
            <?php include(APPPATH.'/views/mobile/layout/footer-bottom.php'); ?>
            <!-- End Copyright Section -->

        </div>
        <!-- End FOOTER -->

        <!-- Back to top Link -->
        <div id="to-top" class="main-bg"><i class="fa fa-long-arrow-up"></i></div>

    </div>
    <!-- END MAIN PAGE -->

</div><!-- #main -->


<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slicknav.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.swipebox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
<script>

$(document).ready(function(e){
    $('#search-field-mobile').autocomplete({
        source: function (request, response) {
            var selectedcategory= concept;



            $.ajax({
                url: "<?=base_url()?>search",
                method:"POST",
                data: { searchText: request.term, maxResults: 10,category:selectedcategory},
                dataType: "json",
                success: function (data) {

                    response($.map(data, function (item) {
                        return {
                            value:item.title,
                            avatar:"https://www.blazebay.com/assets/uploadedimages/"+item.image,
                            uid: item.uid,
                            selectedId:item.id,
                            selectedType:item.company

                        };
                    }))
                }
            })
        },
        select: function (event, ui) {
            var   term=ui.item.value;
            if(ui.item.selectedType=="company"){
                window.location="<?=base_url();?>company-details/"+ term.replace(/[^a-z0-9]+/g,'-') + "/"+ ui.item.uid;
            }else{
                window.location="<?=base_url();?>product-details/"+ term.replace(/[^a-z0-9]+/g,'-') + "/"+ ui.item.selectedId+"/"+ ui.item.uid;
            }

            return false;
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li />")
            .data("item.autocomplete", item)
            .append("<div style='width: 240px;'><a><img  class='img-thumbnail' style='max-height:50px;min-height:50px;max-width:50px;min-width:50px;' src='" +
            item.avatar + "' /><span class='search-title-results' >" + trimByWord(item.value.toLowerCase()) + "</span></a></div>")
            .appendTo(ul);

    };

    checkCountMsgs();
    $('#search-field-mobile').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            search()

        }
    });

    $('#data-table').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
    var concept="";

    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();

        $('.search-panel span#search_concept').html(concept);
        $('.input-group #search_param').val(param);
    });

    $('.language-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();
        $('.language-panel span#language_concept').html("");
        $('.language-panel span#language_concept').html(concept);
        var selectedLanguage= $('.language-panel span#language_concept').text();
        if(selectedLanguage!=""){
            $.ajax({
                url: "<?=base_url()?>switchLanguage",
                method:"POST",
                data: {language:selectedLanguage},
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                    location.reload();
                }
            })
        }

    });

    $('.search-panel2 .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel2 span#search_concept2').text(concept);
        $('.input-group #search_param2').val(param);
        var category=$("#search_param2").val();
        var append='<?=$firstitem?>';

        if(category=='greather_than'||category=='less_than' ){
            $("#all-products-search_param").prop('type', 'number');
            if(append=='all-products' || append=='sale-offers' || append=='all') {
                $("#url-link").val('<?=$appendLink?>');
            }
            else{
                $("#url-link").val('wholesell/');
            }
        }else{
            $("#all-products-search_param").prop('type', 'text');
            if(append=='all-products' || append=='sale-offers' || append=='all' ) {
                $("#url-link").val('<?=$appendLink?>');
            }
            else{
                $("#url-link").val('wholesell/');
            }
        }
    });


    $('#all-products-search_param').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {

            search2()

        }
    });

    $('.cnt-block .list-unstyled').find('a').click(function(e) {
        e.preventDefault();

        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();

        var selectedCurrency=concept;


        if(selectedCurrency==="USD"|| selectedCurrency==="KSH"|| selectedCurrency==="NURUCOIN" ||selectedCurrency==="NRCT"){
            $.ajax({
                url: "<?=base_url()?>currencyConvertion",
                method:"POST",
                data: { currency:selectedCurrency},
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                    location.reload();
                }
            })
        }

        //  location.reload();
    });



    $("#login-modal-button").click(function(e) {
        e.preventDefault();
        var username= $("#modal-username").val();
        var password=$("#modal-password").val();

        if(username==""){
            new Noty({
                type: 'error',
                timeout: 6000,
                text     : 'Please enter your username or email',
                container: '.modal-username-invalidLogin'
            }).show();

        }
        else if(password==""){
            new Noty({
                type: 'error',
                timeout: 6000,
                text     : 'Please enter your password',
                container: '.modal-password-invalidLogin'
            }).show();

        }else{


            var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
            var RedirectUrl="<?php echo base_url().'login' ;?>";
            var userUrl="<?php echo base_url().'dashboard' ;?>";

            $.ajax({
                type: "POST",
                url: ctrlUrl,
                data:({
                    username: username,
                    password: password
                }),
                cache
                    :
                    false,
                success
                    :
                    function (data) {

                        //alert(data);
                        if (data ==10) {
                            new Noty({
                                type: 'warning',
                                timeout: 60000,
                                text     : 'Your account is not approved',
                                container: '.modal-invalidLogin'
                            }).show();
                            //window.location.href=RedirectUrl;
                        }
                        else if (data==1||data==2||data==3||data==4){
                            new Noty({
                                type: 'success',
                                timeout: 100000,
                                text     : 'Success',
                                container: '.invalidLogin'
                            }).show();
                            $('#loginp').modal('toggle');
                            window.location.reload();
                        }
                        else{
                            new Noty({
                                type: 'error',
                                timeout: 60000,
                                text     : 'Oops!.Invalid Credentials',
                                container: '.modal-invalidLogin'
                            }).show();

                            window.location.reload;
                        }
                    }
            });
        }
    });

} );

function checkCountMsgs() {

    var base_url =  "<?php echo base_url()?>";
    $.ajax({
        url:base_url+"getCountMessage",
        type:"POST",
        success:function(data){
            $(".countMgs").html(data);
            setTimeout(function(){ return checkCountMsgs(); },2000);
        }
    });
}

function trimByWord(sentence) {
    var result = sentence;
    var resultArray = result.split("");
    if(resultArray.length > 20){
        resultArray = resultArray.slice(0, 20);
        result = resultArray.join("");
    }
    return result;
}
function userLogin() {

    var username= $("#username").val();
    var password=$("#password").val();

    if(username==""){
        new Noty({
            type: 'error',
            timeout: 500,
            text     : 'Please enter your username or email',
            container: '.usernameerror'
        }).show();

    }
    else if(password==""){
        new Noty({
            type: 'error',
            timeout: 500,
            text     : 'Please enter your password',
            container: '.passworderr'
        }).show();

    }else{


        var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
        var RedirectUrl="<?php echo base_url().'login' ;?>";
        var userUrl="<?php echo base_url().'dashboard' ;?>";
        $.ajax({
            type: "POST",
            url: ctrlUrl,
            data:({
                username: username,
                password: password
            }),
            cache
                :
                false,
            success
                :
                function (data) {

                    //alert(data);
                    if (data ==10) {
                        new Noty({
                            type: 'warning',
                            timeout: 3000,
                            text     : 'Your account is not activated',
                            container: '.invalidLogin'
                        }).show();
                        //window.location.href=RedirectUrl;
                    }
                    else if (data==1||data==2||data==3||data==4){

                        new Noty({
                            type: 'info',
                            timeout:3000,
                            text     : 'Success',
                            container: '.invalidLogin'
                        }).show();

                        window.location=userUrl;
                    }
                    else{
                        new Noty({
                            type: 'error',
                            timeout: 30000,
                            text     : 'Oops!.Invalid Credentials',
                            container: '.invalidLogin'
                        }).show();

                        window.location.reload;
                    }
                }
        });
    }
}
function search(){
    var searchText=$("#search-field-mobile").val();
    if(searchText!=""){
        var item=searchText.replace(/[^a-z0-9]+/g,'-');
        location.replace('<?=base_url()?>all-products/'+item);
    }else{
        location.replace('<?=base_url()?>all/products');
    }

}


function search2(){
    var searchText=$("#all-products-search_param").val();
    var append='<?=$firstitem?>';



    if(append=='all-products' || append=='sale-offers' || append=='all' ) {
        $("#url-link").val('<?=$appendLink?>');
    }
    var url=$("#url-link").val();
    var category=$("#search_param2").val();
    if(category=="greather_than"){
        if (searchText != "") {
            var item = searchText;
            location.replace('<?=base_url()?>' + url + 'price-greater-than/' + item);
        } else {
            location.replace('<?=base_url()?>' + url + '');
        }
    } else if(category=="less_than"  ){
        if (searchText != "") {
            var item = searchText;
            location.replace('<?=base_url()?>' + url + 'price-less-than/' + item);
        } else {
            location.replace('<?=base_url()?>' + url + '');
        }
    } else {
        if (searchText != "") {
            var item = searchText;

            location.replace('<?=base_url()?>'+ url +''+ item);

        } else {
            location.replace('<?=base_url()?>' + url + '');
        }
    }
}
function buy(product_id,qty){
    var orderurl='<?=base_url(). "make-an-order/";?>'+product_id+"/"+qty;
    location.replace(orderurl);
}
function buy_trade_security(product_id,qty){
    var orderurl='<?=base_url(). "order/";?>'+product_id+"/"+qty;
    location.replace(orderurl);
}
function makeOrder(product_id){
    var size=$("#size option:selected").text();
    var color=$("#color option:selected").text()
    var qty=$("#itemp_qty").val();
    if(color!="" &&  size!="" && qty!=""){
        var orderurl='<?=base_url()."make-an-order/";?>'+product_id+"/"+qty+"/"+color+"/"+size;
    }else{
        var orderurl='<?=base_url(). "make-an-order/";?>'+product_id+"/"+qty;
    }
    location.replace(orderurl);
}
function setcheked(id){
    var baseurl='<?php echo base_url();?>';
    if(id=='1'){
        $('#mpesa').show();
        $('#paypal').hide();
        $('#nurucoin').hide();
        $('#card').hide();

    }else if(id=='2'){
        $('#mpesa').hide();
        $('#paypal').show();
        $('#nurucoin').hide();
        $('#card').hide();

    }else if(id=='3'){
        $('#mpesa').hide();
        $('#paypal').hide();
//            $('#nurucoin').show();
        $('#card').hide();
        $('#nurucoinModal').modal('show');

    }
    else if(id=='4'){
        $('#mpesa').hide();
        $('#paypal').hide();
        $('#nurucoin').show();
        $('#card').show();


    }



}

function contactSupplier(supplier_id){



    var base_url='<?php echo base_url()?>';
    $.get(base_url+"get/supplier/Details/"+supplier_id,function(res){

        if(res){
            $(".ContactSupplier #suppliername").html(res.data['company_name']);
            $(".ContactSupplier #address").html(res.data['address']);
            $(".ContactSupplier #phone").html(res.data['phone']);
            $(".ContactSupplier #country").html(res.data['street']);
            $(".ContactSupplier #street").html(res.data['street']);
            $(".ContactSupplier #contact").html(res.data['firstname'] +' '+res.data['lastname'] );
            $(".ContactSupplier #supplier_id").val(res.data['user_id']);
            $(".ContactSupplier #supplier_fname").val(res.data['firstname']);
            $(".ContactSupplier #supplier_lname").val(res.data['lastname']);
            $(".ContactSupplier #company_name").val(res.data['company_name']);
            $(".ContactSupplier #supplier_email").val(res.data['email']);
            $(".ContactSupplier #product_id").val(res.data['id']);
            $(".ContactSupplier #product_name").val(res.data['title']);
            $(".ContactSupplier #product_image").val(res.data['image']);
            $(".ContactSupplier #minisiteurl").val('https://'+ res.data['minisite_prefix'].toLowerCase() +'.blazebay.com');
            //}

            $(".ContactSupplier #productimage").html('<img src="https://www.blazebay.com/assets/uploadedimages/'+res.data['image']+'"  id="image" name="image"  width="75px" height="75px" />');

            location.replace(base_url+"contact-supplier/"+res.data['company_name'].replace(/[^a-z0-9]+/g,'-')+"/"+res.data['id'])
            //  $('.ContactSupplier').modal('show');

        }
        else{
            alert('no data')
        }
    },'json');
}
function viewMinisite(){
    var url=$('#minisiteurl').val();
    window.open(url,'_blank');
}


function submitsupplierContact(){

    var base_url="<?php echo base_url();?>";
    var user_id="<?php echo $this->session->userdata['logged_in']['user_id'];?>";
    if(user_id=='' || user_id==null){
        swal({
            title: "One more step!",
            text: "Please login first to contact the supplier",
            type: "info"
        }, function() {
            $('#loginp').modal('show');
        });

    }else{

        var formData = new FormData($('.Contact_Supplier_Frm')[0]);
        var contactmessage=tinyMCE.get('contact-message').getContent();
        var contactname=$('#contact-name').val();
        var contactemail=$('#contact-email').val();
        var supplierId=$('#contact-supplier-id').val();
        var productId=$('#contact-product-id').val();

        if(contactname==" "){
            new Noty({
                type: 'info',
                timeout: 1000,
                text     : 'Oops!.Please enter your Name',
                container: '.ErrorMessage'
            }).show();
        }
        else if(contactemail==" "){
            new Noty({
                type: 'info',
                timeout: 1000,
                text     : 'Oops!.Please enter your Email',
                container: '.ErrorMessage'
            }).show();
        }
        else if(contactmessage=== undefined || contactmessage.length == 0){
            new Noty({
                type: 'info',
                timeout: 1000,
                text     : 'Oops!.Please enter message',
                container: '.ErrorMessage'
            }).show();
        }
        else {
            $.ajax({
                url: base_url + "contactSupplier",
                type: "POST",
                data: {name:contactname,email:contactemail,message:contactmessage,supplierId:supplierId,productId:productId},
                dataType: "json",
                success: function (msg) {
                    if (msg == 1) {
                        new Noty({
                            type: 'info',
                            timeout: 30000,
                            text     : 'Success! your enquiry has reached the supplier.The supplier is processing it.',
                            container: '.displayMessage'
                        }).show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                    } else {
                        new Noty({
                            type: 'error',
                            timeout: 30000,
                            text     : 'Error! something went wrong,we are resolving it shortly',
                            container: '.displayMessage'
                        }).show();
                    }
                }

            });


        }
    }
}


function removeWishlist(product){
    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url();?>wishlist-remove',
        data  : {
            'product'   : product
        },
        success: function (response) {
            swal("Success", "Product removed from wishlist", "success");
            location.reload();
        }
    });
}
function wishlist(product,user){
    var user='<?=$this->session->userdata['logged_in']['user_id'];?>';
    if (user=='' || user== null) {
        $('#loginp').modal('show');
    }else {

        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>product-add-to-wishlist',
            data: {
                'user': user,
                'product': product,
                'type': 'wishlist'
            },
            success: function (response) {
                swal("Success", "Product added to wishlist", "success")
            }
        });
    }
}

function compareProducts(product,user){
    var user='<?=$this->session->userdata['logged_in']['user_id'];?>';
    if (user=='' || user== null) {
        $('#loginp').modal('show');
    }else {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>product-add-to-wishlist',
            data: {
                'user': user,
                'product': product,
                'type': 'compare'
            },
            success: function (response) {
                swal("Success", "Product added to comparison list", "success")
            }
        });
    }
}

</script>
</body>
</html>