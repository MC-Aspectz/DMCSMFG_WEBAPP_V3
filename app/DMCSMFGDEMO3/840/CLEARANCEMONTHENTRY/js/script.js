// button search
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHLOC = $('#SEARCHLOC');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=CLEARANCEMONTHENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=CLEARANCEMONTHENTRY&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});

const search_icon = [SEARCHITEM, SEARCHLOC];

// input
const LOCCD = $('#LOCCD');
const ITEMCODE = $('#ITEMCODE');
const CLEARANCE = $('#CLEARANCE');
const CLEARANCEDATE = $('#CLEARANCEDATE');
const LOCTYP = $('#LOCTYP');

const input_serach = [LOCCD, ITEMCODE, CLEARANCE, CLEARANCEDATE, LOCTYP];

// action button
const OK = $('#OK');
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

// form
const form = document.getElementById('clearanceMonthEntry');

for(const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            $('#loading').show();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

SEARCHLOC.click(async function() {
    await keepData();
});

SEARCH.click(async function() {
    await keepData();
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

CLEARANCEDATE.on('change', function (e) {
    return getElement('checkDate', CLEARANCEDATE.val());
});

ITEMCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCODE', ITEMCODE.val());
    }
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('LOCCD', LOCCD.val());
    }
});

LOCTYP.on('change', function (e) {
    return getElement('LOCTYP', LOCTYP.val());
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../CLEARANCEMONTHENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            if(code == 'checkDate') {
                if(result['SYSMSG'] != '') {
                    document.getElementById('CLEARANCEDATE').value = '';
                    return getMessage(result['SYSMSG']);
                }
            } else {
                $.each(result, function(key, value) {
                    if(document.getElementById(''+key+'')) {
                        document.getElementById(''+key+'').value = value;
                    }
                });
            }
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
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../CLEARANCEMONTHENTRY/function/index_x.php', data)
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
        return errorDialog(1, response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../CLEARANCEMONTHENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../CLEARANCEMONTHENTRY/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'CLEARANCEMONTHENTRY');
    await axios.post('../CLEARANCEMONTHENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'CLEARANCEMONTHENTRY');
    data.append('lineIndex', lineIndex);
    await axios.post('../CLEARANCEMONTHENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
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

    // refresh
    window.location.href = '../CLEARANCEMONTHENTRY/';
    // emptyTable();
    // $(":checkbox").bind("click", true);

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
  $('#table tbody').append( '<tr class="divide-y divide-gray-200 row-empty" id="rowId'+ n +'">' +
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
        for (var z = 1; z <= 9; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function entry() {

    $('#ROWNO').val('');
    $('#CLEARANCEDATE').val('');
    $('#ITEMCODE').val('');
    $('#ITEMNAME').val('');
    $('#ITEMSPEC').val('');
    $('#ITEMDRAWNUMBER').val('');
    $('#LOCCD').val('');
    $('#LOCNAME').val('');
    $('#CLEARANCEQUANTITY').val('');

    document.getElementById('LOCTYP').value = '';
    document.getElementById('ITEMUNIT').value = '';

    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;

    return unRequired();
}

function unRequired(){

  document.getElementById('CLEARANCEDATE').classList[document.getElementById('CLEARANCEDATE').value !== '' ? 'remove' : 'add']('req');
  document.getElementById('ITEMCODE').classList[document.getElementById('ITEMCODE').value !== '' ? 'remove' : 'add']('req');
  document.getElementById('LOCTYP').classList[document.getElementById('LOCTYP').value !== '' ? 'remove' : 'add']('req');
  document.getElementById('LOCCD').classList[document.getElementById('LOCCD').value !== '' ? 'remove' : 'add']('req');
  document.getElementById('CLEARANCEQUANTITY').classList[document.getElementById('CLEARANCEQUANTITY').value !== '' ? 'remove' : 'add']('req');

}