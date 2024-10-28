// icon search
const SEARCHSALETRAN_ACC2 = $('#SEARCHSALETRAN_ACC2');
const SEARCHSALETRANFORDC2_ACC = $('#SEARCHSALETRANFORDC2_ACC');
const SEARCHSTAFF = $('#SEARCHSTAFF');

SEARCHSALETRAN_ACC2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALETRAN_ACC2/index.php?page=ACC_SALEDCNOTEENTRY2_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHSALETRANFORDC2_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALETRANFORDC2_ACC/index.php?page=ACC_SALEDCNOTEENTRY2_THARD', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEDCNOTEENTRY2_THARD', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHSALETRAN_ACC2, SEARCHSALETRANFORDC2_ACC, SEARCHSTAFF];

//input serach
const DCNO = $('#DCNO'); 
const SALETRANNO = $('#SALETRANNO');
const DCTYP = $('#DCTYP');
const CHANGETYP = $('#CHANGETYP');
const STAFFCD = $('#STAFFCD');
const SALEDIVCON = $('#SALEDIVCON');
const REPRINTREASON = $('#REPRINTREASON');

const input_serach = [DCNO, SALETRANNO, DCTYP, CHANGETYP, STAFFCD, SALEDIVCON];

// form
const form = document.getElementById('dcnoteentryrd');

// action button
const COMMIT = $('#COMMIT');
const DCFORM = $('#DCFORM');
const DCVC = $('#DCVC');

for(const icon of serach_icon){
    icon.click(function () {
        keepData();
    });
};

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            $('#loading').show();
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

DCFORM.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    // if (REPRINTREASON.val() == '') {
    //     printValidation();
    //     return false;
    // }
    return noteprintCheck('printChecknote');
});

DCVC.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    // if (REPRINTREASON.val() == '') {
    //     printValidation();
    //     return false;
    // }
    return noteprintCheck('printCheckVoucher');
});

DCNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('DCNO', DCNO.val());
    }
    if(DCNO.val() == '') unsetSession(form);
});

SALETRANNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SALETRANNO', SALETRANNO.val());
    }
    if(SALETRANNO.val() == '') unsetSession(form);
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getElement('STAFFCD', STAFFCD.val());
    }
});

DCTYP.change(function() {
    keepData();
    return getDCMESSAGECMB('DCTYP', DCTYP.val());
});

CHANGETYP.change(function() {
    keepData();
    return getDCMESSAGECMB('CHANGETYP', CHANGETYP.val());
});

SALEDIVCON.change(function() {
    keepData();
    return getElement('SALEDIVCON', SALEDIVCON.val());
    // window.location.href='index.php?SALEDIVCON=' + SALEDIVCON.val();
});

async function getSearch(code, value) {
  $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEDCNOTEENTRY2_THARD/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
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

async function getDCMESSAGECMB(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', 'DCMESSAGECMB');
    await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                // if(key != 'ITEM' && key != 'DCMESSAGE3') {
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });

            if(result.DCMESSAGE3 != '') {
               $('#SALEDIVCON').empty();
                let select = document.getElementById('SALEDIVCON');
                $.each(result.DCMESSAGE3, function(key, value) {
                    let option = document.createElement('option');
                    option.value = value.CODE;
                    option.text = value.TEXT;
                    select.appendChild(option);
                }); 
            }
     
            if(result.ITEM != '') {
                let itemsaleqty = document.getElementsByName('SALEQTY[]');
                let itemssaleqty = document.getElementsByName('SSALEQTY[]');
                let itemsaleprc = document.getElementsByName('SALEUNITPRC[]');
                let itemssaleprc = document.getElementsByName('SSALEUNITPRC[]');
                let itemsaleamt = document.getElementsByName('SALEAMT[]');
                $.each(result.ITEM, function(key, value) {
                    let index = key-1;
                    itemsaleqty[index].value = num2digit(value.SALEQTY);
                    itemssaleqty[index].value = num2digit(value.SSALEQTY);
                    itemsaleprc[index].value = num2digit(value.SALEUNITPRC);
                    itemssaleprc[index].value = num2digit(value.SSALEUNITPRC);
                    itemsaleamt[index].value = num2digit(value.SALEAMT);
                    if(result.CHANGETYP == 1) {
                        itemsaleprc[index].classList.remove('read');
                        itemsaleqty[index].classList.add('read');
                    } else if(result.CHANGETYP == 2) {
                        itemsaleprc[index].classList.add('read');
                        itemsaleqty[index].classList.remove('read');
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

async function action(action) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
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
            } else {
                return window.location.reload();
            }
        }
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function printed(type) {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', type);
  await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
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

async function noteprintCheck(type) {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', type);
  await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let result = response.data;
        if (response.status == '200') {
            if(result != 'ERRO:ERRO_NO_INPUT_REPRINT_REASON') {
                if(type == 'printChecknote') {
                    return printed('debitNote');
                } else if(type == 'printCheckVoucher') {
                    return printed('debitNoteVoucher');
                }
                //  document.getElementById('reason').style.visibility = 'visible';
                // $('#reason').removeAttr('disabled').css('background-color', 'white');
            } else {
                document.getElementById('reason').style.display = 'block';
                $('#REPRINTREASON').attr('readonly', false).css('background-color', 'white');
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
    await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_SALEDCNOTEENTRY2_THARD');

    await axios.post('../ACC_SALEDCNOTEENTRY2_THARD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
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
    window.location.href = '../ACC_SALEDCNOTEENTRY2_THARD/';

    return false;
}

function calculateamt(x) {
    // console.log(x);
    let amount = 0;
    let qty = $('#SALEQTY'+x+'').val().replace(/,/g, '');
    let unitprice = $('#SALEUNITPRC'+x+'').val().replace(/,/g, '');
    amount = parseFloat(qty) * parseFloat(unitprice);
    // console.log(amount);
    // set amount per one feach
    $('#SALEAMT'+x+'').val(num2digit(amount));
    keepItemData();
    subtotal();
}

function subtotal() {
    // --------------------------------------------------
    let itemamount = document.getElementsByName('SALEAMT[]');
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
    vatamt = (parseFloat($('#VATRATE').val()) / 100) * parseFloat(diff); //* $("#GROUPRT").val()
    toal = parseFloat(diff) + parseFloat(vatamt);
    $('#VATAMOUNT1').val(num2digit(vatamt));
    $('#T_AMOUNT').val(num2digit(toal));
    keepData();
    $('#loading').hide();
}

function unRequired() {
    document.getElementById('SALETRANNO').classList[document.getElementById('SALETRANNO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SALEDIVCON').classList[document.getElementById('SALEDIVCON').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
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

// async function printed(type) {
//     await keepData();
//     if(type == 'debitnote') {
//         var popupWindow = window.open('../ACC_SALEDCNOTEENTRY2_THARD/print.php?REPRINTREASON=' + $('#REPRINTREASON').val(), '_blank', 'width=800, height=800');
//     } else {
//         var popupWindow = window.open('../ACC_SALEDCNOTEENTRY2_THARD/print_voucher.php?REPRINTREASON=' + $('#REPRINTREASON').val(), '_blank', 'width=800, height=800');
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }



// DCTYP.change(function() {
//     // --------------------------------------------------
//     keepData();
//     // window.location.href="index.php?DCTYP=" + DCTYP.val();
//     // --------------------------------------------------
//     let itemsaleqty = document.getElementsByName('SALEQTY[]');
//     let itemssaleqty = document.getElementsByName('SSALEQTY[]');
//     let itemsaleprc = document.getElementsByName('SALEUNITPRC[]');
//     let itemssaleprc = document.getElementsByName('SSALEUNITPRC[]');
//     let itemsaleamt = document.getElementsByName('SALEAMT[]');
//     if(CHANGETYP.val() == 1) {
//         // --------------------------------------------------
//         // Unit price change
//         for (let i = 0; i < itemsaleqty.length; i++) {
//             itemsaleqty[i].value = itemssaleqty[i].value;
//             itemsaleprc[i].value = 0;
//             itemsaleamt[i].value = 0;
//             itemsaleprc[i].classList.remove('read');
//             itemsaleqty[i].classList.add('read');
//             // console.log(itemamount[i].value);
//         }  // for (let i = 0; i < itemsaleqty.length; i++) {
//         // --------------------------------------------------
//     } else if(CHANGETYP.val() == 2) {
//         // --------------------------------------------------
//         // Quantity change
//         for (let i = 0; i < itemsaleprc.length; i++) {
//             itemsaleqty[i].value = 0;
//             itemsaleprc[i].value = itemssaleprc[i].value;
//             itemsaleamt[i].value = 0;
//             itemsaleprc[i].classList.add('read');
//             itemsaleqty[i].classList.remove('read');
//             // console.log(itemamount[i].value);
//         }  // for (let i = 0; i < itemsaleprc.length; i++) {
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
//     let itemsaleqty = document.getElementsByName('SALEQTY[]');
//     let itemssaleqty = document.getElementsByName('SSALEQTY[]');
//     let itemsaleprc = document.getElementsByName('SALEUNITPRC[]');
//     let itemssaleprc = document.getElementsByName('SSALEUNITPRC[]');
//     let itemsaleamt = document.getElementsByName('SALEAMT[]');
//     if(CHANGETYP.val() == 1) {
//         // --------------------------------------------------
//         // Unit price change
//         for (let i = 0; i < itemsaleqty.length; i++) {
//             itemsaleqty[i].value = itemssaleqty[i].value;
//             itemsaleprc[i].value = 0;
//             itemsaleamt[i].value = 0;
//             itemsaleprc[i].classList.remove('read');
//             itemsaleqty[i].classList.add('read');
//             // console.log(itemamount[i].value);
//         }  // for (let i = 0; i < itemsaleqty.length; i++) {
//         // --------------------------------------------------
//     } else if(CHANGETYP.val() == 2) {
//         // --------------------------------------------------
//         // Quantity change
//         for (let i = 0; i < itemsaleprc.length; i++) {
//             itemsaleqty[i].value = 0;
//             itemsaleprc[i].value = itemssaleprc[i].value;
//             itemsaleamt[i].value = 0;
//             itemsaleprc[i].classList.add('read');
//             itemsaleqty[i].classList.remove('read');
//             // console.log(itemamount[i].value);
//         }  // for (let i = 0; i < itemsaleprc.length; i++) {
//         // --------------------------------------------------
//     }  // else if(CHANGETYP.val() == 2) {
//     // --------------------------------------------------
//     // Reset SubTotal
//     subtotal();
//     // --------------------------------------------------
//     $('#loading').hide();
//     // --------------------------------------------------
// });
