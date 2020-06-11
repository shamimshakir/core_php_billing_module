<?php
    require '../../../bootstrap.php';
    require '../../../stylesheet.php';
?>
<div id="msgsuc"></div>
<div class="card">
    <div class="card-header">
        <span>Invoice Collection</span>
    </div>
    <div class="card-body">
        <div class="invoiceSearchForm">
            <form id="invoiceSearchForm">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="cboDebtor">Select Client</label>
                        <select name='cboDebtor' id='cboDebtor' class="select2">
                            <?php
                            $library->createClientCombo("Client","clients_info","id","clients_name","Order by id", $sInvoiceData['client_id']);
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary btn-sm" id="searchInvoiceBtn" name="searchInvoice">Show Data</button>
                </div>
            </form>
        </div>
        <div id="invoiceCollectionFormContent">

        </div>
    </div>
</div>

<?php require '../../../scriptfiles.php'; ?>
<script>

    $(document).ready(function () {
        $("#searchInvoiceBtn").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "views/billing/collection/generated_invoice_collection.php",
                data : $('#invoiceSearchForm').serialize(),
                success: function(response) {
                    $('#invoiceCollectionFormContent').html(response);
                    //console.log(response);
                }
            });
        });
    });

</script>


<script>
    function sendValue()
    {
        var Index=parseInt(document.MyForm.hidIndex.value);
        var NetBill;
        var ReceivedAmount;
        var Amount;
        var PossibleMaxAmount;
        //alert("working");
        if(document.MyForm.elements["rdoReceiveType"].value=='')
        {
            alert("Please Enter Received Type")
            return;
        }

        var Flag=true;
        for (var i=0;i<Index;i++)
        {
            if(document.MyForm.elements["chkAccept["+i+"]"].checked)
            {
                NetBill=document.MyForm.elements["txtNetBill["+i+"]"].value;
                ReceivedAmount=document.MyForm.elements["txtReceivedAmount["+i+"]"].value;
                Amount=parseFloat(document.MyForm.elements["txtAmount["+i+"]"].value);
                PossibleMaxAmount=parseFloat(NetBill)-parseFloat(ReceivedAmount);

                if(Amount>PossibleMaxAmount || Amount<=0 || isNaN(Amount))
                {
                    alert ("Please Enter Valid Amount.");
                    document.MyForm.elements["txtAmount["+i+"]"].focus();
                    return;
                }
                Flag=false;
            }
        }
        if(Flag)
        {
            alert("Please Select At List One Invoice.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "views/billing/collection/invoice_collection_save.php",
            data: $('#modal_form').serialize(),

        }).done(function(msg) {
            $('#msgsuc').css('opacity', 1);
            $('#msgsuc').css('visibility', 'visible');
            $('#msgsuc').html(msg);
            //console.log(msg);
        }).fail(function() {
            alert("error");
        });
    }
</script>


<title>Invoice Posting</title>

<script language=javascript>

    var xmlHttp = false;
    try
    {
        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
        try
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e2)
        {
            xmlHttp = false;
        }
    }

    if (!xmlHttp && typeof XMLHttpRequest != 'undefined')
    {
        xmlHttp = new XMLHttpRequest();
    }

    function callServer(URLQuery)
    {
        var url = "Library/AjaxLibrary.php";

        xmlHttp.open("POST", url, true);
        //xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

        xmlHttp.setRequestHeader("Method", "POST " + url + " HTTP/1.1");
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xmlHttp.onreadystatechange = updatePage;
        xmlHttp.send(URLQuery);
    }

    function updatePage()
    {
        // alert(xmlHttp.readyState);
        if (xmlHttp.readyState == 4)
        {
            var response = xmlHttp.responseText;
            //alert(response);
            window.BankAccountX.innerHTML="";
            window.BankAccountX.innerHTML=response;
        }
    }

</script>

<script language='javascript'>
    function getAmount(IndexVal)
    {
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
        }
        else
        {
            document.MyForm.elements["txtAmount["+IndexVal+"]"].value="";
            calculateTotalAmount();
            document.MyForm.elements["txtDiscount["+IndexVal+"]"].value="";
            calculateTotalAmount1();
            document.MyForm.elements["txtAdvance["+IndexVal+"]"].value="";
            calculateTotalAmount2();
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
                if(!isNaN(document.MyForm.elements["txtAmount["+i+"]"].value))
                    TotalAmount1=TotalAmount1+parseFloat(document.MyForm.elements["txtDiscount["+i+"]"].value);
                else
                    document.MyForm.elements["txtDiscount["+i+"]"].value='0';
            }
        }
        var tamt1 = new NumberFormat(TotalAmount1);
        tamt1.setPlaces(2);
        tamt1.setSeparators(false);
        var ptamount1 =parseFloat(tamt1.toFormatted());
        document.MyForm.txtTotalDiscount.value=ptamount1;
    }

    function calculateTotalAmount2()
    {
        var Index2=parseInt(document.MyForm.hidIndex.value);
        var TotalAmount2=0;

        for (var i=0;i<Index2;i++)
        {
            if(document.MyForm.elements["chkAccept["+i+"]"].checked)
            {
                if(!isNaN(document.MyForm.elements["txtAdvance["+i+"]"].value))
                    TotalAmount2=TotalAmount2+parseFloat(document.MyForm.elements["txtAdvance["+i+"]"].value);
                else
                    document.MyForm.elements["txtAdvance["+i+"]"].value='0';
            }
        }
        var tamt2 = new NumberFormat(TotalAmount2);
        tamt2.setPlaces(2);
        tamt2.setSeparators(false);
        var ptamount2 =parseFloat(tamt2.toFormatted());
        document.MyForm.txtTotalAdvance.value=ptamount2;
    }

    function checkReceiveType(val)
    {
        //alert(val);
        document.MyForm.elements["rdoReceiveType"].value=val
        if(val=='C' || val=='D')
        {

            document.MyForm.txtChequeNo.disabled=true;
            document.MyForm.cboChequeDay.disabled=true;
            document.MyForm.cboChequeMonth.disabled=true;
            document.MyForm.cboChequeYear.disabled=true;
        }
        else
        {

            document.MyForm.txtChequeNo.disabled=false;
            document.MyForm.cboChequeDay.disabled=false;
            document.MyForm.cboChequeMonth.disabled=false;
            document.MyForm.cboChequeYear.disabled=false;
        }
    }


</script>
