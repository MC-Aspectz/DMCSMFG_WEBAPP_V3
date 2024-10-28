// button search
const SEARCHITEM = $('#SEARCHITEM');
SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=PLANVIEW', 'authWindow', 'width=1200,height=600');});

// button action
const CSV = $('#CSV');

//input serach
const ITEMCODE = $('#ITEMCODE');

// form
const form = document.getElementById('planView');

$('#SEARCHITEM').on('click', function() {
    keepData();
});

ITEMCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCODE', ITEMCODE.val());
    }
});

var isItem = false;

$(document).on('click', '.pv tbody tr', function(event) {
    $('table#table tr').removeAttr('id');
    document.getElementById('DETAIL').disabled = true;
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(5).text() != 'undefined' && item.eq(5).text() != '') {
        isItem = true;
        $(this).attr('id', 'selected-row');

        $('#DUEDATE').html(item.eq(0).text());
        $('#PARENTITEMCODE').html(item.eq(1).text());
        $('#ORDERNUMBER').html(item.eq(2).text());
        $('#QTYIN').html(item.eq(3).text());
        $('#QTYOUT').html(item.eq(4).text());
        $('#TOTAL').html(item.eq(5).text());
        $('#STARTDATE').html(item.eq(6).text());
        $('#PRODUCTIONPLANTYPE').html(item.eq(7).text());
        $('#CURDUEDATE').html(item.eq(8).text());

        document.getElementById('DETAIL').disabled = false;
    }
});

$('#DETAIL').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});

CSV.click(function() {
    return exportCSV();
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../PLANVIEW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });
        }
        unRequired();
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
    let factorycode = document.getElementById('FACTORYCODE');
    let factory = factorycode.options[factorycode.selectedIndex].text;
    let orderpolicy = document.getElementById('ITEMORDERTRIGGER');
    let orderplc = orderpolicy.options[orderpolicy.selectedIndex].text;
    let itemunit = document.getElementById('ITEMUNIT');
    let unit = itemunit.options[itemunit.selectedIndex].text;

    var csv_data = ['Factory ,' + factory ];
    csv_data.push('Item Code ,' +  $('#ITEMCODE').val() +' , '+ $('#ITEMNAME').val());
    csv_data.push('On-hand ,' +  $('#ONHAND').val() +' , ' + 'Awaiting Inspection ,'+ $('#AWAIT_TEST').val() +','+'On Order ,' + $('#INV_OF_ORDER').val() + ',' +'Backlog ,' + $('#BACKLOG').val());
    csv_data.push('Reserve Balance ,' +  $('#ALLOCATE').val() +' , ' + 'Order Multiple ,'+ $('#ITEMORDERROT').val() +','+'Minimum Order ,' + $('#ITEMORDERMINIMUMQUANTITY').val() + ',' +'Buffer Stock ,' + $('#ITEMMINIMUMQUANTITY').val());
    csv_data.push('Lead time ,' +  $('#ITEMLEADTIME').val() +' , ' + 'Day ,' + 'Order Policy ,' + orderplc + ',' + unit);

    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 0; x < cols.length; x++) {
            csvrow.push("\""+cols[x].innerText+"\"");
        }
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
    await axios
    .post('../PLANVIEW/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'PLANVIEW');
    await axios
    .post('../PLANVIEW/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
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

    // clearing table
    $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = 'index.php';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: '',
    text: txt,
    showCancelButton: true,
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
    }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return closeApp($('#appcode').val()); 
        } else if (type == 2) {
            // $("#loading").show();
        } else {
        // 
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
        for (var z = 1; z <= 10; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function unRequired() {
    document.getElementById('ITEMCODE').classList[document.getElementById('ITEMCODE').value !== '' ? 'remove' : 'add']('req');
}

function back() {
    unsetSession();
    return window.history.back();
}