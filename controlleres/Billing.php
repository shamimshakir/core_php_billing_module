<?php


class Billing
{

    public $pdo;
    public $library;


    public function __construct($pdo){

        $this->pdo = $pdo;

        $this->library = new Library($this->pdo);
    }

    // Add Other Invoice
    public function addOtherInvoice($data){

        $sUserId = Session::get('SUserID');

        $invoice_number = $this->library->findField('mas_invoice', 'MAX(invoice_number)', '') + 1;

        try{

            $this->pdo->beginTransaction();

            $sql = "INSERT INTO
                mas_invoice(
                    invoice_date,
                    client_id,
                    invoice_number,
                    bill_number,
                    remarks,
                    bill_amount,
                    vat,
                    total_bill,
                    discount_amnt,
                    vatper,
                    next_inv_date,
                    work_order,
                    work_order_date,
                    entry_by,
                    entry_date) 
                values(
                    '$data[txtinvoice_date]',
                    '$data[txtclient_id]',
                    '$invoice_number',
                    '',
                    '',
                    '$data[totcost1]',
                    '$data[vat1]',
                    '$data[gtot]',
                    '$data[discount]',
                    '$data[vatper]',
                    '$data[txtwork_order]',
                    '$data[txtwork_order]',
                    '$data[txtwork_order_date]',
                    '$sUserId',
                    DATE(now())
                )";

            $statement = $this->pdo->prepare($sql);

            $res = $statement->execute();

            $masInvoiceColumnID = $this->pdo->lastInsertId();


            $id = $data['id'];

            $txtcat_id = $data['txtcat_id'];

            $txtprod_id = $data['txtprod_id'];

            $loc = $data['loc'];

            $pwv = $data['pwv'];

            $sd = $data['sd'];

            $qty = $data['qty'];

            $unt = $data['unt'];

            $vat = $data['vat'];

            foreach($id as $a => $v){

                $purchase_rate = $this->library->findField("tbl_product","pd_price","pd_id = {$txtprod_id[$a]}");

                $sql = "INSERT INTO trn_invoice_detail(
                    invoiceobject_id,
                    sl_no,
                    cat_id,
                    prod_id,
                    prod_description,
                    location,
                    rate,
                    qty,
                    unit,
                    total,
                    purchase_rate,
                    entry_by,
                    entry_date)
                 VALUES(
                    '$masInvoiceColumnID',
                    '$id[$a]',
                    '$txtcat_id[$a]',
                    '$txtprod_id[$a]',
                    '$sd[$a]',
                    '$loc[$a]',
                    '$pwv[$a]',
                    '$qty[$a]',
                    '$unt[$a]',
                    '$vat[$a]',
                    '$purchase_rate',
                    '$sUserId',
                    DATE(now())
                )";

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                    // Update Table Product
                    $p_id='';

                    $qty1='';

                    $pd_qty='';

                    $item_type='';

                    $p_id = $txtprod_id[$a];

                    $qty1 = $qty[$a];

                    $pd_qty = $this->library->findField("tbl_product","pd_qty","pd_id = {$p_id}");

                    $item_type = $this->library->findField("tbl_product","item_type","pd_id = {$p_id}");

                    if ($item_type == 2) {

                        $n_qty = $pd_qty - $qty1;

                        $query ="UPDATE tbl_product SET pd_qty = '$n_qty' WHERE pd_id = '$p_id'";

                        $statement = $this->pdo->prepare($query);

                        $statement->execute();

                    }

            }

            $ThikThak = $this->pdo->commit();

            if ($ThikThak){

                echo "Saved Successfully";

            }

        }catch(Exception $e){

            echo $e->getMessage();

            $this->pdo->rollBack();

        }

    }





    public function updateOtherInvoice($data){

        $invoiceId = $data['otherInvoiceEditID'];

        $sUserId = Session::get('SUserID');


        try{

            $this->pdo->beginTransaction();

            $sql = "UPDATE mas_invoice 
                SET invoice_date = '$data[txtinvoice_date]',
                    client_id = '$data[txtclient_id]',
                    bill_amount = '$data[totcost1]',
                    vat = '$data[vat1]',
                    total_bill = '$data[gtot]',
                    discount_amnt = '$data[discount]',
                    vatper = '$data[vatper]',
                    next_inv_date = '$data[txtwork_order]',
                    work_order = '$data[txtwork_order]',
                    work_order_date = '$data[txtwork_order_date]'
                WHERE  invoiceobjet_id = ? ";

            $statement = $this->pdo->prepare($sql);

            $statement->execute(array($invoiceId));


            // Selecting Product Quantity for return inventory
            $stmt = $this->pdo->prepare("SELECT prod_id, qty AS nQty FROM trn_invoice_detail WHERE invoiceobject_id = ?");

            $stmt->execute(array($invoiceId));

            $returnProducts = $stmt->fetchAll();


            foreach ($returnProducts as $rPro){

                $pd_qty = $this->library->findField('tbl_product', 'pd_qty', "pd_id = {$rPro['prod_id']}");

                $item_type = $this->library->findField('tbl_product', 'item_type', "pd_id = {$rPro['prod_id']}");

                if ($item_type == 2) {

                    $n_qty = $pd_qty + $rPro['nQty'];

                    $stmt = $this->pdo->prepare("UPDATE tbl_product SET pd_qty = {$n_qty} WHERE pd_id = {$rPro['prod_id']}");

                    $stmt->execute();

                }

            }

            // Deleting Invoice Items From trn_invoice_detail
            $dltItem = "DELETE FROM trn_invoice_detail WHERE  invoiceobject_id = ?";


            $statement = $this->pdo->prepare($dltItem);

            $statement->execute(array($invoiceId));

            $id = $data['id'];

            $txtcat_id = $data['txtcat_id'];

            $txtprod_id = $data['txtprod_id'];

            $loc = $data['loc'];

            $pwv = $data['pwv'];

            $sd = $data['sd'];

            $qty = $data['qty'];

            $unt = $data['unt'];

            $vat = $data['vat'];


            // Insert Invoice Items After Delete
            foreach($id as $a => $v){

                $purchase_rate = $this->library->findField("tbl_product","pd_price","pd_id = {$txtprod_id[$a]}");

                $sql = "INSERT INTO trn_invoice_detail(
                    invoiceobject_id,
                    sl_no,
                    cat_id,
                    prod_id,
                    prod_description,
                    location,
                    rate,
                    qty,
                    unit,
                    total,
                    purchase_rate,
                    entry_by,
                    entry_date)
                 VALUES(
                    '$invoiceId',
                    '$id[$a]',
                    '$txtcat_id[$a]',
                    '$txtprod_id[$a]',
                    '$sd[$a]',
                    '$loc[$a]',
                    '$pwv[$a]',
                    '$qty[$a]',
                    '$unt[$a]',
                    '$vat[$a]',
                    '$purchase_rate',
                    '$sUserId',
                    DATE(now())
                )";

                $statement = $this->pdo->prepare($sql);

                $statement->execute();


                // Update Table Product
                $p_id = $txtprod_id[$a];

                $qty1 = $qty[$a];

                $pd_qty = $this->library->findField("tbl_product","pd_qty","pd_id = {$p_id}");

                $item_type = $this->library->findField("tbl_product","item_type","pd_id = {$p_id}");

                if ($item_type == 2) {

                    $n_qty = $pd_qty - $qty1;

                    $query ="UPDATE tbl_product SET pd_qty = '$n_qty' WHERE pd_id = '$p_id'";

                    $statement = $this->pdo->prepare($query);

                    $statement->execute();

                }

            } 

            $ThikThak = $this->pdo->commit();

            if ($ThikThak){

                echo "Updated Successfully";

            }

        }catch(Exception $e){

            echo $e->getMessage();

            $this->pdo->rollBack();

        }


    }




    //Get Invoices
    public function getInvoices(){

          $sql = "SELECT
            mas_invoice.invoiceobjet_id,
            mas_invoice.invoice_number,
            mas_invoice.bill_number,
            mas_invoice.client_type,
            DATE_FORMAT(mas_invoice.invoice_date,'%d/%m/%Y') as invoice_date,
            clients_info.clients_name as client_id,
            mas_invoice.remarks,
            mas_invoice.vat,
            mas_invoice.vatper,
            mas_invoice.bill_amount,
            mas_invoice.total_bill,
            mas_invoice.collection_amnt,
            mas_invoice.ait_adjustment,
            mas_invoice.ait_adj_date,
            mas_invoice.other_adjustment,
            mas_invoice.discount_amnt,
            mas_invoice.discount_date,
            mas_invoice.comments,
            mas_invoice.receive_status,
            mas_invoice.view_status,
            mas_invoice.entry_by,
            mas_invoice.entry_date,
            mas_invoice.update_by,
            mas_invoice.update_date,
            tbl_invoice_type.type_name as invoice_cat
        FROM 
            mas_invoice						
            LEFT JOIN clients_info ON  clients_info.id = mas_invoice.client_id
            LEFT JOIN tbl_invoice_type ON  tbl_invoice_type.invoicetype_id = mas_invoice.invoice_cat
        WHERE invoice_cat<>'Monthly'";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }


    public function getInvoiceCollection($cboDebtor){
        $query="SELECT
              invoiceobjet_id as invoiceobjet_id,
              DATE_FORMAT(invoice_date,'%d-%m-%Y') as smonth,
              invoice_cat as syear,
              serv_id,
              total_bill as net_bill,
              total_bill as total_bill,
              invoice_number,
              (collection_amnt+discount_amnt+ait_adjustment+vat_adjust_ment+ other_adjustment) AS ReceivedAmount,
              client_id as customer_id
        FROM
              mas_invoice
        WHERE
        client_id='$cboDebtor'
        AND total_bill>(collection_amnt+discount_amnt+ait_adjustment+vat_adjust_ment+ other_adjustment)";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }





    public function invoiceCollectionSave($data){
        extract($data);
        $sUserId = Session::get('SUserID');

        if (isset($cboVoucherDay, $cboVoucherMonth, $cboVoucherYear)){
            $collection_date = date('Y-m-d',strtotime("{$cboVoucherDay}-{$cboVoucherMonth}-{$cboVoucherYear}"));
        }else{ $collection_date = ''; }

        if (isset($cboChequeDay, $cboChequeMonth, $cboChequeYear)){
            $cheque_date     = date('Y-m-d',strtotime("{$cboChequeDay}-{$cboChequeMonth}-{$cboChequeYear}")); 
        }else{ $cheque_date = ''; }

        if (isset($txtTotalAdvance)){ $txtTotalAdvance  = $txtTotalAdvance; }else{ $txtTotalAdvance = 0; }

        $todaySDate      = date('Y-m-d');

        try{

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO mas_collection
              (
                  client_Id,
                  money_receipt,
                  collection_date,
                  pay_type,
                  bank_id,
                  cheque_no,
                  cheque_date,
                  coll_amount,
                  discoun_amnt,
                  adv_rec,
                  coll_by,
                  remarks,
                  entry_by,
                  entry_date
              )VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute(array($client_Id, $txtMoneyReceiptNo, $collection_date, $rdoReceiveType,
                $cbobank, $txtChequeNo, $cheque_date, $txtTotalAmount, $txtTotalDiscount, $txtTotalAdvance,
                $sUserId, $txaRemarks, $sUserId, $todaySDate));

            $collection_id = $this->pdo->lastInsertId();

            for($i = 0; $i < $hidIndex; $i++) {

                if(isset($chkAccept[$i]) AND $chkAccept[$i]=="ON") {
                    if (isset($txtAdvance)){
                        if ($txtAdvance[$i] == "") {
                            $txtAdvance[$i] = 0;
                        }
                    }

                    $stmt = $this->pdo->prepare("INSERT INTO  trn_collection(
                        collection_id,
                        serv_id,
                        client_Id,
                        masinvoiceobject_id,
                        billing_month,
                        collamnt,
                        collection_date,
                        discoun_amnt,
                        entry_by,
                        entry_date
                      ) VALUES (
                        '$collection_id',
                        '',
                        '$client_Id',
                        '',
                        '',
                        '',
                        '$collection_date',
                        '',
                        '$sUserId',
                        '$todaySDate'
                      )");
                    $stmt->execute();

                    $collAmntrs = $this->library->findField('mas_invoice', 'collection_amnt', "invoiceobjet_id = {$txtInvoiceObjectID[$i]}");
                    $collection_amnt = $collAmntrs + $txtAmount[$i];
                    $colldisconts = $this->library->findField('mas_invoice', 'discount_amnt', "invoiceobjet_id = {$txtInvoiceObjectID[$i]}");
                    $discount_amnt = $colldisconts + $txtDiscount[$i];

                    if($txtDiscount[$i]>0){
                        $stmt = $this->pdo->prepare("UPDATE mas_invoice
                            SET
                                discount_amnt =  '$discount_amnt',
                                discount_date = '$collection_date',
                                collection_amnt = '$collection_amnt'
                            WHERE invoiceobjet_id = '$txtInvoiceObjectID[$i]'");
                        $stmt->execute();
                    }else{
                        $stmt = $this->pdo->prepare("UPDATE mas_invoice
                            SET
                                collection_amnt = '$collection_amnt'
                            WHERE invoiceobjet_id = '$txtInvoiceObjectID[$i]'");
                        $stmt->execute();
                    }


                }
            }

            $ThikThak = $this->pdo->commit();

            if ($ThikThak){

                echo "Saved Successfully";

            }

        }catch (PDOException $e){
            $this->pdo->rollback();
            die('Failed'.$e->getMessage());
        }

    }





}






