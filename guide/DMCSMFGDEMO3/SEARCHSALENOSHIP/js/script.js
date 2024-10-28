// search Icon
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHITEM = $('#SEARCHITEM');

SEARCHSTAFF.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SEARCHSALENOSHIP');
SEARCHCUSTOMER.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SEARCHSALENOSHIP');
SEARCHITEM.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SEARCHSALENOSHIP');

const STAFFCD = $('#STAFFCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const ITEMCODE = $('#ITEMCODE');

const input_serach = [STAFFCD, CUSTOMERCD, ITEMCODE];

// form
const form = document.getElementById('shipReqSaleOrderGuide');

for(const input of input_serach) {
    input.on('keyup change', function(e) {
        if(e.type === 'change') {
            $('#loading').show();
        } else if( e.key === 'Enter' || e.keyCode === 13) {
            $('#loading').show();
        }
    });
};

STAFFCD.on('keyup change', function(e) {
    return getElement('STAFFCD', STAFFCD.val());
});

CUSTOMERCD.on('keyup change', function(e) {
    return getElement('CUSTOMERCD', CUSTOMERCD.val());
});

ITEMCODE.on('keyup change', function(e) {
    return getElement('ITEMCODE', ITEMCODE.val());
});

var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var SALEORDERNO;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        SALEORDERNO = item.eq(0).text();
    }

    $('#select_item').on('click', function() {
        return HandleResult(SALEORDERNO);
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#back').on('click', async function() {
    // window.history.back();
    await unsetSession(form);
    return window.close();
});

async function HandleResult(result) {
    try {
        await unsetSession(form);
        window.opener.HandlePopupResult('SALEORDERNO', result);
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../SEARCHSALENOSHIP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                } 
            });
        }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../SEARCHSALENOSHIP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
        $('#loading').hide();
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
        $('#table_result tbody').append('<tr class="flex w-full p-0 divide-x">' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-1/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}

function onSearch(Parameter) {
    const param = $('#'+Parameter+'');
    param.on('keyup change', function(event) {
        if(event.type === 'change') {
            window.location.href='index.php?'+Parameter+'=' + param.val();
        } else if(event.key === 'Enter' || event.keyCode === 13) {
            window.location.href='index.php?'+Parameter+'=' + param.val();
        }
    });
}
