var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var DELIVERYCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        DELIVERYCD = item.eq(0).text();

        $('#DELIVERYCD').html(item.eq(0).text());
        $('#DELIVERYNAME').html(item.eq(1).text());
        $('#DELIVERYSEARCH').html(item.eq(2).text());
    }

    $('#select_item').on('click', function() {
        return HandleResult(DELIVERYCD);
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#back').on('click', async function() {
    // window.history.back();
    await unsetSession();
    return window.close();
});

async function HandleResult(result) {
    try {
        window.opener.HandlePopupResult('DELIVERYCD', result);
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}


async function unsetSession() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../SEARCHDELIVERY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm();
        $('#loading').hide();
    })
    .catch(e => {
        console.log(e);
    });
}

async function clearForm() {
    // clearing inputs
    const form = document.getElementById('shipReqSaleOrderGuide');
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'date':
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
        $('#table_result tbody').append('<tr class="row-empty">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}