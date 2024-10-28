// button search
const SEARCHPRODUCTIONORDER = $('#SEARCHPRODUCTIONORDER');
const SEARCHPROTRAN = $('#SEARCHPROTRAN');

SEARCHPRODUCTIONORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPRODUCTIONORDER/index.php?page=WAREHOUSEENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHPROTRAN.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPROTRAN/index.php?page=WAREHOUSEENTRY&PROORDERNO=' + $('#PROORDERNO').val(), 'authWindow', 'width=1200,height=600');});

// input
const PROORDERNO = $('#PROORDERNO');
const PROTRANORDERNO = $('#PROTRANORDERNO');
const PROTRANQTY = $('#PROTRANQTY');

const serachIcon = [SEARCHPROTRAN];

// action button
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DEL = $('#DELETE');
const ADDROW = $('#ADDROW');
const DELROW = $('#DELROW');

// form
const form = document.getElementById('warehouseEntry');

for (const serach of serachIcon) {
    serach.click(function () {
        keepData();
    });
}

INSERT.click(function () {
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    return action('INSERT');
});

UPDATE.click(function () {
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    return action('UPDATE');
});

DEL.click(function () {
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    return action('DELETE');
});

PROORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        if(PROORDERNO.val() == '') { unsetSession(form); return false; }
        return getSearch('PROORDERNO', PROORDERNO.val());
    }
});

PROTRANORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        if(PROTRANORDERNO.val() == '') { return entry(); }
        return getElement('PROTRANORDERNO', PROTRANORDERNO.val());
    }
});

PROTRANQTY.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('PROTRANQTY', PROTRANQTY.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/WAREHOUSEENTRY/index.php?'+code+'=' + value;        
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../WAREHOUSEENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if(response.status == 200) {
            if(method == 'DELETE') { return clearForm(form); }
            let result  = response.data;
            if(typeof result['PROTRANORDERNO'] !== 'undefined') {
                return clearForm(form);
            } else {
                return errorDialog(result);
            }
        }
    }).catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../WAREHOUSEENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result  = response.data;
        if(result == '') { return false; $('#loading').hide(); entry();}
        if(code == 'PROTRANORDERNO') {
            generateScrap(result['searchBad']);
            let protran = result['getProTran'];
            if(protran != '') {
                // console.log(protran);
                $.each(protran, function(key, value) {
                    // console.log(key, '=>', value);
                    if(document.getElementById(''+key+'')) {
                        if(key == 'BFPROTRANQTY' || key == 'PROTRANBADQTY' || key == 'PROTRANQTY' || key == 'SUMBADQTY') {
                            document.getElementById(''+key+'').value = num2digit(value);
                        } else if(key == 'PROTRANDT') {
                            var dt = moment(value, 'YYYYMMDD');
                            document.getElementById(''+key+'').value = dt.format('yyyy-MM-DD');
                        } else {
                            document.getElementById(''+key+'').value = value;
                        }
                    }
                });
                document.getElementById('INSERT').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
            }       
        } else if(code == 'PROTRANQTY') {
            for (let key in result) {
                document.getElementById(''+key+'').value = result[key];
                if(result['SYSMSG'] == '1') {
                    qtyDialog();
                }
            }
        }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: '',
    text: txt,
    showCancelButton: type != 3 ? true : false,
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
    }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return closeApp($('#appcode').val()); 
        } else if (type == 2) {
    
        } else {
        // 
        }
    }
  });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../WAREHOUSEENTRY/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function keepScrapItemData() {
    const data = new FormData(form);
    data.append('action', 'keepScrapItemData');
    await axios.post('../WAREHOUSEENTRY/function/index_x.php', data)
    .then(response => {
        // $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function unsetScrapItemData(lineIndex) {
    $("#loading").show();
    let data = new FormData(form);
    data.append('action', 'unsetScrapItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../WAREHOUSEENTRY/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'JobResultEntry2');
    await axios.post('../WAREHOUSEENTRY/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

function unRequired() {
    document.getElementById('PROORDERNO').classList[document.getElementById('PROORDERNO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROTRANORDERNO').classList[document.getElementById('PROTRANORDERNO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROTRANQTY').classList[document.getElementById('PROTRANQTY').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROTRANSTATUS').classList[document.getElementById('PROTRANSTATUS').selectedIndex != 0  ? 'remove' : 'add']('req');
    document.getElementById('PROTRANINSPTYP').classList[document.getElementById('PROTRANINSPTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
}

function changeScrapRowId() {
    let scrapTb = document.getElementById('tableScrap');
    let rows = scrapTb.getElementsByTagName('tr');
    for (var i = 1; i < rows.length; i++) {
      if (rows[i].id) {
        let index_x = Number(rows[i].rowIndex);
        rows[i].id = 'rowId' + index_x;
      }
    }
}

function emptyRow(n) {
  $('#tableScrap tbody').append('<tr class="divide-y divide-gray-200 row-empty" id="rowId'+ n +'">' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td></tr>');
}

function clearScrapTable() {
  for (var i = 1; i <= 5; i++) {
    let emptyRow = $('<tr class="divide-y divide-gray-200 row-empty" id="rowId'+i+'">');                      
    let emptyCol = '';  
    emptyCol += '<td class="h-6 border border-slate-700"></td>';
    emptyCol += '<td class="h-6 border border-slate-700"></td>';
    emptyCol += '<td class="h-6 border border-slate-700"></td></tr>';
    $('#rowId'+i+'').empty();
    $('#rowId'+i+'').append(emptyCol);
  }
  $('#scrapcount').html('0');
}

function entry() {

    $('#PROTRANORDERNO').val('');
    $('#TRANID').val('');
    $('#PROTRANBADQTY').val('');
    $('#BFPROTRANQTY').val('');
    $('#PROSCRAPPROORDERNO').val('');
    $('#SYSMSG').val('');
    $('#PROTRANQTY').val('');
    $('#SUMBADQTY').val('');
    $('#PROTRANREM').val('');

    document.getElementById('PROTRANINSPTYP').value = '';
    document.getElementById('PROTRANSTATUS').value = '';

    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;

    return unRequired();
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
            case 'text':
        inputs[i].value = '';
        break;
      case 'checkbox':
        inputs[i].checked = false;
        break;
    }
  }
  // clearing selects
  var selects = form.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName('textarea');
  for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

  // clearing table
  clearScrapTable();
  // refresh
  // window.location.href = 'index.php';
  window.location.href = '../WAREHOUSEENTRY/';
  return false;
}

function emptyRows(maxrow) {
    let rowcount =  $('.scrapRow-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#tableScrap tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 3; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}