<?php
$pagename = "showmessage";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
$prev="bt_";
//$flashmsg = new \Plasticbrain\FlashMessages\FlashMessages();


$logged_userid = $this->session->userdata['logged_in']['user_id'];
//echo $logged_userid;


// ----TO DELETE MESSAGE::----
$msg1="";
$to_delete="";
$items_removed=0;
if ( count($_POST)<>0 )
{

    if(isset($_REQUEST["cnt"])){ $cnt = $_REQUEST["cnt"]; }
    if(isset($_REQUEST["cnt2"])){ $cnt = $_REQUEST["cnt2"]; }

    for($i=1;$i<=$cnt;$i++){

        //Is the checkbox ticked
        if ( isset($_REQUEST["checkbox" . $i]) )
        {
            if ($to_delete!="") { $to_delete.="," ; }   //To insert comma??
            $to_delete.= $_REQUEST["checkbox" . $i];    //Add another item to delete
            $items_removed++;
        }
    } //End For
    if ($to_delete=="")
    {
        $msg1=" Unable to remove Enquiries. ";
    }
    else
    {

        $sql0=mysql_query("select * from " . $prev. "messages where id IN (" . $to_delete .")");

        while($rs_t0=mysql_fetch_array($sql0))
        {
            if($rs_t0["fid"]==$_SESSION['user_id']) {
                $del_str=" update " . $prev. "messages set f_del='yes' where id=".$rs_t0["id"];
            }

            if($rs_t0["tid"]==$_SESSION['user_id']) {
                $del_str=" update " . $prev. "messages set t_del='yes' where id=".$rs_t0["id"];
            }

            if($rs_t0["tid"]==$rs_t0["fid"]) {
                $del_str=" update " . $prev. "messages set t_del='yes', f_del='yes' where id=".$rs_t0["id"];
            }
            mysql_query($del_str);
        }
        $del_str = "Delete from " . $prev. "messages where f_del='yes' && t_del='yes'";
        mysql_query($del_str);

        $msg1= ($items_removed > 1)?$items_removed . " Enquiries have been Removed":$items_removed . " Enquiry has been removed";
    }
}


// GET INCOMING MESSAGE::
$incoming_slct = " SELECT m.user_id,m.firstname,m.lastname,m.username,mg.*   FROM ";
$incoming_from = $prev."messages as mg JOIN ".$prev."members as m ON m.user_id = mg.fid WHERE ";
$incoming_cond = "mg.tid = '$logged_userid' AND mg.t_del ='No' AND mg.to_msg_read !='Yes' ORDER BY mg.id DESC";

$incoming_msglist= $this->Site_model->getcountRecods($incoming_slct.$incoming_from.$incoming_cond);
$incoming_msglist_count = 0;
if(!empty($incoming_msglist)){
    $incoming_msglist_count = count($incoming_msglist);
}


if($incoming_msglist){
    foreach ($incoming_msglist as &$val) {

        // business details:
        $busi_uid = $val['user_id'];
        $busidata = getRowData($prev.'business',"*","user_id = '$busi_uid'");
        if($busidata){
            $val['show_nameas'] = ucwords($busidata['company_name']);
            $val['busi_company']= $busidata['company_name'];
            $val['busi_mobile'] = $busidata['mobile'];
            $val['busi_fax']    = $busidata['fax'];
        }else{
            $val['show_nameas'] = ucwords($val['firstname']." ".$val['lastname']);
            $val['busi_company']= "";
            $val['busi_mobile'] = "";
            $val['busi_fax']    = "";
        }
    }
}

// GET OUTGOING MESSAGE::
$outgoing_slct  = "SELECT m.user_id,m.firstname,m.lastname,m.username,mg.*   FROM ";
$outgoing_from  = $prev."messages as mg JOIN ".$prev."members as m ON m.user_id = mg.tid  WHERE ";
$outgoing_cond  = "mg.fid='$logged_userid' AND mg.t_del='No' ORDER BY mg.id DESC";
//$outgoing_msglist = getTableData($outgoing_from, $outgoing_slct, $outgoing_cond, $assoc = TRUE);

$outgoing_msglist= $this->Site_model->getcountRecods($outgoing_slct.$outgoing_from.$outgoing_cond);

$incoming_msglist_count = 0;
if(!empty($incoming_msglist)){
    $incoming_msglist_count = count($incoming_msglist);
}
if($outgoing_msglist){
    foreach ($outgoing_msglist as &$val) {

        // business details:
        $busi_uid = $val['user_id'];
        $where ="user_id = '$busi_uid'";

        $busidata= $this->Site_model->getDataById($prev.'business',$where);
        if($busidata){
            $busidata=$busidata[0];
            $val['show_nameas'] = ucwords($busidata['company_name']);
            $val['busi_company']= $busidata['company_name'];
            $val['busi_mobile'] = $busidata['mobile'];
            $val['busi_fax']    = $busidata['fax'];
        }else{
            $val['show_nameas'] = ucwords($val['firstname']." ".$val['lastname']);
            $val['busi_company']= "";
            $val['busi_mobile'] = "";
            $val['busi_fax']    = "";
        }
    }
}

//echo "<pre>";
//var_dump($incoming_msglist);
//print_r($outgoing_msglist);
//echo "</pre>";
//echo $incoming_msglist_count;

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
                <div class="container">
                    <div class="col-md-10">

                        <div class="featuredpro">
                            <h3 class="section-title"> <a href="JavaScript:void(0);" >Check Inquiries</a></h3>

                            <!--Container Section1 -->

                            <div class="container-fluid ">

                                <div id="amazingcarousel-container-1" >
                                    <div class="newmsglist-area ">
                                        <h5 class="" style="padding-left:10px; ">Incoming Messages:</h5>
                                        <?php
                                        //if ($incoming_msglist_count ) {
                                        if ($incoming_msglist ) { ?>

                                            <form name="form2" id="form2" method="post" action="show_messages.php">
                                                <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">
                                                    <tr class="subtitle">
                                                        <td width="10" style="padding-left:10px;">
                                                            <input type="checkbox" name="check_all" value="yes" onClick="select_all();">
                                                        </td>
                                                        <td height="25"><b>Subject</b></td>
                                                        <td><b>From User</b></td>
                                                        <td><b>Date Received</b></td>
                                                        <td><b>Status</b></td>
                                                    </tr>

                                                    <?php
                                                    $count=0;
                                                    foreach ($incoming_msglist as $coming) {

                                                        $count++;
                                                        if($coming['to_msg_read']=='No'){
                                                            $msg_status = "<span class='new-msg'>New</span>";
                                                        }else{
                                                            $msg_status = "<span class='read-msg'>Read</span>";
                                                        }
                                                        ?>

                                                        <tr class='mtr'>
                                                            <td width="10" style="padding-left:10px;" >
                                                                <div align="right">
                                                                    <input name="checkbox<?php echo $count;?>" id="checkbox<?php echo $count;?>" type="checkbox" id="checkbox<?php echo $count;?>" value="<?php echo $rs0["id"];?>" >
                                                                    <input type="hidden" name="spam1" id="spam1"/>
                                                                </div>
                                                            </td>

                                                            <td valign="top" >

                                                                <a href="<?=base_url();?>read-message/<?=$coming["fid"];?>/<?=$coming["id"];?>" target="_self" >
                                                                    <?php
                                                                    if(strlen($coming["subject"])>50) {
                                                                        echo substr($coming["subject"], 0,  strrpos( substr($coming["subject"], 0, 50),' ' )) . "..";
                                                                    }else{
                                                                        echo $coming["subject"];
                                                                    }
                                                                    ?>
                                                                </a>
                                                            </td>

                                                            <td valign="top" >   <?php echo $coming["show_nameas"]; ?> </td>

                                                            <td valign="top" ><?php echo date('d M Y h.i.s A', strtotime($coming["tempdate"]));?></td>
                                                            <td valign="top" ><?php echo $msg_status;?></td>
                                                        </tr>

                                                    <?php } ?>
                                                    <!--
        <tr>
          <td colspan="5" style="padding-top:20px;text-align:center"> <input type="hidden" name="cnt" value="<?php echo $count; ?>">
            <input type="submit" name="Submit" value="Remove" class="btn btn-warning btn-big">
          </td>

        </tr>
        -->
                                                </table>
                                                <p class="text-center">
                                                    <input type="hidden" name="cnt" value="<?php echo $count; ?>">
                                                    <input type="submit" name="Submit" value="Remove" class="btn btn-warning btn-big">
                                                </p>
                                            </form>

                                        <?php }else{ ?>
                                            <p class="text-center"> No Message Found</p>
                                        <?php } ?>
                                    </div>


                                    <div class="outmsglist-area">
                                        <h5 class="" style="padding-left:10px; ">Outgoing Messages:</h5>
                                        <?php
                                        if ($outgoing_msglist) { ?>

                                            <form action="show_messages.php" method="post" name="form3" id="form3">
                                                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                                                    <tr class="subtitle">
                                                        <td width="10" style="padding-left:10px;">
                                                            <input name="check_all" type="checkbox" id="check_all" onClick="select_all2();" value="yes">
                                                        </td>
                                                        <td height="25"><b>Subject</b></td>
                                                        <td><b>To User</b></td>
                                                        <td><b>Date Sent</b></td>
                                                        <td><b>Status</b></td>
                                                    </tr>


                                                    <?php
                                                    $count2=0;
                                                    foreach ($outgoing_msglist as $going) {

                                                        $count2++;
                                                        if($going['to_msg_read']=='No'){
                                                            $outmsg_status = "<span class='new-msg'>Not Read</span>";
                                                        }else{
                                                            $outmsg_status = "<span class='read-msg'>Read</span>";
                                                        }
                                                        ?>


                                                        <tr class=mtr>
                                                            <td width="10" style="padding-left:10px;" >
                                                                <div align="right">
                                                                    <input name="checkbox<?php echo $count2;?>" id="checkbox<?=$count2;?>" type="checkbox" id="checkbox<?=$count2;?>" value="<?php echo $going["id"];?>" >

                                                                    <input type="hidden" name="spam" id="spam" />
                                                                </div>
                                                            </td>

                                                            <td valign="top" >
                                                                <a href="<?=base_url();?>read-msg-out/<?=$going["tid"];?>/<?=$going["id"];?>" target="_self">
                                                                    <?php
                                                                    if (strlen ($going["subject"])>50){
                                                                        echo substr($going["subject"], 0,  strrpos( substr($going["subject"], 0, 50),' ' )) . "..";

                                                                    } else{ echo $going["subject"]; }
                                                                    ?> </a>
                                                            </td>

                                                            <td valign="top" ><?php  echo $going["show_nameas"]; ?> </td>

                                                            <td valign="top" ><?php echo date('d M Y h.i.s A', strtotime($going["tempdate"]));?></td>
                                                            <td valign="top" ><?php echo $outmsg_status;?></td>
                                                        </tr>

                                                        <!-- <tr>
          <td colspan="5" style="padding-top:30px;padding-bottom:10px;text-align:center">
            <input type="hidden" name="cnt2" value="<?php echo $cnt; ?>">
            <input type="submit" name="Submit2" value="Remove" class="btn btn-warning btn-big">
          </td>
        </tr> -->

                                                    <?php } ?>

                                                </table>
                                                <p class="text-center">
                                                    <input type="hidden" name="cnt2" value="<?php echo $count2; ?>">
                                                    <input type="submit" name="Submit2" value="Remove" class="btn btn-warning btn-big">
                                                </p>

                                            </form>

                                        <?php } else { ?>

                                            <div class="alert alert-danger alert-dismissable" style="text-align:center;" > No Outgoing Message. </div>

                                        <?php } ?>
                                    </div>




                                </div>

                            </div>
                        </div>

                    </div></div>

            </div>
            </div>

            </form>

        </div>
    </div>
</div>


</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php include APPPATH.'views/dashboard/footer.php'; ?>
<script language="JavaScript">


    //<!--
    function select_all()
    {
        for (var i=0;i<document.form2.elements.length;i++)
        {
            var e =document. form2.elements[i];
            if ((e.name != 'check_all') && (e.type=='checkbox'))
            {
                e.checked = document.form2.check_all.checked;
            }
        }

    }

    function select_all2()
    {
        for (var i=0;i<document.form3.elements.length;i++)
        {
            var e =document. form3.elements[i];
            if ((e.name != 'check_all') && (e.type=='checkbox'))
            {
                e.checked = document.form3.check_all.checked;
            }
        }

    }

    //-->
</script>
<script language="javascript">
    //<!--
    function formValidate(form) {
        if(form.add_desc.value == "") {
            alert('Please enter description.');
            return false;
        }
        return true;
    }
    //-->

</script>


</body>
</html>
