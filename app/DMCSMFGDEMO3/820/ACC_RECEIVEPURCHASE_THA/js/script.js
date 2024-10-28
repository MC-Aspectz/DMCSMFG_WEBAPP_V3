// search
const SEARCHPURCHASEORDER = $('#SEARCHPURCHASEORDER');
const SEARCHPURRECTRAN_ACC = $('#SEARCHPURRECTRAN_ACC');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');

SEARCHPURCHASEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php?page=ACC_RECEIVEPURCHASE_THA', 'authWindow', 'width=1200,height=720');});
SEARCHPURRECTRAN_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURRECTRAN_ACC/index.php?page=ACC_RECEIVEPURCHASE_THA', 'authWindow', 'width=1200,height=720');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_RECEIVEPURCHASE_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_RECEIVEPURCHASE_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_RECEIVEPURCHASE_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_RECEIVEPURCHASE_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHPURCHASEORDER, SEARCHPURRECTRAN_ACC, SEARCHDIVISION, SEARCHSUPPLIER, SEARCHSTAFF, SEARCHCURRENCY];

//input serach
const PVNO = $('#PVNO');
const PONO = $('#PONO');
const DIVISIONCD = $('#DIVISIONCD');
const SUPPLIERCD = $('#SUPPLIERCD');
const STAFFCD = $('#STAFFCD');
const SUPCURCD = $('#SUPCURCD');
const PURDUEDT = $('#PURDUEDT');
const ADD05 = $('#ADD05');
const ADD11 = $('#ADD11');
const INSPDT = $('#INSPDT');

const input_serach = [ DIVISIONCD, SUPPLIERCD, STAFFCD, SUPCURCD, ADD11, INSPDT];

// action button
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PURCHV = $('#PURCHV');
const TODISTRIBUTION = $('#TODISTRIBUTION');

// form
const form = document.getElementById('purchseOrderEntryTHA');

for (const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
}

for (const input of input_serach) {
    input.on('keyup change', async function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepItemData();
            await keepData();
        }
    });
}

PVNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PVNO', PVNO.val());
    }
    if (PVNO.val() == '') unsetSession(form);
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
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPCURCD', SUPCURCD.val());
    }
});

ADD11.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ADD11', ADD11.val());
    }
});

INSPDT.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('INSPDT', INSPDT.val());
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

TODISTRIBUTION.click(function () {
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  return action('distribute');
  // form.submit();
});

CANCEL.click(function () {
  return actionDialog(4);
});

PURCHV.click(function () {
  return action('PURCHV');
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_RECEIVEPURCHASE_THA/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    var supcurdisp = document.getElementsByName('SUPCURDISP');
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
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
                if(key == 'SUPCURCD') {
                    for (var i = 0; i < supcurdisp.length; i++) {
                        supcurdisp[i].value = value;
                    }
                }
                if(key == 'SYSVIS_INVOICEDATEOVER' & value == 'F') {
                    document.getElementById('invoicedateovr').classList.add('hidden');
                } else {
                    document.getElementById('invoicedateovr').classList.remove('hidden'); 
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
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
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
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == 200) {
            let result = response.data;
            // console.log(result['PVNO']);
            if (action == 'commit') {
                if(objectArray(result)) {
                    if (result['SYSMSG'] == 'INFODMCSREM2' || result['SYSMSG'] == '') {
                        actionDialog(5);
                        return window.location.href ='index.php?PVNO=' + result['PVNO'];
                    } else if (result['SYSMSG'] == 'NOTITEM') {
                        return actionDialog(6);
                    } else {
                        return getMessage(result['SYSMSG'].replace('ERRO:',''));
                    }
                } else {
                    return window.location.reload();
                }
            } else if (action == 'distribute') {
                $('#loading').hide();
            } else if (action == 'PURCHV') {
                if (result == 'ERRO:ERRONOTFOUNDPRINTDATA') {
                    return getMessage(result.replace('ERRO:',''));
                } else {
                    $('#loading').hide();
                    return printed();
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
    data.append('action', 'PURCHV');
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            // console.log(checkArray(result));
            if(checkArray(result)) {
                $.each(result, function(key, value) {
                    // console.log(value.url);
                    downloader($('#sessionUrl').val() + value.url, value.filename);
                });
            } else {
                return getMessage(result);
            }
        }
        $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function getVat(action) {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', action);
  await axios
    .post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
    .then((response) => {
      $('#loading').hide();
      // console.log(response.data);
      if (response.status == 200) {
        // $('#VATAMOUNT1').val(response.data['VATAMOUNT1']);
        $('#VATAMOUNT1').val(num2digit(parseFloat(response.data['VATAMOUNT1'].replace(/,/g, ''))));
      }
      keepData();
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function checkItemTable(index, action) {
  let ITEMCD_DVW = $('#ITEMCD'+index+'').val();
  let CALCIE_DVW = $('#CALCIE'+index+'').val();
  let FIFOFLG_DVW = $('#FIFOFLG'+index+'').val();
  let IEAMT_DVW = $('#IEAMT'+index+'').val();
  const data = new FormData(form);
  data.append('action', action);
  data.append('ITEMCD_DVW', ITEMCD_DVW);
  data.append('CALCIE_DVW', CALCIE_DVW);
  data.append('FIFOFLG_DVW', FIFOFLG_DVW);
  data.append('IEAMT_DVW', IEAMT_DVW);
  $('#loading').show();
  await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
    .then((response) => {
      $('#loading').hide();
      // console.log(response.data);
        if (action == 'checkDistribute') {
            $('#FIFOFLG'+index+'').val(response.data['FIFOFLG']);
            if (response.data['FIFOFLG'] == 'T') {
                document.getElementById('CALCIE'+index+'').value =
                response.data['CALCIE'];
            }
        } else if (action == 'checkIEAmt') {
        if (response.data['IEAMT'] != '') {
        $('#IEAMT' + index + '').val(
        num2digit(parseFloat(response.data['IEAMT'].replace(/,/g, ''))));
        } else {
        $('#IEAMT'+index+'').val(response.data['IEAMT']);
        }
    }
    keepItemData();
    })
    .catch((e) => {
        // console.log(e);
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

  await axios
    .post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
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
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
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
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
        return clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSessionItem(lineIndex) {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'unsetsessionItem');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_RECEIVEPURCHASE_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        return window.location.href = '../ACC_RECEIVEPURCHASE_THA/index.php';
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
    window.location.href = '../ACC_RECEIVEPURCHASE_THA/';

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
        } else if (type == 3) {
            return action('commit');
        } else if (type == 4) {
            return action('cancel');
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
        cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
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
    '<tr class="row-empty" id="rowId' +  n + ">" +
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
        '<td class="h-6 border border-slate-700"></td></tr>'
    );
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'row-empty');
        for (var z = 1; z <= 11; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
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
    let qty = $('#PURQTY'+x+'').val().replace(/,/g, '');
    let unitprice = $('#PURUNITPRC'+x+'').val().replace(/,/g, '');
    let discount = $('#DISCOUNT'+x+'').val().replace(/,/g, '');
    // getAmt(qty, unitprice, discount);
    prices = parseFloat(qty) * parseFloat(unitprice);
    amount = prices - parseFloat(discount);
    // console.log(amount);
    // set amount per one feach
    $('#PURAMT'+x+'').val(num2digit(amount));
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
    let subtotal = decimalnum($('#S_TTL').val());
    let disrate = decimalnum($('#DISCRATE').val());
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
    let quoteamt = decimalnum($('#QUOTEAMOUNT').val());
    let vatamt = 0;
    let total = 0;
    vatamt = (parseFloat($('#VATRATE').val()) / 100) * parseFloat(quoteamt); //* $('#GROUPRT').val()
    // console.log('quoteamt:' + quoteamt);
    // console.log('vatamt:' + vatamt);
    total = parseFloat(quoteamt) + parseFloat(vatamt);
    // console.log('total:' + total);
    $('#VATAMOUNT1').val(num2digit(vatamt));
    $('#T_AMOUNT').val(num2digit(total));
      $('#VATRATE').val(num2digit($('#VATRATE').val()));
    keepData();
}

function unRequired() {
    document.getElementById('ADD05').classList[document.getElementById('ADD05').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ADD11').classList[document.getElementById('ADD11').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERCD').classList[document.getElementById('SUPPLIERCD').value !== '' ? 'remove' : 'add']('req');
}

function onSearch(Parameter) {
  const param = $('#' + Parameter + '');
  param.on('keyup change', function (e) {
    if (e.type === 'change' || e.key === 'Enter' || e.keyCode === 13) {
      // $('#loading').show();
      window.location.href = 'index.php?' + Parameter + '=' + param.val();
    }
  });
}

// function printReport() {
//   var popupWindow = window.open('../ACC_RECEIVEPURCHASE_THA/print.php?REPRINTREASON=' + $('#REPRINTREASON').val(), '_blank', 'width=800, height=800');
//   setTimeout(function () {
//     popupWindow.close();
//   }, 10000);
// }