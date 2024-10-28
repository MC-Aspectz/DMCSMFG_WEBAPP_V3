// icon
const SEARCHSALEORDER = $('#SEARCHSALEORDER');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHCATALOG = $('#SEARCHCATALOG');

SEARCHSALEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=SHIPREQUESTVOUCHERPRINT', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SHIPREQUESTVOUCHERPRINT', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=SHIPREQUESTVOUCHERPRINT', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSALEORDER, SEARCHSTAFF, SEARCHCATALOG];

// input
const SALEORDERNUMBER_S = $('#SALEORDERNUMBER_S');
const STAFFCODE = $('#STAFFCODE');
const CATALOGCODE = $('#CATALOGCODE');

const input_serach = [ SALEORDERNUMBER_S, STAFFCODE, CATALOGCODE];

// action button
const SEARCH = $('#SEARCH');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('shipRequestVoucherPrint');

// for (const input of input_serach) {
//     input.on('keyup change', function (e) {
//         if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
//             $('#loading').show();
//         }
//     });
// }

for (const input of serach_icon) {
    input.click(function () {
        keepData();
    });
}

SEARCH.click(async function() {
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    await keepData();
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

PRINT.click(async function() {
    return printCheck();
});

// SALEORDERNUMBER_S.on('keyup change', function (e) {
//     if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
//         // keepData();
//         return getSearch('SALEORDERNUMBER_S', SALEORDERNUMBER_S.val());
//         // return $('#loading').hide();
//     }
// });

STAFFCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getElement('STAFFCODE', STAFFCODE.val());
    }
});

CATALOGCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getElement('CATALOGCODE', CATALOGCODE.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    SALEORDERNUMBER_S.val(value);
    return $('#loading').hide();
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../SHIPREQUESTVOUCHERPRINT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
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

async function action(method) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../SHIPREQUESTVOUCHERPRINT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            if(result['printStatic'] == 'ERRO:ERRONODATAPRINT') {
                printWarning();
            } else {
                $.each(response.data,function(key, value) {
                    // console.log(value.url);
                    downloader($('#sessionUrl').val() + value.url, value.filename);
                });
            }
           return unsetSession(form);
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function controlPrint() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'controlPrint');
    await axios.post('../SHIPPINGREQUESTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../SHIPREQUESTVOUCHERPRINT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'SHIPREQUESTVOUCHERPRINT');

    await axios.post('../SHIPREQUESTVOUCHERPRINT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                return closeApp($('#appcode').val()); 
            }
        }
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
    for (var i = 0; i < selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // refresh
    window.location.href = '../SHIPREQUESTVOUCHERPRINT/';
    // emptyTable();
    // $(":checkbox").bind("click", true);

    return false;
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 13; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}