<?php
$pagename = "my_received_enquiries";
if(!isset($this->session->userdata['logged_in']['user_id'])){
    header('location:'.base_url());
}
//$flashmsg = new \Plasticbrain\FlashMessages\FlashMessages();

//===== get login user Details:: Starts =====
if(isset($this->session->userdata['logged_in']['user_id'])){

    $logged_user_id       = $this->session->userdata['logged_in']['user_id'];
    $logged_user_usertype = $this->session->userdata['logged_in']['usertype'];
    $logged_user_memtype  =$this->session->userdata['logged_in']['memtype'];

    $user_id = $logged_userid = $logged_user_id;

}
//===== get login user Details:: Ends =====

//======= Defines Table ========


//get my received enquiries.
$getEnquiries_received = $this->Site_model->get_enqreceived($logged_user_id );

$getEnquiries_sent     =$this->Site_model->get_enquiryData_sent($logged_user_id );


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

        <div class="col-md-12">
        <?php // $flashmsg->display(); ?>
        <div class="featuredpro">

        <!--Container Section1 -->
        <div class="">
        <div id="amazingcarousel-container-1" >
            <div class="">
                    <table class="table table-hover table-striped" id="data-table">
                        <thead>
                        <tr >
                            <td style="display: none;"><b>Id</b></td>
                            <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){?>
                            <td ><b>From User</b></td>
                            <?php  }?>
<!--                            <td><b>Email</b></td>-->
                            <td ><b>Product</b></td>
                            <td><b>Message</b></td>
                            <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){?>
                            <td><b>Replied</b></td>
                            <?php  }?>
                            <td><b>Action</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count=0;
                        foreach ($getEnquiries_received as $received) {
                            $enquiry_id = $received['id'];
                            $count++;
                            ?>

                            <tr class='mtr'>
                                <td style="display: none;"><?php echo $received['id'];?></td>

                                <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2){?>
                                <td >
                                    <?php
                                    if(!empty($received['user_id'])){
                                        echo $received['full_name'];
                                    }else{
                                        echo "Unknown";
                                    }
                                    ?>
                                </td>

   <?php }?>

                                <td ><?php
                                    if(!empty($received['prod_id'])){
                                        $qry="SELECT image,title,id,uid FROM bt_products where id=".$received['prod_id'];
                                        $productdata = $this->Site_model->execute($qry );
                                        ?>

                                        <div class="row">
                                            <div class="col-sm-4 hidden-xs">
                                                <img style="width:150px !important;" src="<?php echo base_url().'assets/uploadedimages/'. $productdata[0]['image']; ?>"
                                                     alt="<?=$productdata[0]['title'];?>"  class="img-responsive"/></div>
                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url().'/product-details/'.$productdata[0]['title'].'/'.$productdata[0]['id'].'/'.$productdata[0]['uid'];?>"><?=$productdata[0]['title'];?></a>
                                                <p style="text-transform: lowercase !important;color: #656565;font-weight: 300;line-height: 1.7em;"><?=$this->session->userdata['orderData']['product_desc'];?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td valign="top"><?php echo $received['message'];?></td>
                                <?php if(isset($this->session->userdata['logged_in'])&&$this->session->userdata['logged_in']['usertype']==2) { ?>
                                    <?php
                                    if ($received['msg_read'] == 1) {
                                        ?>
                                        <td><i class="fa fa-check-circle" style="color:green;"></i></td>
                                    <?php } else { ?>
                                        <td><i class="fa fa-times-circle" style="color:red;"></i></td>
                                    <?php
                                    }
                                } ?>


                                <td valign="top"><a href="<?php echo base_url()?>reply-enquiries-received/<?php echo $enquiry_id; ?>"  class="btn btn-warning btn-big">Reply</a></td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>

            </div>
        </div>
        <?php /* ?>
            <div id="amazingcarousel-container-1" style="margin-top: 20px;">
              <div class="outmsglist-area" >
                <h5 class="" style="padding-left:10px; ">Sent Enquiries:</h5>
                <?php
                if ($getEnquiries_sent) { ?>

                  <form action="show_messages.php" method="post" name="form3" id="form3">
                    <!--
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
                            <a href="<?=base_url();?>read-msg-out/<?=$going["tid"];?>/<?=$going["id"];?>" target="_self">  <?php
                              if (strlen ($going["subject"])>50){
                                echo substr($going["subject"], 0,  strrpos( substr($going["subject"], 0, 50),' ' )) . "..";
                              } else{ echo $going["subject"]; }
                              ?>
                            </a>
                          </td>

                          <td valign="top" ><?php  echo $going["show_nameas"]; ?> </td>

                          <td valign="top" ><?php echo date('d M Y h.i.s A', strtotime($going["tempdate"]));?></td>
                          <td valign="top" ><?php echo $outmsg_status;?></td>
                        </tr>

                      <?php } ?>
                    </table>
                    -->

                    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">

                      <tr class="subtitle" >
                        <td width="10" style="padding-left:10px;" ><b>Sl.</b>
                          <!-- <input type="checkbox" name="check_all" value="yes" onClick="select_all();"> -->
                        </td>
                        <td style="width:200px"><b>Subject</b></td>
                        <td style="width:180px"><b>To User</b></td>
                        <td style="width:250px"><b>To Email</b></td>
                        <td><b>Message</b></td>
                      </tr>

                      <?php
                      $count=0;
                      foreach ($getEnquiries_sent['result'] as $received) {
                        $enquiry_id = $received['id'];
                        $count++;
                        ?>

                        <tr class='mtr'>
                          <td width="10" style="padding-left:10px;" ><?php echo $count;?>
                            <!-- <div align="right">
                              <input name="checkbox<?php echo $enquiry_id;?>" id="checkbox<?php echo $enquiry_id;?>" type="checkbox" id="checkbox<?php echo $enquiry_id;?>" value="<?php echo $enquiry_id;?>" >
                              <input type="hidden" name="spam1" id="spam1"/>
                            </div> -->
                          </td>

                          <td valign="top" ><?php echo $received['subject'];?></td>
                          <td valign="top" >
                            <?php
                            if(!empty($received['member_id'])){
                              echo $received['member_firstname'].' '.$received['member_lastname'];
                            }else{
                              echo "Unknown";
                            }
                            ?>
                          </td>
                          <td valign="top"><?php echo $received['email'];?></td>
                          <td valign="top"><?php echo $received['message'];?></td>
                        </tr>

                      <?php } ?>

                    </table>
                    <!--
                    <p class="text-center">
                      <input type="hidden" name="cnt2" value="<?php echo $count2; ?>">
                      <input type="submit" name="Submit2" value="Remove" class="btn btn-warning btn-big">
                    </p>
                    -->

                  </form>

                <?php } else { ?>

                  <div class="alert alert-danger alert-dismissable" style="text-align:center;" > No Outgoing Message. </div>

                <?php } ?>
              </div>
            </div>
            <?php */ ?>
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



</body>
</html>
