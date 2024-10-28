// search
const SEARCHSALEORDER = $('#SEARCHSALEORDER');
const SEARCHSALETRAN_ACC = $('#SEARCHSALETRAN_ACC');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHSTAFF = $('#SEARCHSTAFF');

SEARCHSALEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=ACC_SALEENTRY_THA3_MFG', 'authWindow', 'width=1280,height=720');});
SEARCHSALETRAN_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALETRAN_ACC/index.php?page=ACC_SALEENTRY_THA3_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_SALEENTRY_THA3_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_SALEENTRY_THA3_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_SALEENTRY_THA3_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEENTRY_THA3_MFG', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSALEORDER, SEARCHSALETRAN_ACC, SEARCHCUSTOMER, SEARCHDIVISION, SEARCHCURRENCY, SEARCHSTAFF];

//input serach
const SALETRANNO = $('#SALETRANNO');
const SALEORDERNO = $('#SALEORDERNO');
const DIVISIONCD = $('#DIVISIONCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const STAFFCD = $('#STAFFCD');
const SVNO = $('#SVNO');
const input_serach = [ SALETRANNO, SALEORDERNO, DIVISIONCD, CUSTOMERCD, CUSCURCD, STAFFCD];

// form
const form = document.getElementById('saleentrymfg');

// action button
const COMMIT = $('#COMMIT');
const INV = $('#INV');
const SALEV = $('#SALEV');
const TAXINV = $('#TAXINV');
const REPLACEZ = $('#REPLACEZ');

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
}

for (const input of serach_icon) {
    input.click(function () {
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
});

REPLACEZ.click(function () {
    $('#loading').show();
    return replacez();
    // return window.location.href = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ACC_RESALEENTRY_THA/index.php?SALETRANNO=' + SALETRANNO.val() + '&SVNO=' + SVNO.val() + '&page=ACC_SALEENTRY_THA3_MFG';
});

INV.click(function () {
    return printed('IVprint');
});

TAXINV.click(function () {
    return printed('TIVprint');
});

SALEV.click(function () {
    return SVprint();
});

SALETRANNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SALETRANNO', SALETRANNO.val());
    }
    if (SALETRANNO.val() == '') unsetSession(form);
});

SALEORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SALEORDERNO', SALEORDERNO.val());
    }
    if (SALEORDERNO.val() == '') unsetSession(form);
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
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEENTRY_THA3_MFG/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const cuscurdisp = document.getElementsByName('CUSCURDISP');
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
                if(key == 'CUSCURCD') {
                    for (var i = 0; i < cuscurdisp.length; i++) {
                        cuscurdisp[i].value = value;
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
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
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
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            if(objectArray(result)) {
                successValidation();
                document.getElementById('REPLACEZ').disabled = true;
                document.getElementById('INV').disabled = result.SYSEN_PRINTINV == 'F' ? true : false;
                document.getElementById('COMMIT').disabled = result.SYSEN_COMMIT == 'F' ? true : false;
                document.getElementById('SALEV').disabled = result.SYSEN_PRINTVOU == 'F' ? true : false;
                document.getElementById('TAXINV').disabled = result.SYSEN_PRINTTAXINV == 'F' ? true : false;
                document.getElementById('INV').classList[result.SYSVIS_PRINTINV == 'F' ? 'add' : 'remove']('hidden');
                document.getElementById('SALEV').classList[result.SYSVIS_PRINTVOU == 'F' ? 'add' : 'remove']('hidden');
                document.getElementById('TAXINV').classList[result.SYSVIS_PRINTTAXINV == 'F' ? 'add' : 'remove']('hidden');
                if(REPLACEMODE == 1) { document.getElementById('COMMIT').disabled = true; }

                $.each(result, function(key, value) {
                    // console.log(key, '=>', value);
                    if(document.getElementById(''+key+'')) {
                        document.getElementById(''+key+'').value = value;
                    }                
                    // if(document.getElementById(''+key.split('/').shift()+'')) {
                    //     document.getElementById(''+key.split('/').shift()+'').disabled = value == 'F' ? true : false;
                    // }
                });
                // document.getElementById('REPLACEZ').classList[result.SYSVIS_REPLACE == 'F' ? 'add' : 'remove']('hidden');
                // document.getElementById('REPLACEZ').disabled = result.SYSEN_REPLACE == 'F' ? true : false;
                $('#loading').hide();
                // return window.location.href = 'index.php?SALETRANNO=' + result['SALETRANNO'];
            } else {
                return getMessage(result.replace('ERRO:',''));
            }
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function replacez() {
    $('#loading').show();
    data.append('action', 'replacez');
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            var elements = document.getElementsByClassName('SALEDIVCON2');
            for (let i = 0; i < elements.length; i++) { elements[i].style.display = 'none'; }
            document.getElementById('COMMIT').disabled = result.SYSEN_COMMIT == 'F' ? true : false;
            document.getElementById('REPLACEZ').disabled = result.SYSEN_REPLACE == 'F' ? true : false;
            document.getElementById('INV').classList[result.SYSVIS_PRINTINV == 'F' ? 'add' : 'remove']('hidden');
            document.getElementById('SALEV').classList[result.SYSVIS_PRINTVOU == 'F' ? 'add' : 'remove']('hidden');
            document.getElementById('TAXINV').classList[result.SYSVIS_PRINTTAXINV == 'F' ? 'add' : 'remove']('hidden');
            document.getElementById('SYSVIS_CANCELSALETRANNO').classList[result.SYSVIS_CANCELSALETRANNO == 'F' ? 'add' : 'remove']('hidden');
            document.getElementById('reprints').style.display = result.SYSVIS_REPRINTREASON == 'F' ? 'none' : 'block';
            document.getElementById('SALEDIVCON2').style.display = result.SYSVIS_SALEDIVCON2 == 'F' ? 'none' : 'block';
            document.getElementById('SALEDIVCON2CBO').style.display = result.SYSVIS_SALEDIVCON2CBO == 'F' ? 'none' : 'block';

            $.each(result, function(key, val) {
                // console.log(key, '=>', val);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = val;
                }
            });
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function printed(printTYPE) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', printTYPE);
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            if(checkArray(result)) {
                $.each(result, function(key, value) {
                    // console.log(value.url);
                    if(objectArray(value.printFlg)) {
                        $.each(value.printFlg, function(index, val) {
                            // console.log(val);
                            document.getElementById('COMMIT').disabled = val.SYSEN_COMMIT == 'F' ? true : false;
                            document.getElementById('REPLACEZ').disabled = val.SYSEN_REPLACE == 'F' ? true : false;
                            document.getElementById('STAFFCD').classList[val.SYSEN_STAFFCD == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('VATRATE').classList[val.SYSEN_VATRATE == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('CUSCURCD').classList[val.SYSEN_CUSCURCD == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('DISCRATE').classList[val.SYSEN_DISCRATE == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALETERM').classList[val.SYSEN_SALETERM == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('REPLACEZ').classList[val.SYSVIS_REPLACE == 'F' ? 'add' : 'remove']('hidden');
                            document.getElementById('reprints').classList[val.SYSVIS_REPRINTLBL == 'F' ? 'add' : 'remove']('hidden');
                            document.getElementById('DIVISIONCD').classList[val.SYSEN_DIVISIONCD == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('CUSTOMERCD').classList[val.SYSEN_CUSTOMERCD == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALEORDERNO').classList[val.SYSEN_SALEORDERNO == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('ESTCUSSTAFF').classList[val.SYSEN_ESTCUSSTAFF == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('DESCRIPTION').classList[val.SYSEN_DESCRIPTION == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALECUSMEMO').classList[val.SYSEN_SALECUSMEMO == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALEDIVCON1').classList[val.SYSEN_SALEDIVCON1 == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALEDIVCON2').classList[val.SYSEN_SALEDIVCON2 == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALEDIVCON3').classList[val.SYSEN_SALEDIVCON3 == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('REPRINTREASON').classList[val.SYSEN_REPRINTREASON == 'F' ? 'add' : 'remove']('read');
                            document.getElementById('SALETRANINSPDT').classList[val.SYSEN_SALETRANINSPDT == 'T' ? 'remove' : 'add']('read');

                            document.getElementById('reprints').style.display = val.SYSVIS_REPRINTREASON == 'F' ? 'none' : 'block';

                            if(val.SYSEN_DVW == 'F') { document.getElementById('table').classList.add('read');
                                var readItem = document.getElementsByClassName('item-read');
                                for(var i = 0; i < readItem.length; i++) {
                                    readItem[i].classList.add('read');
                                }
                            }
                        });
                    } else {
                        downloader($('#sessionUrl').val() + value.url, value.filename);
                    }
                });
            } else {
                document.getElementById('reprints').style.display = 'block';
                document.getElementById('REPRINTREASON').classList.remove('read')
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

async function setSaleDivCon2() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'setSaleDivCon2');
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        document.getElementById('SALEDIVCON2').value = result.SALEDIVCON2;
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getAmt() {
    const data = new FormData(form);
    data.append('action', 'getAmt');
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
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
        return alertError(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
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
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
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
    await axios.post('../ACC_SALEENTRY_THA3_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
        return window.location.href = '../ACC_SALEENTRY_THA3_MFG/index.php';
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
    $('#table > tbody > tr').remove();

    // refresh
    window.location.replace('../ACC_SALEENTRY_THA3_MFG/');

    return false;
}

function calculateDVW() {
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
    let prices = 0;
    let qty = $('#SALEQTY' + x + '').val().replace(/,/g, '');
    let unitprice = $('#SALEUNITPRC' + x + '').val().replace(/,/g, '');
    let discount = $('#SALEDISCOUNT' + x + '').val().replace(/,/g, '');
    // getAmt(qty, unitprice, discount);
    prices = parseFloat(qty) * parseFloat(unitprice);
    amount = prices - parseFloat(discount);
    // console.log(amount);
    // set amount per one feach
    $('#SALEAMT' + x + '').val(num2digit(amount));
    keepItemData();
    subtotal();
}

function subtotal() {
    let itemamount = document.getElementsByName('SALEAMT[]');
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
    let quoteamt = $('#QUOTEAMOUNT').val().replace(/,/g, '');
    let vatamt = 0;
    let toal = 0;
    vatamt = (parseFloat($('#VATRATE').val()) / 100) * parseFloat(quoteamt); //* $('#GROUPRT').val()
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
                    // $('#loading').show();
                    // return canceled();
                } else if (type == 3) {
                    $('#loading').show();
                    return commited();
                } else if (type == 4) {
                    return printed('SVPrint');
                } else {
                    // taxInvoiceReport();
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