// form
const form = document.getElementById('accRPTAssetDeplist');

// button
const SEARCH = $("#SEARCH");
const CSV = $("#CSV");
const CLOSEPAGE = $("#CLOSEPAGE");

// guide
const ASSETACCGUIDE = $("#ASSETACCGUIDE");

ASSETACCGUIDE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETACCGUIDE/index.php?page=ACC_RPTASSETDEPLIST', 'authWindow', 'width=1200,height=600');});

const search_icon = [ASSETACCGUIDE];

for(const icon of search_icon){
    icon.click(async function () {
       await keepData();
    });
};

// onchange 
const GA1 = $("#GA1");

const input_search = [GA1];

for (const input of input_search) {
    input.on('keyup change', function (e) {
      if (e.type === 'change') {
        $('#loading').show();
      } else if (e.key === 'Enter' || e.keyCode === 13) {
        $('#loading').show();
      }
    });
}

GA1.on('keyup change', function (e) {
    if (e.type === 'change') {
        keepData();
        return getSearch('GA1', GA1.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        return getSearch('GA1', GA1.val());
    }
    if (GA1.val() == '') unsetSession(form);
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACC_RPTASSETDEPLIST/index.php?'+code+'=' + value;
}


CLOSEPAGE.click(function () {
  return programDelete();
});



SEARCH.click(async function() {
    // check validate form
    $("#loading").show();
    await keepData();
    // return actionDialog(2);
});

CSV.click(function() {
    return exportCSV();
});


async function getAssetGName() {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', 'getAssetGName');
    data.append('ASSETACC', $('#GA1').val());
    await axios.post('../ACC_RPTASSETDEPLIST/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            var res = response.data;
            $('#GA1').val(res.GA1);
            $('#GANAME').val(res.GANAME);
        }
    })
    .catch(e => {
        // console.log(e);
        $("#loading").hide();
    });
}

async function exportCSV() {
  // Variable to store the final csv data
    let year = document.getElementById("YEAR");
    let yearname = year.options[year.selectedIndex].text;
    var csv_data = ['Fiscal Period,' + yearname + ',Asset Group Code,' + $('#GA1').val() + ',' + $('#GANAME').val()];
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
    csv_data.push('JAN,' + $('#JANTTL').val() + ',FEB,' + $('#FEBTTL').val() + ',MAR,' + $('#MARTTL').val() + ',APR,' + $('#APRTTL').val() + ',MAY,' + $('#MAYTTL').val() + ',JUN,' + $('#JUNTTL').val());
    csv_data.push('JUL,' + $('#JULTTL').val() + ',AUG,' + $('#AUGTTL').val() + ',SEP,' + $('#SEPTTL').val() + ',OCT,' + $('#OCTTTL').val() + ',NOV,' + $('#NOVTTL').val() + ',DEC,' + $('#DECTTL').val());
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

    await axios.post('../ACC_RPTASSETDEPLIST/function/index_x.php', data)
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
    data.append('systemName', 'ACC_RPTASSETDEPLIST');

    await axios.post('../ACC_RPTASSETDEPLIST/function/index_x.php', data)
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

    await axios.post('../ACC_RPTASSETDEPLIST/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href = $("#sessionUrl").val() + "/home.php";
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
                programDelete();
                // unsetSession(form); 
                // window.location.href="/DMCS_WEBAPP";  
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

    // refresh
    window.location.href = '../ACC_RPTASSETDEPLIST/';

    return false;
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