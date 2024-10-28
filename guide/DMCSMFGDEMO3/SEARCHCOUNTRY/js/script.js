// Action Button
const csv = $("#csv");

// CSV
const P2 = $("#P2");

var page = $('#page').val();
var pageUrl = $('#pageUrl').val();

var isItem = false;
var COUNTRYCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        COUNTRYCD = item.eq(0).text();

    }

    $('#countrycd').html(item.eq(0).text());
    $('#countryname').html(item.eq(1).text());
    
    
    $("#select_item").on('click', function() {
        $('#loading').show();
        return HandleResult(COUNTRYCD);
    });
});

$("#view_item").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$("#back").on('click', function() {
    // window.history.back();
    return window.close();
});

function HandleResult(result) {
    try {
        if(page == 'CUSTOMERMASTER_DMCS_THA' || page == 'TAXDETAILENTRY') {
            window.opener.HandlePopupResult('COUNTRYCD', result);
        } 
        // else if(page == '') {
        //     window.opener.HandlePopupResult('SUPCURCD', result);
        // } 
        else {
            window.opener.HandlePopupResult('COUNTRYCD', result);
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

    // clearing table
    $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = 'index.php';

    return false;
}

csv.click(function() {
    exportCSV();
});

async function exportCSV() {
    // Variable to store the final csv data P1
    // var csv_data = [  'Staff Code,' + P1.val() + ',\n' ];
    var csv_data = [  'Country Name,' + P2.val() ];

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
