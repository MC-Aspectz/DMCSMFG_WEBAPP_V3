// icon search
const ACCBOKGUIDE8 = $('#ACCBOKGUIDE8');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCDDATA = $('#SEARCHCDDATA');
const SEARCHRECUR = $('#SEARCHRECUR');
const SEARCHACCOUNT = $('#SEARCHACCOUNT');

ACCBOKGUIDE8.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ACCBOKGUIDE8/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCDDATA.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCDDATA/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');});
SEARCHRECUR.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHRECUR/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ACCBOKGUIDE8, SEARCHDIVISION, SEARCHCDDATA, SEARCHRECUR, SEARCHACCOUNT];

//input serach
const BOOKORDERNO = $('#BOOKORDERNO'); 
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
const form = document.getElementById('pettycashvoucher');

// action button
const SEARCH = $('#SEARCH');
const PETTYVOUCHER = $('#PETTYVOUCHER');
const SAVE = $('#SAVE');
const SAVEREC = $('#SAVEREC');
const RE01 = $('#RE01');
const COMMIT = $('#COMMIT');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

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

UPDATE.click(function() {
    // check validate form
    $('#loading').show();
    return update();
});

PETTYVOUCHER.click(function() {
    // check validate form
    if (REPRINTREASON.val() == '') {
        actionDialog(4);
        return false;
    }
    // return printed('JV');
    return printed();
});

BOOKORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('BOOKORDERNO', BOOKORDERNO.val());
    }
    if(BOOKORDERNO.val() == '') unsetSession(form);
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
  return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/830/ACC_PETTYCASHVO_THA/index.php?'+code+'=' + value;
}

function searchPartner() {
    keepData();
    if(CSSTYPE.val() == 1) {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');
    } else if(CSSTYPE.val() == 2) {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');
    } else {
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_PETTYCASHVO_THA', 'authWindow', 'width=1200,height=600');
    }
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
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

async function getACCCD(ACC_CD) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'getACCCD');
    data.append('ACC_CD', ACC_CD);
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#ACC_CD').val(response.data['ACC_CD']);
        $('#ACC_NM').val(response.data['ACC_NM']);
        if(DC_TYPE.value == 0) {
            $('#ACCAMT1').val('0.00');
        } else if(DC_TYPE.value == 1) {
            $('#ACCAMT2').val('0.00');
        }
        unRequired();      
        document.activeElement.blur();  
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function entryUnset() {
    const data = new FormData(form);
    data.append('action', 'entryUnset');
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        // window.location.reload();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function action(action) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(jQuery.type(response.data) === 'object');
        if(response.status == '200') {
            $('#loading').hide();
            if(action == 'commit') {
                if(jQuery.type(response.data) === 'object') {
                    window.location.href='index.php?BOOKORDERNO=' + response.data['BOOKORDERNO'];
                } else {
                    return actionDialog(response.data);
                }
            }
        }
    })
    .catch(e => {
        console.log(e);
    });
}

async function getDetail() {
    $('#loading').show();
    let accamt1 = 0; let accamt2 = 0;
    const data = new FormData(form);
    data.append('action', 'getDetail');
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwdetail').html('');
        let countRow = 0; let sectype = response.data['sectype'];
        $.each(response.data['getDetail'],function(key, value) {
            let section = '';
            if(sectype[value.SECTION1] != undefined) {  section = sectype[value.SECTION1]; }
            $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+key+'">'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD'+key+'">'+value.ROWNO+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_CD_TD'+key+'">'+value.ACC_CD+'</td>'+
                                        '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACC_NM_TD'+key+'">'+value.ACC_NM+'</td>'+
                                        '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACCTRANREMARK_TD'+key+'">'+value.ACCTRANREMARK+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT1_TD'+key+'">'+value.ACCAMT1+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT2_TD'+key+'">'+value.ACCAMT2+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="SECTION1_TD'+key+'">'+ section +'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="PROJECTNO_TD'+key+'">'+value.PROJECTNO+'</td>'+

                                        '<input class="td-param" id="ROWNO'+key+'" name="ROWNOA[]" value="'+value.ROWNO+'">' +
                                        '<input class="td-param" id="ACC_CD'+key+'" name="ACC_CDA[]" value="'+ value.ACC_CD +'">' +
                                        '<input class="td-param" id="ACC_NM'+key+'" name="ACC_NMA[]" value="'+ value.ACC_NM +'">' +
                                        '<input class="td-param" id="ACCTRANREMARK'+key+'" name="ACCTRANREMARKA[]" value="'+ value.ACCTRANREMARK +'">' +
                                        '<input class="td-param" id="ACCAMT1'+key+'" name="ACCAMT1A[]" value="'+ value.ACCAMT1 +'">' +
                                        '<input class="td-param" id="ACCAMT2'+key+'" name="ACCAMT2A[]" value="'+ value.ACCAMT2 +'">' +
                                        '<input class="td-param" id="SECTION1'+key+'" name="SECTION1A[]" value="'+ value.SECTION1 +'">' +
                                        '<input class="td-param" id="PROJECTNO'+key+'" name="PROJECTNOA[]" value="'+ value.PROJECTNO +'">' +
                                        '<input class="td-param" id="ADJFLAG'+key+'" name="ADJFLAGA[]" value="">' +
                                        '<input class="td-param" id="DC_TYPE'+key+'" name="DC_TYPEA[]" value="'+ value.DC_TYPE +'">' +
                                        '<input class="td-param" id="CURRENCY1'+key+'" name="CURRENCY1A[]" value="'+ value.CURRENCY1 +'">' +
                                        '<input class="td-param" id="I_CURRENCY'+key+'" name="I_CURRENCYA[]" value="'+ value.I_CURRENCY +'">' +
                                        '<input class="td-param" id="EXRATE'+key+'" name="EXRATEA[]" value="'+ value.EXRATE +'">' +
                                        '<input class="td-param" id="AMT'+key+'" name="AMTA[]" value="'+ value.AMT +'">' +
                                        '<input class="td-param" id="WHTAXTYP'+key+'" name="WHTAXTYPA[]" value="">' +
                                        '<input class="td-param" id="TAXINVOICENO'+key+'" name="TAXINVOICENOA[]" value=">' +
                                    '</tr>');
            countRow++;
            accamt1 += parseFloat(value.ACCAMT1.replace(/,/g, '')) || 0;
            accamt2 += parseFloat(value.ACCAMT2.replace(/,/g, '')) || 0;
        });
        // console.log(countRow);
        if(countRow <= 5) {
            for (var i = countRow+1; i <= 5; i++) {
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
        // emptyTable()
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
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
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
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
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
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwdetail').html('');
        let countRow = 0; let sectype = response.data['sectype'];
        $.each(response.data['searchRecur'],function(key, value) {
            let section = '';
            if(sectype[value.SECTION1] != undefined) {  section = sectype[value.SECTION1]; }
            $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+key+'">'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD'+key+'">'+value.ROWNO+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_CD_TD'+key+'">'+value.ACC_CD+'</td>'+
                                        '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACC_NM_TD'+key+'">'+value.ACC_NM+'</td>'+
                                        '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACCTRANREMARK_TD'+key+'">'+value.ACCTRANREMARK+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT1_TD'+key+'">'+value.ACCAMT1+'</td>'+
                                        '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT2_TD'+key+'">'+value.ACCAMT2+'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="SECTION1_TD'+key+'">'+ section +'</td>'+
                                        '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="PROJECTNO_TD'+key+'">'+value.PROJECTNO+'</td>'+

                                        '<input class="td-param" type="hidden" id="ROWNO'+key+'" name="ROWNOA[]" value="'+value.ROWNO+'">' +
                                        '<input class="td-param" type="hidden" id="ACC_CD'+key+'" name="ACC_CDA[]" value="'+ value.ACC_CD +'">' +
                                        '<input class="td-param" type="hidden" id="ACC_NM'+key+'" name="ACC_NMA[]" value="'+ value.ACC_NM +'">' +
                                        '<input class="td-param" type="hidden" id="ACCTRANREMARK'+key+'" name="ACCTRANREMARKA[]" value="'+ value.ACCTRANREMARK +'">' +
                                        '<input class="td-param" type="hidden" id="ACCAMT1'+key+'" name="ACCAMT1A[]" value="'+ value.ACCAMT1 +'">' +
                                        '<input class="td-param" type="hidden" id="ACCAMT2'+key+'" name="ACCAMT2A[]" value="'+ value.ACCAMT2 +'">' +
                                        '<input class="td-param" type="hidden" id="SECTION1'+key+'" name="SECTION1A[]" value="'+ value.SECTION1 +'">' +
                                        '<input class="td-param" type="hidden" id="PROJECTNO'+key+'" name="PROJECTNOA[]" value="'+ value.PROJECTNO +'">' +
                                        '<input class="td-param" type="hidden" id="ADJFLAG'+key+'" name="ADJFLAGA[]" value="">' +
                                        '<input class="td-param" type="hidden" id="DC_TYPE'+key+'" name="DC_TYPEA[]" value="'+ value.DC_TYPE +'">' +
                                        '<input class="td-param" type="hidden" id="CURRENCY1'+key+'" name="CURRENCY1A[]" value="'+ value.CURRENCY1 +'">' +
                                        '<input class="td-param" type="hidden" id="I_CURRENCY'+key+'" name="I_CURRENCYA[]" value="'+ value.I_CURRENCY +'">' +
                                        '<input class="td-param" type="hidden" id="EXRATE'+key+'" name="EXRATEA[]" value="'+ value.EXRATE +'">' +
                                        '<input class="td-param" type="hidden" id="AMT'+key+'" name="AMTA[]" value="'+ value.AMT +'">' +
                                        '<input class="td-param" type="hidden" id="WHTAXTYP'+key+'" name="WHTAXTYPA[]" value="">' +
                                        '<input class="td-param" type="hidden" id="TAXINVOICENO'+key+'" name="TAXINVOICENOA[]" value=">' +
                                    '</tr>');
            countRow++;
            accamt1 += parseFloat(value.ACCAMT1.replace(/,/g, '')) || 0;
            accamt2 += parseFloat(value.ACCAMT2.replace(/,/g, '')) || 0;
        });
        // console.log(countRow);
        if(countRow <= 5) {
            for (var i = countRow+1; i <= 5; i++) {
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
        console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function ChkADJ(ADJFLAG) {
    $('#loading').show();
    let res;
    const data = new FormData(form);
    data.append('action', 'ChkADJ');
    data.append('ADJFLAG', ADJFLAG);
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        document.getElementById('INSERT').disabled = true;
        if(res['SYSEN_UPDATE'] == 'F') { document.getElementById("UPDATE").disabled = true; } else { document.getElementById("UPDATE").disabled = false; }
        if(res['SYSEN_DELETE'] == 'F') { document.getElementById("DELETE").disabled = true; } else { document.getElementById("DELETE").disabled = false; }
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function selectRow() {
    $(document).on('click', '.pcv tbody tr', function(event) {
        if(BOOKORDERNO.val() == '') {
            $('table#table tbody tr').not(this).removeClass('selected'); entry();
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let rec = item.eq(0).text();
                let table = document.getElementById('table');
                if(rec != '') { 
                    table.rows[rec].classList.toggle('selected');
                }
                // console.log(rec);
                $('#ROWNO').val($('#ROWNO'+rec+'').val());
                $('#ACC_CD').val($('#ACC_CD'+rec+'').val());
                $('#ACC_NM').val($('#ACC_NM'+rec+'').val());
                $('#ACCTRANREMARK').val($('#ACCTRANREMARK'+rec+'').val());
                $('#ACCAMT1').val($('#ACCAMT1'+rec+'').val());
                $('#ACCAMT2').val($('#ACCAMT2'+rec+'').val());
                $('#AMT').val($('#AMT'+rec+'').val());
                $('#EXRATE').val($('#EXRATE'+rec+'').val());
                $('#PROJECTNO').val($('#PROJECTNO'+rec+'').val());
                $('#TAXINVOICENO').val($('#TAXINVOICENO'+rec+'').val());

                if($('#DC_TYPE'+rec+'').val() == 0) {
                    $('#AMT').val($('#ACCAMT1'+rec+'').val());
                } else {
                    $('#AMT').val($('#ACCAMT2'+rec+'').val());
                }
                document.getElementById('DC_TYPE').value = $('#DC_TYPE'+rec+'').val();
                document.getElementById('WHTAXTYP').value = $('#WHTAXTYP'+rec+'').val();
                document.getElementById('SECTION1').value = $('#SECTION1'+rec+'').val();
                document.getElementById('CURRENCY1').value = $('#CURRENCY1'+rec+'').val();
                document.getElementById('I_CURRENCY').value = $('#I_CURRENCY'+rec+'').val();
                document.getElementById('INSERT').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;   
                unRequired();    
            }
        }
    });
}

async function update() {
    let rowno = $('#ROWNO').val();
    $('#ACC_CD_TD'+rowno+'').html($('#ACC_CD').val());
    $('#ACC_NM_TD'+rowno+'').html($('#ACC_NM').val());
    $('#ACCTRANREMARK_TD'+rowno+'').html($('#ACCTRANREMARK').val());
    $('#ACCAMT1_TD'+rowno+'').html($('#ACCAMT1').val());
    $('#ACCAMT2_TD'+rowno+'').html($('#ACCAMT2').val());
    $('#SECTION1_TD'+rowno+'').html($('#SECTION1 option:selected').text());
    $('#PROJECTNO_TD'+rowno+'').html($('#PROJECTNO').val());

    $('#ACC_CD'+rowno+'').val($('#ACC_CD').val());
    $('#ACC_NM'+rowno+'').val($('#ACC_NM').val());
    $('#ACCTRANREMARK'+rowno+'').val($('#ACCTRANREMARK').val())
    $('#ACCAMT1'+rowno+'').val($('#ACCAMT1').val());
    $('#ACCAMT2'+rowno+'').val($('#ACCAMT2').val());
    $('#SECTION1'+rowno+'').val(document.getElementById('SECTION1').value);
    $('#PROJECTNO'+rowno+'').val($('#PROJECTNO').val());
    $('#DC_TYPE'+rowno+'').val(document.getElementById('DC_TYPE').value);
    $('#CURRENCY1'+rowno+'').val(document.getElementById('CURRENCY1').value);
    $('#I_CURRENCY'+rowno+'').val(document.getElementById('I_CURRENCY').value);
    $('#EXRATE'+rowno+'').val($('#EXRATE').val());
    $('#AMT'+rowno+'').val(dec2digit($('#AMT').val()));
    $('#WHTAXTYP'+rowno+'').val(document.getElementById('WHTAXTYP').value);
    $('#TAXINVOICENO'+rowno+'').val($('#TAXINVOICENO').val());

    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true; 
    calculateTotal();
    entry();
    await keepItemData();
}

function entry() {
    $('table#table tr').not(this).removeClass('selected');
    $('#ROWNO').val('');
    $('#ACC_CD').val('');
    $('#ACC_NM').val('');
    $('#ACCAMT1').val('');
    $('#ACCAMT2').val('');
    $('#PROJECTNO').val('');
    $('#TAXINVOICENO').val('');
    $('#AMT').val('');
    $('#EXRATE').val('1.000000');
    $('#ACCTRANREMARK').val('');
    document.getElementById('I_CURRENCY').value = 'THB'; 
    document.getElementById('DC_TYPE').value = 0; 
    document.getElementById('SECTION1').value = '';
    document.getElementById('WHTAXTYP').value = '';  
    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
    entryUnset();
}

function calculateTotal() {
    let accamt1 = 0; let accamt2 = 0;
    let accamt1a = document.getElementsByName('ACCAMT1A[]');
    let accamt2a = document.getElementsByName('ACCAMT2A[]');
    // console.log(amta.length);
    for (let i = 0; i < accamt1a.length; i++) {
        accamt1 += parseFloat(accamt1a[i].value.replace(/,/g, '')) || 0;
        accamt2 += parseFloat(accamt2a[i].value.replace(/,/g, '')) || 0;
    }
    // console.log(attlamt1);
    $('#TTL_AMT1').val(num2digit(accamt1));
    $('#TTL_AMT2').val(num2digit(accamt2));
}

async function printed() {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'JVprint');
  await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
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
//         var popupWindow = window.open('../ACC_PETTYCASHVO_THA/petty_cash_voucher.php', '_blank', 'width=800, height=800');
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// }

async function getAcc() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'getAcc');
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res.ACCAMT1 != '') { amt1 = num2digit(res.ACCAMT1); }
        if(res.ACCAMT2 != '') { amt2 = num2digit(res.ACCAMT2); }
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
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res['ACCAMT1'] != '') { amt1 = num2digit(res['ACCAMT1']); }
        if(res['ACCAMT2'] != '') { amt2 = num2digit(res['ACCAMT2']); }
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
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res['ACCAMT1'] != '') { amt1 = num2digit(res['ACCAMT1']); }
        if(res['ACCAMT2'] != '') { amt2 = num2digit(res['ACCAMT2']); }
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

    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
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
    data.append('systemName', 'ACC_PETTYCASHVO_THA');

    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_PETTYCASHVO_THA/function/index_x.php', data)
    .then(response => {
        // $('#loading').hide();
        // console.log(response.data);
        return calculateTotal();
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
    // $('#dvwdetail').empty();
    // emptyTable();
    
    // refresh
    window.location.href = '../ACC_PETTYCASHVO_THA/';

    return false;
}

function emptyTable() {
    let maxrow; $('#dvwdetail').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 15; } else { maxrow = 10; }
    for (var i = 1; i <= maxrow; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200 row-empty" id="rowId'+i+'">'+
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

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function changeRowId() {
    var elem = document.getElementsByTagName('tr');
    var elemTD = document.getElementsByTagName('td');
    var elemInput = document.querySelectorAll('input.td-param');
    for (var i = 1; i < elem.length-1; i++) {
        // console.log(i);
        if (elem[i].id) {
            index_x = Number(elem[i].rowIndex);
            elem[i].id = 'rowId' + index_x;
        }
        // elemTD[i].id = 'ROWNO_TD' + i;
        // elemTD[i].id = 'ACC_CD_TD' + i;
        // elemTD[i].id = 'ACC_NM_TD' + i;
        // elemTD[i].id = 'ACCTRANREMARK_TD' + i;
        // elemTD[i].id = 'ACCAMT1_TD' + i;
        // elemTD[i].id = 'ACCAMT2_TD' + i;
        // elemTD[i].id = 'SECTION1_TD' + i;
        // elemTD[i].id = 'PROJECTNO_TD' + i;
        // elemInput[i].id = 'ROWNO' + i;
        // elemInput[i].id = 'ACC_CD' + i;
        // elemInput[i].id = 'ACC_NM' + i;
        // elemInput[i].id = 'ACCTRANREMARK' + i;
        // elemInput[i].id = 'ACCAMT1' + i;
        // elemInput[i].id = 'ACCAMT2' + i;
        // elemInput[i].id = 'SECTION1' + i;
        // elemInput[i].id = 'PROJECTNO' + i;
        // elemInput[i].id = 'ADJFLAG' + i;
        // elemInput[i].id = 'DC_TYPE' + i;
        // elemInput[i].id = 'CURRENCY1' + i;
        // elemInput[i].id = 'I_CURRENCY' + i;
        // elemInput[i].id = 'EXRATE' + i;
        // elemInput[i].id = 'AMT' + i;
        // elemInput[i].id = 'WHTAXTYP' + i;
        // elemInput[i].id = 'TAXINVOICENO' + i;
    }
}
