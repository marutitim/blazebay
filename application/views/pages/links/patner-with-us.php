<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include(APPPATH.'/views/layout/head.php');?>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <?php include(APPPATH.'/views/layout/top.php'); ?>
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <?php include(APPPATH.'/views/layout/mainheader.php'); ?>
        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <?php include(APPPATH.'/views/layout/menu.php'); ?>
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<?php include(APPPATH.'/views/pages/breadcrum.php'); ?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="body-content">
        <div class="container">


            <div class="checkout-box faq-page">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="heading-title"><?=$name?></h2>
                        <form name="fpartnership" id="fpartnership" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this);">

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Partnership options: <span style="color:red;"> * </span></label>
                                <select name="partnership" id="partnership" class="form-control">
                                    <option value="" selected="selected">Select Option</option>
                                    <option value="Link Banner Exchange">Link &amp; Banner Exchange</option>
                                    <option value="Newsletter Promotion">Newsletter Promotion</option>
                                    <option value="Agent Program">Agent Program</option>
                                    <option value="Trade Show Cooperation">Trade Show Cooperation</option>
                                    <option value="Marketing and Content Partners">Marketing and Content Partners</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Name : <span style="color:red;"> * </span></label>
                                <input id="name" name="name" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Company Name : <span style="color:red;"> * </span></label>
                                <input id="company_name" name="company_name" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Phone : <span style="color:red;"> * </span></label>
                                <input id="phone" name="phone" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Email : <span style="color:red;"> * </span></label>
                                <input id="email" name="email" class="form-control" type="email">
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                        <label for="email2">Country : <span style="color:red;"> * </span></label>
                        <select name="country" id="country" class="form-control">
                        <option value="" selected="selected">Select Option</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Albania">Albania</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="French Southern territories">French Southern territories</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Benin">Benin</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belize">Belize</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Canada">Canada</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Côte d’Ivoire">Côte d’Ivoire</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Congo, The Democratic Republic">Congo, The Democratic Republic</option>
                        <option value="Congo">Congo</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Germany">Germany</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Algeria">Algeria</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Spain">Spain</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Finland">Finland</option>
                        <option value="Fiji Islands">Fiji Islands</option>
                        <option value="Falkland Islands">Falkland Islands</option>
                        <option value="France">France</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Micronesia, Federated States o">Micronesia, Federated States o</option>
                        <option value="Gabon">Gabon</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Greece">Greece</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="Guam">Guam</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Heard Island and McDonald Isla">Heard Island and McDonald Isla</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="India">India</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Iran">Iran</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Iceland">Iceland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Japan">Japan</option>
                        <option value="Kazakstan">Kazakstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="South Korea">South Korea</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Laos">Laos</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Macao">Macao</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Moldova">Moldova</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Macedonia">Macedonia</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Namibia">Namibia</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="Niger">Niger</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niue">Niue</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Norway">Norway</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nauru">Nauru</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Panama">Panama</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Palau">Palau</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Poland">Poland</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="North Korea">North Korea</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Palestine">Palestine</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Réunion">Réunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Singapore">Singapore</option>
                        <option value="South Georgia and the South Sa">South Georgia and the South Sa</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Somalia">Somalia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Syria">Syria</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Chad">Chad</option>
                        <option value="Togo">Togo</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United States Minor Outlying I">United States Minor Outlying I</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="United States">United States</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Saint Vincent and the Grenadin">Saint Vincent and the Grenadin</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Yugoslavia">Yugoslavia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                        <option value="india1">india1</option>
                        </select>
                        </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Subject : <span style="color:red;"> * </span></label>
                                <input id="subject" name="subject" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email2">Message : <span style="color:red;"> * </span></label>
                                <textarea style="max-width:100%;" id="message" name="message" rows="5" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <p class="xhr-mrgn-top">
                                <input name="submit" value="Submit" class="btn btn-warning btn-big" type="submit">
                            </p>
                        </div>
                        </form>

                    </div>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">

                <?php include(APPPATH.'/views/pages/premium-brands.php'); ?>
            </div><!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div>



    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">


        <?php include(APPPATH.'/views/layout/footerbottom.php'); ?>
        <?php include(APPPATH.'/views/layout/copyright.php'); ?>

    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->


    <!-- For demo purposes – can be removed on production -->


    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <?php include(APPPATH.'/views/layout/footer.php'); ?>


    <script>
        $(document).ready(function(){
            $(".changecolor").switchstylesheet( { seperator:"color"} );
            $('.show-theme-options').click(function(){
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function() {
            $('.show-theme-options').delay(2000).trigger('click');
        });
    </script>


</body>
</html>