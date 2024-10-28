var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var DIVISIONCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        DIVISIONCD = item.eq(1).text();
        $('#department').html(item.eq(1).text());
        $('#factory').html(item.eq(2).text());
        $('#departmentname').html(item.eq(3).text());
    }

    $("#select_item").on('click', function() {
        if(page == 'SEARCHPURCHASEORDER') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?DIVISIONCD='+ DIVISIONCD;
        } else {
            return HandleResult(DIVISIONCD);
        }
    });
});

$("#view_item").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    // window.history.back();
    if(page == 'SEARCHPURCHASEORDER') {
        return window.location.href = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'ACC_OUTSTANDINGAR' || page == 'ACC_OUTSTANDINGAP' || page == 'SEARCHSALE' || page == 'SEARCHPURCHASE' || page == 'SEARCHGL' || page == 'SEARCHSTAFFBYDEPT') {
            window.opener.HandlePopupResultIndex('DIVISIONCD', result, index);
        } else {
            window.opener.HandlePopupResult('DIVISIONCD', result);
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
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    // refresh
    // window.location.href = 'index.php';

    return false;
}