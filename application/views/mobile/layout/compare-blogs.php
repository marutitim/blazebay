<!-- TABS -->
<div class="sidebar-tabs">
    <!--
   Tabs Menu -->
    <ul class="tabs">
        <li class="tab"><a class="active" href="#yourcart">Compare</a></li>
        <li class="tab"><a href="#latestblog">Latest blog</a></li>
    </ul>
    <!-- End Tabs Menu -->

</div>

 <!--Right Sidebar Tabs Content -->
<div class="sidebar-tabs_content">

    <!-- Your Cart Tabs -->
    <div id="yourcart">

<!--        <ol class="cart-item">-->
<!--            --><?php
//            $comapare= $this->Site_model->getcustomNewProducts();
//            foreach($comapare as $product){
//                // if(file_exists("assets/uploadedimages/".$product['image']) && $product['image'] !=""){
//
//                $productLink="product-details/".RemoveBadURLCharaters($product['title'])."/". $product['id']."/".$product['uid'];
//                //$imageLink="assets/uploadedimages/".$product['image'];
//                $imageLink="https://www.blazebay.com/assets/uploadedimages/".$product['image'];
//                $unit_id        = $product['qty_unit'];
//                if($unit_id){
//                    $where= "unit_id =$unit_id";
//
//                    $get_units= $this->Site_model->getDataById("bt_unit_master",$where);
//                    $unit        = $get_units[0]['unit_name'];
//                }
//                ?>
<!--                <li><!-- 1. Product Slider item -->
<!--                    <div class="thumb">-->
<!---->
<!--                        <a href="--><?//=base_url().$productLink ?><!--"><img class="newproductImages"  src=" --><?//=$imageLink?><!--" alt="--><?//=$product['title']?><!--"></a>-->
<!--                    </div>-->
<!--                    <div class="product-ctn">-->
<!--                        <div class="product-name">-->
<!--                            <a href="--><?//=base_url().$productLink ?><!--">-->
<!--                                --><?//=wordtrimer(ucfirst(strtolower($product['title'])),2)?>
<!--                            </a>-->
<!--                        </div>-->
<!---->
<!--                        <div class="price">-->
<!---->
<!--                            <span class="price-current"> --><?//=$currencySymbol ?><!--. --><?//= number_format(number_format((float)$product['price'] * $currencyRate, 2, '.', ''));?><!--</span>-->
<!--                        </div>-->
<!--                        <div class="rating">-->
<!--                            <span class="unit-measure">--><?//=$unit?><!--</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li><!-- 1. End Product Slider item -->
<!--                --><?php
//                //}
//            } ?>
<!--        </ol>-->

        <div class="cart-action">
            <div class="subtotal">
                <span class="title">Compared</span>
                <span class="price">0</span>
            </div>

        </div>

    </div>
    <!-- End Your Cart Tabs

    <!-- Latest Blog Tabs -->
    <div id="latestblog">

        <div class="latest-blog-featured">
            <div class="thumb">
                <img src="<?php echo base_url();?>assets/images/500x400-white.jpg" alt="">
            </div>
            <span class="meta">10.07.2018 - by Blazebay</span>
            <h3 class="blog-title"><a href="#">Blazebay 2018 promotions</a></h3>
            <p>Infinx  Trends in Kenya.</p>
        </div>

        <ol class="latest-blog">
            <li>
                <span class="meta">10.07.2018 -by  Blazebay</span>
                <h3 class="blog-title"><a href="#">Blazebay ecommerce Security</a></h3>
            </li>
            <li>
                <span class="meta">10.07.2018 - by  Blazebay</span>
                <h3 class="blog-title"><a href="#">Happy Holidays For All Our Customers</a></h3>
            </li>
            <li>
                <span class="meta">10.07.2018 - by Blazebay</span>
                <h3 class="blog-title"><a href="#">Online Shopping Trends of 2018</a></h3>
            </li>
        </ol>
    </div>
    <!-- End Latest Blog Tabs -->

</div>
<!-- End Right Sidebar Tabs Content -->