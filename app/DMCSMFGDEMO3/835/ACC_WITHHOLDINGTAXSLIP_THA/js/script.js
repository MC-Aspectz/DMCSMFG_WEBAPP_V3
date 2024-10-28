// form
const form = document.getElementById('accWithholdingTaxSlipTHA');

// action button
const UPDATE = $('#UPDATE');
const SEARCH = $('#SEARCH');
const EXPORT = $('#EXPORT');
const WHT = $('#WHT');
const PND53 = $('#PND53');

SEARCH.click(async function() {
    // check validate form
    if(!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
    await keepData();
});

UPDATE.click(function() {
    $('#loading').show();
    return update();
});

EXPORT.click(function() {
    if(checkChecked()) {
        actionDialog('notprint');
        return false;
    }
    return actionDialog(2);
});

WHT.click(function() {
    if(checkChecked()) {
        actionDialog('notprint');
        return false;
    }
    return actionDialog(3);
});

PND53.click(function() {
    if(checkChecked()) {
        actionDialog('notprint');
        return false;
    }
    return actionDialog(4);
});

async function update() {
    const data = new FormData(form);
    data.append('action', 'update');

    await axios.post('../ACC_WITHHOLDINGTAXSLIP_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            window.location.reload();
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function csv_export() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'export');
    await axios.post('../ACC_WITHHOLDINGTAXSLIP_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        exportCSV(response.data);
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function exportCSV(res) {
    // console.log(res);
    var csv_data = [];
    $.each(res, function(key, value) {
        // console.log(value.C01);
        csv_data.push(value.C01);
    });
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function printed(type) {
    await keepData();
    if(type == 'Export') {
        return csv_export();
    } else if(type == 'WHT') {
        var popupWindow = window.open('../ACC_WITHHOLDINGTAXSLIP_THA/print_wht.php', '_blank', "width=800, height=800");
    } else if(type == 'PND53') {
        var popupWindow = window.open('../ACC_WITHHOLDINGTAXSLIP_THA/print_pnd53.php', '_blank', "width=800, height=800");
    }
    setTimeout(function() { popupWindow.close(); }, 10000);
}

function selectRow() {
    $('table#table tr').click(function () {
        $('table#table tr').not(this).removeClass('selected');
        let table = document.getElementById('table');
        let item = $(this).closest('tr').children('td');
        id = item.eq(0).text();
        if(id != '') {
            table.rows[id].classList.toggle('selected');
            $('#ROWNO').val(item.eq(0).text());
            $('#PAYMENTSUPCD').val(item.eq(19).text());
            $('#PAYMENTSUPNAME').val(item.eq(4).text());
            $('#SUPTAXID').val(item.eq(20).text());
            $('#PAYMENTDIVCD').val(item.eq(21).text());
            $('#PAYMENTDIVNAME').val(item.eq(22).text());
            $('#PAYMENTADD07').val(item.eq(26).text());
            $('#PAYMENTADD08').val(dashFormatDate(item.eq(27).text()));
            $('#PAYMENTNO').val(item.eq(15).text());
            $('#PAYMENTDT').val(dashFormatDate(item.eq(2).text()));
            $('#PAYMENTADD03').val(item.eq(5).text());
            $('#PMNOTE05').val(parseFloat(item.eq(24).text()).toFixed(2));
            $('#PAYMENTAMT').val(item.eq(6).text());
            $('#PAYMENTADD09').val(item.eq(31).text());
            $('#PAYMENTADD10').val(item.eq(32).text());
            $('#TRANYEAR').val(item.eq(11).text());
            $('#PURRECPAYORDERNO').val(item.eq(12).text());
            $('#PURRECPAYORDERLN').val(item.eq(13).text());
            $('#PURRECPAYORDERLN2').val(item.eq(14).text());
            $('#PAYMENTLN').val(item.eq(16).text());
            $('#PAYMENTLN2').val(item.eq(17).text());
            $('#PAYMENTCURCD').val(item.eq(23).text());

            document.getElementById('PAYMENTADD15').value = item.eq(30).text();
            document.getElementById('PAYMENTTYP2').value = item.eq(25).text();
            document.getElementById('PAYMENTADD12').value = item.eq(18).text();
            document.getElementById('PAYMENTADD13').value = item.eq(28).text();
            document.getElementById('PAYMENTADD14').value = item.eq(29).text();
            document.getElementById('PAYMENTADD16').value = item.eq(33).text();
            document.getElementById('PAYMENTADD11').value = item.eq(34).text();  

            document.getElementById('UPDATE').disabled = false;
            if(item.eq(36).text() != 'T') { document.getElementById('PND53').disabled = true; } else { document.getElementById('PND53').disabled = false; }
        }
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_WITHHOLDINGTAXSLIP_THA/function/index_x.php', data)
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
    data.append('systemName', 'ACC_WITHHOLDINGTAXSLIP_THA');

    await axios.post('../ACC_WITHHOLDINGTAXSLIP_THA/function/index_x.php', data)
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
                return printed('Export');
            } else if(type == 3) {
                return printed('WHT');
            } else if(type == 4) {
                return printed('PND53');
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
    // window.location.href = '../ACC_WITHHOLDINGTAXSLIP_THA/';
    unRequired();
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
                                '</tr>');
    }
}

function emptyRow(maxrow) {
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

function checkChecked() {
    var chkrow = $("input[name='CHKROW[]']:checkbox");
    if (chkrow.is(':checked'))  {
        return false;  
    } else {
        return true;
    }
}