var page = $('#page').val();
var index = $('#index').val();

var ITEMCD;
var isItem = false;
var guideURL = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val();
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        ITEMCD = item.eq(1).text();
        $('#itemcd').html(item.eq(1).text());
        $('#itemname').html(item.eq(2).text());
        $('#itempec').html(item.eq(3).text());
        $('#drowno').html(item.eq(4).text());
        $('#seach').html(item.eq(5).text());
        $('#saledate').html(item.eq(6).text());
    }
    
    $('#select_item').on('click', function() {
        $('#loading').show();
        if(page == 'SEARCHPURCHASEORDER' || page == 'SEARCHPRODUCTIONORDER') {
            return window.location.href = guideURL +'/'+ page +'/index.php?P3='+ ITEMCD;
        } else if (page == 'SEARCHPURORPRO') {
            return window.location.href = guideURL +'/'+ page +'/index.php?P1='+ ITEMCD;
        } else if(page == 'SEARCHSALENOSHIP') {
            return window.location.href=guideURL +'/SEARCHSALENOSHIP/index.php?ITEMCODE='+ ITEMCD;
        } else {
            return HandleResult(ITEMCD)
        }
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    if(page == 'SEARCHPURCHASEORDER' || page == 'SEARCHSALENOSHIP' || page == 'SEARCHPRODUCTIONORDER' || page == 'SEARCHPURORPRO') { 
        return window.location.href = guideURL +'/'+ page +'/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'SEARCHSALE' || page == 'SEARCHPURCHASE' || page == 'ITEMMASTERINQUIRY' || page == 'BMENTRY' || page == 'PROCESSMASTER') {
            window.opener.HandlePopupResultIndex('ITEMCD', result, index);
        } else if(page == 'ACC_SALEQUOTEENTRY_THA' || page == 'ACC_SALEENTRY_THA2' || page == 'ACC_SALEENTRY_THA3' || page == 'ACC_PURCHASEREQUISITION_THA' || page == 'ACC_PURCHSEORDERENTRY_THA' || page == 'ACC_RECEIVEPURCHASE_THA' || page == 'ORDERBMENTRY') {
            window.opener.HandlePopupItem(result, index);  
        } else if(page == 'ITEMMASTER_CLONE') {
            window.opener.HandlePopupResult('ITEMCLONE', result);
        } else if(page == 'ITEMCOSTCSV' || page == 'MANUFACTURINGPLAN' || page == 'PLANVIEW' || page == 'CLEARANCEMONTHENTRY' || page == 'INVMOVINGREVIEW') {
            window.opener.HandlePopupResult('ITEMCODE', result);
        } else {
            window.opener.HandlePopupResult('ITEMCD', result);
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false; 
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table empty Row
    $('#table_result > tbody > tr').remove();
    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="row-empty" id="rowId'+i+'">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    // refresh
    // window.location.href = 'index.php';

    return false;
}