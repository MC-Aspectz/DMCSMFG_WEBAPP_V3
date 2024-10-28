var page = $('#page').val();
var pageUrl = $('#pageUrl').val();

var isItem = false;
var CURRENCYCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        CURRENCYCD = item.eq(1).text();
        
        $('#currencycode').html(item.eq(1).text());
        $('#decimalunit').html(item.eq(2).text());
        $('#decimaltotal').html(item.eq(3).text());
        $('#currencydisplayed').html(item.eq(4).text());
    }

    
    $("#select_item").on('click', function() {
        $('#loading').show();
        return HandleResult(CURRENCYCD);
    });
});

$("#view_item").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    // window.history.back();
    return window.close();
});

function HandleResult(result) {
    try {
        if(page == 'ACC_OUTSTANDINGAR' || page == 'SEARCHSALE' || page == 'ACC_OUTSTANDINGAP' || page == 'SEARCHPURCHASE' || page == 'SEARCHGL' || page == 'CUSTOMERMASTER_DMCS_THA' || page == 'SUPPLIERMASTER_DMCS_THA') {
            window.opener.HandlePopupResult('CURRENCYCD', result);
        } else if(page == 'ACC_PURCHSEORDERENTRY_THA' || page == 'ACC_RECEIVEPURCHASE_THA' || page == 'ACC_PURCHASEBILLSLIP' || page == 'ACC_PAYMENTENTRY3_THARD') {
            window.opener.HandlePopupResult('SUPCURCD', result);
        } else if(page == 'EXCHANGERATEMASTER'){
            window.opener.HandlePopupResult('currencycd', result);
        } else {
            window.opener.HandlePopupResult('CUSCURCD', result);
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
    for (var i = 0; i < inputs.length; i++) {
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
            case 'checkbox':
                inputs[i].checked = false;
                break;
            case 'radio':
                inputs[i].checked = false;
                break;                
            default:
                inputs[i].value = '';
        }
    }
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

    // clearing table empty Row
    $('#table_result > tbody > tr').remove();
    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="row-empty" id="rowId'+i+'">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}