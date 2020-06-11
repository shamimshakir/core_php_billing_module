<?php
$con=mysqli_connect('localhost','root','','nextadmin')
    or die("connection failed".mysqli_errno());
$request=$_REQUEST;
$col =array(
    0   =>  'invoice_number',
    1   =>  'invoice_date',
    2   =>  'client_id',
    3   =>  'vat',
    4   =>  'bill_amount',
    5   =>  'total_bill',
    6   =>  'collection_amnt'
);  //create column like table in database
$sql ="SELECT *  FROM mas_invoice";
$query = mysqli_query($con,$sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
//Search
$sql ="SELECT * FROM mas_invoice WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (invoiceobjet_id Like {$request['search']['value']}%";
    $sql.=" OR invoice_number Like {$request['search']['value']}%";
    $sql.=" OR salary Like {$request['search']['value']}%";
    $sql.=" OR age Like {$request['search']['value']}%)";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);
//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);
$data=array();
while($row=mysqli_fetch_assoc($query)){
    $subdata=array();
    $subdata['invoice_number']=$row['invoice_number'];
    $subdata['invoice_date']=$row['invoice_number'];
    $subdata['client_id']=$row['client_id'];
    $subdata['vat']=$row['vat'];
    $subdata['bill_amount']=$row['bill_amount'];
    $subdata['total_bill']=$row['total_bill'];
    $subdata['collection_amnt']=$row['collection_amnt'];
    $subdata['edit']= '<a href="views/billing/other_invoice/oth_invoice_entry_form.php" class="pageLoadBtn btn btn-primary btn-sm">
                        <i class="fa fa-pencil"></i></a>';

    $data[]=$subdata;
}
$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);
echo json_encode($json_data);
?>