
<?php
require '../bootstrap.php';

if (isset($_GET['id'])){

    $employeeID = $_GET['id'];

    $employees = $library->findOneById('mas_employees', 'emp_id', $employeeID);

    if (isset($employees)){

        extract($employees);

    }

}
?>

<div class="row">

    <div class="col-lg-10 offset-lg-1">

        <div class="card">

            <div class="card-header">

                <?php if (isset($_GET['id'])){echo 'Edit Employee'; }

                else{echo 'Add Employee'; } ?>

                <a href="views/employee.php" class="pageLoadBtn btn btn-primary btn-sm">Employees</a>

            </div>

            <div class="card-body">

                <div id="msgsuc"></div>

                <form class="inlineForm" id="EmployeeForm" action="">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="emp_name">Employee Name</label>
                                <input type="text" class="form-control input-sm" id="emp_name" name="emp_name" value="<?php if (isset($emp_name)){echo $emp_name;} ?>" placeholder="Name">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth </label>
                                <input type="text" class="form-control input-sm datepicker" name="date_of_birth" value="<?php if (isset($date_of_birth)){echo $date_of_birth;} ?>" id="date_of_birth" placeholder="dd/mm/yy">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date_of_joing">Date of Joining </label>
                                <input type="text" class="form-control input-sm datepicker" id="jdate" name="date_of_joing" value="<?php if (isset($date_of_joing)){echo $date_of_joing;} ?>" placeholder="dd/mm/yy">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control input-sm" name="mobile" id="mobile" value="<?php if (isset($mobile)){echo $mobile;} ?>" placeholder="01xxxxxxxxx">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select  name="designation" id="designation">
                                    <?php
                                    $library->createCombo("Designation","mas_designation","desig_id","designation","order by desig_id",$designation);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select  name="department" id="department">
                                    <?php
                                    $library->createCombo("Department","mas_department","depart_id","department","order by depart_id", $department);
                                    ?>
                                </select>
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
                                <label for="email">Email</label>
                                <input type="text" class="form-control input-sm" name="email" id="email" value="<?php if (isset($email)){echo $email;} ?>" placeholder="abc@xyz.com">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select  name="status" id="status">
                                    <?php
                                    $library->createCombo("Status","employee_status","id","name","order by id", $status);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="payment_mode">Payment Mode</label>
                                <select name="payment_mode" id="payment_mode">
                                    <?php
                                    $library->createCombo("Payment Mode","emp_payment_mode","id","name","order by id",$payment_mode);
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="bank_id">Bank</label>
                                <select name="bank_id" id="bank_id" disabled>
                                    <?php
                                    $library->createCombo("Bank","mas_bank","bank_id","bank_name","order by bank_id",$bank_id);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="acc_no">Account No.</label>
                                <input type="text" class="form-control input-sm" name="acc_no" id="acc_no" value="<?php if (isset($acc_no)){echo $acc_no;} ?>" placeholder="Account No." disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="shift_id">Shift</label>
                                <select name="shift_id" id="shift_id" >
                                    <?php
                                        if (isset($_GET['id'])){
                                            $library->createCombo("Shift","tbl_schedule","sch_id","sch_name","order by sch_id","");
                                        }else{
                                            $library->createCombo("Shift","tbl_schedule","sch_id","sch_name","order by sch_id",1);
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>


                    </div>



                    <?php if(isset($_GET['id'])): ?>

                        <input type="hidden" name="employeeEditId" value="<?= $_GET['id']; ?>">

                        <button type="button" onclick="employeeEdit()" class="btn btn-primary btn-sm mt-2">Update</button>

                    <?php else: ?>

                        <input type="hidden" name="employeeAdd" value="1">

                        <button type="button" onclick="addEmployee()" class="btn btn-primary btn-sm mt-2">Submit</button>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </div>

</div>

<?php require '../scriptfiles.php';?>

<script>
    function addEmployee() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#EmployeeForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }

    function employeeEdit() {
        $.ajax({
            url:"clientActions.php",
            type: "POST",
            data: $('#EmployeeForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }

    $(document).ready(function () {

        $("#payment_mode").change(function () {

            var payment = $('#payment_mode').val();
            //alert(a);
            if(payment == 1) {
                $("#bank_id").prop('disabled', false);
                $("#acc_no").prop('disabled', false);
            }else {
                $("#bank_id").prop('disabled', true);
                $("#acc_no").prop('disabled', true);
            }

        })

    });

</script>