const csv = $("#csv");
const TAXCODE = $("#TAXCODE");
var page = $('#page').val();
var TAXTYPECD;
csv.click(function() {
    exportCSV();
});

var isItem = false;

$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        TAXTYPECD = item.eq(0).text();
    }

    $('#taxcd').html(item.eq(0).text());
    $('#taxnm').html(item.eq(1).text());
    $('#taxty').html(item.eq(2).text());
    $('#taxra').html(item.eq(3).text());
    $('#taxca').html(item.eq(4).text());
    
    $("#select_item").on('click', function() {
        return HandleResult(TAXTYPECD);       
    });
});

function HandleResult(result) {
    try {
        if(page == 'TAXDETAILENTRY') {
            window.opener.HandlePopupResult('TAXTYPECD', result);
        } else {
            window.opener.HandlePopupResult('TAXCODE', result);
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

$("#view_item").on('click', function() {
    if(isItem) {
        $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    // window.history.back();
    // window.history.go(-1); return false;    
    window.location.href=$('#routeUrl').val();
    return window.close();
});

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

async function exportCSV() {
    // Variable to store the final csv data ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT
    // console.log(MONTH.text()

    //date value
    // var asofdt = "--/--/----";
    // if(ASOFDT.val()!='')
    // {
    //     asofdt = formatDate(ASOFDT.val());
    // }
    // );
    // dropdown value 
    // var I1 = document.getElementById("ITEMTYPF").options[document.getElementById('ITEMTYPF').selectedIndex].text;
    // var I2 = document.getElementById("ITEMTYPT").options[document.getElementById('ITEMTYPT').selectedIndex].text;

    // console.log(COM_CCODE.val());
    var csv_data = [  TAXCODE.val()   + ',\n' 
                    + 'Tax Code,' ];
                // isset($data['INV']['INVTRANTRXTYPE']) ? $data['INV']['INVTRANTRXTYPE']: '' ?
    // Get each row data
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('#search_table td:not(.export-exclude),#search_table th');
        // Stores each csv row data
        var csvrow = [];
        for (var j = 0; j < cols.length; j++) {
            // Get the text data of each cell
            // of a row and push it to csvrow
            // csvrow.push(cols[j].innerHTML.replace(/"/g, '""'));
            csvrow.push(cols[j].innerHTML);
        }
        // Combine each column value with comma
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