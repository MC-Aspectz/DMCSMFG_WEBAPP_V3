// form
const form = document.getElementById('accAssetMaster');

// button
const CALCULATE = $("#CALCULATE");
const COMMIT = $("#COMMIT");
const CLOSEPAGE = $("#CLOSEPAGE");

// guide
const ASSETGUIDE02 = $("#ASSETGUIDE02");
const ASSETACCGUIDE = $("#ASSETACCGUIDE");

ASSETGUIDE02.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETGUIDE02/index.php?page=ACCASSETMASTER', 'authWindow', 'width=1200,height=600');});
ASSETACCGUIDE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETACCGUIDE/index.php?page=ACCASSETMASTER', 'authWindow', 'width=1200,height=600');});

const search_icon = [ASSETGUIDE02, ASSETACCGUIDE];

for(const icon of search_icon) {
    icon.click(async function () {
       await keepData(); await keepItemData(); 
    });
};

// onchange
const ASSETACC = $("#ASSETACC");
const ASSETCD = $("#ASSETCD");
const LIFEY = $("#LIFEY");
//req ASSETCD

// onchange
const input_search = [ASSETCD, ASSETACC, LIFEY];

for (const input of input_search) {
    input.on('keyup change', function (e) {
      if (e.type === 'change') {
            $('#loading').show();
        } else if (e.key === 'Enter' || e.keyCode === 13) {
            $('#loading').show();
        }
    });
}



CLOSEPAGE.click(function () {
  return programDelete();
});





COMMIT.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        actionDialog(3);
        return false;
    }
    return actionDialog(2);
});

CALCULATE.click(function() {
    return getThai();
});

ASSETCD.on('keyup change', async function(e) {
    if(ASSETCD.val() == '') unsetSession(form);
    if(e.type === 'change') {
        keepData();
        // await cheak_if();
        window.location.href="index.php?ASSETCD=" + ASSETCD.val();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        // await cheak_if();
        window.location.href="index.php?ASSETCD=" + ASSETCD.val();
    }
});

ASSETACC.on('keyup change', async function(e) {
    if(e.type === 'change') {
        keepData();
        // keepItemData();
        await get_assetacc();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        // keepItemData();
        await get_assetacc();
    }
});

LIFEY.on('keyup change', async function(e) {
    if(e.type === 'change') {
        keepData();
        // keepItemData();
        await calc_Drate();
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        // keepItemData();
        await calc_Drate();
    }
});

async function disp_photo() {
    $('#loading').show();
    var PICTURECD = document.getElementById('SELECTFILE');
    const data = new FormData();
    data.append('action', 'disp_photo');
    data.append('PICTURECD', PICTURECD.files[0].name);
    // data.append('PICTURECD', PICTURECD.value);
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            if(response.data['ITEMIMGLOCVIEW'] != '')
            document.getElementById('PICTURECD').value = $('#PATHFILE').val() + response.data['ITEMIMGLOCVIEW'];
            document.getElementById('ITEMIMGLOCVIEW').src = '../../../../img/csv-file.png';
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

// async function cheak_if() {  
//     const data = new FormData(form);
//     data.append('action', 'cheak_if');
//     await axios.post('../ACCASSETMASTER/function/index_x.php', data)
//     .then(response => {
//         console.log(response.data);
//         if(response.status == '200') {
//             $("#loading").hide();
//             if(jQuery.type(response.data) === 'object') {
//                 var value = response.data;
   
//                 $("#ASSETCD").val(ASSETCD.val());
//                 $("#ACCCD1").val(value.ACCCD1);
//                 $("#ACCCD2").val(value.ACCCD2);
//                 $("#ACCCD3").val(value.ACCCD3);
//                 $("#ACCNM1").val(value.ACCNM1);
//                 $("#ACCNM2").val(value.ACCNM2);
//                 $("#ACCNM3").val(value.ACCNM3);
//                 $("#ASSETACC").val(value.ASSETACC);
//                 $("#ASSETACCNM").val(value.ASSETACCNM);
//                 $("#ASSETNM").val(value.ASSETNM);
//                 $("#ASSETNM_E").val(value.ASSETNM_E);
//                 $("#DRATE").val(value.DRATE);
//                 $("#EXRATE").val(value.EXRATE);
//                 $("#INVOICE_NO").val(value.INVOICE_NO);
//                 $("#I_CURRENCY").val(value.I_CURRENCY);
//                 $("#LIFEY").val(value.LIFEY);
//                 $("#LOSTVL").val(value.LOSTVL);
//                 $("#PURCHAMT").val(value.PURCHAMT);
//                 $("#PURCHPRC").val(value.PURCHPRC);
//                 $("#PURCH_DT").val(formatDate(value.PURCH_DT));
//                 $("#SERIAL_NO").val(value.SERIAL_NO);
//                 $("#SOLDVL").val(value.SOLDVL);
//                 $("#SOLVAGEVL").val(value.SOLVAGEVL);
//                 $("#STDATE").val(formatDate(value.STDATE));
//                 $("#SUPPLIERNM").val(value.SUPPLIERNM);
//                 $("#EDDATE").val(value.EDDATE);
//                 $("#BOOKVALUE").val(numberWithCommas(value.BOOKVALUE));
//                 // $("#PICTURECD").val(value.PICTURECD);
//                 document.getElementById('PICTURECD').html = value.PICTURECD;
//                 document.getElementById('ASSETTYP').value = value.ASSETTYP;
//                 document.getElementById('DEPRTYP').value = value.DEPRTYP;
//                 if(value.DEPREC_A == 'T') { $('#DEPREC_A').prop("checked", true); } else { $('#DEPREC_A').prop("checked", false); }
//                 if(value.ITEMIMGLOCVIEW != '') { document.getElementById('ITEMIMGLOCVIEW').src = '../../../../img/csv-file.png'; }
//             }
//         }
//     })
//     .catch(e => {
//         // console.log(e);
//         $("#loading").hide();
//     });
// }

async function get_assetacc() {
    assetUnset();
    const data = new FormData(form);
    data.append('action', 'get_assetacc');
    data.append('ASSETACC', $('#ASSETACC').val());
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            var res = response.data;
            $('#ACCCD1').val(res.ACCCD1);
            $('#ACCCD2').val(res.ACCCD2);
            $('#ACCCD3').val(res.ACCCD3);
            $('#ACCNM1').val(res.ACCNM1);
            $('#ACCNM2').val(res.ACCNM2);
            $('#ACCNM3').val(res.ACCNM3);
            $('#ASSETACC').val(res.ASSETACC);
            $('#ASSETACCNM').val(res.ASSETACCNM);
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
    data.append('COMCURRENCY', $('#COMCURRENCY').val());  
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $('#loading').hide();
            if(response.data['EXRATE'] != '') { $('#EXRATE').val(digitFormat(response.data['EXRATE'])); }
            calcamt();
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function calc_Drate() {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', 'calc_Drate');
    data.append('ASSETTYP', $('#ASSETTYP').val());
    data.append('LIFEY', $('#LIFEY').val());  
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            $("#DRATE").val(response.data['DRATE']);
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function docal() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'docal');
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            if(response.data['SYSEN_CALCLIST'] == 'F') {
                document.getElementById('CALCULATE').disabled = true;
            } else {
                document.getElementById('CALCULATE').disabled = false;
            }
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function getThai() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'getThai');
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            $('#dvwdetail').html('');
            let countRow = 0;
            $.each(response.data,function(key, value) {
                $('#dvwdetail').append( '<tr class="flex w-full p-0 divide-x csv" id="rowId'+key+'">'+
                                            '<td class="h-10 w-2/12 text-sm text-left border border-slate-700 row-id">'+key+'</td>'+
                                            '<td class="h-10 w-2/12 text-sm text-left border border-slate-700"><input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-left" type="text" id="YYMM<?=$key?>" name="YYMM[]" value='+formatMMyyyy(value.YYMM)+'></td>' +
                                            '<td class="h-10 w-2/12 text-sm text-right border border-slate-700"><input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-right" type="text" id="D_VALUE<?=$key?>" name="D_VALUE[]" value="'+parseFloat(value.D_VALUE).toFixed(2)+'" oninput="this.value = stringReplace(this.value);" ></td>' +
                                            '<td class="h-10 w-2/12 text-sm text-center border border-slate-700">' +
                                                '<input type="hidden" id="DEPARFLGH' + key + '" name="DEPARFLG[]" value="F"/>' +
                                                '<input type="checkbox" id="DEPARFLG' + key + '" name="DEPARFLG[]" value="T" onchange="chked(' + key + ');" ' + (value["APPDELETE"] == "T" ? "checked" : "") + "/>" +
                                            '</td>' +
                                            '<td class="h-10 w-4/12 text-sm text-left border border-slate-700"></td>'+
                                            '<td class="hidden"><input type="hidden" id="ROWNO<?=$key?>" name="ROWNO[]" value='+key+'></td>' +
                                        '</tr>');
                countRow++;
            });
            // console.log(countRow);
            if(countRow < 8) {
               for (var i = countRow; i < 8; i++) {
                    $('#dvwdetail').append( '<tr class="tr_border" id="rowId'+i+'">'+
                                                '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                                '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                                '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                                '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                                '<td class="h-10 w-4/12 border border-slate-700"></td>'+
                                            '</tr>');
               }
            }
            document.querySelector("#record").innerText = countRow;
            // $('#DOCAL').prop('checked', true);
            // document.getElementById('DOCALH').disabled = true;
        }
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function action(action) {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // console.log(jQuery.type(response.data) === 'object');
        if(response.status == '200') {
            $("#loading").hide();
            if(jQuery.type(response.data) === 'object') {
                return window.location.href = '../ACCASSETMASTER/';
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
        }
    });
}

function calcamt() { // 0::PURCHPRC: * 0::EXRATE:
    let pruchamt = 0;
    let purchprc = document.getElementById('PURCHPRC');
    let exrate = document.getElementById('EXRATE');
    pruchamt = parseFloat(purchprc.value.replace(/,/g, '')) * parseFloat(exrate.value.replace(/,/g, '')) || 0.00;
    $('#PURCHAMT').val(numberWithCommas(pruchamt.toFixed(2)));
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        keepItemData(); 
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACCASSETMASTER');
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
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
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function assetUnset() {
    const data = new FormData(form);
    data.append('action', 'assetUnset');
    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#ACCCD1').val('');
        $('#ACCCD2').val('');
        $('#ACCCD3').val('');
        $('#ACCNM1').val('');
        $('#ACCNM2').val('');
        $('#ACCNM3').val('');
        $('#ASSETACC').val('');
        $('#ASSETACCNM').val('');
    })
    .catch(e => {
        // console.log(e);
    });
}

async function programDelete() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../ACCASSETMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
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
            }
        }
    });
}

function alertWarning(msg, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: msg,
        background: '#8ca3a3',
        showCancelButton: false,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
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
    // window.location.href = '../ACCASSETMASTER/';
    $('#dvwdetail').empty();
    emptyTable();

    return false;
}


function emptyTable() {
    for (var i = 1; i <= 5; i++) {
        $('#dvwdetail').append( '<tr class="flex w-full p-0 divide-x" id="rowId'+i+'">'+
                                    '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                    '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                    '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                    '<td class="h-10 w-2/12 border border-slate-700"></td>'+
                                    '<td class="h-10 w-4/12 border border-slate-700"></td>'+
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
    if(date != '') {
        year = date.substring(0, 4);
        month = date.substring(4, 6);
        day = date.substring(6, 8);
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');       
    }
}

function formatMMyyyy(date) {
    if(date != '') {
        year = date.substring(0, 4);
        day = date.substring(5, 7);
        if (day.length < 2) day = '0' + day;
        return [day, year].join('/');      
    }
}


function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}