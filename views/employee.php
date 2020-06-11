<?php
require '../bootstrap.php';
require '../stylesheet.php';
?>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="allClientsList">
            <div class="card">
                <div class="card-header">
                    <span>Employee</span>
                    <a class="pageLoadBtn btn btn-primary btn-sm" href="views/addemployeeform.php">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Birth Date</th>
                                <th>Joining Date</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;

                            $employees = $company->getEmployees();

                            foreach($employees as $employee){
                                ?>
                                <tr>
                                    <td><?php echo $employee['emp_id']; ?></td>
                                    <td><?php echo $employee['emp_name']; ?></td>
                                    <td><?php echo $employee['date_of_birth']; ?></td>
                                    <td><?php echo $employee['date_of_joing']; ?></td>
                                    <td><?php echo $employee['department']; ?></td>
                                    <td><?php echo $employee['designation']; ?></td>
                                    <td><?php echo $employee['mobile']; ?></td>
                                    <td><?php echo $employee['email']; ?></td>
                                    <td><a href="views/addemployeeform.php?id=<?php echo $employee['emp_id']; ?>" id="clientEditBtn" class="pageLoadBtn btn btn-primary btn-sm">
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
