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
        <li><a href="<?=base_url()?>dashboard"><?php if($languange=='Swahili'){ echo 'Dashibodi';} else {?>Dashboard<?php }?></a></li>
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