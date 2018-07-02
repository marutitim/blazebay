



<div id="loginp" class="modal fade" aria-hidden="true" style="margin-top: 10%;">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top: 15%">
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">

                <div class="hr-line-dashed"></div>
                <div class="row">

                    <div class="col-sm-12 ">
                        <form method="post"  action="">
                            <div class="row">

                                <div class="col-sm-12 col-xs-12 homemodal-invalidLogin">

                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <div class="col-sm-12 col-xs-12 homemodal-username-invalidLogin"></div>
                                    <div class="form-group">

                                        <input name="username"  id="modal-homeusername" required="" class="form-control" placeholder="Enter Username/ Email" type="text"></div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="col-sm-12 col-xs-12 homemodal-password-invalidLogin"></div>

                                    <input name="password" id="modal-homepassword" class="form-control" required="" placeholder="Enter Password" type="password"> </div>
                            </div>

                            <div class="col s12 ">
                                <div class="col s6">
                                    <button class="btn btn-upper blazecolor btn-block" type="button"   onclick="return modallogin()">Login</button>

                                </div>
                                <div class="col s6"> <button class="btn btn-upper blazecolor2 btn-block" type="button"   onclick="return modalcancel()">Cancel</button></div>

                                <div class="col 12">
                                    <br><a href="<?php echo base_url();?>forgot-password" target="_blank">Forgot password?</a></div>

                                <div class="col s12"><small>Dont have an account?</small><a href="<?php echo base_url();?>register" target="_blank">&nbsp;Register</a></div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<div class="footer-main">
    <p>
        <span class="block text-small">Secure shopping at BlazeBay via</span>
        <i class="fa fa-cc-amex"></i>
        <i class="fa fa-cc-mastercard"></i>
        <i class="fa fa-credit-card"></i>
        <i class="fa fa-cc-paypal"></i>
        <i class="fa fa-cc-visa"></i>
        <i class="fa fa-google-wallet"></i>
        <i class="fa fa-cc-discover"></i>
        <i class="fa fa-cc-jcb"></i>
    </p>
    <p>
        <span class="block text-small">Having problem? Contact us</span>
        +254-741-403-640 | support@blazebay.com
    </p>

    <div class="social-footer">
        <a href="https://www.facebook.com/Blazebaycom-433808950316401/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/Blazebayltd" class="twitter" target="_blank" ><i class="fa fa-twitter"></i></a>
        <a href="https://plus.google.com/u/0/104872947338133876935" target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a>
    </div>
</div>
<!-- End Footer main Section -->

<!-- Copyright Section -->
<div class="copyright">
    <span class="block">&copy; 2016 - <?=date('Y')?> BlazeBay</span>
    <div class="navigation">
        <a href="<?=base_url()?>termsAndConditions">Term & Condition</a>
        <a href="<?=base_url()?>privacyPolicy">Privacy Policy</a>
    </div>
</div>