<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 11:09 AM
 */
?>
<div class="info-boxes-inner">
    <div class="row">
        <div class="col-md-6 col-sm-4 col-lg-4">
            <div class="info-box">
                <a href="<?=base_url()?>discover-products-and-suppliers"><div class="row">

                    <div class="col-xs-12">
                        <h4 class="info-box-heading green"><?php if($languange=='Swahili'){ echo 'Gundua';} else {?>Discover<?php }?></h4>
                    </div>
                </div>
                <h6 class="text"><?php if($languange=='Swahili'){ echo 'Kugundua Bidhaa na Wauzaji';} else {?>Discover Products and Suppliers<?php }?></h6>
                </a>
            </div>
        </div><!-- .col -->

        <div class="hidden-md col-sm-4 col-lg-4">
            <div class="info-box">
                <div class="row">
                    <?php
                    if(isset($this->session->userdata['logged_in']['usertype'])){
                        if($this->session->userdata['logged_in']['usertype']==1){
                            $link="buyer-orderlist";
                        }else if($this->session->userdata['logged_in']['usertype']==2){
                            $link="supplier-orderlist";
                        }
                    }
                   else{
                        $link="#";
                    }
                    ?>
                    <a href="<?=base_url().$link?>">
                    <div class="col-xs-12">
                        <h4 class="info-box-heading green"><?php if($languange=='Swahili'){ echo 'Nunua';} else {?>Order<?php }?></h4>
                    </div>
                </div>
                <h6 class="text"><?php if($languange=='Swahili'){ echo 'Dhibiti manunuzi za mtandaoni';} else {?>Manage Orders Online<?php }?></h6>
                </a>
            </div>
        </div><!-- .col -->

        <div class="col-md-6 col-sm-4 col-lg-4">
            <a href="<?=base_url()?>access-secure-trade-services"><div class="info-box">
                <div class="row">

                    <div class="col-xs-12">
                        <h4 class="info-box-heading green"><?php if($languange=='Swahili'){ echo 'Biashara';} else {?>Trade<?php }?></h4>
                    </div>
                </div>
                <h6 class="text"><?php if($languange=='Swahili'){ echo 'Fikia Huduma za Biashara';} else {?>Access Trade Services<?php }?></h6>
                    </a>
            </div>
        </div><!-- .col -->
    </div><!-- /.row -->
</div><!-- /.info-boxes-inner -->
