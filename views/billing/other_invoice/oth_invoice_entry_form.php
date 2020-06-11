<?php
require '../../../bootstrap.php';
require '../../../stylesheet.php';

    if (isset($_GET['id'])){

        $editInvoiceId = $_GET['id'];

        $sInvoiceData = $library->findOneById('mas_invoice', 'invoiceobjet_id', $editInvoiceId);

    }

?>
<div class="othInvoiceEntryFormSection">
    <div class="card">
        <div class="card-header">
            <?php if (isset($_GET['id'])){echo 'Edit Invoice'; }

            else{echo 'Add Invoice'; } ?>
            <a class="pageLoadBtn btn btn-primary btn-sm" href="views/billing/other_invoice/oth_invoice_entrygrid.php">
                All Invoices
            </a>
        </div>
        <div class="card-body">
            <div id="msgsuc"></div>
            <form action="" id="otherInvoiceForm" name="otherInvoiceForm" action="">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="txtclient_id">Client Name</label>
                            <select name='txtclient_id' id='txtclient_id' class="select2">
                                <?php
                                $library->createClientCombo("Client","clients_info","id","clients_name","Order by id", $sInvoiceData['client_id']);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-5 invoiceRightDateInfo">
                        <div class="row"> 
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Invoice Date</label>
                                    <input type="text" name="txtinvoice_date" class="form-control input-sm datepicker" id="txtinvoice_date" value="<?php if (isset($sInvoiceData['invoice_date'])){echo $sInvoiceData['invoice_date'];} ?>" maxlength="35"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Work Order Ref.</label>
                                    <input type="text" name="txtwork_order"  class="form-control input-sm" id="txtwork_order" value="<?php if (isset($sInvoiceData['work_order'])){echo $sInvoiceData['work_order'];} ?>" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Next Invoice Date</label>
                                    <input type="text" name="txtwork_order_date" class="form-control input-sm datepicker" id="txtwork_order_date" value="<?php if (isset($sInvoiceData['work_order_date'])){echo $sInvoiceData['work_order_date'];} ?>"  maxlength="35"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['id'])):?>
                <div class="invoiceItemRowsSection">
                    <h2>Invoice Item</h2>
                    <button id="ExtendRow"><i class="fa fa-plus"></i></button>
                    <?php
                        $invoiceItems = $library->findAllById('trn_invoice_detail', 'invoiceobject_id', $sInvoiceData['invoiceobjet_id']);
                        foreach ($invoiceItems as $sInvoItem):
                        $catId = $sInvoItem['cat_id'];?>

                    <div class="row invoiceItemRow" id="invoiceItemRow">
                        <div class="col-lg-3">
                            <label for="">Category</label>
                            <select name='txtcat_id[]' id='txtcat_id' >
                                <?php $library->categoryLevelCombo($sInvoItem['cat_id']); ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Product</label>
                            <select name='txtprod_id[]' id='txtprod_id' >
                                <?php
                                $library->createCombo("Product","tbl_product","pd_id","pd_name","", '$catId');
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Remain Qty</label>
                            <input type="text" class="form-control input-sm" name="r_qty[]" id="r_qty" value="" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Billing Period</label>
                            <input type="text" class="form-control input-sm" name="loc[]"  value="<?= $sInvoItem['location']; ?>" id="loc" size="20"/>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Price/Rate <small>(BDT)</small></label>
                            <input type="text" name="pwv[]" value="<?= $sInvoItem['rate']; ?>" id="pwv"  size="5" onblur="CaclulateCostTotal();" class="form-control input-sm"/>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Description</label>
                            <textarea class="textAreaField form-control" name="sd[]" id="sd" ><?= $sInvoItem['prod_description']; ?></textarea>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Quantity</label>
                            <input type="text" name="qty[]" class="form-control input-sm" value="<?= $sInvoItem['qty']; ?>" onblur="CaclulateCostTotal();" id="qty" size="5"/>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Unit</label>
                            <input type="text" class="form-control input-sm" name="unt[]"  value="<?= $sInvoItem['unit']; ?>" id="unt" size="5"/>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Amount <small>(BDT)</small></label>
                            <input type="text" class="form-control input-sm" name="vat[]" value="<?= $sInvoItem['total']; ?>" id="vat" size="10" />
                        </div>
                        <input type="hidden" name="id[]" value="" class="id" size="3" readonly />

                        <button class="deleteItem deleteEditItem"><i class="fa fa-times"></i></button>
                    </div>
                    <?php endforeach;?>
                </div>
                <?php else: ?>
                <div class="invoiceItemRowsSection">
                    <h2>Invoice Item</h2>
                    <button id="ExtendRow"><i class="fa fa-plus"></i></button>
                    <div class="row invoiceItemRow" id="invoiceItemRow">
                        <div class="col-lg-3">
                            <label for="">Category</label>
                            <select name='txtcat_id[]' id='txtcat_id'">
                                <?php $library->categoryLevelCombo(''); ?>
                            </select>

                        </div>
                        <div class="col-lg-3">
                            <label for="">Product</label>
                            <select name='txtprod_id[]' id='txtprod_id' >
                                <?php
                                $library->createCombo("Product","tbl_product","pd_id","pd_name","",'');
                                ?>
                                </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Remain Qty</label>
                            <input type="text" class="form-control input-sm" name="r_qty[]" id="r_qty" value="" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Billing Period</label>
                            <input type="text" class="form-control input-sm" name="loc[]"  value="" id="loc" size="20"/>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Price/Rate <small>(BDT)</small></label>
                            <input type="text" name="pwv[]" value="" id="pwv"  size="5" onblur="CaclulateCostTotal();" class="form-control input-sm"/>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Description</label>
                            <textarea class="textAreaField form-control" name="sd[]" id="sd" ></textarea>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Quantity</label>
                            <input type="text" name="qty[]" class="form-control input-sm" value="" onblur="CaclulateCostTotal();" id="qty" size="5"/>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Unit</label>
                            <input type="text" class="form-control input-sm" name="unt[]"  value="" id="unt" size="5"/>
                        </div>
                        <div class="col-lg-2">
                            <label for="">Amount <small>(BDT)</small></label>
                            <input type="text" class="form-control input-sm" name="vat[]" value=""  id="vat" size="10" />
                        </div>
                        <input type="hidden" name="id[]" value="" class="id" size="3" readonly />
                    </div>

                </div>
                <?php endif; ?>
                <div class="invoiceResultCountRow">
                    <div class="invoiceResultFormGroup">
                        <label for="">Sub Total</label>
                        <input type="text" name="totcost1" id="totcost1" size="8" value="<?php if (isset($sInvoiceData['bill_amount'])){echo $sInvoiceData['bill_amount'];} ?>" readonly />
                    </div>
                    <div class="invoiceResultFormGroup">
                        <label for="">Discount</label>
                        <input type="text" name="discount" id="discount" value="0" size="8" value="<?php if (isset($sInvoiceData['discount_amnt'])){echo $sInvoiceData['discount_amnt'];} ?>" onblur="CaclulateCostTotal();" />
                    </div>
                    <div class="invoiceResultFormGroup">
                        <label for="">Vat</label>
                        <input type="text" name="vatper" value="0" id="vatper" value="<?php if (isset($sInvoiceData['vatper'])){echo $sInvoiceData['vatper'];}?>" size="2" onblur="CaclulateCostTotal();"/> &nbsp;&nbsp;%
                        <input type="text" name="vat1" value="<?php if (isset($sInvoiceData['vat'])){echo $sInvoiceData['vat'];} ?>" id="vat1" size="5" value="" readonly />
                    </div>
                    <div class="invoiceResultFormGroup">
                        <label for="">Total Bill</label>
                        <input type="text" name="gtot" id="gtot" size="14"  value="<?php if (isset($sInvoiceData['total_bill'])){echo $sInvoiceData['total_bill'];} ?>" readonly />
                    </div>
                    <?php if(isset($_GET['id'])): ?>

                        <input type="hidden" name="otherInvoiceEditID" value="<?= $_GET['id']; ?>">

                        <button type="button" onclick="editOtherInvoice()" class="btn btn-primary btn-sm mt-2">Update</button>

                    <?php else: ?>

                        <input type="hidden" name="otherInvoiceAdd" value="1">

                        <button type="button" onclick="addOtherInvoice()" class="btn btn-primary btn-sm mt-2">Submit</button>

                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../../../scriptfiles.php'; ?>
<script>

    // Extend Invoice Product Item Row
    $("#ExtendRow").click(function(e) {
        e.preventDefault();
        var invoiceItemRowCloned = $("#invoiceItemRow").clone(true);
        var newInvoiceItemRow = invoiceItemRowCloned.append('<button class="deleteItem"><i class="fa fa-times"></i></button>');
        newInvoiceItemRow.appendTo(".invoiceItemRowsSection").find('input[type="text"]').val("").find('select').removeAttr('selected');

        $('.deleteItem').click(function(e){
            e.preventDefault();
            $(this).parent().remove();
        });
    });

    $('.deleteEditItem').click(function(e){
        e.preventDefault();
        $(this).parent().remove();
    });


    // Invoice Adding
    function addOtherInvoice(){
        $.ajax({
            url:"views/billing/other_invoice/other_invoice_xhr.php",
            type: "POST",
            data: $('#otherInvoiceForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
            }
        });
    }


    // Invoice Editing
    function editOtherInvoice(){
        $.ajax({
            url:"views/billing/other_invoice/other_invoice_xhr.php",
            type: "POST",
            data: $('#otherInvoiceForm').serialize(),
            success:function (response) {
                $('#msgsuc').css('opacity', 1);
                $('#msgsuc').css('visibility', 'visible');
                $('#msgsuc').html(response);
                console.log(response);
            }
        });
    }






        //Category Wise Product Combo
    $(document).on('change', 'select[name="txtcat_id[]"]', function(){
        var cat_id = $(this).val();
        var parRow = $(this).closest('.row');
        $.ajax({
            type:'POST',
            url:'views/billing/other_invoice/other_invoice_xhr.php',
            data:{
                cat_id: cat_id,
                getProductByCategory: 1
            },
            success:function(html){
                parRow.find('select[name="txtprod_id[]"]').html(html);
            }
        });

    });




        // Product Wise Quantity Show
    $(document).on('change', 'select[name="txtprod_id[]"]', function(){
        var prod_id = $(this).val();
        var parRow = $(this).closest('.row');
        $.ajax({
            type:'POST',
            url:'views/billing/other_invoice/other_invoice_xhr.php',
            data:{
                prod_id: prod_id,
                getProductQuantity: 1
            },
            success:function(html){
                parRow.find('input[name="r_qty[]"]').val(html);
            }
        });
    });



    CaclulateCostTotal = function() {
        var totcost=0;
        $('.invoiceItemRow').each(function(i, el) {
            var $this = $(this),
                $cost = $this.find('[name="pwv\\[\\]"]'),
                $quant = $this.find('[name="qty\\[\\]"]'),
                c = parseFloat($cost.val()),
                q = parseInt($quant.val(), 10),
                total = c * q || 0;
            $this.find('[name="vat\\[\\]"]').val(total.toFixed(2));
            totcost=totcost+total;
        });
        $("#totcost1").val(totcost.toFixed(2));

        //VAT Calculation and Total

        $cost = $("#totcost1").val();
        $per = $("#vatper").val();
        $discount = $("#discount").val();
        vatcal = Math.round(($cost-$discount) * $per/100) || 0;
        grandtot = Math.round(parseFloat($cost)+parseFloat((($cost-$discount) * $per/100))-parseFloat($discount) );

        $("#vat1").val(vatcal.toFixed(2));
        $("#gtot").val(grandtot.toFixed(2));

    };

    $("#invoiceItemRow:first .deleteItem").css('display', 'none');


</script>



