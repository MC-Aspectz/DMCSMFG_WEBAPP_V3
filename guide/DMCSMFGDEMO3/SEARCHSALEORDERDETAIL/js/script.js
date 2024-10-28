// 
var page = $('#page').val();

var SALEORDERNOLN;
var isItem = false;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        SALEORDERNOLN = item.eq(1).text();
        $('#saleorderno').html(item.eq(1).text());
        $('#customercode').html(item.eq(2).text());
        $('#customername').html(item.eq(3).text());
        $('#itemname').html(item.eq(4).text());
        $('#itemcode').html(item.eq(5).text());
        $('#duedate').html(item.eq(6).text());
    }
    
    $('#select_item').on('click', function() {
        $('#loading').show();
        return HandleResult(SALEORDERNOLN);
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
        if(page == 'NEWSHIPREQUESTENTRY' || page == 'SHIPREQUESTCANCEL' || page == 'NEWSHIPENTRY' || page == 'NEWSHIPENTRY_MFG' || page == 'NEWSHIPREQUESTENTRY_MFG') {
            window.opener.HandlePopupResult('SALEORDERNUMBER_S', result);
        } else {
            window.opener.HandlePopupResult('SALEORDERNOLN', result);
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
        $('#table_result tbody').append('<tr class="flex w-full p-0 divide-x">' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-1/12"></td>' +
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-1/12"></td></tr>');
    }
    
    return false;
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [day, month, year].join('-');
}