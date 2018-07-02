
<div id="collapseOne" class="panel-collapse <?php if(isset($replydata[0]['message'])){ echo 'collapse';}?>">

    <!-- panel-body  -->
    <div class="panel-body">


        <div class="row">

            <!-- review -->
            <div class="col-md-12 col-sm-12">
                <div id="qty-dialog"></div>
                <table id="cart" class="table table-hover table-condensed" style="height:10% !important;">
                    <thead>
                    <tr>

                        <th >Product details</th>
                        <th  >Price</th>

                        <th ></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-4 hidden-xs"><img style="width:150px !important;"
                                                                     src="<?="https://www.blazebay.com/assets/uploadedimages/".$productData[0]['image']?>"
                                                                     alt="<?=$productData[0]['title'];?>"  class="img-responsive"/></div>
                                <div class="col-sm-6">
                                    <?=$productData[0]['title'];?>

                                </div>
                            </div>
                        </td>
                        <td data-th="Price"><b></b><?php echo $currencySymbol ?>.<?=number_format((float)$productData[0]['price']*
                                $currencyRate, 2, '.', '')?></td>




                    </tr>
                    </tbody>

                </table>

            </div>
            <!-- review-->

        </div>

        <div class="row">

            <!-- review -->
            <div class="col-md-12 col-sm-12">
                <form method="post" action=""  class="Contact_Supplier_Frm" id="Contact_Supplier_Frm" >
                    <div class="row">

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="recipient-name">Your Name : </label>
                                <div class="ErrorName"></div>
                                <input name="name" id="contact-name" required="" class="form-control" placeholder="Enter Your Name" type="text"
                                       value="<?php  echo $memD[0]['firstname'];?>   <?php  echo $memD[0]['lastname'];?>" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="message-text">Your Email : </label>
                                <div class="ErrorEmail"></div>


                                <input name="email" id="contact-email" class="form-control"  value="<?php echo $memD[0]['email'];?>" placeholder="Enter Your Email" type="email" autocomplete="off">

                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="message-text">Your Message:</label>

                                <div class="ErrorMessage"></div>
                                <textarea name="contact-message" id="contact-message"></textarea>
                            </div>
                        </div>
                        <input name="supplier_id" id="contact-supplier-id" class="form-control"  value="<?php echo $productData[0]['uid'];?>"
                                type="hidden"  >
                        <input name="contact-product-id" id="contact-product-id" class="form-control"  value="<?php echo $productData[0]['pid'];?>"
                               type="hidden"  >


                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group" >

                                <input name="button"  onclick="return submitsupplierContact()" type="button" class="btn btn-primary text-right" value="Submit Enquiry"/>

                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 text-center" id="LoaderAjax" style="display: none;">
                            <img src="images/loader.gif" width="35"> Sending mail...
                        </div>
                    </div>

                    <input type="hidden" name="contact_supplier" id="contact_supplier" value="1">
                </form>
            </div>
            <!-- review-->

        </div>
    </div>
    <!-- panel-body  -->

</div><!-- row -->