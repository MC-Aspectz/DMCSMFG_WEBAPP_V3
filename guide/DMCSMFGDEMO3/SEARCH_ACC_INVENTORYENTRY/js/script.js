var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var INVTRANNO;

$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        INVTRANNO = item.eq(0).text();
    }

    $('#voucherno').html(item.eq(0).text());
    $('#voucherdate').html(item.eq(1).text());
    $('#processtype').html(item.eq(2).text());
    $('#locationtype').html(item.eq(3).text());
    $('#locationcode').html(item.eq(4).text());
    $('#locationname').html(item.eq(5).text());
    $('#itemcode').html(item.eq(6).text());    
    $('#itemname').html(item.eq(7).text());
    $('#specification').html(item.eq(8).text());
    $('#quantity').html(item.eq(9).text());
    $('#comment').html(item.eq(10).text());
    // $('#comment').html(item.eq(11).text());

    $("#select_item").on('click', function() {
        return HandleResult(INVTRANNO);
        if($('#page').val() == 'SEARCHPURCHASEORDER') {
            window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?P3='+ item.eq(1).text();
        } 
        else if($('#index').val() != null && $('#index').val() != '') {
            window.location.href=$('#routeUrl').val() + item.eq(0).text() +'&index=' +$('#index').val();
        } else {
            window.location.href=$('#routeUrl').val() + item.eq(0).text();
        }            
        
    });
});

$("#view_item").on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    return window.close();
    // window.history.back();
    // window.history.go(-1); return false;
    if($('#page').val() == 'SEARCHPURCHASEORDER') {
        window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php';
    } else {
        window.location.href=$('#routeUrl').val();
    }

});

function HandleResult(result) {
    try {
        if(page == 'ACC_INVENTORYENTRY') {
           window.opener.HandlePopupResult('INVTRANNO',result);   
        } else {
            window.opener.HandlePopupResult('INVTRANNO', result);    
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
        $('#table_result tbody').append('<tr class="flex w-full p-0 divide-x">' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +      
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-1/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';
    // refresh
    // window.location.href = 'index.php';
    return false;
}