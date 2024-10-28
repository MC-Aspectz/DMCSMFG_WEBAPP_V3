// 
var page = $('#page').val();

var SHIPTRANORDERNO;
var SHIPTRANORDERLN;
var isItem = false;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        SHIPTRANORDERNO = item.eq(0).text();
        SHIPTRANORDERLN = item.eq(1).text();
        $('#VOUCHER_NO').html(item.eq(0).text());
        $('#LINE').html(item.eq(1).text());
        $('#SHIP_DATE').html(item.eq(2).text());
        $('#SALES_ORDER_NO').html(item.eq(3).text());
    }
    
    $('#select_item').on('click', function() {
        $('#loading').show();
        if(page == 'SHIPMENTENTRY') { 
            return HandleResultLN(SHIPTRANORDERNO, SHIPTRANORDERLN);
        } else {
            return HandleResult(SHIPTRANORDERNO);
        }
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});      

$('#back').on('click', async function() {
    // window.history.back();
    return window.close();
});

async function HandleResult(result) {
    try {
        window.opener.HandlePopupResult('SHIPTRANORDERNO', result);
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

async function HandleResultLN(SHIPTRANORDERNO, SHIPTRANORDERLN) {
    try {
        window.opener.HandleResultLN(SHIPTRANORDERNO, SHIPTRANORDERLN);
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../SEARCHSHIPTRAN/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
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
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-7/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}