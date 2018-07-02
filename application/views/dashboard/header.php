<header class="header-style-1">

<!-- ============================================== TOP MENU ============================================== -->

<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">
                    <li><a href="#"><i class="fa fa-phone"></i> 24/7 Support</a></li>
                    <li><a href="<?=base_url()?>order-with-trade-security"><i class="fa fa-shopping-basket"></i> Order with Trade Security</a></li>

                    <li><a href="<?=base_url()?>dashboard"><i class="icon fa fa-user"></i>My Account</a></li>
                    <li>
                        <a href="<?=base_url();?>compare"> <i class="fa fa-signal" aria-hidden="true"></i> Compare</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>wishlist"> <i class="fa fa-heart" aria-hidden="true"></i> Wishlist</a>
                    </li>
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
            </div><!-- /.cnt-account -->

            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li class="dropdown dropdown-small">
                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">KES </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">KES</a></li>
                            <li><a href="#">NURUCOIN</a></li>
                            <li><a href="#">USD</a></li>
                            <li><a href="#">RS</a></li>
                            <li><a href="#">GPP</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-small">
                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">English</a></li>
                            <li><a href="#">Swahili</a></li>
                        </ul>
                    </li>
                </ul><!-- /.list-unstyled -->
            </div><!-- /.cnt-cart -->
            <div class="clearfix"></div>
        </div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.header-top -->
<!-- ============================================== TOP MENU : END ============================================== -->
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo">
                    <a href="<?php echo base_url();?>">

                        <img src="<?php echo base_url();?>assets/images/logo.png" alt="">

                    </a>
                </div><!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                <!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                <div class="search-area">
                    <!--    <form action="#" method="POST">  -->
                    <div class="control-group">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn dropdown-toggle dropdown-toggle searchtoggle"  data-toggle="dropdown">
                                    <span id="search_concept" ><span class="glyphicon glyphicon-align-justify"></span> All</span>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu"  role="menu">
                                    <li class="menu-header">Product</li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Clothing</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Electronics</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Shoes</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Watches</a></li>
                                    <li class="menu-header">Company</li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Kenya</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- China</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- USA</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- India</a></li>
                                </ul>
                            </div>
                            <input type="hidden" name="search_param" value="all" id="search_param">
                            <input type="text" id="search-field" class="search-field" name="x" placeholder="Search term...">
                  <span class="input-group-btn">
                    <button class="search-button" onclick="return search()"></button>
                </span>

                        </div>
                        <div class="search-results"></div>
                        <!--    </form>-->
                    </div>
                </div><!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                <div class="dropdown dropdown-cart">
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="basket">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </div>
                            <div class="basket-item-count"><span class="countMgs"><?=$msgs?></span></div>
                            <div class="total-price-basket">

					<span class="total-price">
						<span class="sign">Dashboard</span>
					</span>
                            </div>


                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url()?>dashboard">Dashboard</a></li>
                        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){?>
                            <li><a href="<?=base_url()?>buyer-orderlist">Orders</a></li>
                        <?php } else { ?>
                            <li><a href="<?=base_url()?>supplier-orderlist">Orders</a></li>
                        <?php } ?>
                        <li><a href="<?=base_url()?>buyer-transactions">Transactions</a></li>
                        <li><a href="<?=base_url()?>enquiries-received">Enquiries</a></li>
                        <li ><a href="<?=base_url()?>order-with-trade-security" class="bt" style="background-color:#456FB5; color: #ffffff !important;">Trade security Order</a></li>

                        <!-- ============================================================= Insert menu Here============================================================= -->

                    </ul><!-- /.dropdown-menu-->
                </div>


                <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
        </div><!-- /.row -->

    </div><!-- /.container -->

</div><!-- /.main-header -->

<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
    <?php
    if ($this->agent->is_mobile())
    {
        ?>
        <div id="wrapper" >
            <div class="overlay"></div>

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">


                <ul class="nav sidebar-nav">

                    <?php if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
                        <li class="sidebar-brand">
                            <a href="<?=base_url();?>dashboard/" title="" >
                                <i class="fa fa-user" aria-hidden="true"></i> Hi,
                                <?php echo ucwords($this->session->userdata['logged_in']['firstname']);?></a>
                        </li>
                        <li class="sidebar-brand"><a href="<?=base_url()?>logout"><i class="fa fa-sign-out"></i></i> Logout</a></li>
                    <?php } else {?>
                        <li class="sidebar-brand">
                            <a href="<?=base_url()?>login"><i class="fa fa-user"></i> Login or Sign up
                            </a>
                        </li>
                    <?php } ?>
                    <?php
                    $groups =$this->Site_model->getDataById("bt_categorie_group", "group_status ='1' AND group_id IN(4209,
                 4210,4212,4216) ORDER BY group_name ASC " );

                    foreach($groups as $group){
                        $getGroupId=$group['group_id'];
                        $groupsicon =$this->Site_model->getDataById("bt_categorie_group","group_status='1' AND group_id ='$getGroupId'");
                        ?>
                        <li class="dropdown" >
                            <a href="#" style="padding: 5px 10px;" class="dropdown-toggle" data-toggle="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="<?=$groupsicon[0]['group_icon']?>" aria-hidden="true"></i> <?=$group['group_name']?></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php

                                    $categories = $this->Site_model->getDataById( "bt_categories", " group_id=" . $group['group_id'] . " and pid='0' and status ='Y' ORDER BY cat_name ASC");
                                    foreach($categories as $category) { ?>
                                        <?php

                                        $subcategories =$this->Site_model->getDataById("bt_categories", " pid=" .$category['id'] ."
                         and status ='Y' ORDER BY cat_name LIMIT 14");
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
                                                $has_scat_pro_count=0;

                                                $scat_link= base_url().'all-products/'.RemoveBadURLCharaters(strtolower($subcategory['cat_name'])).'/'.$subcategory['id'];
                                                $scat_prodnum_txt = "($has_scat_pro_count)";
                                                $SubCategory_Name = htmlentities($subcategory["cat_name"],ENT_IGNORE );
                                                ?>
                                                <li><a href="<?=$scat_link?>"><?=$SubCategory_Name?></a></li>
                                            <?php
                                            }

                                            ?>

                                        <?php } ?>

                                    <?php } ?>
                                </ul>

                        </li>
                    <?php } ?>
                    <hr>
                    <li>
                        <a href="<?=base_url();?>dashboard">My Account</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>wishlist">My wishlist</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>enquiries-received">My Enquiries</a>
                    </li>

                    <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){?>
                        <li><a href="<?=base_url()?>buyer-orderlist">My Orders</a></li>
                    <?php } else { ?>
                        <li><a href="<?=base_url()?>supplier-orderlist">My Orders</a></li>
                    <?php } ?>
                    <li>
                        <a href="<?=base_url();?>order-with-trade-security">Trade security Order</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>sitehelp">Help center</a>
                    </li>
                </ul>
            </nav>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>

            </div>
            <!-- /#page-content-wrapper -->

        </div>
    <?php
    }
    else
    {
        ?>
        <div class="mobile-hide">
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
                                    <a href="<?php echo base_url()?>"   class="dropdown-toggle" ><?php if($languange=='Swahili'){ echo 'Nyumbani';} else {?>Home<?php } ?></a>

                                </li>
                                <li class="<?php if($active=='buyer'){ echo 'active';}?> yamm-fw">
                                    <a href="<?php echo base_url()?>dashboard"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown"><?php if($languange=='Swahili'){ echo 'Wanunuzi';} else {?>For Buyers<?php } ?></a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">

                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="<?=base_url();?>sale-offers/" >Sale Offers</a></li>
                                                            <li><a href="<?=base_url();?>buy-offers/" >Buy Offers</a></li>
                                                            <li><a href="<?=base_url();?>wishlist" >Favorite List</a></li>
                                                            <li><a href="<?=base_url();?>post-buy-offers" >Post Buy Offer</a></li>
                                                            <li><a href="<?=base_url();?>manage-buy-offers">Manage Buy Offers</a></li>

                                                        </ul>
                                                    </div>



                                                </div>
                                            </div>
                                        </li>



                                    </ul>
                                </li>

                                <?php  if(isset($this->session->userdata['logged_in']['usertype']) && $this->session->userdata['logged_in']['usertype']==2) { ?>
                                    <li class="<?php if($active=='forsupplier'){ echo 'active';}?> yamm-fw">
                                        <a href="<?php echo base_url()?>dashboard"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                            <?php if($languange=='Swahili'){ echo 'Wauzaji';} else {?>For Suppliers<?php } ?></a>
                                        <ul class="dropdown-menu pages">
                                            <li>
                                                <div class="yamm-content">
                                                    <div class="row">

                                                        <div class="col-xs-12 col-menu">
                                                            <ul class="links">
                                                                <li><a href="<?=base_url();?>post-product" >Post Products </a></li>
                                                                <li><a href="<?=base_url();?>post-sell-offers" >Post Sale Offer</a></li>
                                                                <li><a href="<?=base_url();?>manage-products" >Manage Products</a></li>

                                                            </ul>
                                                        </div>



                                                    </div>
                                                </div>
                                            </li>



                                        </ul>
                                    </li>

                                <?php }  if(isset($this->session->userdata['logged_in']['usertype']) && $this->session->userdata['logged_in']['usertype']==4) { ?>
                                    <li class="<?php if($active=='forcourier'){ echo 'active';}?> yamm-fw">
                                        <a href="<?php echo base_url()?>dashboard"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                            For Couriers</a>
                                        <ul class="dropdown-menu pages">
                                            <li>
                                                <div class="yamm-content">
                                                    <div class="row">

                                                        <div class="col-xs-12 col-menu">
                                                            <ul class="links">
                                                                <li><a href="<?=base_url();?>addlocation" >Add new route </a></li>
                                                                <li><a href="<?=base_url();?>courier-orderlist" >Order List</a></li>
                                                                <li><a href="<?=base_url();?>locations-pricing" >Manage routes</a></li>

                                                            </ul>
                                                        </div>



                                                    </div>
                                                </div>
                                            </li>



                                        </ul>
                                    </li>

                                <?php } ?>

                                <li class="<?php if($active=='myblazebay'){ echo 'active';}?> yamm-fw">
                                    <a href="<?php echo base_url()?>dashboard"   data-hover="dropdown" class="dropdown-toggle"
                                       data-toggle="dropdown">My Blazebay</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">

                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="<?=base_url();?>dashboard">My Account</a></li>
                                                            <li><a href="<?=base_url();?>buyer-transactions" >My Transactions</a></li>
                                                            <li><a href="<?=base_url();?>my-contacts" >My Contact</a></li>
                                                            <li><a href="<?=base_url();?>change-password">Change Password</a></li>

                                                        </ul>
                                                    </div>



                                                </div>
                                            </div>
                                        </li>



                                    </ul>
                                </li>
                                <?php  if(isset($this->session->userdata['logged_in']['usertype']) && $this->session->userdata['logged_in']['usertype']==2) { ?>
                                    <?php if($this->session->userdata['logged_in']['token']){?>
                                        <li ><a href="https://crm.blazebay.com/Crm/home/<?php echo $this->session->userdata['logged_in']['token'];?>" target="_blank">CRM</a></li>
                                    <?php } else{ ?>

                                        <li  class="yamm-fw"><a href="<?=base_url();?>login" target="_blank">
                                                <?php if($languange=='Swahili'){ echo 'CRM ya Wauzaji';} else {?>CRM<?php } ?></a></li>
                                    <?php } } ?>

                                <li class="<?php if($active=='partners'){ echo 'active';}?> yamm-fw">
                                    <a href="<?php echo base_url()?>our-partners"  class="dropdown-toggle" >
                                        <?php if($languange=='Swahili'){ echo 'washirika wetu';} else {?>Our Partners<?php } ?></a>

                                </li>


                                <li class="<?php if($active=='offers'){ echo 'active';}?> dropdown  navbar-right special-menu">
                                    <a href="<?php echo base_url()?>sale-offers"><?php if($languange=='Swahili'){ echo 'Punguzo';} else {?>OFFER ZONE<?php }?></a>
                                </li>


                                <li class="<?php if($active=='postrequirements'){ echo 'active';}?>">
                                    <a href="<?php echo base_url()?>post-buy-requirements"> <?php if($languange=='Swahili'){ echo 'Tuma  mahitaji';} else {?>Request for Quotation<?php } ?></a>
                                </li>

                                <li class="<?php if($active=='wholesale'){ echo 'active';}?>">
                                    <a href="<?php echo base_url()?>wholesell"><?php if($languange=='Swahili'){ echo 'Bidhaa za jumla';} else {?>Wholesale <?php }?></a>
                                </li>



                            </ul><!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div><!-- /.nav-outer -->
                    </div><!-- /.navbar-collapse -->


                </div><!-- /.nav-bg-class -->

            </div><!-- /.navbar-default -->
        </div>
    <?php } ?>

    </div><!-- /.container-class -->

</div><!-- /.header-nav -->


</header>
