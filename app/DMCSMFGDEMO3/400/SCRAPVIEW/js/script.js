//input serach
const PROORDERNO = $('#PROORDERNO');

// search
const SEARCHPRODUCTIONORDER = $("#SEARCHPRODUCTIONORDER");

SEARCHPRODUCTIONORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPRODUCTIONORDER/index.php?page=SCRAPVIEW', 'authWindow', 'width=1200,height=600');});

// action button
const SEARCH = $('#SEARCH');

// form
const form = document.getElementById('scrapView');

PROORDERNO.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        $('#loading').show();
        if(PROORDERNO.val() == '') { unsetSession(form); return false; }
        return getSearch('PROORDERNO', PROORDERNO.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/SCRAPVIEW/index.php?'+code+'=' + value;        
}

SEARCH.click(function () {
    if(PROORDERNO.val() == '') {
      unsetSession(form);
      return false;
    }
    $('#loading').show();
    let action = document.createElement('input');
    action.setAttribute('name', 'action');
    action.setAttribute('value', 'searchPro');
    form.appendChild(action);
    form.submit();
});

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
    await axios.post('../SCRAPVIEW/function/index_x.php', data)
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
    data.append('systemName', 'ScrapView');
    await axios.post('../SCRAPVIEW/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

// Keep it because unset session data in page 
// async function programDelete() {
//     $('#loading').show();
//     let data = new FormData();
//     data.append('action', 'programDelete');
//     await axios.post('../SCRAPVIEW/function/index_x.php', data)
//     .then((response) => {
//           // console.log(response.data);
//           if(response.status == 200) {
//               return window.location.href = $('#sessionUrl').val() + '/home.php';
//           }
//           $('#loading').hide();
//       })
//     .catch((e) => {
//         console.log(e);
//         $('#loading').hide();
//     });
// }

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
  // $('#tableJob > tbody > tr').remove();
  // $('#tableScrap > tbody > tr').remove();
  // refresh
  // window.location.href = "index.php";
  window.location.href = '../SCRAPVIEW/';
  return false;
}

function unRequired() {
    document.getElementById('PROORDERNO').classList[document.getElementById('PROORDERNO').value !== '' ? 'remove' : 'add']('req');
}

function emptyRows(maxrow) {
    let rowcount =  $('.priceRow-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#tablePrice tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowPriceId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 35; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}