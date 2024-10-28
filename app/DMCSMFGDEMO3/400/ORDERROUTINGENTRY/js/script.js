// button search
const SEARCHPRODUCTIONORDER = $('#SEARCHPRODUCTIONORDER');
const PROCESSPATTERNGUIDE = $('#PROCESSPATTERNGUIDE');
const SEARCHITEMPLACE = $('#SEARCHITEMPLACE');
const SEARCHJOBCODE = $('#SEARCHJOBCODE');

SEARCHPRODUCTIONORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPRODUCTIONORDER/index.php?page=ORDERROUTINGENTRY', 'authWindow', 'width=1200,height=600');});
PROCESSPATTERNGUIDE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/PROCESSPATTERNGUIDE/index.php?page=ORDERROUTINGENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHITEMPLACE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEMPLACE/index.php?page=ORDERROUTINGENTRY&ITEMPSSTYP=' + $('#PROPSSTYP').val(), 'authWindow', 'width=1200,height=600');});
SEARCHJOBCODE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHJOBCODE/index.php?page=ORDERROUTINGENTRY', 'authWindow', 'width=1200,height=600');});

//input search
const PROORDERNO = $('#PROORDERNO');
const ITEMPLACECD = $('#ITEMPLACECD');
const PROPSSJOBTYP = $('#PROPSSJOBTYP');
const PROPSSTYP = $('#PROPSSTYP');

const input_serach = [PROORDERNO, ITEMPLACECD, PROPSSJOBTYP];

// action button
const OK = $('#OK');
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const REMAKE = $('#REMAKE');

// form
const form = document.getElementById('orderRoutingEntry');

//search button
const search_guide = [SEARCHPRODUCTIONORDER, PROCESSPATTERNGUIDE, SEARCHITEMPLACE, SEARCHJOBCODE];

for(const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
};

for(const icon of search_guide) {
    icon.click(async function () {
        await keepData();
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

PROORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PROORDERNO', PROORDERNO.val());
    }
});

ITEMPLACECD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getPlace(ITEMPLACECD.val(), PROPSSTYP.val());
    }
});

PROPSSTYP.change(function () {
    return getPlace(ITEMPLACECD.val(), PROPSSTYP.val());
});

PROPSSJOBTYP.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('PROPSSJOBTYP', PROPSSJOBTYP.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/ORDERROUTINGENTRY/index.php?'+code+'=' + value;        
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
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

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
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

async function getPlace(ITEMPLACECD, PROPSSTYP) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('ITEMPLACECD', ITEMPLACECD);
    data.append('PROPSSTYP', PROPSSTYP);
    data.append('action', 'ITEMPLACECD');
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            for (let key in result) {
                document.getElementById(''+key+'').value = result[key];
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

function entry() {

    $('#ROWNO').val('');
    $('#PROPSSNO').val('');
    $('#ITEMPLACECD').val('');
    $('#ITEMPLACENAME').val('');
    $('#PROPSSJOBTYP').val('');
    $('#PROPSSJOBTYPSTR').val('');
    $('#JOB_NAME').val('');
    $('#PROPSSQTY').val('');
    $('#PROPSSPLANTIME').val('');
    $('#PROPSSTYP').val('');
    $('#PROPSSTYPSTR').val('');
    $('#PROPSSPLANSTARTDT').val('');
    $('#PROPSSPLANENDDT').val('');
    $('#PROPSSPLANSTARTTM').val('00:01');
    $('#PROPSSPLANENDTM').val('00:00');
    $('#PROPSSSTARTDT').val('');
    $('#PROPSSENDDT').val('');
    $('#PROPSSSTARTTM').val('');
    $('#PROPSSENDTM').val('');
    $('#PROPSSCOMPQTY').val('');
    $('#PROPSSALLOWANCE').val('');
    $('#PROPSSPLANDT').val('');
    $('#PROPSSREM').val('');
    $('#PROPSSDURATION').val('');
    $('#PROPSSSTATUS').val('');
    $('#PROPSSSTATUSSTR').val('');

    document.getElementById('PROPSSTYP').value = 1;
    document.getElementById('PROPSSUNITTYP').value = 1;
    document.getElementById('PROPSSLINKTYP').value = '';
    document.getElementById('PROPSSFIXFLG').checked = false;

    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;

    return unRequired();
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
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
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
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
    data.append('systemName', 'ORDERROUTINGENTRY');
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
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
    window.location.href = '../ORDERROUTINGENTRY/';
    //  window.location.href = 'index.php';

    return false;
}

function clearRow(){
    var selectedRowIndex = localStorage.getItem('selectedRowIndex');
    if (selectedRowIndex !== null) {
        $('table#table tr').eq(selectedRowIndex).removeAttr('id');
        localStorage.removeItem('selectedRowIndex');
    }
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
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td></tr>');
}

async function unsetItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
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

function unRequired() {

    document.getElementById('PROORDERNO').classList[document.getElementById('PROORDERNO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROPSSNO').classList[document.getElementById('PROPSSNO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMPLACECD').classList[document.getElementById('ITEMPLACECD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROPSSJOBTYP').classList[document.getElementById('PROPSSJOBTYP').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROPSSQTY').classList[document.getElementById('PROPSSQTY').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROPSSPLANTIME').classList[document.getElementById('PROPSSPLANTIME').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PROPSSUNITTYP').classList[document.getElementById('PROPSSUNITTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('PROPSSTYP').classList[document.getElementById('PROPSSTYP').value !== '' ? 'remove' : 'add']('req');

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