// icon search
const SEARCHACCOUNT = $('#SEARCHACCOUNT');

SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACC_RPTFORMSETTING', 'authWindow', 'width=1200,height=600');});

//input serach
const ACC_CD = $('#ACC_CD');

// action button
const SEARCH = $('#SEARCH');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const INS = $('#INS');
const UPD = $('#UPD');
const DEL = $('#DEL');

// form
const form = document.getElementById('AccRPTFormSetting');

ACC_CD.on('keyup change', function(e) {
    if(e.type === 'change') {
        keepData();
        getACCCD(ACC_CD.val());
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        getACCCD(ACC_CD.val());
    }
});

SEARCHACCOUNT.click(async function () {
    keepItemData();
    return keepData();
});

INSERT.click(async function() {
    // check validate form
    return insRptFormDtl();
});

UPDATE.click(async function() {
    return updRptFormDtl();
});

DELETE.click(async function() {
    return delRptFormDtl();   
});

INS.click(async function() {
    if($('#FORMROWNUM').val() == '' || $('#FORMTEXT1').val() == '') {
        actionDialog(1);
        return false;
    }
    return insRptForm();   
});

UPD.click(async function() {
    return updRptForm();  
});

DEL.click(async function() {
    return delRptForm();      
});

async function onSearch() {
    let RPTFORMTYP = document.getElementById('RPTFORMTYP');
    if(RPTFORMTYP.selectedIndex == 0) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
    await keepData();
    // return actionDialog(2);
}

async function getRptFormDtl(FORMROWNUM) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'getRptFormDtl');
    data.append('FORMROWNUM', FORMROWNUM);
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwdetail2').html('');
        let countRow = 0;
        let cacltyp;
        $.each(response.data,function(key, value) {
            if(value.CALC_TYP == 1) { cacltyp = '+'; } else { cacltyp = '-'; }
                $('#table_acc').append($('<tr class="divide-y divide-gray-200" id="rowIdB'+key+'">')
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(cacltyp))
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(value.ACC_CD))
                                .append($('<td class="h-6 border border-slate-700 pl-1 text-left">').append(value.ACC_NM))
                                .append($('<td class="hidden">').append(value.ACCSEQ))
                                .append($('<td class="hidden">').append(value.ACC_NM2))
                );
            countRow++;
        });
        // console.log(countRow);
        if(countRow < 10) {
           for (var i = countRow; i < 10; i++) {
                $('#table_acc').append($('<tr class="divide-y divide-gray-200" id="rowIdB'+i+'">')
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(''))
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(''))
                                .append($('<td class="h-6 border border-slate-700 text-left">').append(''))
                );
           }
        }
        document.querySelector('#record2').innerText = countRow;
        $('#loading').hide();
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
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#ACC_CD').val(response.data['ACC_CD']);
        $('#ACC_NM').val(response.data['ACC_NM']);
        $("#loading").hide(); unRequired();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function insRptFormDtl() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'insRptFormDtl');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        entryAcc();
        getRptFormDtl($("#FORMROWNUM").val());
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function updRptFormDtl() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'updRptFormDtl');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        entryAcc();
        getRptFormDtl($("#FORMROWNUM").val());
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function delRptFormDtl() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'delRptFormDtl');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        entryAcc();
        getRptFormDtl($("#FORMROWNUM").val());
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function insRptForm() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'insRptForm');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        window.location.reload();
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function updRptForm() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'updRptForm');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        window.location.reload();
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function delRptForm() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'delRptForm');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        window.location.reload();
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

function entry() {
    $("#FORMROWNUM").val('');
    $("#FORMLEVEL").val('');   
    $('#FORMLINEFLG').prop('checked', false);
    $('#FORMZEROFLG').prop('checked', false);
    $("#FORMTEXT1").val('');
    $("#FORMTEXT2").val('');   
    document.getElementById('FORMTEXTAL').value = '';
    document.getElementById('INS').disabled = false;
    document.getElementById('UPD').disabled = true;
    document.getElementById('DEL').disabled = true;
}

function entryAcc() {
    $("#ACC_CD").val('');
    $("#ACC_NM").val('');
    $('#ACCSEQ').val('');
    document.getElementById('CALC_TYP').value = 1;
    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
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
    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_RPTFORMSETTING');

    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../ACC_RPTFORMSETTING/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href = $('#sessionUrl').val() + '/home.php';
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
                unsetSession(form); 
                programDelete();
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
    emptyTable();
    document.querySelector('#record').innerText = '0';
    document.querySelector('#record2').innerText = '0';
    // refresh
    // window.location.href = '../ACC_RPTFORMSETTING/';
    return false;
}

function emptyTable() {
    $('#dvwdetail').empty();
    for (var i = 1; i <= 10; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
    
    $('#dvwdetail2').empty();
    for (var x = 1; x <= 10; x++) {
        $('#dvwdetail2').append('<tr class="divide-y divide-gray-200" id="rowIdB'+x+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
}

function changeRowId() {
    var elem = document.getElementsByTagName("tr");
    for (var i = 0; i < elem.length; i++) {
      // console.log(i);
      if (elem[i].id) {
        index_x = Number(elem[i].rowIndex);
        elem[i].id = "rowIdB" + index_x;
      }
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