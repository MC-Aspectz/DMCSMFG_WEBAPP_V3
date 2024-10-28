var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var BANKCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        BANKCD = item.eq(1).text();
    }

    $("#select_item").on('click', function() {
        return HandleResult(BANKCD);
    });
});

function HandleResult(result) {
    try {
        if(page == 'BANKBRANCHMASTER') {
            window.opener.HandlePopupResult('BANKCD', result);
        } else {
            window.opener.HandlePopupResult('BANKCD', result);
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

$("#back").on('click', function() {
    // window.history.back();
    return window.close();
});