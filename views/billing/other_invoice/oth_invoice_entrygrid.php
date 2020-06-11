<?php
    require '../../../bootstrap.php';
    require '../../../stylesheet.php';

?>

<div class="allClientsList"> 
    <div class="card">
        <div class="card-header">
            <span>Invoice Information</span>
            <a class="pageLoadBtn btn btn-primary btn-sm" href="views/billing/other_invoice/oth_invoice_entry_form.php">
                <i class="fa fa-plus"></i> Add Invoice
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="pagiTableView">

                <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Client Name</th>
                        <th>Vat</th>
                        <th>Bill Amount</th>
                        <th>Total Bill</th>
                        <th>Collection Amount</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $invoices = $billing->getInvoices();
                    foreach ($invoices as $invoice):?>
                        <tr>
                            <td><?= $invoice['invoice_number'];?></td>
                            <td><?= $invoice['invoice_date'];?></td>
                            <td><?= $invoice['client_id'];?></td>
                            <td><?= $invoice['vat'];?></td>
                            <td><?= $invoice['bill_amount'];?></td>
                            <td><?= $invoice['total_bill'];?></td>
                            <td><?= $invoice['collection_amnt'];?></td>
                            <td><a href="views/billing/other_invoice/oth_invoice_entry_form.php?id=<?= $invoice['invoiceobjet_id']; ?>" class="pageLoadBtn btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require '../../../scriptfiles.php';
?>

<script>
    $(document).ready(function(){

        // $('#dataTable').DataTable({
        //     "processing": true,
        //     "serverSide":true,
        //     'serverMethod': 'post',
        //     "ajax":{
        //         url:"views/billing/other_invoice/view_other_invoice.php",
        //         type:"POST"
        //     },
        //     'columns': [
        //         { data: 'invoice_number' },
        //         { data: 'invoice_date' },
        //         { data: 'client_id' },
        //         { data: 'vat' },
        //         { data: 'bill_amount' },
        //         { data: 'total_bill' },
        //         { data: 'collection_amnt' },
        //         { data: 'edit' }
        //     ]
        // });

        $('#dataTable').DataTable();


    });
</script>