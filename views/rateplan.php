<?php
require '../bootstrap.php';
require '../stylesheet.php';
?>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="allClientsList">
            <div class="card">
                <div class="card-header">
                    <span>Package Plan</span>
                    <a class="pageLoadBtn btn btn-primary btn-sm" href="views/packageplanform.php">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Package Name</th>
                                <th>Package Bandwidth (K)</th>
                                <th>Package Price</th>
                                <th>Provider Bill (Amount)</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;

                            $reseller_id = Session::get('reseller_id');
                            $packagePlans = $library->findAllById('tbl_client_type', 'reseller_id', -1);

                            foreach($packagePlans as $pPlan){
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $pPlan['name']; ?></td>
                                    <td><?php echo $pPlan['unit']; ?></td>
                                    <td><?php echo $pPlan['price']; ?></td>
                                    <td><?php echo $pPlan['share_rate']; ?></td>
                                    <td><a href="views/packageplanform.php?id=<?php echo $pPlan['id']; ?>" id="clientEditBtn" class="pageLoadBtn btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../scriptfiles.php';
?>
