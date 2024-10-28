// button search
const SEARCHITEM = $('#SEARCHITEM');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=INQ_PRODUCTIONORDER_01', 'authWindow', 'width=1200,height=600');});

//input serach
const ITEMCD = $('#ITEMCD');

// form
const form = document.getElementById('inqProductionOrder');

// action button
const CSV = $('#CSV');

$('#SEARCHITEM').on('click', function() {
    keepData();
});


ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getElement('ITEMCD', ITEMCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/INQ_PRODUCTIONORDER_01/index.php?'+code+'=' + value;        
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../INQ_PRODUCTIONORDER_01/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
              // console.log(key, '=>', value);
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

var isItem = false;
$(document).on('click', '.poinq tbody tr', function(event) {
    isItem = false;
    $('table#table tr').removeAttr('id');
    document.getElementById('DETAIL').disabled = true;
    // $(this).attr('id', 'selected-row');
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(3).text() != '') {
        $(this).attr('id', 'selected-row');
        $('#PRODUCTIONORDER').html(item.eq(1).text());
        $('#INPUT_DATE').html(item.eq(2).text());
        $('#ITEMCODE1').html(item.eq(3).text());
        $('#ITEMNAME1').html(item.eq(4).text());
        $('#SPECIFICATE1').html(item.eq(5).text());
        $('#FACTORYNAME').html(item.eq(6).text());
        $('#WC_CODE').html(item.eq(7).text());
        $('#WORK_CENTER_NAME').html(item.eq(8).text());
        $('#STAFFCODE').html(item.eq(9).text());
        $('#STAFF_NAME').html(item.eq(10).text());
        $('#REFERENCE').html(item.eq(11).text());
        $('#CUSTOMERCD').html(item.eq(12).text());
        $('#CUSTOMERNAME').html(item.eq(13).text());
        $('#DELE_PLACE').html(item.eq(14).text());
        $('#DELE_PLACE_NAME').html(item.eq(15).text());
        $('#ITEMCODE2').html(item.eq(16).text());
        $('#ITEMNAME2').html(item.eq(17).text());
        $('#SPECIFICATE2').html(item.eq(18).text());
        $('#SALES_ORDER_QTY').html(item.eq(19).text());
        $('#SALES_ORDER_PRICE').html(item.eq(20).text());
        $('#SALES_ORDER_AMOUNT').html(item.eq(21).text());
        $('#CURRENCY').html(item.eq(22).text());
        $('#MYCURRENCY_PRICE').html(item.eq(23).text());
        $('#CURRENCY1').html(item.eq(24).text());
        $('#INSPECTION').html(item.eq(25).text());
        $('#PLAN_START_DATE').html(item.eq(26).text());
        $('#PROD_DUEDATE').html(item.eq(27).text());
        $('#STORAGETYPE').html(item.eq(28).text());
        $('#LO_CODE').html(item.eq(29).text());
        $('#ACT_START_DATE').html(item.eq(30).text());
        $('#LAST_SHIP_DATE').html(item.eq(31).text());
        $('#PRODUCT_ORDER_QTY').html(item.eq(32).text());
        $('#TOTAL_PROD_QTY').html(item.eq(33).text());
        $('#STATUS1').html(item.eq(34).text());
        $('#REMARK').html(item.eq(35).text());

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

async function exportCSV() {
  // Variable to store the final csv data
    let P2 = '--/--/----';
    let P3 = '--/--/----';
    let factyp = document.getElementById('FACTYP');
    let factory = factyp.options[factyp.selectedIndex].text;
    let statusorder = document.getElementById('STATUS');
    let status = statusorder.options[statusorder.selectedIndex].text;
    if($('#P2').val() != '') { P2 = $('#P2').val(); }
    if($('#P3').val() != '') { P3 = $('#P3').val(); }
    // let accy = document.getElementById("ACCY");
    // let accyname2 = accy.options[accy.selectedIndex].text;
    var csv_data = ['Item Code,' + $('#ITEMCD').val()];
    csv_data.push('Estimated Due Date,' + P2 + ',→,' + P3);
    csv_data.push('Factory,' + factory);
    csv_data.push('Status,' + status);
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
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios
    .post('../INQ_PRODUCTIONORDER_01/function/index_x.php', data)
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
  data.append('systemName', 'INQ_PRODUCTIONORDER_01');
  await axios
    .post('../INQ_PRODUCTIONORDER_01/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
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
        for (var z = 1; z <= 35; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}