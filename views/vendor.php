<?php
require '../bootstrap.php';
require '../stylesheet.php';
?>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="allClientsList">
            <div class="card">
                <div class="card-header">
                    <span>Vendor</span>
                    <a class="pageLoadBtn btn btn-primary btn-sm" href="views/add_vendor.php">
                        <i class="fa fa-plus"></i> Add Vendor
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supplier Name</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;

                            $vendors = $library->findAll('mas_supplier');

                            foreach($vendors as $vendor){
                                extract($vendor);

                                ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $clients_name;?></td>
                                    <td><?php echo $contract_person;?></td>
                                    <td><?php echo $phone;?></td>
                                    <td><?php echo $mobile1;?></td>
                                    <td><a href="views/add_vendor.php?id=<?php echo $id; ?>" id="clientEditBtn" class="pageLoadBtn btn btn-primary btn-sm">
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
