// button search
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');

// form
const form = document.getElementById('InqJobResult');

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    return submitSearch();
});

var isItem = false;
$('table#table tr').click(function () {
    $('table#table tr').removeAttr('id')
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        $(this).attr('id', 'selected-row');
        isItem = true;
        $('#JOB_CARD_NO').html(item.eq(0).text());
        $('#LINE').html(item.eq(1).text());
        $('#ITEMCODE').html(item.eq(2).text());
        $('#ITEMNAME').html(item.eq(3).text());
        $('#SPECIFICATE').html(item.eq(4).text());
        $('#PRODUCT_ORDER_QTY').html(item.eq(5).text());
        $('#PROD_DUE_DATE').html(item.eq(6).text());
        $('#PRODUCTIONORDER').html(item.eq(7).text());
        $('#ROUT_NO').html(item.eq(8).text());
        $('#INPUT_DATE').html(item.eq(9).text());
        $('#JOB_TYPE').html(item.eq(10).text());
        $('#WC_CODE').html(item.eq(11).text());
        $('#WORK_CENTER_NAME').html(item.eq(12).text());
        $('#PERSON_RESPONSE').html(item.eq(13).text());
        $('#STAFF_NAME').html(item.eq(14).text());
        $('#JOB_CODE').html(item.eq(15).text());
        $('#MEMO').html(item.eq(16).text());
        $('#COMP_QTY').html(item.eq(17).text());
        $('#JOB_TIME').html(item.eq(18).text());
        $('#UNIT_TIME').html(item.eq(19).text());
        $('#WORK_DAY').html(item.eq(20).text());
        $('#STARTTIME').html(item.eq(21).text());
        $('#ENDTIME').html(item.eq(22).text());
        $('#STATUS').html(item.eq(23).text());
        $('#MEMBERS').html(item.eq(24).text());
    }
});

$('#DETAIL').on('click', function() {
    if(isItem) {
        $('#modal-view').modal('show');
    }
});

async function submitSearch() {
    $('#loading').show();
    const form = document.getElementById('InqJobResult');
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
}

CSV.click(function() {
    return exportCSV();
});

async function exportCSV() {
    // Variable to store the final csv data
    let P1 = '--/--/----';
    let P2 = '--/--/----';
    if($('#P1').val() != '') { P1 = $('#P1').val(); }
    if($('#P2').val() != '') { P2 = $('#P2').val(); }
    let INPUTDATE_LB = (document.getElementById('INPUTDATE_LB').innerText || document.getElementById('INPUTDATE_LB').textContent);
    var csv_data = [ INPUTDATE_LB + ',' + P1 + ',→,' + P2];

    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            csvrow.push("\""+el.innerText+"\"");
        });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../INQ_JOBRESULT_01/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'INQ_JOBRESULT_01');
    await axios.post('../INQ_JOBRESULT_01/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch((e) => {
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
    for (var i = 0; i <selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table
    $('#table > tbody > tr').remove();

    // refresh
    window.location.href = 'index.php';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({
    title: '',
    text: txt,
    showCancelButton: true,
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
            if (type == 1) {
                return closeApp($('#appcode').val()); 
            }
        }
    });
}

function unRequired() {
    document.getElementById('P2').classList[document.getElementById('P2').value !== '' ? 'remove' : 'add']('req');
}