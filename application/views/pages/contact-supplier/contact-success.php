<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include(APPPATH.'/views/mobile/layout/head.php'); ?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

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


        <!-- End Featured Slider -->

        <!-- CONTENT CONTAINER -->
        <div class="content-container">


            <?php
            $where="offer_id ='$productId'";
            $prodcat= $this->Site_model->getDataById( $table = "bt_product_cats", $where );




            if($prodcat[0]['cid']!=0 ||$prodcat[0]['cid']!=""){
                $relatedproducts = $this->Site_model->relatedproducts($prodcat[0]['cid']);

            }
            if(!empty($relatedproducts)){
                foreach($relatedproducts as $product){
                    // if(file_exists("assets/uploadedimages/".$product['image']) && $product['image'] !=""){

                    $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['id']."/".$product['uid'];
                    //$imageLink="assets/uploadedimages/".$product['image'];
                    $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];
                    $unit_id        = $product['qty_unit'];
                    if($unit_id){
                        $where= "unit_id =$unit_id";

                        $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
                        $unit        = $get_units[0]['unit_name'];
                    }
                    ?>
                    <li><!-- 1. Product Slider item -->
                        <div class="thumb">

                            <a href="<?=base_url().$productLink ?>"><img class="newproductImages"  src=" <?=$imageLink?>" alt="<?=$product['title']?>"></a>
                        </div>
                        <div class="product-ctn">
                            <div class="product-name">
                                <a href="<?=base_url().$productLink ?>">
                                    <?=wordtrimer(ucfirst(strtolower($product['title'])),2)?>
                                </a>
                            </div>

                            <div class="price">

                                <span class="price-current"> <?=$currencySymbol ?>. <?= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));?></span>
                            </div>
                            <div class="rating">
                                <span class="unit-measure"><?=$unit?></span>
                            </div>
                        </div>
                    </li><!-- 1. End Product Slider item -->
                    <?php
                    //}
                }} else {
                ?>
                <div class="alert alert-info" role="alert">
                    People who contacted the supplier also boughts
                </div>
            <?php
            } ?>
            </ol>

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

<?php include(APPPATH.'/views/mobile/layout/footer.php'); ?>

<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script>
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
</script>

</body>
</html>