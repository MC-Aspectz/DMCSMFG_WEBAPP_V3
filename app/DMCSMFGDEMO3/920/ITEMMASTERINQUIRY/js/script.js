// form
const form = document.getElementById('itemmasterinquiry');

// button
const CLOSEPAGE = $("#CLOSEPAGE");

// guide
const SEARCHITEM1 = $("#SEARCHITEM1");
const SEARCHITEM2 = $("#SEARCHITEM2");
const SEARCHCATALOG = $("#SEARCHCATALOG");
const SEARCHSUPPLIER = $("#SEARCHSUPPLIER");
const SEARCHSTORAGE = $("#SEARCHSTORAGE");

SEARCHITEM1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ITEMMASTERINQUIRY&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHITEM2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ITEMMASTERINQUIRY&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=ITEMMASTERINQUIRY', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ITEMMASTERINQUIRY', 'authWindow', 'width=1200,height=600');});
SEARCHSTORAGE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTORAGE/index.php?page=ITEMMASTERINQUIRY', 'authWindow', 'width=1200,height=600');});

const search_icon = [ SEARCHITEM1, SEARCHITEM2, SEARCHCATALOG, SEARCHSUPPLIER, SEARCHSTORAGE ]

for (const icon of search_icon) {
    icon.click(function () {
      keepData();
    });
  }

// onchange + req
const CATALOGCD = $("#CATALOGCD");
const SUPPLIERCD = $("#SUPPLIERCD");
const STORAGECD = $("#STORAGECD");

// onchange
const input_search = [CATALOGCD, SUPPLIERCD, STORAGECD];

for (const input of input_search) {
    input.on('keyup change', function (e) {
      if (e.type === 'change') {
        $('#loading').show();
      } else if (e.key === 'Enter' || e.keyCode === 13) {
        $('#loading').show();
      }
    });
}

CATALOGCD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('CATALOGCD', CATALOGCD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('CATALOGCD', CATALOGCD.val());
    }
    if (CATALOGCD.val() == '') unsetSession(form);
});

SUPPLIERCD.on('keyup change', function (e) {
    if (e.type === 'change') {
        return getSearch('SUPPLIERCD', SUPPLIERCD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
        return getSearch('SUPPLIERCD', SUPPLIERCD.val());
    }
    if (SUPPLIERCD.val() == '') unsetSession(form);
});

STORAGECD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('STORAGECD', STORAGECD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('STORAGECD', STORAGECD.val());
    }
    if (STORAGECD.val() == '') unsetSession(form);
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/ITEMMASTERINQUIRY/index.php?'+code+'=' + value;
}

// insrts.click(function() {
//     // check validate form
//     if (!form.reportValidity()) {
//         validationDialog();
//         return false;
//     }
//     return commit('insert');
// });

// updte.click(function() {
//     return commit('update');
// });

// deletes.click(function() {
//     return commit('deletes');
// });

CLOSEPAGE.click(function() {
    return programDelete();
});


$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr("id", "selected-row");
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
       // $('#WHTAXTYPE').val(item.eq(0).text());
        $('#ITEMNAME').val(item.eq(1).text());
        $('#ITEMSEARCH').val(item.eq(2).text());
     //  $('#ACC_CD2').val(item.eq(3).text());
        $('#ITEMTYP').val(item.eq(4).text());
        $('#ITEMBOI').val(item.eq(6).text());
        
       
        
        //document.getElementById("insert").disabled = false;
        //document.getElementById("update").disabled = false;
        //document.getElementById("delete").disabled = true;
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();
    }
});

async function searchs() {
    $('#loading').show(); 
    form.submit();
}

async function commit(method) {
    let data = new FormData(form);
    data.append('action', method);

    await axios.post('../ITEMMASTERINQUIRY/function/index_x.php', data)
    .then(response => {
        console.log(response.data)
        window.location.href='index.php?refresh=1';
        // clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

async function exportCSV() {
    // Variable to store the final csv data
    var csv_data = ['Item,' + ITEMCD1.val() + ',-,' + ITEMCD2.val() +'Type of Item', + ITEMTYP.val() + 'Catgory Code',+ CATALOGCD.val()];

    // Get each row data
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
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
}

async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(["\uFEFF"+csv_data], { type: "text/csv;charset=utf-8;"});
    // console.log(CSVFile);
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

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ITEMMASTERINQUIRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ITEMMASTERINQUIRY');

    await axios.post('../ITEMMASTERINQUIRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
    $('#loading').show();
    const appcode = $('#appcode').val();
    const appurl = $('#sessionUrl').val();
    let data = new FormData();
    data.append('FAPPCD', appcode);
    data.append('PROGRAMDELETE', 'programDelete');
    await axios.post(appurl + '/common/setsession.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(result['APPOPEN'] > 0) {
            return window.close();
        } else {
            return window.location.href = $('#sessionUrl').val() + '/home.php';
        }
        document.getElementById('loading').style.display = 'none';    
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
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
    // $('#search_table > tbody > tr').remove();
    // emptyRow();
    // refresh
    window.location.href = '../ITEMMASTERINQUIRY/';
    return false;
}

function emptyRow() {
    for (var i = 0; i < 10; i++) {
        $("table tbody").append('<tr class="tr_border table-secondary">' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +  
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' + 
                                '<td class="td-class"></td>' +  
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +  
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' + 
                                '<td class="td-class"></td>' +  
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +  
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' + 
                                '<td class="td-class"></td>' +                          
                                '<td class="td-class"></td></tr>');
    }
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
                // window.location.href="/DMCS_WEBAPP";          
            }
        }
    });
}

// function getMachineId() {
//     let machineId = localStorage.getItem('MachineId');

//     if (!machineId) {
//         machineId = crypto.randomUUID();
//         localStorage.setItem('MachineId', machineId);
//     }  
//     return machineId.toUpperCase();
// }