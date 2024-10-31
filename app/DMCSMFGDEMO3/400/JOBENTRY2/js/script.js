
//input serach
const PROORDERNO = $('#PROORDERNO');
const PROPSSNO = $('#PROPSSNO');
const JOBPROCOMQTY = $('#JOBPROCOMQTY');
const JOBPROSTARTTM = $('#JOBPROSTARTTM');
const JOBPROENDTM = $('#JOBPROENDTM');

// search
const SEARCHPRODUCTIONORDER = $('#SEARCHPRODUCTIONORDER');
const SEARCHPROPSS = $('#SEARCHPROPSS');
const SEARCHITEMPLACE = $('#SEARCHITEMPLACE');

SEARCHPRODUCTIONORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPRODUCTIONORDER/index.php?page=JOBENTRY2', 'authWindow', 'width=1200,height=600');});
SEARCHPROPSS.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPROPSS/index.php?page=JOBENTRY2&P1=' + PROORDERNO.val(), 'authWindow', 'width=1200,height=600');});
SEARCHITEMPLACE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEMPLACE/index.php?page=JOBENTRY2', 'authWindow', 'width=1200,height=600');});

// requried input
// const PROQTY = $('#PROQTY');
// const PROPLANENDDT = $('#PROPLANENDDT');
// const PROPLANSTARTDT = $('#PROPLANSTARTDT');

const input_serach = [PROORDERNO, PROPSSNO, JOBPROCOMQTY, JOBPROSTARTTM, JOBPROENDTM];
const serachIcon = [SEARCHPRODUCTIONORDER, SEARCHPROPSS, SEARCHITEMPLACE];

// action button
const SEARCH = $('#SEARCH');
const OK = $('#OK');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DEL = $('#DELETE');
const ENTRY = $('#ENTRY');
const ADDROW = $('#ADDROW');
const DELROW = $('#DELROW');

// form
const form = document.getElementById('jobResultEntry2');

// parameter
for (const input of input_serach) {
    input.change(async function () {
        if(PROORDERNO.val() == '') {
          unsetSession(form);
          return false;
        }
        $('#loading').show();
        await keepData();
    });

    input.keyup(async function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
          if(PROORDERNO.val() == '') {
            unsetSession(form);
            return false;
          }
          $('#loading').show();
          await keepData();
        }
    });
}

for (const serach of serachIcon) {
    serach.click(async function () {
      $('#loading').show();
      await keepJobItemData();
      await keepData();
      $('#loading').hide();
    });
}

SEARCH.click(function () {
    if(PROORDERNO.val() == '') {
      unsetSession(form);
      return false;
    }
    $('#loading').show();
    let action = document.createElement('input');
    action.setAttribute('name', 'action');
    action.setAttribute('value', 'searchJob');
    form.appendChild(action);
    form.submit();
 });

COMMIT.click(function () {
  // check validate form
  if (PROORDERNO.val() == '') {
    alertValidation();
    return false;
  }
  return commitAll();
  // form.submit();
});

PROORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        if(PROORDERNO.val() == '') { unsetSession(form); return false; }
        return getSearch('PROORDERNO', PROORDERNO.val());
    }
});

PROPSSNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getJobDetail(PROPSSNO.val());
    }
});

JOBPROCOMQTY.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return chkStatus(JOBPROCOMQTY.val());
    }
});

JOBPROSTARTTM.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getPlanHour(JOBPROSTARTTM.val(), JOBPROENDTM.val());
    }
});

JOBPROENDTM.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getPlanHour(JOBPROSTARTTM.val(), JOBPROENDTM.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/JOBENTRY2/index.php?'+code+'=' + value;        
}

async function commitAll() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'commitAll');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response)  => {
        // console.log(response.data);
        if(response.status == 200) {
          clearForm(form);
          $('#loading').hide();
          // return window.location.href='index.php';
        }
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function getJobDetail(PROPSSNO) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'getJobDetail');
    data.append('PROPSSNO', PROPSSNO);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let data = response.data;
        // console.log(data['PROPSSNO']);
        if(data['PROPSSNO'] != undefined && data['PROPSSNO'] != '') {
          $('#PROPSSNO').val(data['PROPSSNO']);
          $('#LOCCD').val(data['LOCCD']);
          $('#LOCNAME').val(data['LOCNAME']);
          $('#JOBPROCOMQTY').val(parseFloat(data['JOBPROCOMQTY']).toFixed(2));
          $('#PROCOMPQTY').val(data['PROCOMPQTY']);
          $('#JOBPROREM').val(data['JOBPROREM']);
          $('#PROPSSLASTFLG').val(data['PROPSSLASTFLG']);
          $('#IMAGEFILE').val(data['IMAGEFILE']);
          document.getElementById('JOBPROPSSTYP').value = data['JOBPROPSSTYP'];
          document.getElementById('JOBPROJOBTYP').value = data['JOBPROJOBTYP'];
        } else {
          $('#PROPSSNO').val('');
          $('#LOCCD').val('');
          $('#LOCNAME').val('');
          $('#JOBPROCOMQTY').val('');
          $('#PROCOMPQTY').val('');
          $('#JOBPROREM').val('');
          $('#PROPSSLASTFLG').val('');
          $('#IMAGEFILE').val('');
          document.getElementById('JOBPROPSSTYP').value = '';
          document.getElementById('JOBPROJOBTYP').value = '';
        }
        unRequired();
        $('#loading').hide();
        clearScrapTable();
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function updateTmpScrap() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'updateTmpScrap');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        // keepJobItemData();
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function deleteTmpScrap() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'deleteTmpScrap');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        // keepJobItemData();
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function searchScrap() {
    $('#loading').show();
    clearScrapTable();
    const data = new FormData(form);
    data.append('action', 'searchScrap');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            if(result['Scrap'] != '') {
                // console.log(result['Scrap']);
                // console.log(result['SumScrap']);
                generateScrap(result['Scrap']);
                let sum  = result['SumScrap']['SUMSCRAP'];
                $('#SUMSCRAP').val(parseFloat(sum).toFixed(2));       
            }
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getPlanHour(JOBPROSTARTTM, JOBPROENDTM) {
    const data = new FormData(form);
    data.append('action', 'getPlanHour');
    data.append('JOBPROSTARTTM', JOBPROSTARTTM);
    data.append('JOBPROENDTM', JOBPROENDTM);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        // $('#JOBPROSTARTTM').val(response.data['JOBPROSTARTTMSTR']);
        // $('#JOBPROENDTM').val(response.data['JOBPROENDTMSTR']);
        $('#JOBPROHOUR').val(response.data['JOBPROHOUR']);
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function chkStatus(JOBPROCOMQTY) {
    const data = new FormData(form);
    data.append('action', 'chkStatus');
    data.append('JOBPROCOMQTY', JOBPROCOMQTY);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        document.getElementById('JOBPROSTATUS').value = response.data['JOBPROSTATUS'];
        unRequired();
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function clearTmp() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'clearTmp');
    data.append('TIMESTAMP', $('#TIMESTAMP').val());
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function entry() {

    let jobTb = document.getElementById('tableProduct');
    let rows = jobTb.getElementsByTagName('tr');
    $('.proRow-id').each(function (i) {
      rows[i+1].classList.remove('selected-row');
    });
    $('#ROWNO').val('');
    $('#PROPSSNO').val('');
    $('#JOBPROENTRYDT').val(new Date().toISOString().substring(0, 10));
    $('#PROPSSLASTFLG').val('');
    $('#LOCCD').val('');
    $('#LOCNAME').val('');
    $('#JOBPROREM').val('');
    $('#JOBPROCOMQTY').val('');
    $('#PROCOMPQTY').val('');
    $('#JOBPROSTARTDT').val('');
    $('#JOBPROSTARTTM').val('');
    $('#JOBPROENDTM').val('');
    $('#JOBPROHOUR').val('');
    $('#IMAGEFILE').val('');

    document.getElementById('JOBPROPSSTYP').value = '';
    document.getElementById('JOBPROJOBTYP').value = '';
    document.getElementById('WORKTIMECD').value = '';
    document.getElementById('JOBPROSTATUS').value = '';

    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
    unRequired();
    // DVWSCRAP
    clearScrapTable();
    const data = new FormData(form);
    data.append('action', 'entry');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        // return clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
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
            // $("#loading").show();
        } else {
        // 
        }
    }
  });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function keepJobItemData() {
    const data = new FormData(form);
    data.append('action', 'keepJobItemData');
    // console.log(data);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then(response => {
        // $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepScrapItemData() {
    const data = new FormData(form);
    data.append('action', 'keepScrapItemData');
    // console.log(data);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then(response => {
        // $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetJobItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetAccItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetScrapItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetScrapItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../JOBENTRY2/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'JobResultEntry2');
    await axios.post('../JOBENTRY2/function/index_x.php', data)
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
    for (var i = 0; i < inputs.length; i++) {
        switch (inputs[i].type) {
          // case 'hidden':
          case 'text':
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
    // $('#tableProduct > tbody > tr').remove();
    // $('#tableScrap > tbody > tr').remove();
    clearProTable();
    clearScrapTable();
    // refresh
    // window.location.href = "index.php";
    window.location.href = '../JOBENTRY2/';
    return false;
}

function unRequired() {

    document.getElementById('PROORDERNO').classList[document.getElementById('PROORDERNO').value != '' ? 'remove' : 'add']('req');
    document.getElementById('PROPSSNO').classList[document.getElementById('PROPSSNO').value != '' ? 'remove' : 'add']('req');
    document.getElementById('JOBPROCOMQTY').classList[document.getElementById('JOBPROCOMQTY').value != '' ? 'remove' : 'add']('req');
    document.getElementById('JOBPROMEMBER').classList[document.getElementById('JOBPROMEMBER').value != '' ? 'remove' : 'add']('req');

    const JOBPROSTATUS = document.getElementById('JOBPROSTATUS');
    JOBPROSTATUS.classList[JOBPROSTATUS.selectedIndex != 0 ? 'remove' : 'add']('req');
}

function changeproRowId() {
    let jobTb = document.getElementById('tableProduct');
    let rows = jobTb.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
      // console.log(i);
        if (rows[i].id) {
            index_x = Number(rows[i].rowIndex);
            rows[i].id = 'rowPrdId' + index_x;
        }
    }
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
                                '<td class="h-6 border border-slate-700"></td></tr>');
}

function emptyproRow(n) {
  $('#tableProduct tbody').append('<tr class="divide-y divide-gray-200 row-empty" id="rowPrdId'+ n +'">' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td>' +
                                '<td class="h-6 border border-slate-700"></td></tr>');
}

function clearProTable() {
    let maxrow; $('#dvwdetailA').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 11; } else { maxrow = 6; }
    $('#tableProduct tbody tr.row-empty').remove();
    for (var x = 1; x <= maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowPrdId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetailA.appendChild(row);
    }
    $('#procount').html('0');
}

function clearScrapTable() {
    let maxrow; $('#dvwdetailB').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 10; } else { maxrow = 5; }
    for (var i = 1; i <= maxrow; i++) {
        $('#dvwdetailB').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
    $('#scrapcount').html('0');
}

function emptyRowsA(maxrowA) {
    let rowcount =  $('.proRow-id').length || 0;
    const dvwdetailA = document.getElementById('dvwdetailA');
    $('#tableProduct tbody tr.row-empty').remove();
    for (var x = rowcount; x < maxrowA; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowPrdId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetailA.appendChild(row);
    }
}

function emptyRowsB(maxrowB) {
    let rowcount =  $('.scrapRow-id').length || 0;
    const dvwdetailB = document.getElementById('dvwdetailB');
    $('#tableScrap tbody tr.row-empty').remove();
    for (var x = rowcount; x < maxrowB; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 2; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetailB.appendChild(row);
    }
}


