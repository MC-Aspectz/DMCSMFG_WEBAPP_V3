// icon search
const SEARCHPAYMENT_ACC = $('#SEARCHPAYMENT_ACC');
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHACCOUNT = $('#SEARCHACCOUNT');
const SEARCHSUPPLIERINVOICE_ACC1 = $('#SEARCHSUPPLIERINVOICE_ACC1');
const SEARCHSUPPLIERINVOICE_ACC2 = $('#SEARCHSUPPLIERINVOICE_ACC2');

SEARCHPAYMENT_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPAYMENT_ACC/index.php?page=ACC_PAYMENTENTRY3_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_PAYMENTENTRY3_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_PAYMENTENTRY3_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_PAYMENTENTRY3_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACC_PAYMENTENTRY3_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIERINVOICE_ACC1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIERINVOICE_ACC/index.php?page=ACC_PAYMENTENTRY3_THARD&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIERINVOICE_ACC2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIERINVOICE_ACC/index.php?page=ACC_PAYMENTENTRY3_THARD&index=2', 'authWindow', 'width=1200,height=600');});



const serach_icon = [SEARCHPAYMENT_ACC, SEARCHSUPPLIER, SEARCHCURRENCY, SEARCHDIVISION, SEARCHACCOUNT];

//input serach
const RVNO = $('#RVNO'); 
const SUPPLIERCD = $('#SUPPLIERCD');
const SUPCURCD = $('#SUPCURCD');
const DIVISIONCD = $('#DIVISIONCD');
const ACCCD = $('#ACCCD');
const PT_PAYAMT = $('#PT_PAYAMT');
const DCTYP = document.getElementById('DCTYP');

const input_serach = [ SUPPLIERCD, SUPCURCD, DIVISIONCD, ACCCD];

// form
const form = document.getElementById('acc_paymententry');

// action button
const SEARCH = $('#SEARCH');
const SETACC = $('#SETACC');
const ENTRY = $('#ENTRY');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PMVC = $('#PMVC');

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
    return actionDialog(6);
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
    if(PT_PAYAMT.val() != '0.00' || PT_PAYAMT.val() != '') {
        keepPaymentItemData();
        keepData();
        $('#loading').show();
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

PMVC.click(function() {
    return printed('PVprint');
});

RVNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('RVNO', RVNO.val());
    }
    if(RVNO.val() == '') unsetSession(form);
});

SUPPLIERCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERCD', SUPPLIERCD.val());
    }
});

SUPCURCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPCURCD', SUPCURCD.val());
    }
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
    return getElement('DIVISIONCD', DIVISIONCD.val());
  }
});

ACCCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ACCCD', ACCCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_PAYMENTENTRY3_THARD/index.php?'+code+'=' + value;    
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
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
      
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function printed(type) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', type);
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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

async function setSelPaid(x) {
    // console.log(x);
    var result; let status;
    const data = new FormData(form);
    data.append('action', 'setSelPaid');
    data.append('PAYMENTDV_SEL', $('#PAYMENTDV_SEL'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_OSTDAMT', $('#CALCBASE_OSTDAMT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_VAT', $('#CALCBASE_VAT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_WHT', $('#CALCBASE_WHT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_OSTDTTLAMT', $('#CALCBASE_OSTDTTLAMT'+x+'').val().replace(/,/g, ''));
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        result = response.data;
        $('#PAYMENTDV_OSTDAMT'+x+'').val(result['PAYMENTDV_OSTDAMT']);
        $('#PAYMENTDV_SEL'+x+'').val(result['PAYMENTDV_SEL']);
        $('#PAYMENTDV_OSTDTTLAMT'+x+'').val(result['PAYMENTDV_OSTDTTLAMT']);
        $('#PAYMENTDV_PAYAMT'+x+'').val(result['PAYMENTDV_PAYAMT']);
        $('#PAYMENTDV_VAT'+x+'').val(result['PAYMENTDV_VAT']);
        $('#PAYMENTDV_WHT'+x+'').val(result['PAYMENTDV_WHT']);
        $('#PAYMENTDV_PAYVATAMT'+x+'').val(result['PAYMENTDV_PAYVATAMT']);
        $('#PAYMENTDV_PAYWHTAMT'+x+'').val(result['PAYMENTDV_PAYWHTAMT']);
        $('#PAYMENTDV_PAYTTLAMT'+x+'').val(result['PAYMENTDV_PAYTTLAMT']);
        $('#PAYMENTDV_STATUS'+x+'').val(result['PAYMENTDV_STATUS']);

        // ---------------------------------------------------------------//
        $('#PAYMENTDV_OSTDAMT_TD'+x+'').html(result['PAYMENTDV_OSTDAMT']);
        $('#PAYMENTDV_VAT_TD'+x+'').html(result['PAYMENTDV_VAT']);
        $('#PAYMENTDV_WHT_TD'+x+'').html(result['PAYMENTDV_WHT']);
        $('#PAYMENTDV_OSTDTTLAMT_TD'+x+'').html(result['PAYMENTDV_OSTDTTLAMT']);
        $('#PAYMENTDV_PAYVATAMT_TD'+x+'').html(result['PAYMENTDV_PAYVATAMT']);
        $('#PAYMENTDV_PAYTTLAMT_TD'+x+'').html(result['PAYMENTDV_PAYTTLAMT']);
        if(result['PAYMENTDV_STATUS'] == '0') { status = 'Outstanding'; } else if(result['PAYMENTDV_STATUS'] == '1') { status = 'Processed'; } else { status = ''; }
        $('#PAYMENTDV_STATUS_TD'+x+'').html(status);
        keepPaymentItemData();
        calculatePaymentTotal();
        // $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function setCalcPaid(x) {
    const data = new FormData(form);
    data.append('action', 'setCalcPaid');
    data.append('CALCBASE_OSTDAMT', $('#CALCBASE_OSTDAMT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_VAT', $('#CALCBASE_VAT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_WHT', $('#CALCBASE_WHT'+x+'').val().replace(/,/g, ''));
    data.append('CALCBASE_OSTDTTLAMT', $('#CALCBASE_OSTDTTLAMT'+x+'').val().replace(/,/g, ''));
    data.append('VATRATE', $('#VATRATE'+x+'').val().replace(/,/g, ''));
    data.append('WHTRATE', $('#WHTRATE'+x+'').val().replace(/,/g, ''));
    data.append('PAYMENTDV_SEL', $('#PAYMENTDV_SEL'+x+'').val().replace(/,/g, ''));
    data.append('PAYMENTDV_STATUS', $('#PAYMENTDV_STATUS'+x+'').val().replace(/,/g, ''));
    data.append('PAYMENTDV_PAYAMT', $('#PAYMENTDV_PAYAMT'+x+'').val().replace(/,/g, ''));
    data.append('PAYMENTDV_PAYWHTAMT', $('#PAYMENTDV_PAYWHTAMT'+x+'').val().replace(/,/g, ''));
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        result = response.data;
        $('#PAYMENTDV_OSTDAMT'+x+'').val(result['PAYMENTDV_OSTDAMT']);
        $('#PAYMENTDV_SEL'+x+'').val(result['PAYMENTDV_SEL']);
        $('#PAYMENTDV_OSTDTTLAMT'+x+'').val(result['PAYMENTDV_OSTDTTLAMT']);
        $('#PAYMENTDV_PAYAMT'+x+'').val(result['PAYMENTDV_PAYAMT']);
        $('#PAYMENTDV_VAT'+x+'').val(result['PAYMENTDV_VAT']);
        $('#PAYMENTDV_WHT'+x+'').val(result['PAYMENTDV_WHT']);
        $('#PAYMENTDV_PAYVATAMT'+x+'').val(result['PAYMENTDV_PAYVATAMT']);
        $('#PAYMENTDV_PAYWHTAMT'+x+'').val(result['PAYMENTDV_PAYWHTAMT']);
        $('#PAYMENTDV_PAYTTLAMT'+x+'').val(result['PAYMENTDV_PAYTTLAMT']);
        $('#PAYMENTDV_STATUS'+x+'').val(result['PAYMENTDV_STATUS']);

        // ---------------------------------------------------------------//
        $('#PAYMENTDV_OSTDAMT_TD'+x+'').html(result['PAYMENTDV_OSTDAMT']);
        $('#PAYMENTDV_VAT_TD'+x+'').html(result['PAYMENTDV_VAT']);
        $('#PAYMENTDV_WHT_TD'+x+'').html(result['PAYMENTDV_WHT']);
        $('#PAYMENTDV_OSTDTTLAMT_TD'+x+'').html(result['PAYMENTDV_OSTDTTLAMT']);
        $('#PAYMENTDV_PAYVATAMT_TD'+x+'').html(result['PAYMENTDV_PAYVATAMT']);
        $('#PAYMENTDV_PAYTTLAMT_TD'+x+'').html(result['PAYMENTDV_PAYTTLAMT']);
        if(result['PAYMENTDV_STATUS'] == '0') { status = 'Outstanding'; } else if(result['PAYMENTDV_STATUS'] == '1') { status = 'Processed'; } else { status = ''; }
        $('#PAYMENTDV_STATUS_TD'+x+'').html(status);
        keepPaymentItemData();
        calculatePaymentTotal();
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
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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
        $('#BASEAMTC1').val(accamtc1);
        $('#BASEAMTC2').val(accamtc2);
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

async function AmtC2(type) {
    var res;
    const data = new FormData(form);
    data.append('action', 'AmtC2');
    data.append('AmtC2TYPE', type);
    data.append('DCTYP', $('#DCTYP').val());
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res != '') {
            $('#ACCAMTC2').val(num2digit(res['ACCAMTC2']));
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
    $('#CHECKNO'+rowno+'').val($('#CHECKNO').val());
    $('#CHECKDT'+rowno+'').val($('#CHECKDT').val());
    $('#CHECKNO_TD'+rowno+'').html($('#CHECKNO').val());
    $('#CHECKDT_TD'+rowno+'').html($('#CHECKDT').val());

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
    $('#EXRATE').val('1.000000')
    $('#ACCAMTC1').val('');
    $('#ACCAMTC2').val('');
    $('#ACCREM').val(''); 
    $('#CHECKDT').val('');
    $('#CHECKNO').val(''); 
    document.getElementById('DCTYP').value = 0;
    document.getElementById('WHTAXTYP').value = '';
    document.getElementById('INPUTCURDISP').value = document.getElementById('SUPCURCD').value;
    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true; 
    document.getElementById('DELETE').disabled = true; 

    document.getElementById('DCTYP').classList.remove('read');
    document.getElementById('WHTAXTYP').classList.remove('read');
    document.getElementById('INPUTCURDISP').classList.remove('read');

    let accTb = document.getElementById('table_acc');
    let rows = accTb.getElementsByTagName('tr');
    $('.row-id').each(function (i) {
        rows[i+1].classList.remove('selected-row');
    });

    // $('#WHTAXTYP').removeAttr('style', 'pointer-events: none');
    // $('#DCTYP').removeAttr('disabled').css('background-color', 'white');
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
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepPaymentItemData() {
    const data = new FormData(form);
    data.append('action', 'keepPaymentItemData');
    // console.log(data);
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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
    data.append('systemName', 'ACC_PAYMENTENTRY3_THARD');

    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
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
    await axios.post('../ACC_PAYMENTENTRY3_THARD/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        return calculateAccTotal();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
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
            } else if(type == 3) {
                return action('commit');
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
    window.location.href = '../ACC_PAYMENTENTRY3_THARD/';

    return false;
}

function calculatePaymentTotal() {
    let cpt_pvamt = 0; let cpb_ostdamt = 0; let cpt_vatamt = 0; let cpt_whtamt = 0; let cpv_ostdttlamt = 0; let cpt_payamt = 0; let ct_pay = 0; let cpt_payvatamt = 0; let cpt_paywhtamt = 0;  let cpt_payttlamt = 0;
    let paymentdvostamt = document.getElementsByName('PAYMENTDV_OSTDAMT[]');
    let paymentdvostattlamt = document.getElementsByName('PAYMENTDV_OSTDTTLAMT[]');
    let paymentdvpayamt = document.getElementsByName('PAYMENTDV_PAYAMT[]');
    let paymentdvvat = document.getElementsByName('PAYMENTDV_VAT[]');
    let paymentdvwht = document.getElementsByName('PAYMENTDV_WHT[]');
    let paymentdvpayvatamt = document.getElementsByName('PAYMENTDV_PAYVATAMT[]');
    let paymentdvpaywhtamt = document.getElementsByName('PAYMENTDV_PAYWHTAMT[]');
    let paymentdvpayttlamt = document.getElementsByName('PAYMENTDV_PAYTTLAMT[]');
    let paymentdvamt = document.getElementsByName('PAYMENTDV_PVAMT[]');

    for (let i = 0; i < paymentdvostamt.length; i++) {
        cpt_pvamt += parseFloat(paymentdvamt[i].value.replace(/,/g, '')) || 0;
        cpb_ostdamt += parseFloat(paymentdvostamt[i].value.replace(/,/g, '')) || 0;
        cpt_vatamt += parseFloat(paymentdvvat[i].value.replace(/,/g, '')) || 0;
        cpt_whtamt += parseFloat(paymentdvwht[i].value.replace(/,/g, '')) || 0;
        cpv_ostdttlamt += parseFloat(paymentdvostattlamt[i].value.replace(/,/g, '')) || 0;
        cpt_payamt += parseFloat(paymentdvpayamt[i].value.replace(/,/g, '')) || 0;
        ct_pay += parseFloat(paymentdvpayttlamt[i].value.replace(/,/g, '')) || 0;
        cpt_payvatamt += parseFloat(paymentdvpayvatamt[i].value.replace(/,/g, '')) || 0;
        cpt_paywhtamt += parseFloat(paymentdvpaywhtamt[i].value.replace(/,/g, '')) || 0;
        cpt_payttlamt += parseFloat(paymentdvpayttlamt[i].value.replace(/,/g, '')) || 0;
    }
    $('#PT_PVAMT').val(num2digit(cpt_pvamt));
    $('#PT_OSTDAMT').val(num2digit(cpb_ostdamt));
    $('#PT_VATAMT').val(num2digit(cpt_vatamt));
    $('#PT_WHTAMT').val(num2digit(cpt_whtamt));
    $('#PT_OSTDTTLAMT').val(num2digit(cpv_ostdttlamt));
    $('#PT_PAYAMT').val(num2digit(cpt_payamt));
    $('#T_PAY').val(num2digit(ct_pay));
    $('#PT_PAYVATAMT').val(num2digit(cpt_payvatamt));
    $('#PT_PAYWHTAMT').val(num2digit(cpt_paywhtamt));
    $('#PT_PAYTTLAMT').val(num2digit(cpt_payttlamt));
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
    var elem = document.getElementsByTagName('#table_acc tr');
    for (var i = 0; i < elem.length; i++) {
      // console.log(i);
      if (elem[i].id) {
        index_x = Number(elem[i].rowIndex);
        elem[i].id = 'rowId' + index_x;
      }
    }
}

function unRequired() {
    document.getElementById('DCTYP').classList[document.getElementById('DCTYP').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPCURCD').classList[document.getElementById('SUPCURCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERCD').classList[document.getElementById('SUPPLIERCD').value !== '' ? 'remove' : 'add']('req');
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
//     if(type == 'PMVC') {
//         var popupWindow = window.open('../ACC_PAYMENTENTRY3_THARD/payment_voucher.php', '_blank', 'width=800, height=800');
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }
