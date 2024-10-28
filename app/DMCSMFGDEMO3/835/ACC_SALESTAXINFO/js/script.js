// form
const form = document.getElementById('accSaleTaxInfo');

// action button
const SEARCH = $('#SEARCH');
const PRINT = $('#PRINT');

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

async function printed() {
    await keepData();
    var popupWindow = window.open('../ACC_SALESTAXINFO/print.php', '_blank', 'width=auto, height=auto');
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
            $('#INVNO').val(item.eq(2).text());
            $('#SALEINVDT').val(dashFormatDate(item.eq(1).text()));
            $('#CUSTOMERCD').val(item.eq(14).text());
            $('#CUSTOMERNAME').val(item.eq(3).text());
            $('#TAXID').val(item.eq(4).text());
            $('#BRANCH').val(item.eq(5).text());
            $('#SALEDIVCD').val(item.eq(17).text());
            $('#SALEDIVNAME').val(item.eq(18).text());
            $('#SVNO').val(item.eq(20).text());
            $('#SVDT').val(dashFormatDate(item.eq(19).text()));
            $('#AMOUNT').val(item.eq(7).text());
            $('#VATAMOUNT').val(item.eq(9).text());
            $('#AMOUNT2').val(item.eq(8).text());
            $('#STAFFCD').val(item.eq(15).text());
            $('#STAFFNAME').val(item.eq(16).text());
        }
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_SALESTAXINFO/function/index_x.php', data)
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
    data.append('systemName', 'ACC_SALESTAXINFO');

    await axios.post('../ACC_SALESTAXINFO/function/index_x.php', data)
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
                return printed();
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
    // $('#table > tbody > tr').remove();

    // refresh
    emptyTable();
    $('#record').html(0);
    // window.location.href = '../ACC_SALESTAXINFO/';

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
        for (var z = 1; z <= 12; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}