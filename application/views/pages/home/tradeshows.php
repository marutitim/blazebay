
<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">

    <?php

    $sqlStatement = "SELECT

							t.*,

							m.user_id as member_id,

							m.firstname as member_firstname,

							m.lastname as member_lastname,

							m.email as member_email,

							m.usertype as member_usertype,

							m.memtype as member_memtype,

							s.id as business_id,

							s.company_name as business_name,

							s.minisite_prefix,

							s.services as business_services,

							s.address1 as business_address1,

							s.email as business_email,

							s.website as business_website



						FROM

							bt_tradeshow t

						JOIN bt_members m ON m.user_id = t.user_id

						JOIN bt_business s ON s.user_id = t.user_id

						WHERE  m.suspended='N' AND t.approved = 'Y'   ORDER BY t.tradeshow_id ASC LIMIT 2";

    //AND tradeshow_date >= CURDATE()


    $getTradeshows=$this->Site_model->execute($sqlStatement);

    foreach($getTradeshows as $eachTradeshow){
        $description  = html_entity_decode($eachTradeshow['description']);

        $tradeImage   = $eachTradeshow['tradeshow_img'];

        $path         =base_url().'assets/trade/';

        $image_thumb =$path.$tradeImage;

        $tradeShow_id = $eachTradeshow['tradeshow_id'];

        $tradeName    = $eachTradeshow['tradeshow_name'];

        $trade_slug   =RemoveBadURLCharaters($tradeName);

        $tradeDetails_link = base_url()."trade-details/".$trade_slug."/".$tradeShow_id.'/';

        ?>
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image">
                        <a href="<?php echo $tradeDetails_link;?>" alt="<?php echo $tradeName;?>"  target="_blank">

                            <img src="<?=$image_thumb;?>" alt="<?php echo $tradeName;?>" >

                        </a>
                    </div>

                </div><!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="<?=$tradeDetails_link?>"><span class="price"><?=$tradeName?></span></a></h3>
                    <div class="product-price">
                                           <?php if(!empty($description)){ ?>

                            <em>"</em>

                            <?=ucwords(substr($description,0,100)); ?>...<em>"</em>

                        <?php } ?>

                    </div><!-- /.product-price --><br>
                    <a href="<?=$tradeDetails_link?>" class="lnk btn btn-primary">Read more</a>
                </div><!-- /.product-info -->
            </div>
        </div>

    <?php  } ?>


</div><!-- /.sidebar-widget -->