

<div class="action" style="float:left;">
    <ul class="list-unstyled">
        <?php if(isset($wholesell)|| isset($wholesellsearch) || (isset($product['wholesale']) && $product['wholesale']==1)){?>
            <li class="lnk wishlist">
                <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return buy(<?=$product['id']?>,<?=$product['min_order']?>)" title="Start Ordering">
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </li>
        <?php } ?>

        <li class="lnk wishlist">
            <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return contactSupplier(<?=$product['id']?>)" title="Contact Supplier">
                <i class="icon fa fa-envelope"></i>
            </a>
        </li>
        <?php
        if ($this->agent->is_mobile())
        {
            echo " ";
        }

        else
        {
        ?>
        <li class="lnk">
            <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return compareProducts(<?=$product['id']?>,<?=$product['uid']?>)" title="Add to Compare">
                <i class="fa fa-signal" aria-hidden="true"></i>
            </a>
        </li>
        <?php } ?>
        <li class="lnk wishlist">
            <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="return wishlist(<?=$product['id']?>,<?=$product['uid']?>)" title="Add to Favourite">
                <i class="fa fa-heart"></i>
            </a>
        </li>
    </ul>
</div><!-- /.action -->

