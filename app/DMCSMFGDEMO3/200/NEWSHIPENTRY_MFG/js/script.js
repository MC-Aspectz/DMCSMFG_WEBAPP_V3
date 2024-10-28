// icon
const SEARCHSALEORDERDETAIL = $('#SEARCHSALEORDERDETAIL');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCATALOG = $('#SEARCHCATALOG');
const GMAPVIEW = $('#GMAPVIEW');

SEARCHSALEORDERDETAIL.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDERDETAIL/index.php?page=NEWSHIPENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=NEWSHIPENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=NEWSHIPENTRY_MFG', 'authWindow', 'width=1200,height=600');});
GMAPVIEW.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/GMAPVIEW/index.php?page=NEWSHIPENTRY_MFG&GMAPADR=' + $('#GMAPADR').val(), 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSALEORDERDETAIL, SEARCHCUSTOMER, SEARCHCATALOG];

// input
const SALEORDERNUMBER_S = $('#SALEORDERNUMBER_S');
const CUSTOMERCD_S = $('#CUSTOMERCD_S');
const CATALOGCD = $('#CATALOGCD');

const input_serach = [ SALEORDERNUMBER_S, CUSTOMERCD_S, CATALOGCD];

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');

// form
const form = document.getElementById('newShipEntryMFG');

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

SEARCH.click(async function() {
    $('#loading').show();
    await keepData();
});

COMMIT.click(async function() {
    return action('commit');
});

SALEORDERNUMBER_S.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SALEORDERNUMBER_S', SALEORDERNUMBER_S.val());
    }
});

CUSTOMERCD_S.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD_S', CUSTOMERCD_S.val());
    }
});

CATALOGCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CATALOGCD', CATALOGCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/200/NEWSHIPENTRY_MFG/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../NEWSHIPENTRY_MFG/function/index_x.php', data)
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
    await axios.post('../NEWSHIPENTRY_MFG/function/index_x.php', data)
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

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../NEWSHIPENTRY_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    const data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'NEWSHIPENTRY_MFG');
    await axios.post('../NEWSHIPENTRY_MFG/function/index_x.php', data)
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
    window.location.href = '../NEWSHIPENTRY_MFG/';
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
        for (var z = 1; z <= 22; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}