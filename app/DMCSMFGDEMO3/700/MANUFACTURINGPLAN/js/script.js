// form
const form = document.getElementById('mfg_plan_entry');

// action button
const OK = $('#OK');
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const REMAKE = $('#REMAKE');

// button search
const SEARCHITEM = $('#SEARCHITEM');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=MANUFACTURINGPLAN', 'authWindow', 'width=1200,height=600');});

//search button
const search_guide = [SEARCHITEM];

//input search
const ITEMCODE = $('#ITEMCODE');

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    submitSearch();
});

COMMIT.click(function() {
    return action('commit');
});

ITEMCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCODE', ITEMCODE.val());
    }
});

// async function getSearch(code, value) {
//     $('#loading').show();
//     return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/700/MANUFACTURINGPLAN/index.php?'+code+'=' + value;        
// }

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../MANUFACTURINGPLAN/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                } 
            });
            return submitSearch(); 
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function submitSearch() {
    $('#loading').show();
    const form = document.getElementById('mfg_plan_entry');
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../MANUFACTURINGPLAN/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
          if(response.data != 'ERRO:ERRORUNCHECK') {
            return clearForm(form);
          } else {
            $('#loading').hide();
            return errorDialog();
          }
        }
        $('#loading').hide();
    })
    .catch(e => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../MANUFACTURINGPLAN/function/index_x.php', data)
      .then((response) => {
        // console.log(response.data);
      })
      .catch((e) => {
        // console.log(e);
        $('#loading').hide();
      });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../MANUFACTURINGPLAN/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'MANUFACTURINGPLAN');
    await axios.post('../MANUFACTURINGPLAN/function/index_x.php', data)
      .then((response) => {
        // console.log(response.data)
        clearForm(form);
      })
      .catch((e) => {
        // console.log(e);
        $('#loading').hide();
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
    window.location.href = 'index.php';

    return false;
}

function changeRowId() {
    var elem = document.getElementsByTagName('tr');
    for (var i = 0; i < elem.length; i++) {
      // console.log(i);
      if (elem[i].id) {
        index_x = Number(elem[i].rowIndex);
        elem[i].id = 'rowId' + index_x;
      }
    }
}

function emptyRow(n) {
  $('#table tbody').append( '<tr class="divide-y divide-gray-200 row-empty" id="rowId'+ n +'">' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td>' +
                            '<td class="h-6 border border-slate-700"></td></tr>');
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 7; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

async function unsetItemData(lineIndex) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'MANUFACTURINGPLAN');
    data.append('lineIndex', lineIndex);
    await axios.post('../ORDERROUTINGENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: '',
    showCancelButton: true,
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            unsetSession(form);
            return closeApp($('#appcode').val()); 
        } else {
        // 
        }
    }
  });
}

function entry() {

  $('#ROWNO').val('');
  $('#MANUPLANCOMB').val('');
  $('#MANUFACTURINGPLANCODE').val('');
  $('#MANUFACTURINGPLANQTY').val('');
  $('#MANUFACTURINGPLANNOTE').val('');

  document.getElementById('DIVISIONTYP').value = '';

  document.getElementById('OK').disabled = false;
  document.getElementById('UPDATE').disabled = true;
  document.getElementById('DELETE').disabled = true;

  return unRequired();
}

function unRequired(){

  let ITEMCODE = document.getElementById('ITEMCODE');
  let MANUFACTURINGPLANQTY = document.getElementById('MANUFACTURINGPLANQTY');
  ITEMCODE.classList[ITEMCODE.value !== '' ? 'remove' : 'add']('req');
  MANUFACTURINGPLANQTY.classList[MANUFACTURINGPLANQTY.value !== '' ? 'remove' : 'add']('req');

}