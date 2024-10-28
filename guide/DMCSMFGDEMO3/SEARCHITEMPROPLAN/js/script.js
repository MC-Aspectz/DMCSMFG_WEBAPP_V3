var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var ITEMCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        ITEMCD = item.eq(1).text();
        $('#itemcode').html(item.eq(0).text());
        $('#itemname').html(item.eq(1).text());
        $('#specification').html(item.eq(2).text());
        $('#drawingno').html(item.eq(3).text());
        $('#searchstring').html(item.eq(4).text());
    }
    
    $("#select_item").on('click', function() {
        $('#loading').show();
        if(page == 'SEARCHPURCHASEORDER') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?P3='+ ITEMCD;
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
    if(page == 'SEARCHPURCHASEORDER') { 
        $('#loading').hide();
        return window.location.href = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/'+ page +'/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
     
        window.opener.HandlePopupResult('ITEMCD', result);

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
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';


    return false;
}