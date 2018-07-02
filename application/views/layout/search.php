
<div class="search-area ">
<!--    <form action="#" method="POST">  -->
        <div class="control-group">
                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn dropdown-toggle dropdown-toggle searchtoggle"  data-toggle="dropdown">
                            <span id="search_concept" ><span class="glyphicon glyphicon-align-justify mobile-hide"></span><?php if($languange=='Swahili'){ echo 'Kila kitu ';} else {?> All<?php }?> </span>  <span class="caret"></span>
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
                    <input type="text" id="search-field" class="search-field" name="x" placeholder="<?php if($languange=='Swahili'){ echo 'Tafuta Blazebay... ';} else {?> Search Blazebay...<?php }?>">
                  <span class="input-group-btn">
                    <button class="search-button" onclick="return search()"></button>
                </span>

                </div>
            <div class="search-results"></div>
<!--    </form>-->
    </div>
</div><!-- /.search-area -->