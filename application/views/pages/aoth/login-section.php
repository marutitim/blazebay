<h4 class="">Sign in</h4>
<p class="">Hello, Welcome to your account.</p>
<div class="social-sign-in outer-top-xs">
<!--    <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>-->
<!--    <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>-->
</div>
<form method="post"   class="register-form outer-top-xs" role="form">
    <div class="col-sm-12 col-xs-12 invalidLogin"></div>
    <div class="form-group">
        <div class="col-sm-12 col-xs-12 usernameerror"></div>
        <label class="info-title" for="exampleInputEmail1">User Name/Email<span>*</span></label>
        <input type="text" nam="username" class="form-control unicase-form-control text-input" id="username" >
    </div>


    <div class="form-group">
        <div class="col-sm-12 col-xs-12 passworderr"></div>
        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input" id="password" >
    </div>
    <div class="radio outer-xs">
        <label>
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
        </label>
        <a href="<?php echo base_url() ?>forgot-password" class="forgot-password pull-right">Forgot your Password?</a>
    </div>
    <button type="button" id="submit-login"  onclick="return userLogin()" class="btn-upper btn btn-primary checkout-page-button">Login</button>
</form>
