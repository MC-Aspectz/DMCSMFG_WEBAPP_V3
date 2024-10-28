// search
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHQUOTE = $('#SEARCHQUOTE');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHSTAFFS = $('#SEARCHSTAFFS');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHDELIVERY = $('#SEARCHDELIVERY');
const SEARCHCUSTOMERS = $('#SEARCHCUSTOMERS');
const SEARCHSALEORDER = $('#SEARCHSALEORDER');
const SEARCHSALEORDER1 = $('#SEARCHSALEORDER1');
const SEARCHSALEORDER2 = $('#SEARCHSALEORDER2');

SEARCHQUOTE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHQUOTE/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHSALEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHDELIVERY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDELIVERY/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHSALEORDER1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=ACC_SALEORDERENTRY_MFG_SEARCH&index=SERSONO1', 'authWindow', 'width=1200,height=600');});
SEARCHSALEORDER2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=ACC_SALEORDERENTRY_MFG_SEARCH&index=SERSONO2', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMERS.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_SALEORDERENTRY_MFG_SEARCH', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFFS.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEORDERENTRY_MFG_SEARCH', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHCUSTOMERS, SEARCHSTAFFS];

// input data
const ESTNO = $('#ESTNO');
const ITEMCD = $('#ITEMCD');
const STAFFCD = $('#STAFFCD');
const CUSCURCD = $('#CUSCURCD');
const DIVISIONCD = $('#DIVISIONCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const DELIVERYCD = $('#DELIVERYCD');
const SALEORDERNO = $('#SALEORDERNO');

// input serach
const SERCUSTCD = $('#SERCUSTCD');
const SERSTAFFCD = $('#SERSTAFFCD');

const input_serach = [ ESTNO, SALEORDERNO, DIVISIONCD, CUSTOMERCD, CUSCURCD, STAFFCD, ITEMCD];

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const NEWITEM = $('#NEWITEM');
const SAVEITEM = $('#SAVEITEM');
const DELITEM = $('#DELITEM');
const PRINT = $('#PRINT');
const CSV = $('#CSV');

// form
const form = document.getElementById('soentrymfg');

for (const input of serach_icon) {
    input.click(function () {
        keepData();
    });
}

SEARCH.click(async function() {
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

COMMIT.click(function () {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return action('COMMIT');
});

CANCEL.click(function () {
    return actionDialog('CANCEL');
});

PRINT.click(function () {
    return actionDialog('PRINT');
});

CSV.click(function() {
    return exportCSV();
});

ESTNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        if (ESTNO.val() == '') clearForm();
        return getElement('ESTNO', ESTNO.val());
    }
});

SALEORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        if (SALEORDERNO.val() == '') clearForm();
        return getElement('SALEORDERNO', SALEORDERNO.val());
    }
});

DIVISIONCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

CUSTOMERCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

CUSCURCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSCURCD', CUSCURCD.val());
    }
});

STAFFCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

DELIVERYCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DELIVERYCD', DELIVERYCD.val());
    }
});

SERCUSTCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SERCUSTCD', SERCUSTCD.val());
    }
});

SERSTAFFCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SERSTAFFCD', SERSTAFFCD.val());
    }
});

ITEMCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        if(CUSTOMERCD.val() == '' || CUSTOMERCD.val() == 'undefined') {
            document.getElementById('ITEMCD').value = '';
            return getMessage('ERRO_NO_CUTOMER');
        } else if(CUSCURCD.val()== '' || CUSCURCD.val()== 'undefined') {
            document.getElementById('ITEMCD').value = '';
            return getMessage('ERRO_NOCURCD');
        } else {
            return getElement('ITEMCD', ITEMCD.val());
        }
    }
});

SEARCHITEM.click(function() {
    if(CUSTOMERCD.val() == '' || CUSTOMERCD.val() == 'undefined') {
        document.getElementById('ITEMCD').value = '';
        return getMessage('ERRO_NO_CUTOMER');
    } else if(CUSCURCD.val()== '' || CUSCURCD.val()== 'undefined') {
        document.getElementById('ITEMCD').value = '';
        return getMessage('ERRO_NOCURCD');
    } else {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_SALEORDERENTRY_MFG', 'authWindow', 'width=1200,height=600');
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const cuscurdisp = document.getElementsByName('CUSCURDISP');
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_SALEORDERENTRY_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result.ITEM);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    if(key == 'SALEISSUEDT') {
                        document.getElementById(''+key+'').value = dateFormat(value);
                    } else if(key == 'S_TTL' || key == 'DISCOUNTAMOUNT' || key == 'QUOTEAMOUNT' || key == 'VATRATE' || key == 'VATAMOUNT1' || key == 'VATAMOUNT' || key == 'T_AMOUNT') {
                        document.getElementById(''+key+'').value = num2digits(value);
                    } else if(key == 'CUSCURCD') {
                        document.getElementById('CUSCURCD').value = value;
                        document.getElementById('CUSCURDISP').value = value;
                        for (var i = 0; i < cuscurdisp.length; i++) {
                            cuscurdisp[i].value = value;
                        }
                    } else {
                        document.getElementById(''+key+'').value = value;
                    }
                }

                if (key.includes('SYSEN_')) {
                    // console.log(value);
                    if(document.getElementById(''+key.replace('SYSEN_', '')+'')) {
                        document.getElementById(''+key.replace('SYSEN_', '')+'').classList[value == 'T' ? 'remove' : 'add']('read');
                    }
                }
            });
            // ------------------------ Table Item --------------------------- //
            let rowcount =  $('.row-id').length || 0;
            let index = 0;
            let maxrowz = document.getElementById('maxrow').value;
            const dvwdetail = document.getElementById('dvwdetail');
            if(objectArray(result.ITEM)) {
                $.each(result.ITEM, function(key, value) {
                    // console.log(key, '=>', value);
                    index = index+1;
                    if(index <= maxrowz) {
                        // console.log('key : '+ key+ ':' + index);
                        if(document.getElementById('rowId'+key+'')) {
                            document.getElementById('rowId'+key+'').classList.remove('row-empty');
                            document.getElementById('rowId'+key+'').classList.add('row-id');  
                        }

                        $('#LINE_TXT'+key+'').html(value.ROWNO);
                        $('#CODE_TXT'+key+'').html(value.ITEMCD);            
                        $('#DESCRIPTION_TXT'+key+'').html(value.ITEMNAME);      
                        $('#QUANTITY_TXT'+key+'').html(num2digits(value.SALELNQTY));      
                        $('#UOM_TXT'+key+'').html(result.UNIT.hasOwnProperty(value.ITEMUNITTYP) ? result.UNIT[value.ITEMUNITTYP]: '');      
                        $('#UNIT_PRICE_TXT'+key+'').html(num2digits(value.SALELNUNITPRC));      
                        $('#DISCOUNT_TXT'+key+'').html(num2digits(value.SALELNDISCOUNT));    
                        $('#AMOUNT_TXT'+key+'').html(num2digits(value.SALELNAMT));   
                        $('#DUE_DATE_TXT'+key+'').html(value.SALELNDUEDT ? dateFormat(value.SALELNDUEDT): '');      
                        $('#DELIVERY_DATE_TXT'+key+'').html(value.SALELNPLANSHIPDT ? dateFormat(value.SALELNPLANSHIPDT): '');   
                        $('#REMARKS_TXT'+key+'').html(value.SALELNREM);    

                        document.getElementById('ROWNO'+key+'').value = value.hasOwnProperty('ROWNO') ? value.ROWNO: '';
                        document.getElementById('ITEMCD'+key+'').value = value.hasOwnProperty('ITEMCD') ? value.ITEMCD: '';
                        document.getElementById('ITEMNAME'+key+'').value = value.hasOwnProperty('ITEMNAME') ? value.ITEMNAME: '';
                        document.getElementById('SALELNQTY'+key+'').value = value.hasOwnProperty('SALELNQTY') ? value.SALELNQTY: '';
                        document.getElementById('ITEMUNITTYP'+key+'').value = value.hasOwnProperty('ITEMUNITTYP') ? value.ITEMUNITTYP: '';
                        document.getElementById('SALELNUNITPRC'+key+'').value = value.hasOwnProperty('SALELNUNITPRC') ? value.SALELNUNITPRC: '';
                        document.getElementById('SALELNDISCOUNT'+key+'').value = value.hasOwnProperty('SALELNDISCOUNT') ? value.SALELNDISCOUNT: '';
                        document.getElementById('SALELNAMT'+key+'').value = value.hasOwnProperty('SALELNAMT') ? value.SALELNAMT: '';
                        document.getElementById('SALELNDUEDT'+key+'').value = value.hasOwnProperty('SALELNDUEDT') ? value.SALELNDUEDT: '';
                        document.getElementById('SALELNPLANSHIPDT'+key+'').value = value.hasOwnProperty('SALELNPLANSHIPDT') ? value.SALELNPLANSHIPDT: '';
                        document.getElementById('SALELNREM'+key+'').value = value.hasOwnProperty('SALELNREM') ? value.SALELNREM: '';
                        document.getElementById('SALELNDISCOUNT2'+key+'').value = value.hasOwnProperty('SALELNDISCOUNT2') ? value.SALELNDISCOUNT2: '';
                        document.getElementById('SALELNTAXAMT'+key+'').value = value.hasOwnProperty('SALELNTAXAMT') ? value.SALELNTAXAMT: '';
                        document.getElementById('CUSPONO'+key+'').value = value.hasOwnProperty('CUSPONO') ? value.CUSPONO: '';
                        document.getElementById('SALELNSHIPQTY'+key+'').value = value.hasOwnProperty('SALELNSHIPQTY') ? value.SALELNSHIPQTY: '';
                        document.getElementById('SALELNSHIPREQQTY'+key+'').value = value.hasOwnProperty('SALELNSHIPREQQTY') ? value.SALELNSHIPREQQTY: '';      
                        document.getElementById('SALELNSTATUS'+key+'').value = value.hasOwnProperty('SALELNSTATUS') ? value.SALELNSTATUS: '';
                    } else {
                        generateRows(key, value, result.UNIT);
                    }
                });
            }
            $('#rowCount').html(index);
            // --------------------------------------------------------------- //
            let cancelled = result.SYSVIS_CANCELLBL != '' ? result.SYSVIS_CANCELLBL: 'F';  // SD230300002
            Array.from(document.getElementsByClassName('ctrl-read')).forEach(ctrlRead => {
                ctrlRead.classList[cancelled == 'T' ? 'add' : 'remove']('read');
            });
            // console.log(result.SYSVIS_DELETE);
            // document.getElementById('ESTNO').classList.remove('read');
            // document.getElementById('SALEORDERNO').classList.remove('read');
            // document.getElementById('SEARCHQUOTE').classList.remove('read');
            // document.getElementById('SEARCHSALEORDER').classList.remove('read');
            document.getElementById('table').classList[cancelled == 'T' ? 'add' : 'remove']('read');
            document.getElementById('CANCELMSG').classList[cancelled == 'T' ? 'remove' : 'add']('hidden');
            // document.getElementById('DELETE').classList[result.SYSVIS_DELETE == 'T' ? 'remove' : 'add']('hidden');
            document.getElementById('CANCEL').disabled = document.getElementById('SALEORDERNO').value != '' ? false : true;
            document.getElementById('PRINT').disabled = document.getElementById('SALEORDERNO').value != '' ? false : true;
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
    await axios.post('../ACC_SALEORDERENTRY_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            $('#loading').hide();
            if(method == 'COMMIT') {
                let result = response.data;
                if(objectArray(result)) {
                    document.getElementById('SALEORDERNO').value = result.SALEORDERNO;;
                } else {
                    return getMessage(result.replace('ERRO:',''));
                }
            } else {
                return clearForm();
            }
        }
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'PRINT');
    await axios.post('../ACC_SALEORDERENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(response.data,function(key, value) {
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

async function exportCSV() {
    // Variable to store the final csv data
    let SALEORDERNO_TXT = (document.getElementById('SALEORDERNO_TXT').innerText || document.getElementById('SALEORDERNO_TXT').textContent);
    let INPUT_DATE_TXT = (document.getElementById('INPUT_DATE_TXT').innerText || document.getElementById('INPUT_DATE_TXT').textContent);
    let CUSTOMERCODE_TXT = (document.getElementById('CUSTOMERCODE_TXT').innerText || document.getElementById('CUSTOMERCODE_TXT').textContent);
    let PERSON_RESPONSE_TXT = (document.getElementById('PERSON_RESPONSE_TXT').innerText || document.getElementById('PERSON_RESPONSE_TXT').textContent);
    let SERINPDATE1 = $('#SERINPDATE1').val() != '' ? $('#SERINPDATE1').val():'--/--/----';
    let SERINPDATE2 = $('#SERINPDATE2').val() != '' ? $('#SERINPDATE2').val():'--/--/----';
    var csv_data = [SALEORDERNO_TXT + ',' + $('#SERSONO1').val() + ',→,' + $('#SERSONO2').val()];
        csv_data.push(INPUT_DATE_TXT + ',' + SERINPDATE1 + ',→,' +SERINPDATE2);
        csv_data.push(CUSTOMERCODE_TXT + ',' + $('#SERCUSTCD').val() + ',' + $('#SERCUSTNAME').val());
        csv_data.push(PERSON_RESPONSE_TXT + ',' + $('#SERSTAFFCD').val() + ',' + $('#SERSTAFFNAME').val());
    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 1; x < cols.length; x++) {
            csvrow.push('\"'+cols[x].innerText+'\"');
        }
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function getAmt() {
  const data = new FormData(form);
  data.append('action', 'getAmt');
  await axios.post('../ACC_SALEORDERENTRY_MFG/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
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
    await axios.post('../ACC_SALEORDERENTRY_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function programDelete() {
    $('#loading').show();
    const appcode = $('#appcode').val();
    const appurl = $('#sessionUrl').val();
    let data = new FormData();
    data.append('FAPPCD', appcode);
    data.append('PROGRAMDELETE', 'programDelete');
    await axios.post(appurl + '/common/setsession.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(result['APPOPEN'] > 0) {
            return window.close();
        } else {
            return window.location.href = $('#sessionUrl').val() + '/home.php';
        }
        document.getElementById('loading').style.display = 'none';    
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function calcAmount() {
    let amount = 0;
    let prices = 0;
    let qty = $('#SALELNQTY').val().replace(/,/g, '');
    let unitprice = $('#SALELNUNITPRC').val().replace(/,/g, '');
    let discount = $('#SALELNDISCOUNT').val().replace(/,/g, '');
    prices = parseFloat(qty) * parseFloat(unitprice);
    amount = prices - parseFloat(discount);
    // console.log(amount);
    $('#SALELNAMT').val(num2digit(amount));
}

function calcDiscount() {
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
    calcVat();
}

function calcVat() {
    let quoteamt = $('#QUOTEAMOUNT').val().replace(/,/g, '');
    let vatamt = 0;
    let toal = 0;
    vatamt = parseFloat(quoteamt) * (parseFloat($('#VATRATE').val()) / 100);
    toal = parseFloat(quoteamt) + parseFloat(vatamt);
    $('#VATAMOUNT1').val(num2digit(vatamt));
    $('#T_AMOUNT').val(num2digit(toal));
}

function calcTotal() {
    let SALELNAMT = document.getElementsByName('SALELNAMTZ[]');
    let SUMSALELNAMT = 0;  let QUOTEAMOUNT = 0; let VATAMOUNT1 = 0; let T_AMOUNT = 0;
    let DISCOUNTAMOUNT = parseFloat($('#DISCOUNTAMOUNT').val().replace(/,/g, '')) || 0;
    for (let i = 0; i < SALELNAMT.length; i++) {
        SUMSALELNAMT += parseFloat(SALELNAMT[i].value.replace(/,/g, '')) || 0;
    }
    QUOTEAMOUNT = SUMSALELNAMT - DISCOUNTAMOUNT;
    $('#S_TTL').val(num2digit(SUMSALELNAMT));
    $('#QUOTEAMOUNT').val(num2digit(QUOTEAMOUNT));
    VATAMOUNT1 = parseFloat(QUOTEAMOUNT) * (parseFloat($('#VATRATE').val()) / 100);
    T_AMOUNT = parseFloat(QUOTEAMOUNT) + parseFloat(VATAMOUNT1);
    $('#VATAMOUNT1').val(num2digit(VATAMOUNT1));
    $('#T_AMOUNT').val(num2digit(T_AMOUNT));
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
                    return action('COMMIT');
                } else if (type == 3) {
                    return action('CANCEL');
                } else {
                   return printed();
                }
            }
    });
}

function alertDialog(error, btnyes, btnno) {
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

function itemEntry() {

    document.getElementById('ROWNO').value = '';
    document.getElementById('ITEMCD').value = '';
    document.getElementById('ITEMNAME').value = '';
    document.getElementById('SALELNQTY').value = '';
    document.getElementById('ITEMUNITTYP').value = '';
    document.getElementById('SALELNUNITPRC').value = '';
    document.getElementById('SALELNDISCOUNT').value = '';
    document.getElementById('SALELNAMT').value = '';
    document.getElementById('SALELNDUEDT').value = '';
    document.getElementById('SALELNPLANSHIPDT').value = '';
    document.getElementById('SALELNREM').value = '';

    document.getElementById('DELITEM').disabled = true;
    $('table#table tbody tr').not(this).removeClass('selected-row');
}

async function clearForm() {
    // clearing inputs
    document.getElementById('SALEORDERNO').value = '';
    document.getElementById('ITEMCD').classList.remove('read');
    const form_data = document.getElementById('form_data');
    var inputs = form_data.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
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

    document.getElementById('SALEISSUEDT').valueAsDate = new Date();

    // clearing select
    var selectoption = form_data.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form_data.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }


    Array.from(document.getElementsByClassName('ctrl-read')).forEach(ctrlRead => {
        ctrlRead.classList.remove('read');
    });

    document.getElementById('table').classList.remove('read');
    document.getElementById('COMMIT').classList.remove('read');
    document.getElementById('CANCELMSG').classList.add('hidden');

    emptyRows(); 

    document.getElementById('PRINT').disabled = true;
    document.getElementById('CANCEL').disabled = true;
    
    $('#rowCount').html('0');

    unRequired();

    return false;
}

function emptySearchRows(maxrow) {
    let rowcount =  $('.search-id').length || 0;
    const searchdetail = document.getElementById('searchdetail');
    $('#table-search tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'searchrow'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        var colhide = document.createElement('td');
        colhide.setAttribute('class', 'hidden search-seq');
        row.appendChild(colhide);
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        searchdetail.appendChild(row);
    }
}

function emptyRows(minrow) {
    // let rowcount =  $('.row-id').length || 1;
    let maxrow = document.getElementById('maxrow').value;
    $('#dvwdetail').empty();
    for (var x = 1; x <= maxrow; x++) {
        $('#dvwdetail').append('<tr class="divide-y divide-gray-200 row-empty" id="rowId'+x+'">' +
                                '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="LINE_TXT'+x+'"></td>' +
                                '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CODE_TXT'+x+'"></td>' +
                                '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DESCRIPTION_TXT'+x+'"></td>' +
                                '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="QUANTITY_TXT'+x+'"></td>' +
                                '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="UOM_TXT'+x+'"></td>' +
                                '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="UNIT_PRICE_TXT'+x+'"></td>' +
                                '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="DISCOUNT_TXT'+x+'"></td>' +
                                '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="AMOUNT_TXT'+x+'"></td>' +
                                '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DUE_DATE_TXT'+x+'"></td>' +
                                '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DELIVERY_DATE_TXT'+x+'"></td>' +
                                '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="REMARKS_TXT'+x+'"></td>' +
                                '<td class="hidden"><input class="hidden" id="ROWNO'+x+'" name="ROWNOZ[]" value=""/>' +
                                '<input class="hidden" id="ITEMCD'+x+'" name="ITEMCDZ[]" value=""/>' +
                                '<input class="hidden" id="ITEMNAME'+x+'" name="ITEMNAMEZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNQTY'+x+'" name="SALELNQTYZ[]" value=""/>' +
                                '<input class="hidden" id="ITEMUNITTYP'+x+'" name="ITEMUNITTYPZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNUNITPRC'+x+'" name="SALELNUNITPRCZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNDISCOUNT'+x+'" name="SALELNDISCOUNTZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNAMT'+x+'" name="SALELNAMTZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNDUEDT'+x+'" name="SALELNDUEDTZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNPLANSHIPDT'+x+'" name="SALELNPLANSHIPDTZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNREM'+x+'" name="SALELNREMZ[]" value=""/>' +
                                '<input class="hidden" id="SALELNDISCOUNT2'+x+'" name="SALELNDISCOUNT2Z[]" value=""/>' +
                                '<input class="hidden" id="SALELNTAXAMT'+x+'" name="SALELNTAXAMTZ[]"  value=""/>' +
                                '<input class="hidden" id="CUSPONO'+x+'" name="CUSPONOZ[]"  value=""/>' +
                                '<input class="hidden" id="SALELNSHIPQTY'+x+'" name="SALELNSHIPQTYZ[]"  value=""/>' +
                                '<input class="hidden" id="SALELNSHIPREQQTY'+x+'" name="SALELNSHIPREQQTYZ[]"  value=""/>' +
                                '<input class="hidden" id="SALELNSTATUS'+x+'" name="SALELNSTATUSZ[]"  value=""/></td>' +
                                '</tr>');
    }
    
    $('#rowCount').html($('.row-id').length || 0);

    itemEntry();
    return calcTotal();
}

function generateSaveItem(index, _delete) {
    let id = index; if(_delete) { id = ''; }
    let ITEMUNITTYP = document.getElementById('ITEMUNITTYP');
    let ITEMUNITNAME = ITEMUNITTYP.options[ITEMUNITTYP.selectedIndex].text;
    $('#dvwdetail').append( '<tr class="divide-y divide-gray-200 row-id" id="rowId'+index+'">' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="LINE_TXT'+index+'">'+String(id)+'</td>' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CODE_TXT'+index+'">'+String(document.getElementById('ITEMCD').value)+'</td>' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DESCRIPTION_TXT'+index+'">'+String(document.getElementById('ITEMNAME').value)+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="QUANTITY_TXT'+index+'">'+String(document.getElementById('SALELNQTY').value)+'</td>' +
                            '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="UOM_TXT'+index+'">'+String(ITEMUNITNAME)+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="UNIT_PRICE_TXT'+index+'">'+String(document.getElementById('SALELNUNITPRC').value)+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="DISCOUNT_TXT'+index+'">'+String(document.getElementById('SALELNDISCOUNT').value)+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="AMOUNT_TXT'+index+'">'+String(document.getElementById('SALELNAMT').value)+'</td>' +
                            '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DUE_DATE_TXT'+index+'">'+String(document.getElementById('SALELNDUEDT').value)+'</td>' +
                            '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DELIVERY_DATE_TXT'+index+'">'+String(document.getElementById('SALELNPLANSHIPDT').value)+'</td>' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="REMARKS_TXT'+index+'">'+String(document.getElementById('SALELNREM').value)+'</td>' +
                            '<td class="hidden"><input class="hidden" id="ROWNO'+index+'" name="ROWNOZ[]" value="'+String(id)+'"/>' +
                            '<input class="hidden" id="ITEMCD'+index+'" name="ITEMCDZ[]" value="'+String(document.getElementById('ITEMCD').value)+'"/>' +
                            '<input class="hidden" id="ITEMNAME'+index+'" name="ITEMNAMEZ[]" value="'+String(document.getElementById('ITEMNAME').value)+'"/>' +
                            '<input class="hidden" id="SALELNQTY'+index+'" name="SALELNQTYZ[]" value="'+String(document.getElementById('SALELNQTY').value)+'"/>' +
                            '<input class="hidden" id="ITEMUNITTYP'+index+'" name="ITEMUNITTYPZ[]" value="'+String(document.getElementById('ITEMUNITTYP').value)+'"/>' +
                            '<input class="hidden" id="SALELNUNITPRC'+index+'" name="SALELNUNITPRCZ[]" value="'+String(document.getElementById('SALELNUNITPRC').value)+'"/>' +
                            '<input class="hidden" id="SALELNDISCOUNT'+index+'" name="SALELNDISCOUNTZ[]" value="'+String(document.getElementById('SALELNDISCOUNT').value)+'"/>' +
                            '<input class="hidden" id="SALELNAMT'+index+'" name="SALELNAMTZ[]" value="'+String(document.getElementById('SALELNAMT').value)+'"/>' +
                            '<input class="hidden" id="SALELNDUEDT'+index+'" name="SALELNDUEDTZ[]" value="'+String(document.getElementById('SALELNDUEDT').value ? document.getElementById('SALELNDUEDT').value.replace(',', ''): '')+'"/>' +
                            '<input class="hidden" id="SALELNPLANSHIPDT'+index+'" name="SALELNPLANSHIPDTZ[]" value="'+String(document.getElementById('SALELNPLANSHIPDT').value ? document.getElementById('SALELNPLANSHIPDT').value.replace(',', ''): '')+'"/>' +
                            '<input class="hidden" id="SALELNREM'+index+'" name="SALELNREMZ[]" value="'+String(document.getElementById('SALELNREM').value)+'"/>' +
                            '<input class="hidden" id="SALELNDISCOUNT2'+index+'" name="SALELNDISCOUNT2Z[]" value=""/>' +
                            '<input class="hidden" id="SALELNTAXAMT'+index+'" name="SALELNTAXAMTZ[]" value=""/>' +
                            '<input class="hidden" id="CUSPONO'+index+'" name="CUSPONOZ[]" value=""/>' +
                            '<input class="hidden" id="SALELNSHIPQTY'+index+'" name="SALELNSHIPQTYZ[]" value=""/>' +
                            '<input class="hidden" id="SALELNSHIPREQQTY'+index+'" name="SALELNSHIPREQQTYZ[]"  value=""/>' +
                            '<input class="hidden" id="SALELNSTATUS'+index+'" name="SALELNSTATUSZ[]" value=""/></td>' +
                            '</tr>');

    document.getElementById('rowId'+index+'').classList.remove('row-id');
    document.getElementById('rowId'+index+'').classList.add('row-empty');  

    calcTotal();
    return itemEntry();
}

function generateRows(index, value, unit) {
    let reqdate = value.SALELNDUEDT ? dateFormat(value.SALELNDUEDT): '';
    let shipdate = value.SALELNPLANSHIPDT ? dateFormat(value.SALELNPLANSHIPDT): '';
    let itemunit = unit.hasOwnProperty(value.ITEMUNITTYP) ? unit[value.ITEMUNITTYP]: '';
    let rowno = value.hasOwnProperty('ROWNO') ? value.ROWNO: '';
    let itemcd = value.hasOwnProperty('ITEMCD') ? value.ITEMCD: '';
    let itemname = value.hasOwnProperty('ITEMNAME') ? value.ITEMNAME: '';
    let saleqty = value.hasOwnProperty('SALELNQTY') ? value.SALELNQTY: '';
    let itemtype = value.hasOwnProperty('ITEMUNITTYP') ? value.ITEMUNITTYP: '';
    let unitprc = value.hasOwnProperty('SALELNUNITPRC') ? value.SALELNUNITPRC: '';
    let discount = value.hasOwnProperty('SALELNDISCOUNT') ? value.SALELNDISCOUNT: '';    
    let saleamt = value.hasOwnProperty('SALELNAMT') ? value.SALELNAMT: '';
    let duedt = value.hasOwnProperty('SALELNDUEDT') ? value.SALELNDUEDT: '';
    let shipdt = value.hasOwnProperty('SALELNPLANSHIPDT') ? value.SALELNPLANSHIPDT: '';
    let remark = value.hasOwnProperty('SALELNREM') ? value.SALELNREM: '';
    let discount2 = value.hasOwnProperty('SALELNDISCOUNT2') ? value.SALELNDISCOUNT2: '';
    let taxamt = value.hasOwnProperty('SALELNTAXAMT') ? value.SALELNTAXAMT: '';
    let cuspo = value.hasOwnProperty('CUSPONO') ? value.CUSPONO: '';
    let shipqty = value.hasOwnProperty('SALELNSHIPQTY') ? value.SALELNSHIPQTY: '';
    let shipreqqty = value.hasOwnProperty('SALELNSHIPREQQTY') ? value.SALELNSHIPREQQTY: '';
    let salestatus = value.hasOwnProperty('SALELNSTATUS') ? value.SALELNSTATUS: '';
    $('#dvwdetail').append('<tr class="divide-y divide-gray-200 row-empty" id="rowId'+index+'">' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="LINE_TXT'+index+'">'+String(value.ROWNO)+'</td>' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CODE_TXT'+index+'">'+String(value.ITEMCD)+'</td>' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DESCRIPTION_TXT'+index+'">'+String(value.ITEMNAME)+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="QUANTITY_TXT'+index+'">'+String(num2digit(value.SALELNQTY))+'</td>' +
                            '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="UOM_TXT'+index+'">'+String(itemunit)+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="UNIT_PRICE_TXT'+index+'">'+String(num2digit(value.SALELNUNITPRC))+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="DISCOUNT_TXT'+index+'">'+String(num2digit(value.SALELNDISCOUNT))+'</td>' +
                            '<td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="AMOUNT_TXT'+index+'">'+String(num2digit(value.SALELNAMT))+'</td>' +
                            '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DUE_DATE_TXT'+index+'">'+String(reqdate)+'</td>' +
                            '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DELIVERY_DATE_TXT'+index+'">'+String(shipdate)+'</td>' +
                            '<td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="REMARKS_TXT'+index+'">'+String(value.SALELNREM)+'</td>' +
                            '<td class="hidden"><input class="hidden" id="ROWNO'+index+'" name="ROWNOZ[]" value="'+String(rowno)+'"/>' +
                            '<input class="hidden" id="ITEMCD'+index+'" name="ITEMCDZ[]" value="'+String(itemcd)+'"/>' +
                            '<input class="hidden" id="ITEMNAME'+index+'" name="ITEMNAMEZ[]" value="'+String(itemname)+'"/>' +
                            '<input class="hidden" id="SALELNQTY'+index+'" name="SALELNQTYZ[]" value="'+String(saleqty)+'"/>' +
                            '<input class="hidden" id="ITEMUNITTYP'+index+'" name="ITEMUNITTYPZ[]" value="'+String(itemtype)+'"/>' +
                            '<input class="hidden" id="SALELNUNITPRC'+index+'" name="SALELNUNITPRCZ[]" value="'+String(unitprc)+'"/>' +
                            '<input class="hidden" id="SALELNDISCOUNT'+index+'" name="SALELNDISCOUNTZ[]" value="'+String(discount)+'"/>' +
                            '<input class="hidden" id="SALELNAMT'+index+'" name="SALELNAMTZ[]" value="'+String(saleamt)+'"/>' +
                            '<input class="hidden" id="SALELNDUEDT'+index+'" name="SALELNDUEDTZ[]" value="'+String(duedt)+'"/>' +
                            '<input class="hidden" id="SALELNPLANSHIPDT'+index+'" name="SALELNPLANSHIPDTZ[]" value="'+String(shipdt)+'"/>' +
                            '<input class="hidden" id="SALELNREM'+index+'" name="SALELNREMZ[]" value="'+String(remark)+'"/>' +
                            '<input class="hidden" id="SALELNDISCOUNT2'+index+'" name="SALELNDISCOUNT2Z[]" value="'+String(discount2)+'"/>' +
                            '<input class="hidden" id="SALELNTAXAMT'+index+'" name="SALELNTAXAMTZ[]" value="'+String(taxamt)+'"/>' +
                            '<input class="hidden" id="CUSPONO'+index+'" name="CUSPONOZ[]" value="'+String(cuspo)+'"/>' +
                            '<input class="hidden" id="SALELNSHIPQTY'+index+'" name="SALELNSHIPQTYZ[]" value="'+String(shipqty)+'"/>' +
                            '<input class="hidden" id="SALELNSHIPREQQTY'+index+'" name="SALELNSHIPREQQTYZ[]"  value="'+String(shipreqqty)+'"/>' +
                            '<input class="hidden" id="SALELNSTATUS'+index+'" name="SALELNSTATUSZ[]" value="'+String(salestatus)+'"/></td>' +
                            '</tr>');
}

function shiftRowTb(itemindex, tblenght) {
    for (var seq = itemindex; seq <= tblenght; seq++) {
        let shift = Number(seq) + 1;
        // if(seq != 1)
        if (document.getElementById('ROWNO'+shift+'')) {
            $('#LINE_TXT'+seq+'').html($('#LINE_TXT'+shift+'').html());
            $('#CODE_TXT'+seq+'').html($('#CODE_TXT'+shift+'').html());       
            $('#DESCRIPTION_TXT'+seq+'').html($('#DESCRIPTION_TXT'+shift+'').html());      
            $('#QUANTITY_TXT'+seq+'').html($('#QUANTITY_TXT'+shift+'').html());    
            $('#UOM_TXT'+seq+'').html($('#UOM_TXT'+shift+'').html());
            $('#UNIT_PRICE_TXT'+seq+'').html($('#UNIT_PRICE_TXT'+shift+'').html());   
            $('#DISCOUNT_TXT'+seq+'').html($('#DISCOUNT_TXT'+shift+'').html());   
            $('#AMOUNT_TXT'+seq+'').html($('#AMOUNT_TXT'+shift+'').html()); 
            $('#DUE_DATE_TXT'+seq+'').html($('#DUE_DATE_TXT'+shift+'').html());      
            $('#DELIVERY_DATE_TXT'+seq+'').html($('#DELIVERY_DATE_TXT'+shift+'').html());
            $('#REMARKS_TXT'+seq+'').html($('#REMARKS_TXT'+shift+'').html());  

            document.getElementById('ROWNO'+seq+'').value = document.getElementById('ROWNO'+shift+'').value;
            document.getElementById('ITEMCD'+seq+'').value = document.getElementById('ITEMCD'+shift+'').value;
            document.getElementById('ITEMNAME'+seq+'').value = document.getElementById('ITEMNAME'+shift+'').value;
            document.getElementById('SALELNQTY'+seq+'').value = document.getElementById('SALELNQTY'+shift+'').value;
            document.getElementById('ITEMUNITTYP'+seq+'').value = document.getElementById('ITEMUNITTYP'+shift+'').value;
            document.getElementById('SALELNUNITPRC'+seq+'').value = document.getElementById('SALELNUNITPRC'+shift+'').value;
            document.getElementById('SALELNDISCOUNT'+seq+'').value = document.getElementById('SALELNDISCOUNT'+shift+'').value;
            document.getElementById('SALELNAMT'+seq+'').value = document.getElementById('SALELNAMT'+shift+'').value;
            document.getElementById('SALELNDUEDT'+seq+'').value = document.getElementById('SALELNDUEDT'+shift+'').value;
            document.getElementById('SALELNPLANSHIPDT'+seq+'').value = document.getElementById('SALELNPLANSHIPDT'+shift+'').value;
            document.getElementById('SALELNREM'+seq+'').value = document.getElementById('SALELNREM'+shift+'').value;
            document.getElementById('SALELNDISCOUNT2'+seq+'').value = document.getElementById('SALELNDISCOUNT2'+shift+'').value;
            document.getElementById('SALELNTAXAMT'+seq+'').value = document.getElementById('SALELNTAXAMT'+shift+'').value;
            document.getElementById('CUSPONO'+seq+'').value = document.getElementById('CUSPONO'+shift+'').value;
            document.getElementById('SALELNSHIPQTY'+seq+'').value = document.getElementById('SALELNSHIPQTY'+shift+'').value;
            document.getElementById('SALELNSHIPREQQTY'+seq+'').value = document.getElementById('SALELNSHIPREQQTY'+shift+'').value;
            document.getElementById('SALELNSTATUS'+seq+'').value = document.getElementById('SALELNSTATUS'+shift+'').value;

            document.getElementById('rowId'+shift+'').classList.remove('row-id');
            document.getElementById('rowId'+shift+'').classList.add('row-empty');  
            
            if(document.getElementById('ROWNO'+seq+'').value) {
                document.getElementById('rowId'+seq+'').classList.remove('row-empty');
                document.getElementById('rowId'+seq+'').classList.add('row-id');
            }
        }
    }

    // re generate sequence
    $('.row-id').each(function (n) {
        let no = n+1;
        // console.log(no);
        $('#LINE_TXT'+no+'').html(no);
         document.getElementById('ROWNO'+no+'').value = no;
    });
}

function unRequired() {
    document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('CUSTOMERCD').classList[document.getElementById('CUSTOMERCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
}