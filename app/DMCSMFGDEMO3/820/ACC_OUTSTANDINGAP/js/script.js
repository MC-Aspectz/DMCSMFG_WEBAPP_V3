// icon search
const SEARCHSUPPLIER1 = $('#SEARCHSUPPLIER1');
const SEARCHSUPPLIER2 = $('#SEARCHSUPPLIER2');
const SEARCHSUPPLIERINVOICE_ACC1 = $('#SEARCHSUPPLIERINVOICE_ACC1');
const SEARCHSUPPLIERINVOICE_ACC2 = $('#SEARCHSUPPLIERINVOICE_ACC2');
const SEARCHPURRECTRAN_ACC1 = $('#SEARCHPURRECTRAN_ACC1');
const SEARCHPURRECTRAN_ACC2 = $('#SEARCHPURRECTRAN_ACC2');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHDIVISION1 = $('#SEARCHDIVISION1');
const SEARCHDIVISION2 = $('#SEARCHDIVISION2');
const SEARCHSTAFF1 = $('#SEARCHSTAFF1');
const SEARCHSTAFF2 = $('#SEARCHSTAFF2');

SEARCHSUPPLIER1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_OUTSTANDINGAP&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ACC_OUTSTANDINGAP&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIERINVOICE_ACC1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIERINVOICE_ACC/index.php?page=ACC_OUTSTANDINGAP&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIERINVOICE_ACC2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIERINVOICE_ACC/index.php?page=ACC_OUTSTANDINGAP&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHPURRECTRAN_ACC1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURRECTRAN_ACC/index.php?page=ACC_OUTSTANDINGAP&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHPURRECTRAN_ACC2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURRECTRAN_ACC/index.php?page=ACC_OUTSTANDINGAP&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_OUTSTANDINGAP', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_OUTSTANDINGAP&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_OUTSTANDINGAP&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_OUTSTANDINGAP&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_OUTSTANDINGAP&index=2', 'authWindow', 'width=1200,height=600');});


const serach_icon = [SEARCHSUPPLIER1, SEARCHSUPPLIER2, SEARCHSUPPLIERINVOICE_ACC1, SEARCHSUPPLIERINVOICE_ACC2, SEARCHPURRECTRAN_ACC1, SEARCHPURRECTRAN_ACC2, SEARCHCURRENCY, SEARCHDIVISION1, SEARCHDIVISION2, SEARCHSTAFF1, SEARCHSTAFF2];

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('accOutStandingAP');

for(const icon of serach_icon){
    icon.click(async function () {
       await keepData();
    });
};

SEARCH.click(async function() {
    // check validate form
    $('#loading').show();
    await keepData();
    // return actionDialog(2);
});

PRINT.click(function() {
    return actionDialog(2);
});

CSV.click(function() {
    return exportCSV();
});

async function getElementIndex(code, value, index) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('index', index);
    data.append('action', 'getElement');
    await axios.post('../ACC_OUTSTANDINGAP/function/index_x.php', data)
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
  await axios.post('../ACC_OUTSTANDINGAP/function/index_x.php', data)
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

async function exportCSV() {
  // Variable to store the final csv data
    let duefr = '--/--/----';
    let dueto = '--/--/----';
    let supinvfr = '--/--/----';
    let supinvto = '--/--/----';
    let voucfr = '--/--/----';
    let voucto = '--/--/----';
    let paystatus = document.getElementById("PAYMENTSTATUS");
    let paystatusname = paystatus.options[paystatus.selectedIndex].text;
    if($('#DUEDATEFR').val() != '') { duefr = $('#DUEDATEFR').val(); }
    if($('#DUEDATETO').val() != '') { dueto = $('#DUEDATETO').val(); }
    if($('#SUPPINVDTFR').val() != '') { supinvfr = $('#SUPPINVDTFR').val(); }
    if($('#SUPPINVDTTO').val() != '') { supinvto = $('#SUPPINVDTTO').val(); }
    if($('#VOUCHERDTFR').val() != '') { voucfr = $('#VOUCHERDTFR').val(); }
    if($('#VOUCHERDTTO').val() != '') { voucto = $('#VOUCHERDTTO').val(); }
    // let accy = document.getElementById("ACCY");
    // let accyname2 = accy.options[accy.selectedIndex].text;
    var csv_data = ['Status,' + paystatusname];
    csv_data.push('Due Date,' + duefr + ',-,' + dueto + ',Supplier invoice date,' + supinvfr + ',-,' + supinvto);
    csv_data.push('Voucher Date,' + voucfr + ',-,' + voucto + ',Supplier Code,' + $('#SUPPLIERFR').val() + ',-,' + $('#SUPPLIERTO').val());
    csv_data.push('Supplier Invoice No.,' + $('#SUPPINVNOFR').val() + ',-,' + $('#SUPPINVNOTO').val() + ',Voucher No.,' + $('#VOUCHERNOFR').val() + ',-,' + $('#VOUCHERNOTO').val());
    csv_data.push('Currency,' + $('#CURRENCY').val());
    csv_data.push('Department,' + $('#DEPARTMENTFR').val() + ',-,' + $('#DEPARTMENTTO').val() + ',Staff,' + $('#STAFFFR').val() + ',-,' + $('#STAFFTO').val());
    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            csvrow.push("\""+el.innerText+"\"");
        });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(","));
    }
    csv_data.push(',,,,,,,,,,' + "\""+$('#TTLINVAMT').val()+"\""  + ',' + "\""+$('#TTLOUTSTDAMT').val()+"\"");
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_OUTSTANDINGAP/function/index_x.php', data)
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
    data.append('systemName', 'ACC_OUTSTANDINGAP');

    await axios.post('../ACC_OUTSTANDINGAP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
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
                return printed('printAP');
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
    window.location.href = '../ACC_OUTSTANDINGAP/';

    return false;
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        $('#dvwdetail').append( '<tr class="flex w-full p-0 divide-x row-empty" id="rowId'+x+'">'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                    '<td class="h-6 w-40 py-2"></td>'+
                                '</tr>');
    }
}

// async function printed(type) {
//     await keepData();
//     if(type == 'AP') {
//         var popupWindow = window.open('../ACC_OUTSTANDINGAP/print.php', '_blank', "width=auto, height=auto");
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);
// }
