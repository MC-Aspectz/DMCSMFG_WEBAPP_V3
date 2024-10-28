// icon
const SEARCHSALEORDERDETAIL = $('#SEARCHSALEORDERDETAIL');
const SEARCHSTORAGE = $('#SEARCHSTORAGE');
const SEARCHCATALOG = $('#SEARCHCATALOG');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHLOC = $('#SEARCHLOC');

SEARCHSALEORDERDETAIL.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDERDETAIL/index.php?page=SHIPREQUESTCANCEL', 'authWindow', 'width=1200,height=600');});
SEARCHSTORAGE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTORAGE/index.php?page=SHIPREQUESTCANCEL', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=SHIPREQUESTCANCEL', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SHIPREQUESTCANCEL', 'authWindow', 'width=1200,height=600');});
SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=SHIPREQUESTCANCEL&LOCTYP=' + $('#STORAGETYPE').val(), 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSALEORDERDETAIL, SEARCHSTORAGE, SEARCHCATALOG, SEARCHCUSTOMER, SEARCHLOC];

// input
const SALEORDERNUMBER_S = $('#SALEORDERNUMBER_S');
const LC_CODE = $('#LC_CODE');
const CATALOGCD = $('#CATALOGCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const LOCCD = $('#LOCCD');
const SHIPQTY = $('#SHIPQTY');

const input_serach = [ SALEORDERNUMBER_S, LC_CODE, CATALOGCD, CUSTOMERCD, LOCCD];

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');

// form
const form = document.getElementById('shipRequestCancel');

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
    $('#loading').show();
    await keepData();
});

COMMIT.click(async function() {
    return action('commit');
});

UPDATE.click(async function() {
    if(SHIPQTY.val() == '') {
        validationDialog();
        return false;
    }
    update();
});

SALEORDERNUMBER_S.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getSearch('SALEORDERNUMBER_S', SALEORDERNUMBER_S.val());
    }
});

LC_CODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getSearch('LC_CODE', LC_CODE.val());
    }
});

CATALOGCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getSearch('CATALOGCD', CATALOGCD.val());
    }
});

CUSTOMERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getSearch('CUSTOMERCD', CUSTOMERCD.val());
    }
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        // keepData();
        return getLoc(LOCCD.val(), $('#STORAGETYPE').val());
    }
});

async function getSearch(code, value) {
  $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/200/SHIPREQUESTCANCEL/index.php?'+code+'=' + value;
}

async function action(method) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../SHIPREQUESTCANCEL/function/index_x.php', data)
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
    await axios.post('../SHIPREQUESTCANCEL/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            document.getElementById('LOCCD').value = result.LOCCD;
            document.getElementById('LOCNAME').value = result.LOCNAME;           
        } else {
            document.getElementById('LOCCD').value = '';
            document.getElementById('LOCNAME').value = ''; 
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function searchImOh(index) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('ITEMCD', $('#ITEMCODE'+index+'').val());
    data.append('action', 'searchImOh');
    await axios.post('../SHIPREQUESTCANCEL/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwloc').html('');
        let countRow = 0;
        if(response.data != '') {
            $.each(response.data,function(key, value) {
                $('#dvwloc').append( '<tr class="divide-y divide-gray-200" id="rowlocId'+key+'">'+
                                            '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.LO_CODE+'</td>'+
                                            '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.LO_NAME+'</td>'+
                                            '<td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right">'+value.ONHAND+'</td>'+
                                        '</tr>');
                countRow++;
            });
        }

        if(countRow < 4) {
           for (var i = countRow; i <= 3; i++) {
                $('#dvwloc').append('<tr class="divide-y divide-gray-200" id="rowlocId'+i+'">'+
                                        '<td class="h-6 border border-slate-700"></td>'+
                                        '<td class="h-6 border border-slate-700"></td>'+
                                        '<td class="h-6 border border-slate-700"></td>'+
                                    '</tr>');
           }
        }

        document.querySelector('#record').innerText = countRow; 

        document.getElementById('loading').style.display = 'none';
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
        $('#ODRNUMLINE'+index+'').val($('#ODRNUMLINE').val());
        $('#SHIPDT'+index+'').val($('#SHIPDT').val());
        $('#ITEMCODE'+index+'').val($('#ITEMCODE').val());
        $('#ITEMNAME'+index+'').val($('#ITEMNAME').val());
        $('#ITEMSPEC'+index+'').val($('#ITEMSPEC').val());
        $('#SALEORDERCUSTOMERCODE'+index+'').val($('#SALEORDERCUSTOMERCODE').val());
        $('#SALEORDERCUSTOMERNAME'+index+'').val($('#SALEORDERCUSTOMERNAME').val());
        $('#SALEORDERNUMBER'+index+'').val($('#SALEORDERNUMBER').val());
        $('#SALEORDERCUSTOMERSTAFF'+index+'').val($('#SALEORDERCUSTOMERSTAFF').val());
        $('#ORDERDETAILCUSTOMERORDERNUMBER'+index+'').val($('#ORDERDETAILCUSTOMERORDERNUMBER').val());
        $('#SALEORDERDELIVERYNAME'+index+'').val($('#SALEORDERDELIVERYNAME').val());
        $('#SHIPREQNO'+index+'').val($('#SHIPREQNO').val());
        $('#SHIPREQLN'+index+'').val($('#SHIPREQLN').val());
        $('#SHIPQTY'+index+'').val($('#SHIPQTY').val());
        $('#ITEMUNITTYP'+index+'').val($('#ITEMUNITTYP').val());
        $('#LOCTYP'+index+'').val($('#STORAGETYPE').val());
        $('#LOCCD'+index+'').val($('#LOCCD').val());
        $('#LOCNAME'+index+'').val($('#LOCNAME').val());
        $('#SHIPREQTRANSTYP'+index+'').val($('#SHIPREQTRANSTYP').val());
        $('#SHIPREQSUSPENDTYP'+index+'').val($('#SHIPREQSUSPENDTYP').val());
        $('#TOTALOH'+index+'').val($('#TOTALOH').val());
    }
    setTimeout(function() { $('#loading').hide(); }, 1000); // 1 second
    document.getElementById('UPDATE').disabled = true; entry();
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../SHIPREQUESTCANCEL/function/index_x.php', data)
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
    data.append('systemName', 'SHIPREQUESTCANCEL');

    await axios.post('../SHIPREQUESTCANCEL/function/index_x.php', data)
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
    window.location.href = '../SHIPREQUESTCANCEL/';

    return false;
}

function entry() {

    $('#ROWNO').val('');
    $('#ODRNUMLINE').val('');
    $('#SHIPDT').val('');
    $('#ITEMCODE').val('');
    $('#ITEMNAME').val('');
    $('#ITEMSPEC').val('');
    $('#SALEORDERCUSTOMERCODE').val('');
    $('#SALEORDERCUSTOMERNAME').val('');
    $('#SALEORDERNUMBER').val('');
    $('#SALEORDERCUSTOMERSTAFF').val('');
    $('#ORDERDETAILCUSTOMERORDERNUMBER').val('');
    $('#SALEORDERDELIVERYNAME').val('');
    $('#SHIPREQNO').val('');
    $('#SHIPREQLN').val('');
    $('#SHIPQTY').val('');
    $('#ITEMUNITTYP').val('');
    $('#STORAGETYPE').val('');
    $('#LOCCD').val('');
    $('#LOCNAME').val('');
    $('#SHIPREQTRANSTYP').val('');
    $('#SHIPREQSUSPENDTYP').val('');
    $('#TOTALOH').val('0.00');

    $('#dvwloc').empty();
    for (var i = 1; i <= 3; i++) {
        $('#dvwloc').append('<tr class="divide-y divide-gray-200" id="rowlocId'+i+'">'+
                                '<td class="h-6 border border-slate-700"></td>'+
                                '<td class="h-6 border border-slate-700"></td>'+
                                '<td class="h-6 border border-slate-700"></td>'+
                            '</tr>');
    }

    document.querySelector('#record').innerText = '0';
    
    return unRequired();
}

function emptyTable() {
    let maxrow; $('#dvwdetail').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 15; } else { maxrow = 12; }
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
        for (var z = 1; z <= 14; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function unRequired() {
    let SHIPQTY = document.getElementById('SHIPQTY');

    SHIPQTY.classList[SHIPQTY.value !== '' ? 'remove' : 'add']('req');
}