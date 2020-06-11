<?php
require '../../../bootstrap.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

## Search
 $searchQuery = " ";
 if($searchValue != ''){
    $searchQuery = " AND (emp_name LIKE :emp_name or 
         email LIKE :email OR 
         city LIKE :city ) ";
    $searchArray = array(
         'emp_name'=>"%$searchValue%",
         'email'=>"%$searchValue%",
         'city'=>"%$searchValue%"
    );
 }

## Total number of records without filtering
$totalRecords = $library->getRowCount('mas_supplier');

## Total number of records with filtering
 $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM employee WHERE 1 ".$searchQuery);
 $stmt->execute($searchArray);
 $records = $stmt->fetch();
 $totalRecordwithFilter = $records['allcount'];

## Fetch records
## Fetch records
$allRecords = $library->paginationSelect($table, $columnName, $columnSortOrder, $row, $rowperpage);

$data = array();

foreach($allRecords as $row){
   $data[] = array(
      "invoice_number"=>$row['invoice_number'],
      "invoice_date"=>$row['invoice_date'],
      "client_id"=>$row['client_id'],
      "vat"=>$row['vat'],
      "bill_amount"=>$row['bill_amount'],
      "total_bill"=>$row['total_bill'],
      "collection_amnt"=>$row['collection_amnt']
   );
}

## Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);