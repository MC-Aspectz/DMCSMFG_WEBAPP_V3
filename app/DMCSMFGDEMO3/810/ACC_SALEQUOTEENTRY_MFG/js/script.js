// search
const SEARCHQUOTE = $('#SEARCHQUOTE');
const CLONEQUOTE = $('#CLONEQUOTE');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHSTAFF = $('#SEARCHSTAFF');
// const CLOSEPAGE = $('#CLOSEPAGE');

SEARCHQUOTE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHQUOTE/index.php?page=ACC_SALEQUOTEENTRY_MFG', 'authWindow', 'width=1200,height=600');});

CLONEQUOTE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHQUOTE/index.php?page=ACC_SALEQUOTEENTRY_MFG_CLONE', 'authWindow', 'width=1200,height=600');});

SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_SALEQUOTEENTRY_MFG', 'authWindow', 'width=1200,height=600');});

SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_SALEQUOTEENTRY_MFG', 'authWindow', 'width=1200,height=600');});

SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_SALEQUOTEENTRY_MFG', 'authWindow', 'width=1200,height=600');});

SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEQUOTEENTRY_MFG', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHQUOTE, SEARCHDIVISION, SEARCHCUSTOMER, SEARCHCURRENCY, SEARCHSTAFF];

//input serach
const ESTNO = $('#ESTNO');
const DIVISIONCD = $('#DIVISIONCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const STAFFCD = $('#STAFFCD');
const input_serach = [DIVISIONCD, CUSTOMERCD, CUSCURCD, STAFFCD];

// form
const form = document.getElementById('quoteentryMFG');

// action button
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PRINT = $('#PRINT');

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
}

for (const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
}

COMMIT.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  return commitDialog();
  // form.submit();
});

CANCEL.click(function () {
  return cancelDialog();
});

PRINT.click(function () {
  return printDialog();
});

ESTNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('ESTNO', ESTNO.val());
    }
    if (ESTNO.val() == '') unsetSession(form);
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

CUSTOMERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

CUSCURCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSCURCD', CUSCURCD.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    if(code == 'ESTNOCLONE') {
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEQUOTEENTRY_MFG/index.php?ESTNOCLONE=' + value;
    } else {
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEQUOTEENTRY_MFG/index.php?'+code+'=' + value;
    }
}

async function getElement(code, value) {
    $('#loading').show();
    var cuscurdisp = document.getElementsByName('CUSCURDISP');
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;

                    if(key == 'CUSCURDISP') {
                        for (var i = 0; i < cuscurdisp.length; i++) {
                            cuscurdisp[i].value = value;
                        }
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
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
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

async function commited() {
    const data = new FormData(form);
    data.append('action', 'commit');
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            if(objectArray(result)) {
                return window.location.href = 'index.php?ESTNO=' + result['ESTNO'];
            } else {
                return getMessage(result.replace('ERRO:',''));
            }
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function canceled() {
    const data = new FormData(form);
    data.append('action', 'cancel');
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
      // window.location.href='index.php';
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'print');
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(response.data, function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getAmt() {
    const data = new FormData(form);
    data.append('action', 'getAmt');
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
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
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'QuoteEntry');
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSessionItem(lineIndex) {
    let data = new FormData();
    data.append('action', 'unsetsessionItem');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_SALEQUOTEENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      return window.location.href = '../ACC_SALEQUOTEENTRY_MFG/index.php';
      // window.location.reload();
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
            case 'date':
                break;
            case 'checkbox':
                inputs[i].checked = false;
                break;
            case 'radio':
                inputs[i].checked = false;
                break;                
            default:
                inputs[i].value = '';
        }
    }
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

    // clearing table
    $('#table > tbody > tr').remove();

    // refresh
    window.location.href = '../ACC_SALEQUOTEENTRY_MFG/';

    return false;
}

function calculateDVW() {
    subtotal();
    let VATAMOUNT = $('#VATAMOUNT').val().replace(/,/g, '');
    let VATAMOUNT1 = $('#VATAMOUNT1').val().replace(/,/g, '');
    let QUOTEAMOUNT = $('#QUOTEAMOUNT').val().replace(/,/g, '');
    let T_AMOUNT = parseFloat(VATAMOUNT) + parseFloat(VATAMOUNT1) + parseFloat(QUOTEAMOUNT);
    // console.log(T_AMOUNT);
    $('#T_AMOUNT').val(num2digit(T_AMOUNT));
}

function calculateamt(x) {
    // console.log(x);
    let amount = 0;
    let price;
    let qty = $('#ESTLNQTY' + x + '').val().replace(/,/g, '');
    let unitprice = $('#ESTLNUNITPRC' + x + '').val().replace(/,/g, '');
    let discount = $('#ESTDISCOUNT' + x + '').val().replace(/,/g, '');
    price = parseFloat(qty) * parseFloat(unitprice);
    amount = price - parseFloat(discount);
    // set amount per one feach
    $('#ESTLNAMTDISP' + x + '').val(num2digit(amount));
    keepItemData();
    subtotal();
}

function subtotal() {
    let itemamount = document.getElementsByName('ESTLNAMTDISP[]');
    let sumtotal = 0;
    for (let i = 0; i < itemamount.length; i++) {
        sumtotal += parseFloat(itemamount[i].value.replace(/,/g, '')) || 0;
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
    keepData();
    vat();
}

function vat() {
  // VATCALCTYP
  let quoteamt = $('#QUOTEAMOUNT').val().replace(/,/g, '');
  let vatamt = 0;
  let toal = 0;
  vatamt = parseFloat(quoteamt) * (parseFloat($('#VATRATE').val()) / 100);
  toal = parseFloat(quoteamt) + parseFloat(vatamt);
  $('#VATAMOUNT1').val(num2digit(vatamt));
  $('#T_AMOUNT').val(num2digit(toal));
  keepData();
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
                $('#loading').show();
                return canceled();
            } else if (type == 3) {
                $('#loading').show();
                return commited();
            } else {
                return printed();
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

function unRequired() {
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('CUSTOMERCD').classList[document.getElementById('CUSTOMERCD').value !== '' ? 'remove' : 'add']('req');
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