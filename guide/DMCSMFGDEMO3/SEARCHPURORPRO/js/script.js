const SEARCHITEM = $('#SEARCHITEM');

SEARCHITEM.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SEARCHPURORPRO');
 
const P1 = $('#P1');

P1.on('keyup change', function(e) {
    if(e.type === 'change' || (e.key === 'Enter' || e.keyCode === 13)) {
        $("#loading").show();
        window.location.href='index.php?P2=' + P2.val();
    }
});

var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var ODRNO;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        ODRNO = item.eq(0).text();
        $('#orderno').html(item.eq(0).text());
        $('#issuedate').html(item.eq(1).text());
        $('#item').html(item.eq(2).text());
        $('#itemname').html(item.eq(3).text());
        $('#salesorderno').html(item.eq(4).text());
        $('#requireddate').html(item.eq(5).text());
    }
    
    $('#select_item').on('click', function() {
        $('#loading').show();
        return HandleResult(ODRNO);
    });
});


$('#view_item').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    


$('#back').on('click', function() {
    // window.history.back();
    unsetSession(this.form);
    if(page == 'SEARCHPURCHASEORDER') {
        return window.location.href=$('#sessionUrl').val() + '/guide/SEARCHPURCHASEORDER/index.php';
    } else {
        return window.close();
    }
    
});

function HandleResult(result) {
    try {
        if(page == 'ORDERBMENTRY') {
            window.opener.HandlePopupResult('ALLOCORDERNO', result);
        } else {
            window.opener.HandlePopupResult('ODRNO', result);
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

async function unsetSession(form) {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../SEARCHPURORPRO/function/index_x.php', data)
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
        $('#table_result tbody').append('<tr class="divide-y divide-gray-200">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}
