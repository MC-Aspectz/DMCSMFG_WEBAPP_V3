// icon search
const SEARCHITEM = $('#SEARCHITEM');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ITEMCOSTCSV', 'authWindow', 'width=1200,height=600');});

//input serach
const ITEMCODE = $('#ITEMCODE'); 

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');

// form
const form = document.getElementById('itemCostCSV');

const serach_icon = [SEARCHITEM];

for(const icon of serach_icon) {
    icon.click(async function () {
        await keepData();
    });
};

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    $('#loading').show();
    await keepData();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

CSV.click(function() {
    return exportCSV();
});

ITEMCODE.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('ITEMCODE', ITEMCODE.val(), 'getItem');
    }
});

async function getSearch(code, value, action) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', action);
    await axios.post('../ITEMCOSTCSV/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;

        $('#ITEMCODE').val(result['ITEMCODE']);
        $('#COMBINATION').val(result['COMBINATION']);
        $('#ITEMDRAWNUMBER').val(result['ITEMDRAWNUMBER']);
        $('#ITEMNAME').val(result['ITEMNAME']);
        $('#ITEMSPEC').val(result['ITEMSPEC']);
        $('#ITEMUNIT').val(result['ITEMUNIT']);

        $('#loading').hide(); unRequired();    
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function exportCSV() {
  // Variable to store the final csv data
    let itemcodetxt = document.getElementById('ITEMCODE_TXT');
    let itemcd = (itemcodetxt.innerText || itemcodetxt.textContent);
    let costsctxt = document.getElementById('COSTSC_TXT');
    let costtxt = (costsctxt.innerText || costsctxt.textContent);
    let costsc = document.getElementById('COSTSC');
    let costscname = costsc.options[costsc.selectedIndex].text;
    let bmversion = document.getElementById('BMVERSION');
    let bmversionname = bmversion.options[bmversion.selectedIndex].text;
    var csv_data = [itemcd + ',' + $('#ITEMCODE').val() + ',' + $('#ITEMNAME').val() + ',' + $('#ITEMSPEC').val() + ',' + $('#ITEMDRAWNUMBER').val()];
    csv_data.push(costtxt + ',' + costscname + ',' + bmversionname);
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
        // [...cols].forEach((el) => {
        //     // console.log(el.innerText);
        //     csvrow.push("\""+el.innerText+"\"");
        // });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(","));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ITEMCOSTCSV/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // $('#loading').hide();        
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../ITEMCOSTCSV/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
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
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

	window.location.href = '../ITEMCOSTCSV/';

    return false;
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
            }
        }
    });
}

function unRequired() {
    let ITEMCODE = document.getElementById('ITEMCODE');
    let COSTSC = document.getElementById('COSTSC');

    ITEMCODE.classList[ITEMCODE.value !== '' ? 'remove' : 'add']('req');
    COSTSC.classList[COSTSC.selectedIndex != 0 ? 'remove' : 'add']('req');
}


function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 14; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}