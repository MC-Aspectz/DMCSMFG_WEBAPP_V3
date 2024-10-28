// button search
const SEARCH = $('#SEARCH');

// action button
const CSV = $('#CSV');
const COMMIT = $('#COMMIT');
const DETAIL = $('#DETAIL');

// input search
const FROMDATE = $('#FROMDATE');
const PLANDT = $('#PLANDT');

// form
const form = document.getElementById('masterPlan');

FROMDATE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return changeCondition();
    }
});

PLANDT.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return changeCondition();
    }
});

COMMIT.click(function() {
    return commit();
});

DETAIL.click(function() {
    return $('#item_view').modal('show');
});

CSV.click(function() {
    return exportCSV();
});

async function commit() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'commit');
    await axios.post('../MASTERPLANVW/function/index_x.php', data)
    .then((response)  => {
        // console.log(response.data);
        clearForm(form);
        $("#loading").hide();
        // return window.location.href='index.php';
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function search() {
    $('#loading').show();
    setMonthCounter(); document.getElementById('DETAIL').disabled = true;
    const data = new FormData(form);
    data.append('action', 'search');
    await axios.post('../MASTERPLANVW/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let tbrow = 0;
        var setVw = response.data['setVw'];
        var setCol = response.data['setCol'];
        var search = response.data['search'];
        var langauge = response.data['langauge'];
        $('#tableResult').empty(); $('#tbodyModal').html(''); // $('#tbodyModal').empty();
        // -------------------------- Table header -------------------------- //
        // const table = document.getElementById('table');
        const body = document.getElementById('tableResult');
        const table = document.createElement('table');
        table.setAttribute('id', 'table');
        table.setAttribute('class', 'w-full border-collapse border border-slate-500 divide-gray-200 stripe detail_table');
        // table.className = 'table-head detail_table';
        const thead = document.createElement('thead');
        thead.setAttribute('class', 'bg-gray-50');
        const tr = document.createElement('tr');
        tr.setAttribute('class', 'border border-gray-600 csv');
        // modal
        // const tablemodal = document.getElementById('tabelModal');
        const tbodymodal = document.getElementById('tbodyModal');
        for(var i = 0; i < setVw.length; i++) {
            // console.log(i);
            // console.log(setVw[i]);
            // --------- Table Result ----------//
            let th = document.createElement('th')
            th.setAttribute('class', 'px-6 text-sm text-center border border-slate-700 whitespace-nowrap');
            // console.log(Object.hasOwn(langauge, setVw[i]));
            th.textContent = Object.hasOwn(langauge, setVw[i]) ? langauge[setVw[i]] : setVw[i];
            tr.append(th);
            // ------------------------------- //
            // ------------ modal ------------ //
            var rowModal = document.createElement('tr');
            rowModal.setAttribute('class', 'h-6 text-sm divide-y divide-gray-200');
            var cellModal = document.createElement('td');
            cellModal.setAttribute('class', 'h-6 text-sm border border-slate-700');
            var cellTextModal = document.createTextNode(Object.hasOwn(langauge, setVw[i]) ? langauge[setVw[i]] : setVw[i]);
            cellModal.appendChild(cellTextModal);
            rowModal.appendChild(cellModal);
            // tbodymodal.appendChild(rowModal);
            // ------------ Data ------------ //
            var cellModalData = document.createElement('td');
            cellModalData.setAttribute('id', 'Mdata' + i);
            // var cellTextModalData = document.createTextNode('');
            // cellModalData.appendChild(cellTextModalData);
            rowModal.appendChild(cellModalData);
            tbodymodal.appendChild(rowModal);
            // tablemodal.appendChild(tbodymodal);
            $('#viewCount').html(setVw.length);
            // ------------------------------------
        }
        thead.append(tr);
        table.append(thead);
        // -------------------------- Data -------------------------- //
        var tbody = document.createElement('tbody');
        tbody.setAttribute('class', 'divide-y divide-gray-200 flex-none');
        $.each(search, function(key, value) {
            // console.log(key);
            tbrow = key;
            var row = document.createElement('tr');
            row.setAttribute('class', 'divide-y divide-gray-200 csv row-id');
            $.each(setCol, function(n, index) {
                // console.log(index);
                // console.log(value[''+index+'']);
                var cell = document.createElement('td');
                if(n < 3) {
                    cell.setAttribute('class', 'h-6 text-sm border border-slate-700 px-2 whitespace-nowrap');
                } else {
                    cell.setAttribute('class', 'h-6 text-sm border border-slate-700 px-2 text-right whitespace-nowrap');
                }
                var cellText = document.createTextNode(value[''+index+'']);
                cell.appendChild(cellText);
                row.appendChild(cell);
            });
            tbody.appendChild(row);
        });

        if(tbrow < 23) {
            // console.log(tbrow);
            for(let i = tbrow; i < 23; i++) {
                var rowNull = document.createElement('tr');
                rowNull.setAttribute('class', 'divide-y divide-gray-200');
                for(let x = 1; x <= setVw.length; x++) {
                    var cellNull = document.createElement('td');
                    cellNull.setAttribute('class', 'h-6 text-sm border border-slate-700 px-2 whitespace-nowrap');
                    rowNull.appendChild(cellNull);
                }
                tbody.appendChild(rowNull);
            }
        }

        table.appendChild(tbody);
        body.appendChild(table);
        // ------------------------------------------------------------- //
        // -------------------------- DataTable -------------------------- //
        $('#table').DataTable({
            scrollY: '620.0px',
            scrollX: true,
            scrollCollapse: true,
            searching: false,
            responsive: true,
            processing: false,
            fixedHeader: true,
            ordering: false,
            paging: false,
            info: false,
            fixedColumns:   {
                leftColumns: 4,
                // rightColumns: 1,
                // start: 1, // end: 4,
            },
            language: {
              emptyTable: ' ',
              infoEmpty: ' '
            },
            columnDefs: [{ width: 100, targets: '_all' }],
            createdRow: function(row, data, dataIndex) {
                // $(row).addClass('table-warning');
            },
            initComplete: function() {
                // console.log(tbrow);
                // console.log(setVw.length);
                // createEmptyRow(tbrow, setVw.length);
            },
        });
        selectRow(setVw.length);
      // ---------------------------------------------------------------- //
      $('#rowCount').html(tbrow);
      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

function selectRow(tbCount) {
    // console.log(tbCount);
    $('table#table tr').click(function () {
        let id = ''; $('table#table tr').not(this).removeClass('selected');
        let item = $(this).closest('tr').children('td');
        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            document.getElementById('DETAIL').disabled = false;
            let detailpTb = document.getElementById('table');
            let row = detailpTb.getElementsByTagName('tr');
            $('.row-id').each(function (i) {
            // console.log(i);
            $('#Mdata'+i+'').html(' ');
                row[i+1].classList.remove('selected');
            }); 
            if (!$(this).hasClass('active')) {
                $(this).addClass('selected');
                for(var z = 0; z < tbCount; z++) {
                    $('#Mdata'+z+'').html(item.eq(z).text());
                }
            }
        } else {
            document.getElementById('DETAIL').disabled = true;
        }
    });
}

async function exportCSV() {
    // Variable to store the final csv data
    let FROMDATE = '--/--/----';
    let PLANDT = '--/--/----';
    let checkedkaku;
    let startdate = document.getElementById('STARTDATE');
    let stdate = (startdate.innerText || startdate.textContent);
    let kakuteitorikom = document.getElementById('KAKU');
    let kaku = (kakuteitorikom.innerText || kakuteitorikom.textContent);
    let saleplantxt = document.getElementById('SALE_PLAN_TXT');
    let saleplan = (saleplantxt.innerText || saleplantxt.textContent);
    let kakut = document.getElementById('KAKUTEITORIKOM');
    if(kakut.checked) { checkedkaku = 'T';  } else { checkedkaku = 'F'; }
    // console.log(stdate);
    if($('#FROMDATE').val() != '') { FROMDATE = $('#FROMDATE').val(); }
    if($('#PLANDT').val() != '') { PLANDT = $('#PLANDT').val(); }
    var csv_data = [stdate + ',' + FROMDATE + ',' + checkedkaku + ',' + kaku + ',' + PLANDT + ',' + saleplan];
    // Get each row data
    var rows = document.getElementsByClassName('csv');
    // console.log(rows.length);
    for (var i = 1; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('th, td');
        // Stores each csv row datad
        var csvrow = [];
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            csvrow.push("\""+el.innerText+"\"");
        });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

function createEmptyRow(rowCount, colspan) {
    // if(rowCount < 16) {
    //     for(let i = rowCount; i < 16; i++) {
    //         var newRow = $('<tr class="divide-y divide-gray-200">');
    //         var cols = '';
    //         for(let x = 1; x <= colspan; x++) {
    //             cols += '<td class="h-6 border border-slate-700"></td>';
    //         }
    //         newRow.append(cols);
    //         $('#table tbody').append(newRow);
    //     }
    // }
    // for(let i = rowCount; i < 16; i++) {
    //     // console.log(i);
    //     $('#table tbody').append('<tr class="divide-y divide-gray-200"><td class="h-6 border border-slate-700" colspan="'+colspan+'"></td></tr>');
    // }             
}

async function changeCondition() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'changeCondition');
    await axios.post('../MASTERPLANVW/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: '',
    text: txt,
    showCancelButton: type != 3 ? true : false,
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return closeApp($('#appcode').val()); 
        } else if (type == 2) {
            // $("#loading").show();
        } else {
        // 
        }
    }
  });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../MASTERPLANVW/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
    });
}


async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'MasterPlan');
    await axios.post('../MASTERPLANVW/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
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
            case 'text':
        inputs[i].value = '';
        break;
      case 'checkbox':
        inputs[i].checked = false;
        break;
    }
  }
  // clearing selects
  var selects = form.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName('textarea');
  for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

  // clearing table
  // $('#table > tbody > tr').remove();
  // refresh
  // window.location.href = "index.php";
  window.location.href = '../MASTERPLANVW/';
  return false;
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
  return num.replace(/[^0-9.,]/g, "").replace(/(\..*?)\..*/g, "$1");
}

function setMonthCounter() {
    let MONTHCTR;
    if(document.getElementById('ONEMONTH').checked) {
        MONTHCTR = 1;
    } else if (document.getElementById('TWOMONTH').checked) {
        MONTHCTR = 2;
    } else if (document.getElementById('THREEMONTH').checked) {
        MONTHCTR = 3;    
    } else if (document.getElementById('FOURMONTH').checked) {
        MONTHCTR = 4;    
    } else if (document.getElementById('FIVEMONTH').checked) {
        MONTHCTR = 5;    
    } else if (document.getElementById('SIXMONTH').checked) {
        MONTHCTR = 6;    
    } else {
        MONTHCTR = 1;
        document.getElementById('ONEMONTH').checked = true;
    }

    $('#MONTHCTR').val(MONTHCTR);
    // console.log(MONTHCTR);
}
