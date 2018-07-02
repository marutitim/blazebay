<div class="modal fade loginmodal"  id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="#">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>

            <!-- Begin # DIV Form -->
            <div id="div-forms">

                <!-- Begin # Login Form -->
                <form id="login-form">
                    <div class="modal-body">
                        <?php include('login-section.php'); ?>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        </div>
                        <div>
                            <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                            <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                        </div>
                    </div>
                </form>
                <!-- End # Login Form -->
            </div>
            <!-- End # DIV Form -->

        </div>
    </div>
</div>


<div id="loginp" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Please login to continue</h4>
            </div>
            <div class="modal-body">

                <div class="hr-line-dashed"></div>
                <div class="row">

                    <div class="col-sm-12 ">
                        <form method="post"  action="">
                            <div class="row">

                                <div class="col-sm-12 col-xs-12 modal-invalidLogin">

                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <div class="col-sm-12 col-xs-12 modal-username-invalidLogin"></div>
                                    <div class="form-group">
                                        <label class="control-label" for="recipient-name">User Name/Email : <font color="#FF0000">*</font></label>
                                        <input name="username" id="modal-username" required="" class="form-control" placeholder="Enter Username/ Email" type="text"></div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="col-sm-12 col-xs-12 modal-password-invalidLogin"></div>
                                    <div class="form-group"> <label class="control-label" for="message-text">Password : <font color="#FF0000">*</font></label>
                                        <input name="password" id="modal-password" class="form-control" required="" placeholder="Enter Password" type="password"> </div>
                                </div>

                                <div class="col-sm-12 col-xs-12 ">
                                    <div class="col-sm-4"><button class="btn btn-upper btn-primary btn-block" type="button"  id="login-modal-button">Login</button></div>

                                    <div class="col-sm-3"><a href="<?php echo base_url();?>forgot-password" target="_blank">Forgot password?</a></div>

                                    <div class="col-sm-5"><small>Dont have an account?</small><a href="<?php echo base_url();?>signup" target="_blank">&nbsp;Register</a></div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
