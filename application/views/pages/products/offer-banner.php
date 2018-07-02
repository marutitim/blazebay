<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 12:22 PM
 */
?>

<div id="category" class="category-carousel hidden-xs" >
    <div class="item">
        <div class="image">
 <?php

 if(isset($selloffers) ||isset($saleproductsearchprice)|| isset($saleproductsearch)){ ?>
     <div id="offer-slider" style="height: 250px;"></div>
            <?php } else { ?>

     <div id="wholesale-slider" style="height: 250px;"></div>
            <?php } ?>
        </div>
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </div>
</div>