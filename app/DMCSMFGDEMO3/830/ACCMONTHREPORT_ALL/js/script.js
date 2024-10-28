// icon search
const SEARCHACCOUNT1 = $('#SEARCHACCOUNT1');
const SEARCHACCOUNT2 = $('#SEARCHACCOUNT2');

SEARCHACCOUNT1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACCMONTHREPORT_ALL&index=ACCCD1', 'authWindow', 'width=1200,height=600');});
SEARCHACCOUNT2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACCMONTHREPORT_ALL&index=ACCCD2', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHACCOUNT1, SEARCHACCOUNT2];

// input
const VOUCHERNO = $('#VOUCHERNO');

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');
const REVIEW = $('#REVIEW');

// form
const form = document.getElementById('AccMonthReportAll');

for(const icon of serach_icon){
    icon.click(async function () {
       await keepData();
    });
};

REVIEW.click(async function() {
    if(VOUCHERNO.val() != '') {
        $('#loading').show();
        await keepData();
        window.location.href = $('#accINCVOURL').val() + '/index.php?VOUCHERNO=' + VOUCHERNO.val();
    }
});

SEARCH.click(async function() {
    // check validate form
    $('#loading').show();
    await keepData();
    // return actionDialog(2);
});

CSV.click(function() {
    return exportCSV();
});

async function exportCSV() {
  // Variable to store the final csv data
    let p1 = '--/--/----';
    let p2 = '--/--/----';
    if($('#P1').val() != '') { p1 = $('#P1').val(); }
    if($('#P2').val() != '') { p2 = $('#P2').val(); }
    var csv_data = ['Target Period,' + p1 + ',→,' + p2 + ',Acc Code,' + $('#ACCCD1').val() + ',→,' + $('#ACCCD2').val()];
    csv_data.push('All the data is coming from General ledger.');
    // Get each row data
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll("td, th");
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
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACCMONTHREPORT_ALL/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACCMONTHREPORT_ALL');
    await axios.post('../ACCMONTHREPORT_ALL/function/index_x.php', data)
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
    window.location.href = '../ACCMONTHREPORT_ALL/';

    return false;
}

function emptyRow(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr');
        row.setAttribute('class', 'flex w-full p-0 divide-x row-empty');
        for (var z = 1; z <= 15; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 w-40 py-2');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}