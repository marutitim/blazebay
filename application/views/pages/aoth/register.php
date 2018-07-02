<h4 class="checkout-subtitle">Create a new account</h4>
<p class="text title-tag-line">Create your new account.</p>
<form class="register-form outer-top-xs"  enctype="multipart/form-data" name="frmUser" id="signup_form" method="post" role="form">

    <div class="register-msg"></div>
     <div class="col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="info-title" for="exampleInputEmail2">First name<span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" name="firstname" id="firstname" >
    </div>
        </div>
    <div class="col-sm-6 col-xs-12"> <div class="form-group">
        <label class="info-title" for="exampleInputEmail2">Last name<span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" name="lastname" id="lastname" >
    </div></div>
    <div class="col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" name="email" id="email" >
        </div></div>

    <div class="col-sm-6 col-xs-12"> <div class="form-group">
        <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
        <input type="text"  class="form-control unicase-form-control text-input" name="phone" id="phone" >
    </div></div>

    <div class="col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="info-title" for="exampleInputEmail1">Username <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" name="username" id="username" >
    </div>
        </div>
    <div class="col-sm-6 col-xs-12"><div class="form-group">
        <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input" name="password" id="password" >
    </div></div> <div class="col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input"  name="cpassword" id="cpassword" >
    </div>
        </div>
    <!-- ../End -->
    <div class="company-floorarea" id="company-floorarea" style="display:none;">

        <!-- Starts -->
        <div class="col-sm-6 col-xs-12">
            <div class="form-group ">
                <label class="control-label" for="recipient-name">Company Name :

                </label>
                <input type="text" id="companyname" name="companyname"  class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group ">
                <label class="control-label" for="recipient-name">Company Email:

                </label>
                <input type="text" id="companyemail" name="companyemail"  class="form-control" autocomplete="off">
            </div>
        </div>

        <!-- Starts -->
        <div class="col-sm-6 col-xs-12">
            <div class="form-group ">
                <label class="control-label" for="recipient-name">Company Mobile : </label>
                <input type="text" id="companyphone" name="companyphone"
                       class="form-control" data-fv-stringlength="true" data-fv-stringlength-min="10"
                       autocomplete="off">
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group ">
                <label class="control-label" for="recipient-name">Company Address: <font color="#FF0000">*
                    </font>
                </label>
                <textarea id="address1" rows="2" cols="60" name="address1"   class="form-control"></textarea>
            </div>
        </div>

        <!-- Starts -->
        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="recipient-name">Preferable Category:
                    <font color="#FF0000">*</font>
                </label>
                <select class="form-control" name="preferable_cat" id="preferable_cat" >
                    <option value=''>Select Business Category</option>
                    <?php
                    $query_business_cat = $this->Site_model->getcountRecods("SELECT cat_name, id, pid FROM bt_categories
                     WHERE status = 'Y' AND pid != 0 ORDER BY cat_name ASC");
                    foreach($query_business_cat as $key=>$cat) {
                        ?>
                        <option value="<?=$cat['id'] ?>" ><?= $cat['cat_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
    <div class="" id="signup-fieldsnot-forcourier" style="display:none;">
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="recipient-name">Enter Minisite Url:<font color="#FF0000">*</font></label>
                <div class=" miniurl-box">
                    <input type="text" name="minisite_custom_url" value="" id="minisite_custom_url"   class="form-control"  autocomplete="off">

                    <span class="zds-msite-span">.blazebay.com</span>
                </div>

                <p id="mcustom_urlresult" class="zsr-sgnup-murl"></p>
            </div>

        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="minisite-url">&nbsp;</label>
                <div>
                    <div>[ Minisite url will not change in future.]</div>
                    <span>[ Example: <font color="grey">mysite</font>.blazebay.com ,Please Add your url like: mysite, site44 etc only ]</span>
                    <span>Only AlphaNumeric Character Allowed</span>
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="col-sm-12 col-xs-12"> <div class="radio outer-xs">
        <label>
            <input type="radio" name="usertype" id="optionsRadios2" value="1" checked>Buyer
        </label>
        <label>
            <input type="radio" name="usertype"  id="optionsRadios2" value="2">Supplier
        </label>
        <label>
            <input type="radio" name="usertype" id="optionsRadios2" value="4">Courier
        </label>
        <a href="#" class="forgot-password pull-right">Terms and Conditions</a>
    </div></div>
    <div class="col-sm-12 col-xs-12">
    <button type="button" onclick="return register()" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
        </div>
</form>
