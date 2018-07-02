<?php


if ($this->agent->is_mobile())
{
    echo " ";
}

else
{
?>

<nav class="yamm megamenu-horizontal" role="navigation">
<ul class="nav nav-cat">
    <?php
    $groups =$this->Site_model->getDataById("bt_categorie_group", "group_status ='1' AND group_id IN(4206,4207,4209,
    4210,4216,4212,4219) ORDER BY group_name ASC " );

    foreach($groups as $group){
        $getGroupId=$group['group_id'];
        $groupsicon =$this->Site_model->getDataById("bt_categorie_group","group_status='1' AND group_id ='$getGroupId'");
        ?>
<li class="dropdown menu-item">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="<?=$groupsicon[0]['group_icon']?>" aria-hidden="true"></i><?=$group['group_name']?></a>

    <ul class="dropdown-menu mega-menu" >
        <li class="yamm-content" >
            <div class="row">
                <?php

                $categories = $this->Site_model->getDataById( "bt_categories", " group_id=" . $group['group_id'] . " and pid='0' and status ='Y' ORDER BY cat_name ASC");
                foreach($categories as $category) { ?>
                    <div class="col-sm-12 col-md-3">
                    <ul class="links list-unstyled">
                        <?php

                        $subcategories =$this->Site_model->getDataById("bt_categories", " pid=" .$category['id'] ."
                         and status ='Y' ORDER BY cat_name  DESC LIMIT 20");
                        foreach($subcategories as $subcategory){

                            $join_sel =" SELECT p.id,p.approved,pc.cid FROM bt_products as p

														  JOIN bt_product_cats as pc  ON p.id = pc.offer_id

														  JOIN bt_categories as c ON c.id = pc.cid

														  JOIN bt_members m ON m.user_id = p.uid
														  WHERE pc.cid = ". $subcategory['id']." AND p.approved = 'yes'
														   AND m.suspended='N' ";
                            $res=$this->Site_model->getcountRecods($join_sel);

                            if(!empty($res)){
                                $scat_link= base_url().'all-products/'.RemoveBadURLCharaters(strtolower($subcategory['cat_name'])).'/'.$subcategory['id'];
                                $SubCategory_Name = htmlentities($subcategory["cat_name"],ENT_IGNORE );
                                ?>
                                <li><a href="<?=$scat_link?>"><?=$SubCategory_Name?></a></li>
                                <?php
                            }
                            else{
//                                $has_scat_pro_count=0;
//
//								$scat_link= base_url().'all-products/'.RemoveBadURLCharaters(strtolower($subcategory['cat_name'])).'/'.$subcategory['id'];
//                                $scat_prodnum_txt = "($has_scat_pro_count)";
//                                $SubCategory_Name = htmlentities($subcategory["cat_name"],ENT_IGNORE );
                                ?>
<!--                                <li><a href="#">--><?//=$SubCategory_Name?><!--</a></li>-->
                                <?php
                              }

                            ?>

                        <?php } ?>
                    </ul>
                </div><!-- /.col -->
                <?php } ?>
                <div class="mobile-hide">
<!--                --><?php // if($getGroupId==4206){ ?>
<!--                <div class="dropdown-banner-holder">-->
<!--                    <a href="--><?//=base_url()?><!--product-details/-ishori-ice/22164/1787"><img alt="" src="--><?//=base_url()?><!--assets/images/Agriculture.png" /></a>-->
<!--                </div>-->
<!--                --><?php //} ?>
<!--                --><?php // if($getGroupId==4208){ ?>
<!--                    <div class="dropdown-banner-holder">-->
<!--                        <a href="--><?//=base_url()?><!--product-details/-otorcycle-ifan-200-10-200-/21779/1643"><img alt="" src="--><?//=base_url()?><!--assets/images/Auto.png" /></a>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--                --><?php // if($getGroupId==4209){ ?>
<!--                    <div class="dropdown-banner-holder">-->
<!--                        <a href="--><?//=base_url()?><!--product-details/-tti-sports-shoes-lack-ellow/22026/1414"><img alt="" src="--><?//=base_url()?><!--assets/images/Bags.png" /></a>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!---->
<!--                --><?php // if($getGroupId==4212){ ?>
<!--                    <div class="dropdown-banner-holder">-->
<!--                        <a href="--><?//=base_url()?><!--product-details/48-hour-protection-deodorant/22229/1804"><img alt="" src="--><?//=base_url()?><!--assets/images/healthbeauty.png" /></a>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--                --><?php // if($getGroupId==4217){ ?>
<!--                    <div class="dropdown-banner-holder">-->
<!--                        <a href="#"><img alt="" src="--><?//=base_url()?><!--assets/images/Electrics.png" /></a>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--                --><?php // if($getGroupId==4211){ ?>
<!--                    <div class="dropdown-banner-holder">-->
<!--                        <a href="#"><img alt="" src="--><?//=base_url()?><!--assets/images/Gifts.png" /></a>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--                    </div>-->
            </div><!-- /.row -->

        </li><!-- /.yamm-content -->
    </ul><!-- /.dropdown-menu -->

</li><!-- /.menu-item -->
    <?php } ?>

</ul><!-- /.nav -->
</nav>
<?php } ?>