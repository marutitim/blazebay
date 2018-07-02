<?php 
$mvpath= "https://".$_SERVER['SERVER_NAME'] . "/";
?>
<div class="yamm navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="nav-bg-class">
        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
                <ul class="nav navbar-nav">
                    <li class="<?php if($active=='home'){ echo 'active';}?> dropdown yamm-fw">
                        <a href="<?=$mvpath?>" >Home</a>

                    </li>
                    <li class="yamm-fw" >
                        <a href="<?=$mvpath?>m/category" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown" >Product Categories</a>
                        <ul class="dropdown-menu pages">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">

                                        <div class="col-xs-12 col-menu">
                                            <ul class="links">
                                                <?php
                                                $prodcat = array_map("unserialize", array_unique(array_map("serialize", $minisite_header['minisite_category'])));
                                                if(!empty($prodcat)){
                                                foreach($prodcat as $pcat){ ?>
                                                <li><a href="<?=$pcat['minisite_category_products'];?>" ><?=$pcat['cat_name'];?></a></li>
                                                <?php }} ?>

                                            </ul>
                                        </div>



                                    </div>
                                </div>
                            </li>
                            </ul>
                    </li>
                    <li class="<?php if($active=='overview'){ echo 'active';}?> yamm-fw">
                        <a href="<?=$mvpath?>m/overview" >Company Profile</a>

                    </li>
<!--                    <li class="--><?php //if($active=='location'){ echo 'active';}?><!-- yamm-fw">-->
<!--                        <a href="--><?//=$mvpath?><!--m/location" >Location</a>-->
<!---->
<!--                    </li>-->
                    <li class="yamm-fw <?php if($active=='contact'){ echo 'active';}?>">
                        <a href="<?=$mvpath?>m/contact-us"  >Contacts</a>

                    </li>



                    <li class="dropdown  navbar-right special-menu">
                        <a href="<?=$websitePath?>" target="_blank">Back to BlazeBay Site</a>
                    </li>





                </ul><!-- /.navbar-nav -->
                <div class="clearfix"></div>
            </div><!-- /.nav-outer -->
        </div><!-- /.navbar-collapse -->


    </div><!-- /.nav-bg-class -->
</div><!-- /.navbar-default -->