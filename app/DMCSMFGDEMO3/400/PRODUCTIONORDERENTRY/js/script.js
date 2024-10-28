// search
const SEARCHPRODUCTIONORDER = $('#SEARCHPRODUCTIONORDER');
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHLOC = $('#SEARCHLOC');
const SEARCHWORKCENTER = $('#SEARCHWORKCENTER');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHSALEORDERDETAIL = $('#SEARCHSALEORDERDETAIL');
const PROCESSPATTERNGUIDE = $('#PROCESSPATTERNGUIDE');
const PROINSPTYP = $('#PROINSPTYP');

SEARCHPRODUCTIONORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPRODUCTIONORDER/index.php?page=PRODUCTIONORDERENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=PRODUCTIONORDERENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHWORKCENTER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHWORKCENTER/index.php?page=PRODUCTIONORDERENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=PRODUCTIONORDERENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHSALEORDERDETAIL.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDERDETAIL/index.php?page=PRODUCTIONORDERENTRY', 'authWindow', 'width=1200,height=600');});
PROCESSPATTERNGUIDE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/PROCESSPATTERNGUIDE/index.php?page=PRODUCTIONORDERENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=PRODUCTIONORDERENTRY&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});

//input serach
const PROORDERNO = $('#PROORDERNO');
const ITEMCD = $('#ITEMCD');
const LOCCD = $('#LOCCD');
const WCCD = $('#WCCD');
const STAFFCD = $('#STAFFCD');
const SALEORDERNOLN = $('#SALEORDERNOLN');
const ITEMPROPTNCD = $('#ITEMPROPTNCD');

// requried input
const PROFACTYP = $('#PROFACTYP');
const PROQTY = $('#PROQTY');
const PROPLANENDDT = $('#PROPLANENDDT');
const PROPLANSTARTDT = $('#PROPLANSTARTDT');

const input_serach = [PROORDERNO, ITEMCD, LOCCD, WCCD, STAFFCD, SALEORDERNOLN, ITEMPROPTNCD, PROPLANENDDT];
const serachIcon = [SEARCHPRODUCTIONORDER, SEARCHITEM, SEARCHLOC, SEARCHWORKCENTER, SEARCHSTAFF, SEARCHSALEORDERDETAIL, PROCESSPATTERNGUIDE];

// action button
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DEL = $('#DELETE');
const INSERTBAK = $('#INSERTBAK');

// form
const form = document.getElementById('productionOrderEntry');

for (const input of input_serach) {
    input.change(function () {
        keepData();
        $('#loading').show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            keepData();
            $('#loading').show();
        }
    });
}

for (const serach of serachIcon) {
    serach.click(function () {
        keepData();
    });
}

INSERT.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  inserted();
  // form.submit();
});

INSERTBAK.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  insertBack();
  // form.submit();
});

UPDATE.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  updated();
  // form.submit();
});

DEL.click(function () {
  // check validate item code
  if (ITEMCD.val() == '' || PROORDERNO.val() == '') {
    return false;
  }
  deleted();
  // form.submit();
});

PROORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('PROORDERNO', PROORDERNO.val());
    }
    // if(PROORDERNO.val() == '') unsetSession(form);
});

ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCD', ITEMCD.val());
    }
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getLoc(LOCCD.val(), $('#LOCTYP').val());
    }
});

WCCD.on('keyup change', function (e) {
    let WORKCD;
    if(WCCD.val() != '') { WORKCD = WCCD.val(); } else { WORKCD = '/'; }
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('WCCD', WORKCD);
    }
});

STAFFCD.on('keyup change', function (e) {
    let STAFFCODE;
    if(STAFFCD.val() != '') { STAFFCODE = STAFFCD.val(); } else { STAFFCODE = '/'; }
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCODE);
    }
});

SALEORDERNOLN.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SALEORDERNOLN', SALEORDERNOLN.val());
    }
});

PROPLANENDDT.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('PROPLANENDDT', PROPLANENDDT.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/PRODUCTIONORDERENTRY/index.php?'+code+'=' + value;        
}

async function inserted() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'insert');
    await axios.post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then((response)  => {
        // console.log(response.data);
        if(response.data['SYSMSG'] != 'WARN_BOM_COUNT_ZERO') {
          return clearForm(form);
        } else {
          $('#loading').hide();
          return getMessage(response.data['SYSMSG']);
        }
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function updated() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'update');
    await axios.post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if(response.data['SYSMSG'] != 'WARN_BOM_COUNT_ZERO') {
          return clearForm(form);
          // window.location.href='index.php';
        } else {
          $('#loading').hide();
          return getMessage(response.data['SYSMSG']);
        }
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function deleted() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'delete');
    await axios
    .post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        return clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
          // console.log(result);
          if(code == 'PROPLANENDDT') {
            var dt = moment(result['PROPLANSTARTDT'], 'YYYYMMDD');
            document.getElementById('PROPLANSTARTDT').value = dt.format('yyyy-MM-DD');
          } else {
            // console.log(code);
            $.each(result, function(key, value) {
              // console.log(key, '=>', value);
              if(document.getElementById(''+key+'')) {
                if(key == 'ONHAND' || key == 'AWAIT_TEST' || key == 'INV_OF_ORDER' || key == 'BACKLOG' || key == 'ALLOCATE') {
                  document.getElementById(''+key+'').value = num2digit(value);
                } else {
                  document.getElementById(''+key+'').value = value;
                }
              }
            });
          }
          // for (let key in result) {
          //   // console.log(key, '=>', result[key]);
          // }
        } else {
          if(code == 'SALEORDERNOLN') {
            document.getElementById('SALELNITEMNAME').value = '';
          }
        }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getLoc(LOCCD, LOCTYP) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('LOCCD', LOCCD);
    data.append('LOCTYP', LOCTYP);
    data.append('action', 'LOCCD');
    await axios.post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            document.getElementById('LOCCD').value = result.LOCCD;
            document.getElementById('LOCNAME').value = result.LOCNAME;           
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function insertBack() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'insertBak');
    await axios.post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let result = response.data;
        if(result['SYSMSG'] != 'WARN_BOM_COUNT_ZERO') {
          if (result != '') {
            return back(result['PROORDERNO']);
          }
          $('#loading').hide();
        } else {
          $('#loading').hide();
          return getMessage(response.data['SYSMSG']);
        }
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
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

async function back(PROORDERNO = '') {
    $('#loading').show();
    const appurl = $('#sessionUrl').val();
    let data = new FormData();
    data.append('PROGRAMDELETE', 'programDelete');
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
      if(response.status == 200) {
          // console.log(response.data);
        if(PROORDERNO != '') {
            return $.redirect($('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/ORDERBMENTRY/index.php', { PROORDERNO: PROORDERNO });
        } else {
            return window.history.back();
        }
      }
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function getMessage(code) {
    $('#loading').show();
    const appurl = $('#sessionUrl').val();
    const data = new FormData(form);
    data.append('CODE', code);
    data.append('MESSAGE', 'getMessage');
    await axios.post(appurl + '/common/setsession.php', data)
    .then(response => {
        // console.log(response.data);
        document.getElementById('loading').style.display = 'none';
        return actionDialog(response.data);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}


async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios
    .post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'PRODUCTIONORDERENTRY');
    await axios
    .post('../PRODUCTIONORDERENTRY/function/index_x.php', data)
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
      case 'checkbox':
        inputs[i].checked = false;
    }
  }
  // clearing selects
  var selects = form.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName('textarea');
  for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

  // clearing table
  $('#table_result > tbody > tr').remove();

  // refresh
  // if (form.id == 'productionOrderEntry') {
    // window.location.href = "index.php";
    window.location.href = '../PRODUCTIONORDERENTRY/';
  // }
  return false;
}

function unRequired() {

    document.getElementById('PROFACTYP').classList[PROFACTYP.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMCD').classList[ITEMCD.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('LOCCD').classList[LOCCD.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('WCCD').classList[WCCD.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('STAFFCD').classList[STAFFCD.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('PROQTY').classList[PROQTY.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('PROPLANENDDT').classList[PROPLANENDDT.val() != '' ? 'remove' : 'add']('req');
    document.getElementById('PROPLANSTARTDT').classList[PROPLANSTARTDT.val() != '' ? 'remove' : 'add']('req');
    // document.getElementById('SALEORDERNOLN').classList[SALEORDERNOLN.val() != '' ? 'remove' : 'add']('req');

    const LOCTYPE = document.getElementById('LOCTYP');
    if(LOCTYPE.selectedIndex != 0) {
        LOCTYPE.classList.remove('req');
        LOCTYP = LOCTYPE.value;
    } else {
        LOCTYPE.classList.add('req');
        LOCTYP = '';
    }
}