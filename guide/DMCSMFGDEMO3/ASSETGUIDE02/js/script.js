var page = $('#page').val();
var index = $('#index').val();

const ASSETACCGUIDE = $('#ASSETACCGUIDE');
ASSETACCGUIDE.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETACCGUIDE/index.php?page=ASSETGUIDE&pageUrl=' + $('#guideUrl').val());

var ASSETCD = $('#ASSETCD');
var ASSETACC = $('#ASSETACC');
var isItem = false;

ASSETACC.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        $('#loading').show();
        return window.location.href='index.php?ASSETACC=' + ASSETACC.val();
    }
});

$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');

    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        ASSETCD = item.eq(1).text();
    }
    // console.log(item.eq(1).text());
    $('#SELECT').on('click', function() {
        //  window.location.href=$('#routeUrl').val() + item.eq(1).text() + '&index=' + $('#index').val();
        return HandleResult(ASSETCD);

    });
});

$('#back').on('click', function() {
    return window.close();
});

function HandleResult(result) {
    try {
        if(page == 'index') {
           window.opener.HandlePopupResultIndex('ASSETCD',result, index);   
        } else {
            window.opener.HandlePopupResult('ASSETCD', result);    
        }
    } catch (err) {
        console.log(err);
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
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-3/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}