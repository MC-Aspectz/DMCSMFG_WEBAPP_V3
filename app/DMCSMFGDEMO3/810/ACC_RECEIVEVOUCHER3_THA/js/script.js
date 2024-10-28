// icon search
const SEARCHRECMONEYTRAN_ACC = $('#SEARCHRECMONEYTRAN_ACC');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHACCOUNT = $('#SEARCHACCOUNT');

SEARCHRECMONEYTRAN_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHRECMONEYTRAN_ACC/index.php?page=ACC_RECEIVEVOUCHER3_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_RECEIVEVOUCHER3_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_RECEIVEVOUCHER3_THA', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_RECEIVEVOUCHER3_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_RECEIVEVOUCHER3_THA', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACC_RECEIVEVOUCHER3_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHRECMONEYTRAN_ACC, SEARCHCUSTOMER, SEARCHCURRENCY, SEARCHDIVISION, SEARCHSTAFF, SEARCHACCOUNT];

//input serach
const RVNO = $('#RVNO'); 
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const DIVISIONCD = $('#DIVISIONCD');
const STAFFCD = $('#STAFFCD');
const ACCCD = $('#ACCCD');
const DCTYP = $('#DCTYP');
const TTLRECFEE = $('#TTLRECFEE');
const REPRINTREASON = $('#REPRINTREASON');

const input_serach = [ CUSTOMERCD, CUSCURCD, DIVISIONCD, STAFFCD, ACCCD];

// form
const form = document.getElementById('acc_receivevoucher');

// action button
const SEARCH = $('#SEARCH');
const SETACC = $('#SETACC');
const ENTRY = $('#ENTRY');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL')
const RECEIPT = $('#RECEIPT')
const BTNTAXINV = $('#BTNTAXINV')
const BTNTAXINVREC = $('#BTNTAXINVREC')
const RCVVC = $('#RCVVC')

for(const icon of serach_icon){
    icon.click(function () {
        keepData();
    });
};

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
}

COMMIT.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    return action('commit');
});

CANCEL.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    return actionDialog(2);
});

SEARCH.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    keepData();
    $('#loading').show();
});

SETACC.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    if(TTLRECFEE.val() != '0.00' || TTLRECFEE.val() != '') {
        keepData();
        $('#loading').show();
        keepSaleItemData();
    }
});

UPDATE.click(function() {
    // check validate form
    $('#loading').show();
    return update();
});


ENTRY.click(function() {
    return emptyAcc();
});

RECEIPT.click(function() {
    if(RVNO.val() == '') {
        return actionDialog(5);
    }
    return printCheck('RCprint');
});

BTNTAXINV.click(function() {
    if(REPRINTREASON.val() == '') {
        return actionDialog(4);
    } 
    return printCheck('TAXINVprint');
});

BTNTAXINVREC.click(function() {
    if(REPRINTREASON.val() == '') {
        return actionDialog(4);
    } 
    return printCheck('TAXINVRecprint');
});

RCVVC.click(function() {
    // if(REPRINTREASON.val() == '') {
    //     return actionDialog(4);
    // } 
    return printCheck('RVprint');
});

RVNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('RVNO', RVNO.val());
    }
    if (RVNO.val() == '') unsetSession(form);
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

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

ACCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ACCCD', ACCCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_RECEIVEVOUCHER3_THA/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
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
        unRequired();
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
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(objectArray(response.data));
        if(response.status == '200') {
            let result = response.data;
            if(action == 'commit') {
                if(objectArray(result)) {
                    return window.location.href='index.php?RVNO=' + result['RVNO'];
                } else {
                    $('#loading').hide();
                    if(result == 'ERRO:ERRO_NOT_EQUAL_DEBIT_AND_CREDIT' || result == 'ERRO:ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT') {
                        return actionDialog(result.replace('ERRO:',''));
                    }
                    return getMessage(result.replace('ERRO:',''));
                }
            } else if(action == 'cancel') {
                clearForm(form);
                // return window.location.reload();
            }
        }
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function printCheck(type) {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', type + 'check');
  await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            if(objectArray(result)) {
                $.each(result, function(key, value) {
                    if(document.getElementById(''+key+'')) {
                        document.getElementById(''+key+'').value = value;
                    }
                });
                return printed(type);
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

async function printed(type) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', type);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
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

async function setSelReceived(x) {
    // console.log(x);
    var result; let status;
    const data = new FormData(form);
    data.append('action', 'setSelReceived');
    data.append('RECEIVEDV_SEL', $('#RECEIVEDV_SEL'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_OSTDAMT', $('#CALCBASE_OSTDAMT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_VAT', $('#CALCBASE_VAT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_WHT', $('#CALCBASE_WHT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_OSTDTTLAMT', $('#CALCBASE_OSTDTTLAMT'+x+'').val().replace(/,/g, ''));
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        result = response.data;
        $('#RECEIVEDV_SEL'+x+'').val(result['RECEIVEDV_SEL']);
        $('#RECEIVEDV_OSTDAMT'+x+'').val(result['RECEIVEDV_OSTDAMT']);
        $('#RECEIVEDV_OSTDVAT'+x+'').val(result['RECEIVEDV_OSTDVAT']);
        $('#RECEIVEDV_OSTDWHT'+x+'').val(result['RECEIVEDV_OSTDWHT']);
        $('#RECEIVEDV_OSTDTTLAMT'+x+'').val(result['RECEIVEDV_OSTDTTLAMT']);
        $('#RECEIVEDV_RECAMT'+x+'').val(result['RECEIVEDV_RECAMT']);
        $('#RECEIVEDV_RECFEE'+x+'').val(result['RECEIVEDV_RECFEE']);
        $('#RECEIVEDV_RECVAT'+x+'').val(result['RECEIVEDV_RECVAT']);
        $('#RECEIVEDV_RECWHT'+x+'').val(result['RECEIVEDV_RECWHT']);
        $('#RECEIVEDV_RECTTLAMT'+x+'').val(result['RECEIVEDV_RECTTLAMT']);
        $('#RECEIVEDV_STATUS'+x+'').val(result['RECEIVEDV_STATUS']);
        // ---------------------------------------------------------------//
        $('#RECEIVEDV_OSTDAMT_TD'+x+'').html(result['RECEIVEDV_OSTDAMT']);
        $('#RECEIVEDV_OSTDVAT_TD'+x+'').html(result['RECEIVEDV_OSTDVAT']);
        $('#RECEIVEDV_OSTDWHT_TD'+x+'').html(result['RECEIVEDV_OSTDWHT']);
        $('#RECEIVEDV_OSTDTTLAMT_TD'+x+'').html(result['RECEIVEDV_OSTDTTLAMT']);
        $('#RECEIVEDV_RECVAT_TD'+x+'').html(result['RECEIVEDV_RECVAT']);
        $('#RECEIVEDV_RECTTLAMT_TD'+x+'').html(result['RECEIVEDV_RECTTLAMT']);
        if(result['RECEIVEDV_STATUS'] == '0') { status = 'Outstanding'; } else if(result['RECEIVEDV_STATUS'] == '1') { status = 'Processed'; } else { status = ''; }
        $('#RECEIVEDV_STATUS_TD'+x+'').html(status);
        keepSaleItemData();
        calculateSaleTotal();
        // $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function setCalcReceived(x) {
    const data = new FormData(form);
    data.append('action', 'setCalcReceived');
    data.append('CALCBASE_OSTDAMT', $('#CALCBASE_OSTDAMT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_VAT', $('#CALCBASE_VAT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_WHT', $('#CALCBASE_WHT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_OSTDTTLAMT', $('#CALCBASE_OSTDTTLAMT'+x+'').val().replace(/,/g, ''));
    data.append('VATRATE', $('#VATRATE'+x+'').val().replace(/,/g, ''));
    data.append('WHTRATE', $('#WHTRATE'+x+'').val().replace(/,/g, ''));
    data.append('RECEIVEDV_SEL', $('#RECEIVEDV_SEL'+x+'').val().replace(/,/g, ''));
    data.append('RECEIVEDV_STATUS', $('#RECEIVEDV_STATUS'+x+'').val().replace(/,/g, ''));
    data.append('RECEIVEDV_RECAMT', $('#RECEIVEDV_RECAMT'+x+'').val().replace(/,/g, ''));
    data.append('RECEIVEDV_RECFEE', $('#RECEIVEDV_RECFEE'+x+'').val().replace(/,/g, ''));
    data.append('RECEIVEDV_RECWHT', $('#RECEIVEDV_RECWHT'+x+'').val().replace(/,/g, ''));
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        result = response.data;
        $('#RECEIVEDV_OSTDAMT'+x+'').val(result['RECEIVEDV_OSTDAMT']);
        $('#RECEIVEDV_OSTDTTLAMT'+x+'').val(result['RECEIVEDV_OSTDTTLAMT']);
        $('#RECEIVEDV_OSTDVAT'+x+'').val(result['RECEIVEDV_OSTDVAT']);
        $('#RECEIVEDV_OSTDWHT'+x+'').val(result['RECEIVEDV_OSTDWHT']);
        $('#RECEIVEDV_RECAMT'+x+'').val(result['RECEIVEDV_RECAMT']);
        $('#RECEIVEDV_RECFEE'+x+'').val(result['RECEIVEDV_RECFEE']);
        $('#RECEIVEDV_RECTTLAMT'+x+'').val(result['RECEIVEDV_RECTTLAMT']);
        $('#RECEIVEDV_RECVAT'+x+'').val(result['RECEIVEDV_RECVAT']);
        $('#RECEIVEDV_RECWHT'+x+'').val(result['RECEIVEDV_RECWHT']);
        $('#RECEIVEDV_SEL'+x+'').val(result['RECEIVEDV_SEL']);
        $('#RECEIVEDV_STATUS'+x+'').val(result['RECEIVEDV_STATUS']);
        // VR
        // ---------------------------------------------------------------//
        $('#RECEIVEDV_OSTDAMT_TD'+x+'').html(result['RECEIVEDV_OSTDAMT']);
        $('#RECEIVEDV_OSTDVAT_TD'+x+'').html(result['RECEIVEDV_OSTDVAT']);
        $('#RECEIVEDV_OSTDWHT_TD'+x+'').html(result['RECEIVEDV_OSTDWHT']);
        $('#RECEIVEDV_OSTDTTLAMT_TD'+x+'').html(result['RECEIVEDV_OSTDTTLAMT']);
        $('#RECEIVEDV_RECVAT_TD'+x+'').html(result['RECEIVEDV_RECVAT']);
        $('#RECEIVEDV_RECTTLAMT_TD'+x+'').html(result['RECEIVEDV_RECTTLAMT']);
        if(result['RECEIVEDV_STATUS'] == '0') { status = 'Outstanding'; } else if(result['RECEIVEDV_STATUS'] == '1') { status = 'Processed'; } else { status = ''; }
        $('#RECEIVEDV_STATUS_TD'+x+'').html(status);
        keepSaleItemData();
        calculateSaleTotal();
        // $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function setDCTypV2(flg) {
    var result; let amt = 0; let accamtc1 = ''; let accamtc2 = '';
    const data = new FormData(form);
    data.append('action', 'setDCTypV2');
    data.append('DCTYP', $('#DCTYP').val());
    data.append('INPUTCURDISP', $('#INPUTCURDISP').val());
    data.append('INPUTCURFLG', '');
    data.append('CURFLG', flg);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        result = response.data;
        if($('#DCTYP').val() == 0) { // debit
            let debit = parseFloat(result['ACCAMTC1'].replace(/,/g, '')) || 0;
            accamtc1 = num2digit(debit);
        } else if($('#DCTYP').val() == 1) { // credit
            let credit = parseFloat(result['ACCAMTC2'].replace(/,/g, '')) || 0;
            accamtc2 = num2digit(credit);
        }
        amt = parseFloat(result['AMT'].replace(/,/g, '')) || 0;
        $('#ACCAMTC1').val(accamtc1);
        $('#ACCAMTC2').val(accamtc2);
        $('#ACCCD').val(result['ACCCD']);
        $('#ACCNM').val(result['ACCNM']);
        $('#AMT').val(num2digit(amt));
        if(flg == 2) { 
            $('#EXRATE').val(result['EXRATE']);
            document.getElementById('INPUTCURDISP').value = result['INPUTCURDISP'];
        }
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function update() {
    let rowno = $('#ROWNO').val();
    $('#ACCCD'+rowno+'').val($('#ACCCD').val());
    $('#ACCCD_TD'+rowno+'').html($('#ACCCD').val());
    $('#ACCNM'+rowno+'').val($('#ACCNM').val());
    $('#ACCNM_TD'+rowno+'').html($('#ACCNM').val());
    $('#AMT'+rowno+'').val($('#AMT').val())
    $('#AMT_TD'+rowno+'').html($('#AMT').val());
    $('#EXRATE'+rowno+'').val($('#EXRATE').val());
    $('#EXRATE_TD'+rowno+'').html($('#EXRATE').val());
    $('#ACCAMTC1'+rowno+'').val($('#ACCAMTC1').val());
    $('#ACCAMTC1_TD'+rowno+'').html($('#ACCAMTC1').val());
    $('#ACCAMTC2'+rowno+'').val($('#ACCAMTC2').val());
    $('#ACCAMTC2_TD'+rowno+'').html($('#ACCAMTC2').val());
    $('#ACCREM'+rowno+'').val($('#ACCREM').val());
    $('#ACCREM_TD'+rowno+'').html($('#ACCREM').val());
    $('#AMT1'+rowno+'').val($('#AMT').val().replace(/,/g, ''));
    $('#BASEAMTC1'+rowno+'').val($('#ACCAMTC1').val());
    $('#BASEAMTC2'+rowno+'').val($('#ACCAMTC2').val());

    calculateAccTotal();
    emptyAcc();
    await keepAccItemData();
}

function emptyAcc() {
    $('#ROWNO').val('');
    $('#TAXINVOICENO').val('');
    $('#ACCCD').val('');
    $('#ACCNM').val('');
    $('#AMT').val('');
    $('#EXRATE').val('1.000000');
    $('#ACCAMTC1').val('');
    $('#ACCAMTC2').val('');
    $('#ACCREM').val(''); 
    document.getElementById('DCTYP').value = 0;
    document.getElementById('WHTAXTYP').value = '';
    document.getElementById('INPUTCURDISP').value = document.getElementById('CUSCURCD').value;
    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true; 
    document.getElementById('DELETE').disabled = true; 

    document.getElementById('DCTYP').classList.remove('read');
    document.getElementById('WHTAXTYP').classList.remove('read');
    document.getElementById('INPUTCURDISP').classList.remove('read');
    document.getElementById('TAXINVOICENO').classList.remove('read');

    let accTb = document.getElementById('table_acc');
    let rows = accTb.getElementsByTagName('tr');
    $('.row-id').each(function (i) {
        rows[i+1].classList.remove('selected-row');
    });

    // $('#DCTYP').attr('readonly', false).css('background-color', 'white');
    // $('#WHTAXTYP').removeAttr('disabled').css('background-color', 'white');
    // $('#INPUTCURDISP').removeAttr('disabled').css('background-color', 'white');
    // $('#TAXINVOICENO').attr('readonly', false).css('background-color', 'white');

    keepData();
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
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepSaleItemData() {
    const data = new FormData(form);
    data.append('action', 'keepSaleItemData');
    // console.log(data);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepAccItemData() {
    const data = new FormData(form);
    data.append('action', 'keepAccItemData');
    // console.log(data);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_RECEIVEVOUCHER3_THA');

    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetAccItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetAccItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_RECEIVEVOUCHER3_THA/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        return calculateAccTotal();
        // console.log(response.data);
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
            } else if(type == 2) {
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

    // clearing table
    // $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = '../ACC_RECEIVEVOUCHER3_THA/';

    return false;
}

$(document).ready(function() {  
    if(CUSTOMERCD.val() != '') {
        document.getElementById('CUSTOMERCD').classList.remove('req');
    }
    if(CUSCURCD.val() != '') {
        document.getElementById('CUSCURCD').classList.remove('req');
    }
}); 

function calculateSaleTotal() {
    let cttlostdamt = 0; let cttlostdvat = 0; let cttlostdwht = 0; let cttlostdttlamt = 0; let cttlrecamt = 0; let cttlrecfee = 0; let cttlrecvat = 0; let cttlrecwht = 0; let cttlrecttlamt = 0;
    let receivedvostamt = document.getElementsByName('RECEIVEDV_OSTDAMT[]');
    let receivedvostvat = document.getElementsByName('RECEIVEDV_OSTDVAT[]');
    let receivedvostwht = document.getElementsByName('RECEIVEDV_OSTDWHT[]');
    let receivedvostattlamt = document.getElementsByName('RECEIVEDV_OSTDTTLAMT[]');
    let receivedvrecamt = document.getElementsByName('RECEIVEDV_RECAMT[]');
    let receivedvrecfee = document.getElementsByName('RECEIVEDV_RECFEE[]');
    let receivedvrecvat = document.getElementsByName('RECEIVEDV_RECVAT[]');
    let receivedvrecwht = document.getElementsByName('RECEIVEDV_RECWHT[]');
    let receivedvrecttlamt = document.getElementsByName('RECEIVEDV_RECTTLAMT[]');
    for (let i = 0; i < receivedvostamt.length; i++) {
        cttlostdamt += parseFloat(receivedvostamt[i].value.replace(/,/g, '')) || 0;
        cttlostdvat += parseFloat(receivedvostvat[i].value.replace(/,/g, '')) || 0;
        cttlostdwht += parseFloat(receivedvostwht[i].value.replace(/,/g, '')) || 0;
        cttlostdttlamt += parseFloat(receivedvostattlamt[i].value.replace(/,/g, '')) || 0;
        cttlrecamt += parseFloat(receivedvrecamt[i].value.replace(/,/g, '')) || 0;
        cttlrecfee += parseFloat(receivedvrecfee[i].value.replace(/,/g, '')) || 0;
        cttlrecvat += parseFloat(receivedvrecvat[i].value.replace(/,/g, '')) || 0;
        cttlrecwht += parseFloat(receivedvrecwht[i].value.replace(/,/g, '')) || 0;
        cttlrecttlamt += parseFloat(receivedvrecttlamt[i].value.replace(/,/g, '')) || 0;
    }
    $('#TTLOSTDAMT').val(num2digit(cttlostdamt));
    $('#TTLOSTDVAT').val(num2digit(cttlostdvat));
    $('#TTLOSTDWHT').val(num2digit(cttlostdwht));
    $('#TTLOSTDTTLAMT').val(num2digit(cttlostdttlamt));
    $('#TTLRECAMT').val(num2digit(cttlrecamt));
    $('#TTLRECFEE').val(num2digit(cttlrecfee));
    $('#TTLRECVAT').val(num2digit(cttlrecvat));
    $('#TTLRECWHT').val(num2digit(cttlrecwht));
    $('#TTLRECTTLAMT').val(num2digit(cttlrecttlamt));
    // keepData();
}

function calculateAccTotal() {
    let attlamt1 = 0; let attlamtc1 = 0; let attlamtc2 = 0; 
    let amta = document.getElementsByName('AMTA[]');
    let accamta1a = document.getElementsByName('ACCAMTC1A[]');
    let accamta2a = document.getElementsByName('ACCAMTC2A[]');
    let dctypa = document.getElementsByName('DCTYPA[]');
    // console.log(amta.length);
    for (let i = 0; i < amta.length; i++) {
        if(dctypa[i].value == 0) {
            attlamt1 += parseFloat(amta[i].value.replace(/,/g, '')) || 0;
        }
        attlamtc1 += parseFloat(accamta1a[i].value.replace(/,/g, '')) || 0;
        attlamtc2 += parseFloat(accamta2a[i].value.replace(/,/g, '')) || 0;
    }
    // console.log(attlamt1);
    // console.log(attlamtc1);
    // console.log(attlamtc2);
    $('#TTL_AMT1').val(num2digit(attlamt1));
    $('#TTL_AMTC1').val(num2digit(attlamtc1));
    $('#TTL_AMTC2').val(num2digit(attlamtc2));
    // keepData();
}

function changeRowId() {
    let accTb = document.getElementById('table_acc');
    let rows = accTb.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // console.log(i);
        if (rows[i].id) {
            index_x = Number(rows[i].rowIndex);
            rows[i].id = 'rowId' + index_x;
        }
    }
}

function emptyRow(n) {
  $('#table_acc tbody').append( '<tr class="divide-x" id="rowId'+ n +'">' +
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

// async function printed(type) {
//     await keepData();
//     if(type == 'RECEIPT') {
//         var popupWindow = window.open('../ACC_RECEIVEVOUCHER3_THA/receipt.php', '_blank', 'width=800, height=800');
//     } else if(type == 'BTNTAXINV') {
//         var popupWindow = window.open('../ACC_RECEIVEVOUCHER3_THA/taxinv.php', '_blank', 'width=800, height=800');
//     } else if(type == 'BTNTAXINVREC') {
//         var popupWindow = window.open('../ACC_RECEIVEVOUCHER3_THA/taxinvrec.php', '_blank', 'width=800, height=800');
//     } else if(type == 'RCVVC') {
//         var popupWindow = window.open('../ACC_RECEIVEVOUCHER3_THA/receive_voucher.php', '_blank', 'width=800, height=800');
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }