<div id="collapseThree" class="panel-collapse collapse">
    <div class="panel-body">
        <div class="displaynegoMessage" ></div>

        <!--Container Section1 -->

        <div class="">

            <div id="amazingcarousel-container-1" >

                <form  name="" id="negotiate" class="form-horizontal" method="post" action="" >

                    <input  required="" type="hidden" name="subject"  id="subject" class="form-control" value="<?php
                    echo $replydata[0]['subject'];?>" >

                    <div class="form-group">

                        <label class="col-md-3 col-sm-4">Enquiry Message <span>*</span>

                        </label>

                        <div class="col-md-9 col-sm-8 col-xs-12">

                            <?php  echo $replydata[0]['message'];?>

                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-md-3 col-sm-4">Supplier Reply <span>*</span>

                        </label>

                        <div class="col-md-9 col-sm-8 col-xs-12">

                            <?php
                            echo $supplierData[0]['message'];?>

                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-md-3 col-sm-4">Message Description: <span>*</span>

                        </label>

                        <div class="col-md-12">

                            <textarea rows="5" name="description" class="form-control"  id="description" required=""></textarea>

                        </div>

                    </div>



                    <div class="form-group">

                        <div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4 col-xs-12">
                            <input type="button" value="Submit Message" onClick="return sendNegoreply()" class="btn btn-primary" name="sub">

                        </div>

                    </div>

                    <div class="clear"></div>

                </form>

            </div>


        </div>
    </div>
</div>
