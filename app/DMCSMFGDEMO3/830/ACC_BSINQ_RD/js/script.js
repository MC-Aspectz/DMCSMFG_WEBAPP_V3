// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');
const PRINT = $('#PRINT');

// form
const form = document.getElementById('accBalanceSheetRd');

SEARCH.click(async function() {
    // check validate form
    if(!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
    await keepData();
    // return actionDialog(2);
});

PRINT.click(function() {
    return actionDialog(2);
});

CSV.click(function() {
    return actionDialog(3);
});

async function exportCSV() {
  // Variable to store the final csv data
    let year = document.getElementById('YEAR');
    let yearname = year.options[year.selectedIndex].text;
    let month = document.getElementById('MONTH');
    let monthname = month.options[month.selectedIndex].text;
    let year2 = document.getElementById('YEAR2');
    let yearname2 = year2.options[year2.selectedIndex].text;
    let month2 = document.getElementById('MONTH2');
    let monthname2 = month2.options[month2.selectedIndex].text;
    // let accy = document.getElementById("ACCY");
    // let accyname2 = accy.options[accy.selectedIndex].text;
    var csv_data = ['Period,' + yearname + ',' + monthname + ',→,' + yearname2 + ',' + monthname2];
    // Get each row data
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        [...cols].forEach((el) => {
            // if (el.innerText.length > 0) {
                // console.log(el.innerText);
                csvrow.push("\""+el.innerText+"\"");
            // }
        });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(','));
    }
    csv_data.push('All the data is coming from General ledger.')
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(['\uFEFF' + csv_data], { type: 'text/csv;charset=utf-8;', });
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
  data.append('action', 'Print_BS');
  await axios.post('../ACC_BSINQ_RD/function/index_x.php', data)
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

// async function printed(type) {
//     await keepData();
//     if(type == 'BS') {
//         var popupWindow = window.open('../ACC_BSINQ_RD/print.php', '_blank', "width=800, height=800");
//     }
//     setTimeout(function() { popupWindow.close(); }, 10000);
// }

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_BSINQ_RD/function/index_x.php', data)
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
    data.append('systemName', 'ACC_BSINQ_RD');
    await axios.post('../ACC_BSINQ_RD/function/index_x.php', data)
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
                // return printed('BS');
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
    window.location.href = '../ACC_BSINQ_RD/';

    return false;
}