// icon
const SEARCHBILLNO = $('#SEARCHBILLNO');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHDIVISION = $('#SEARCHDIVISION');

SEARCHBILLNO.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHBILLNO/index.php?page=ACC_BILLSLIPENTRY', 'authWindow', 'width=1200,height=600');});

SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_BILLSLIPENTRY', 'authWindow', 'width=1200,height=600');});

SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_BILLSLIPENTRY', 'authWindow', 'width=1200,height=600');});

SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_BILLSLIPENTRY', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHBILLNO, SEARCHDIVISION, SEARCHCUSTOMER, SEARCHCURRENCY];

// input
const BILLNO = $('#BILLNO');
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const DIVISIONCD = $('#DIVISIONCD');

const input_serach = [ DIVISIONCD, CUSTOMERCD, CUSCURCD];

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('accBilling');

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
            $('#loading').show();
        }
    });
}

for (const input of serach_icon) {
  input.click(function () {
    keepData();
  });
}

SEARCHDIVISION.click(function () {
    keepData();
});

SEARCH.click(async function() {
    $('#loading').show();
    await keepData();
});

COMMIT.click(async function() {
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

CUSTOMERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

CUSCURCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSCURCD', CUSCURCD.val());
    }
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

async function getSearch(code, value) {
  $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_BILLSLIPENTRY/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_SALEENTRY_THA3/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(result != '') {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(value != '') {
                    document.getElementById(''+key+'').value = value;
                } 
            });
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(method) {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../ACC_BILLSLIPENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == "200") {
            if (method == 'commit') {
                if(response.data["BILLNO"] != undefined) {
                    window.location.href = "index.php?BILLNO=" + response.data["BILLNO"];
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
    await axios.post('../ACC_BILLSLIPENTRY/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(response.data, function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}


async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_BILLSLIPENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_BILLSLIPENTRY');

    await axios.post('../ACC_BILLSLIPENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
    $('#loading').show();
    const appurl = $('#sessionUrl').val();
    let data = new FormData();
    data.append('PROGRAMDELETE', 'programDelete');
    await axios.post(appurl + '/common/setsession.php', data)
    .then(response => {
        // console.log(response.data)
        return window.location.href = $('#sessionUrl').val() + '/home.php';
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
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                unsetSession(form); 
                programDelete(); 
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
        // background: '#8ca3a3',
        showCancelButton: false,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
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
    window.location.href = '../ACC_BILLSLIPENTRY/';
    // emptyTable();
    // $(":checkbox").bind("click", true);

    return false;
}

function emptyTable() {
    $('#dvwdetail').empty();
    for (var i = 1; i <= 10; i++) {
        $('#dvwdetail').append( '<tr class="flex w-full p-0 divide-x" id="rowId'+i+'">'+
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
                                    '<td class="h-6 w-32 py-2"></td>'+
                                    '<td class="h-6 w-24 py-2"></td>'+
                                '</tr>');
    }
    document.querySelector('#rowCount').innerText = '0';
}

function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}

// async function printed() {
//     await keepData();
//     var popupWindow = window.open('../ACC_BILLSLIPENTRY/print.php', '_blank', 'width=800, height=800');
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }