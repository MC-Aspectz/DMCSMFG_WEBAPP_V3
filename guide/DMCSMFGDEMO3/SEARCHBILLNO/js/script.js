const SEARCHCUSTOMER = $("#SEARCHCUSTOMER");
SEARCHCUSTOMER.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SEARCHBILLNO&pageUrl=' + $('#guideUrl').val());

var page = $('#page').val();
var index = $('#index').val();
const CD = $("#CD");
var BILLNO;
// form
const form = document.getElementById('billno');

CD.on('keyup change', function(e) {
    if(e.type === 'change') {
        $("#loading").show();
        window.location.href="index.php?CD=" + CD.val();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        $("#loading").show();
        window.location.href="index.php?CD=" + CD.val();
    }
});

var isItem = false;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');

    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        BILLNO = item.eq(1).text();
        $("#BILLNO").html(item.eq(1).text());
        $("#CUSTOMERCD").html(item.eq(2).text());
        $("#CUSTOMERNAME").html(item.eq(3).text());
        $("#INSPDATE").html(item.eq(4).text());
        $("#STATUS").html(item.eq(5).text());
    }
    // console.log(item.eq(1).text());
    $('#SELECT').on('click', function() {
        return HandleResult(BILLNO);
        // window.location.href=$('#routeUrl').val() + BILLNO;
    });
});

$('#DETAIL').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');   
    }
});    

$('#BACK').on('click', function() {
    return window.close();
});

function HandleResult(result) {
    try {
        window.opener.HandlePopupResult('BILLNO', result);
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
    data.append('systemName', 'SEARCHBILLNO');

    await axios.post('../SEARCHBILLNO/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
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
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-3/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-2/12"></td>' +
                                        '<td class="h-6 w-1/12"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}