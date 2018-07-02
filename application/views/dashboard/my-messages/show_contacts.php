<?php
$pagename = "mycontacts";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}

?>

<?php
$msg1="";

//--- TO DELETE CONTACT ------
$to_delete="";
$items_removed=0;
if(isset($_POST["Submit"]))
{
    if ( count($_POST)<>0 ){

        for($i=1;$i<=$_REQUEST["cnt"];$i++) {

            //Is the checkbox ticked
            if ( isset($_REQUEST["checkbox" . $i]) ) {

                if ($to_delete!="") { $to_delete.="," ; }  	//To insert comma??
                $to_delete.= $_REQUEST["checkbox" . $i];  	//Add another item to delete
                $items_removed++;
            }
        } //End For

        if ($to_delete==""){
            $_SESSION['err_msg'] = " Unable to remove any user from the Contact List ";
        }else{
            $del_str ="Delete from ".$prev."contacts where id IN (" . $to_delete .")";
            $deldone = mysql_query($del_str);

            if($deldone){  	$_SESSION['after_post_msg'] = "User have been removed from your Contact List";}
            else{ $_SESSION['after_post_msg'] = "Failed To Remove Contact"; }
        }
    }
}

if(isset($_POST['submit2'])){

    $contact_id = $_POST['username'];
    $check_id ="select * from " . $prev. "contacts where uid='".$_SESSION["user_id"]."' and ( contact_id = '".$contact_id."' or uid = '".$contact_id."') ";

    //print_r($check_id);exit;

    $check_gro=mysql_fetch_array(mysql_query($check_id));
    if($check_gro) {
        if($check_gro['block'] == 'Y'){
            $msg = 'This user already blocked in my contacts please try another one';
        } else {
            $msg = 'This user already showing in my contacts please try another one';
        }
    } else {
        $check_id  ="select * from " . $prev. "members where user_id ='".$contact_id."' ";
        $check_gro =mysql_fetch_array(mysql_query($check_id));
        if($check_gro) {
            //$contactid = getSingleRow('members',array('username'=>$_POST[username]),'user_id','');
            $query = db_insert('contacts',array('uid'=>$this->session->userdata['logged_in']['user_id'],'contact_id'=>$_POST[username]));
        } else {
            $msg = 'Please use correct member id';
        }
    }

    $to = getSingleRow('members',array('user_id'=>$_POST[username]),'email,firstname','');
    $from = getSingleRow('members',array('user_id'=>$this->session->userdata['logged_in']['user_id']),'email,firstname','');

    $to = $to['email'];
    $subject = "Contact invitation information";
    $txt = $from['firstname'].' '.'send you a contact information';
    $headers = "From:".$from['email'] . "\r\n" ;

    mail($to,$subject,$txt,$headers);

}




// REQUESTED MEMEBERS::
$condz23 = "uid = '".$this->session->userdata['logged_in']['user_id']."' and status = 'N' AND block != 'Y' ORDER BY id DESC";
//$request_sentlist = getTableData($prev.'contacts',"*",$condz23, $assoc = TRUE);
$request_sentlist= $this->Site_model->getDataById("bt_contacts",$condz23);
$requested_memlist = array();
if($request_sentlist){
    $req_i =0;
    foreach ($request_sentlist as $v) {
        $where ="user_id = '".$v['contact_id']."'";

        $memdata= $this->Site_model->getDataById("bt_members",$where);
        $memdata=$memdata[0];
        if($memdata){
            array_push($requested_memlist,$memdata);
            $requested_memlist[$req_i]['contact_status'] = $v['status'];

            // business details:
            $busi_uid = $memdata['user_id'];
            $where ="user_id = '$busi_uid'";

            $busidata= $this->Site_model->getDataById("bt_business",$where);
            if($busidata){
                $busidata=$busidata[0];
                $requested_memlist[$req_i]['show_nameas'] = $busidata['company_name'];
            }else{
                $requested_memlist[$req_i]['show_nameas'] = ucfirst($memdata['firstname'])." ".ucfirst($memdata['lastname']);
            }

            $req_i++;
        }
    }
}

// RECEIVED REQUEST FROM MEMEBERS::
$recv_cond = "contact_id = '".$this->session->userdata['logged_in']['user_id']."' AND status = 'N' AND block != 'Y' ORDER BY id DESC";
//$received_requestlist = getTableData($prev.'contacts',"*",$recv_cond, $assoc = TRUE);

$received_requestlist= $this->Site_model->getDataById("bt_contacts",$recv_cond);

$received_memlist = array();
if($received_requestlist){
    $recv_i=0;
    foreach ($received_requestlist as $v) {

        $cond = "user_id = '".$v['uid']."'";
        $received_requestlist= $this->Site_model->getDataById("bt_members",$cond);
        if($mdata){
            array_push($received_memlist,$mdata);
            $received_memlist[$recv_i]['contact_status'] = $v['status'];

            // business details:
            $busi_uid = $mdata['user_id'];
            $busidata = getRowData($prev.'business',"*","user_id = '$busi_uid'");
            if($busidata){
                $received_memlist[$recv_i]['show_nameas'] = $busidata['company_name'];
            }else{
                $received_memlist[$recv_i]['show_nameas'] = ucfirst($mdata['firstname'])." ".ucfirst($mdata['lastname']);
            }

            $recv_i++;
        }
    }
}

// GET ALL CONTACT LIST::
$allcontact_cond = "(uid = '".$this->session->userdata['logged_in']['user_id']."' OR contact_id = '".$this->session->userdata['logged_in']['user_id']."') AND block != 'Y'";
//$allcontact_list = getTableData( $prev.'contacts', "*" , $allcontact_cond , $assoc = TRUE);
$allcontact_list= $this->Site_model->getDataById("bt_contacts",$allcontact_cond);
$mycontact_total = 0;
$mycontact_list = array();
if($allcontact_list){

    $usr_i = 0;
    foreach($allcontact_list as $con){

        if($con['contact_id'] == $this->session->userdata['logged_in']['user_id']){
            $usrdata_cond = "user_id = '".$con['uid']."'";
        }
        else if($con['uid'] == $this->session->userdata['logged_in']['user_id']){
            $usrdata_cond = "user_id = '".$con['contact_id']."'";
        }
        //$usrdata = getRowData($prev.'members',"*",$usrdata_cond);
        $usrdata= $this->Site_model->getDataById("bt_members",$usrdata_cond);
        $usrdata=$usrdata[0];
        if($usrdata){
            array_push($mycontact_list , $usrdata);

            // contact table data adding:
            $mycontact_list[$usr_i]['con_id'] 		  = $con['id'];
            $mycontact_list[$usr_i]['con_uid'] 		  = $con['uid'];
            $mycontact_list[$usr_i]['con_contact_id'] = $con['contact_id'];
            $mycontact_list[$usr_i]['con_status'] 	  = $con['status'];
            $mycontact_list[$usr_i]['con_block'] 	  = $con['block'];

            // business details:
            $busi_uid = $usrdata['user_id'];
            $where ="user_id = '$busi_uid'";
            $busidata= $this->Site_model->getDataById("bt_business",$where);
            if($busidata){
                $busidata=$busidata[0];
                $mycontact_list[$usr_i]['show_nameas']  = ucwords($busidata['company_name']);
                $mycontact_list[$usr_i]['busi_company'] = $busidata['company_name'];
                $mycontact_list[$usr_i]['busi_mobile'] 	= $busidata['mobile'];
                $mycontact_list[$usr_i]['busi_fax'] 	= $busidata['fax'];
            }else{
                $mycontact_list[$usr_i]['show_nameas']  = ucwords($usrdata['firstname']." ".$usrdata['lastname']);
                $mycontact_list[$usr_i]['busi_company'] = "";
                $mycontact_list[$usr_i]['busi_mobile'] 	= "";
                $mycontact_list[$usr_i]['busi_fax'] 	= "";
            }

            $mycontact_total++;
            $usr_i++;
        }
    }
}

//print_r($mycontact_list);

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
        <?php //$flashmsg->display();?>
        <div class="featuredpro">
        <h3 class="section-title"> <a href="javascript:void(0);"> My Contacts   </a></h3>

        <?php

        $prev="bt_";
        $config= $this->Site_model->getTabledata("bt_config");
        //$config=mysql_fetch_array(mysql_query("select * from " . $prev. "config"));

        //echo $ff =  "Select count(*) from " . $prev. "contacts  where  uid =" .$this->session->userdata['logged_in']['user_id']. "and block != 'Y'";
        $rs0_query="Select count(*) from " . $prev. "members," . $prev. "contacts  where " . $prev. "contacts.contact_id=" . $prev. "members.user_id and (uid =" .$this->session->userdata['logged_in']['user_id']." or contact_id = " .$this->session->userdata['logged_in']['user_id'].") and " . $prev. "contacts.block != 'Y'";

        $rs0= $this->Site_model->getcountRecods($rs0_query);
        //$rs0=mysql_fetch_array($rs0_query);
        $contact_count=$rs0;

        $rs0_query="Select * from " . $prev. "members," . $prev. "contacts  where
         " . $prev. "contacts.block != 'Y' LIMIT 10" ;
        $rrs0_query= $this->Site_model->getcountRecods($rs0_query);

        //$sbq_gro="select * from " . $prev. "privilage where privilage_id='".$_SESSION["memtype"]."'";
        //$sbrow_gro = mysql_fetch_array(mysql_query($sbq_gro));

        $vidQ="select count(*) from ".$prev."contacts where uid=".$this->session->userdata['logged_in']['user_id'];

        $vid= $this->Site_model->getcountRecods($vidQ);
        $sbvid_count=$vid[0]['count(*)'];

        ?>

        <?php
        if(isset($_SESSION['after_post_msg']) && $_SESSION['after_post_msg']!=''){ ?>
            <div class="alert alert-success">
                <i class="fa fa-check"></i><?php echo $_SESSION['after_post_msg'];?>
            </div>
            <?php unset($_SESSION['after_post_msg']);} ?>

        <!-- <strong>Add to Contact List</strong> -->
        <span>[Note]: Select a Buyer or Supplier profile and send request to add him/her to your contact list.</span>
        <!-- <div style="height:15px;"></div> -->

        <span style='font-size:15px;color:red'><?php if(isset($msg)){ echo $msg ; }?></span>


        <div></div>
        <!-- My Requested Contacts Starts-->
        <div class="">
            <?php if(!empty($requested_memlist)){ ?>
                <h5>Sent Request:: </h5>
                <?php
                foreach ($requested_memlist as $memdata) { ?>
                    <p>
                        <!--
						<span style='font-weight:bold;margin-left:5px'><?php  echo "Your contact send to ";?></span>
						-->
						<span style='color:red;width:100px;font-size:15px'><i class="fa fa-user" aria-hidden="true"></i>
                            <?php echo $memdata['show_nameas'];?>
						</span>
                        <span class="pull-right">Pending</span>
                    </p>
                <?php	}
            } ?>
        </div>
        <!-- My Requested Contacts Ends-->

        <!-- Received Requested Contacts Starts-->
        <div class="">
            <?php if(!empty($received_memlist)){ ?>
                <h5>Recieved Request::</h5>
                <?php foreach ($received_memlist as $md) { ?>
                    <p>
					<span style='color:red;width:100px;font-size:15px'><i class="fa fa-user" aria-hidden="true"></i>
                        <?php echo $md['show_nameas'];?></span>
					<span style='font-weight:bold;margin-left:5px'>
					<?php //echo "has send you a contact invitation Please approved";?>
				   </span>

				   	<span class="pull-right">
				   	<?php if($md["contact_status"]=='N') {?>
                        <font color="red">
                            <a href="approved_file.php?uid=<?=$this->session->userdata['logged_in']['user_id'];?>&contact_id=<?=$md['user_id'];?>" ><b>Approve</b></a>
                        </font>
                    <?php } else {?>
                        <font color="green" ><b >Approved</b></font>
                    <?php } ?>
				   </span>
                    </p>
                <?php	}
            }
            ?>
        </div>
        <!-- Received RequestedContacts Ends-->
        <div style="margin-top:2px;"></div>

        <!--
			<div>
				<h5>My Contacts:::</h5>
				<p>To Remove a User from your contacts list just click the check box and click the remove button below. </p>

				<?php
        /*
        if($mycontact_total){ ?>
        <form name="form2" method="post" action="">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >
            <tr class="subtitle">
                  <td align="center" width="27" style="padding-left:10px;">
                      <input  name="check_all" type="checkbox" id="check_all" onClick="select_all();" value="yes">
                  </td>
                  <td height="25" style="padding-left:10px;"> Name2</td>
                <td> Company Name </td>
                <td> Phone </td>
                <td> Fax </td>
                <td> Status </td>
            </tr>

            <?php
            $count = 0;
            foreach($mycontact_list as $udat){
                $count++;
                $user_fullname = ucwords($udat['firstname'].' '.$udat['lastname']);
                if($udat['con_status'] == 'N') {
                    $phone = '*****';
                    $fax   = '*****';
                } else {
                    $phone = $udat["busi_mobile"];
                    $fax   = $udat["busi_fax"];
                }
            ?>

            <tr>
                <td align="center" width="27" style="padding-left:10px;" >
                    <input type="checkbox" class="check_class"  name="checkbox<?php echo $count;?>" value="<?php
                    echo $udat['con_id'];?>">
                </td>
                  <td height="25" style="padding-left:10px;">
                      <a href="send_new_message.php?type=contact&tid=<?php echo $udat['user_id'];?>" ><?=$user_fullname;?></a>
                  </td>
                <td><?=$udat['busi_company'];?></td>
                <td><?=$phone;?></td>
                <td><?=$fax;?></td>
                <td>
                    <?php if($udat["con_status"]=='N') {?>
                        <font color="red"><b>Pending</b></font>
                    <?php } else {?>
                        <font color="green"><b>Approved</b></font>
                    <?php } ?> |

                    <?php if($udat["con_contact_id"] == $this->session->userdata['logged_in']['user_id']) { ?>
                    <a  href="blockuser.php?type=block&contact_id=<?php echo $this->session->userdata['logged_in']['user_id'];?>&uid=<?php echo $udat["con_uid"] ;?>"><font color="#652d90"><b>Block</b></font></a>
                    <?php } else { ?>
                    <a  href="blockuser.php?type=block&contact_id=<?php echo $udat['con_uid'];?>&uid=<?php echo $this->session->userdata['logged_in']['user_id'] ;?>" ><font color="#652d90"><b>Block</b></font></a>
                    <?php } ?>


                </td>
            </tr>
            <?php } ?>
        </table>
        </form>
        <?php }else{ ?>

        <div class="alert alert-danger alert-dismissable" style="text-align:center;">No Contact Found.</div>

        <?php }
        */
        ?>
			</div>
			-->




        <?php

        if (!empty($rrs0_query))
        {
            ?>
            <strong>My Contacts</strong>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  >
                <tr >
                    <td height="25" valign="middle" style="padding-left:10px;">Your Contact List Contains
                        <strong><font class='red'><?php echo count($contact_count); ?></font></strong>entries. <br>
                    </td>
                </tr>
                <tr>
                    <td height="25" valign="middle" style="padding-left:10px;">
                        To Remove a User from your contacts list just click the check box and click the remove button below.
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <form name="form2" method="post" action="">
                            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                                <tr class="subtitle" >
                                    <td align="center" width="27" style="padding-left:10px;">
                                        <input  name="check_all" type="checkbox" id="check_all" onClick="select_all();" value="yes">
                                    </td>
                                    <td height="25" style="padding-left:10px;"> Name</td>
                                    <td> Company Name  </td>
                                    <td> Phone </td>
                                    <td> Fax </td>
                                    <td> Status </td>
                                </tr>
                                <?php
                                //$config= $this->Site_model->getTabledata("bt_setting");
                                //print_r($rrs0_query);
                                $cnt=0;
                                if(!empty($rrs0_query)){
                                    foreach ($rrs0_query as $key=>$rs0)
                                    {
                                        $cnt++;
                                        $company_name=$config[0]["null_char"];
                                        $phone=$config[0]["null_char"];
                                        $fax=$config[0]["null_char"];
                                        //echo "select * from " . $prev. "business where id=".$rs0["contact_id"];
                                        if($rs0["user_id"] == $this->session->userdata['logged_in']['user_id']) {
                                            //echo $ff = "select * from " . $prev. "business where user_id=".$rs0["uid"] ;
                                            $mem_comp=$this->Site_model-> getcountRecods("select * from " . $prev. "business where user_id=".$rs0["uid"]);
                                        } else {
                                            //echo $ff = "select * from " . $prev. "business where user_id=".$rs0["contact_id"];
                                            $mem_comp=$this->Site_model-> getcountRecods("select * from " . $prev. "business where user_id=".$rs0["contact_id"]);
                                            $mem_comp=$mem_comp[0];
                                        }
                                        if($mem_comp)
                                        {
                                            $company_name=$mem_comp["company_name"];
                                            if($rs0['status'] == 'N') {
                                                $phone= '*****';
                                                $fax= '*****';
                                            } else {
                                                $phone=$mem_comp["phone"];
                                                $fax=$mem_comp["fax"];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td align="center" width="27" style="padding-left:10px;" >
                                                <input type="checkbox" class="check_class"  name="checkbox<?php echo $cnt;?>" value="<?php
                                                echo $rs0["id"];?>">
                                            </td>
                                            <?php
                                            if($rs0["user_id"] == $this->session->userdata['logged_in']['user_id']) {
                                                //echo $ff = "select * from " . $prev. "members where user_id=".$rs0["uid"] ;
                                                $mem_user=$this->Site_model-> getcountRecods("select * from " . $prev. "members where user_id=".$rs0["uid"]);
                                                $mem_user=$mem_user[0];
                                                ?>
                                                <td > <a href="send_new_message.php?type=contact&tid=<?php echo $mem_user["user_id"];?>" ><?php echo ucfirst($mem_user["username"]);?></a>
                                                </td>
                                            <?php } else {
                                                //echo $ff = "select * from " . $prev. "members where user_id=".$rs0["contact_id"] ;
                                                $mem_user=$this->Site_model-> getcountRecods("select * from " . $prev. "members where user_id=".$rs0["contact_id"]);
                                                $mem_user=$mem_user[0];
                                                ?>
                                                <td >
                                                    <?php if($rs0["status"]=='N'){ ?>
                                                        <a href="JavaScript:void(0);" ><?=ucfirst($mem_user['firstname']).' '.ucfirst($mem_user['lastname']);?></a>
                                                    <?php }else{ ?>

                                                        <a href="send_new_message.php?type=contact&tid=<?php echo $rs0["contact_id"];?>" ><?php echo ucfirst($mem_user['firstname'])."&nbsp;&nbsp;".ucfirst($mem_user['lastname']); ?></a>

                                                    <?php }	?>

                                                    <!-- <a href="send_new_message.php?type=contact&tid=<?php echo $rs0["contact_id"];?>" ><?php echo ucfirst($mem_user['firstname'])."&nbsp;&nbsp;".ucfirst($mem_user['lastname']); ?></a> -->

                                                </td>
                                            <?php } ?>
                                            <td><? echo $company_name;?> </td>
                                            <td> <? echo $phone;?> </td>
                                            <td> <? echo $fax;?> </td>
                                            <td><?php if($rs0["status"]=='N') {?><font color="red"><b>Pending</b></font> <?php } else {?><font color="green"><b>Approved</b></font><?php } ?> |
                                                <?php if($rs0["user_id"] == $this->session->userdata['logged_in']['user_id']) { ?>
                                                    <a  href="blockuser.php?type=block&contact_id=<?php echo $rs0["contact_id"];?>&uid=<?php echo$mem_user['user_id'] ;?>"><font color="#652d90"><b>Block</b></font></a>
                                                <?php } else { ?>
                                                    <a  href="blockuser.php?type=block&contact_id=<?php echo $rs0["contact_id"];?>&uid=<?php echo$this->session->userdata['logged_in']['user_id'] ;?>"><font color="#652d90"><b>Block</b></font></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="6" align="left" style="padding-left:10px;">
                                        <input type="hidden" name="cnt" value="<?php echo $cnt; ?>">
                                        <input type="submit" name="Submit" onclick="check_input();" value="Remove" class="btn btn-warning btn-big">
                                        <!--input type="" name="Submit3" value="Remove" class="btn btn-primary" onclick="check_input()"-->
                                    </td>

                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        <?php } else { ?>
            <tr>
                <td colspan="6">
                    <div class="alert alert-danger alert-dismissable" style="text-align:center;">No Contact Found.</div>
                </td>
            </tr>
        <?php }

        ?>

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
    //-->
</script>
<script language="JavaScript">
    function check_input()
    {
        var checked_boxes = $('input.check_class:checked').length
        if(checked_boxes == 0) {
            alert('Please Select Atleast One Checkbox');
            return false ;
        }
    }
    function validate(form)
    {
        if((form.username.value==""))
        {
            alert('Please specify Member ID');
            form.username.focus();
            return false;
        }
        return true;
    }
</script>


</body>
</html>
