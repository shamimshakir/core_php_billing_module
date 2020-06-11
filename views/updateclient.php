<?php
require '../bootstrap.php';
    $id = $_GET['id'];
    $cProfileInfos = $library->findOneById('clients_info', 'id', $id);
?>


<div class="card">
    <div class="card-header">
        Update Client Information
        <a class="pageLoadBtn btn btn-primary btn-sm" href="views/all_client.php">
            All Clients
        </a>
    </div>
    <div class="card-body">
        <div id="msgsuc"></div>
        <!-- MultiStep Form -->
        <form class="inlineForm" id="msform" enctype='multipart/form-data'>
            <!-- progressbar -->
            <ul id="progressbar">
                <li id="cBasicInfo" class="active">Basic Information</li>
                <li id="cServiceInfo">Service Information</li>
                <li id="cAccountInfo">Account Information</li>
                <li id="cPersonalInfo">Personal Information</li>
            </ul>


            <!-- Basic Information -->

            <fieldset>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="clients_name">Clients Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-sm" name="clients_name" id="clients_name"
                                   placeholder="Clients Name" value="<?= $cProfileInfos['clients_name'];?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ac_no">A/C No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-sm" name="ac_no" id="ac_no"
                                   placeholder="A/C No." value="<?= $cProfileInfos['ac_no'];?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="user_id">client ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-sm" name="user_id" id="user_id" value="<?= $cProfileInfos['user_id'];?>"
                                   placeholder="User ID">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-sm" name="password" id="password" value="<?= $cProfileInfos['password'];?>"
                                   placeholder="Password">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mobile1">Mobile1</label>
                            <input type="text" class="form-control input-sm" name="mobile1" id="mobile1"
                                   placeholder="01xxxxxxxxx" value="<?= $cProfileInfos['mobile1'];?>">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_status">Client Status <span class="text-danger">*</span></label>
                            <select name='client_status' id='client_status'>
                                <?php
                                $library->createCombo("Client Status", "tbl_status_type", "inv_id", "inv_name", "Order by inv_id", $cProfileInfos['client_status']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_type">Package <span class="text-danger">*</span></label>
                            <select name="client_type" id="client_type">
                                <?php
                                $library->createCombo("Package", "tbl_client_type", "id", "name", "Order by id", $cProfileInfos['client_type']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bandwidth">Bandwidth(K)</label>
                            <input type="text" class="form-control input-sm" name="bandwidth" id="bandwidth" value="<?= $cProfileInfos['bandwidth'];?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="rate_amnt" class="col-sm-5 control-label">Monthly Bill. <span
                                        class="color">*</span></label>
                            <input type="number" class="form-control input-sm" name="txtamnt" id="txtamnt"
                                   placeholder="Monthly Bill" value="<?= $cProfileInfos['rate_amnt'];?>">
                        </div>
                    </div>


                </div>
                <input type="button" name="next" class="next action-button btn btn-primary btn-sm" value="Next Step"/>
            </fieldset>

            <!-- Service INFORMATION  -->
            <fieldset>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_catagory">Client Type</label>
                            <select name="client_catagory" id="client_catagory">
                                <?php
                                $library->createCombo("Client Type", "tbl_client_catagory", "id", "name", " WHERE id != 3 Order by id", $cProfileInfos['clientTypeName']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="zone">Zone</label>
                            <select name="zone" id="zone">
                                <?php
                                $library->createCombo("Zone", "tbl_zone", "zone_id", "zone_name", "Order by zone_id", $cProfileInfos['zone']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bandwidth_plan">Connection Type</label>
                            <select name="bandwidth_plan" id="bandwidth_plan">
                                <?php
                                $library->createCombo("Client Type", "tbl_bandwidth_plan", "id", "bandwidth_plan", "Order by id", $cProfileInfos['bandwidth_plan']);
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="cable_type">Cable Type</label>
                            <select name="cable_type" id="cable_type">
                                <?php
                                $library->createCombo("Cable Type", "tbl_cable_type", "id", "cable_type", "Order by id", $cProfileInfos['cable_type']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="router">Router</label>
                            <select name="router" id="router">
                                <?php
                                $library->createCombo("Router", "tbl_router", "router_id", "router_name", "Order by router_id", $cProfileInfos['router']);
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="switch">Switch</label>
                            <select name="switch" id="switch">
                                <?php
                                $library->createCombo("Router", "tbl_switch", "switch_id", "switch_name", "Order by switch_id", $cProfileInfos['switch']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="switch_port">Switch Port</label>
                            <input type="text" class="form-control input-sm" name="switch_port" id="switch_port"
                                   value="<?= $cProfileInfos['switch_port']; ?>">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ip_number">IP Number</label>
                            <input type="text" class="form-control input-sm" name="ip_number" id="ip_number" value="<?= $cProfileInfos['ip_number']; ?>"
                                   placeholder="01xxxxxxxxx">
                        </div>
                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous  btn btn-primary btn-sm"
                       value="Previous"/>
                <input type="button" name="next" class="next action-button btn btn-primary btn-sm" value="Next Step"/>
            </fieldset>


            <fieldset>
                <h3 style="padding-left: 0px;" class="clientFormAreaTitle">Installation Charge</h3>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sales_price" class="col-sm-5 control-label">Sale Amount</label>
                            <input type="number" class="form-control input-sm" name="sales_price" id="sales_price"
                                   placeholder="Sale Amount" value="<?= $cProfileInfos['sales_price']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="paid_amount" class="col-sm-5 control-label">Paid Amount</label>
                            <input type="number" class="form-control input-sm" name="paid_amount" id="paid_amount"
                                   placeholder="Paid Amount" value="<?= $cProfileInfos['paid_amount']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mrn" class="col-sm-5 control-label">Money Receipt</label>
                            <input type="text" class="form-control input-sm" name="mrn" id="mrn" placeholder="Money Receipt" value="<?= $cProfileInfos['mrn']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="inst_date" class="col-sm-5 control-label">Inst. Date</label>
                            <input type="text" class="form-control datepicker input-sm" name="inst_date"
                                   id="inst_date" placeholder="dd/mm/yy" value="<?= $inst_date = date('Y-m-d', strtotime($cProfileInfos['inst_date'])); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ip_charge" class="col-sm-5 control-label">IP Charge</label>
                            <input type="text" class="form-control input-sm" name="ip_charge" id="ip_charge"
                                   placeholder="IP Charge" value="<?= $cProfileInfos['ip_charge']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ip_mr_number" class="col-sm-5 control-label">IP Money Receipt</label>
                            <input type="text" class="form-control input-sm" name="ip_mr_number" id="ip_mr_number"
                                   placeholder="IP Money Receipt" value="<?= $cProfileInfos['ip_mr_number']; ?>">
                        </div>
                    </div>

                </div>


                <input type="button" name="previous" class="previous action-button-previous  btn btn-primary btn-sm"
                       value="Previous"/>
                <input type="button" name="next" class="next action-button  btn btn-primary btn-sm" value="Next Step"/>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="father_husband_name">Father/Husband Name</label>
                            <input type="text" class="form-control input-sm" name="father_husband_name"
                                   id="father_husband_name" placeholder="Father/Husband Name" value="<?= $cProfileInfos['father_husband_name']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="text" class="form-control input-sm datepicker" name="date_of_birth" id="date_of_birth"
                                   placeholder="dd/mm/yy" value="<?= $date_of_birth = date('Y-m-d', strtotime($cProfileInfos['date_of_birth'])) ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="blood_group">Blood Group</label>
                            <select name='blood_group' id='blood_group'>
                                <?php $library->createCombo("Blood Group", "tbl_blood_group", "id", "blood_group", "Order by id", $cProfileInfos['blood_group']); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="gender">Gender</label>

                            <select name='gender' id='gender'>
                                <?php $library->createCombo("Gender", "tbl_gender", "id", "gender", "Order by id", $cProfileInfos['gender']); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control input-sm" name="occupation" id="occupation"
                                   placeholder="Occupation" value="<?= $cProfileInfos['occupation']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="fb_id">Facebook ID</label>
                            <input type="text" class="form-control input-sm" name="fb_id" id="fb_id"
                                   placeholder="Facebook ID" value="<?= $cProfileInfos['fb_id']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nid_number">NID Number</label>
                            <input type="text" class="form-control input-sm" name="nid_number" id="nid_number"
                                   placeholder="NID Number" value="<?= $cProfileInfos['nid_number']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="email" class="form-control input-sm" name="email" id="email"
                                   placeholder="Email" value="<?= $cProfileInfos['email']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control input-sm" name="phone" id="phone"
                                   placeholder="phone" value="<?= $cProfileInfos['phone']; ?>">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mobile2">Mobile2</label>
                            <input type="text" class="form-control input-sm" name="mobile2" id="mobile2"
                                   placeholder="01xxxxxxxxx" value="<?= $cProfileInfos['mobile2']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="vat_status">VAT Status</label>
                            <select name='vat_status' id='vat_status' disabled>
                                <?php
                                $library->createCombo("VAT Status", "tbl_vat_type", "status_id", "status_name", "Order by status_id", $cProfileInfos['clients_name']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="road_no">Road No#</label>
                            <input type="text" class="form-control input-sm" name="road_no" id="road_no"
                                   placeholder="Road No#" value="<?= $cProfileInfos['road_no']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="house_flat_no">House & Flat No.</label>
                            <input type="text" class="form-control input-sm" name="house_flat_no" id="house_flat_no"
                                   placeholder="House & Flat No." value="<?= $cProfileInfos['house_flat_no']; ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="area">Housing</label>
                            <select name='area' id='area'>
                                <?php
                                $library->createCombo("Housing/Area", "tbl_area", "area_id", "area_name", "Order by area_id", $cProfileInfos['area']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="thana">Thana</label>
                            <select name='thana' id='thana'>
                                <?php
                                $library->createCombo("Thana", "tbl_thana", "thana_id", "thana_name", "Order by thana_id", $cProfileInfos['thana']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="business_type">Business Type</label>
                            <select name='business_type' id='business_type'>
                                <?php
                                $library->createCombo("Business Type", "tbl_business_type", "bus_id", "bus_name", "Order by bus_id", $cProfileInfos['business_type']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea type="text" class="form-control " name='address' id='address'
                                      placeholder="Address"><?= $cProfileInfos['address']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="contract_person">Contract Person</label>
                            <input type="text" class="form-control input-sm" name='contract_person' id='contract_person'
                                   placeholder="Contract Person" value="<?= $cProfileInfos['contract_person']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea class="form-control " name="comments" id="comments" value=""
                                      placeholder="Comments"><?= $cProfileInfos['comments']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bill_type">Bill Type</label>
                            <select name='bill_type' id='bill_type' disabled>
                                <?php
                                $library->createCombo("Bill Type", "tbl_bill_type", "id", "name", "Order by id", $cProfileInfos['bill_type']);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">VAT Include</label>
                            <input style="float:left;" type="checkbox" name="vat" id="vat" value="1" checked>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group imgUploadArea">
                            <label>Client Image</label>
                            <input type="file" name="client_img" id="client_img" class="inputFile"/>
                            <div class="viewPrviousImg">
                                <img src="assets/images/<?= $cProfileInfos['client_img']; ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 imgUploadArea">
                        <div class="form-group">
                            <label>NID/Passport/DL/Others Image</label>
                            <input type="file" name="nid_img" id="nid_img" multiple=true>
                            <div class="viewPrviousImg">
                                <img src="assets/images/<?= $cProfileInfos['nid_img']; ?>" alt="">
                            </div>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="editClient" value="1">
                <input type="hidden" name="editClientID" value="<?= $id;?>>">
                <input type="button" name="previous" class="previous action-button-previous  btn btn-primary btn-sm"
                       value="Previous"/>
                <input type="submit" name="editClient" id="editClient" class="btn btn-success btn-sm" value="Confirm"/>
            </fieldset>
        </form>
    </div>
</div>



<?php
require '../scriptfiles.php';
?>
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 100
            });

        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 100
            });
        });

        $('.radio-group .radio').click(function() {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function() {
            return false;
        })




        $("#editClient").click(function(e){
            e.preventDefault();
            var data = new FormData(this.form);
            $.ajax({
                type:'POST',
                url:'clientActions.php',
                // data : $('#msform').serialize(),
                data: data,
                processData: false,
                contentType: false,
                success:function(response){
                    $('#msgsuc').css('opacity', 1);
                    $('#msgsuc').css('visibility', 'visible');
                    $('#msgsuc').html(response);
                    // console.log(response)
                }
            });
        });




        $("#client_type").on('change', function () {
            var clientType = $(this).val();
            if(clientType){
                $.ajax({
                    type:'POST',
                    url:'clientActions.php',
                    data: {
                        clientType: clientType,
                        getInfoOfClientType: 1
                    },
                    success:function(response){
                        var myString = response;
                        var arr = myString.split(',');
                        $('#bandwidth').val(arr[0]);
                        $('#txtamnt').val(arr[1]);
                        // console.log(response);
                    }
                });
            }
        });









    });


</script>
