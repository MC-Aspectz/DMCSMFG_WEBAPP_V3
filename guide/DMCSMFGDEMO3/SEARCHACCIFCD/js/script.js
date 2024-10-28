var page = $('#page').val();
var index = $('#index').val();

var isItem = false;
var ACCIFCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        ACCIFCD = item.eq(1).text();
    }
    // console.log(item.eq(1).text());
    $('#select_item').on('click', function() {
        return HandleResult(ACCIFCD);
    });
});

$('#back').on('click', function() {
    return window.close();
});

function HandleResult(result) {
    try {
        if(page == 'ACCIFCDMASTER1') {
            window.opener.HandlePopupResult('ACCIFCD_S', result); 
        } else if(page == 'ACCIFSETUP') {
            window.opener.HandlePopupResult('ITEMTYP', result); 
        } else {
            window.opener.HandlePopupResult('ACCIFCD', result);       
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}
