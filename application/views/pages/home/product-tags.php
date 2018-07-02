<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 11:12 AM
 */
?>
<div class="sidebar-widget-body outer-top-xs">
    <div class="tag-list">
        <a class="item" title="Phone" href="<?=base_url()?>all-products/Phone">Phone</a>
          <a class="item" <?php if($name=='Furniture'){ echo 'active';} ?>title="Furniture" href="<?=base_url()?>all-products/Furniture">Furniture</a>
        <a class="item"  <?php if($name=='shirt'){ echo 'active';} ?>title="T-shirt" href="<?=base_url()?>all-products/shirt">T-shirt</a>
           </div><!-- /.tag-list -->
</div><!-- /.sidebar-widget-body -->
