// search
const SEARCHPURCHASEREQUEST = $('#SEARCHPURCHASEREQUEST');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');

SEARCHPURCHASEREQUEST.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEREQUEST/index.php?page=ACC_PURCHASEREQUISITION_THA', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_PURCHASEREQUISITION_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_PURCHASEREQUISITION_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_PURCHASEREQUISITION_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHPURCHASEREQUEST, SEARCHDIVISION, SEARCHSTAFF, SEARCHSUPPLIER];

//input serach
const PURREQNO = $('#PURREQNO');
const DIVISIONCD = $('#DIVISIONCD');
const STAFFCD = $('#STAFFCD');
const SUPCD = $('#SUPCD');
const PURREQDUEDT = $('#PURREQDUEDT');

const input_serach = [ DIVISIONCD, STAFFCD, SUPCD];

// action button
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('purchaseRequisition');

for (const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
}

for (const input of input_serach) {
    input.on('keyup change', async function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            await keepData();
        }
    });
}

// action
COMMIT.click(function () {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return actionDialog(3);
    // form.submit();
});

CANCEL.click(function () {
    return actionDialog(4);
});

PRINT.click(function () {
    return actionDialog(2);
    // return printAction();
});

PURREQNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PURREQNO', PURREQNO.val());
    }
    if (PURREQNO.val() == '') unsetSession(form);
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

SUPCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPCD', SUPCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_PURCHASEREQUISITION_THA/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });
        }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getElementIndex(code, value, index) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('index', index);
    data.append('action', code);
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+index+'')) {
                    document.getElementById(''+key+index+'').value = value;
                }
            });
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(action) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == 200) {
            if (action == 'commit') {
                let result = response.data;
                if(objectArray(result)) {
                    return window.location.href = 'index.php?PURREQNO=' + result['PURREQNO'];
                } else {
                    return getMessage(result.replace('ERRO:',''));
                }
            } else {
                return window.location.reload();
            }
            document.getElementById('loading').style.display = 'none';
        }
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'print');
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(result, function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function getMessage(code) {
    $('#loading').show();
    const appurl = $('#sessionUrl').val();
    const data = new FormData(form);
    data.append('CODE', code);
    data.append('MESSAGE', 'getMessage');
    await axios.post(appurl + '/common/setsession.php', data)
    .then(response => {
        // console.log(response.data);
        document.getElementById('loading').style.display = 'none';
        return actionDialog(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_PURCHASEREQUISITION_THA');
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSessionItem(lineIndex) {
    let data = new FormData();
    data.append('action', 'unsetsessionItem');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        return window.location.href = '../ACC_PURCHASEREQUISITION_THA/index.php';
        // window.location.reload();
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
        case 'radio':
        case 'checkbox':
            inputs[i].checked = false;
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

    // clearing textarea
    var text = form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

    // clearing table
    // $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = '../ACC_PURCHASEREQUISITION_THA/';

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
        } else if (type == 2) {
            return printed();
        } else if (type == 3) {
            return action('commit');
        } else if (type == 4) {
            return action('cancel');
        }
    }
    });
}

function changeRowIds() {
    var elem = document.getElementsByTagName('tr');
    for (var i = 0; i < elem.length; i++) {
        // console.log(i);
        if (elem[i].id) {
            index_x = Number(elem[i].rowIndex);
            elem[i].id = 'rowId' + index_x;
        }
    }
}

function emptyRow(n) {
  $('table tbody').append('<tr class="row-empty" id="rowId' + n +">" +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td></tr>');
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'row-empty');
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function unRequired() {
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PURREQDUEDT').classList[document.getElementById('PURREQDUEDT').value !== '' ? 'remove' : 'add']('req');
}

function itemValidation(error, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: error,
        showCancelButton: false,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
          //
        }
    });
}


// function printReport() {
//   var popupWindow = window.open('../ACC_PURCHASEREQUISITION_THA/print.php', '_blank', 'width=auto, height=auto');
//   setTimeout(function () {
//     popupWindow.close();
//   }, 10000);

//   // var printReport = document.getElementById('printReport');
//   // var popupWindow = window.open('', '_blank', 'width=auto, height=auto');
//   // // var popupWindow = window.open('../ACC_PURCHASEREQUISITION_THA/function/index_x.php', '_blank', 'width=auto, height=auto');
//   // popupWindow.document.open();
//   // // popupWindow.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link type="text/css" href="./css/print.css" media="print" rel="stylesheet"></head>');
//   // popupWindow.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link type="text/css" href="./css/print.css" rel="stylesheet"></head>');
//   // popupWindow.document.write('<body onload="window.print()">' + printReport.innerHTML + '</body></html>');
//   // // popupWindow.document.write('<body>' + printReport.innerHTML + '</body></html>');
//   // popupWindow.document.close();
//   // setTimeout(function() { popupWindow.close(); }, 1000);
// }

function require_once(filename) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
          // console.log(this.responseText);
        }
    };
    xhr.open('GET', filename, true);
    xhr.send();
}