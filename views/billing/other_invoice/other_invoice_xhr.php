<?php
require '../../../bootstrap.php';


// Selected Product Quantity From Other Invoice
if (isset($_POST['getProductQuantity']) AND $_POST['getProductQuantity'] == 1){
    $prod_id = $_POST['prod_id'];
    echo $library->findField('tbl_product', 'pd_qty', "pd_id = {$prod_id}");
}





// Get Product List By selecting Category
if (isset($_POST['getProductByCategory']) AND $_POST['getProductByCategory'] == 1){
    $cat_id = $_POST['cat_id'];
    echo $library->createCombo("Product","tbl_product","pd_id","pd_name","Where cat_id='$cat_id' ORDER BY pd_name  ",'');
}





//Adding Other Invoice To DataBase
if (isset($_POST['otherInvoiceAdd']) AND $_POST['otherInvoiceAdd'] == 1){
    $billing->addOtherInvoice($_POST);
}



// Updating Other Inovice
if (isset($_POST['otherInvoiceEditID'])){
    $billing->updateOtherInvoice($_POST);
}
