var page = page;
var index = $('#index').val();

var isItem = false;
var ASSETACC;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');

    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        ASSETACC = item.eq(1).text();
    }
    // console.log(item.eq(1).text());
    $('#SELECT').on('click', function() {
        if(page == 'ASSETGUIDE' || page == 'ASSETACCGUIDE') {
            window.location.href= $('#pageUrl').val() +'?ASSETACC=' + ASSETACC;  
        } else {
            return HandleResult(ASSETACC);
        }
    });
});

$('#back').on('click', function() {
    if(page == 'ASSETGUIDE' || page == 'ASSETACCGUIDE') {
       return window.location.href = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/'+ page +'/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'ACC_ASSETDEPLISTPRINT') {
           window.opener.HandlePopupResultIndex('ASSETACC',result, index);   
        } else {
            window.opener.HandlePopupResult('ASSETACC', result);    
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
    for (var i = 0; i < selects.length; i++)
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
                                        '<td class="h-6 w-5/12"></td>' +
                                        '<td class="h-6 w-5/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    // refresh
    // window.location.href = 'index.php';

    return false;
}