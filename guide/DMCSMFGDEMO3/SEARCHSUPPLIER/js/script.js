var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var SUPCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        SUPCD = item.eq(1).text();
        $('#suppliercd').html(item.eq(1).text());
        $('#suppliername').html(item.eq(2).text());
        $('#address1').html(item.eq(3).text());
        $('#address2').html(item.eq(4).text());
    }


    $('#select_item').on('click', function() {
        if(page == 'SEARCHPURCHASEORDER') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?P2='+ SUPCD;
        } else {
            return HandleResult(SUPCD);
        }
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    // window.history.back();
    // window.history.go(-1); return false;
    if(page == 'SEARCHPURCHASEORDER') {
        return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'ACC_PURCHSEORDERENTRY_THA' || page == 'ACC_RECEIVEPURCHASE_THA' || page == 'ACC_PURCHASEBILLSLIP' || page == 'ACC_PAYMENTENTRY3_THARD' || page == 'ACC_WHTMETHOD2' || page == 'ITEMMASTER' || page == 'ITEMMASTER_MFG' || page == 'ACC_GENERALVO_THARD' || page == 'ACC_ADJUSTVO_THA' || page == 'ACC_ADJUSTVO_ONLY_THA' || page == 'ACC_PETTYCASHVO_THA') {
            window.opener.HandlePopupResult('SUPPLIERCD', result);
        } else if(page == 'ACC_OUTSTANDINGAP' || page == 'SEARCHPURCHASE' || page == 'SEARCHGL') {
            window.opener.HandlePopupResultIndex('SUPPLIERCD', result, index);
        } else {
            window.opener.HandlePopupResult('SUPCD', result);
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
        $('#table_result tbody').append('<tr class="row-empty">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}