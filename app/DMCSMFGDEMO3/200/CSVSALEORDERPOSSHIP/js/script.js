// icon search
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHITEM = $('#SEARCHITEM');

SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=CSVSALEORDERPOSSHIP', 'authWindow', 'width=1200,height=600');});
SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=CSVSALEORDERPOSSHIP', 'authWindow', 'width=1200,height=600');});

//input serach
const CUSTOMERCD = $('#CUSTOMERCD'); 
const ITEMCD = $('#ITEMCD'); 


// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');

// form
const form = document.getElementById('csvsaleOrderPOSship');

const serach_icon = [SEARCHCUSTOMER, SEARCHITEM];

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
    await keepData();
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

CSV.click(function() {
    return exportCSV();
});

CUSTOMERCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

ITEMCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCD', ITEMCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/200/CSVSALEORDERPOSSHIP/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../CSVSALEORDERPOSSHIP/function/index_x.php', data)
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
    let P3 = '--/--/----'; if($('#P3').val() != '') { P3 = $('#P3').val(); }
    let P4 = '--/--/----'; if($('#P4').val() != '') { P4 = $('#P4').val(); }
    let P5 = '--/--/----'; if($('#P5').val() != '') { P5 = $('#P5').val(); }
    let P6 = '--/--/----'; if($('#P6').val() != '') { P6 = $('#P6').val(); }
    let customertxt = document.getElementById('CUSTOMERCD_TXT');
    let customercode = (customertxt.innerText || customertxt.textContent);
    let itemcdtxt = document.getElementById('ITEMCODE_TXT');
    let itemcd = (itemcdtxt.innerText || itemcdtxt.textContent);
    let orderdatetxt = document.getElementById('ORDERDATE_TXT');
    let orderdate = (orderdatetxt.innerText || orderdatetxt.textContent);
    let deliverydatetxt = document.getElementById('DELIVERY_DATE_TXT');
    let deliverydate = (deliverydatetxt.innerText || deliverydatetxt.textContent);
    let arrowtxt = document.getElementById('ARROW_TXT');
    let arrow = (arrowtxt.innerText || arrowtxt.textContent);

    var csv_data = [customercode + ',' + $('#CUSTOMERCD').val() + ',' + $('#CUSTOMERNAME_S').val() + ',' + itemcd + ',' + $('#ITEMCD').val()];
    csv_data.push(orderdate + ',' + P3 + ',' + arrow + ',' + P4);
    csv_data.push(deliverydate + ',' + P5 + ',' + arrow + ',' + P6);
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
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../CSVSALEORDERPOSSHIP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();        
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../CSVSALEORDERPOSSHIP/function/index_x.php', data)
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

	window.location.href = '../CSVSALEORDERPOSSHIP/';

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

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 12; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}