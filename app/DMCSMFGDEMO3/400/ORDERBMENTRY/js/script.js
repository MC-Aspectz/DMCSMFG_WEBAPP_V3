// search
const SEARCHPURORPRO = $('#SEARCHPURORPRO');
const SEARCHMATERIAL = $('#SEARCHMATERIAL');
const SEARCHITEM1 = $('#SEARCHITEM1');
const SEARCHITEM2 = $('#SEARCHITEM2');

SEARCHPURORPRO.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURORPRO/index.php?page=ORDERBMENTRY&ALLOCORDERTYP=' + $('#ALLOCORDERTYP').val(), 'authWindow', 'width=1200,height=600');});
SEARCHMATERIAL.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHMATERIAL/index.php?page=ORDERBMENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHITEM1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ORDERBMENTRY&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHITEM2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ORDERBMENTRY&index=2', 'authWindow', 'width=1200,height=600');});

const ALLOCORDERTYP = $('#ALLOCORDERTYP');
const ALLOCORDERNO = $('#ALLOCORDERNO');
const ITEMCD = $('#ITEMCD');
const MATERIALCD = $('#MATERIALCD');
const PITEMCODE = $('#PITEMCODE');
const ALLOCORDERFLG = $('#ALLOCORDERFLG');
const SYSLD_BOMLOADAPP = $('#SYSLD_BOMLOADAPP');

const input_serach = [ALLOCORDERNO, ITEMCD, MATERIALCD, PITEMCODE];

// action button
const OK = $('#OK');
const CSV = $('#CSV');
const ORDER = $('#ORDER');
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const REMAKE = $('#REMAKE');

// form
const form = document.getElementById('orderbmentry');

const search_icon = [SEARCHPURORPRO, SEARCHMATERIAL, SEARCHITEM1, SEARCHITEM2, SEARCH, REMAKE];

for(const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

ALLOCORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('ALLOCORDERNO', ALLOCORDERNO.val());
    }
});

ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCD', ITEMCD.val());
    }
});

MATERIALCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('MATERIALCD', MATERIALCD.val());
    }
});

PITEMCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('PITEMCODE', PITEMCODE.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/ORDERBMENTRY/index.php?'+code+'=' + value + '&ALLOCORDERTYP=' + ALLOCORDERTYP.val();        
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
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
        // for (let key in result) {
        //   // console.log(key, '=>', result[key]);
        // }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

SEARCH.click(async function() {
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

REMAKE.click(async function() {
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'REMAKE';
    form.appendChild(action);
    form.submit();
});

COMMIT.click(function() {
    return action('commit');
});

ORDER.click(async function() {
    $('#loading').show(); await keepData(); await keepItemData();
    let ODRQTY = document.getElementById('ODRQTY').value;
    let ALLOCQTY = document.getElementById('ALLOCQTY').value;
    var param = {   ALLOCORDERFLG: document.getElementById('ALLOCORDERFLG').value,
                    ITEMCD: document.getElementById('ITEMCD').value,
                    ODRQTY: ODRQTY != '' ? ODRQTY.replaceAll(',', ''): 0,
                    ALLOCQTY: ALLOCQTY != '' ? ALLOCQTY.replaceAll(',', ''): 0,
                    ALLOCPURORDERNOLN: document.getElementById('ALLOCPURORDERNOLN').value || '',
                    ALLOCORDERTYP: document.getElementById('ALLOCORDERTYP').value,
                    ALLOCORDERNO: document.getElementById('ALLOCORDERNO').value,
                    // ACTION: 'ORDERBMENTRY'
                }
    // console.log(param);
    if(SYSLD_BOMLOADAPP.val() == 'PRODUCTIONORDERENTRY' && ITEMCD.val() != '' && ALLOCORDERFLG.val() == 1) {  // Production
        return $.redirect($('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/PRODUCTIONORDERENTRY/index.php', param);
    } else if(SYSLD_BOMLOADAPP.val() == 'PURCHASEORDERENTRY' && ITEMCD.val() != '' && ALLOCORDERFLG.val() == 2) { // Purchase
        return $.redirect($('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_PURCHSEORDERENTRY_THA/index.php', param);
    } else { 
        $('#loading').hide();
    }
    // $('#loading').hide();
});
        
CSV.click(function() {
    exportCSV();
});

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if (response.status == '200') {
            return clearForm(form);
        }
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function proOrPur() {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'proOrPur');
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let SYSENBOMLOADAPP = response.data['SYSEN_BOMLOADAPP'];
        let SYSLDBOMLOADAPP = response.data['SYSLD_BOMLOADAPP'];
        document.getElementById('SYSEN_BOMLOADAPP').value = SYSENBOMLOADAPP;
        document.getElementById('SYSLD_BOMLOADAPP').value = SYSLDBOMLOADAPP;
        document.getElementById('ORDER').classList[SYSENBOMLOADAPP == 'T' ? 'remove' : 'add']('read');
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function exportCSV() {

    let ORDER_NO_TXT = (document.getElementById('ORDER_NO_TXT').innerText || document.getElementById('ORDER_NO_TXT').textContent);
    let BMVERSIONLBL = (document.getElementById('BMVERSIONLBL').innerText || document.getElementById('BMVERSIONLBL').textContent);
    let DUE_DATE_TXT = (document.getElementById('DUE_DATE_TXT').innerText || document.getElementById('DUE_DATE_TXT').textContent);
    let ITEM_TXT = (document.getElementById('ITEM_TXT').innerText || document.getElementById('ITEM_TXT').textContent);
    let JOBPLACE_TXT = (document.getElementById('JOBPLACE_TXT').innerText || document.getElementById('JOBPLACE_TXT').textContent);
    let ORDER_QTY_PRO_TXT = (document.getElementById('ORDER_QTY_PRO_TXT').innerText || document.getElementById('ORDER_QTY_PRO_TXT').textContent);

    let ORDERDUEDT = '--/--/----'; if($('#ORDERDUEDT').val() != '') { ORDERDUEDT = dashFormatDate($('#ORDERDUEDT').val()); }
    let ALLOCPLANWDDT = '--/--/----'; if($('#ALLOCPLANWDDT').val() != '') { ALLOCPLANWDDT = dashFormatDate($('#ALLOCPLANWDDT').val()); }
    let ALLOCDRAWDT = '--/--/----'; if($('#ALLOCDRAWDT').val() != '') { ALLOCDRAWDT = dashFormatDate($('#ALLOCDRAWDT').val()); }

    var ALLOCORDERTYP = document.getElementById('ALLOCORDERTYP').options[document.getElementById('ALLOCORDERTYP').selectedIndex].text;
    var BMVERSION = document.getElementById('BMVERSION').options[document.getElementById('BMVERSION').selectedIndex].text;
    var ORDITEMUNITTYP = document.getElementById('ORDITEMUNITTYP').options[document.getElementById('ORDITEMUNITTYP').selectedIndex].text;
    var ITEMUNITTYP = document.getElementById('ITEMUNITTYP').options[document.getElementById('ITEMUNITTYP').selectedIndex].text;
    var ALLOCORDERFLG = document.getElementById('ALLOCORDERFLG').options[document.getElementById('ALLOCORDERFLG').selectedIndex].text;

    var csv_data = [  ORDER_NO_TXT + ',' + ALLOCORDERTYP + ',' + $('#ALLOCORDERNO').val() + ',' + BMVERSIONLBL + ',' + BMVERSION + ',' + DUE_DATE_TXT + ',' + ORDERDUEDT];
        csv_data.push(ITEM_TXT + ',' + $('#ODRITEMCD').val()  + ',' + $('#ODRITEMNAME').val() + ',' + $('#ODRITEMSPEC').val() + ',' + $('#ODRITEMDRAWNO').val());
        csv_data.push(JOBPLACE_TXT + ',' + $('#ODRPLACE').val()  + ',' + $('#ODRPLACENAME').val() + ',' + ORDER_QTY_PRO_TXT+ ',' + $('#ODRQTY').val() + ',' + ORDITEMUNITTYP);

    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 0; x < cols.length; x++) {
            csvrow.push("\""+cols[x].innerText+"\"");
        }
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    // csv_data.push(csv_data2);
    csv_data = csv_data.join('\n');
    // Call this function to download csv file 
    await handleSaveAsCSV(csv_data);
    // console.log(csv_data);
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

function entry() {

    $('#ROWNO').val('');
    $('#ALLOCLN').val('');
    $('#AQTY').val('');
    $('#ALLOCBASETYP').val('');
    $('#ITEMCD').val('');
    $('#ITEMNAME').val('');
    $('#ITEMSPEC').val('');
    $('#ITEMDRAWNO').val('');
    $('#MATERIALCD').val('');
    $('#MATERIALNAME').val('');
    $('#PITEMCODE').val('');
    $('#PITEMNAME').val('');
    $('#ALLOCQTY').val('');
    $('#ALLOCSPAREQTY').val('');
    $('#ALLOCWDQTY').val('');
    $('#ALLOCLASTWDDT').val('');
    $('#ALLOCDRAWNO').val('');
    $('#ALLOCPLANWDDT').val('');      
    $('#ALLOCDRAWDT').val('');
    $('#ALLOCPURORDERNOLN').val('');
    $('#ALLOCREM').val('');
    $('#ITEMSERIALLFLG').val('');
    $('#SYSEN_BOMLOADAPP').val('');
    $('#SYSLD_BOMLOADAPP').val('');

    document.getElementById('ITEMUNITTYP').value = '';
    document.getElementById('ITEMUNITTYPE').value = '';
    document.getElementById('ALLOCORDERFLG').value = '';
    document.getElementById('ALLOCSPECIALFLG').checked = false;

    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
    document.getElementById('ORDER').classList.add('read');
    // document.getElementById('ORDER').disabled = true;

    return unRequired();
}

function emptyRow(n) {
  $('#table tbody').append( '<tr class="divide-y divide-gray-200 row-empty" id="rowId'+ n +'">' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td></tr>');
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
    for (var i = 0; i < selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table
    // $('#table > tbody > tr').remove();

    // refresh
    window.location.href = '../ORDERBMENTRY/';
    //  window.location.href = 'index.php';

    return false;
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
            } else {
             
            }
        }
    });
}

function unRequired() {

    document.getElementById('ALLOCORDERNO').classList[document.getElementById('ALLOCORDERNO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ALLOCORDERTYP').classList[document.getElementById('ALLOCORDERTYP').value != '' ? 'remove' : 'add']('req');

    document.getElementById('ITEMCD').classList[document.getElementById('ITEMCD').value != '' ? 'remove' : 'add']('req');
}

function changeRowId() {
    var rows = document.getElementsByTagName('tr');
    for (var i = 1; i < rows.length; i++) {
        // console.log(rows[i].id);
        if (rows[i].id) {
            index_x = Number(rows[i].rowIndex);
            rows[i].id = 'rowId' + index_x;
        }
    }
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../ORDERBMENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 11; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}