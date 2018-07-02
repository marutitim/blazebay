
<?php
$prev="bt_";
 if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2) {
     $busi_slct = " SELECT m.username,b.id as busi_id,b.*  FROM  ";
     $busi_from = $prev . "members as m
            JOIN " . $prev . "business as b ON m.user_id=b.user_id";
     $busi_cond = " WHERE m.suspended='N' AND b.user_id=" . $this->session->userdata['logged_in']['user_id'] . "";
     $business_info = $this->Site_model->getcountRecods($busi_slct . $busi_from . $busi_cond);
     $mini_overview_image = "";
//p($business_info);
     $business_info = $business_info[0];
     $minisite_name = $business_info['company_name'];
     $miniPrefix = $business_info['minisite_prefix'];

     $company_slug = strtolower($minisite_name);
     $company_info_path = base_url() . 'company-details/' . $company_slug . '/' . $business_info['id'] . '/' . $business_info['user_id'];

     $seller_id = $business_info['user_id'];
     $https = "https://";
     $miniSuffix = ".blazebay.com";
//-----:: COMPANY MINI SITE:: -----------------
     if (!empty($miniPrefix)) {
         $minisite_home = $https . $miniPrefix . $miniSuffix;
     } else {
         $minisite_home = "javascript:void(0);";
     }
 }
?>
<div id="sidebar-menu">
    <ul>
        <li class="text-muted menu-title">Navigation</li>

        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i><span> General Options </span> </a>
            <ul class="list-unstyled">
                <li><a href="<?=base_url()?>">Back to website</a></li>
                <li><a href="<?=base_url()?>dashboard">Dashboard</a></li>
                <li  class="<?php if($active=='profile'){ echo 'active';} ?>"><a href="<?=base_url()?>edit-profile">Edit Profile</a></li>
                <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){ ?>
                <li><a href="<?=base_url()?>upgrade">Upgrade Membership</a></li>
                <?php } ?>
                <li><a href="<?=base_url()?>logout">Logout</a></li>

            </ul>
        </li>
        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2||$this->session->userdata['logged_in']['usertype']==4){ ?>
        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-city-alt"></i><span> Company Management </span> </a>
            <ul class="list-unstyled">
                <li><a href="<?=base_url()?>edit-companyprofile">Edit Company</a></li>
                <li><a href="<?=base_url()?>post-photo">Edit Banner</a></li>
                <li><a href="<?=base_url()?>post-company-location">Company Location</a></li>

            </ul>
        </li>
        <?php }?>
        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){ ?>
        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-globe-alt"></i><span> Minisite Management </span> </a>
            <ul class="list-unstyled">

                <li><a href="<?=$minisite_home?>" target="_blank">View Minisite</a></li>

                <li><a href="<?=base_url()?>minisite-banners">Manage Banners</a></li>

                <li><a href="<?=base_url()?>manage-minisite">Manage Minisite</a></li>

                <li><a href="<?=base_url()?>company-logo">Company Logo</a></li>

                <li><a href="<?=base_url()?>manage-theme">Manage Theme</a></li>



            </ul>
        </li>




        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-labels"></i><span> Product Management </span> </a>
            <ul class="list-unstyled">


       <li  ><a href="<?=base_url()?>manage-products">Manage Products</a></li>

        <li><a href="<?=base_url()?>post-product/">Post Product</a></li>

        <li><a href="<?=base_url()?>manage-wholesale-products">Manage Wholesale</a></li>

        <li><a href="<?=base_url()?>post-wholesale-product">Post Wholesale</a></li>


    </ul>
        </li>

        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-labels"></i><span> Sale Ofers </span> </a>
            <ul class="list-unstyled">

                <li><a href="<?=base_url()?>manage-sell-offers">Manage Offers</a></li>

                <li><a href="<?=base_url()?>post-sell-offers">Post Sale Offer</a></li>


            </ul>
        </li>
        <?php } ?>
        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){ ?>
        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-label-heart"></i><span> My Buy Offers </span> </a>
            <ul class="list-unstyled">


                <li class="<?php if($active2=='buyoffer'){ echo 'active';} ?>"><a href="<?=base_url()?>manage-buy-offers"> Manage Buy Offers</a></li>

                <li <?php if($active2=='buyoffer'){ echo 'active';} ?>><a href="<?=base_url()?>post-buy-offers"> Post Buy Offer</a></li>


            </ul>
        </li>
        <?php } ?>


        <?php if(isset($this->session->userdata['logged_in'])&&( $this->session->userdata['logged_in']['usertype']==1||$this->session->userdata['logged_in']['usertype']==2)){?>
        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-truck"></i><span> Order Management </span> </a>
            <ul class="list-unstyled">
                <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){?>
                <li  <?php if($active2=='orders'){ echo 'active';} ?>>

                    <a href="<?=base_url()?>buyer-orderlist"> Order List <sup class="xcs-notify">( <?=$orderNo?> )</sup></a>

                </li>
                <?php } else { ?>

                    <li  <?php if($active2=='orders'){ echo 'active';} ?>>

                        <a href="<?=base_url()?>supplier-orderlist"> Order List <sup class="xcs-notify">(<?=$orderNo?> )</sup></a>

                    </li>
                <?php } ?>
            </ul>
        </li>
        <?php } ?>
        <?php if(isset($this->session->userdata['logged_in'])&&( $this->session->userdata['logged_in']['usertype']==4)){?>
            <li class="has_sub">

                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-truck"></i><span> Route Management</span> </a>
                <ul class="list-unstyled">

                        <li  <?php if($active2=='addlocationpricing'){ echo 'active';} ?>>

                            <a href="<?=base_url()?>addlocation"> Add new route </a>

                        </li>

                        <li  <?php if($active2=='cloctionpricing'){ echo 'active';} ?>>

                            <a href="<?=base_url()?>locations-pricing"> Manage routes </a>

                        </li>

                </ul>
            </li>

            <li class="has_sub">

                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-shopping-cart"></i><span> Order Management </span> </a>
                <ul class="list-unstyled">

                        <li>

                            <a href="<?=base_url()?>courier-orderlist"> Orders List</a>

                        </li>


                </ul>
            </li>
        <?php } ?>
        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-money"></i><span> Transaction Management </span> </a>
            <ul class="list-unstyled">


                <li   <?php if($active2=='transactions'){ echo 'active';} ?>>

                    <a href="<?=base_url()?>buyer-transactions">My Transactions </a>

                </li>


            </ul>
        </li>

        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){ ?>
        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-globe"></i><span> Trade Management </span> </a>
            <ul class="list-unstyled">

                <li><a href="<?=base_url()?>manage-trades">Manage Trades</a></li>

                <li><a href="<?=base_url()?>post-tradeshow">Post Trade</a></li>

            </ul>
        </li>

<?php } ?>




        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-phone-msg"></i><span> My Enquiries </span> </a>
            <ul class="list-unstyled">
                <li <?php if($active2=='messages'){ echo 'active';} ?>><a href="<?=base_url()?>send-new-message">New Compose Message</a></li>

                <li <?php if($active2=='enquiries'){ echo 'active';} ?>><a href="<?=base_url()?>enquiries-received">Enquiries Received</a></li>

                <li <?php if($active2=='enquiries'){ echo 'active';} ?>><a href="<?=base_url()?>enquiries-sent">Enquiries sent</a></li>
                <li <?php if($active2=='messages'){ echo 'active';} ?>><a href="<?=base_url()?>my-contacts">My contacts</a></li>

            </ul>
        </li>


        <li class="has_sub">

            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-pin-account"></i><span> Account Settings </span> </a>
            <ul class="list-unstyled">

                <li <?php if($active2=='accountchange'){ echo 'active';} ?>><a href="<?=base_url()?>change-password">Change Password</a></li>


            </ul>
        </li>


    </ul>
    <div class="clearfix"></div>
</div>