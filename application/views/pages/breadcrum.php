<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/10/2018
 * Time: 2:34 PM
 */
?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?=base_url()?>">Home</a></li>
<!--                <li style="width:7%"><a href="--><?//=base_url().$link?><!--">--><?//=$categoryName?><!--</a></li>-->
                <li class='active'><?=ucfirst(strtolower(RemoveBadURLCharaters($name)))?></li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div>