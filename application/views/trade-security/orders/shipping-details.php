<div id="collapseThree" class="panel-collapse collapse">
    <div class="panel-body">
        <div class="row edit-margin">

                      <div class="col-sm-6" >
                          <input type="radio" id="blazebay" class="modeofshipping" onchange="return setmethod('blazebay')"
                                 value="blazebay" name="method" checked> <label class="control-label" for="recipient-name"> &nbsp;<b> Use Blazebay couriers</b><font color="#FF0000">*</font> </label>
                   </div>
                <div class="col-sm-6" ><input type="radio" id="self" class="modeofshipping"   onchange="return setmethod('self')"
             value="self" name="method" ><label class="control-label" for="recipient-name">&nbsp;<b> I will pick the order myself from Supplier</b> <font color="#FF0000">*</font> </label>
                      </div>

            </div>
        <br><br>
        <div id="blazebay-means">
        <div class="row edit-margin">

            <div class="col-sm-6" >
                Select means of Shipment
                <select name="country" class="form-control" id="shipping-mode" >
                    <option value="land" >By Land</option>
                    <option value="air" >By Air </option>
                    <option value="sea" >By Sea</option>
                    </select>

            </div>
            <div class="col-sm-6" > <div id="shipings-msg-dialog"></div></div>
        </div>

        <div class="row">
            <br>
        <div class="form-group col-md-4">
            <label for="country" class="form-label">Country</label>
            <select name="country" class="form-control" id="country" >
                <option value="" ><?php echo 'Please select State'; ?> </option>
                <?php
                $cD= $this->Site_model->gettableData( 'bt_countries');
                foreach ($cD as $countries) {
                    $country_id = $countries['country_id'];

                    $country_name=$countries['country_name'];
                    if($country_id==$memD['country']){
                        ?>

                        <option value="<?php echo $country_id; ?>" selected><?php echo $country_name; ?> </option>

                    <?php
                    }else{ ?>
                        <option value="<?php echo $country_id; ?>" ><?php echo $country_name; ?> </option>

                    <?php
                    }
                }

                ?>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="state" class="form-label">State</label>
            <select name="state" class="form-control" id="state" >
                <option value="" ><?php echo 'Please select State'; ?> </option>
                <?php
                $country=$memD['country'];
                $where="country_id='".$country."' ORDER BY  state_name ASC";
                $stateData= $this->Site_model->getDataById( 'bt_states',$where);
                foreach ($stateData as $statesinfo) {
                    $state_id = $statesinfo['state_id'];

                    $state_name=$statesinfo['state_name'];
                    if($state_id==$memD['state']){
                        ?>

                        <option value="<?php echo $state_id; ?>" selected><?php echo $state_name; ?> </option>

                    <?php
                    }else{ ?>
                        <option value="<?php echo $state_id; ?>" ><?php echo $state_name; ?> </option>

                    <?php
                    }
                }

                ?>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="city" class="form-label">City</label>
            <select name="city" class="form-control" id="city" >
                <option value="" ><?php echo 'Please select your city'; ?> </option>
                <?php
                $state_id=$memD['state'];
                $where="state_id='".$state_id."'  ORDER BY  city_name ASC";
                $stateData= $this->Site_model->getDataById( 'bt_cities',$where);
                foreach ($stateData as $cityinfo) {
                    $city_id = $cityinfo['city_id'];

                    $city_name=$cityinfo['city_name'];
                    if($city_id==$memD['city']){
                        ?>

                        <option value="<?php echo $city_id; ?>" selected><?php echo $city_name; ?> </option>

                    <?php
                    }else{ ?>
                        <option value="<?php echo $city_name; ?>" ><?php echo $city_name; ?> </option>

                    <?php
                    }
                }

                ?>

            </select>

        </div>

        <div class="col-md-12 ">
            <form class="register-form" role="form">
                <div class="form-group">
                    <label class="info-title" for="exampleInputName">Shipping Address <span>*</span></label>
                    <textarea class="form-control unicase-form-control" id="exampleInputComments"><?php echo $memD[0]['street'];?></textarea>
                </div>
            </form>
        </div>
        </div>
      </div>


    </div>
</div>
