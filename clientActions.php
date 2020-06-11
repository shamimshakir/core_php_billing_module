<?php
require 'bootstrap.php';

    // Adding New Client Info
if(isset($_POST['addClient']) AND $_POST['addClient']  == 1){

    $company->saveNewClient($_POST);

}




    //Edit Client Info
if(isset($_POST['editClient']) AND $_POST['editClient']  == 1){

    $company->updateClient($_POST);

}




    //Select/Find Client Type/Package By ID
if(isset($_POST['clientType']) AND $_POST['getInfoOfClientType'] == 1){

    $getClientInfo = $library->findOneById('tbl_client_type', 'id', $_POST['clientType']);

    extract($getClientInfo);

    print($unit.','.$price);

}





    //Edit Company Information
if(isset($_POST['companyEdit']) AND $_POST['companyEdit'] == 1){

    $company->updateCompany($_POST);

}





    //Adding Package Plan
if (isset($_POST['packagePlanAdd']) AND $_POST['packagePlanAdd'] == 1){

    $data = [

        'name' => $_POST['name'],

        'unit' => $_POST['unit'],

        'night_unit' => $_POST['night_unit'],

        'price' => $_POST['price'],

        'reseller_id' => $_POST['reseller_id']

    ];

    $library->save('tbl_client_type', $data);

}






    //Edit Package Plan
if(isset($_POST['packagePlanEditId'])){


    $data = [

        'name' => $_POST['name'],

        'unit' => $_POST['unit'],

        'night_unit' => $_POST['night_unit'],

        'price' => $_POST['price'],

        'pcq' => $_POST['pcq'],

        'hotspot' => $_POST['hotspot']

    ];

    $cond = [
        'id' => $_POST['packagePlanEditId']
    ];

    $library->update('tbl_client_type', $data, $cond);

}



    //Add Employee
if (isset($_POST['employeeAdd']) AND $_POST['employeeAdd'] == 1){

    if (isset($_POST['bank_id'])){
        $bankID = $_POST['bank_id'];
    }else{
        $bankID = '';
    }

    if (isset($_POST['acc_no'])){
        $accNo = $_POST['acc_no'];
    }else{
        $accNo = '';
    }

    $data = [

        'emp_name' => $_POST['txtemp_name'],

        'date_of_birth' => $_POST['txtdate_of_birth'],

        'date_of_joing' => $_POST['txtdate_of_joing'],

        'mobile' => $_POST['txtmobile'],

        'designation' => $_POST['txtdesignation'],

        'department' => $_POST['txtdepartment'],

        'address' => $_POST['txtaddress'],

        'email' => $_POST['txtemail'],

        'status' => $_POST['status'],

        'payment_mode' => $_POST['payment_mode'],

        'bank_id' => $bankID,

        'acc_no' => $accNo,

        'shift_id' => $_POST['shift_id']

    ];

    $library->save('mas_employees', $data);
}



if (isset($_POST['employeeEditId'])){

    if (isset($_POST['bank_id'])){
        $bankID = $_POST['bank_id'];
    }else{
        $bankID = '';
    }

    if (isset($_POST['acc_no'])){
        $accNo = $_POST['acc_no'];
    }else{
        $accNo = '';
    }

    $data = [

        'emp_name' => $_POST['emp_name'],

        'date_of_birth' => $_POST['date_of_birth'],

        'date_of_joing' => $_POST['date_of_joing'],

        'mobile' => $_POST['mobile'],

        'designation' => $_POST['designation'],

        'department' => $_POST['department'],

        'address' => $_POST['address'],

        'email' => $_POST['email'],

        'status' => $_POST['status'],

        'payment_mode' => $_POST['payment_mode'],

        'bank_id' => $bankID,

        'acc_no' => $accNo,

        'shift_id' => $_POST['shift_id']

    ];

    $cond = [
        'emp_id' => $_POST['employeeEditId']
    ];

    $library->update('mas_employees', $data, $cond);
}




//Adding Vendor
if (isset($_POST['vendorAdd']) AND $_POST['vendorAdd'] == 1){

    $data = [

        'clients_name' => $_POST['clients_name'],

        'contract_person' => $_POST['contract_person'],

        'mobile1' => $_POST['mobile1'],

        'phone' => $_POST['phone'],

        'email' => $_POST['email'],

        'web_address' => $_POST['web_address'],

        'address' => $_POST['address'],

        'cstatus' => $_POST['cstatus'],

    ];

    $library->save('mas_supplier', $data);

}



//Updating Vendor
if (isset($_POST['vendorEditId'])){

    $data = [

        'clients_name' => $_POST['clients_name'],

        'contract_person' => $_POST['contract_person'],

        'mobile1' => $_POST['mobile1'],

        'phone' => $_POST['phone'],

        'email' => $_POST['email'],

        'web_address' => $_POST['web_address'],

        'address' => $_POST['address'],

        'cstatus' => $_POST['cstatus'],

    ];

    $cond = [
        'id' => $_POST['vendorEditId']
    ];

    $library->update('mas_supplier', $data, $cond);

}







//Adding Bandwidth Info
if (isset($_POST['BandwidthInfoAdd']) AND $_POST['BandwidthInfoAdd'] == 1){

    $data = [

        'name' => $_POST['name'],

        'month' => $_POST['month'],

        'connected_date' => $_POST['connected_date'],

        'bandwidth' => $_POST['bandwidth']

    ];

    $library->save('tbl_bandwidth_info', $data);

}



//Updating Bandwidth Info
if (isset($_POST['editBandwidthInfoId'])){


    $data = [

        'name' => $_POST['name'],

        'month' => $_POST['month'],

        'connected_date' => $_POST['connected_date'],

        'bandwidth' => $_POST['bandwidth']

    ];

    $cond = [
      'id' => $_POST['editBandwidthInfoId']
    ];

    $library->update('tbl_bandwidth_info', $data, $cond);

}