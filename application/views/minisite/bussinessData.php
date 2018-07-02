<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<?php
$websitePath="https://www.blazebay.com/";
$mvpath= "https://".$_SERVER['SERVER_NAME'] . "/";
//$mvpath="http://blazebay/minisite";

//uploaded File & Image Folders
define("BLAZE_UPLOADIMAGES_DIR", 		 $mvpath."assets/uploadedimages/");
define("BLAZE_BUSINESS_LOGO_DIR", 		 $mvpath."assets/uploadedimages/");
define("BLAZE_BUSINESS_BANNER_DIR", 	 $mvpath."assets/company_banner/");
define("BLAZE_PRODUCT_DIR_VPATH", 		 $mvpath."assets/uploadedimages/");
define("BLAZE_PRODUCT_DIR_APATH", 		 $mvpath."assets/uploadedimages/");

//Default Image Path
define("BLAZE_NO_IMAGE_VPATH", 			 $mvpath."assets/uploadedimages/default/no-image.jpg");
define("BLAZE_DEFAULT_IMAGE_VPATH", 	 $mvpath."assets/uploadedimages/default/no-image.jpg");
define("BLAZE_DEFAULT_USERIMG_VPATH", 	 $mvpath."assets/upload_image/profile_picture/default/useravtar.png");


define("BLAZE_DEFAULT_COMPANY_BANNER_VPATH",  $mvpath."company_banner/default/default-company-banner_20030117.jpg");

//====== Defined blazebay Directory & Paths :: Ends =====

//====== Defined Constants ::  Ends ======

//====== Defined Constant Tabels Name :: Starts ======
$prev="bt_";
$settingTable 				= $prev . "setting";
$membersTable 				= $prev . "members";
$businessTable 				= $prev . "business";
$orderTable 				= $prev . "order";
$orderSupplierTable 		= $prev . "order_supplier";
$businessBannerTable 		= $prev . "business_banners";
$categoryGroupTable 		= $prev.  'categorie_group';
$categoryTable          	= $prev . "categories";
$productTable 				= $prev.  'products';
$productCategoryTable   	= $prev . "product_cats";
$mailTemplatesTable   		= $prev . "mailtemplates";	//mail template table
$employeesTable 			= $prev . "employees";

$minisiteIndusCertifyTable  = $prev . 'minisite_indus_certify';

$masterThemeTable   		= $prev . "master_theme";	//master theme table
$userThemeTable   			= $prev . "user_theme";		//user theme table


define("TABLE_SETTING", 		$settingTable);			//Setting Table
define("TABLE_MEMBER", 			$membersTable);			//Member Table
define("TABLE_BUSINESS",		$businessTable);		//Business TAble
define("TABLE_ORDER", 			$orderTable);
define("TABLE_ORDER_SUPPLIER",	$orderSupplierTable);
define("TABLE_ORDER_COURIER" ,	"");
define("TABLE_BUSINESS_BANNER",	$businessBannerTable);
define("TABLE_CATEGORY_GROUP",	$categoryGroupTable);
define("TABLE_CATEGORY" ,		$categoryTable);
define("TABLE_PRODUCT" ,		$productTable);
define("TABLE_PRODUCT_CATEGORY",$productCategoryTable);

define("TABLE_MAIL_TEMPLATES",	$mailTemplatesTable);
define("TABLE_EMPLOYEES",		$employeesTable);

define("TABLE_MASTER_THEME",	$masterThemeTable);
define("TABLE_USER_THEME",		$userThemeTable);


define("TABLE_MINISITE_INDUS_CERTIFY",	$minisiteIndusCertifyTable);


//======= For Minisite Received url parameters:: Starts =======
$urlParts = explode('.', str_replace("www.","",$_SERVER['SERVER_NAME']));
//$urlParts = explode('.', str_replace("www.","","chandaria_industries.blazebay.com"));
$busi_data="";
$busi_id="";
//print_r($urlParts);exit;
if(count($urlParts)==3)
{
    $minisite_prefix = $urlParts[0];
    //echo $minisite_prefix;
    $where  = "minisite_prefix='". $minisite_prefix."'";
    $busi_data= $this->Mini_site_model->getDataById($table="bt_business",$where);


    if(!empty($busi_data)){

        $_GET['busi_id'] = $busi_data[0]['id'];
        $busi_id		 = $busi_data[0]['id'];
        $mvpath 		 = "https://".$_SERVER['SERVER_NAME'] . "/";
       // $mvpath 		 = "https://".$_SERVER['SERVER_NAME'] . "/";
    }else{
        header("location:". $mvpath);
    }
}
//======= For Minisite Received url parameters::  Ends =======
//echo $_SERVER['SERVER_NAME'];
//p($urlParts);


//========= Get Site Settings ==========
$where="site_maintenance<> '' LIMIT 1 ";
$setting= $this->Mini_site_model->getDataById($table="bt_setting",$where);

$setting=$setting[0];
if($setting['site_maintenance']=='Y'){ ?>
    <script type="text/javascript">
        window.location.href = 'siteundermaintainance';
    </script>
<?php }

// Current Link::
$SETTING_HEADER_CURRENT_URL = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//========== Assigning Session Variables :: ========
$MY_SESSION_ID = session_id();
$_SESSION['MY_SESSION_ID']				= $MY_SESSION_ID;
$_SESSION['SETTING_EMAIL_TECHNICAL']	= $setting['support_mail'];
$_SESSION['SETTING_EMAIL_ENQUIRY']		= $setting['enquiry_email'];
$_SESSION['SETTING_EMAIL_SALES']		= $setting['sales_email'];
$_SESSION['SETTING_ADMIN_EMAIL']		= $setting['admin_mail'];
$_SESSION['SETTING_ADMIN_PERCENT']		= $setting['order_percentage'];
$_SESSION['SETTING_SITE_TAGLINE']		= $setting['site_tagline'];
$_SESSION['SETTING_SITE_CONTACT']		= $setting['telephone'];
$_SESSION['SETTING_SITE_ADDRESS']		= $setting['address'];
$_SESSION['SETTING_DEFAULT_CURRENCY']   = $BB_CURRENCY = $setting['currency'];

//=========DYNAMIC META KEYWORDS:: ===============
$CURRENT_PAGE_TITLE = ucwords( $busi_data[0]['company_name'] );

//minisite Meta Description
if(!empty($busi_data[0]['about'])){
    //$META_DESCRIPTION 	= ucwords( html_entity_decode( strip_tags( $busi_data['about']) ) );
    $META_DESCRIPTION = $CURRENT_PAGE_TITLE;
}else{
    $META_DESCRIPTION 	= $CURRENT_PAGE_TITLE;
}
//minisite Meta Keywords
if(!empty($busi_data[0]['services'])){
    //$META_KEYWORDS 	= ucwords( html_entity_decode( strip_tags( $busi_data['services'] )));
    $META_KEYWORDS = $CURRENT_PAGE_TITLE;
}else{
    $META_KEYWORDS 	= $CURRENT_PAGE_TITLE;
}


$SITE_META_TITLE    = $CURRENT_PAGE_TITLE;
$SITE_META_KEYWORDS = "";
$SITE_META_DESCRIPTION = "";

$META_TITLE 		= $CURRENT_PAGE_TITLE;
$META_KEYWORDS 		= $CURRENT_PAGE_TITLE;
//------------------------------------------------


if(isset($_REQUEST['id'])){
    $ids = $_REQUEST['id'];
}
$url_path 	= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ;
$parse 		= parse_url($url_path);
$host 		=  $parse['host'];
$url 		= $_SERVER['REQUEST_URI'];
$file 		= $_SERVER["PHP_SELF"]  ;
$var 		= $_SERVER["QUERY_STRING"]  ;
$pathWithoutSlash = substr($file, 14);

$description="";
$type		="";
$title		="";
$image		="";
$minisite_urlParts = explode('.', str_replace("www.","",$_SERVER['SERVER_NAME']));
//$minisite_urlParts = explode('.', str_replace("www.","","chandaria_industries.blazebay.com"));


if(count($minisite_urlParts)==3)
{

    $minisite_prefix = $minisite_urlParts[0];

    $check_minisite_business_details_SQL = "SELECT id,user_id FROM  bt_business WHERE minisite_prefix ='$minisite_prefix'";
    //$check_minisite_business_details_SQL = "SELECT id,user_id FROM  bt_business WHERE minisite_prefix ='chandaria_industries'";
    $check_minisite_exists= $this->Mini_site_model->getcountRecods($check_minisite_business_details_SQL);

    //If Exists Enter The Block
    if(!empty($check_minisite_exists)){
        $check_minisite_business_details_RESULT =$check_minisite_exists;
        $business_id = $check_minisite_business_details_RESULT[0]['id'];
        $member_id 	 = $check_minisite_business_details_RESULT[0]['user_id'];

        $supplier_id = $supplierId = $member_id;
        $businessId  = $business_id;
        $supplierUniqueKey = strtolower($minisite_prefix);

        $_GET['busi_id'] = $business_id;
        $busi_id		 = $business_id;
        $mvpath 		 = "https://".$_SERVER['SERVER_NAME'] . "/";

        //=====check User Active Theme=====
        /*$activeThemeData = get_minisite_user_supplier_ActiveTheme($supplier_id);
        //print($activeThemeData);die;

        if($activeThemeData){
            $activeTheme_id = $activeThemeData;
        }else{
            $activeTheme_id = "";
        }*/

        if(empty($activeTheme_id)){

            //======== Load Default Minisite Theme : Starts ===========
            //echo "Default";
            //include('mini-index.php');
            //======== Load Default Minisite Theme : Ends ===========

        }
        else
        {
            //##============= Show User Selected Theme :: Starts ================##

            $minisiteDirectory = "publish_minisite/";

            //====== Defined Constants :: Starts ======
            define("HTTPS", 			$https);				// For HTTPs
            define("VPATH", 			$mvpath);				// For Virtual Path/Url Path
            define("APATH", 			APATH);				// For Absolute Path/Uploading path
            define("MINI_DIR", 			$minisiteDirectory);	// Fro minisite Directory
            define("MINI_DIR_VPATH", 	$mvpath.$minisiteDirectory);					// For minisite Directory vpath
            define("MINI_DIR_APATH", 	base_url_().$minisiteDirectory);					// For minisite Directory vpath



            //MInisite Constant Defined For Minisite PAth

            //$CONSTANT_SUPPLIER_PATH = $supplierUniqueKey . "/";
            $CONSTANT_SUPPLIER_PATH = $minisiteDirectory;

            define('MINI_HOME', 		$mvpath );   //MInisite Home
            define('MINI_VPATH', 		$mvpath );  	//MInisite Vpath
            define("MINI_APATH", 		APATH . $CONSTANT_SUPPLIER_PATH);  	//MInisite Apath
            define("MINI_UNIQUE_KEY", 	$supplierUniqueKey);          		//MInisite Unique KEy
            define("MINI_BUSINESS_ID", 	$businessId);                		//business id
            define("MINI_MEMBER_ID", 	$supplierId);                  		//Member/Supplier ID
            define("MINI_THEME_ID", 	$activeTheme_id);               	//Member Active Theme ID


            //===== Defined Constant :: User's Folder path : Starts ======

            $userThemeFolder = "";
            if(!empty(MINI_THEME_ID)){
                $userThemeFolder = "themes/";
                //$user_folderpath = MINI_MEMBER_ID."/".MINI_THEME_ID.'/';
                $user_folderpath = MINI_MEMBER_ID."/".$userThemeFolder.MINI_THEME_ID.'/';
            }

            //defined Constants As Minisite User's Directory
            define("MINI_USER_THEME_FOLDER" , $userThemeFolder);
            define("MINI_USER_FOLDER"       , $user_folderpath);
            define("MINI_USER_FOLDER_VPATH" , MINI_DIR_VPATH.MINI_USER_FOLDER);
            define("MINI_USER_FOLDER_APATH" , MINI_DIR_APATH.MINI_USER_FOLDER);

            //===== Defined Constant :: User's Folder path : Ends ======

            //====== Defined Url Links Or Site Link : Starts =======
            define("LINK_HOME",                MINI_HOME.'home/');
            define("LINK_ABOUT_US",            MINI_HOME.'m/about-us/');
            define("LINK_CONTACT_US",          MINI_HOME.'m/contact-us/');
            define("LINK_OVERVIEW",            MINI_HOME.'m/overview/');
            define("LINK_TRUSTPASS_PROFILE",   MINI_HOME.'m/trustpass-profile/');
            define("LINK_CATEGORY",   MINI_HOME.'m/category/');

            //====== Defined Url Links Or Site Link : Starts =======

            /*=======================================*/
            $MINI_SITE_URL_SEGMENTS = "";
            if(isset($_SERVER['REQUEST_URI'])){
                $MINI_SITE_URL_SEGMENTS = $_SERVER['REQUEST_URI'];
            }

            //include("publish_minisite/index.php");
            include(MINI_DIR_APATH."index.php");

            //##============= Show User Selected Theme :: Ends ================##
        }

    }else{

        //If Minisite Not Found Redirect To Home page

        header("location:". $mvpath);

    }
}else{

}

$current_link = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

//Get Currency

$where="id =1";
$pcurrency_info= $this->Mini_site_model->getDataById($table="bt_setting",$where);
$pcurrency      = $pcurrency_info[0]['currency'];

// Send Enquiry to Seller::
if(isset($_POST['send_enquiry'])) {
    if(!empty($_POST['message']) && !empty($_POST['email']) && !empty($_POST['phone'])){

        $enq_name = $_POST['full_name'];
        $enq_email = $_POST['email'];
        $enq_phone = $_POST['phone'];
        $enq_subject = htmlentities($_POST['subject']);
        $enq_message = htmlentities($_POST['message']);
        $enq_product="";
        $user_ip="";
        if(isset($_SERVER['REMOTE_ADDR'])){$user_ip=$_SERVER['REMOTE_ADDR'];}

        $enquire_data = array(
            'message'  => htmlentities($_POST['message']),
            'email'    => $_POST['email'],
            'phone'    => $_POST['phone'],
            'prod_id'  => "",
            'user_id'  => 0,
            'full_name'=> $_POST['full_name'],
            'subject'  => htmlentities($_POST['subject']),
            'user_ip'  => $user_ip,
        );

        $enquired_return = Insert_data_into_table($prev.'enquiry', $enquire_data);
        if($enquired_return == "DONE"){

            $SITE_SETTING = getRowData($prev.'setting',"*","id = '1'");
            $SITELOGO           = $SITE_SETTING['site_logo'];
            $FROM_ACCOUNT_EMAIL = $SITE_SETTING['enquiry_email'];
            $SITELOGO_VPATH     = $vpath.'images/logo/'.$SITE_SETTING['site_logo'];

            $site_name = $dotcom;
            $subj = "{@SITE_NAME} : Enquiry";
            $subj = str_replace("{@SITE_NAME}", $site_name, $subj);
            $mail_msg = file_get_contents("mailtemplates/enquiry.txt");

            $mail_msg = str_replace("{@COMPUSER}", $enq_name, $mail_msg);
            $mail_msg = str_replace("{@EMAIL}", $enq_email, $mail_msg);
            $mail_msg = str_replace("{@MOBILE}", $enq_phone, $mail_msg);
            $mail_msg = str_replace("{@PRODUCT}", $enq_product, $mail_msg);
            $mail_msg = str_replace("{@SITE_NAME}", $site_name, $mail_msg);

            $mail_msg = str_replace("{@MESSAGE}", $enq_message, $mail_msg);
            $mail_msg = str_replace("{@SUBJECT}", $enq_subject, $mail_msg);

            $mail_msg = str_replace("{@SITELOGO_VPATH}", $SITELOGO_VPATH, $mail_msg);

            //$msg = str_replace("{@SITEURL}", $script_url, $msg);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <" . $FROM_ACCOUNT_EMAIL . ">\r\n";
            $headers .= "Cc: " . $FROM_ACCOUNT_EMAIL . "\r\n";

            //mail($email, $subj, $msg, $headers);
            if (!mail($enq_email, $subj, $mail_msg, $headers)) {
                $flash_msg->error('Failed to Send Mail.');
            }else {
                $flash_msg->success("Enquiry Send Successfully.");
            }
        }else{
            $flash_msg->error("Oops.! Failed Due to Network Issue.");
        }
        header("location:$current_link");
        die();

    }
}

$busidata_biz = array();
$mainproducts = array();
$business_data = FALSE;
if(isset($busi_id) &&  !empty($busi_id) ){

    $business_id = $busi_id;

    // COMPANY INFO::

    $where="id='$business_id'";
    $business_data= $this->Mini_site_model->getDataById($table="bt_business",$where);

    $company_encoded_name =urlencode(strtolower($business_data[0]['company_name']));
    $company_info_path =$mvpath.'company-details/'.RemoveBadURLCharaters($company_encoded_name).'/'.$business_data[0]['id'].'/'.$business_data[0]['user_id'];

    $seller_id = $business_data[0]['user_id'];

    // COMPANY MINI SITE::
    $minisite_url 		= $mvpath;
    $minisite_home 		= $mvpath;
    $minisite_aboutus 	= $mvpath.'m/about-us/';
    $minisite_contactus	= $mvpath.'m/contact-us/';
    $minisite_profile 	= $mvpath.'m/profile/';

    // BUSINESS TYPES::
    $bustype_name="";
    $business_typearr = array();
    if(!empty($business_data[0]['businesstypes'])){
        $busitypelist   = $business_data[0]['businesstypes'];
        $where="group_id IN(".$busitypelist.")";
        $bustype_data= $this->Mini_site_model->getDataById($table="bt_categorie_group",$where);
        foreach ($bustype_data as $val) {
            array_push($business_typearr, $val['group_name']);
        }
        $bustype_name=implode(', ', $business_typearr);
    }

    //get year Establishment
    $yearEstablishedOn = "N/A";
    if(!empty($business_data[0]['year_established']) && $business_data[0]['year_established'] >0){
        $yearEstablishedOn = $business_data[0]['year_established'];
    }


    $busidata_biz['business_uid']        = $seller_id;
    $busidata_biz['business_info']       = $business_data[0];
    $busidata_biz['EXTRA-ADDED-DATA']    = "EXTRA ADDED DATA";
    $busidata_biz['company_info_path']   = $company_info_path;
    $busidata_biz['company_encoded_name']= $company_encoded_name;
    $busidata_biz['few_mainproducts']    = "";
    $busidata_biz['busitype_list']       = "";

    $busidata_biz['minisite_home']        = $minisite_home;
    $busidata_biz['minisite_aboutus']     = $minisite_aboutus;
    $busidata_biz['minisite_contactus']   = $minisite_contactus;
    $busidata_biz['minisite_profile']     = $minisite_profile;

    $busidata_biz['busitype_name']       = $bustype_name;
    $busidata_biz['yearEstablishedOn']       = $yearEstablishedOn;
    $fewmain_products = "";

    //-------PRODUCTS LIST::---------

    $where="uid='$seller_id' AND approved='yes' AND wholesale='0' ORDER BY id DESC";
    $top_products= $this->Mini_site_model->getDataById($table="bt_products",$where);


    if($top_products){
        $mainpro_count=1;

        foreach ($top_products as &$val) {

            $pid = $val['id'];
            $ptitle= RemoveBadURLChars(strtolower($val['title']));
            //$purl = $vpath."product-details/".$ptitle."/".$pid."/".$val['uid'];

            $purl = $mvpath."m/product-details/".$ptitle."/".$pid."/";

            //Get Currency

            $where="id =1";
            $pcurrency_info= $this->Mini_site_model->getDataById($table="bt_setting",$where);
            $pcurrency      = $pcurrency_info[0]['currency'];

            //Product Image
            $pimg =$val['image'];

            if($pimg!='') {
                $file_count = file_exists('assets/uploadedimages/'.$pimg);
                if ($file_count!='') {
                    $img_path1 =$pimg;
                    $file1 =$img_path1;
                    $path  ='uploadedimages';
                    $pimg_path =$websitePath.'assets/uploadedimages/'.$pimg;
                }else { $pimg_path=$websitePath.'assets/images/nopic.jpg';    }
            }else { $pimg_path=$websitePath.'assets/images/nopic.jpg'; }

            // Product Rating Starts
            //   $prate_info = getRowData($prev.'ratings','avg(rating) as star_rate',"ratedto='$pid' AND type_rate='P'");

            $where="ratedto='$pid' AND type_rate='P'";
            $prate_info= $this->Mini_site_model->getDataById($table="bt_ratings",$where);

            $prate_content = "";
            $star_rate = 0;
            if($prate_info[0]['rating'] !="" || $prate_info[0]['rating'] != null) {
                for($rcnt=0; $rcnt<$prate_info[0]['star_rate']; $rcnt++) {
                    $prate_content .= "<i class='fa fa-star' aria-hidden='true'></i>";
                }
                $star_rate = $rcnt;
            }
            for($star_blank=0; $star_blank < (5-$star_rate); $star_blank++) {
                $prate_content .= "<i class='fa fa-star-o' aria-hidden='true'></i>";
            }

            $pprice        = $val['price'];   // Product Original Price
            $psell_price   = $pprice;
            $poffer_price  = "";

            $where="prod_id = '$pid'";
            $poffer_info= $this->Mini_site_model->getDataById($table="bt_offers",$where);

            $poffer_percent="";
            if($poffer_info)
            {
                $poffer_price = $poffer_info[0]['offer_price'];
                $psell_price  = $poffer_price;
                // Percentage:
                $poffer_percent = parcentage_calulate($pprice,$poffer_price);
            }

            $val['pdetail_url']     = $purl;
            $val['pimg_thumb_path'] = $pimg_path;
            $val['prating']         = $prate_content;
            $val['pcurrency']       = $pcurrency;
            $val['pprice']          = $pprice;
            $val['psell_price']     = $psell_price;
            $val['poffer_price']    = $poffer_percent;
            $val['poffer_percent']  = $poffer_percent;

            //SHORT MAIN PRODUCTS::
            if($mainpro_count <3){
                $fewmain_products .= $val['title'].', ';
                array_push($mainproducts,array('id'=>$pid,'title'=>$val['title']));

                $mainpro_count++;
            }

        }
        $fewmain_products = rtrim($fewmain_products,', ');
        $busidata_biz['few_mainproducts'] = ucwords($fewmain_products);
    }

    // ------ Wholesale Products:: -----

    $where="uid='$seller_id' AND approved='yes' AND wholesale='1' ORDER BY id DESC";
    $top_wholesale_products= $this->Mini_site_model->getDataById($table="bt_products",$where);



    if($top_wholesale_products){
        foreach ($top_wholesale_products as &$val) {

            $pid = $val['id'];
            $ptitle= RemoveBadURLChars(strtolower($val['title']));
            //$purl = $vpath."wholesale/product-details/".$ptitle."/".$pid."/".$val['uid'];

            $purl = $mvpath."m/wholesale-product-details/".$ptitle."/".$pid."/";


            //Product Image
            $pimg =$val['image'];
            if($pimg!='') {
                if(file_exists('assets/uploadedimages/'.$pimg))
                {

                    $path  = $mvpath.'assets/uploadedimages/';
                    $pimg_path =$path.$pimg;
                }else { $pimg_path = $mvpath.'assets/images/nopic.jpg';    }
            }else { $pimg_path = $mvpath.'assets/images/nopic.jpg'; }

            // Product Rating Starts
            $where="ratedto='$pid' AND type_rate='P'";
            $prate_info= $this->Mini_site_model->getDataById($table="bt_ratings",$where);

            $prate_content = "";
            $star_rate = 0;
            if($prate_info[0]['rating'] !="" || $prate_info[0]['rating'] != null) {
                for($rcnt=0; $rcnt<$prate_info[0]['star_rate']; $rcnt++) {
                    $prate_content .= "<i class='fa fa-star' aria-hidden='true'></i>";
                }
                $star_rate = $rcnt;
            }
            for($star_blank=0; $star_blank < (5-$star_rate); $star_blank++) {
                $prate_content .= "<i class='fa fa-star-o' aria-hidden='true'></i>";
            }

            $pprice        = $val['price'];   // Product Original Price
            $psell_price   = $pprice;

            $val['pdetail_url']     = $purl;
            $val['pimg_thumb_path'] = $pimg_path;
            $val['prating']         = $prate_content;
            $val['pcurrency']       = $pcurrency;
            $val['pprice']          = $pprice;
            $val['psell_price']     = $psell_price;
        }
    }
    //------------ Wholesale Products Ends---------

}
function parcentage_calulate($pprice,$poffer_price){

    return $poffer_price/$pprice*100;
}

function RemoveBadURLChars($str) {
    return preg_replace("/[^0-9a-zA-Z]+/", "-", $str);
}

	$busi_id = $busi_id;    
	$where="id='$busi_id'";
    $business_data= $this->Mini_site_model->getDataById($table="bt_business",$where);
	
	$minisite_companyinfo = $business_data;
	$minisite_companyName = $business_data[0]['company_name'];
	$qry=" SELECT banner_image FROM bt_business_banners WHERE business_id='$busi_id' AND banner_status='Y' ORDER BY banner_id DESC";
    $minisite_bannerlist= $this->Mini_site_model->execute($qry);

$minisiteActiveLink = "";

$minisite_header = array();
if(isset($busi_id) &&  !empty($busi_id) ){
    $busi_id = $busi_id;
    // COMPANY INFO::
    $where="id='$busi_id'";
    $busi_data= $this->Mini_site_model->getDataById($table="bt_business",$where);
    if($busi_data){
        $busi_usrid = $busi_data[0]['user_id'];
        $company_encoded_name 	= RemoveBadURLChars(strtolower($busi_data[0]['company_name']));
        $company_info_path 		= $mvpath.'company-details/';

        // COMPANY MINI SITE::
        $minisite_url 		= $mvpath;
        $minisite_home 		= $mvpath;
        $minisite_aboutus 	= $mvpath.'m/about-us/';
        $minisite_contactus	= $mvpath.'m/contact-us/';
        $minisite_profile 	= $mvpath.'m/profile/';

        $minisite_url_overview 		  = $mvpath.'m/overview/';
        $minisite_url_tradecapability = $mvpath.'m/trade-capability/';
        $minisite_url_trustpass 	  = $mvpath.'m/trustpass-profile/';

        // COMPANY LOGO::
        $comlogo =$busi_data[0]['company_logo'];
        $minisite_logo ="";
        if (file_exists("assets/uploadedimages/".$comlogo)) {
            $minisite_logo = $mvpath.'assets/uploadedimages/'.$comlogo;
        }else {

            $minisite_logo = $mvpath.'assets/company_banner/BB-logo.png';
        }

        // category list::
        /*	$minicat_froQ = "SELECT DISTINCT c.id,c.cat_name  FROM bt_product_cats as pc JOIN bt_products as p ON p.id=pc.offer_id JOIN bt_categories
            as c ON c.id = pc.cid WHERE p.approved ='yes' AND  p.uid='$busi_usrid' ORDER BY c.cat_name";

        //print_r($minicat_froQ);

            $minisite_category= $this->Mini_site_model->getcountRecods($minicat_froQ);
            if($minisite_category){
                foreach($minisite_category as $val){

                    $minisite_catslug = RemoveBadURLChars(strtolower($val['cat_name']));
                    $minisite_catpro_url =$mvpath."m/category/".$minisite_catslug.'/'.$val['id'].'/';
                    $val['minisite_category_products'] = $minisite_catpro_url;
                }
            }*/
        $minicat_froQ = "SELECT pc.*,c.cat_name FROM
		               ".$prev."product_cats as pc
						JOIN ".$prev."products as p ON p.id=pc.offer_id
						JOIN ".$prev."categories as c ON c.id = pc.cid
		                WHERE p.approved ='yes' AND p.uid='$busi_usrid'   GROUP BY pc.cid ORDER BY c.cat_name";

        $minisite_category= $this->Mini_site_model->getcountRecods($minicat_froQ);
        if($minisite_category){
            foreach($minisite_category as &$val){

                $minisite_catslug = RemoveBadURLChars(strtolower($val['cat_name']));
                $minisite_catpro_url =$mvpath."m/category/".$minisite_catslug.'/'.$val['cid'].'/';
                $val['minisite_category_products'] = $minisite_catpro_url;
            }
        }



        $minisite_header['minisite_category']    = $minisite_category;

        //print_r($val['minisite_category_products']);

        $minisite_header['company_id']           = $busi_id;
        $minisite_header['company_info']         = $busi_data;
        $minisite_header['company_phone']        = $busi_data[0]['phone'];
        $minisite_header['EXTRA-ADDED-DATA']     = "EXTRA ADDED DATA";
        $minisite_header['company_info_path']    = $company_info_path;
        $minisite_header['company_encoded_name'] = $company_encoded_name;
        $minisite_header['minisite_logo']        = $minisite_logo;
        $minisite_header['minisite_name']        = $busi_data[0]['company_name'];
        $minisite_header['company_minisite_url'] = $minisite_url;

        // business Other data::
        $minisite_header['minisite_url']         = $minisite_url;
        $minisite_header['minisite_url_home']    = $minisite_home;
        $minisite_header['minisite_url_aboutus'] = $minisite_aboutus;
        $minisite_header['minisite_url_contacus']= $minisite_contactus;
        $minisite_header['minisite_url_profile'] = $minisite_profile;

        $minisite_header['minisite_url_overview'] = $minisite_url_overview;
        $minisite_header['minisite_url_tradecapability'] = $minisite_url_tradecapability;
        $minisite_header['minisite_url_trustpass'] = $minisite_url_trustpass;
    }
} else{

}

?>

