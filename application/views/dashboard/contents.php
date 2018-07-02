<?php
$where = "user_id='" . $this->session->userdata['logged_in']['user_id'] . "'";
$loggedUser_details= $this->Site_model->getDataById( 'bt_members', $where );
$logged_user_lastlogin = $loggedUser_details[0] ['lastlogin'];
?>

<!-- Start content -->
<div class="content">
<div class="container">
<?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){ ?>

    <div class="row">


        <div class="col-md-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-shopping-basket"></i>
                    </a>

                </div>

                <a href="<?=base_url()?>buyer-orderlist"> <h4 class="header-title m-t-0 m-b-30">Orders </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"><?=$order_count?count($order_count):0?> </h2>
                        <p class="text-muted m-b-25">Total Orders</p>
                    </div>

                </div></a>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>

                <a href="<?=base_url()?>enquiries-received">  <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">

                        </div>
                        <div class="widget-detail-1">
                            <h2 class="p-t-10 m-b-0">  <?=$enquiry_count?count($enquiry_count):0?> </h2>
                            <p class="text-muted">Total Enquiries</p>
                        </div>
                    </div></a>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="text-center card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>
                <div>

                    <h4 class="header-title m-t-0 m-b-30">My Profile</h4>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Last Login :</strong> <span class="m-l-15">
                                <?=date('d-M-Y', strtotime($logged_user_lastlogin));?></span></p>

                        <p class="text-muted font-13"><strong>Password:</strong><span class="m-l-15">To change your existing password <a href="<?=base_url()?>change-password">Click Here</a></span></p>


                    </div>

                </div>

            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-heartbeat"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">My favourites</h4>

                <div class="widget-chart-1">
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 2 </h2>
                        <p class="text-muted">total favourites</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-first-order"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">Pending Oders </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"> 36 </h2>
                        <p class="text-muted m-b-25">Total pending Orders</p>
                    </div>

                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-buysellads"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">Buy Offers</h4>

                <div class="widget-chart-1">

                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 4 </h2>
                        <p class="text-muted">Total buy offers</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="text-center card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>
                <div>

                    <h4 class="header-title m-t-0 m-b-30">Need Help</h4>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Frequently Asked Questions: </strong> <span class="m-l-15"><a href="<?=base_url()?>faq">FAQ/Help</a></span></p>

                        <p class="text-muted font-13"><strong>For BlazeBay: </strong><span class="m-l-15"><a href="<?=base_url()?>site-help">Site Help</a></span></p>


                    </div>

                </div>

            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->
<?php } ?>
<?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){ ?>

    <div class="row">

        <div class="col-md-3">
            <div class="card-box">

                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-product-hunt"></i>
                    </a>

                </div>

                <a href="<?=base_url()?>manage-products"> <h4 class="header-title m-t-0 m-b-30">Products</h4>

                <div class="widget-chart-1">

                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> <?=count($product_count)?> </h2>
                        <p class="text-muted">Total Products</p>
                    </div>
                </div>
                </a>
            </div>
        </div><!-- end col -->


        <div class="col-md-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>

                <a href="<?=base_url()?>enquiries-received">  <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">

                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0">  <?=$enquiry_count?count($enquiry_count):0?> </h2>
                        <p class="text-muted">Total Enquiries</p>
                    </div>
                </div></a>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="text-center card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>
                <div>

                    <h4 class="header-title m-t-0 m-b-30">My Profile</h4>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Last Login :</strong> <span class="m-l-15"><?=date('d-M-Y', strtotime($logged_user_lastlogin));?></span></p>

                        <p class="text-muted font-13"><strong>Password:</strong><span class="m-l-15">To change your existing password <a href="<?=base_url()?>change-password">Click Here</a></span></p>


                    </div>

                </div>

            </div>
        </div><!-- end col -->

    </div>


    <div class="row">
        <div class="col-lg-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
<!--                    <ul class="dropdown-menu" role="menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                    </ul>-->
                </div>

                <h4 class="header-title m-t-0">Daily Sales</h4>

                <div class="widget-chart text-center">
                    <div id="morris-donut-example"style="height: 245px;"></div>
                    <ul class="list-inline chart-detail-list m-b-0">
                        <li>
                            <h5 style="color: #ff8acc;"><i class="fa fa-circle m-r-5"></i>Series A</h5>
                        </li>
                        <li>
                            <h5 style="color: #5b69bc;"><i class="fa fa-circle m-r-5"></i>Series B</h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
<!--                    <ul class="dropdown-menu" role="menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                    </ul>-->
                </div>
                <h4 class="header-title m-t-0">Statistics</h4>
                <div id="morris-bar-example" style="height: 280px;"></div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
<!--                    <ul class="dropdown-menu" role="menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                    </ul>-->
                </div>
                <h4 class="header-title m-t-0">Total Revenue</h4>
                <div id="morris-line-example" style="height: 280px;"></div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->


    <!-- end row -->
    <div class="row">

        <div class="col-md-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-th-list"></i>
                    </a>

                </div>

                <a href="<?=base_url()?>supplier-orderlist"> <h4 class="header-title m-t-0 m-b-30">Orders </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"><?=$order_count?count($order_count):0?></h2>
                        <p class="text-muted m-b-25">Total Orders</p>
                    </div>

                </div></a>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
<!--                    <ul class="dropdown-menu" role="menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                    </ul>-->
                </div>

                <h4 class="header-title m-t-0 m-b-30">Sales Analytics</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"> 10 </h2>
                        <p class="text-muted m-b-25">Revenue today</p>
                    </div>

                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
<!--                    <ul class="dropdown-menu" role="menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                    </ul>-->
                </div>

                <h4 class="header-title m-t-0 m-b-30">Statistics</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">

                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 20 </h2>
                        <p class="text-muted">Revenue today</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
<!--                    <ul class="dropdown-menu" role="menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                    </ul>-->
                </div>

                <h4 class="header-title m-t-0 m-b-30">Daily Sales</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-pink pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0"> 158 </h2>
                        <p class="text-muted m-b-25">Revenue today</p>
                    </div>
                    <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                        <div class="progress-bar progress-bar-pink" role="progressbar"
                             aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                             style="width: 77%;">
                            <span class="sr-only">77% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->

<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

            </div>

            <a href="<?=base_url()?>manage-trades"> <h4 class="header-title m-t-0 m-b-30">Tradeshow</h4>

            <div class="widget-chart-1">

                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0"> <?=$trade_count?count($trade_count):0?></h2>
                    <p class="text-muted">Tradeshow</p>
                </div>
            </div>
                </a>
        </div>
    </div><!-- end col -->


    <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

            </div>

            <a href="https://crm.blazebay.com/Crm/home/<?php echo $this->session->userdata['logged_in']['token'];?>"  target="_blank"><h4 class="header-title m-t-0 m-b-30">CRM</h4>

            <div class="widget-chart-1">
                <div class="widget-chart-box-1">

                </div>
                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0"> 4 </h2>
                    <p class="text-muted">Total Notifications</p>
                </div>
            </div></a>
        </div>
    </div><!-- end col -->

    <div class="col-lg-3 col-md-6">
        <div class="text-center card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

            </div>
            <div>

                <h4 class="header-title m-t-0 m-b-30">Need Help</h4>

                <div class="text-left">
                    <p class="text-muted font-13"><strong>Frequently Asked Questions: </strong> <span class="m-l-15"><a href="<?=base_url()?>faq">FAQ/Help</a></span></p>

                    <p class="text-muted font-13"><strong>For BlazeBay: </strong><span class="m-l-15"><a href="<?=base_url()?>sitehelp">Site Help</a></span></p>


                </div>

            </div>

        </div>
    </div><!-- end col -->

</div>
<!-- end row -->

<?php } ?>
<?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==4){ ?>

    <div class="row">


        <div class="col-md-3">
             <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-shopping-basket"></i>
                    </a>

                </div>

                 <a href="<?=base_url()?>courier-orderlist">  <h4 class="header-title m-t-0 m-b-30">Shipping Orders </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"><?=$order_count?count($order_count):0?> </h2>
                        <p class="text-muted m-b-25">Total Orders</p>
                    </div>

                </div>
                     </a>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>

                <a href="<?=base_url()?>enquiries-received">  <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">

                        </div>
                        <div class="widget-detail-1">
                            <h2 class="p-t-10 m-b-0">  <?=$enquiry_count?count($enquiry_count):0?> </h2>
                            <p class="text-muted">Total Enquiries</p>
                        </div>
                    </div></a>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="text-center card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>
                <div>

                    <h4 class="header-title m-t-0 m-b-30">My Profile</h4>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Last Login :</strong> <span class="m-l-15">
                                <?=date('d-M-Y', strtotime($logged_user_lastlogin));?></span></p>

                        <p class="text-muted font-13"><strong>Password:</strong><span class="m-l-15">To change your existing password <a href="<?=base_url()?>change-password">Click Here</a></span></p>


                    </div>

                </div>

            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->
    <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="card-box">
             <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-truck"></i>
                    </a>

                </div>
              <a href="<?=base_url()?>locations-pricing">
                <h4 class="header-title m-t-0 m-b-30">My routes</h4>

                <div class="widget-chart-1">
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 0 </h2>

                    </div>
                </div></a>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-first-order"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">Pending Shipments </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"> 2 </h2>
                        <p class="text-muted m-b-25">Pending Shipments</p>
                    </div>

                </div>
            </div>
        </div><!-- end col -->


        <div class="col-lg-3 col-md-6">
            <div class="text-center card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                </div>
                <div>

                    <h4 class="header-title m-t-0 m-b-30">Need Help</h4>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Frequently Asked Questions: </strong> <span class="m-l-15"><a href="<?=base_url()?>faq">FAQ/Help</a></span></p>

                        <p class="text-muted font-13"><strong>For BlazeBay: </strong><span class="m-l-15"><a href="<?=base_url()?>site-help">Site Help</a></span></p>


                    </div>

                </div>

            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->
<?php } ?>
</div> <!-- container -->

</div> <!-- content -->

