var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var LOCCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        LOCCD = item.eq(1).text();
    }

    $('#loccd').html(item.eq(1).text());
    $('#locnm').html(item.eq(2).text());
    
    $('#select_item').on('click', function() {
        if($('#page').val() == 'SEARCHPURCHASEORDER') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?P3='+ item.eq(1).text();
        } else if($('#index').val() != null && $('#index').val() != '') {
            return window.location.href=$('#routeUrl').val() + item.eq(1).text() +'&index=' +$('#index').val();
        } else {
            return HandleResult(LOCCD);
        }
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    if($('#page').val() == 'SEARCHPURCHASEORDER') {
        return window.location.href=$('#sessionUrl').val() + '/guide/SEARCHPURCHASEORDER/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'ACC_INVENTORYENTRY') {
            window.opener.HandlePopupResult('loccd',result);   
        } else if(page == 'SHIPREQUESTCANCEL' || page == 'SHIPPINGREQUESTENTRY' || page == 'SHIPMENTENTRY' || page == 'PRODUCTIONORDERENTRY') { 
            window.opener.HandlePopupLocResult(result, $('#P1').val());
        } else {
            window.opener.HandlePopupResult('LOCCD', result);    
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

    // clearing table
    $('#table_result > tbody > tr').remove();
    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="divide-y divide-gray-200">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';
    // refresh
    // window.location.href = 'index.php';

    return false;
}