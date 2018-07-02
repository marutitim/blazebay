<ul>
    <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="has-sub"><a href="#"><i class="fa fa-th-list"></i> Categories</a>
        <ul>
            <?php
            $groups =$this->Site_model->getDataById("bt_categorie_group", "group_status ='1' AND group_id IN(4207,4209,
    4210,4212,4219) ORDER BY group_name ASC " );

            foreach($groups as $group){
            $getGroupId=$group['group_id'];
            $groupsicon =$this->Site_model->getDataById("bt_categorie_group","group_status='1' AND group_id ='$getGroupId'");
            ?>

            <li class="has-sub"><a href="#"><i class="<?=$groupsicon[0]['group_icon']?>" style="color:#dd8237" aria-hidden="true"></i> <?=$group['group_name']?></a>
                <ul>
                    <?php
                    $categories = $this->Site_model->getDataById( "bt_categories", " group_id=" . $group['group_id'] . " and pid='0' and status ='Y' ORDER BY cat_name ASC");
                    foreach($categories as $category) {

                    $subcategories =$this->Site_model->getDataById("bt_categories", " pid=" .$category['id'] ."
                         and status ='Y' ORDER BY cat_name ASC");
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
                        }else{
//                            $has_scat_pro_count=0;
//
//                            $scat_link= base_url().'all-products/'.RemoveBadURLCharaters(strtolower($subcategory['cat_name'])).'/'.$subcategory['id'];
//                            $scat_prodnum_txt = "($has_scat_pro_count)";
//                            $SubCategory_Name = htmlentities($subcategory["cat_name"],ENT_IGNORE );
                            ?>
<!--                            <li><a href="--><?//=$scat_link?><!--">--><?//=$SubCategory_Name?><!--</a></li>-->
                        <?php
                        }

                        ?>

                    <?php } }?>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </li>
    <li class="has-sub"><a href="#"><i class="fa fa-briefcase"></i> Products</a>
        <ul>
            <li><a href="<?=base_url()?>all/products">All Products</a></li>
            <li><a href="<?=base_url()?>sale-offers">Offer Zone</a></li>
            <li><a href="<?=base_url()?>wholesell">Wholesale</a></li>
        </ul>
    </li>

    <li><a href="<?=base_url()?>contact"><i class="fa fa-phone"></i> Contact Us</a></li>
    <li><a href="<?=base_url()?>feedback"><i class="fa fa-envelope"></i>Feedback</a></li>
    <li><a href="<?=base_url()?>sitehelp"><i class="fa fa-support"></i> Help Center</a></li>


    <?php if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
        <li>
            <a href="<?=base_url();?>dashboard/" title="" >
                <i class="fa fa-user" aria-hidden="true"></i> Hi,
                <?php echo ucwords($this->session->userdata['logged_in']['firstname']);?></a>
        </li>
        <li><a href="<?=base_url()?>logout"><i class="fa fa-sign-out"></i></i> Logout</a></li>
    <?php } else {?>
        <li><a href="<?=base_url()?>login"><i class="fa fa-sign-in"></i> Login</a></li>
    <?php } ?>
</ul>