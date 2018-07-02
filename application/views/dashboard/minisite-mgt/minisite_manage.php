<?php
$title = "minisite_pages";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
$logged_usrid= false;
$mini_image="";
$verifiaction_type="";
$operational_address="";
$licence_number="";
if(isset($this->session->userdata['logged_in']['user_id'])){ $logged_usrid = $this->session->userdata['logged_in']['user_id']; }



//--------------------------------------------------------
$busidata_biz = array();
//Category Groups::
$groupheads = $this->Site_model->getDataById($prev.'categorie_group',"group_status='1' ORDER by group_name ASC");
$empoptions = $this->Site_model->getDataById($prev.'employees',"status = 'Y' ORDER BY id DESC");

// Manage Minisite Overview::
$busi_slct  = " SELECT m.username,b.id as busi_id,b.*  FROM  ";
$busi_from = $prev."members as m
            JOIN ".$prev."business as b ON m.user_id=b.user_id";
$busi_cond = " WHERE m.suspended='N' AND b.user_id=".$this->session->userdata['logged_in']['user_id']."";
$business_info = $this->Site_model->getcountRecods($busi_slct.$busi_from.$busi_cond);
$mini_overview_image="";
//p($business_info);
$business_info=$business_info[0];
$minisite_name = $business_info['company_name'];
$miniPrefix = $business_info['minisite_prefix'];

$company_slug = RemoveBadURLCha(strtolower($minisite_name));
$company_info_path = base_url().'company-details/'.$company_slug.'/'.$business_info['id'].'/'.$business_info['user_id'];

$seller_id = $business_info['user_id'];
$https="https://";
$miniSuffix=".blazebay.com";
//-----:: COMPANY MINI SITE:: -----------------
if(!empty($miniPrefix)){
    $minisite_home      =  $https.$miniPrefix.$miniSuffix;
}else{
    $minisite_home      =  "javascript:void(0);";
}

//$minisite_url       =base_url().'minisite/home/'.$company_slug.'/'.$business_info['id'].'/';

//$minisite_aboutus   =base_url().'minisite/about-us/'.$company_slug.'/'.$business_info['id'].'/';
//$minisite_contactus =base_url().'minisite/contact-us/'.$company_slug.'/'.$business_info['id'].'/';
//$minisite_profile   =base_url().'minisite/profile/'.$company_slug.'/'.$business_info['id'].'/';

$busidata_biz['minisite_name']        = $minisite_name;
$busidata_biz['minisite_home']        = $minisite_home;

$verifiaction_desc="";
$mini_certificatin =$this->Site_model-> getRowData($prev.'minisite_indus_certify',"mini_user_id='".$this->session->userdata['logged_in']['user_id']."'");
$mini_certificatin=$mini_certificatin[0];
if(!empty($mini_certificatin)){
    $verifiaction_desc  = $mini_certificatin['mini_verification_desc'];
    $verifiaction_type  = $mini_certificatin['mini_verification_type'];
    $licence_number     = $mini_certificatin['mini_license_no'];
    $mini_image     = $mini_certificatin['mini_image'];
    $operational_address= $mini_certificatin['operational_address'];
}
function RemoveBadURLCha($str) {
    return preg_replace("/[^0-9a-zA-Z]+/", "-", $str);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="Blazebay Ecommerce">
    <meta name="robots" content="all">
    <title><?=$name?></title>
    <link rel="shortcut icon" type="image/x-icon" href="https://www.blazebay.com/assets/images/logo/FAV_8521497874673.png" />
    <?php include( APPPATH.'views/dashboard/head.php'); ?>

    <style type="text/css">
        .go-msite-link{font-size: 14px !important;margin:0;}
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            background-color: #fd7f1b !important;

        }
        p {
            line-height: 1.6;
            color: cadetblue !important;
        }
    </style>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <?php include( APPPATH.'views/dashboard/header.php'); ?>

</header>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="clearfix filters-container m-t-10">
            <!-- Button mobile view to collapse sidebar menu -->
            <?php include( APPPATH.'views/dashboard/breadcrum.php'); ?>
        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="">
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">


                    <!-- User -->
                    <?php include APPPATH.'views/dashboard/myaccount/profile.php'; ?>
                    <!-- End User -->


                    <!--- Sidemenu -->
                    <?php include APPPATH.'views/dashboard/side-menu.php'; ?>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                <div class="col-md-12">
                <div class="featuredpro">
                <h3 class="section-title">Minisite Contents
                    <a href="<?=$busidata_biz['minisite_home'];?>" target="blank" class="go-msite-link pull-right"><button>Visit Minisite</button></a>
                </h3>
                <div id="msgReplies"></div>
                <?php //$flash_msg->display(); ?>
                <ul class="nav nav-tabs tabs">
                    <li class="active"><a data-toggle="tab" href="#overview" class="padding-both-side">Company Overview</a></li>
                    <li><a data-toggle="tab" href="#certification" class="padding-both-side">Industrial Certification</a></li>

                </ul>

                <div class="tab-content">
                <div id="overview" class="tab-pane fade in active">
                   Company Overview
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <form method="post" action="#" name="frm_company_overview" id="frm_company_overview">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <!-- <img src="http://192.168.0.43/blazetraders-advance/assets/images/banners/banner-side.png" alt="Blazebay.com" title="Welcome to Blazebay.com">  -->

                                    <!-- <?php
                                    $file_count = file_exists("assets/company_banner/minisite_images/".$mini_overview_image);
                                    if ($file_count!='' && $mini_overview_image!='' ) {
                                        $file = $mini_image;
                                        $path = 'assets/company_banner/minisite_images/';
                                        $overview_image1_thumb = base_url().$path.$file;
                                    }else { $overview_image1_thumb = base_url().'assets/images/nopic.jpg'; }
                                    ?>
                    <img src="<?=$overview_image1_thumb; ?>" alt="Blazebay.com" title="">
                    <input type="file" name="image" value=""> -->


                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="short-info21">
                                        <ul class="company-text1 margin-none">
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Business Type:
                                                <span></span>

                                                <div class="checkbox-sec">
                                                    <?php
                                                    //echo $business_info['businesstypes'];
                                                    if($groupheads){
                                                        $cnt = 1;
                                                        foreach ($groupheads as $val) {
                                                            $btypeslctd="";
                                                            if(!empty($business_info['businesstypes'])) {
                                                                $businesstypes = explode(",", $business_info['businesstypes']);
                                                                if (in_array($val['group_id'], $businesstypes))
                                                                { $btypeslctd=" checked";}
                                                            }
                                                            ?>
                                                            <ul>
                                                                <li>
                                                                    <input type="checkbox" name="business_type[]" value="<?=$val['group_id']; ?>" <?=$btypeslctd;?> > <p><?=$val["group_name"];?></p>
                                                                    <div class="clear"></div>
                                                                </li>
                                                                <div class="clear"></div>
                                                            </ul>
                                                        <?php }  } ?>
                                                </div>

                                            </li>
                                            <!-- <li><i class="fa fa-check" aria-hidden="true"></i> Location :
                                            <span>
                                             <input type="text" name="loaction" class="mini-ovrvw-inpt" value="Zhejiang, China (Mainland)">
                                            </span>
                                            </li> -->
                                            <!-- <li><i class="fa fa-check" aria-hidden="true"></i> Main Products : <span>
                                            <input type="text" name="main_products" class="mini-ovrvw-inpt" value="statement necklace,earrings,pearl necklace,bracelet,brooch">

                                            </span>
                                            </li> -->
                                            <div style=" color: cadetblue !important;">
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Total Employees : <span>
                          <select name='employees' class="">
                              <option value="">Please Select</option>

                              <?php if($empoptions){
                                  foreach ($empoptions as $emp) { ?>

                                      <option value="<?=$emp["id"];?>"
                                          <?php if ($emp["id"]==$business_info['employees']){
                                              echo "  selected ";}?> > <?=$emp["employees"];?></option>

                                  <?php } } ?>

                          </select>
                          </span>
                                            </li>

                                            <li><i class="fa fa-check" aria-hidden="true"></i>Total Annual Revenue :
                        <span>
                        <input type="text" name="anual_revenue" class="form-contol" value="<?=$business_info['anual_revenue'];?> " >
                        </span>
                                            </li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Year Established : <span>

                          <select name="yearestablished" class="form-contol" required="">
                              <option value="">Please select</option>
                              <?php for ($i=date('Y'); $i >= 1900; $i--) { ?>

                                  <option  value="<?=$i;?>" <?php if ($i==$business_info['year_established']) { ?>selected="selected"<?php } ?>><?=$i; ?></option>

                              <?php } ?>
                          </select>
                        </span>
                                            </li>

                                            <!-- <li><i class="fa fa-check" aria-hidden="true"></i> Top 3 Markets :
                                              <span>
                                              Mid East 27.26%,  Domestic Market 20.54%,  South America 16.22%,
                                              </span>
                                            </li> -->
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Company Certifications :
                          <span>
                          <input type="text" name="certifications" class="form-contol" value="<?=$business_info['certifications']?>" />
                          </span>
                                            </li>
                                            </div>
                                        </ul>
                                    </div>

                                    <div class="form-group">

                                        <input type="hidden" name="business_id" value="<?=$business_info['busi_id']?>">
                                        <input type="button" class="btn btn-warning float-right" name="update_overview"  onclick="update_company_Overview()" value="Update">

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <!-- <div class="col-xs-12 col-sm-12 col-md-8 trade">
                              <h2>Trade Capacity <a href="#">View More</a></h2>
                              <h3>Trade &amp; Market</h3>
                              <table class="trade-market">
                                <tbody><tr>
                                  <th>Main Markets</th>
                                  <th>Total Revenue(%)</th>
                                </tr>
                                <tr>
                                  <td>Mid East</td>
                                  <td>27.26%</td>
                                </tr>
                              </tbody>
                              </table>
                            </div> -->

                            <!-- <div class="col-xs-12 col-sm-12 col-md-4 supplier-form1">
                            <h2>Email to this supplier</h2>

                              <form name="enquiry_form" id="minisite_enqform" action="" method="post" class="form-box padding-none supplier-form fv-form fv-form-bootstrap" novalidate="novalidate">

                                <div class="form-group col-md-12 has-feedback">
                                <label>Message</label>
                                  <textarea cols="" rows="" name="message" id="message" required""="" class="col-md-12" placeholder="Please Describe Your Requirement" data-fv-field="message"></textarea>
                                  <i class="form-control-feedback fv-icon-no-label" data-fv-icon-for="message" style="display: none;"></i>
                                  <p class="help-block" data-fv-validator="notEmpty" data-fv-for="message" data-fv-result="NOT_VALIDATED" style="display: none;">The "Message" field is required</p>
                                </div>


                                <div class="form-group col-md-12">
                                  <button type="submit" name="send_enquiry" class="btn-upper btn btn-primary checkout-page-button margin-left float-right"><i class="fa fa-paper-plane" aria-hidden="true"></i> SEND</button>
                                </div>
                                <div class="clear"></div>
                              </form>

                            </div> -->
                        </div>
                    </div>
                    <div class="clear"></div>

                </div>

                <div id="certification" class="tab-pane fade">
                    <div style=" color: cadetblue !important;">
                    <h4>Industrial Certification</h4>

                    <form name="frm_indus_certification"  id="frm_indus_certification" action="#" method="POST" enctype="multipart/form-data" >
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row">
                                <!-- Short Image Starts -->
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <?php
                                    //print_r($mini_image);
                                    if(file_exists("assets/company_banner/minisite_images/".$mini_image)) {
                                        $file = $mini_image;
                                        $path = 'assets/company_banner/minisite_images/';
                                        $image_thumb = base_url().$path.$file;
                                    }else { $image_thumb = base_url().'assets/images/nopic.jpg'; }
                                    ?>
                                    <img src="<?=$image_thumb; ?>" alt="Blazebay.com" title="">
                                    <input type="file" name="image" value="">
                                </div>
                                <!-- SHort Image Ends -->
                                <div class="col-xs-12 col-sm-12 col-md-9">
                                    <div class="short-info21">
                                        <h5>About Industrial Certification::</h5>
                                        <p>
                                            <textarea class="mini-verfydesc" name="verification_desc" style="border: 1px solid #e3e3e3;" ><?=$verifiaction_desc;?></textarea>
                                        </p>
                                        <!-- <a href="#">About Verification Services</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="short-info21">
                                        <ul class="company-text1 margin-none">
                                          Verified Information By Onsite Checked

                                            <li><i class="fa fa-check" aria-hidden="true"></i> Verification Type :
                          <span>
                          <input type="text" name="verification_type" value="<?=$verifiaction_type;?>" class="mini-verfy-inpt">
                          </span>
                                            </li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i> Business License : <span>

                        <input type="text" name="licence_number" value="<?=$licence_number;?>" class="mini-verfy-inpt">
                        </span>
                                            </li>
                                            <!-- <li><i class="fa fa-check" aria-hidden="true"></i> Business Type : <span> Manufacturer, Trading Company</span>
                                            </li> -->
                                            <li><i class="fa fa-check" aria-hidden="true"></i> Operational Address :
                          <span>
                          <p><textarea name="operational_address" class="mini-verfy-inpt"><?=$operational_address;?></textarea></p>
                          </span>
                                            </li>
                                          </div>

                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12 supplier-form1">
                            <h2 class="margin-none">Email to this supplier</h2>

                              <form name="enquiry_form" id="minisite_enqform" action="" method="post" class="form-box padding-none supplier-form fv-form fv-form-bootstrap" novalidate="novalidate">
                                <div class="form-group col-md-12 has-feedback">
                                <label>Message</label>
                                  <textarea cols="" rows="" name="message" id="message" required""="" class="col-md-12" placeholder="Please Describe Your Requirement" data-fv-field="message"></textarea>
                                  <i class="form-control-feedback fv-icon-no-label" data-fv-icon-for="message" style="display: none;"></i>
                                  <p class="help-block" data-fv-validator="notEmpty" data-fv-for="message" data-fv-result="NOT_VALIDATED" style="display: none;">The "Message" field is required</p>
                                </div>

                                <div class="form-group col-md-12">
                                  <button type="submit" name="send_enquiry" class="btn-upper btn btn-primary checkout-page-button margin-left float-right"><i class="fa fa-paper-plane" aria-hidden="true"></i> SEND</button>
                                </div>
                                <div class="clear"></div>
                              </form>

                            </div>
                          </div>
                        </div> -->
                        <div class="clear"></div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="busi_uid" value="<?=$business_info['user_id']?>">
                                <input type="button" class="btn btn-warning float-right" name="update_certify" onclick="update_company_Certification()"  value="Update Certification">
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>

                <div id="menu2" class="tab-pane fade">
                    <h4>Company Capability</h4>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14736.913093984038!2d88.43553275!3d22.5705641!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1488656988812" frameborder="0" class="trade-map" allowfullscreen=""></iframe>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="">
                            <div class="col-xs-12 col-sm-12 col-md-8 trade padding-left-none">
                                <h2>Trade Capacity <a href="#">View More</a></h2>
                                <h3>Trade &amp; Market</h3>
                                <table class="trade-market">
                                    <tbody><tr>
                                        <th>Main Markets</th>
                                        <th>Total Revenue(%)</th>
                                    </tr>
                                    <tr>
                                        <td>Mid East</td>
                                        <td>27.26%</td>
                                    </tr>
                                    <tr>
                                        <td>Mid East</td>
                                        <td>27.26%</td>
                                    </tr>
                                    <tr>
                                        <td>Mid East</td>
                                        <td>27.26%</td>
                                    </tr>
                                    <tr>
                                        <td>Mid East</td>
                                        <td>27.26%</td>
                                    </tr>
                                    <tr>
                                        <td>Mid East</td>
                                        <td>27.26%</td>
                                    </tr>
                                    </tbody></table>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 supplier-form1">
                                <h2>Email to this supplier</h2>

                                <form name="enquiry_form" id="minisite_enqform" action="" method="post" class="form-box padding-none supplier-form fv-form fv-form-bootstrap" novalidate="novalidate">





                                    <div class="form-group col-md-12 has-feedback">
                                        <label>Message</label>
                                        <textarea cols="" rows="" name="message" id="message" required""="" class="col-md-12" placeholder="Please Describe Your Requirement" data-fv-field="message"></textarea>
                                        <i class="form-control-feedback fv-icon-no-label" data-fv-icon-for="message" style="display: none;"></i>
                                        <p class="help-block" data-fv-validator="notEmpty" data-fv-for="message" data-fv-result="NOT_VALIDATED" style="display: none;">The "Message" field is required</p>
                                    </div>

                                    <!-- <div class="checkbox form-group col-md-12 float-right">
                                <label class="line-height"><input type="checkbox" class="margin-left-checkbox">
                                <p>I agree to share my Business Card to the supplier</p></label>
                              </div> -->

                                    <div class="form-group col-md-12">
                                        <button type="submit" name="send_enquiry" class="btn-upper btn btn-primary checkout-page-button margin-left float-right"><i class="fa fa-paper-plane" aria-hidden="true"></i> SEND</button>
                                    </div>
                                    <div class="clear"></div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                </div>
                <div id="menu3" class="tab-pane fade">
                    <h4>Business Performance</h4>

                </div>
                </div>

                </div>
                </div>

                </div>
            </div>



        </div>
    </div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>
<script>
    function update_company_Overview(){
        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#frm_company_overview')[0]);

        $.ajax({
            url: base_url+"update_company_Overview",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                //window.location.href=base_url+"manage-wholesale-products";
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

    function update_company_Certification(){
        var base_url="<?php echo base_url();?>";
        var formData = new FormData($('#frm_indus_certification')[0]);

        $.ajax({
            url: base_url+"update_company_Certification",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                $("#msgReplies").html(msg);
                //window.location.href=base_url+"manage-wholesale-products";
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
</script>

</body>
</html>
		