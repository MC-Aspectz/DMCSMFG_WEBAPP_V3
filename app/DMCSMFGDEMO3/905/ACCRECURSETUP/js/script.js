// icon search
const SEARCHRECUR = $('#SEARCHRECUR');
const SEARCHACCOUNT = $('#SEARCHACCOUNT');

SEARCHRECUR.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHRECUR/index.php?page=ACCRECURSETUP', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACCRECURSETUP', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHRECUR, SEARCHACCOUNT];

//input serach
const RECURCD = $('#RECURCD');
const ACC_CD = $('#ACC_CD');

const input_serach = [RECURCD, ACC_CD];

// form
const form = document.getElementById('accRecurSetup');

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

for(const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
};

for (const input of input_serach) {
    input.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        $('#loading').show();
        keepData();
    }
  });
}

COMMIT.click(function() {
    // check validate form
    return actionDialog(2);
});

UPDATE.click(function() {
    // check validate form
    $('#loading').show();
    return update();
});

RECURCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        getSearch('RECURCD', RECURCD.val());
    }
});

ACC_CD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        getElement('ACC_CD', ACC_CD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/905/ACCRECURSETUP/index.php?'+code+'=' + value;  
}

async function getElement(code, value) {
    $('#loading').show(); entry();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        // console.log(result);
        if(result != '' && result != 'ERRO:ERRONOTACTIVEACC') {
            $.each(result, function(key, value) {
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });
        }

        if(result == 'ERRO:ERRONOTACTIVEACC') {
            return getMessage('ERRONOTACTIVEACC');
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
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(jQuery.type(response.data) === 'object');
        if(response.status == '200') {
            $('#loading').hide();
            unsetSession(form);
            window.location.href = '../ACCRECURSETUP/';
        }
    })
    .catch(e => {
        // console.log(e);
    });
}

async function entryUnset() {
    const data = new FormData(form);
    data.append('action', 'entryUnset');
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        // window.location.reload();
    })
    .catch(e => {
        // console.log(e);
    });
}

function selectRow() {
    $(document).on('click', '.recur_tb tr', function(event){
        // let rowId = $(this).closest('tr').attr('id');
        // console.log(rowId);
        let item = $(this).closest('tr').children('td');
        id = item.eq(0).text();
        // console.log($(this).closest('tr'));
        let rows = document.getElementsByTagName('tr');
        $('.row-id').each(function (i) {
            rows[i+1].classList.remove('selected-row');
        }); 
        if(id != '') {
            rows[id].classList.add('selected-row'); 

            $('#ROWNO').val(item.eq(0).text());
            $('#ACC_CD').val(item.eq(1).text());
            $('#ACC_NM').val(item.eq(2).text());
            $('#ACCTRANREMARK').val(item.eq(3).text());
            $('#ACCAMT1').val(item.eq(4).text());
            $('#ACCAMT2').val(item.eq(5).text());
            $('#PROJECTNO').val(item.eq(7).text());
            if(item.eq(4).text() != '') {
                $('#AMT').val(item.eq(4).text());
            } else {
                $('#AMT').val(item.eq(5).text());
            }
            document.getElementById('DC_TYP').value = item.eq(8).text(); 
            document.getElementById('SECTION1').value = item.eq(6).text();
            document.getElementById('INSERT').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;  
        }
    });
    // $('table#table tbody tr').click(function () {
    //     // $('table#table tbody tr').removeAttr('id');
    //     $('table#table tbody tr').removeClass('click-row');

    //     let item = $(this).closest('tr').children('td');

    //     if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
    //         // console.log(item.eq(0).text());
    //         // $(this).attr('id', 'click-row');
    //         $(this).addClass('click-row');
    //         $('#ROWNO').val(item.eq(0).text());
    //         $('#ACC_CD').val(item.eq(1).text());
    //         $('#ACC_NM').val(item.eq(2).text());
    //         $('#ACCTRANREMARK').val(item.eq(3).text());
    //         $('#ACCAMT1').val(item.eq(4).text());
    //         $('#ACCAMT2').val(item.eq(5).text());
    //         $('#PROJECTNO').val(item.eq(7).text());
    //         if(item.eq(4).text() != '') {
    //             $('#AMT').val(item.eq(4).text());
    //         } else {
    //             $('#AMT').val(item.eq(5).text());
    //         }
    //         document.getElementById('DC_TYP').value = item.eq(8).text(); 
    //         document.getElementById('SECTION1').value = item.eq(6).text();
    //         document.getElementById("INSERT").disabled = true;
    //         document.getElementById("UPDATE").disabled = false;
    //         document.getElementById("DELETE").disabled = false;       
    //     }
    // });
}

async function update() {
    let rowno = $('#ROWNO').val();
    $('#ACC_CD'+rowno+'').val($('#ACC_CD').val());
    $('#ACC_CD_TD'+rowno+'').html($('#ACC_CD').val());
    $('#ACC_NM'+rowno+'').val($('#ACC_NM').val());
    $('#ACC_NM_TD'+rowno+'').html($('#ACC_NM').val());
    $('#ACCTRANREMARK'+rowno+'').val($('#ACCTRANREMARK').val())
    $('#ACCTRANREMARK_TD'+rowno+'').html($('#ACCTRANREMARK').val());
    $('#SECTION1'+rowno+'').val(document.getElementById("SECTION1").value);
    $('#SECTION1_TD'+rowno+'').html(document.getElementById("SECTION1").value);
    $('#ACCAMT1'+rowno+'').val($('#ACCAMT1').val());
    $('#ACCAMT1_TD'+rowno+'').html($('#ACCAMT1').val());
    $('#ACCAMT2'+rowno+'').val($('#ACCAMT2').val());
    $('#ACCAMT2_TD'+rowno+'').html($('#ACCAMT2').val());
    $('#PROJECTNO'+rowno+'').val($('#PROJECTNO').val());
    $('#PROJECTNO_TD'+rowno+'').html($('#PROJECTNO').val());
    $('#DC_TYPE'+rowno+'').val($('#DC_TYP').val());
    $('#DC_TYPE_TD'+rowno+'').html($('#DC_TYP').val());
    $('#AMT'+rowno+'').val($('#AMT').val().replace(/,/g, ''));
    $('#CURRENCY1'+rowno+'').val($('#CURRENCY1').val());
    $('#I_CURRENCY'+rowno+'').val($('#I_CURRENCY').val());
    $('#EXRATE'+rowno+'').val($('#EXRATE').val());

    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true; 
    calculateTotal();
    entry(); entryUnset();
    await keepItemData();
}

function entry() {
    $('#ROWNO').val('');
    $('#ACC_CD').val('');
    $('#ACC_NM').val('');
    $('#ACCAMT1').val('');
    $('#ACCAMT2').val('');
    $('#PROJECTNO').val('');
    $('#AMT').val('');
    $('#EXRATE').val('1.000000');
    $('#ACCTRANREMARK').val('');
    $('#DCACCCD').val('');
    $('#ACCTYP').val('');
    $('#ROWCOUNTER').val('');

    document.getElementById('I_CURRENCY').value = 'THB'; 
    document.getElementById('DC_TYP').value = 0; 
    document.getElementById('SECTION1').value = '';
    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
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
    $('#TTL_AMT1').val(numberWithCommas(accamt1.toFixed(2)));
    $('#TTL_AMT2').val(numberWithCommas(accamt2.toFixed(2)));
}

async function dc_type() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'dc_type');
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        $('#AMT').val(res.AMT);
        $('#ACC_NM').val(res.ACC_NM);
        $('#EXRATE').val(res.EXRATE);
        $('#I_CURRENCY').val(res.I_CURRENCY);
        $('#ACCAMT1').val('');
        $('#ACCAMT2').val('');
        // keepData();
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function dc_type1() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'dc_type1');
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        if(res['ACCAMT1'] != '') { amt1 = numberWithCommas(parseFloat(res['ACCAMT1']).toFixed(2)); }
        if(res['ACCAMT2'] != '') { amt2 = numberWithCommas(parseFloat(res['ACCAMT2']).toFixed(2)); }
        $('#ACCAMT1').val(amt1);
        $('#ACCAMT2').val(amt2);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function get_exrate() {
    $('#loading').show();
    var res; let amt1; let amt2;
    const data = new FormData(form);
    data.append('action', 'get_exrate');
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        res = response.data;
        $('#EXRATE').val(res['EXRATE']);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getMessage(code) {
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

    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
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
    data.append('systemName', 'ACCRECURSETUP');

    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
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
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
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
    await axios.post('../ACCRECURSETUP/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        return calculateTotal();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
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
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                unsetSession(form); 
                return programDelete();
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
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

    // clearing table
    // $('#table_result > tbody > tr').remove();

    // refresh
    $('#dvwdetail').empty();
    emptyTable();
    $('#record').html(0);
    // window.location.href = '../ACCRECURSETUP/';

    return false;
}
  
function emptyTable() {
    for (var i = 1; i <= 5; i++) {
        $('#dvwdetail').append( '<tr class="border border-gray-600" id="rowId'+i+'">'+
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

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}

function digitFormat(num) {
    while (num.search(",") >= 0) {
        num = (num + "").replace(',', '');
    }
    return parseFloat(num).toFixed(6);
};

$(document).ready(function() {  
    if(ACC_CD.val() != '') {
        document.getElementById('ACC_CD').classList.remove('req');
    }
}); 

function changeRowId() {
    var elem = document.getElementsByTagName('tr');
    // var elem = document.getElementsByClassName('border border-gray-600');
    for (var i = 1; i <= elem.length-1; i++) {
      // console.log(i);
      // if (elem[i].id) {
        // console.log(elem[i].id);
        index_x = Number(elem[i].rowIndex);
        elem[i].id = "rowId" + index_x;
      // }
    }
}

function emptyRow(n) {
  $("table tbody").append(
    '<tr class="border border-gray-600" id="rowId' + n +">" +
        '<td class="h-6 border border-slate-700 row-id"></td>' +
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


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}