<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <?php include(APPPATH.'/views/layout/mainheader.php'); ?>
        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <?php include(APPPATH.'/views/layout/menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="body-content">
        <div class="container">


            <div class="checkout-box faq-page">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="heading-title"><?=$name?></h2>

                        <div class="col-md-12">
                        <?php
                        if(!empty($id)){

                            $tradeshow_id = $id;	//Trade Show Primary key
                            //get Trade Details
                            //$getTradeDetails = getRowData($tradeshowTable, "*", "tradeshow_id ='$tradeshow_id'");
                            $getTradeDetails =$this->Site_model->getTradeShowList($tradeshow_id);

                            //chcek if trade exists
                            if($getTradeDetails){

                            }
                            $trade_det = $getTradeDetails[0];
                        }

                        if($getTradeDetails){ ?>
                            <div class="trades">
                            <h3><?php echo ucwords($trade_det['tradeshow_name'])?></h3>
                            <div class="tradebox">
                            <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="trade_img2">
                                    <?php

                                    $file 	= $getTradeDetails[0]['tradeshow_img'];
                                    $path	='assets/trade/';
                                    $image_thumb	=base_url().$path.$file;
                                    if($trade_det['tradeshow_img']==''){?>
                                        <img alt="" style="max-width:350px;" src="<?php echo base_url();?>images/nopic.jpg" alt="<?php echo ucwords($trade_det['tradeshow_name'])?>" >
                                    <?php
                                    }else{ ?>
                                        <img  style="max-width:350px;" src="<?=$image_thumb;?>" />
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <div class="tradetext full-width">
                                    <table align="center" width="100%">
                                        <tr>
                                            <td width="15%" class="b2b-1"><span>Venue:</span></td>
                                            <td width="85%">
                                                <p>
                                                    <?php
                                                    if($trade_det['tradeshow_venue'] == '') {
                                                        echo 'N/A' ;
                                                    } else {
                                                        echo ucwords($trade_det['tradeshow_venue']);
                                                    }
                                                    ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="b2b-2">
                                                <span>Date:</span>
                                            </td>
                                            <td>
                                                <p>
                                                    <?php echo date('d-M-Y',strtotime($trade_det["tradeshow_date"]));?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="b2b-3">
                                                <span>End Date:</span>
                                            </td>
                                            <td>
                                                <p>
                                                    <?php echo date('d-M-Y',strtotime($trade_det["enddate"]));?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="b2b-4">
                                                <span>Frequency :</span>
                                            </td>
                                            <td>
                                                <p>
                                                    <?php if($trade_det["frq_period"]=='A'){
                                                        echo "Annual";
                                                    }elseif($trade_det["frq_period"]=='T'){
                                                        echo "Twice a year";
                                                    }else{
                                                        echo "Biennial";
                                                    }
                                                    ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="b2b-5">
                                                <span>Open to :</span>
                                            </td>
                                            <td>
                                                <p>
                                                    <?php if($trade_det["open_to"]=='T'){
                                                        echo "Trade Visitors";
                                                    }elseif($trade_det["frq_period"]=='G'){
                                                        echo "General Public";
                                                    }else{
                                                        echo "Trade Visitors And General Public";
                                                    }
                                                    ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="b2b-6">
                                                <span>Categories :</span>
                                            </td>
                                            <td>
                                                <p>
                                                    <?php
                                                    $business_category = $trade_det['category'];
                                                    $cat = explode(',',$business_category);
                                                    foreach($cat as $key) {
                                                        $_QUERY = "SELECT  cat_name,id FROM bt_categories ";
                                                        $catname =$this->Site_model->getcountRecods($_QUERY);
                                                        if($catname == '') {
                                                            echo 'N/A';
                                                        } else {
                                                            echo $catname[0]['cat_name'];
                                                        }
                                                    } ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <table align="center" width="100%">
                                    <tr>
                                        <td width="10%" class="b2b-7">
                                            <span>Website :</span>
                                        </td>
                                        <td width="90%">
                                            <p>
                                                <?php
                                                if($trade_det["show_website"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["show_website"];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="b2b-1">
                                            <span>Last fair report:</span>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                if($trade_det["lastfair_report"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["lastfair_report"];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="b2b-2">
                                            <span>Official Hotel:</span>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                if($trade_det["official_hotels"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["official_hotels"];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="b2b-3">
                                            <span> Official Airlines:</span>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                if($trade_det["official_airlines"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["official_airlines"];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="b2b-4">
                                            <span>Product Profile:</span>
                                        </td>
                                        <td>
                                            <p><?php
                                                if($trade_det["product_profile"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["product_profile"];
                                                }
                                                ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="b2b-5">
                                            <span>Visitor Profile:</span>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                if($trade_det["visitor_profile"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["visitor_profile"];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="b2b-6">
                                            <span>Posted By:</span>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                if($trade_det["business_name"] == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo $trade_det["business_name"];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">									<table align="center" width="100%" class="blazetraders_tradedescrip">
                                    <tr>
                                        <td>
                                            <span>Description:</span>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo html_entity_decode($trade_det['description'])?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="clearfix"></div>
                            </div>
                            </div>
                            </div>
                        <?php }else{ ?>
                            <div class="trades">
                                <div class="tradebox">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>No Details Found</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        </div>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->

</div>
            </div>


    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">


        <?php include(APPPATH.'/views/layout/footerbottom.php'); ?>
        <?php include(APPPATH.'/views/layout/copyright.php'); ?>

    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->


    <!-- For demo purposes – can be removed on production -->


    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <?php include(APPPATH.'/views/layout/footer.php'); ?>


    <script>
        $(document).ready(function(){
            $(".changecolor").switchstylesheet( { seperator:"color"} );
            $('.show-theme-options').click(function(){
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function() {
            $('.show-theme-options').delay(2000).trigger('click');
        });
    </script>


</body>
</html>