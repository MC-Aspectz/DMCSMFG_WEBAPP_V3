

var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var MATERIALCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        MATERIALCD = item.eq(1).text();
        $('#MATERIALCODE').html(item.eq(1).text());
        $('#MATERIALNAME').html(item.eq(2).text());
        $('#MATERIALPARENTCD').html(item.eq(3).text());
        $('#MATERIALSPEC').html(item.eq(4).text());
        $('#MATERIALNOTE').html(item.eq(5).text());
    }

    $('#select_item').on('click', function() {
        $('#loading').show();
        return HandleResult(MATERIALCD);
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
        window.opener.HandlePopupResult('MATERIALCD', result);
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

    // clearing table empty Row
    $('#table_result > tbody > tr').remove();
    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="divide-y divide-gray-200">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';
    
    return false;
}