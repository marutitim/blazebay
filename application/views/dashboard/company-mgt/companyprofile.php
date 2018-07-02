<?php
$pagename = "companyprofile";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

$prev="bt_";

//$flash_msg = new \Plasticbrain\FlashMessages\FlashMessages();

$busidata_aiz = array();
// GROUP HEAD::

$qry=" SELECT * FROM bt_categorie_group WHERE group_status=1 ORDER by group_name ASC";
$groupdata  = $this->Site_model->getcountRecods($qry);

// CATEGORY DATA::
//$category_list = $this->Site_model->getcountRecods($prev.'categories','*',"status='Y' ORDER by group_name ASC",TRUE);
$joincat_slct  = " SELECT cat.*  FROM ";
$joincat_from  = "bt_categories as cat JOIN  bt_categorie_group as cg ON cat.group_id=cg.group_id";
$joincat_cond  = "   WHERE cg.group_status='1' AND cat.pid=0 AND cat.status='Y' ORDER BY cg.group_id ASC";
$category_list = $this->Site_model->getcountRecods($joincat_slct.$joincat_from.$joincat_cond);

if($category_list){
    foreach ($category_list as &$val) {
        $zcid = $val['id'];
        $zsubcat_list = $this->Site_model->getcountRecods("SELECT id,cat_name FROM bt_categories WHERE pid='$zcid' AND status='Y' ORDER BY cat_name ASC");
        $val['subcat_list'] = $zsubcat_list;
    }
}

$busidata_aiz['business_group'] = $groupdata;         // Category Group Data
$busidata_aiz['categorylist']   = $category_list;     // Category List
//p($busidata_aiz['categorylist']);

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
<div class="containerr">
<div class="col-md-12">

<div class="featuredpro">
<?php /*?><h2><i aria-hidden="true" class="fa"> <img src="images/FEATURED-PRODUCTS_ICON.png"></i>
                      <a href="edit-companyprofile"> Edit Profile </a>
                  </h2><?php */?>
<h3 class="section-title">Edit Company Info</h3>

<?php
$othermarkets = "";
$productfocus = "";
$errcnt = 0;

$sql       = "Select * from " . $prev . "groups where memtype=" . $this->session->userdata['logged_in']["memtype"];
// $rs0_query = mysql_query($sql);
//   $rs0       = mysql_fetch_array($rs0_query);
$rs0 =$this->Site_model->getcountRecods($sql);
$rs0=$rs0[0];
$cats     = $rs0["profilecat_cnt"];
$allowed  = $rs0["profile"];
$posturl  = $rs0["posturl"];

/* if ($allowed!="yes")
{ */


$pofile_id = 0;
//echo "Select * from " . $prev. "business  where id =" . $_SESSION['user_id'];
//echo "Select * from " . $prev. "business  where id =" . $_SESSION['user_id'] ;die();
$sql ="Select * from bt_business  where user_id =" . $this->session->userdata['logged_in']['user_id'];
//echo "Select * from " . $prev. "business  where user_id =" . $_SESSION['user_id'];

$profile =$this->Site_model->getcountRecods($sql);

if (!empty($profile)) {
    $profile=$profile[0];
    $profile_id = $profile["id"];
    $companyname1 = $profile["company_name"];
    $cemail = $profile["email"];

    $logo1 = $profile["company_logo"];

    $logo = substr($logo1, 15);
    if (isset($profile["businesstype"])) {
        $businesstype = $profile["businesstype"];
    }
    $services = $profile["services"];
    $yearestablished = $profile["year_established"];


    $othermarkets = $profile["othermarkets"];
    $productfocus = $profile["productfocus"];
    $companyprofile = $profile["companyprofile"];
    $employees    = $profile["employees"];
    $ceo          = $profile["ceo"];
    $website      = $profile["website"];
    $about        = $profile["about"];
    $address1     = $profile["address1"];
    $phone        = $profile["phone"];
    $address2     = $profile["address2"];
    $address3     = $profile["address3"];
    $zip          = $profile["zip"];
    $mobile       = $profile["mobile"];
    $cat          = $profile['cat_id'];
    $mkk          = $profile['markets'];
    $company_logo = $profile['company_logo'];
    $mkts         = explode(",", $mkk);
    $businesstypes1 = $profile['businesstypes'];
    $businesstypes = explode(",", $businesstypes1);

    $fax2=""; $fax="";

    $fax2 = $profile["fax"];
}
?>

<div id="msgReplies" ></div>
<!--New Form-->
<form name="form123" id="edit_companyprofile_info" class="form-horizontal" method="post" action="" enctype="multipart/form-data" >



<div class="profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Company Name: <font color="#FF0000">*</font></label>

            <input  class='form-control' name="companyname" type="text" placeholder="Enter Company Name" value="<?php echo $companyname1; ?>" >



            <input  class='form-control' name="profile_id" type="hidden" id="profile_id" value="<?php echo $profile_id; ?>">

        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Company Email: <font color="#FF0000">*</font></label>

            <input  class='form-control' placeholder="Enter Company email" name="cemail" type="text" id="cemail"  value="<?php echo $cemail ?>"/>

        </div>

    </div>

</div>



<div class="profile_margin">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



        <div class="form-group">

            <label>Company Logo: <span>*</span></label>

            <div class="">
                <?php
                if(file_exists('assets/uploadedimages/'.$company_logo)){
                    $company_logo=base_url().'assets/uploadedimages/'.$company_logo;
                }else{
                    $company_logo=base_url() . 'assets/images/nopic.jpg';;
                }
                ?>
                <img src="<?php echo $company_logo; ?>"  style="width:200px;">

                <input type="hidden" value="<?php echo $company_logo ?>" name="change_image">

                <input type="file" class="choosefile " name='list1' >

            </div>



        </div>



    </div>

</div>



<!-- Business type Starts -->

<div class="profile_margin">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="form-group">

            <label>Business Type : <span>*</span></label>

            <div class="">



                <?php

                /*  OLD CODE WAS WORKING:: 2017-03-07

                $cnt = 1;

                $rs_query_t1 = mysql_query("select * from " . $prev . "businesstypes order by businesstype ");

                while ($rs_t1 = mysql_fetch_array($rs_query_t1)) {

                    ?>

                    <div class="col-lg-6 col-sm-6 col-12">

                        <label>

                            <?php if ($cnt % 2 == 1) { ?>





                            <?php } ?>

                            <span>

                                <input   type="checkbox" value="<?php echo $rs_t1["id"]; ?>" name="business_type[]"

                                <?php

                                if ($businesstypes != "") {



                                    if (in_array($rs_t1['id'], $businesstypes)) {

                                        echo " checked ";

                                    }

                                }

                                ?> >

                            </span>

                            <?php echo $rs_t1["businesstype"]; ?>

                            <?php if ($cnt % 1 == 0) { ?>



                            <?php } ?>

                        </label>

                    </div>

                    <?php

                    $cnt++;

                }

                */

                ?>



                <?php

                if($busidata_aiz['business_group']){

                    $cnt = 1;

                    foreach ($busidata_aiz['business_group'] as $val) { ?>



                        <div class="col-lg-6 col-sm-6 col-12" >

                            <div class="form-group">

                                <label>

                                    <?php if($cnt % 2==1){}?>

                                    <span>

                                                  <input type="checkbox" value="<?php echo $val["group_id"]; ?>" name="business_type[]"

                                                      <?php if ($businesstypes != "") {

                                                          if (in_array($val['group_id'], $businesstypes)){ echo " checked "; }

                                                      }?> >

                                                </span><?=$val["group_name"];?><?php if ($cnt % 1==0){}?></label>

                            </div>

                        </div>



                        <?php

                        $cnt++;

                    }

                }

                ?>

            </div>

        </div>

    </div>

</div>

<!-- Business Type Ends -->



<div class="profile_margin has-feedback">



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label for="sel1">Preferable Category:<font color="#FF0000">*</font></label>

            <select class="form-control" name="cid" id="cid" <?php if ($_SESSION['user_id']) { ?>onchange="callajax(this.value,<?= $_SESSION['user_id'] ?>);" <?php } else { ?>onchange="callajax(this.value);"<?php } ?> >

                <option value=''>Select Business Category</option>



                <?php

                foreach ($busidata_aiz['categorylist'] as $val) {

                    if($val['subcat_list']!=0){  ?>



                        <optgroup label="<?php echo strtoupper($val['cat_name']); ?>" >



                            <?php foreach ($val['subcat_list'] as $subval) { ?>



                                <option value="<?=$subval['id'];?>" <?php

                                if($profile['cat_id']==$subval['id']){echo ' selected';}?> ><?=utf8_encode($subval['cat_name']);?></option>



                            <?php } ?>



                        </optgroup>



                    <?php }

                } ?>

            </select>



        </div>

    </div>






    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Product/Services We Offer : <font color="#FF0000">*</font></label>

            <textarea  class='form-control' name='services' cols="60" rows="2" placeholder="Enter Product/services you offer" required=""><?= $services ?></textarea>

        </div>

    </div>

</div>





<div class="profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Year Established : <font color="#FF0000">*</font></label>

            <select name="yearestablished" class="form-control" required="">

                <option value="">Please select</option>

                <?php

                for ($i = date('Y'); $i >= 1900; $i--) {

                    ?>

                    <option  value="<?php echo $i; ?>" <?php if ($i == $yearestablished) { ?> selected="selected"<?php  } ?>><?php echo $i; ?></option>

                <?php

                }

                ?>

            </select>

        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Number of Employees: <font color="#FF0000">*</font></label>

            <select name='employees' class="form-control">

                <option value="">Please Select</option>

                <?php

                $qry ="Select * from  bt_employees where status = 'Y' order by id";

                $rs_query  = $this->Site_model->getcountRecods($qry);
                foreach($rs_query as $key=>$rs) { ?>



                    <option value="<?php echo $rs["id"]; ?>"

                        <?php

                        if($rs["id"] == $employees){

                            echo "  selected ";

                        }

                        ?> ><?php echo $rs["employees"]; ?></option>

                <?php

                }

                ?>

            </select>

        </div>

    </div>

</div>




<?php

$cnt = 1;

$qryrs_query_t = "select * from  bt_markets order by market";

$rs_query  = $this->Site_model->getcountRecods($qryrs_query_t);
foreach($rs_query as $key=>$rs_t) {

    if ($cnt % 2 == 1) {



    }


    if ($mkts != "") {

        if (in_array($rs_t['mid'], $mkts)) {

            echo " checked ";

        }

    }
    echo $rs_t["market"];

    if ($cnt % 1 == 0) {



    }
    $cnt++;
}


?>






<div class="profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Company Profile: <font color="#FF0000">*</font></label>

            <textarea class='form-control' name='companyprofile' cols="60" rows="2" placeholder="Enter company profile"><?= $companyprofile ?></textarea>

        </div>

    </div>

</div>



<div class="profile_margin">

    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>About Us: <font color="#FF0000">*</font></label>

            <textarea class='form-control' name="about" cols="60" rows="2" placeholder="Enter something about your company" id="editor_office2003"><?= $about ?></textarea>

        </div>

    </div>

</div>



<div class="form-group profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>CEO/Owner's Name: <font color="#FF0000">*</font></label>

            <input  class='form-control' name="ceo" type="text" placeholder="Enter CEO's name" value="<?php echo $ceo; ?>" >

        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Address1: <font color="#FF0000">*</font></label>

            <textarea class='form-control' name="address1" cols="60" rows="2" placeholder="Enter Address" id="address1"><?= $address1 ?></textarea>

        </div>

    </div>

</div>



<div class="profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Address2: </label>

            <textarea class='form-control' name="address2" cols="60" rows="2" id="address2" placeholder="Enter another address(optional)"><?= $address2 ?></textarea>

        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Address3: </label>

            <textarea class='form-control' name="address3" cols="60" rows="2" id="address3" placeholder="Enter another address(optional)"><?= $address3 ?></textarea>

        </div>

    </div>

</div>





<div class=" profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group">

            <label>Phone: </label>

            <input  class='form-control' name="phone" type="text"  id="phone" placeholder="Enter phone no"  value="<?php echo $profile['phone']; ?>" size="20" maxlength="20" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"pattern="[0-9]{10}">



        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group ">

            <label>Phone2 :</label>

            <input  class='form-control' name="phone2" type="text"  id="phone2" placeholder="Enter another phone no" value="<?php echo $profile['phone2']; ?>" size="20" maxlength="20" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"pattern="[0-9]{10}" >

        </div>

    </div>

</div>





<div class="profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group ">

            <label>Mobile: </label>

            <input  class='form-control' name="mobile" type="text" placeholder="Enter mobile no" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"pattern="[0-9]{10}" value="<?= $mobile ?>"/>

        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group ">

            <label>Zip: <font color="#FF0000">*</font></label>

            <input  class='form-control' name="zip" type="text" placeholder="Enter zipcode" id="zip" value="<?= $zip ?>"/>

        </div>

    </div>

</div>





<div class="profile_margin">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">



        <div class="form-group ">

            <label>Fax : </label>





            <input type="text" name="fax2" id="fax2" value="<?=$fax2;?>" size="20" maxlength="20" placeholder="Enter FAX" class='form-control' >





        </div>

    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <div class="form-group ">

            <label>Website URL : </label>



            <input  class='form-control' name="website" type="url" id="website" placeholder="Enter Website url" value="<?php

            if ($website == "") {

                // echo 'http://' . $website;

                echo $website;

            } else {

                echo $website;

            }

            ?>">



        </div>

    </div>

    <div class="clearfix"></div>

</div>



<div class="form-group profile_margin">



</div>



<div class="clearfix"></div>



<div class="form-group profile_margin">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <!-- <input class='btn btn-warning btn-big' type="submit" name="Submit2" value="Post / Edit Profile">  -->

        <input class='btn btn-warning btn-big' type="button" name="Submit2"  onclick="update_company_details();" value="Update Info" >

    </div>

</div>





</form>


<!--New Form End-->











</div>
</div>

</div>
</div>

</form>

</div>
</div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>
<script>
    function update_company_details (){
        var formData = new FormData($('#edit_companyprofile_info')[0]);
        var base_url='<?php echo base_url();?>';
        $.ajax({
            url: base_url+"edit_company_Info",
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
<script language="JavaScript">

    function attachment(box)
    {
        str = "fileupload.php?box=" + box;
//alert(str);
        window.open(str, "Attachment", "top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=350,height=450,location=no,directories=no,scrollbars=yes");
    }

    function category(box)
    {
        str = "choosecategory.php?box=" + box;

        window.open(str, "Category", "top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=550,height=450,location=no,directories=no,scrollbars=yes");
    }



    function removeattachment(box)
    {
        window.document.form123.list1.value = ""
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function validate(form)
    {

        var mob = document.form123.mobile.value;
        var ph1 = document.form123.phone.value + document.form123.phone1.value + document.form123.phone2.value;
        var ph2 = document.form123.phonee.value + document.form123.phonee1.value + document.form123.phonee2.value;
        /*var capt=document.getElementById('captcha').value;
         var capt_text=document.getElementById('contact_security').value;
         alert(capt);
         //updateRTEs();
         if(capt!=capt_text)
         {
         alert('Security code is error.');
         return false;
         }*/

        if (form.companyname.value == "") {
            alert('Please Specify Companyname!');
            form.companyname.focus();
            return false;
        }
        if (form.companyname.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from Companyname (e.g. &  < >)");
            form.companyname.focus();
            return(false);
        }
        //if ( form.businesstype.value == "" ) {
        //  alert('Please Choose a Business Type!');
        //   form.businesstype.focus();
        //   return false;
        //  }
        if (!/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(document.form123.cemail.value)) {
            alert("Please enter a valid Email Id.");
            document.form123.cemail.focus();
            return false;
        }
        if (form.cid.value == "")
        {
            alert('Please Choose atleast a Category!');
            form.cats.focus();
            return false;
        }

        if (form.services.value == "") {
            alert('Please Specify Products/Services!');
            return false;
        }
        var checked = 'no';
        var count = form.cnt.value;
        var i = 1;

        for (i = 1; i < form.elements.length; i++)
        {
            if (form.elements[i].checked == true)
            {
                checked = 'yes';
            }
        }

        if ((checked == 'no') && (form.othermarkets.value == ""))
        {
            alert(' Please choose atleast one market.')
            form.othermarkets.focus();
            return false;
        }
        /*
         if (form.productfocus.value == "") {
         alert('Please Choose Main Product Focus!');
         form.productfocus.focus();
         return false;
         }
         */
        if (form.employees.value == "") {
            alert('Please Choose Number of Employees!');
            form.employees.focus();
            return false;
        }
        if (form.companyprofile.value == "") {
            alert('Please Specify Company Profile!');
            return false;
        }
        if (form.ceo.value == "") {
            alert("Please Specify CEO/Owner's Name!");
            form.ceo.focus();
            return false;
        }
        if (form.ceo.value.match(/[&<>]+/))
        {
            alert("Please remove Invalid characters from CEO/Owner's Name (e.g. &  < >)");
            form.ceo.focus();
            return(false);
        }

        if (isNaN(mob) || mob.length < 10 || mob.length > 11)
        {
            alert("Please enter a valid mobile number.");
            document.form123.mobile.focus();
            return false;
        }
        if (mob == "") {
            alert("Please enter mobile number.");
            document.form123.mobile.focus();
            return false;
        }
        if (ph1 == "") {
            alert("Please enter Phone number.");
            document.form123.phonee.focus();
            return false;
        }
        if (ph2 == "") {
            alert("Please enter 2nd Phone number.");
            document.form123.phone.focus();
            return false;
        }
        if (isNaN(ph1))
        {
            alert("Please enter a valid phone number.");
            document.form123.phone.focus();
            document.form123.phone1.focus();
            document.form123.phone2.focus();
            return false;
        }
        if (isNaN(ph2))
        {
            alert("Please enter a valid phone number.");
            document.form123.phonee.focus();
            document.form123.phonee1.focus();
            document.form123.phonee2.focus();
            return false;
        }

        if (form.website.value != ""){
            var txt = form.website.value;
            // var re = /(http:\\)?(www\.)?[A-Za-z0-9]+(\.[a-z]{2,3})/
            var re= /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
            //var re = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/
            if (!re.test(txt))
                alert('Enter Valid URL');
            return false;
        }



        return true;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //-->
</script>
<script type="text/javascript" >
    var select_count = 0, select_type = 0, buy_chk = 0, sell_chk = 0;


    function counttype(element)
    {

        ++select_type;
    }
    function countchk(element)
    {
        ++select_count;
    }
    function textCounter(field)
    {
        document.getElementById('remLen1').value = 250 - document.getElementById('short_description').value.length;
        if (document.getElementById('short_description').value.length >= 250)
            return false;
    }

    function callajax(control, uid)
    {
        var ajaxPOST;  // The variable that makes Ajax possible!

        try {
            // Opera 8.0+, Firefox, Safari
            ajaxPOST = new XMLHttpPOST();
        } catch (e) {
            // Internet Explorer Browsers
            try {
                ajaxPOST = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    ajaxPOST = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    // Something went wrong
                    //alert("Your browser broke!");
                    return false;
                }
            }
        }
        // Create a function that will receive data sent from the server
        ajaxPOST.onreadystatechange = function () {
            if (ajaxPOST.readyState == 4) {
                document.getElementById('subscription-categories').innerHTML = ajaxPOST.responseText;
            }
        }
        var id = control;
        var user_id = uid;
        var queryString = "?id=" + id + "&user_id=" + user_id;
        ajaxPOST.open("GET", "resp1.php" + queryString, true);
        ajaxPOST.send(null);

    }
</script>
<script>
    $(function () {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    //if( log ) alert(log);
                }

            });
        });

    });
</script>


<script type="text/javascript">
    CKEDITOR.replace('editor_office2003',
        {
            height: '300px',
            enterMode: CKEDITOR.ENTER_BR,
            toolbar:
                [
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo'],
                        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                    }, '/',
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink', 'Anchor']
                    },
                ]
        });
</script>

<script type="text/javascript">

$(document).ready(function () {
    $("#group_name_id").change(function () {
        var groupid = $('#group_name_id').val();
        //alert(groupid);

        /*
         $.ajax({
         url: "<?=base_url();?>ajax_fetch_optcats.php,
         type: "POST",
         data: groupid,
         success: function (data) {
         var result = $.trim(data);
         //alert(result);
         console.log(data);
         //$('#subcatdiv').html(data);
         if (result == '<option value="">Choose a category</option>') {
         //$('#subcatdiv').css('display','none');
         //$('#subcatdiv').removeAttr('required');
         $("#subcatdiv").empty();
         } else {
         $("#subcatdiv").empty();
         $('#subcatdiv').css('display', 'block');
         //$('#subcatdiv').attr('required','required');
         $('#subcatdiv').html(data);
         }

         }
         });
         */
    });
});






$(document).ready(function () {
    $("#frmUser").formValidation({/*
     addOns: {
     reCaptcha2: {
     element: 'captchaContainercompany',
     theme: 'light',
     siteKey: '6Lf-KCUTAAAAAEulFYVyd7afrlFOS3HGq4wBnuY-',
     language: 'en',
     message: 'The captcha is not valid'
     }
     }
     ,
     */
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        }
        ,
        fields: {
            companyname: {
                validators: {
                    notEmpty: {
                        message: 'Company name field is required'
                    },

                }
            }
            ,

            cid: {
                validators: {
                    notEmpty: {
                        message: 'Category field is required'
                    },

                }
            }
            ,

            cemail: {
                validators: {
                    notEmpty: {
                        message: 'Company email field is required'
                    },

                }
            }
            ,

            yearestablished: {
                validators: {
                    notEmpty: {
                        message: 'Year of establishment is required'
                    },

                }
            }
            ,
            productfocus: {
                validators: {
                    notEmpty: {
                        message: 'Please select main product'
                    },

                }
            }
            ,

            employees: {
                validators: {
                    notEmpty: {
                        message: 'Please select no of employees'
                    },

                }
            }
            ,
            services: {
                validators: {
                    notEmpty: {
                        message: 'Please provide a service'
                    },

                }
            }
            ,
            companyprofile: {
                validators: {
                    notEmpty: {
                        message: 'Please provide a service'
                    },

                }
            }
            ,
            editor_office2003: {
                validators: {
                    notEmpty: {
                        message: 'Provide some information about your company'
                    },

                }
            }
            ,
            ceo: {
                validators: {
                    notEmpty: {
                        message: 'Please fill this field'
                    },

                }
            }
            ,
            address1: {
                validators: {
                    notEmpty: {
                        message: 'Please fill the address field'
                    },

                }
            }
            ,
            // mobile: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Please fill the mobile field'
            //         },

            //     }
            // }
            // ,
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Please provide zipcode'
                    },

                }
            }
            ,

            // website: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Please provide Web url'
            //         },

            //     }
            // }
            //,

            message: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'The message field is required'
                    }
                    ,
                }
            }
            ,
        }
    });
});
</script>


</body>
</html>
		