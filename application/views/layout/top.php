<?php
if ($this->agent->is_mobile())
{
    echo " ";
}

else
{
?>
<div class="mobile-hide">
<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">

                    <li><a href="#"><i class="fa fa-phone"></i><?php if($languange=='Swahili'){ echo '24/7 Msaidizi';} else {?> 24/7 Support<?php }?> </a></li>
                    <li><a href="<?=base_url()?>order-with-trade-security"><i class="fa fa-shopping-basket"></i><?php if($languange=='Swahili'){ echo 'Amri na Usalama wa Biashara';} else {?> Order with Trade Security<?php }?> </a></li>
                    <li>
                        <a href="<?=base_url();?>compare"> <i class="fa fa-signal" aria-hidden="true"></i><?php if($languange=='Swahili'){ echo 'Linganisha';} else {?> Compare<?php }?> </a>
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
                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                            <span class="currencyvalue" >
                     <?=$this->session->userdata['currencyConvertion']['convertSymbol']?$this->session->userdata['currencyConvertion']['convertSymbol']:'KES'?>
                            </span><b class="caret"></b></a>
                        <input type="hidden" name="curent_currency" value="" id="curent_currency">
                        <ul class="dropdown-menu">
                            <li><a href="#">KSH</a></li>
                            <li><a href="#">USD</a></li>
                            <li><a href="#">NURUCOIN</a></li>
                        </ul>
                    </li>


                </ul><!-- /.list-unstyled -->
            </div><!-- /.cnt-cart -->


            <div class="clearfix"></div>
        </div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.header-top -->
    </div>
<?php } ?>