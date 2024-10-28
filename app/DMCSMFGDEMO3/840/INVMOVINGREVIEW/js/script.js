// form
const form = document.getElementById('inv_moving_review');

// button search
const SEARCH = $("SEARCH");

// guide
const SEARCHITEM = $("#SEARCHITEM");

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=INVMOVINGREVIEW', 'authWindow', 'width=1200,height=600');});

const search_icon = [SEARCHITEM];

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

// onchange
const COM_CCODE = $("#COM_CCODE");
const COMPANYNAME = $("#COMPANYNAME");
const COMPANY_MD = $("#COMPANY_MD");
const TAXID = $("#TAXID");
const ITEMCODE = $("#ITEMCODE");
const ITEMNAME = $("#ITEMNAME");
const ITEMSPEC = $("#ITEMSPEC");
const ONHAND = $("#ONHAND");
const BACKLOG = $("#BACKLOG");
const FROMDATE = $("#FROMDATE");
const TODATE = $("#TODATE");

// onchange
const input_search = [ITEMCODE];

// SEARCHITEM.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php');

for (const input of input_search) {
    input.on('keyup change', function (e) {
      if (e.type === 'change') {
        $('#loading').show();
      } else if (e.key === 'Enter' || e.keyCode === 13) {
        $('#loading').show();
      }
    });
  }

  ITEMCODE.on('keyup change', function (e) {
    if (e.type === 'change') {
        keepData();
        return getSearch('ITEMCODE', ITEMCODE.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();      
        return getSearch('ITEMCODE', ITEMCODE.val());
    }
    if (ITEMCODE.val() == '') unsetSession(form);

  });


  async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/840/INVMOVINGREVIEW/index.php?'+code+'=' + value;
  }
// ITEMCODE.change(function() {
//     keepData();
//     window.location.href="index.php?ITEMCODE=" + ITEMCODE.val();
// });

// ITEMCODE.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         keepData();
//         window.location.href="index.php?ITEMCODE=" + ITEMCODE.val();
//     }
// })

// action button
const PRINT = $("#PRINT");
const CSV = $("#CSV");






SEARCH.click(async function() {
    $('#loading').show();
    await keepData();
  });

  PRINT.click(function() {
    return actionDialog(2);
});

CSV.click(function() {
    return actionDialog(3);
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
    // Variable to store the final csv data
    var fromdate = "--/--/----";
    var todate = "--/--/----";
    if(FROMDATE.val()!='')
    {
        fromdate = formatDate(FROMDATE.val());
    }
    if(TODATE.val()!='')
    {
        todate = formatDate(TODATE.val());
    }
                console.log(COM_CCODE.val());
    var csv_data = [COM_CCODE.val() + ',\n' 
                + COMPANYNAME.val() + ',' + COMPANY_MD.val(),',TAX ID NO,' + TAXID.val() + ',\n'
                + 'Item Code,' + ITEMCODE.val() + ',' + ITEMNAME.val() + ',' + ITEMSPEC.val() + ',\n'
                + 'On-hand,' + ONHAND.val() + ',Backlog,' + BACKLOG.val() + ',\n'
                + 'Date Range,' + fromdate + ',→,' + todate];
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
            csvrow.push(cols[j].innerHTML);
        }
        // Combine each column value with comma
        csv_data.push(csvrow.join(","));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file 
    await handleSaveAsFile(csv_data);
    // console.log(csv_data);
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

    await axios.post('../INVMOVINGREVIEW/function/index_x.php', data)
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

    await axios.post('../INVMOVINGREVIEW/function/index_x.php', data)
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
    window.location.href = '../INVMOVINGREVIEW/';
 
    return false;
}



function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/840/INVMOVINGREVIEW/index.php?'+code+'=' + result;
}

async function programDelete() {
    $("#loading").show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../INVMOVINGREVIEW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        return window.location.href = $("#sessionUrl").val() + "/home.php";
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
            } else if(type == 2) {
                return printed();
            }

        }
    });
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'PrintReport');
    await axios.post('../INVMOVINGREVIEW/function/index_x.php', data)
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
 

function printReport() {   
    var popupWindow = window.open('../INVMOVINGREVIEW/print.php', '_blank', 'width=auto, height=auto');
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

    await axios.post('../INVMOVINGREVIEW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
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