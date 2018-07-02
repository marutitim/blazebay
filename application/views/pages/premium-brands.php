<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 11:14 AM
 */
?>
<div class="logo-slider-inner">
    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
        <?php
        $sbq_con = "SELECT company_name,bt_members.user_img,bt_members.user_id FROM `bt_business`
JOIN bt_members ON bt_members.user_id=bt_business.user_id
WHERE bt_members.user_id IN (1506,1507,1508,1801,1509,1510,1511)";
        $premium_supplierBrands = $this->Site_model->getcountRecods($sbq_con);
        foreach ($premium_supplierBrands as $key => $value) {

       $business_logo_vpath 	='https://www.blazebay.com/assets/uploadedimages/'.$value['user_img'];

        $suppliers_products_link=base_url().RemoveBadURLCharaters($value['company_name']).'/'.$value['user_id'];

        ?>
        <div class="item" style="padding-left:4%;">
            <a href="<?=$suppliers_products_link?>" class="image">
                <img title="<?=$value['company_name']?>" data-echo="<?=$business_logo_vpath?>" style="max-height:80px;min-height:80px;max-width:200px;min-width:200px;padding-left: 10%;"
                     src="<?=$business_logo_vpath?>" alt="<?=$value['company_name']?>">
            </a>
        </div><!--/.item-->
<?php } ?>
    </div><!-- /.owl-carousel #logo-slider -->
</div><!-- /.logo-slider-inner -->
