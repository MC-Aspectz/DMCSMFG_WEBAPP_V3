// button search
const SEARCHITEM = $('#SEARCHITEM');
SEARCHITEM.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SEARCHPRODUCTIONORDER');

// input search
const P3 = $('#P3');

P3.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        $('#loading').show();
        return window.location.href='index.php?P3=' + P3.val();
    }
});

var isItem = false;
var page = $('#page').val();
var PROORDERNO;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        PROORDERNO = item.eq(1).text();
        $('#production').html(item.eq(1).text());
        $('#entrydate').html(item.eq(2).text());
        $('#itemcode').html(item.eq(3).text());
        $('#itemname').html(item.eq(4).text());
        $('#specification').html(item.eq(5).text());
        $('#referenceno').html(item.eq(6).text());
        $('#planned').html(item.eq(7).text());
        $('#estimatedduedate').html(item.eq(8).text());
    }
    
    $('#select_item').on('click', function() {
        if(isItem) {
            $('#loading').show();
            return HandleResult(PROORDERNO);
        }
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
        if(page == 'INQ_PROCESS') {
            window.opener.HandlePopupResult('P1', result);
        } else {
            window.opener.HandlePopupResult('PROORDERNO', result);
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
    // window.location.href = 'index.php';

    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="w-full p-0 divide-x">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
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