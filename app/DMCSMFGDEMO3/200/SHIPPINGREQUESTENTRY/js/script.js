// icon
const SEARCHSALENOSHIP = $('#SEARCHSALENOSHIP');
const SEARCHLOC = $('#SEARCHLOC');

SEARCHSALENOSHIP.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALENOSHIP/index.php?page=SHIPPINGREQUESTENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=SHIPPINGREQUESTENTRY&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSALENOSHIP, SEARCHLOC];

// input
const SALEORDERNO = $('#SALEORDERNO');
const LOCCD = $('#LOCCD');
const THISSHIPQTY = $('#THISSHIPQTY');

const input_serach = [ SALEORDERNO, LOCCD];

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');

// form
const form = document.getElementById('shipingRequestEntry');

for (const input of input_serach) {
  input.change(function () {
    $('#loading').show();
  });

  input.keyup(function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        $('#loading').show();
    }
  });
}

for (const input of serach_icon) {
  input.click(function () {
    keepData();
  });
}

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    $('#loading').show();
    await keepData();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

COMMIT.click(async function() {
    return action('commit');
});

UPDATE.click(async function() {
    if(THISSHIPQTY.val() == '') {
        validationDialog();
        return false;
    }
    update();
});

SALEORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getSearch('SALEORDERNO', SALEORDERNO.val());
    }
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        // keepData();
        return getLoc(LOCCD.val(), $('#STORAGETYPE').val());
    }
});

THISSHIPQTY.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return chkQty();
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/200/SHIPPINGREQUESTENTRY/index.php?'+code+'=' + value;
}

async function action(method) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../SHIPPINGREQUESTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            return unsetSession(form);
            // window.location.reload();
        }
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
    await axios.post('../SHIPPINGREQUESTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            document.getElementById('LOCCD').value = result.LOCCD;
            document.getElementById('LOCNAME').value = result.LOCNAME;           
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function chkQty() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'chkQty');
    await axios.post('../SHIPPINGREQUESTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        $('#THISSHIPQTY').val(result.THISSHIPQTY);
        $('#ORDERBALANCE').val(result.ORDERBALANCE);
        $('#loading').hide();
        return chkQtyDialog(); 
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function update() {
    $('#loading').show();
    let index = $('#ROWNO').val();
    if(index != '') {
        $('#ITEMCODE'+index+'').val($('#ITEMCODE').val());
        $('#ITEMNAME'+index+'').val($('#ITEMNAME').val());
        $('#ITEMSPEC'+index+'').val($('#ITEMSPEC').val());
        $('#ORDERQTY'+index+'').val($('#ORDERQTY').val());
        $('#ORDERBALANCE'+index+'').val($('#ORDERBALANCE').val());
        $('#THISSHIPQTY'+index+'').val($('#THISSHIPQTY').val());
        $('#SHIPREQUESTSHIPPEDDATE'+index+'').val($('#SHIPREQUESTSHIPPEDDATE').val());
        $('#ITEMUNIT'+index+'').val($('#ITEMUNIT').val());
        $('#LOCTYP'+index+'').val($('#LOCTYP').val());
        $('#LOCCD'+index+'').val($('#LOCCD').val());
        $('#LOCNAME'+index+'').val($('#LOCNAME').val());

        document.getElementById('THISSHIPQTY_TD'+index+'').innerHTML = $('#THISSHIPQTY').val();
        document.getElementById('SHIPPEDDATE_TD'+index+'').innerHTML = slashFormatDate($('#SHIPREQUESTSHIPPEDDATE').val());
    }
    setTimeout(function() { $('#loading').hide(); }, 1000); // 1 second
    document.getElementById('UPDATE').disabled = true; entry();
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../SHIPPINGREQUESTENTRY/function/index_x.php', data)
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
    data.append('systemName', 'SHIPPINGREQUESTENTRY');

    await axios.post('../SHIPPINGREQUESTENTRY/function/index_x.php', data)
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
    window.location.href = '../SHIPPINGREQUESTENTRY/';

    return false;
}

function entry() {

    $('#ROWNO').val('');
    $('#SHIPREQUESTSHIPPEDDATE').val('');
    $('#ITEMCODE').val('');
    $('#ITEMNAME').val('');
    $('#ITEMSPEC').val('');
    $('#ORDERQTY').val('');
    $('#ORDERBALANCE').val('');
    $('#THISSHIPQTY').val('');
    $('#ITEMUNIT').val('');
    $('#LOCTYP').val('');
    $('#LOCCD').val('');
    $('#LOCNAME').val('');

}

function emptyTable() {
    let maxrow; $('#dvwdetail').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 18; } else { maxrow = 12; }
    for (var i = 1; i <= maxrow; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200 row-empty" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }

    document.querySelector('#rowCount').innerText = '0';
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function unRequired() {
    
    let SALEORDERNO = document.getElementById('SALEORDERNO');
    let THISSHIPQTY = document.getElementById('THISSHIPQTY');
    SALEORDERNO.classList[SALEORDERNO.value !== '' ? 'remove' : 'add']('req');
    THISSHIPQTY.classList[THISSHIPQTY.value !== '' ? 'remove' : 'add']('req');
}