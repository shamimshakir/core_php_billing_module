
<?php
require '../../../bootstrap.php';
?>

<div class="dailycollectionsheet">
    <div class="card">
        <div class="card-header">
            <span>Daily Collection Sheet</span>
        </div>
        <div class="card-body">
            <div class="dailyCollectionReportForm">
                <form action="" id="dailyCollectionReportForm" class="inlineForm">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Select a Date</label>
                                    <div class="row">
                                    <div class="col-lg-4 pr-0">
                                        <select name="cbotDay" class='form-control'>
                                            <?php $library->comboDay(date('d')); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 pr-0">
                                        <select name="cbotMonth" class='form-control'>
                                            <?php $library->comboMonth(date('m')); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 pr-0">
                                        <select name="cbotYear" class='form-control'>
                                            <?php
                                            $Y=date('Y');
                                            $PY=$Y-10;
                                            $NY=$Y+10;
                                            $library->comboYear($PY,$NY,$Y); ?>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 pr-0">
                                        <label for="">Collector: </label>
                                        <?php
//                                        if($SType==1){
                                            echo "<select name='cbocustomer'  class='form-control'>";
                                            $library->createCombo("Collector","_nisl_mas_member","User_ID","User_Name","order by User_Name","");
                                            echo "</select>";
//                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-4 pr-0">
                                        <label for="">Client Type</label>
                                        <select name="client_catagory" id="client_catagory" class='form-control'>
                                            <?php
                                            $library->createCombo("Client Type","tbl_client_catagory","id","name","Order by name", "");
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 pr-0">
                                        <label for="">Zone</label>
                                        <select id="zone" name="zone" class='form-control'>
                                            <?php  $library->createCombo("Zone","tbl_zone","zone_id","zone_name","order by zone_name",'');?>
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 pr-0">
                            <label for="">Profile</label>
                            <select id="area" name="area" class='form-control'>
                                <?php  $library->createCombo("Zone","tbl_area","area_id","area_name","order by area_name",'');?>
                            </select>
                        </div>
                        <div class="col-lg-2 mt-2">
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Show Report</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="dailyCollectionReportView">

            </div>
        </div>
    </div>
</div>