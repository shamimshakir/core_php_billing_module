<?php
    require '../bootstrap.php';
    require '../stylesheet.php';
?>

<div class="allClientsList">
    <div class="card">
        <div class="card-header">
            <span>Client List</span>
            <a class="pageLoadBtn btn btn-primary btn-sm" href="views/add_client.php">
                <i class="fa fa-plus"></i> Add Client
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

            <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>User Id</th>
                        <th>Client Name</th>
                        <th>Mobile</th>
                        <th>Package</th>
                        <th>Client Status</th>
                        <th>Inst. Date</th>
                        <th>Bill Start Date</th>
                        <th>Client Type</th>
                        <th>Bill Type</th>
                        <th>Action</th>
                    </tr> 
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    $allClients = $company->getAllClients();
                    foreach($allClients as $clients){  
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $clients['user_id']; ?></td>
                        <td><?php echo $clients['clients_name']; ?></td>
                        <td><?php echo $clients['mobile1']; ?></td>
                        <td><?php echo $clients['package']; ?></td>
                        <td><?php if($clients['cstatus'] != 0) : ?>
                                <span class="badge badge-success">Active</span>
                            <?php else: ?>
                            <span class="badge badge-secondary">InActive</span>
                        <?php endif;?></td>
                        <td><?php echo $clients['instDate']; ?></td>
                        <td><?php echo $clients['billStartDate']; ?></td>
                        <td><?php echo $clients['clientTypeName']; ?></td>
                        <td><?php echo $clients['billTypeName']; ?></td>
                        <td>
                            <a href="views/updateclient.php?id=<?php echo $clients['id']; ?>" id="clientEditBtn" class="pageLoadBtn btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                            <a href="views/clientViewDetail.php?id=<?php echo $clients['id']; ?>" id="clientViewDetail" class="pageLoadBtn btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>

<?php
    require '../scriptfiles.php';
?>
