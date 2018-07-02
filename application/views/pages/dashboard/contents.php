<?php
$where = "user_id='" . $this->session->userdata['logged_in']['user_id'] . "'";
$loggedUser_details= $this->Site_model->getDataById( 'bt_members', $where );
$logged_user_lastlogin = $loggedUser_details[0] ['lastlogin'];
?>

<!-- Start content -->
<div class="content">
<div class="container">

<?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){ ?>




<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-product-hunt"></i>
                </a>

            </div>

            <h4 class="header-title m-t-0 m-b-30">Products</h4>

            <div class="widget-chart-1">

                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0"> <?=count($product_count)?> </h2>
                    <p class="text-muted">Total Products</p>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-th-list"></i>
                </a>

            </div>

            <h4 class="header-title m-t-0 m-b-30">Orders </h4>

            <div class="widget-box-2">
                <div class="widget-detail-2">

                    <h2 class="m-b-0"><?=$order_count?count($order_count):0?></h2>
                    <p class="text-muted m-b-25">Total Orders</p>
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

            </div>

            <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

            <div class="widget-chart-1">
                <div class="widget-chart-box-1">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                           data-bgColor="#FFE6BA" value="80"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0">  <?=$enquiry_count?count($enquiry_count):0?> </h2>
                    <p class="text-muted">Total Enquiries</p>
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

                <h4 class="header-title m-t-0 m-b-30">My Profile</h4>

                <div class="text-left">
                    <p class="text-muted font-13"><strong>Last Login :</strong> <span class="m-l-15"><?=date('d-M-Y', strtotime($logged_user_lastlogin));?></span></p>

                    <p class="text-muted font-13"><strong>Password:</strong><span class="m-l-15">To change your existing password <a href="#">Click Here</a></span></p>


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

            <h4 class="header-title m-t-0 m-b-30">Tradeshow</h4>

            <div class="widget-chart-1">

                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0"> <?=$trade_count?count($trade_count):0?></h2>
                    <p class="text-muted">Tradeshow</p>
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

            </div>

            <h4 class="header-title m-t-0 m-b-30">Transaction </h4>

            <div class="widget-box-2">
                <div class="widget-detail-2">
                    <h2 class="m-b-0"> 0 </h2>
                    <p class="text-muted m-b-25">Total Transactions</p>
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

            </div>

            <h4 class="header-title m-t-0 m-b-30">CRM</h4>

            <div class="widget-chart-1">
                <div class="widget-chart-box-1">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                           data-bgColor="#FFE6BA" value="80"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0"> 4 </h2>
                    <p class="text-muted">Total Notifications</p>
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
                    <p class="text-muted font-13"><strong>Frequently Asked Questions: </strong> <span class="m-l-15"><a href="#">FAQ/Help</a></span></p>

                    <p class="text-muted font-13"><strong>For BlazeBay: </strong><span class="m-l-15"><a href="#">Site Help</a></span></p>


                </div>

            </div>

        </div>
    </div><!-- end col -->

</div>
<!-- end row -->

<?php } ?>
<?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==1){ ?>

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-folder-open"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">Transactions</h4>

                <div class="widget-chart-1">
                    <span class="badge badge-success pull-left m-t-20"></span>


                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0">0 </h2>
                        <p class="text-muted">Total Transactions</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-shopping-basket"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">Orders </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">

                        <h2 class="m-b-0"><?=$order_count?count($order_count):0?> </h2>
                        <p class="text-muted m-b-25">Total Orders</p>
                    </div>

                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-phone"></i>
                    </a>

                </div>

                <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">

                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 4569 </h2>
                        <p class="text-muted">Total Enquiries</p>
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
</div> <!-- container -->

</div> <!-- content -->

