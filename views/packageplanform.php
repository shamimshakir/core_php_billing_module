
<?php
    require '../bootstrap.php';

    if (isset($_GET['id'])){

        $editPackageId = $_GET['id'];

        $sPackagePlan = $library->findOneById('tbl_client_type', 'id', $editPackageId);

        if (isset($sPackagePlan)){

            extract($sPackagePlan);

        }

    }
?>

<div class="row">

    <div class="col-lg-6 offset-lg-3">

        <div class="card">

            <div class="card-header">

                <?php if (isset($_GET['id'])){echo 'Edit Package Plan'; }

                else{echo 'Add Package Plan'; } ?>

                <a href="views/rateplan.php" class="pageLoadBtn btn btn-primary btn-sm">Package Plan</a>

            </div>

            <div class="card-body">

                <div id="msgsuc"></div>

                <form class="blockForm" id="blockForm" action="" id="addPackagePlanForm">

                    <div class="form-group">
                        <label for="name">Package Name </label>
                        <input type="text" class="form-control input-sm" name="name" id="name" value="<?php if (isset($name)){echo $name;} ?>" placeholder="Package Name">
                    </div>

                    <div class="form-group">
                        <label for="unit">Package bandmidth <span class="block">(512k/512k or 4M/4M) Default/Day</span></label>
                        <input type="text" class="form-control input-sm" name="unit" id="unit" value="<?php if (isset($unit)){echo $unit;} ?>">
                    </div>

                    <div class="form-group">
                        <label for="night_unit">Package bandmidth <span class="block">(512k/512k or 4M/4M) Night</span></label>
                        <input type="text" class="form-control input-sm" name="night_unit" id="night_unit" value="<?php if (isset($night_unit)){echo $night_unit;} ?>">
                    </div>

                    <div class="row mb-1">

                        <div class="col-lg-6">
                            <label style="font-weight: bold;">
                                <input type="checkbox" name="pcq" value="1" <?php if(isset($pcq) AND $pcq==1){echo 'checked';}?>> Disable Rate Limit In Radius
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label style="font-weight: bold;">
                                <input type="checkbox" name="hotspot" value="1" <?php if(isset($hotspot) AND $hotspot==1){echo 'checked';}?>> Hotspot
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price">Package price</label>
                        <input type="text" class="form-control input-sm" name="price" id="price" placeholder="Package price" value="<?php if (isset($price)){echo $price;} ?>">
                    </div>


                    <?php if(isset($_GET['id'])): ?>

                    <input type="hidden" name="packagePlanEditId" value="<?= $_GET['id']; ?>">

                    <button type="button" onclick="editPackagePlan()" class="btn btn-primary btn-sm mt-2">Update</button>

                    <?php else: ?>

                    <input type="hidden" name="packagePlanAdd" value="1">

                    <button type="button" onclick="addPackagePlan()" class="btn btn-primary btn-sm mt-2">Submit</button>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
    require '../scriptfiles.php';
?>

<script>
    function addPackagePlan() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#blockForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }

    function editPackagePlan() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#blockForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }

</script>