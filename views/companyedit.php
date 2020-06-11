
<?php
    require '../bootstrap.php';
    $singlecompanyInfos = $company->selectCompanyById(1);
    extract($singlecompanyInfos);
?>

  <div class="card">
      <div class="card-header">
          Company Info Setup
      </div>
      <div class="card-body">
          <div id="msgsuc"></div>
          <form class="inlineForm" action="javascript:void(0);" id="companySetupForm">
              <div class="row">
                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="company_name">Name of ISP</label>
                          <input type="text" class="form-control input-sm" name="company_name" id="company_name" placeholder="Name of ISP"  value="<?php if(isset($company_name)) {echo $company_name;} ?>" required>
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="address">Address/NOC Address</label>
                          <input type="text" class="form-control input-sm" name="address" id="address" placeholder="Address" value="<?php if(isset($address)) {echo $address;} ?>"  >
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="phone">Phone</label>
                          <input type="text" class="form-control input-sm" name="phone" id="phone" placeholder="Phone"  value="<?php if(isset($phone)) {echo $phone;} ?>" >
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="phone_emergency">Contact Cell No</label>
                          <input type="text" class="form-control input-sm" name="phone_emergency" id="phone_emergency" placeholder="Contact Cell No" value="<?php if(isset($phone_emergency)) {echo $phone_emergency;} ?>" required maxlength="11" pattern="\d{1,11}">
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="fax">Fax</label>
                          <input type="text" class="form-control input-sm" name="fax" id="fax" placeholder="Fax"  value="<?php if(isset($fax)) {echo $fax;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="hst_no">VAT Reg.No</label>
                          <input type="text" class="form-control input-sm" name="hst_no" id="hst_no" placeholder="Hst no"  value="<?php if(isset($fax)) {echo $fax;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control input-sm" name="email" id="email" placeholder="Email" required value="<?php if(isset($email)) {echo $email;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4  col-md-6">
                      <div class="form-group">
                          <label for="account_email">Account Email</label>
                          <input type="text" class="form-control input-sm" name="account_email" id="account_email" placeholder="Account Email" required value="<?php if(isset($account_email)) {echo $account_email;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="state">District</label>
                          <input type="text" class="form-control input-sm" name="state" id="state" placeholder="State"  value="<?php if(isset($state)) {echo $state;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="postal_code">Postal Code</label>
                          <input type="text" class="form-control input-sm" name="postal_code" id="postal_code" placeholder="Postal Code"  value="<?php if(isset($postal_code)) {echo $postal_code;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" class="form-control input-sm" name="city" id="city" placeholder="City"  value="<?php if(isset($city)) {echo $city;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="country">Country</label>
                          <input type="text" class="form-control input-sm" name="country" id="country" placeholder="Country"  value="<?php if(isset($country)) {echo $country;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city">Type of ISP</label>
                          <input type="text" class="form-control input-sm" name="type_of_isp" id="type_of_isp" placeholder="Type of ISP"  value="<?php if(isset($type_of_isp)) {echo $type_of_isp;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city">Transmission Capacity (Core & MB)</label>
                          <input type="text" class="form-control input-sm" name="transmission_capacity" id="transmission_capacity" placeholder="Transmission Capacity (Core & MB)"  value="<?php if(isset($transmission_capacity)) {echo $transmission_capacity;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city">Date of License</label>
                          <input type="text" class="form-control input-sm datepicker" name="date_of_license" id="date_of_license" placeholder="Date of License"  value="<?php if(isset($date_of_license)) {echo $date_of_license = date('Y-m-d', strtotime($date_of_license));} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="country">Approved date of last renewal</label>
                          <input type="text" class="form-control input-sm datepicker" name="last_reenal_date" id="last_reenal_date" placeholder="Approved date of last renewal"  value="<?php if(isset($last_reenal_date)) {echo $last_reenal_date = date('Y-m-d', strtotime($last_reenal_date));} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city">License Validity Date</label>
                          <input type="text" class="form-control input-sm datepicker" name="license_validity_date" id="license_validity_date" placeholder="License Validity Date"  value="<?php if(isset($license_validity_date)) {echo $license_validity_date = date('Y-m-d', strtotime($license_validity_date));;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="date_of_launch" >Date Of Launch</label>
                          <input type="text" class="form-control input-sm datepicker" name="date_of_launch" id="date_of_launch" placeholder="Date Of Launch"  value="<?php if(isset($date_of_launch)) {echo $date_of_launch = date('Y-m-d', strtotime($date_of_launch));} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city">Parmitted Area/Thana(s)</label>
                          <input type="text" class="form-control input-sm" name="parmitted_area" id="parmitted_area" placeholder="Parmitted Area/Thana(s)"  value="<?php if(isset($parmitted_area)) {echo $parmitted_area;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="contact_name">Contact Person Name</label>
                          <input type="text" class="form-control input-sm" name="contact_name" id="contact_name" placeholder="Contact Person Name"  value="<?php if(isset($contact_name)) {echo $contact_name;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city" >NOC Location (Longitude & Lattitude)</label>
                          <input type="text" class="form-control input-sm" name="noc_location" id="noc_location" placeholder="NOC Location (Longitude & Lattitude) "  value="<?php if(isset($noc_location)) {echo $noc_location;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="pop_address">PoP Address</label>
                          <input type="text" class="form-control input-sm" name="pop_address" id="pop_address" placeholder="PoP Address"  value="<?php if(isset($pop_address)) {echo $pop_address;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city" >MRTG Link with ID & Password</label>
                          <input type="text" class="form-control input-sm" name="mrtg_id_pass" id="mrtg_id_pass" placeholder="MRTG Link with ID & Password"  value="<?php if(isset($mrtg_id_pass)) {echo $mrtg_id_pass;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="tranamission" >Tranamission(KM)</label>
                          <input type="text" class="form-control input-sm" name="tranamission" id="tranamission" placeholder="Tranamission"  value="<?php if(isset($tranamission)) {echo $tranamission;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="city" >a. Own</label>
                          <input type="text" class="form-control input-sm" name="own" id="own" placeholder="a. Own"  value="<?php if(isset($own)) {echo $own;} ?>">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                          <label for="leased">b. Leased</label>
                          <input type="text" class="form-control input-sm" name="leased" id="leased" placeholder="Leased"  value="<?php if(isset($leased)) {echo $leased;} ?>">
                      </div>
                  </div>

              </div>
              <div class="row mt-2">
                  <input type="hidden" name="companyEdit" value="1">
                  <div class="col-lg-2">
                      <button type="submit" class="btn btn-primary btn-block btn-sm" name="updateCompany">Update</button>
                  </div>
              </div>

          </form>
      </div>
  </div>


<?php require '../scriptfiles.php'; ?>

  <script>
    $("#companySetupForm").submit(function(){
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $(this).serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    });
  </script>