// button search
const SEARCHITEMPROPLAN = $('#SEARCHITEMPROPLAN');
const SEARCHLOC = $('#SEARCHLOC');
const SEARCHOFFER = $('#SEARCHOFFER');

SEARCHITEMPROPLAN.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEMPROPLAN/index.php?page=PRODUCTIONPLAN', 'authWindow', 'width=1200,height=600');});
SEARCHOFFER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHOFFER/index.php?page=PRODUCTIONPLAN&COSTTYPE=' + $('#COSTTYPE').val(), 'authWindow', 'width=1200,height=600');});
SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=PRODUCTIONPLAN&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});

const search_icon = [SEARCHITEMPROPLAN, SEARCHLOC, SEARCHOFFER];

//input search
const ITEMCODE = $('#ITEMCODE');
const SUPPLIERCODE = $('#SUPPLIERCODE');
const LOCCD = $('#LOCCD');

const input_serach = [ITEMCODE, SUPPLIERCODE, LOCCD];

// action button
const OK = $('#OK');
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const PLANVIEW = $('#PLANVIEW1');
const CSV = $('#CSV');

// form
const form = document.getElementById('productionplan');

for(const input of input_serach) {
    input.change(function () {
        $('#loading').show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $('#loading').show();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

SEARCH.click(async function() {
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

COMMIT.click(function() {
    return action('commit');
});

PLANVIEW.click(async function() {
    $('#loading').show(); await keepData();
    var param = {   ITEMCODE: document.getElementById('ITEMCODE').value,
                    ITEMNAME: document.getElementById('ITEMNAME').value,
                    FACTORYCODE: document.getElementById('FACTORYCODE').value,
                    action: 'PRODUCTIONPLAN'
                }
    return $.redirect($('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/700/PLANVIEW/index.php', param);
    // $('#loading').hide();
});

CSV.click(function() {
    exportCSV();
});

ITEMCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCODE', ITEMCODE.val());
    }
});

SUPPLIERCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSW(SUPPLIERCODE.val(), $('#COSTTYPE').val());
    }
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        // return getElement('LOCCD', LOCCD.val());
        return getLoc(LOCCD.val(), $('#LOCTYP').val());
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
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
        document.getElementById('PLANVIEW1').disabled = false;
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getSW(SUPPLIERCODE, COSTTYPE) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('SUPPLIERCODE', SUPPLIERCODE);
    data.append('COSTTYPE', COSTTYPE);
    data.append('action', 'getSW');
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
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
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getLoc(LOCCD, LOCTYP) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('LOCCD', LOCCD);
    data.append('LOCTYP', LOCTYP);
    data.append('action', 'getLoc');
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
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
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
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

async function exportCSV() {

    let FACTORYNAME_TXT = (document.getElementById('FACTORYNAME_TXT').innerText || document.getElementById('FACTORYNAME_TXT').textContent);
    let IM_TYPE_TXT = (document.getElementById('IM_TYPE_TXT').innerText || document.getElementById('IM_TYPE_TXT').textContent);
    let DUE_DATE_TXT = (document.getElementById('DUE_DATE_TXT').innerText || document.getElementById('DUE_DATE_TXT').textContent);

    let DUEDATES = '--/--/----'; if($('#DUEDATES').val() != '') { DUEDATES = formatDate($('#DUEDATES').val()); }

    var FACTORYCODE = document.getElementById('FACTORYCODE').options[document.getElementById('FACTORYCODE').selectedIndex].text;
    var COSTTYPES = document.getElementById('COSTTYPES').options[document.getElementById('COSTTYPES').selectedIndex].text;

    var csv_data = [  FACTORYNAME_TXT + ',' + FACTORYCODE + ', ,' + DUE_DATE_TXT + ',' + DUEDATES];
        csv_data.push(IM_TYPE_TXT + ',' + COSTTYPES);

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
    await handleSaveAsFile(csv_data);
    // console.log(csv_data);
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
        } else {
        // 
        }
    }
  });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
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
    // console.log(data);
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetSession(form) {
  let data = new FormData(form);
  data.append('action', 'unsetsession');
  data.append('systemName', 'PRODUCTIONPLAN');
  await axios
    .post('../PRODUCTIONPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
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
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table
    $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = '../PRODUCTIONPLAN/';
    //  window.location.href = 'index.php';

    return false;
}

function changeRowId() {
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
    $('table tbody').append('<tr class="divide-y divide-gray-200 row-empty" id="rowId'+n+'>' +
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
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td></tr>');
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 12; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

async function unsetItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../PRODUCTIONPLAN/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

function digitFormat(num) {
    while (num.search(",") >= 0) {
        num = (num + "").replace(',', '');
    }
    return parseFloat(num).toFixed(2);
};


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [day, month, year].join('/');
}


function entry() {
    
    $('#ROWNO').val('');
    $('#ITEMCODE').val('');
    $('#ITEMNAME').val('');
    $('#QTY').val('');
    $('#DUEDATE').val('');
    $('#SUPPLIERCODE').val('');
    $('#SUPPLIERNAME').val('');
    $('#LOCCD').val('');
    $('#LOCNAME').val('');

    document.getElementById('ITEMUNIT').value = '';
    document.getElementById('COSTTYPE').value = '';
    document.getElementById('LOCTYP').value = '';

    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
    document.getElementById('PLANVIEW1').disabled = true;

    return unRequired();
}

function unRequired() {

    document.getElementById('ITEMCODE').classList[document.getElementById('ITEMCODE').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('QTY').classList[document.getElementById('QTY').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('DUEDATE').classList[document.getElementById('DUEDATE').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERCODE').classList[document.getElementById('SUPPLIERCODE').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('LOCCD').classList[document.getElementById('LOCCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('LOCTYP').classList[document.getElementById('LOCTYP').value !== '' ? 'remove' : 'add']('req');
}


async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(["\uFEFF"+csv_data], { type: "text/csv;charset=utf-8;"});
        const supportsFileSystemAccess = 'showSaveFilePicker' in window && (() => {
        try {
            return window.self === window.top;
        } catch {
            return false;
        }
    });
    // If the File System Access API is supported…
    if (supportsFileSystemAccess) {
      try {
        // Show the file save dialog.
        const handle = await showSaveFilePicker({
            types: [{
                description: 'CSV file',
                accept: {'application/csv': ['.csv']},
            }],
        });
        // Write the CSVFile to the file.
        const writable = await handle.createWritable();
        await writable.write(CSVFile);
        await writable.close();
        return;
      } catch (err) {
        // Fail silently if the user has simply canceled the dialog.
        if (err.name !== 'AbortError') {
            console.error(err.name, err.message);
            return;
        }
      }
    }
    // Fallback if the File System Access API is not supported…
    // Create the CSVFile URL.
    const url = URL.createObjectURL(CSVFile);
    // Create the `<a download>` element and append it invisibly.
    const temp_link = document.createElement('a');
    temp_link.href = url;
    temp_link.download = suggestedName;
    temp_link.style.display = 'none';
    document.body.append(temp_link);
    // Programmatically click the element.
    temp_link.click();
    // Revoke the CSVFile URL and remove the element.
    setTimeout(() => {
        URL.revokeObjectURL(url);
        temp_link.remove();
    }, 1000);
}

function number2digit(num) {
    if (isNaN(num) || num == '' || num == null) {
        return '';
    }
    return numberWithCommas(parseFloat(num).toFixed(2));
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}