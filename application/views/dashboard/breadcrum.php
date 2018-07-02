<div class="navbar navbar-default" role="navigation">
    <div class="container">

        <!-- Page title -->
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="javascript:void(0);" class="icon button-menu-mobile open-left" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
            <li>
                <h4 class="page-title"><?=$name?></h4>
            </li>
        </ul>

        <div class="blazenav" id="myBlazenav">
            <a href="<?=base_url()?>dashboard">Dashboard</a>
            <a href="<?=base_url()?>edit-profile">Edit Account</a>
            <a href="<?=base_url()?>">Change password</a>
            <a href="<?=base_url()?>enquiries-received">Enquiries</a>
            <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){?>
                <a href="<?=base_url()?>supplier-orderlist">Orders</a>

                <a href="<?=base_url()?>manage-wholesale-products">Manage Wholesale Products</a>
                <a href="<?=base_url()?>manage-products">Manage Featured Products</a>
                <a href="<?=base_url()?>post-product">Add Featured Products</a>
                <a href="<?=base_url()?>post-wholesale-product">Add Wholesale Products</a>
                <a href="<?=base_url()?>post-sell-offers">Add Sale Offers</a>
                <a href="<?=base_url()?>post-tradeshow">Add Tradeshows</a>
            <?php } else { ?>
            <a href="<?=base_url()?>buyer-orderlist">Orders</a>
            <?php }  ?>
            <a href="<?=base_url()?>logout">logout</a>
        </div>



    </div><!-- end container -->
</div><!-- end navbar -->