<!-- Contact Supplier Modal [start] -->
<div id="ContactSupplier" class="modal fade  ContactSupplier" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <table>
                    <tr><td><h2 class="modal-title">Contact Supplier</h2></td><td ><button style="float:right;" class="btn btn-primary" onclick="return viewMinisite()"  value="View Minisite" > View Minisite</button></td></tr>
                </table>
            </div>
            <div class="modal-body">
                <form method="post" action=""  class="Contact_Supplier_Frm" id="Contact_Supplier_Frm" >
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <span class="modal-supplier-product-image">
                     <div id="productimage"></div>
                    </span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">


                                        <table>
                                            <tr id="supplierv"><td style="width:120px"><strong>Supplier Name :</strong></td><td><div id="suppliername"></div></td></tr>
                                            <tr id="addressv"><td style="width:120px"><strong>Address:</strong> </td><td><div id="address"></div></td></tr>
                                            <tr id="streetv"><td style="width:120px"><strong>Street:</strong> </td><td><div id="street"></div></td></tr>
                                            <tr id="phonev"><td style="width:120px"><strong>Phone :</strong> </td><td><div id="phone"></div></td></tr>
                                            <tr id="phonev"><td style="width:120px"><strong>Contact person :</strong> </td><td><div id="contact"></div></td></tr>
                                        </table>
                                        <input type="hidden" value="url" id="minisiteurl" name="minisiteurl"/>
                                    </div>
                                </div>

                                <input type="hidden" name="supplier_fname" id="supplier_fname" class="hidden_supplier_fname" value=""  >
                                <input type="hidden" name="supplier_lname" id="supplier_lname" class="hidden_supplier_lname" value="" autocomplete="off" >
                                <input type="hidden" name="supplier_email" id="supplier_email" class="hidden_supplier_email" value="" autocomplete="off" >
                                <input type="hidden" name="product_id"     id="product_id"     class="hidden_product_id"     value=""  >
                                <input type="hidden" name="product_name"   id="product_name"   class="hidden_product_name"  value=""  >
                                <input type="hidden" name="product_image"  id="product_image" class="hidden_product_image"  value=""  >
                                <input type="hidden" name="company_name"  id="company_name" class="hidden_product_image"  value=""  >
                                <input type="hidden" name="supplier_id"  id="supplier_id" class="hidden_supplier_id"  value=""  >




                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="recipient-name">Your Name : </label>
                                <input name="name" id="name" required="" class="form-control" placeholder="Enter Your Name" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="message-text">Your Email : </label>
                                <input name="email" id="email" class="form-control"   placeholder="Enter Your Email" type="email" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="message-text">Your Message : </label>
                                <textarea name="message" id="message" class="form-control" required="" placeholder="Enter Your Message" cols="5" rows="5"></textarea>
                            </div>
                        </div>



                        <div class="col-sm-12 col-xs-12 text-center" id="LoaderAjax" style="display: none;">
                            <img src="images/loader.gif" width="35"> Sending mail...
                        </div>
                    </div>

                    <input type="hidden" name="contact_supplier" id="contact_supplier" value="1">
                </form>
                <div class="modal-footer">

                    <table>
                        <tr><td></td>
                            <td><button style="padding: 4px 13px !important" type="button" class="btn btn-warning2" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="return submitsupplierContact();">Submit</button></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Supplier Modal [ends] -->