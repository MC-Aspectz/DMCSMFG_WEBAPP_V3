// Action Button
const csv = $("#csv");
var page = $('#page').val();
var index = $('#index').val();

// CSV
const P1_CUSTCD = $("#P1_CUSTCD");
const P2_CUSTCD = $("#P2_CUSTCD");
const P3_CUSTNM = $("#P3_CUSTNM");
const P4_SEARCHCHAR = $("#P4_SEARCHCHAR");
const P5_CUSTADDR = $("#P5_CUSTADDR");
const P6_CUSTADDR = $("#P6_CUSTADDR");

var isItem = false;
var CUSTOMERCD; var CUSTOMERNAME;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        CUSTOMERCD = item.eq(1).text();
        CUSTOMERNAME = item.eq(2).text();
        
        $('#customercode').html(item.eq(1).text());
        $('#customername').html(item.eq(2).text());
        $('#postalcode').html(item.eq(3).text());
        $('#address1').html(item.eq(4).text());
        $('#address2').html(item.eq(5).text());
        $('#tel').html(item.eq(6).text());
    }


    $('#select_item').on('click', function() {
        $('#loading').show();
        if(page == 'SEARCHQUOTE') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHQUOTE/index.php?P1CODE='+ CUSTOMERCD + '&P1NAME=' + CUSTOMERNAME;
        } else if(page == 'SEARCHSALEORDER') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?P1CODE='+ CUSTOMERCD;
        } else if(page == 'SEARCHSALENOSHIP') {
            return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALENOSHIP/index.php?CUSTOMERCD='+ CUSTOMERCD;
        } else if(page == 'SEARCHBILLNO') {
            return window.location.href=$('#pageUrl').val() + '?CD=' + CUSTOMERCD;
        } else {
            return HandleResult(CUSTOMERCD);
        }
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    if (page == 'SEARCHQUOTE' || page == 'SEARCHSALENOSHIP') {
        return window.location.href = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/'+ page +'/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'ACC_OUTSTANDINGAR' || page == 'SEARCHSALE' || page == 'SEARCHGL') {
            window.opener.HandlePopupResultIndex('CUSTOMERCD', result, index);
        } else if(page == 'ACC_GENERALVO_THARD' || page == 'ACC_ADJUSTVO_THA' || page == 'ACC_ADJUSTVO_ONLY_THA' || page == 'ACC_PETTYCASHVO_THA') {
            window.opener.HandlePopupResult('CUSTOMERCODE', result);
        } else if(page == 'NEWSHIPENTRY' || page == 'NEWSHIPENTRY_MFG') {
            window.opener.HandlePopupResult('CUSTOMERCD_S', result);
        } else if(page == 'ACC_SALEORDERENTRY_MFG_SEARCH') {
            window.opener.HandlePopupResult('SERCUSTCD', result);  
        } else {
            window.opener.HandlePopupResult('CUSTOMERCD', result);
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
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

    // clearing table empty Row
    $('#table_result > tbody > tr').remove();
    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="row-empty">' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td>' +
                                        '<td class="h-6 border border-slate-700"></td></tr>');
    }

    document.getElementById('rowcount').innerHTML = '0';

    // refresh
    // window.location.href = 'index.php';

    return false;
}

csv.click(function() {
    exportCSV();
});

async function exportCSV() {
    // Variable to store the final csv data P1_CUSTCD, P2_CUSTCD, P3_CUSTNM, P4_SEARCHCHAR, P5_CUSTADDR, P6_CUSTADDR
    var csv_data = [
        'Customer Code,' + P1_CUSTCD.val() + ',-,' + P2_CUSTCD.val() + ',\n'
        + 'Customer Name,' + P3_CUSTNM.val() + ',\n'
        + 'Search String,' + P4_SEARCHCHAR.val() + ',\n'
        + 'Address,' + P5_CUSTADDR.val() + ',\n'
        + 'Address,' + P6_CUSTADDR.val() + ',\n'
    ];
    // Get each row data
    // var rows = document.getElementsByTagName('tr');
    var rows = document.getElementsByClassName('csv-row');
    console.log(rows.length);
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        // var cols = rows[i].querySelectorAll('td:not(.export-exclude), th');
        // var cols = rows[i].querySelectorAll('td, th');
        var cols = rows[i].getElementsByClassName('csv-col');
        
        // console.log(cols);
        // Stores each csv row data
        // var csvrow = [];
        // for (var j = 0; j < cols.length; j++) {
        //     console.log(cols[j].innerHTML);
        //     // Get the text data of each cell
        //     // of a row and push it to csvrow
        //     // csvrow.push(cols[j].innerHTML.replace(/"/g, '""'));
        //     // csvrow.push(cols[j].innerHTML);
        //     if (j > 0) {
        //         csvrow.push(cols[j].innerHTML);
        //     }
        // }
        // // Combine each column value with comma
        // csv_data.push(arrayToCSV(csvrow));

        var csvrow = [];
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            // csvrow.push("\""+el.innerText+"\"");
            csvrow.push(el.innerText);
        });
        // console.log(csvrow);
        // Combine each column value with comma
        // csv_data.push(csvrow.join(","));
        csv_data.push(arrayToCSV(csvrow));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file 
    await handleSaveAsFile(csv_data);
    // console.log(csv_data);
}

function arrayToCSV(row) {
    for (let i in row) {
        row[i] = row[i].replace(/"/g, '""');
    }
    return '"' + row.join('","') + '"';
}

async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(["\uFEFF"+csv_data], { type: "text/csv;charset=utf-8;"});
        const supportsFileSystemAccess = 'showSaveFilePicker' in window && (() => {
        try {
            return window.self === window.top;
        } catch {
            return false;
        }
    });
    // If the File System Access API is supported…
    if (supportsFileSystemAccess) {
      try {
        // Show the file save dialog.
        const handle = await showSaveFilePicker({
            types: [{
                description: 'CSV file',
                accept: {'application/csv': ['.csv']},
            }],
        });
        // Write the CSVFile to the file.
        const writable = await handle.createWritable();
        await writable.write(CSVFile);
        await writable.close();
        return;
      } catch (err) {
        // Fail silently if the user has simply canceled the dialog.
        if (err.name !== 'AbortError') {
            console.error(err.name, err.message);
            return;
        }
      }
    }
    // Fallback if the File System Access API is not supported…
    // Create the CSVFile URL.
    const url = URL.createObjectURL(CSVFile);
    // Create the `<a download>` element and append it invisibly.
    const temp_link = document.createElement('a');
    temp_link.href = url;
    temp_link.download = suggestedName;
    temp_link.style.display = 'none';
    document.body.append(temp_link);
    // Programmatically click the element.
    temp_link.click();
    // Revoke the CSVFile URL and remove the element.
    setTimeout(() => {
        URL.revokeObjectURL(url);
        temp_link.remove();
    }, 1000);
}