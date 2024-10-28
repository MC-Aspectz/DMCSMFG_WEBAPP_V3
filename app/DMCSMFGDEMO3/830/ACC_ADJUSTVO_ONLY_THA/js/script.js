// icon search
const ACCBOKGUIDE9 = $('#ACCBOKGUIDE9');
const ACCBOKGUIDE91 = $('#ACCBOKGUIDE91');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCDDATA = $('#SEARCHCDDATA');
const SEARCHRECUR = $('#SEARCHRECUR');
const SEARCHACCOUNT = $('#SEARCHACCOUNT');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');

ACCBOKGUIDE9.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ACCBOKGUIDE9/index.php?page=ACC_ADJUSTVO_ONLY_THA', 'authWindow', 'width=1200,height=600');});
ACCBOKGUIDE91.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ACCBOKGUIDE9/index.php?page=ACC_ADJUSTVO_ONLY_THA_RE', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_ADJUSTVO_ONLY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCDDATA.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCDDATA/index.php?page=ACC_ADJUSTVO_ONLY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHRECUR.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHRECUR/index.php?page=ACC_ADJUSTVO_ONLY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACC_ADJUSTVO_ONLY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_ADJUSTVO_ONLY_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ACCBOKGUIDE9, SEARCHDIVISION, SEARCHCDDATA, SEARCHRECUR, SEARCHACCOUNT, SEARCHCUSTOMER];

//input serach
const BOOKORDERNO = $('#BOOKORDERNO');
const REFBOOKORDERNO = $('#REFBOOKORDERNO');
const DIVISIONCD = $('#DIVISIONCD');
const CSSTYPE = $('#CSSTYPE');
const CUSTOMERCODE = $('#CUSTOMERCODE');
const STAFFCODE = $('#STAFFCODE');
const SUPPLIERCD = $('#SUPPLIERCD');
const ACC_CD = $('#ACC_CD');
const RECURCD = $('#RECURCD');
const REPRINTREASON = $('#REPRINTREASON');

const input_serach = [DIVISIONCD, CSSTYPE, CUSTOMERCODE, STAFFCODE, SUPPLIERCD, ACC_CD, RECURCD];

// form
const form = document.getElementById('adjust_voucher_only');

// action button
const SEARCH = $('#SEARCH');
const GENERALV = $('#GENERALV');
const SAVE = $('#SAVE');
const SAVEREC = $('#SAVEREC');
const RE01 = $('#RE01');
const COMMIT = $('#COMMIT');

for(const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
};

for(const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
};

COMMIT.click(function() {
    // check validate form
    // if (!form.reportValidity()) {
    //     actionDialog(3);
    //     return false;
    // }
    return actionDialog(2);
});

GENERALV.click(function() {
    // check validate form
    if (REPRINTREASON.val() == '') {
        actionDialog(4);
        return false;
    }
    return printed();
});

BOOKORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('BOOKORDERNO', BOOKORDERNO.val());
    }
    if(BOOKORDERNO.val() == '') unsetSession(form);
});

REFBOOKORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('REFBOOKORDERNO', REFBOOKORDERNO.val());
    }
    if(REFBOOKORDERNO.val() == '') unsetSession(form);
});

CSSTYPE.on('change', function(e) {
    keepData();
    return getSearch('CSSTYPE', CSSTYPE.val());
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

CUSTOMERCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCODE', CUSTOMERCODE.val());
    }
});

STAFFCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCODE', STAFFCODE.val());
    }
});

SUPPLIERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERCD', SUPPLIERCD.val());
    }
});

ACC_CD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        getACCCD(ACC_CD.val());
    }
});

RECURCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('RECURCD', RECURCD.val());
    }
});

async function getSearch(code, value) {
  $('#loading').show();
  return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/830/ACC_ADJUSTVO_ONLY_THA/index.php?'+code+'=' + value;
}

function searchPartner() {
    keepData();
    if(CSSTYPE.val() == 1) {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_GENERALVO_THARD', 'authWindow', 'width=1200,height=600');
    } else if(CSSTYPE.val() == 2) {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_GENERALVO_THARD', 'authWindow', 'width=1200,height=600');
    } else {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_GENERALVO_THARD', 'authWindow', 'width=1200,height=600');
    }
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_GENERALVO_THARD/function/index_x.php', data)
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
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(jQuery.type(response.data) === 'object');
        if(response.status == '200') {
            $('#loading').hide();
            if(action == 'commit') {
                if(jQuery.type(response.data) === 'object') {
                    actionDialog(7);
                    window.location.href='index.php?BOOKORDERNO=' + response.data['BOOKORDERNO'];
                } else {
                    return actionDialog(response.data);
                }
            }
        }
    })
    .catch(e => {
        // console.log(e);
    });
}

async function getDetail() {
    $('#loading').show();
    let accamt1 = 0; let accamt2 = 0;
    const data = new FormData(form);
    data.append('action', 'getDetail');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwdetail').html('');
        let countRow = 0;
        $.each(response.data,function(key, value) {
            $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+key+'">'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id">'+value.ROWNO+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.ACC_CD+'</td>'+
                                        '<td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">'+value.ACC_NM+'</td>'+
                                        '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">'+value.ACCTRANREMARK+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right">'+value.ACCAMT1+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right">'+value.ACCAMT2+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.SECTION1+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.PROJECTNO+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.ADJFLAG+'</td>'+
                                        '<td class="hidden"><input name="ROWNOA[]" value='+value.ROWNO+'></td>'+
                                    '</tr>');
            countRow++;
            accamt1 += parseFloat(value.ACCAMT1.replace(/,/g, '')) || 0;
            accamt2 += parseFloat(value.ACCAMT2.replace(/,/g, '')) || 0;
        });
        // console.log(countRow);
        if(countRow < 5) {
           for (var i = countRow; i < 5; i++) {
                $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
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
        }
        document.querySelector('#record').innerText = countRow;
        $('#TTL_AMT1').val(num2digit(accamt1));
        $('#TTL_AMT2').val(num2digit(accamt2));
        $('#loading').hide();
        selectRow();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function commitRemark() {
    $('#loading').show();
    keepData();
    const data = new FormData(form);
    data.append('action', 'commitRemark');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.data === 'ERRO:ERRO_NOREMARK') {
            $('#loading').hide();
            return actionDialog(response.data);
        }
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function commitRecurring() {
    $('#loading').show();
    let res;
    const data = new FormData(form);
    data.append('action', 'commitRecurring');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res != 'ERRO_NO_INPUT_RECURRINGDATA') {
            if(res['SYSVIS_SAVEREC'] == 'F') {
                document.getElementById('SAVEREC').style.visibility = 'hidden';
            }
            if(res['SYSVIS_RE01'] == 'T') {
                document.getElementById('RE01').style.visibility = 'visible';
            }
        } else {
            $('#loading').hide();
            return actionDialog(response.data);
        }
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function searchRecur() {
    $('#loading').show();
    let accamt1 = 0; let accamt2 = 0;
    const data = new FormData(form);
    data.append('action', 'searchRecur');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwdetail').html('');
        let countRow = 0;
        $.each(response.data,function(key, value) {
            $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+key+'">'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id">'+value.ROWNO+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.ACC_CD+'</td>'+
                                        '<td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">'+value.ACC_NM+'</td>'+
                                        '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">'+value.ACCTRANREMARK+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right">'+value.ACCAMT1+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right">'+value.ACCAMT2+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.SECTION1+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.PROJECTNO+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left">'+value.ADJFLAG+'</td>'+
                                        '<td class="hidden"><input name="ROWNOA[]" value='+value.ROWNO+'></td>'+
                                    '</tr>');
            countRow++;
            accamt1 += parseFloat(value.ACCAMT1.replace(/,/g, '')) || 0;
            accamt2 += parseFloat(value.ACCAMT2.replace(/,/g, '')) || 0;
        });
        // console.log(countRow);
        if(countRow < 5) {
           for (var i = countRow; i < 5; i++) {
                $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
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
        }
        document.querySelector('#record').innerText = countRow;
        $('#TTL_AMT1').val(num2digit(accamt1));
        $('#TTL_AMT2').val(num2digit(accamt2));
        $('#loading').hide();
        selectRow();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function selectRow() {
    $(document).on('click', '.av tbody tr', function(event) {
        if(BOOKORDERNO.val() == '') {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
                $('#ROWNO').val(item.eq(0).text());
                $('#ACC_CD').val(item.eq(1).text());
                $('#ACC_NM').val(item.eq(2).text());
                $('#ACCTRANREMARK').val(item.eq(3).text());
                $('#ACCAMT1').val(item.eq(4).text());
                $('#ACCAMT2').val(item.eq(5).text());
                $('#PROJECTNO').val(item.eq(7).text());
                $('#TAXINVOICENO').val(item.eq(7).text());
                if(item.eq(4).text() != '') {
                    $('#AMT').val(item.eq(4).text());
                } else {
                    $('#AMT').val(item.eq(5).text());
                }
                document.getElementById('DC_TYPE').value = item.eq(9).text(); 
                document.getElementById('SECTION1').value = item.eq(6).text(); 
                ChkADJ(item.eq(8).text());     
            }
        }
    });
}

async function ChkADJ(ADJFLAG) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'ChkADJ');
    data.append('ADJFLAG', ADJFLAG);
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function printed() {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'JVprint');
  await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
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

// async function printed(type) {
//     await keepData();
//     if(type == 'JV') {
//         var popupWindow = window.open('../ACC_ADJUSTVO_ONLY_THA/adjust_voucher_only.php', '_blank', 'width=800, height=800');
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }

async function getAcc() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'getAcc');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res.ACCAMT1 != '') { amt1 = numberWithComma(parseFloat(res.ACCAMT1).toFixed(2)); }
        if(res.ACCAMT2 != '') { amt2 = numberWithComma(parseFloat(res.ACCAMT2).toFixed(2)); }
        $('#ACCAMT1').val(amt1);
        $('#ACCAMT2').val(amt2);
        keepData();
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getAmt() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'getAmt');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res['ACCAMT1'] != '') { amt1 = numberWithComma(parseFloat(res['ACCAMT1']).toFixed(2)); }
        if(res['ACCAMT2'] != '') { amt2 = numberWithComma(parseFloat(res['ACCAMT2']).toFixed(2)); }
        $('#ACCAMT1').val(amt1);
        $('#ACCAMT2').val(amt2);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getExRate() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'getExRate');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res['ACCAMT1'] != '') { amt1 = numberWithComma(parseFloat(res['ACCAMT1']).toFixed(2)); }
        if(res['ACCAMT2'] != '') { amt2 = numberWithComma(parseFloat(res['ACCAMT2']).toFixed(2)); }
        $('#EXRATE').val(res['EXRATE']);
        $('#ACCAMT1').val(amt1);
        $('#ACCAMT2').val(amt2);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
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
    data.append('systemName', 'ACC_ADJUSTVO_ONLY_THA');
    await axios.post('../ACC_ADJUSTVO_ONLY_THA/function/index_x.php', data)
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
            } else if(type == 2) {
                return action('commit');
            } else if(type == 3) {
                return commitRecurring();
            } else if(type == 4) {
                return commitRemark();
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

    // clearing table
    // $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = '../ACC_ADJUSTVO_ONLY_THA/';

    return false;
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 9; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}