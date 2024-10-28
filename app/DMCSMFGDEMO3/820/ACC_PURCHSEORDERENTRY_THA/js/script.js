// search
const SEARCHPURCHASEREQUEST = $('#SEARCHPURCHASEREQUEST');
const SEARCHPURCHASEORDER = $('#SEARCHPURCHASEORDER');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');

SEARCHPURCHASEREQUEST.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEREQUEST/index.php?page=ACC_PURCHSEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHPURCHASEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?page=ACC_PURCHSEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_PURCHSEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_PURCHSEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_PURCHSEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_PURCHSEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});


const serach_icon = [ SEARCHPURCHASEREQUEST, SEARCHPURCHASEORDER, SEARCHDIVISION, SEARCHSUPPLIER, SEARCHSTAFF, SEARCHCURRENCY];

//input serach
const PRNO = $('#PRNO');
const PONO = $('#PONO');
const DIVISIONCD = $('#DIVISIONCD');
const SUPPLIERCD = $('#SUPPLIERCD');
const STAFFCD = $('#STAFFCD');
const SUPCURCD = $('#SUPCURCD');
const PURDUEDT = $('#PURDUEDT');

const input_serach = [PRNO, PONO, DIVISIONCD, SUPPLIERCD, STAFFCD, SUPCURCD];

// action button
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('purchseOrderEntryTHA');

for (const icon of serach_icon) {
  icon.click(function () {
    keepData();
  });
}

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
}

PRNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PRNO', PRNO.val());
    }
    if (PRNO.val() == '') unsetSession(form);
});

PONO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PONO', PONO.val());
    }
    if (PONO.val() == '') unsetSession(form);
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

SUPPLIERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERCD', SUPPLIERCD.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

SUPCURCD.on('keyup change', function (e) {
    if(SUPPLIERCD.val() == '') {
        vlidationSupplier();
        $('#loading').hide();
        return false;
    }
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPCURCD', SUPCURCD.val());
    }
});

// action
COMMIT.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  return actionDialog(3);
  // form.submit();
});

CANCEL.click(function () {
  return actionDialog(4);
});

PRINT.click(function () {
  return actionDialog(2);
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_PURCHSEORDERENTRY_THA/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    var supcurdisp = document.getElementsByName('SUPCURDISP');
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
                if(key == 'SUPCURCD') {
                    for (var i = 0; i < supcurdisp.length; i++) {
                        supcurdisp[i].value = value;
                    }
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

async function getElementIndex(code, value, index) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('index', index);
    data.append('action', code);
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+index+'')) {
                    document.getElementById(''+key+index+'').value = value;
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

async function action(action) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            if (action == 'commit') {
                if(objectArray(result)) {
                    return window.location.href = 'index.php?PONO=' + result['PONO'];
                } else {
                    return getMessage(result.replace('ERRO:',''));
                }
            } else {
                return window.location.reload();
            }
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
       $('#loading').hide();
    });
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'print');
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(result, function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
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
        return actionDialog(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSessionItem(lineIndex) {
    let data = new FormData();
    data.append('action', 'unsetsessionItem');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_PURCHSEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
        return window.location.href = '../ACC_PURCHSEORDERENTRY_THA/index.php?ITEMCD=';
        // window.location.reload();
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
        case 'checkbox':
            inputs[i].checked = false;
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

    // clearing textarea
    var text = form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

    // clearing table
    // $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = '../ACC_PURCHSEORDERENTRY_THA/';

    return false;
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
            } else if (type == 2) {
                return printed();
            } else if (type == 3) {
                return action('commit');
            } else if (type == 4) {
                return action('cancel');
            }
        }
    });
}

function itemValidation(error, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: error,
        showCancelButton: false,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
          //
        }
    });
}

function searchItemIndex(lineIndex) {
    // console.log(lineIndex);
    keepItemData();
    if(SUPPLIERCD.val() == '') {
        vlidationSupplier();
        return false;
    }
    return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_PURCHSEORDERENTRY_THA&index=' + lineIndex, 'authWindow', 'width=1200,height=600');
}

function changeRowIds() {
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
    $('table tbody').append(
        '<tr class="row-empty" id="rowId' + n + ">" +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td>' +
          '<td class="class="h-6 border border-slate-700""></td></tr>'
    );
}

function popupwindow(url, w, h) {
    var y = window.outerHeight / 2 + window.screenY - h / 2;
    var x = window.outerWidth / 2 + window.screenX - w / 2;
    return window.open(url, '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + y + ', left=' + x);
}

function calculateamt(x) {
  // console.log(x);
    let amount = 0;
    let prices = 0;
    let qty = $('#PURQTY' + x + '').val().replace(/,/g, '');
    let unitprice = $('#PURUNITPRC' + x + '').val().replace(/,/g, '');
    let discount = $('#DISCOUNT' + x + '').val().replace(/,/g, '');
    // getAmt(qty, unitprice, discount);
    prices = parseFloat(qty) * parseFloat(unitprice);
    amount = prices - parseFloat(discount);
    // console.log(amount);
    // set amount per one feach
    $('#PURAMT' + x + '').val(num2digit(amount));
    keepItemData();
    subtotal();
}

function subtotal() {
    let itemamount = document.getElementsByName('PURAMT[]');
    let sumtotal = 0;
    for (let i = 0; i < itemamount.length; i++) {
        sumtotal += parseFloat(itemamount[i].value.replace(/,/g, '')) || 0;
        // console.log(itemamount[i].value);
    }
    $('#S_TTL').val(num2digit(sumtotal));
    $('#DISCRATE').val('0');
    $('#DISCOUNTAMOUNT').val('0.00');
    $('#QUOTEAMOUNT').val(num2digit(sumtotal));
    keepData();
    vat();
}

function discount() {
    let discount = 0;
    let afeterdc = 0;
    let subtotal = $('#S_TTL').val().replace(/,/g, '');
    let disrate = $('#DISCRATE').val().replace(/,/g, '');
    if (parseInt($('#DISCRATE').val()) > 100) {
        disrate = 100;
    } else {
        disrate = $('#DISCRATE').val();
    }
    discount = parseFloat(disrate) * (parseFloat(subtotal) / 100);
    afeterdc = subtotal - discount;
    $('#DISCOUNTAMOUNT').val(num2digit(discount));
    $('#QUOTEAMOUNT').val(num2digit(afeterdc));
    $('#T_AMOUNT').val(num2digit(afeterdc));
    keepData();
    vat();
}

function vat() {
    // VATCALCTYP
    let quoteamt = $('#QUOTEAMOUNT').val().replace(/,/g, '');
    let vatamt = 0;
    let toal = 0;
    vatamt = (parseFloat($('#VATRATE').val()) / 100) * parseFloat(quoteamt); //* $('#GROUPRT').val()
    toal = parseFloat(quoteamt) + parseFloat(vatamt);
    $('#VATAMOUNT1').val(num2digit(vatamt));
    $('#T_AMOUNT').val(num2digit(toal));
    keepData();
}

function onSearch(Parameter) {
  const param = $('#' + Parameter + '');
  param.on('keyup change', function (e) {
    if (e.type === 'change') {
      // $('#loading').show();
      window.location.href = 'index.php?' + Parameter + '=' + param.val();
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      // $('#loading').show();
      window.location.href = 'index.php?' + Parameter + '=' + param.val();
    }
  });
}

function unRequired() {
    document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERCD').classList[document.getElementById('SUPPLIERCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('PURDUEDT').classList[document.getElementById('PURDUEDT').value !== '' ? 'remove' : 'add']('req');
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'row-empty');
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

// function printReport() {
//   var popupWindow = window.open('../ACC_PURCHSEORDERENTRY_THA/print.php', '_blank', 'width=800, height=800');
//   setTimeout(function () {
//     popupWindow.close();
//   }, 10000);
//   // var printReport = document.getElementById('printReport');
//   // var popupWindow = window.open('', '_blank', 'width=800, height=800');
//   // var popupWindow = window.open('../ACC_PURCHSEORDERENTRY_THA/print.php', '_blank', 'width=800, height=800');
//   // popupWindow.document.open();
//   // popupWindow.document.write('<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><link type='text/css' href='./css/print.css' rel='stylesheet'></head>');
//   // popupWindow.document.write('<body onload='window.print()'>' + printReport.innerHTML + '</body></html>');
//   // popupWindow.document.write('<body>' + printReport.innerHTML + '</body></html>');
//   // popupWindow.document.close();
//   // setTimeout(function() { popupWindow.close(); }, 1000);
// }