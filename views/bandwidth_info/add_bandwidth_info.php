
<?php
require '../../bootstrap.php';

if (isset($_GET['id'])){

    $bandwidthInfoId = $_GET['id'];

    $bandwidthInfos = $library->findOneById('tbl_bandwidth_info', 'id', $bandwidthInfoId);

    if (isset($bandwidthInfos)){

        extract($bandwidthInfos);

    }

}
?>

<div class="row">

    <div class="col-lg-6 offset-lg-3">

        <div class="card">

            <div class="card-header">

                <?php if (isset($_GET['id'])){echo 'Edit Bandwidth Info'; }

                else{echo 'Add Bandwidth Info'; } ?>

                <a href="views/bandwidth_info/bandwidth_info_grid.php" class="pageLoadBtn btn btn-primary btn-sm">Bandwidth Info List</a>

            </div>

            <div class="card-body">

                <div id="msgsuc"></div>

                <form class="blockForm" id="bandwidthForm">

                    <div class="form-group">
                        <label for="thana_name">Name of Bandwidth Provider(s) <br>
                            <sup>(Bandwidth Buying from which ISP) </label>
                        <input type="text" class="form-control input-sm" name="name" id="name" value="<?php if(isset($name)) {echo $name;}?>" placeholder="Name of Bandwidth Provider(s)">
                    </div>

                    <div class="form-group">
                        <label for="thana_name">For month  </label>
                        <input type="text" class="form-control input-sm datepicker" name="month" id="month" value="<?php if(isset($month)) {echo $month = date('M', strtotime($month));}?>" placeholder="Month">
                    </div>

                    <div class="form-group">
                        <label for="connected_date">Connected Date</label>
                        <input type="text" class="form-control input-sm datepicker1" name="connected_date" id="connected_date" value="<?php if(isset($connected_date)) {echo $connected_date;}?>" placeholder="Connected Date">
                    </div>

                    <div class="form-group">
                        <label for="connected_date">Bandwidth</label>
                        <input type="text" class="form-control input-sm" name="bandwidth" id="bandwidth" value="<?php if(isset($bandwidth)) {echo $bandwidth;}?>" placeholder="Bandwidth">
                    </div>

                    <?php if(isset($_GET['id'])): ?>

                        <input type="hidden" name="editBandwidthInfoId" value="<?= $_GET['id']; ?>">

                        <button type="button" onclick="editBandwidthInfo()" class="btn btn-primary btn-sm mt-2">Update</button>

                    <?php else: ?>

                        <input type="hidden" name="BandwidthInfoAdd" value="1">

                        <button type="button" onclick="addBandwidthInfo()" class="btn btn-primary btn-sm mt-2">Submit</button>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
require '../../scriptfiles.php';
?>

<script>
    function addBandwidthInfo() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#bandwidthForm').serialize(),
            success:function (response) {
                //console.log(response);
                $('#msgsuc').css('display', 'inline-block');
                $('#msgsuc').html(response);
            }
        });
    }

    function editBandwidthInfo() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#bandwidthForm').serialize(),
            success:function (response) {
                console.log(response);
                $('#msgsuc').css('display', 'inline-block');
                $('#msgsuc').html(response);
            }
        });
    }

</script>