var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var APPCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        APPCD = item.eq(1).text();
    }

    $("#select_item").on('click', function() {
        return HandleResult(APPCD);
        // window.location.href=$('#routeUrl').val() + item.eq(1).text() +'&index='+ $("#index").val();
    });
});

$("#back").on('click', function() {
    // window.history.back();
    return window.close();
});

function HandleResult(result) {
    try {
        if(page == 'APPLICATION') {
            window.opener.HandlePopupResult('appcd', result);    
        } else {
            window.opener.HandlePopupResult('APPCD', result);    
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}
