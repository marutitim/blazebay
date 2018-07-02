<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5/9/2018
 * Time: 10:50 AM
 */
?>
<?php include(APPPATH.'/views/pages/aoth/login-modal.php'); ?>

<?php include(APPPATH.'/views/pages/contact-supplier.php'); ?>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="module-heading">
                    <h4 class="module-title"><?php if($languange=='Swahili'){ echo 'Wasiliana nasi';} else {?> Contact Us<?php }?></h4>
                </div><!-- /.module-heading -->

                <div class="module-body">
                    <ul class="toggle-footer" style="">
                        <li class="media">
                            <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span>
                            </div>
                            <div class="media-body">
                                <p>Blazebay Ltd, Panesar's Centre,1st Floor, Mombasa Road, P.O. Box 65159 - 00618, Ruaraka, Nairobi, Kenya. </p>
                            </div>
                        </li>

                        <li class="media">
                            <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                            </div>
                            <div class="media-body">
                                <p>+254-741-403-640</p>
                            </div>
                        </li>

                        <li class="media">
                            <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                            </div>
                            <div class="media-body">
                                <span><a href="#">support@blazebay.com</a></span>
                            </div>
                        </li>

                    </ul>
                </div><!-- /.module-body -->
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="module-heading">
                    <h4 class="module-title"><?php if($languange=='Swahili'){ echo 'Kituo cha Usaidizi';} else {?> Contact Us<?php }?></h4>
                </div><!-- /.module-heading -->

                <div class="module-body">
                    <ul class='list-unstyled'>
                        <li class="first"><a href="<?=base_url()?>sitehelp" title="Contact us">Site Help</a></li>
                        <li><a href="<?=base_url()?>faq" title="FAQ">FAQ/Help</a></li>
                        <li><a href="<?=base_url()?>refund-return" title="Refund">Refund & Return</a></li>
                        <li><a href="<?=base_url()?>downloads" title="Downloads">Downloads</a></li>
                        <li class="last"><a href="<?=base_url()?>sitemapL" title="Sitemap">Sitemap</a></li>
                    </ul>
                </div><!-- /.module-body -->
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="module-heading">
                    <h4 class="module-title"><?php if($languange=='Swahili'){ echo 'Kuhusu  Blazebay.com';} else {?>About Blazebay.com<?php }?></h4>
                </div><!-- /.module-heading -->

                <div class="module-body">
                    <ul class='list-unstyled'>
                        <li class="first"><a title="about" href="<?=base_url()?>about">About us</a></li>
                        <li><a title="" href="<?=base_url()?>successStory">Success Story</a></li>
                        <li><a title="" href="<?=base_url()?>termsAndConditions">Terms & Conditions</a></li>
                        <li><a title="" href="<?=base_url()?>privacyPolicy">Privacy Policy</a></li>
                        <li class="last"><a title="" href="<?=base_url()?>access-secure-trade-services">Trade Security</a></li>
                    </ul>
                </div><!-- /.module-body -->
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="module-heading">
                    <h4 class="module-title"><?php if($languange=='Swahili'){ echo 'Kutangaza na Utoaji';} else {?>Dispatch and Delivery<?php }?></h4>
                </div><!-- /.module-heading -->

                <div class="module-body">
                    <ul class='list-unstyled'>
                        <li class="first"><a href="<?=base_url()?>feedback" title="About us">Feedback</a></li>
                        <li><a href="<?=base_url()?>contact" title="">Contact Us</a></li>
                        <li><a href="<?=base_url()?>jobsAndCareer" title="">Jobs & Careers</a></li>
                        <li><a href="<?=base_url()?>advertiseWithUs" title="">Advertise with us</a></li>
                        <li><a href="<?=base_url()?>learningCenter" title="">Learning Center</a></li>
                        <li class=" last"><a href="<?=base_url()?>partner-with-us" title="">Partner with us</a></li>
                    </ul>
                </div><!-- /.module-body -->
            </div>
        </div>
    </div>
</div>
