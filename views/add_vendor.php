
<?php

require '../bootstrap.php';

if (isset($_GET['id'])){

    $vendorID = $_GET['id'];

    $vendors = $library->findOneById('mas_supplier', 'id', $vendorID);

    if (isset($vendors)){

        extract($vendors);

    }

}

?>

<div class="row">

    <div class="col-lg-10 offset-lg-1">

        <div class="card">

            <div class="card-header">

                <?php if (isset($_GET['id'])){echo 'Edit Vendor'; }

                else{echo 'Add Vendor'; } ?>

                <a href="views/vendor.php" class="pageLoadBtn btn btn-primary btn-sm">Vendor List</a>

            </div>

            <div class="card-body">

                <div id="msgsuc"></div>

                <form class="inlineForm" id="vendorForm" action="" id="addVendorForm">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="clients_name">Supplier Name</label>
                                <input type="text" class="form-control input-sm" id="clients_name" name="clients_name" value="<?php if(isset($clients_name)) {echo $clients_name;}?>" placeholder="Supplier Name">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contract_person">Contact Person</label>
                                <input type="text" class="form-control input-sm" id="contract_person" name="contract_person" value="<?php if(isset($contract_person)) {echo $contract_person;}?>" placeholder="Contact Person">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="mobile1">Mobile</label>
                                <input type="text" class="form-control input-sm" name="mobile1" id="mobile1" value="<?php if(isset($mobile1)) {echo $mobile1;}?>" placeholder="01xxxxxxxxx">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control input-sm" name="phone" id="phone" value="<?php if(isset($phone)) {echo $phone;}?>" placeholder="01xxxxxxxxx">
                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control input-sm" name="email" id="email" value="<?php if(isset($email)) {echo $email;}?>" placeholder="abc@xyz.com">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="web_address">Web</label>
                                <input type="text" class="form-control input-sm" name="web_address" id="web_address" value="<?php if(isset($rowNewsTls)) {echo $web_address;}?>" >
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" class="form-control" name="address" id="address"><?php if (isset($address)){echo $address;} ?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cstatus">Status</label>
                                <select class="form-control input-sm" name="cstatus">
                                    <?php
                                    $library->createCombo("Status","tbl_project_status","project_statusid","project_statusdesc","ORDER BY project_statusdesc ",$cstatus);
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>


                    <?php if(isset($_GET['id'])): ?>

                        <input type="hidden" name="vendorEditId" value="<?= $_GET['id']; ?>">

                        <button type="button" onclick="vendorEdit()" class="btn btn-primary btn-sm mt-2">Update</button>

                    <?php else: ?>

                        <input type="hidden" name="vendorAdd" value="1">

                        <button type="button" onclick="addVendor()" class="btn btn-primary btn-sm mt-2">Submit</button>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </div>

</div>

<?php require '../scriptfiles.php';?>

<script>
    function addVendor() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#vendorForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }

    function vendorEdit() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#vendorForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }


</script>