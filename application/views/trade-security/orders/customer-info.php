<div id="collapseTwo" class="panel-collapse collapse">
    <div class="panel-body">
        <div class="col-md-4 ">
            <form class="register-form" role="form">
                <div class="form-group">
                    <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                    <input type="email" class="form-control unicase-form-control text-input" value="<?php  echo $memD[0]['firstname'];?>' '<?php  echo $memD[0]['lastname'];?>" id="exampleInputName" placeholder="">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form class="register-form" role="form">
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Your Address <span>*</span></label>
                    <input type="email" class="form-control unicase-form-control text-input" value="<?php echo $memD[0]['email'];?>" id="email" placeholder="">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form class="register-form" role="form">
                <div class="form-group">
                    <label class="info-title" for="exampleInputTitle">Phone <span>*</span></label>
                    <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $memD[0]['phone'];?>" id="phone-number" placeholder="">
                </div>
            </form>
        </div></div>
</div>