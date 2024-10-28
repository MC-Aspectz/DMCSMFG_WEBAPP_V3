// action button
const print = $("#print");
const csv = $("#csv");

// form
const form = document.getElementById('inv_bal_report');

//csv ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT
const ACCCDF = $("#ACCCDF");
const ACCCDT = $("#ACCCDT");
const ITEMCDF = $("#ITEMCDF");
const ITEMCDT = $("#ITEMCDT");
const ITEMTYPF = $("#ITEMTYPF");
const ITEMTYPT = $("#ITEMTYPT");
const STORAGECDF = $("#STORAGECDF");
const STORAGECDT = $("#STORAGECDT");
const ASOFDT = $("#ASOFDT");

// insrts.click(function() {
//     // check validate form
//     if (!form.reportValidity()) {
//         validationDialog();
//         return false;
//     }
//     return commit('insert');
// });

csv.click(function() {
    exportCSV();
});


async function searchs() {
    $('#loading').show(); 
    form.submit();
    // let data = new FormData(form);
    // data.append('action', 'search');
    // await axios.post('../CATALOGMASTER/function/index_x.php', data)
    // .then(response => {
    //     console.log(response.data)
    // })
    // .catch(e => {
    //     console.log(e);
    // });
}

async function exportCSV() {
    // Variable to store the final csv data ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT
    // console.log(MONTH.text()

    //date value
    var asofdt = "--/--/----";
    if(ASOFDT.val()!='')
    {
        asofdt = formatDate(ASOFDT.val());
    }
    // );
    // dropdown value 
    var I1 = document.getElementById("ITEMTYPF").options[document.getElementById('ITEMTYPF').selectedIndex].text;
    var I2 = document.getElementById("ITEMTYPT").options[document.getElementById('ITEMTYPT').selectedIndex].text;

    // console.log(COM_CCODE.val());
    var csv_data = [  'Acc Code,' + ACCCDF.val() + ',→,' + ACCCDT.val() + ',\n' 
                    + 'Item Code,' + ITEMCDF.val() + ',→,' + ITEMCDT.val() + ',\n' 
                    + 'Type of Item,' + I1 + ',→,' + I2 + ',\n' 
                    + 'Location Code,' + STORAGECDF.val() + ',→,' + STORAGECDT.val() + ',\n' 
                    + 'Date (As of),' + asofdt ];
                // isset($data['INV']['INVTRANTRXTYPE']) ? $data['INV']['INVTRANTRXTYPE']: '' ?
    // Get each row data
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td:not(.export-exclude), th');
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

async function commit(method) {
    let data = new FormData(form);
    data.append('action', method);

    await axios.post('../INVBALREPORT_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href='index.php?refresh=1';
        // clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../INVBALREPORT_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
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
    window.location.href = '../INVBALREPORT_THA/';
 
    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        background: '#8ca3a3',
        showCancelButton: true,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                window.location.href="/DMCS_WEBAPP";          
            } else {
                printReport();
            }

        }
    });
}

print.click(function() {
    return printDialog();
 });
 

function printReport() {   
    var popupWindow = window.open('../INVBALREPORT_THA/print.php', '_blank', 'width=auto, height=auto');
    // setTimeout(function() { popupWindow.close(); }, 5000);  
    // var printReport = document.getElementById('printReport');
    // var popupWindow = window.open('', '_blank', 'width=800, height=800');
    // popupWindow.document.open();
    // popupWindow.document.write('<html><body onload="window.print()">' + printReport.innerHTML + '</html>');
    // // popupWindow.document.write('<html><body>' + printReport.innerHTML + '</html>');
    // popupWindow.document.close();
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [day, month, year].join('/');
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../INVBALREPORT_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}