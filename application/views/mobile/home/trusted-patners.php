<ol class="category-list">

    <?php
    $sbq_con = "SELECT company_name,bt_members.user_img,bt_members.user_id FROM `bt_business`
JOIN bt_members ON bt_members.user_id=bt_business.user_id
WHERE bt_members.user_id IN (1506,1507,1508,1801,1509,1510)";
    $premium_supplierBrands = $this->Site_model->getcountRecods($sbq_con);
    foreach ($premium_supplierBrands as $key => $value) {

        $business_logo_vpath 	='https://www.blazebay.com/assets/uploadedimages/'.$value['user_img'];

        $suppliers_products_link=base_url().RemoveBadURLCharaters($value['company_name']).'/'.$value['user_id'];

        ?>
        <li><!-- Category list item #1 -->
            <div class="thumb">
                <a href="#"><img style="max-width: 200px;margin-top: 10%;"  src="<?=$business_logo_vpath?>" alt="<?=$value['company_name']?>"></a>
            </div>

        </li><!-- End Category list item #1 -->

        <?php

    } ?>
</ol>