// icon search
const SEARCHSALETRAN_ACC1 = $('#SEARCHSALETRAN_ACC1');
const SEARCHSALETRAN_ACC2 = $('#SEARCHSALETRAN_ACC2');
const SEARCHCUSTOMER1 = $('#SEARCHCUSTOMER1');
const SEARCHCUSTOMER2 = $('#SEARCHCUSTOMER2');
const SEARCHCATALOG1 = $('#SEARCHCATALOG1');
const SEARCHCATALOG2 = $('#SEARCHCATALOG2');
const SEARCHITEM1 = $('#SEARCHITEM1');
const SEARCHITEM2 = $('#SEARCHITEM2');
const SEARCHDIVISION1 = $('#SEARCHDIVISION1');
const SEARCHDIVISION2 = $('#SEARCHDIVISION2');
const SEARCHSTAFF1 = $('#SEARCHSTAFF1');
const SEARCHSTAFF2 = $('#SEARCHSTAFF2');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');

SEARCHCUSTOMER1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SEARCHSALE&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SEARCHSALE&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHSALETRAN_ACC1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALETRAN_ACC/index.php?page=SEARCHSALE&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSALETRAN_ACC2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALETRAN_ACC/index.php?page=SEARCHSALE&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=SEARCHSALE&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=SEARCHSALE&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SEARCHSALE&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SEARCHSALE&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=SEARCHSALE&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=SEARCHSALE&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHITEM1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SEARCHSALE&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHITEM2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SEARCHSALE&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=SEARCHSALE', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHSALETRAN_ACC1, SEARCHSALETRAN_ACC2, SEARCHCUSTOMER1, SEARCHCUSTOMER2, SEARCHCATALOG1, SEARCHCATALOG2, SEARCHITEM1, SEARCHITEM2, SEARCHDIVISION1, SEARCHDIVISION2, SEARCHSTAFF1, SEARCHSTAFF2, SEARCHCURRENCY];

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');

// form
const form = document.getElementById('searchSale');

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

CSV.click(function() {
    return exportCSV();
});

async function getElementIndex(code, value, index) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('index', index);
    data.append('action', 'getElement');
    await axios.post('../SEARCHSALE/function/index_x.php', data)
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
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function exportCSV() {
  // Variable to store the final csv data
    let voucfr = '--/--/----';
    let voucto = '--/--/----';
    if($('#VOUCHERDATEFR').val() != '') { voucfr = $('#VOUCHERDATEFR').val(); }
    if($('#VOUCHERDATETO').val() != '') { voucto = $('#VOUCHERDATETO').val(); }
    // let accy = document.getElementById("ACCY");
    // let accyname2 = accy.options[accy.selectedIndex].text;
    var csv_data = ['Voucher Date,' + voucfr + ',-,' + voucto + ',Voucher No.,' + $('#VOUCEHRNOFR').val() + ',-,' + $('#VOUCHERNOTO').val()];
    csv_data.push('Customer Code,' + $('#CUSTOMERFR').val() + ',-,' + $('#CUSTOMERTO').val());
    csv_data.push('Category,' + $('#CATEGORYFR').val() + ',-,' + $('#CATEGORYTO').val() + ',Item,' + $('#ITEMFR').val() + ',-,' + $('#ITEMTO').val());
    csv_data.push('Department,' + $('#DEPARTMENTFR').val() + ',-,' + $('#DEPARTMENTTO').val() + ',Staff,' + $('#STAFFFR').val() + ',-,' + $('#STAFFTO').val());
    csv_data.push(',,,,Currency,' + $('#CURRENCY').val());
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
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../SEARCHSALE/function/index_x.php', data)
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
    data.append('systemName', 'SEARCHSALE');

    await axios.post('../SEARCHSALE/function/index_x.php', data)
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

    // clearing table
    // $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = '../SEARCHSALE/';

    return false;
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'flex w-full p-0 divide-x row-empty');
        for (var z = 1; z <= 43; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 w-40 py-2');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}