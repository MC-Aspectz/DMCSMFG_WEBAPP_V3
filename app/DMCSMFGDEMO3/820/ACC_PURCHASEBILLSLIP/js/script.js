// icon
const SEARCHPBILLSLIP_ACC = $('#SEARCHPBILLSLIP_ACC');
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHDIVISION = $('#SEARCHDIVISION');


SEARCHPBILLSLIP_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPBILLSLIP_ACC/index.php?page=ACC_PURCHASEBILLSLIP', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_PURCHASEBILLSLIP', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_PURCHASEBILLSLIP', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_PURCHASEBILLSLIP', 'authWindow', 'width=1200,height=600');});


const serach_icon = [SEARCHSUPPLIER, SEARCHCURRENCY, SEARCHDIVISION];

// input
const BILLNO = $('#BILLNO');
const SUPPLIERCD = $('#SUPPLIERCD');
const SUPCURCD = $('#SUPCURCD');
const DIVISIONCD = $('#DIVISIONCD');

const input_serach = [ BILLNO, SUPPLIERCD, SUPPLIERCD, DIVISIONCD];

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('accPurBilling');

for (const input of input_serach) {
    input.on('keyup change', async function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            await keepData();
        }
    });
}

for(const icon of serach_icon){
    icon.click(function () {
        keepData();
    });
};

SEARCH.click(async function() {
    if (!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
    await keepData();
    let action = document.createElement('input');
    action.setAttribute('name', 'action');
    action.setAttribute('value', 'SEARCH');
    form.appendChild(action);
    form.submit();
 });


COMMIT.click(async function() {
    if (!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    return actionDialog(2);
});

CANCEL.click(async function() {
    return actionDialog(3);
});

PRINT.click(async function() {
    return actionDialog(4);
});

BILLNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('BILLNO', BILLNO.val());
    }
});

SUPPLIERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERCD', SUPPLIERCD.val());
    }
});

SUPCURCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPCURCD', SUPCURCD.val());
    }
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_PURCHASEBILLSLIP/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_PURCHASEBILLSLIP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
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

async function action(method) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../ACC_PURCHASEBILLSLIP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            if (method == 'commit') {
                if(response.data['BILLNO'] != undefined) {
                    window.location.href = "index.php?BILLNO=" + response.data['BILLNO'];
                } else {
                    actionDialog(response.data);
                }
            } else if(method == 'cancel') {
                window.location.reload();
            }
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'print');
    await axios.post('../ACC_PURCHASEBILLSLIP/function/index_x.php', data)
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

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_PURCHASEBILLSLIP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_PURCHASEBILLSLIP');

    await axios.post('../ACC_PURCHASEBILLSLIP/function/index_x.php', data)
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
            } else if(type == 2) {
                return action('commit');
            } else if(type == 3) {
                return action('cancel');
            } else if(type == 4) {
                return printed();
            }
        }
    });
}

function alertWarning(msg, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: msg,
        showCancelButton: false,
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
            if (result.isConfirmed) {
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
    window.location.href = '../ACC_PURCHASEBILLSLIP/';
    // emptyTable();
    // $(':checkbox').bind('click', true);

    return false;
}

function unRequired() {
    document.getElementById('P1').classList[document.getElementById('P1').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPCURCD').classList[document.getElementById('SUPCURCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERCD').classList[document.getElementById('SUPPLIERCD').value !== '' ? 'remove' : 'add']('req');
}

function emptyTable() {
    $('#dvwdetail').empty();
    for (var i = 1; i <= 10; i++) {
        $('#dvwdetail').append( '<tr class="flex w-full p-0 divide-x row-empty" id="rowId'+i+'">'+
                                    '<td class="h-6 w-16 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-24 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-24 py-2"></td>'+
                                '</tr>');
    }
    document.querySelector('#rowCount').innerText = '0';
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        $('#dvwdetail').append( '<tr class="flex w-full p-0 divide-x row-empty" id="rowId'+x+'">'+
                                    '<td class="h-6 w-16 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-24 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-24 py-2"></td>'+
                                '</tr>');
    }
}
// async function printed() {
//     await keepData();
//     var popupWindow = window.open('../ACC_PURCHASEBILLSLIP/print.php', '_blank', 'width=800, height=800');
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }