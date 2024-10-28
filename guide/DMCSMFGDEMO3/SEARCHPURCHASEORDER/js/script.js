// search Icon
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHDIVISION = $('#SEARCHDIVISION');

SEARCHSUPPLIER.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=SEARCHPURCHASEORDER');
SEARCHITEM.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SEARCHPURCHASEORDER');
SEARCHDIVISION.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=SEARCHPURCHASEORDER');

const P2 = $('#P2');
const P3 = $('#P3');
const DIVISIONCD = $('#DIVISIONCD');

const input_serach = [P2, P3, DIVISIONCD];

for(const input of input_serach) {
    input.on('keyup change', function(e) {
        if(e.type === 'change') {
            $("#loading").show();
        } else if( e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

P2.on('keyup change', function(e) {
    if(e.type === 'change') {
        window.location.href="index.php?P2=" + P2.val();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?P2=" + P2.val();
    }
});

P3.on('keyup change', function(e) {
    if(e.type === 'change') {
        window.location.href="index.php?P3=" + P3.val();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?P3=" + P3.val();
    }
});

DIVISIONCD.on('keyup change', function(e) {
    if(e.type === 'change') {
        window.location.href="index.php?DIVISIONCD=" + DIVISIONCD.val();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?DIVISIONCD=" + DIVISIONCD.val();
    }
});

var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var PONO;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        PONO = item.eq(0).text();
        $('#PURCHASEORDERNO').html(item.eq(0).text());
        $('#LINE').html(item.eq(1).text());
        $('#ITEMCODE').html(item.eq(2).text());
        $('#ITEMNAME').html(item.eq(3).text());
        $('#ISSUE_DATE').html(item.eq(4).text());
        $('#DUE_DATE').html(item.eq(5).text());
        $('#SALEORDERNO').html(item.eq(6).text());
    }

    $('#select_item').on('click', function() {
        return HandleResult(PONO);
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    // window.history.back();
    return window.close();
});

function HandleResult(result) {
    try {
        window.opener.HandlePopupResult('PONO', result);
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

    await axios.post('../SEARCHPURCHASEORDER/function/index_x.php', data)
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
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td></tr>');
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
