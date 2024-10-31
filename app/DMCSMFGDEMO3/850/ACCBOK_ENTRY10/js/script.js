// form
const form = document.getElementById('accBOKEntry10');

// button
const ASVC = $("#ASVC");
const COMMIT = $("#COMMIT");
const OK = $("#OK");
const UPDATE = $("#UPDATE");
const DELETE = $("#DELETE");
const CLOSEPAGE = $("#CLOSEPAGE");

// guide
const ASSETGUIDE = $("#ASSETGUIDE");
const SEARCHDIVISION = $("#SEARCHDIVISION");
const SEARCHSUPPLIER = $("#SEARCHSUPPLIER");
const ASSETACCGUIDE = $("#ASSETACCGUIDE");
const SEARCHACCOUNT = $("#SEARCHACCOUNT");

ASSETGUIDE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETGUIDE/index.php?page=ACCBOK_ENTRY10', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACCBOK_ENTRY10', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACCBOK_ENTRY10', 'authWindow', 'width=1200,height=600');});
ASSETACCGUIDE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETACCGUIDE/index.php?page=ACCBOK_ENTRY10', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACCBOK_ENTRY10', 'authWindow', 'width=1200,height=600');});

const search_icon = [ASSETGUIDE, SEARCHDIVISION, SEARCHSUPPLIER, ASSETACCGUIDE, SEARCHACCOUNT];

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

// onchange
const BOOKORDERNO = $("#BOOKORDERNO"); 
const DIVISIONCD = $("#DIVISIONCD");
const CSS_TYPE = $("#CSS_TYPE");
const ASSETACC = $("#ASSETACC");
const SUPPLIERCD = $("#SUPPLIERCD");
const ACC_CD = $("#ACC_CD");
// req ACCY DIVISIONCD ASSETTYP ASSETCD UPRICE ASSETNM ASSETACC LIFEY
const ACCY = $("#ACCY");
const ASSETTYP = $("#ASSETTYP");
const ASSETCD = $("#ASSETCD");
const UPRICE = $("#UPRICE");
const ASSETNM = $("#ASSETNM");
const LIFEY = $("#LIFEY");

// onchange
const input_search = [BOOKORDERNO, DIVISIONCD, CSS_TYPE, ASSETACC, SUPPLIERCD, ACC_CD];

for (const input of input_search) {
    input.on('keyup change', function (e) {
      if (e.type === 'change') {
            $('#loading').show();
        } else if (e.key === 'Enter' || e.keyCode === 13) {
            $('#loading').show();
        }
    });
}

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACCBOK_ENTRY10/index.php?'+code+'=' + value;
}

COMMIT.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    return actionDialog(2);
});

UPDATE.click(function() {
    // check validate form
    $('#loading').show();
    return update();
});

ASVC.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    return actionDialog(5);
});

BOOKORDERNO.on('keyup change', async function(e) {
    if(e.type === 'change') {
        window.location.href="index.php?BOOKORDERNO=" + BOOKORDERNO.val();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?BOOKORDERNO=" + BOOKORDERNO.val();
    }
    if(BOOKORDERNO.val() == '') unsetSession(form);
});

DIVISIONCD.on('keyup change', async function(e) {
    if(e.type === 'change') {
        keepData();
        await getDiv(DIVISIONCD.val());
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        await getDiv(DIVISIONCD.val());
    }
});

SUPPLIERCD.on('keyup change', async function(e) {
    if(e.type === 'change') {
        keepData();
        await get_supllier(SUPPLIERCD.val());
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        await get_supllier(SUPPLIERCD.val());
    }
});

ASSETACC.on('keyup change', async function(e) {
    if(e.type === 'change') {
        keepData();
        await get_assetn();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        await get_assetn();
    }
});

ACC_CD.on('keyup change', async function(e) {
    if(e.type === 'change') {
        keepData();
        await get_acc();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        await get_acc();
    }
});

async function get_acc() {
    const data = new FormData(form);
    data.append('action', 'get_acc');
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            if(jQuery.type(response.data) === 'object') {
                $("#ACC_CD").val(response.data['ACC_CD']);
                $("#ACC_NM").val(response.data['ACC_NM']);
            } else {
                return actionDialog(4);
            }
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function getDiv(DIVISIONCD) {
    const data = new FormData(form);
    data.append('action', 'getDiv');
    data.append('DIVISIONCD', DIVISIONCD);
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            $("#DIVISIONCD").val(response.data['DIVISIONCD']);
            $("#DIVISIONNAME").val(response.data['DIVISIONNAME']);
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function get_supllier(SUPPLIERCD) {
    const data = new FormData(form);
    data.append('action', 'get_supllier');
    data.append('SUPPLIERCD', SUPPLIERCD);
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            $("#SUPPLIERCD").val(response.data['SUPPLIERCD']);
            $("#SUPPLIERNAME").val(response.data['SUPPLIERNAME']);
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function get_exrate() {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', 'get_exrate');
    data.append('I_CURRENCY', $('#I_CURRENCY').val());
    data.append('CURRENCY1', $('#CURRENCY1').val());  
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $('#loading').hide();
            if(response.data['EXRATE'] != '') { $('#EXRATE').val(digitFormat(response.data['EXRATE'])); $('#EXRATEx').val(digitFormat(response.data['EXRATE'])); }
            document.getElementById('I_CURRENCY').value = response.data['I_CURRENCY'];
            document.getElementById('I_CURRENCYx').value = response.data['I_CURRENCY'];
            calcamt();
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function get_assetn() {
    const data = new FormData(form);
    data.append('action', 'get_assetn');
    data.append('ASSETACC', $('#ASSETACC').val());
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            $("#ASSETACC").val(response.data['ASSETACC']);
            $("#ASSETNA").val(response.data['ASSETNA']);
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function dc_type() {
    $('#loading').show();
    var res; let amt1 = ''; let amt2 = '';
    const data = new FormData(form);
    data.append('action', 'dc_type');
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            res = response.data;
            if(res.ACCAMT1 != '' && res.ACCAMT1 != undefined) { amt1 = numberWithCommas(parseFloat(res.ACCAMT1).toFixed(2)); }
            if(res.ACCAMT2 != '' && res.ACCAMT2 != undefined) { amt2 = numberWithCommas(parseFloat(res.ACCAMT2).toFixed(2)); }
            $('#ACCAMT1').val(amt1);
            $('#ACCAMT2').val(amt2);
        }
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function dc_type1() {
    $('#loading').show();
    var res; let amt1 = ''; let amt2 = '';
    const data = new FormData(form);
    data.append('action', 'dc_type1');
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            res = response.data;
            if(res.ACCAMT1 != '' && res.ACCAMT1 != undefined) { amt1 = numberWithCommas(parseFloat(res.ACCAMT1).toFixed(2)); }
            if(res.ACCAMT2 != '' && res.ACCAMT2 != undefined) { amt2 = numberWithCommas(parseFloat(res.ACCAMT2).toFixed(2)); }
            $('#ACCAMT1').val(amt1);
            $('#ACCAMT2').val(amt2);
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function action(action) {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(jQuery.type(response.data) === 'object');
        if(response.status == '200') {
            $("#loading").hide();
            if(jQuery.type(response.data) === 'object') {
                return inp_AccTran(response.data['BOOKORDERNO']);
            } else {
                return actionDialog(response.data);
            }
        }
    })
    .catch(e => {
        $("#loading").hide();
        // console.log(e);
    });
}

async function inp_AccTran(BOOKORDERNO) {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', 'inp_AccTran');
    data.append('BOOKORDERNO', BOOKORDERNO);
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(jQuery.type(response.data) === 'object');
        if(response.status == '200') {
            $("#loading").hide();
            if(jQuery.type(response.data) === 'object') {
                if(response.data['VOUCHERNO'] != '') {
                    window.location.href = '../ACCBOK_ENTRY10/';
                    // window.location.href='index.php?BOOKORDERNO=' + BOOKORDERNO;
                }
            } else {
                return actionDialog(response.data);
            }
        }
    })
    .catch(e => {
        $("#loading").hide();
        // console.log(e);
    });
}



function selectRow() {
    $(document).on("click", ".asset_tb tr", function(event){
        let item = $(this).closest('tr').children('td');
        id = item.eq(0).text();
        // console.log($(this).closest('tr'));
        let rows = document.getElementsByTagName("tr");
        $(".row-id").each(function (i) {
            rows[i+1].classList.remove("selected-row");
        }); 
        
        if(id != '') {
            rows[id].classList.add("selected-row");
            $('#ROWNO').val(item.eq(0).text());
            $('#ACC_CD').val(item.eq(1).text());
            $('#ACC_NM').val(item.eq(2).text());
            $('#ACCTRANREMARK').val(item.eq(3).text());
            $('#ACCAMT1').val(item.eq(4).text());
            $('#ACCAMT2').val(item.eq(5).text());
            $('#SECTION1').val(item.eq(6).text());
            $('#PROJECTNO').val(item.eq(8).text());
            $('#EXRATEx').val(item.eq(10).text());
            $('#VOUCHERNO').val(item.eq(13).text());
            if(item.eq(4).text() != '') {  $('#AMT').val(item.eq(4).text());
            } else { $('#AMT').val(item.eq(5).text()); }
            document.getElementById('DC_TYPE').value = item.eq(9).text(); 
            document.getElementById('CURRENCY1x').value = item.eq(11).text(); 
            document.getElementById('I_CURRENCYx').value = item.eq(12).text(); 
            document.getElementById("OK").disabled = true;
            document.getElementById("UPDATE").disabled = false;
            document.getElementById("DELETE").disabled = false;    
        }
    });
}

async function update() {
    let rowno = $('#ROWNO').val();
    $('#VOUCHERNO'+rowno+'').val($('#VOUCHERNO').val());
    $('#VOUCHERNO_TD'+rowno+'').val($('#VOUCHERNO').val());
    $('#ACC_CD'+rowno+'').val($('#ACC_CD').val());
    $('#ACC_CD_TD'+rowno+'').html($('#ACC_CD').val());
    $('#ACC_NM'+rowno+'').val($('#ACC_NM').val());
    $('#ACC_NM_TD'+rowno+'').html($('#ACC_NM').val());
    $('#ACCTRANREMARK'+rowno+'').val($('#ACCTRANREMARK').val())
    $('#ACCTRANREMARK_TD'+rowno+'').html($('#ACCTRANREMARK').val());
    $('#SECTION1'+rowno+'').val($('#SECTION1').val());
    $('#SECTION1_TD'+rowno+'').html($('#SECTION1').val());
    $('#ACCAMT1'+rowno+'').val($('#ACCAMT1').val());
    $('#ACCAMT1_TD'+rowno+'').html($('#ACCAMT1').val());
    $('#ACCAMT2'+rowno+'').val($('#ACCAMT2').val());
    $('#ACCAMT2_TD'+rowno+'').html($('#ACCAMT2').val());
    $('#PROJECTNO'+rowno+'').val($('#PROJECTNO').val());
    $('#PROJECTNO_TD'+rowno+'').html($('#PROJECTNO').val());
    $('#DC_TYPE'+rowno+'').val($('#DC_TYPE').val());
    $('#DC_TYPE_TD'+rowno+'').html($('#DC_TYPE').val());
    $('#AMT'+rowno+'').val($('#AMT').val().replace(/,/g, ''));
    $('#CURRENCY1'+rowno+'').val($('#CURRENCY1x').val());
    $('#CURRENCY1_TD'+rowno+'').html($('#CURRENCY1x').val());
    $('#I_CURRENCY'+rowno+'').val($('#I_CURRENCYx').val());
    $('#I_CURRENCY_TD'+rowno+'').html($('#I_CURRENCYx').val());
    $('#EXRATE'+rowno+'').val($('#EXRATEx').val());
    $('#EXRATE_TD'+rowno+'').html($('#EXRATEx').val());

    document.getElementById("OK").disabled = false;
    document.getElementById("UPDATE").disabled = true;
    document.getElementById("DELETE").disabled = true; 
    calculateTotal();
    entry();
    await keepItemData();
}

function entry() {
    $('#ROWNO').val('');
    $('#VOUCHERNO').val('');
    $('#ACC_CD').val('');
    $('#ACC_NM').val('');
    $('#ACCAMT1').val('');
    $('#ACCAMT2').val('');
    $('#PROJECTNO').val('');
    $('#AMT').val('');
    $('#EXRATEx').val('1.000000');
    $('#SECTION1').val('');
    $('#ACCTRANREMARK').val('');
    document.getElementById('CURRENCY1x').value = 'THB'; 
    document.getElementById('I_CURRENCYx').value = 'THB'; 
    document.getElementById('DC_TYPE').value = 0; 
    document.getElementById("OK").disabled = false;
    document.getElementById("UPDATE").disabled = true;
    document.getElementById("DELETE").disabled = true;
    entryUnset();
}

function calcRatio() { // 1/0::LIFEY:*100
    let rate = 0;
    let lifey = document.getElementById('LIFEY');
    rate = (1 / lifey.value) * 100 || 0.00;
    $('#DRATE').val(rate.toFixed(2));
}

function calcsalv() { // 0::QTY:*1 
    let salv = 0;
    let qty = document.getElementById('QTY');
    salv = qty.value * 1 || 0.00;
    $('#SOLVAGEVL').val(salv.toFixed(2));
}

function calcamt() { // 0::UPRICE:*0::EXRATE: // 0::QTY:*0::ASUNITPRC: 
    let asunit = 0; let asamt = 0;
    let qty = document.getElementById('QTY');
    let unitprc = document.getElementById('ASUNITPRC');
    let uprice = document.getElementById('UPRICE');
    let exrate = document.getElementById('EXRATE');
    asunit = parseFloat(uprice.value.replace(/,/g, '')) * parseFloat(exrate.value.replace(/,/g, '')) || 0.00;
    asamt = parseFloat(qty.value.replace(/,/g, '')) * asunit || 0.00;
    $('#ASUNITPRC').val(numberWithCommas(asunit.toFixed(2)));
    $('#AS_AMT').val(numberWithCommas(asamt.toFixed(2)));
}

function calculateTotal() {
    let accamt1 = 0; let accamt2 = 0;
    let accamt1a = document.getElementsByName("ACCAMT1A[]");
    let accamt2a = document.getElementsByName("ACCAMT2A[]");
    // console.log(amta.length);
    for (let i = 0; i < accamt1a.length; i++) {
        accamt1 += parseFloat(accamt1a[i].value.replace(/,/g, '')) || 0;
        accamt2 += parseFloat(accamt2a[i].value.replace(/,/g, '')) || 0;
    }
    // console.log(attlamt1);
    $('#TTL_AMT1').val(numberWithCommas(accamt1.toFixed(2)));
    $('#TTL_AMT2').val(numberWithCommas(accamt2.toFixed(2)));
}

async function printed(type) {
    await keepData();
    if(type == 'ASVC') {
        var popupWindow = window.open('../ACCBOK_ENTRY10/fixed_asset_voucher.php', '_blank', 'width=800, height=800');
    }
    setTimeout(function() { popupWindow.close(); }, 10000);  
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACCBOK_ENTRY10');

    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetItemData(lineIndex) {
    $("#loading").show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        $("#loading").hide();
        return calculateTotal();
        // console.log(response.data);
    })
    .catch(e => {
        console.log(e);
    });
}

async function entryUnset() {
    const data = new FormData(form);
    data.append('action', 'entryUnset');
    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $("#loading").hide();
        // window.location.reload();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function programDelete() {
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../ACCBOK_ENTRY10/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch(e => {
        console.log(e);
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
                programDelete();
                // unsetSession(form); 
                // window.location.href="/DMCS_WEBAPP";  
            } else if(type == 2) {
                return action('commit');
            } else if(type == 3) {
                return printed('ASVC');
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
    window.location.href = '../ACCBOK_ENTRY10/';
    $('#dvwdetail').empty();
    emptyTable();

    return false;
}

                        

function emptyTable() {
    for (var i = 1; i <= 5; i++) {
        $('#dvwdetail').append( '<tr class="tr_border" id="rowId'+i+'">'+
                                '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-2/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-2/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                                '<td class="h-6 w-3/12 border border-slate-700"></td>'+
                                '</tr>');
    }
}

function emptyRow(n) {
    $("table tbody").append('<tr class="tr_border" id="rowId'+n+'>' +
                            '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-2/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-2/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-1/12 border border-slate-700"></td>'+
                            '<td class="h-6 w-3/12 border border-slate-700"></td>'+
                            '<td class="td-class"></td></tr>');
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

function changeRowId() {
    var elem = document.getElementsByTagName("tr");
    for (var i = 0; i < elem.length; i++) {
      // console.log(i);
      if (elem[i].id) {
        index_x = Number(elem[i].rowIndex);
        elem[i].id = "rowId" + index_x;
      }
    }
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