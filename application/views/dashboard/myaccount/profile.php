<!-- User -->
<div class="user-box">
    <div class="user-img">
        <?php
        $where="user_id ='".$this->session->userdata['logged_in']['user_id']."'";
        $LOGGED_USER_DETAILS =$this->Site_model->getDataById('bt_members',$where);
        $LOGGED_USERNAME = $LOGGED_USER_DETAILS[0]['username'];
        $USERNAME_TXT="Username:".$LOGGED_USERNAME;

          if(file_exists('assets/uploadedimages/'.$LOGGED_USER_DETAILS[0]['user_img']))
          {
              $file = $LOGGED_USER_DETAILS[0]['user_img'];
              $path=base_url().'assets/uploadedimages/';
              $image_thumb=$path.$file;
              ?>
              <img src="<?=$image_thumb?>" alt="<?php echo $LOGGED_USERNAME;?>" title="<?php echo $LOGGED_USERNAME;?>"
                   class="img-circle img-thumbnail img-responsive">
          <?php
          }else {
        ?>

            <img src="<?=base_url()?>assets/images/avartar.png" alt="<?php echo $LOGGED_USERNAME;?>" title="<?php echo $LOGGED_USERNAME;?>"
                 class="img-circle img-thumbnail img-responsive">
        <?php  } ?>



        <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
    </div>
    <h5><a href="#"><?php echo ucwords($this->session->userdata['logged_in']['firstname']);?></a> </h5>
    <ul class="list-inline">
        <li>
            <a href="<?=base_url()?>edit-profile" >
                <i class="zmdi zmdi-settings"></i>
            </a>
        </li>

        <li>
            <a href="<?=base_url()?>logout" class="text-custom">
                <i class="zmdi zmdi-power"></i>
            </a>
        </li>
    </ul>
    <h5><a href="<?=base_url()?>edit-profile">Edit Profile</a> </h5>

</div>
<!-- End User -->