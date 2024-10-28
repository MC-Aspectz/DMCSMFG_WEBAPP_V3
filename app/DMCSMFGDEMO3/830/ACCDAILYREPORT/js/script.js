// action button
const SEARCH = $('#SEARCH');
const PRINT = $('#PRINT');
const CSV = $('#CSV');

// form
const form = document.getElementById('accDailyReport');

SEARCH.click(async function() {
    // check validate form
    if(!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
    await keepData();
});

PRINT.click(function() {
    return actionDialog(2);
});

CSV.click(function() {
    return actionDialog(3);
});

async function exportCSV() {
  // Variable to store the final csv data
    let date1 = '--/--/----';
    let date2 = '--/--/----';
    if($('#DATE1').val() != '') { date1 = $('#DATE1').val(); }
    if($('#DATE2').val() != '') { date2 = $('#DATE2').val(); }
    var csv_data = ['Date Range,' + date1 + ',-,' + date2];
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
        csv_data.push(csvrow.join(","));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(["\uFEFF" + csv_data], { type: 'text/csv;charset=utf-8;', });
    // console.log(CSVFile);
    const supportsFileSystemAccess =
    'showSaveFilePicker' in window &&
    (() => { try {
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
                types: [
                    {
                        description: 'CSV file',
                        accept: { 'application/csv': ['.csv'] },
                    },
                ],
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

async function printed() {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'PrintDailyReport');
  await axios.post('../ACCDAILYREPORT/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      if (response.status == '200') {
            let result = response.data;
            $.each(response.data,function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACCDAILYREPORT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACCDAILYREPORT');
    await axios.post('../ACCDAILYREPORT/function/index_x.php', data)
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
                return printed();
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
            // case 'date':
            //     inputs[i].value = '';
            //     break;
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
    // window.location.href = '../ACCDAILYREPORT/';
    $('#dvwdetail').empty();
    emptyTable();
    unRequried();

    return false;
}

function emptyTable() {
    for (var i = 1; i <= 18; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
}

// async function printed() {
//     await keepData();
//     var popupWindow = window.open('../ACCDAILYREPORT/print.php', '_blank', 'width=auto, height=auto');
//     setTimeout(function() { popupWindow.close(); }, 10000);
// }
