// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');

// form
const form = document.getElementById('AccRPTFormSettingInq');

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

CSV.click(function() {
    return exportCSV();
});

async function getRptFormDtl(FORMROWNUM) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'getRptFormDtl');
    data.append('FORMROWNUM', FORMROWNUM);
    await axios.post('../ACC_RPTFORMSETTINGINQ/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#dvwdetail2').html('');
        let countRow = 0;
        let cacltyp;
        $.each(response.data,function(key, value) {
            if(value.CALC_TYP == 1) { cacltyp = '+'; } else { cacltyp = '-'; }
                $('#table_acc').append($('<tr class="divide-y divide-gray-200" id="rowIdB'+key+'">')
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(cacltyp))
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(value.ACC_CD))
                                .append($('<td class="h-6 border border-slate-700 pl-1 text-left">').append(value.ACC_NM))
                                .append($('<td class="hidden">').append(value.ACCSEQ))
                                .append($('<td class="hidden">').append(value.ACC_NM2))
                );
            countRow++;
        });
        // console.log(countRow);
        if(countRow < 15) {
           for (var i = countRow; i < 15; i++) {
                $('#table_acc').append($('<tr class="divide-y divide-gray-200" id="rowIdB'+i+'">')
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(''))
                                .append($('<td class="h-6 border border-slate-700 text-center">').append(''))
                                .append($('<td class="h-6 border border-slate-700 text-left">').append(''))
                );
           }
        }
        document.querySelector('#record2').innerText = countRow;
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}


async function exportCSV() {
  // Variable to store the final csv data
    let rptformtyp = document.getElementById("RPTFORMTYP");
    let rptformname = rptformtyp.options[rptformtyp.selectedIndex].text;
    var csv_data = ['Form Type,' + rptformname];
    // Get each row data
    var rows = document.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll("td, th");
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
        csv_data.push(csvrow.join(","));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(["\uFEFF" + csv_data], { type: "text/csv;charset=utf-8;", });
    // console.log(CSVFile);
    const supportsFileSystemAccess =
    "showSaveFilePicker" in window &&
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
                    description: "CSV file",
                    accept: { "application/csv": [".csv"] },
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
        if (err.name !== "AbortError") {
            console.error(err.name, err.message);
            return;
        }
    }
  }
    // Fallback if the File System Access API is not supported…
    // Create the CSVFile URL.
    const url = URL.createObjectURL(CSVFile);
    // Create the `<a download>` element and append it invisibly.
    const temp_link = document.createElement("a");
    temp_link.href = url;
    temp_link.download = suggestedName;
    temp_link.style.display = "none";
    document.body.append(temp_link);
    // Programmatically click the element.
    temp_link.click();
    // Revoke the CSVFile URL and remove the element.
    setTimeout(() => {
        URL.revokeObjectURL(url);
        temp_link.remove();
    }, 1000);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_RPTFORMSETTINGINQ/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_RPTFORMSETTINGINQ');

    await axios.post('../ACC_RPTFORMSETTINGINQ/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../ACC_RPTFORMSETTINGINQ/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        return window.location.href = $('#sessionUrl').val() + '/home.php';
    })
    .catch(e => {
        console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                unsetSession(form); 
                return programDelete();
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
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
            case 'checkbox':
                inputs[i].checked = false;
                break;
            case 'radio':
                inputs[i].checked = false;
                break;                
            default:
                inputs[i].value = '';
        }
    }
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

    // clearing table
    // $('#table_result > tbody > tr').remove();
    emptyTable();
    document.querySelector('#record').innerText = '0';
    document.querySelector('#record2').innerText = '0';
    // refresh
    // window.location.href = '../ACC_RPTFORMSETTINGINQ/';
    return false;
}

function emptyTable() {
    $('#dvwdetail').empty();
    for (var i = 1; i <= 15; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
    
    $('#dvwdetail2').empty();
    for (var x = 1; x <= 15; x++) {
        $('#dvwdetail2').append('<tr class="divide-y divide-gray-200" id="rowIdB'+x+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}

function digitFormat(num) {
    while (num.search(",") >= 0) {
        num = (num + "").replace(',', '');
    }
    return parseFloat(num).toFixed(6);
};

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}