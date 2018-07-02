<div class="top-navbar-left">
    <a href="#" id="menu-left" data-activates="slide-out-left">
        <i class="fa fa-bars"></i>
    </a>
</div>
<div class="top-navbar-right">
    <a href="#" class="dropdown-button" data-activates="dropdown1">
        <i class="fa fa-user-circle-o"></i>
    </a>
    <ul id="dropdown1" class="dropdown-content">
         <li><a href="<?=base_url()?>dashboard"><i class="fa fa-server"></i> Dashboard</a></li>
        <li><a href="<?=base_url()?>edit-profile"><i class="fa fa-user"></i> My Profile</a></li>
        <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){?>
            <li><a href="<?=base_url()?>buyer-orderlist"><i class="fa fa-history"></i> Order History</a></li>
        <?php } else { ?>
            <li><a href="<?=base_url()?>supplier-orderlist"><i class="fa fa-history"></i> Order History</a></li>
        <?php } ?>
        <li class="divider"></li>
        <li><a href="#"><i class="fa fa-search"></i> Tracking Order</a></li>

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

    <a href="#" id="menu-right" data-activates="slide-out-right">
        <span class="cart-badge">0</span>
        <i class="fa fa-envelope"></i>
    </a>
</div>
<div class="site-title">
    <a href="<?=base_url()?>"><img src="<?php echo base_url();?>assets/images/logo.png"></a>
</div>