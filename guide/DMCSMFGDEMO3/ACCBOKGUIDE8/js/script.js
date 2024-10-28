const SEARCHSTAFF = $('#SEARCHSTAFF');
SEARCHSTAFF.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACCBOKGUIDE8&pageUrl=' + $('#guideUrl').val());

const STAFFCD = $("#STAFFCD");

STAFFCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        $('#loading').show();
        return window.location.href='index.php?STAFFCD=' + STAFFCD.val();
    }
});

var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var VOUCHERNO;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');

    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        VOUCHERNO = item.eq(1).text();
    }
    // console.log(item.eq(1).text());
    $('#SELECT').on('click', function() {
        return HandleResult(VOUCHERNO);
         // window.location.href=$('#routeUrl').val() + item.eq(1).text() + '&index=' + $('#index').val();
    });
});

$('#BACK').on('click', function() {
    return window.close();
});

function HandleResult(result) {
    try {
        if (page == 'ACC_PETTYCASHVO_THA') {
            window.opener.HandlePopupResult('BOOKORDERNO', result);
        } else {
            window.opener.HandlePopupResult('VOUCHERNO', result);
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