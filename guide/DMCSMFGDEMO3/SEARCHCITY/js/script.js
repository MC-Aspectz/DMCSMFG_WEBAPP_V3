var page = $('#page').val();

var isItem = false;
var CITYCD;
var COUNTRYCD = $('#COUNTRYCD').val();
var STATECD = $('#STATECD').val();

$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        CITYCD = item.eq(0).text();

    }

    $('#currencycode').html(item.eq(0).text());
    $('#decimalunit').html(item.eq(1).text());
    
    $("#select_item").on('click', function() {
        $('#loading').show();
        return HandleResult(CITYCD,COUNTRYCD,STATECD);
    });
});

$("#view_item").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    // window.history.back();
    // window.location.href=$('#routeUrl').val();
    return window.close();
});

function HandleResult(result,result2,result3) {
    try {
        if(page == 'CUSTOMERMASTER_DMCS_THA') {
            window.opener.HandlePopupResult('CITYCD', result);
        } 
        else if(page == 'TAXDETAILENTRY') {
            window.opener.HandlePopupResultMultiple('CITYCD', result,'COUNTRYCD',result2,'STATECD',result3);
        } 
        else {
            window.opener.HandlePopupResult('CITYCD', result);
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

    // refresh
    window.location.href = 'index.php';

    return false;
}