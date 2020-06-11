<?php
require '../../../bootstrap.php';
require '../../../stylesheet.php';

?>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="userPermissions">
            <div class="card">
                <div class="card-header">
                    <span>Profile Permission</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="pagiTableView">

                        <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>#Sl</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Company Name</th>
                                <th >Permission</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $users = $library->findAll('_nisl_mas_user');
                            $i = 1;
                            foreach ($users as $user):?>
                                <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $user['Name'];?></td>
                                    <td><?php echo $library->findField('mas_designation', 'designation', "desig_id = {$user['Designation']}")?></td>
                                    <td><?= $user['CompanyName'];?></td>
                                    <td><a href="views/siteAdmin/userPermission/givePermission.php?id=<?= $user['User_ID']; ?>" class="pageLoadBtn btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i> <span>Permission</span></a></td>
                                </tr>
                            <?php  endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../../../scriptfiles.php';
?>

<script>
    $(document).ready(function(){

        $('#dataTable').DataTable();

    });
</script>