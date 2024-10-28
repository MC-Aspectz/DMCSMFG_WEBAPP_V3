const SEARCHSALEORDER = $("#SEARCHSALEORDER");
SEARCHSALEORDER.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SEARCHQUOTE');

const P1 = $('#P1');

const SEARCH = $('#SEARCH');

const form = document.getElementById('quotationindex');
var page = $('#page').val();

P1.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('P1', P1.val());
    }
});

SEARCH.click(async function() {
    // check validate form
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

var isItem = false;
var ESTNO;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        ESTNO = item.eq(1).text();
    }

    $('#ESTIMATE_NO').html(item.eq(1).text());
    $('#CUSTOMERCODE').html(item.eq(2).text());
    $('#CUSTOMERNAME').html(item.eq(3).text());
    $('#ESTTMNAME').html(item.eq(4).text());
    $('#DELI_PLACE').html(item.eq(5).text());
    $('#DELE_PLACE_NAME').html(item.eq(6).text());
    
    $('#select_item').on('click', function() {
        $('#loading').show();
        return HandleResult(ESTNO);
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    return window.close();
});


function HandleResult(result) {
    try {
        if(page == 'ACC_SALEQUOTEENTRY_THA_CLONE') {
            window.opener.HandlePopupResult('ESTNOCLONE', result);
        } else {
            window.opener.HandlePopupResult('ESTNO', result);
        }
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
    await axios.post('../SEARCHQUOTE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });
        } else {
            document.getElementById('P1').value = '';
            document.getElementById('P1NAME').value = '';
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

    // function HandlePopupResult(code, result) {
    //     // console.log("result of popup is: " + code + ' : ' + result);
    //     return getElement(code, result);
    // }


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

    // // clearing table empty Row
    // $('#table_result > tbody > tr').remove();
    // for (var i = 0; i < 10; i++) {
    //     $('#table_result tbody').append('<tr class="row-empty" id="rowId'+i+'">' +
    //                                     '<td class="h-6 border border-slate-700"></td>' +
    //                                     '<td class="h-6 border border-slate-700"></td>' +
    //                                     '<td class="h-6 border border-slate-700"></td>' +
    //                                     '<td class="h-6 border border-slate-700"></td>' +
    //                                     '<td class="h-6 border border-slate-700"></td>' +
    //                                     '<td class="h-6 border border-slate-700"></td></tr>');
    // }

    // document.getElementById('rowcount').innerHTML = '0';
    
    // refresh
    window.location.href = 'index.php';
    return false;
}