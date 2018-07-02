<div id="collapseOne" class="panel-collapse collapse in">

    <!-- panel-body  -->
    <div class="panel-body">
        <div class="row">
            <form class="register-form" role="form">
                <div class="form-group col-md-12">


                    <label class="info-title" for="exampleInputName">Supplier's Email Address <span>*</span>
                        <span id="user-availability-status" style="display: none;color: red;">Oops! we can't find such a supplier,check the email again</span>
                        <span id="user-availability-status2" style="display: none;color: green;"><i class="fa fa-check"></i> </span>
                    </label>
                    <img src="<?=base_url()?>assets/images/ajax.gif" id="loaderIcon" style="display:none" />
                    <input  onblur="return checkSupplierAvailability()" type="email" class="form-control unicase-form-control text-input"
                            autocomplete="off" id="supplier-email" placeholder="">

                </div><div class="form-group col-md-12"></div>

                <div class="form-group col-md-12">
                    <label class="info-title" for="exampleInputName">Upload agreement/Contract form<span>*</span>

                        <span id="agreement2" style="display: none;color: red;">Oops! Please upload the agreement/Contract.</span>
                    </label>
                    <input type="file" class="form-control unicase-form-control contractUploadFile"
                           id="contractUploadFile" name="contractUploadFile"  placeholder="">

                </div><div class="form-group col-md-12"></div>

                <div class="form-group col-md-12">
                    <label class="info-title" for="exampleInputName">Enter Quote number<span>*</span>

                        <span id="quoteserror" style="display: none;color: red;">Oops! Please Enter the Quote number.</span>
                        <span id="quoteserror2" style="display: none;color: red;">Oops! Invalid Quote number.</span>
                    </label>
                    <input type="text" class="form-control unicase-form-control contractUploadFile"  onblur="return checkQouteAvailability(this.value)"
                           id="qoute_number" name="qoute_number"  placeholder="">

                </div><div class="form-group col-md-12"></div>

                <div class="form-group col-md-12">
                    <input type="hidden" class="form-control unicase-form-control contractUploadFile"
                           id="products-id" name="products-id"  placeholder="">
           <div id="produsts-data"></div>
                    </div>



                <div class="form-group col-md-6">
                    <label class="info-title" for="exampleInputName">Shipment Terms <span>*</span></label>
                    <input type="text" onblur="return checkFileuploaded()" class="form-control unicase-form-control text-input" name="shipping-address" placeholder="Address"><br>
                    <input type="text" onblur="return checkFileuploaded()" class="form-control unicase-form-control text-input" name="shipping-method" disabled placeholder="Shipping Method"><br>
                    <input type="text" onblur="return checkFileuploaded()" class="form-control unicase-form-control text-input" name="shipping-cost" disabled placeholder="Fee in ksh."><br>
                    <label class="info-title" onblur="return checkFileuploaded()">Shipment Date <span>*</span></label>
                    <input type="text" class="form-control datepicker" id="datePicker"  name="shipping-date" placeholder="Shipping Date"><br>
                </div><div class="form-group col-md-6"></div>

                <div class="form-group col-md-6">
                    <label class="info-title" for="exampleInputName">Payment Terms <span>*</span></label>
                    <input type="text" class="form-control unicase-form-control text-input " id="total-order-amount" placeholder="Total Order: ksh.0" disabled><br>
                    <input type="text" class="form-control unicase-form-control text-input"  onkeyup="return checkbalance(this.value)"
                           onblur="return checkbalance(this.value)" id="initial-payment" placeholder="Amount of Initial Payment" ><br>
                    <input type="text" class="form-control unicase-form-control text-input" id="agreed_balance"
                           placeholder="Amount of Balance: ksh.0"  disabled><br/>
                    We Support the following payment methods: <img src="<?=base_url()?>assets/images/payments/1.png" alt="">
                    | <img src="<?=base_url()?>assets/images/payments/3.png" alt=""> 
					| <img src="<?=base_url()?>assets/images/payments/4.png" alt=""> 


                </div><div class="form-group col-md-6"></div>
                <div class="form-group col-md-12">
                <div class="form-group"><br>
                    <label class="info-title" for="exampleInputName">Additional Remarks <span>*</span></label>
                    <textarea onblur="return checkFileuploaded()" class="form-control unicase-form-control" id="exampleInputComments"></textarea>
                </div>
           </div>

        </div>
    </div>
    <!-- panel-body  -->

</div>
