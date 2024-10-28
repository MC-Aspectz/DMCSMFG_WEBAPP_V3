// guide search
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHCATALOG = $('#SEARCHCATALOG');
const SEARCHSTAFF = $('#SEARCHSTAFF');

SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=INQ_SALESORDER_01', 'authWindow', 'width=1200,height=600');});
SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=INQ_SALESORDER_01', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=INQ_SALESORDER_01', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=INQ_SALESORDER_01', 'authWindow', 'width=1200,height=600');});

const search_guide = [ SEARCHCUSTOMER, SEARCHITEM, SEARCHCATALOG, SEARCHSTAFF];

//input serach
const CUSTOMERCD = $('#CUSTOMERCD');
const ITEMCD = $('#ITEMCD');
const CATALOGCD = $('#CATALOGCD');
const STAFFCD = $('#STAFFCD');

const input_serach = [CUSTOMERCD, ITEMCD, CATALOGCD, STAFFCD];

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');
const DETAIL = $('#DETAIL');

// form
const form = document.getElementById('inqSaleOrder');

for (const guide of search_guide) {
  guide.click(function () {
    keepData();
  });
}

for(const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
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

CUSTOMERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCD', ITEMCD.val());
    }
});

CATALOGCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CATALOGCD', CATALOGCD.val());
    }
});


STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../INQ_SALESORDER_01/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result  = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });
        }  
        document.activeElement.blur();     
        document.getElementById('loading').style.display = 'none';
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

var isItem = false;
$('table#table tr').click(function () {
    isItem = false;
    $('table#table tr').removeAttr('id');
    document.getElementById('DETAIL').disabled = true;

    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(1).text() != '') {
        $(this).attr('id', 'selected-row');
        $('#SALES_ORDER_NO').html(item.eq(1).text());
        $('#LINE').html(item.eq(2).text());
        $('#SALESORDERTYPE').html(item.eq(3).text());
        $('#STATUS').html(item.eq(4).text());
        $('#DUE_DATE_CUSTOM').html(item.eq(5).text());
        $('#CUSTOMERCODE').html(item.eq(6).text());
        $('#CUSTOMERNAME').html(item.eq(7).text());
        $('#TEL').html(item.eq(8).text());
        $('#CUST_STAFF_NAME').html(item.eq(9).text());
        $('#DELIVERY_ORDER').html(item.eq(10).text());
        $('#ORDER_NO_CUSTOMER').html(item.eq(11).text());
        $('#DELE_PLACE').html(item.eq(12).text());
        $('#DELE_PLACE_NAME').html(item.eq(13).text());
        $('#DISTRICT_CODE').html(item.eq(14).text());
        $('#DISTRICT_NAME').html(item.eq(15).text());
        $('#TEL1').html(item.eq(16).text());
        $('#DELE_PLACE_STAFF').html(item.eq(17).text());
        $('#INPUT_DATE').html(item.eq(18).text());
        $('#BRANCH_TYPE').html(item.eq(19).text());
        $('#PERSON_RESPONSE').html(item.eq(20).text());
        $('#STAFF_NAME').html(item.eq(21).text());
        $('#ITEMCODE1').html(item.eq(22).text());
        $('#ITEMNAME1').html(item.eq(23).text());
        $('#SPECIFICATE').html(item.eq(24).text());
        $('#SALES_ORDER_QTY').html(item.eq(25).text());
        $('#SALES_ORDER_PRICE').html(item.eq(26).text());
        $('#SALES_ORDER_AMOUNT').html(item.eq(27).text());
        $('#CURRENCY').html(item.eq(28).text());
        $('#MYCURRENCY_PRICE').html(item.eq(29).text());
        $('#MYCURRENCY_PRICE2').html(item.eq(30).text());
        $('#CURRENCY1').html(item.eq(31).text());
        $('#TEMPORARY_TYPE').html(item.eq(32).text());
        $('#TAX_TYPE').html(item.eq(33).text());
        $('#TAX_RATE').html(item.eq(34).text());
        $('#TAX_AMOUNT').html(item.eq(35).text());
        $('#SALESCONFIRM2').html(item.eq(36).text());
        $('#FACTORYCONFIRM2').html(item.eq(37).text());
        $('#DELIVERY_DATE').html(item.eq(38).text());
        $('#INSPECTION').html(item.eq(39).text());
        $('#STORAGE_TYPE').html(item.eq(40).text());
        $('#SOURCE_STORAGE').html(item.eq(41).text());
        $('#LAST_SHIP_DATE').html(item.eq(42).text());
        $('#TOTAL_SHIP').html(item.eq(43).text());
        $('#REMARK').html(item.eq(44).text());

        document.getElementById('DETAIL').disabled = false;
    }
});

DETAIL.on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});

CSV.click(function() {
    return exportCSV();
});

async function exportCSV() {
  // Variable to store the final csv data
    let P1 = '--/--/----'; if($('#P1').val() != '') { P1 = $('#P1').val(); }
    let P2 = '--/--/----'; if($('#P2').val() != '') { P2 = $('#P2').val(); }
    let P3 = '--/--/----'; if($('#P3').val() != '') { P3 = $('#P3').val(); }
    let P4 = '--/--/----'; if($('#P4').val() != '') { P4 = $('#P4').val(); }
    let customertxt = (document.getElementById('CUSTOMERCODE_TXT').innerText || document.getElementById('CUSTOMERCODE_TXT').textContent);
    let itemtxt = (document.getElementById('ITEMCODE_TXT').innerText || document.getElementById('ITEMCODE_TXT').textContent);
    let categorytxt = (document.getElementById('CATEGORY_CODE_TXT').innerText || document.getElementById('CATEGORY_CODE_TXT').textContent);
    let stafftxt = (document.getElementById('PERSON_RESPONSE_TXT').innerText || document.getElementById('PERSON_RESPONSE_TXT').textContent);
    let duedate = (document.getElementById('DUE_DATE_CUSTOM_TXT').innerText || document.getElementById('DUE_DATE_CUSTOM_TXT').textContent);
    let saleapprovetxt = (document.getElementById('SALESCONFIRM_TXT').innerText || document.getElementById('SALESCONFIRM_TXT').textContent);
    let factorytxt = (document.getElementById('FACTORYCONFIRM_TXT').innerText || document.getElementById('FACTORYCONFIRM_TXT').textContent);
    let deliverytxt = (document.getElementById('DELIVERY_DATE_TXT').innerText || document.getElementById('DELIVERY_DATE_TXT').textContent);
    let statustxt = (document.getElementById('STATUS_TXT').innerText || document.getElementById('STATUS_TXT').textContent);
    let arrow = (document.getElementById('ARROW_TXT').innerText || document.getElementById('ARROW_TXT').textContent);
    let factorycon = document.getElementById('FACTORYCONFIRM');
    let factoryconfirm = factorycon.options[factorycon.selectedIndex].text;
    let salecon = document.getElementById('SALESCONFIRM');
    let saleconfirm = salecon.options[salecon.selectedIndex].text;
    let statustype = document.getElementById('P5');
    let status = statustype.options[statustype.selectedIndex].text;
    var csv_data = [customertxt + ',' + $('#CUSTOMERCD').val() + ',' + $('#CUSTOMERNAME_S').val() + ',' + itemtxt + ',' + $('#ITEMCD').val() + ',' + $('#ITEMNAME').val()];
        csv_data.push(categorytxt + ',' + $('#CATALOGCD').val() + ',' + $('#CATALOGNAME').val() + ',' + stafftxt + ',' + $('#STAFFCD').val() + ',' + $('#STAFFNAME').val());
        csv_data.push(duedate + ',' + P1 + ',' + arrow + ',' + P2 + ',' + saleapprovetxt + ',' + saleconfirm + ',' + factorytxt + ',' + factoryconfirm);
        csv_data.push(deliverytxt + ',' + P3 + ',' + arrow + ',' + P4 + ',' + statustxt + ',' + status);
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
    .post('../INQ_SALESORDER_01/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function unsetSession(form) {
  let data = new FormData(form);
  data.append('action', 'unsetsession');
  data.append('systemName', 'INQ_SALESORDER_01');
  await axios
    .post('../INQ_SALESORDER_01/function/index_x.php', data)
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
                // 
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
        var colhide = document.createElement('td');
        colhide.setAttribute('class', 'hidden rowSeq');
        row.appendChild(colhide);
        for (var z = 1; z <= 44; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}