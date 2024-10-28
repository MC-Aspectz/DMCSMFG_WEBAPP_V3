var isItem = false;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        // console.log(item.eq(0).text());
        $('#GUIDEPREOBJ').html(item.eq(0).text());
        $('#GUIDEPREDEF').html(item.eq(1).text());
    }

    $("#select_item").on('click', function() {
        window.location.href=$('#routeUrl').val() + item.eq(0).text();
    });
});

$("#view_item").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    // window.history.back();
    window.location.href=$('#routeUrl').val();
});

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
    window.location.href = 'index.php';

    return false;
}