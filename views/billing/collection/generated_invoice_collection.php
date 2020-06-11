
<?php
require '../../../bootstrap.php';
?>

<form name="MyForm" id="modal_form">
    <?php
    $cboDebtor = $_REQUEST['cboDebtor'];
    $accountNo = $library->findField('clients_info', 'ac_no', "id={$cboDebtor}");
    $clientName = $library->findField('clients_info', 'clients_name', "id={$cboDebtor}");
    $userId = $library->findField('clients_info', 'user_id', "id={$cboDebtor}");
    echo "<div class='invoClientInfo mt-5'><span><strong>Account No :</strong>{$accountNo}</span>
        <span><strong> User name :</strong>{$clientName}</span>
        <span><strong>User id :</strong>{$userId}</span></div>";



    $RowCount = $library->rowCountByCond('mas_invoice', "mas_invoice.client_id={$cboDebtor}");
    $cInvoices = $billing->getInvoiceCollection($cboDebtor);

    if($RowCount>0){
        echo "<input type='hidden' name='client_Id' value='$cboDebtor'>";
        echo "<table class='table table-bordered'>
            <tr>

                  <td colspan='9' class='header_cell_e'><h4>Invoice List</h4></td>

            </tr>
            <tr class='thead'>
                  <td>Inv No.</td>
                  <td>Type</td>
                  <td>Date</td>
                  <td>Net Bill</td>
                  <td>Received Amount</td>
                  <td>Accept</td>
                  <td>Amount</td>
                  <td>Discount</td>

            </tr>";
        $i=0;


        foreach($cInvoices as $row) {
            extract($row);
            echo "<tr>
                      <td>

                         <input type='hidden' name='txtInvoiceObjectID[$i]' value='$invoiceobjet_id'>
                         <input type='hidden' name='txtttotalamount[$i]' value='".$total_bill."'>
                         <input type='hidden' name='serv_id[$i]' value='$serv_id'>

                         {$invoice_number}&nbsp;
                      </td>
                      <td>{$syear}&nbsp</td>
                      <td>$smonth <input type='hidden' name='smonth[$i]' value='".$smonth."' readonly></td>
                      <td><input type='text' style='text-align:right'  class='form-control input-sm' name='txtNetBill[$i]' value='".number_format($net_bill,2,'.','')."' readonly></td>
                      <td><input type='text' style='text-align:right'  class='form-control input-sm' name='txtReceivedAmount[$i]' value='".number_format($ReceivedAmount,2,'.','')."' readonly></td>

                      <td><input type='checkbox' name='chkAccept[$i]' value='ON' onclick=\"getAmount('$i')\"></td>
                      <td><input type='text' style='text-align:right'  class='form-control input-sm' name='txtAmount[$i]' onchange='calculateTotalAmount()'></td>
                      <td><input type='text' style='text-align:right'  class='form-control input-sm' name='txtDiscount[$i]' onchange='calculateTotalAmount1()'></td>
                </tr>";
            $i++;
        }
        echo "<tr>
							
						<td></td>
						<td></td>
						<td>&nbsp;</td>
						<td colspan='3' style='text-align:right'>Total Amount</td>
						<td class='td_e'>
							<input type='text' class='form-control input-sm' size='12' style='text-align:right' name='txtTotalAmount' readonly>
						</td>
						<td class='td_e'>
							<input type='text' class='form-control input-sm' size='12' style='text-align:right' name='txtTotalDiscount' readonly>
						</td>
						
					  </tr>";
        echo "</table>";
        echo "<input type='hidden' name='hidIndex' value='$i'>";
    }
    else{
        die('No Information Available.');
    } ?>
    <table  class="table table-bordered">
        <tr>
            <td colspan='9'><h4>Received Detail</h4></td>
        </tr>
        <tr>
            <td>Receive Type</td>
            <td>
                Cash<input type='radio' name='rdoReceiveType' value='C' onclick='checkReceiveType(this.value)'>
                Cheque<input type='radio' name='rdoReceiveType' value='Q' onclick='checkReceiveType(this.value)'>
                Direct Deposit<input type='radio' name='rdoReceiveType' value='D' onclick='checkReceiveType(this.value)'>
            </td>
            <td>Money Receipt No</td>
            <td>
                <input type='text' class='form-control input-sm' name='txtMoneyReceiptNo'>
            </td>
        </tr>
        <tr>
            <td>Collection Date</td>
            <td>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <select name='cboVoucherDay'>
                            <?php
                            $D=date('d');
                            $library->comboDay($D);
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <select name='cboVoucherMonth'>
                            <?php
                            $M=date('m');
                            $library->comboMonth($M);
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <select name='cboVoucherYear'>
                            <?php
                            $Y=date('Y');
                            $PY=$Y-10;
                            $NY=$Y+10;
                            $library->comboYear($PY,$NY,$Y);
                            ?>
                        </select>
                    </div>
                </div>
            </td>
            <td>Bank</td>
            <td>
                <select name='cbobank' class='form-control input-sm'>
                    <?php $library->createCombo("Bank","tbl_bank","bank_id","bank_name","order by bank_name",""); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Cheque No</td>
            <td>
                <input type='text' class='form-control input-sm' name='txtChequeNo'>
            </td>
            <td>Cheque Date</td>
            <td>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <select name='cboChequeDay'>
                            <?php
                            $D=date('d');
                            $library->comboDay($D);
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <select name='cboChequeMonth'>
                            <?php
                            $M=date('m');
                            $library->comboMonth($M);
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <select name='cboChequeYear'>
                            <?php
                            $Y=date('Y');
                            $PY=$Y-10;
                            $NY=$Y+10;
                            $library->comboYear($PY,$NY,$Y);
                            ?>
                        </select>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td  colspan='3'>
                <textarea name='txaRemarks' class='form-control' cols='80'></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td  colspan='3'>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="sms" value="1" checked> SMS Notification
                    </label>
                </div>
            </td>
        </tr>
    </table>
    <div>
        <center><button type="button" class="btn btn-primary btn-sm" onclick="sendValue()" >Submit</button></center>
    </div>
</form>

<script language='javascript'>
    function getAmount(IndexVal)
    {
        // alert(IndexVal);
        var NetBill=document.MyForm.elements["txtNetBill["+IndexVal+"]"].value;
        var ReceivedAmount=document.MyForm.elements["txtReceivedAmount["+IndexVal+"]"].value;
        var Amount=parseFloat(NetBill)-parseFloat(ReceivedAmount);
        var amt = new NumberFormat(Amount);
        amt.setPlaces(2);
        amt.setSeparators(false);
        var pamount =parseFloat(amt.toFormatted());

        if(document.MyForm.elements["chkAccept["+IndexVal+"]"].checked)
        {
            document.MyForm.elements["txtAmount["+IndexVal+"]"].value=pamount;
            calculateTotalAmount();
            document.MyForm.elements["txtDiscount["+IndexVal+"]"].value="0";
            //	calculateTotalAmount1();

            //  }
        }
        else
        {
            document.MyForm.elements["txtAmount["+IndexVal+"]"].value="";
            calculateTotalAmount();
            document.MyForm.elements["txtDiscount["+IndexVal+"]"].value="0";
            calculateTotalAmount1();
            document.MyForm.elements["txtAdvance["+IndexVal+"]"].value="0";
            // calculateTotalAmount2();
        }
        //calculateait();
    }
    function calculateTotalAmount()
    {
        var Index=parseInt(document.MyForm.hidIndex.value);
        var TotalAmount=0;

        for (var i=0;i<Index;i++)
        {
            if(document.MyForm.elements["chkAccept["+i+"]"].checked)
            {
                if(!isNaN(document.MyForm.elements["txtAmount["+i+"]"].value))
                    TotalAmount=TotalAmount+parseFloat(document.MyForm.elements["txtAmount["+i+"]"].value);
                else
                    document.MyForm.elements["txtAmount["+i+"]"].value='0';
            }
        }
        var tamt = new NumberFormat(TotalAmount);
        tamt.setPlaces(2);
        tamt.setSeparators(false);
        var ptamount =parseFloat(tamt.toFormatted());
        document.MyForm.txtTotalAmount.value=ptamount;
    }

    function calculateTotalAmount1()
    {
        var Index1=parseInt(document.MyForm.hidIndex.value);
        var TotalAmount1=0;
        for (var i=0;i<Index1;i++)
        {

            if(document.MyForm.elements["chkAccept["+i+"]"].checked)
            {
                //  getAmount(i);
                if(!isNaN(document.MyForm.elements["txtAmount["+i+"]"].value)){
                    TotalAmount1=TotalAmount1+parseFloat(document.MyForm.elements["txtDiscount["+i+"]"].value);

                    var NetBill=document.MyForm.elements["txtNetBill["+i+"]"].value;
                    var ReceivedAmount=document.MyForm.elements["txtReceivedAmount["+i+"]"].value;
                    var Amount=parseFloat(NetBill)-parseFloat(ReceivedAmount);
                    var tamt=Amount-parseFloat(document.MyForm.elements["txtDiscount["+i+"]"].value);
                    document.MyForm.elements["txtAmount["+i+"]"].value=tamt;
                }else
                    document.MyForm.elements["txtDiscount["+i+"]"].value='0';

            }
        }

        var tamt1 = new NumberFormat(TotalAmount1);
        //var tamtT = new NumberFormat(tam);
        //alert(tam);
        tamt1.setPlaces(2);
        tamt1.setSeparators(false);
        var ptamount1 =parseFloat(tamt1.toFormatted());
        document.MyForm.txtTotalDiscount.value=ptamount1;
        calculateTotalAmount();
        //alert(Index1);
        //getAmount(Index1);

    }

    function checkReceiveType(val) {
        document.MyForm.elements["rdoReceiveType"].value=val
        if(val=='C' || val=='D') {
            document.MyForm.txtChequeNo.readOnly=true;
            document.MyForm.cboChequeDay.disabled=true;
            document.MyForm.cboChequeMonth.disabled=true;
            document.MyForm.cboChequeYear.disabled=true;
        } else {
            document.MyForm.txtChequeNo.readOnly=false;
            document.MyForm.cboChequeDay.disabled=false;
            document.MyForm.cboChequeMonth.disabled=false;
            document.MyForm.cboChequeYear.disabled=false;
        }
    }


</script>