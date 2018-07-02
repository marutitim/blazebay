<div class="page-block margin-bottom postreqments" style="background-image: url('assets/images/postreq.jpg');height: 380px !important;color:#ffffff !important;">
    <div class="row" >
        <div class="col s12" style="margin-top:2%;margin-left:10%;margin-bottom:2%;">

            <h2>Post Your Requirement</h2>



        </div>
        <div class="col s4"><i class="fa fa-question" style="padding-left:25%"></i> <br>Tell us what you need</div>
        <div class="col s4"><i class="fa fa-phone" style="padding-left:25%"></i><br>Recieve suppliers' response</div>
        <div class="col s4"><i class="fa fa-handshake-o" style="padding-left:25%"></i><br>Seal the deal with supplier</div>
        <?php if(isset($this->session->userdata['logged_in']['user_id'])){
            $user_id=$this->session->userdata['logged_in']['user_id'];
            $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
            $memD= $this->Site_model->getDataById( 'bt_members', $where );
        }?>
        <div class="col s12" > <div class="input-field">
                <?php if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
                <form  class="form-box form-box2" name="post_enquiry_form" id="post_enquiry_form" enctype="multipart/form-data" action="" method="post">
                    <input type="text" class="form-control unicase-form-control text-input"  value="<?=$memD[0]['firstname']?$memD[0]['firstname']:'';?>  <?=$memD[0]['lastname']?$memD[0]['lastname']:'';?>" id="name" name="name" placeholder="">
                    <input type="email" class="form-control unicase-form-control text-input" value="<?=$memD[0]['email']?$memD[0]['email']:'';?>"   id="email" name="email" placeholder="">
                    <?php } ?>

                    <textarea class="form-control unicase-form-control" id="product" name="product" placeholder="I am looking for..." ></textarea>

            </div>

            <button class="btn  btn-block blazecolor mui--text-center" onclick="return postInquiry()" type="button" style="margin-left: 35%;">Submit</button></div>
        </form>

    </div>

</div>