// icon
const SEARCHITEM = $('#SEARCHITEM');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=INVFUTURE', 'authWindow', 'width=1200,height=600');});

// input
const ITEMCD = $('#ITEMCD');

// action button
const SEARCH = $('#SEARCH');
const DETAIL = $('#DETAIL');
const CSV = $('#CSV');

// form
const form = document.getElementById('invfuture');

SEARCHITEM.click(function () {
    keepData();
});

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    await keepData();
    return submitSearch();
});

CSV.click(function() {
    return exportCSV();
});

DETAIL.on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});

ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getElement('ITEMCD', ITEMCD.val());
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../INVFUTURE/function/index_x.php', data)
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
            return submitSearch();
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function submitSearch() {
    $('#loading').show();
    const form = document.getElementById('invfuture');
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
}

async function exportCSV() {
    // Variable to store the final csv data
    let ITEMCODE_LB = (document.getElementById('ITEMCODE_LB').innerText || document.getElementById('ITEMCODE_LB').textContent);
    let ONHAND_LB = (document.getElementById('ONHAND_LB').innerText || document.getElementById('ONHAND_LB').textContent);
    var csv_data = [ITEMCODE_LB + ',' + $('#ITEMCD').val() + ',' + $('#ITEMNAME').val()];
        csv_data.push('' + ',' + $('#ITEMSPEC').val() +  ',' + $('#ITEMDRAWNUMBER').val() + ',' + ONHAND_LB + ',' + $('#ONHANDQTY').val() + ',' + $('#UNIT').val());
    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 1; x < cols.length; x++) {
            csvrow.push("\""+cols[x].innerText+"\"");
        }
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../INVFUTURE/function/index_x.php', data)
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
    data.append('systemName', 'INVFUTURE');
    await axios.post('../INVFUTURE/function/index_x.php', data)
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
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
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

    // refresh
    emptyTable();
    // window.location.href = '../INVFUTURE/';
    return false;
}

function emptyTable() {
    let maxrow; $('#dvwdetail').empty();
    const details = document.querySelector('details');
    if (!details.open) { maxrow = 26; } else { maxrow = 23; }
    for (var i = 1; i <= maxrow; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200 row-empty" id="rowId'+i+'">'+
                                    '<td class="hidden row-seq">'+i+'</td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
    document.querySelector('#rowCount').innerText = '0';
}


function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        var colhide = document.createElement('td');
        colhide.setAttribute('class', 'hidden row-seq');
        row.appendChild(colhide);
        for (var z = 1; z <= 7; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}