// form
const form = document.getElementById('accPurTaxInfo');

// action button
const SEARCH = $('#SEARCH');
const PRINT = $('#PRINT');
const CSV = $('#CSV');

SEARCH.click(async function() {
    // check validate form
    if(!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
    await keepData();
});

PRINT.click(function() {
    // check validate form
    actionDialog(2);
    // return update();
});

CSV.click(function() {
    // check validate form
    actionDialog(3);
    // return update();
});

async function printed() {
    await keepData();
    var popupWindow = window.open('../ACC_PURTAXINFO/print.php', '_blank', 'width=auto, height=auto');
    setTimeout(function() { popupWindow.close(); }, 10000);
}


async function exportCSV() {
  // Variable to store the final csv data
    let accname;
    let year = document.getElementById('YEAR');
    let yearname = year.options[year.selectedIndex].text;
    let month = document.getElementById('MONTH');
    let monthname = month.options[month.selectedIndex].text;
    if($('#ACCNAME2USE').is(':checked')) { accname = 'T'; } else { accname = 'F'; }
    var csv_data = ['Period,' + yearname + ',' + monthname];
    // Get each row data
    // var rows = document.getElementsByTagName('tr');
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td:not(.hidden), th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 0; x < cols.length; x++) {
            csvrow.push("\""+cols[x].innerText+"\"");
        }
        csv_data.push(csvrow.join(','));
    }
    csv_data.push('Invoice No.,' + $('#SUPNO').val()+',Date,' + $('#SALEINVDT').val());
    csv_data.push('Supplier Code,' + $('#CUSTOMERCD').val()+',' + $('#CUSTOMERNAME').val());
    csv_data.push('Tax ID,' + "\""+$('#TAXID').val()+"\"" +',' + "\""+$('#BRANCH').val()+"\"");
    csv_data.push(',,,,,,Tax-excluded amount,' + "\""+$('#TTLTAXABLE').val()+"\"");
    csv_data.push(',,,,,Purchase Tax Refundable,Taxable amount,' + "\""+$('#TTLAMOUNT').val()+"\"");
    csv_data.push('Pur. Voucher No.,' + $('#PVNO').val()+ ',Document Date,' + $('#PVDT').val()+ ',,,Tax exempt amount,' + "\""+$('#TTLAMOUNT2').val()+"\"");
    csv_data.push('Remarks,' + $('#REMARKS').val()+ ',Amount,' + "\""+$('#AMOUNT').val()+"\"" + ',Tax Amount,' +  "\""+$('#VATAMOUNT').val()+"\"" + ',VAT,' + "\""+$('#TTLVATAMT').val()+"\"");
    csv_data.push('Staff Code,' + $('#STAFFCD').val()+ ',' + $('#STAFFNAME').val()+ ',,,,Tax-included amount,' + "\""+$('#TTLTOTALAMT').val()+"\"");
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

function selectRow() {
    $('table#table tr').click(function () {
        $('table#table tr').not(this).removeClass('selected');
        let table = document.getElementById('table');
        let item = $(this).closest('tr').children('td');
        id = item.eq(0).text();
        if(id != '') {
            table.rows[id].classList.toggle('selected');
            $('#SUPNO').val(item.eq(2).text());
            $('#SALEINVDT').val(item.eq(13).text().replaceAll('/','-'));
            $('#CUSTOMERCD').val(item.eq(14).text());
            $('#CUSTOMERNAME').val(item.eq(4).text());
            $('#TAXID').val(item.eq(5).text());
            $('#BRANCH').val(item.eq(6).text());
            $('#SALEDIVCD').val(item.eq(15).text());
            $('#SALEDIVNAME').val(item.eq(16).text());
            $('#PVNO').val(item.eq(3).text());
            $('#PVDT').val(item.eq(17).text().replaceAll('/','-'));
            $('#REMARKS').val(item.eq(12).text());
            $('#AMOUNT').val(item.eq(8).text());
            $('#VATAMOUNT').val(item.eq(10).text());
            $('#STAFFCD').val(item.eq(18).text());
            $('#STAFFNAME').val(item.eq(19).text());
        }
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_PURTAXINFO/function/index_x.php', data)
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
    data.append('systemName', 'ACC_PURTAXINFO');

    await axios.post('../ACC_PURTAXINFO/function/index_x.php', data)
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
                return printed();
            } else if(type == 3) {
                return exportCSV();
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
    $('#dvwdetail').empty();
    emptyTable();
    $('#record').html(0);
    // window.location.href = '../ACC_PURTAXINFO/';

    return false;
}
  
function emptyTable() {
    let maxrow; $('#dvwdetail').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 23; } else { maxrow = 12; }
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
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
}

function emptyRow(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 13; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}