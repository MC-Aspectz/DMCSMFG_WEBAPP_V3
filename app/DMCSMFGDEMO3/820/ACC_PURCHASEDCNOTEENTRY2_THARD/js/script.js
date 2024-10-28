// icon search
const SEARCHPURRECTRAN_ACC3 = $('#SEARCHPURRECTRAN_ACC3');
const SEARCHPURRECTRANFORDC2_ACC = $('#SEARCHPURRECTRANFORDC2_ACC');
const SEARCHSTAFF = $('#SEARCHSTAFF');

SEARCHPURRECTRAN_ACC3.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURRECTRAN_ACC3/index.php?page=ACC_PURCHASEDCNOTEENTRY2_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHPURRECTRANFORDC2_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURRECTRANFORDC2_ACC/index.php?page=ACC_PURCHASEDCNOTEENTRY2_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_PURCHASEDCNOTEENTRY2_THARD', 'authWindow', 'width=1200,height=600');});


const serach_icon = [SEARCHPURRECTRAN_ACC3, SEARCHPURRECTRANFORDC2_ACC, SEARCHSTAFF];

//input serach
const DCNO = $('#DCNO'); 
const PVNO = $('#PVNO');
const DCTYP = $('#DCTYP');
const CHANGETYP = $('#CHANGETYP');
const STAFFCD = $('#STAFFCD');
const ADD05 = $('#ADD05');
const REPRINTREASON = $('#REPRINTREASON');
const CRMSG = $('#CRMSG');
const DRMSG = $('#DRMSG');

const input_serach = [ DCTYP, CHANGETYP, STAFFCD, CRMSG, DRMSG];

// form
const form = document.getElementById('dcnoteentryrd');

// action button
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const DCVC = $('#DCVC');

for(const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
};

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            // $('#loading').show();
            keepData();
        }
    });
}

COMMIT.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return actionDialog(2);
    // form.submit();
});

CANCEL.click(function() {
    // check validate form
    return actionDialog(7);
});

DCVC.click(function() {
    // check validate form
    // if (REPRINTREASON.val() == '') {
    //     printValidation();
    //     return false;
    // }
    return printed();
});

DCNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('DCNO', DCNO.val());
    }
    if(DCNO.val() == '') unsetSession(form);
});

PVNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PVNO', PVNO.val());
    }
    if(PVNO.val() == '') unsetSession(form);
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

DCTYP.change(function() {
    return getDCMESSAGE('DCTYP', DCTYP.val());
});

CHANGETYP.change(function() {
    return getDCMESSAGE('CHANGETYP', CHANGETYP.val());
});

CRMSG.change(function() {
    return getElement('CRMSG', CRMSG.val());
});

DRMSG.change(function() { // hidden
    return getElement('DRMSG', DRMSG.val());
});

async function getDCMESSAGE(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', 'DCMESSAGE');
    await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
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

            if(result.DCMESSAGE != '') {
               $('#CRMSG').empty();
                let select = document.getElementById('CRMSG');
                $.each(result.CRMSG, function(key, value) {
                    let option = document.createElement('option');
                    option.value = value.CODE;
                    option.text = value.TEXT;
                    select.appendChild(option);
                }); 
            }
     
            if(result.ITEM != '') {
                let itempurqty = document.getElementsByName('PURQTY[]');
                let itemspurqty = document.getElementsByName('SPURQTY[]');
                let itempurprc = document.getElementsByName('PURUNITPRC[]');
                let itemspurprc = document.getElementsByName('SPURUNITPRC[]');
                let itempuramt = document.getElementsByName('PURAMT[]');
                $.each(result.ITEM, function(key, value) {
                    let index = key-1;
                    itempurqty[index].value = num2digit(value.PURQTY);
                    itemspurqty[index].value = num2digit(value.SPURQTY);
                    itempurprc[index].value = num2digit(value.PURUNITPRC);
                    itemspurprc[index].value = num2digit(value.SPURUNITPRC);
                    itempuramt[index].value = num2digit(value.PURAMT);
                    if(result.CHANGETYP == 1) {
                        itempurprc[index].classList.remove('read');
                        itempurqty[index].classList.add('read');
                    } else if(result.CHANGETYP == 2) {
                        itempurprc[index].classList.add('read');
                        itempurqty[index].classList.remove('read');
                    }
                }); 
                subtotal();
            }
        }
        unRequired();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getSearch(code, value) {
  $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_PURCHASEDCNOTEENTRY2_THARD/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
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
    await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $('#loading').hide();
            let result = response.data;
            if(action == 'commit') {
                if(result == 'ERRO:ERRO_DIFFREMCE_AMOUNT_ZERO') {
                    return getMessage(result.replace('ERRO:',''));
                } else if(result == 'ERRO:ERRO_PISITEM_OUT_OF_STOCK') {
                    return getMessage(result.replace('ERRO:',''));
                } else if(result == 'ERRO:ERRO_ITEM_OUT_OF_STOCK') {
                    return getMessage(result.replace('ERRO:',''));
                } else if(result == 'ERRO:ERROR_NODETAIL_ITEM') {
                    return getMessage(result.replace('ERRO:',''));
                } else {
                    successValidation();
                    window.location.href='index.php?DCNO=' + result['DCNO'];
                }
            } else if(action == 'cancel') {
                return unsetSession(form);
            } else {
                return window.location.reload();
            }
        }
    })
    .catch(e => {
        // console.log(e);
    });
}

async function printed() {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'printedVoucher');
  await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
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

    await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_PURCHASEDCNOTEENTRY2_THARD');

    await axios.post('../ACC_PURCHASEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
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
                return action('commit');
            } else if(type == 3) {
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
    window.location.href = '../ACC_PURCHASEDCNOTEENTRY2_THARD/';

    return false;
}

function calculateamt(x) {
    // console.log(x);
    let amount = 0;
    let qty = $('#PURQTY'+x+'').val().replace(/,/g, '');
    let unitprice = $('#PURUNITPRC'+x+'').val().replace(/,/g, '');
    amount = parseFloat(qty) * parseFloat(unitprice);
    // console.log(amount);
    // set amount per one feach
    $('#PURAMT'+x+'').val(num2digit(amount));
    keepItemData();
    subtotal();
}

function subtotal() {
    // --------------------------------------------------
    let itemamount = document.getElementsByName('PURAMT[]');
    let oldInvant = document.getElementById('OLDINVAMT').value;
    let sumtotal = 0;
    for (let i = 0; i < itemamount.length; i++) {
        sumtotal += parseFloat(itemamount[i].value.replace(/,/g, '')) || 0;
        // console.log(itemamount[i].value);
    }
    $('#S_TTL').val(num2digit(sumtotal));
    let cerInvAmt = parseFloat(oldInvant.replace(/,/g, ''));
    if(DCTYP.val() == 0) {
        // Debit Note
        cerInvAmt = cerInvAmt + sumtotal; 
    } else if(DCTYP.val() == 1) {
        // Credit Note
        cerInvAmt = cerInvAmt - sumtotal; 
    }  // else if(DCTYP.val() == 1) {
    $('#QUOTEAMOUNT').val(num2digit(cerInvAmt));
    $('#DIFFDISP').val(num2digit(sumtotal));
    $('#DIFF').val(num2digit(sumtotal));
    keepData();
    vat();
    // --------------------------------------------------
}

function vat() {
    let diff = $('#DIFFDISP').val().replace(/,/g, '');
    let vatamt = 0; let toal = 0;
    vatamt = (parseFloat($('#VATRATE').val()) / 100) * parseFloat(diff); //* $('#GROUPRT').val()
    toal = parseFloat(diff) + parseFloat(vatamt);
    $('#VATAMOUNT1').val(num2digit(vatamt));
    $('#T_AMOUNT').val(num2digit(toal));
    keepData();
    $('#loading').hide();
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'row-empty');
        for (var z = 1; z <= 9; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}


// async function printed() {
//     await keepData();
//     var popupWindow = window.open('../ACC_PURCHASEDCNOTEENTRY2_THARD/print_voucher.php?REPRINTREASON=' + $('#REPRINTREASON').val(), '_blank', 'width=800, height=800');
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }

// DCTYP.change(function() {
//     // --------------------------------------------------
//     keepData();
//     // window.location.href='index.php?DCTYP=' + DCTYP.val();
//     // --------------------------------------------------
//     let itempurqty = document.getElementsByName('PURQTY[]');
//     let itemspurqty = document.getElementsByName('SPURQTY[]');
//     let itempurprc = document.getElementsByName('PURUNITPRC[]');
//     let itemspurprc = document.getElementsByName('SPURUNITPRC[]');
//     let itempuramt = document.getElementsByName('PURAMT[]');
//     if(CHANGETYP.val() == 1) {
//         // --------------------------------------------------
//         // Unit price change
//         for (let i = 0; i < itempurqty.length; i++) {
//             itempurqty[i].value = itemspurqty[i].value;
//             itempurprc[i].value = 0;
//             itempuramt[i].value = 0;
//             itempurprc[i].classList.remove('read');
//             itempurqty[i].classList.add('read');
//         }  // for (let i = 0; i < itempurqty.length; i++) {
//         // --------------------------------------------------
//     } else if(CHANGETYP.val() == 2) {
//         // --------------------------------------------------
//         // Quantity change
//         for (let i = 0; i < itempurqty.length; i++) {
//             itempurqty[i].value = 0;
//             itempurprc[i].value = itemspurprc[i].value;
//             itempuramt[i].value = 0;
//             itempurprc[i].classList.add('read');
//             itempurqty[i].classList.remove('read');
//         }  // for (let i = 0; i < itempurqty.length; i++) {
//         // --------------------------------------------------
//     }  // else if(CHANGETYP.val() == 2) {
//     // --------------------------------------------------
//     // Reset SubTotal
//     subtotal();
//     // --------------------------------------------------
//     $('#loading').hide();
//     // --------------------------------------------------
// });

// CHANGETYP.change(function() {
//     // --------------------------------------------------
//     keepData();
//     // window.location.href='index.php?CHANGETYP=' + CHANGETYP.val();
//     // --------------------------------------------------
//     let itempurqty = document.getElementsByName('PURQTY[]');
//     let itemspurqty = document.getElementsByName('SPURQTY[]');
//     let itempurprc = document.getElementsByName('PURUNITPRC[]');
//     let itemspurprc = document.getElementsByName('SPURUNITPRC[]');
//     let itempuramt = document.getElementsByName('PURAMT[]');
//     if(CHANGETYP.val() == 1) {
//         // --------------------------------------------------
//         // Unit price change
//         for (let i = 0; i < itempurqty.length; i++) {
//             itempurqty[i].value = itemspurqty[i].value;
//             itempurprc[i].value = 0;
//             itempuramt[i].value = 0;
//             itempurprc[i].classList.remove('read');
//             itempurqty[i].classList.add('read');
//         }  // for (let i = 0; i < itempurqty.length; i++) {
//         // --------------------------------------------------
//     } else if(CHANGETYP.val() == 2) {
//         // --------------------------------------------------
//         // Quantity change
//         for (let i = 0; i < itempurqty.length; i++) {
//             itempurqty[i].value = 0;
//             itempurprc[i].value = itemspurprc[i].value;
//             itempuramt[i].value = 0;
//             itempurprc[i].classList.add('read');
//             itempurqty[i].classList.remove('read');
//         }  // for (let i = 0; i < itempurqty.length; i++) {
//         // --------------------------------------------------
//     }  // else if(CHANGETYP.val() == 2) {
//     // --------------------------------------------------
//     // Reset SubTotal
//     subtotal();
//     // --------------------------------------------------
//     $('#loading').hide();
//     // --------------------------------------------------
// });