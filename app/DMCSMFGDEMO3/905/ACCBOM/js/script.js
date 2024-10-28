// search
const SEARCHACCOUNT = $('#SEARCHACCOUNT');

SEARCHACCOUNT.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?page=ACCBOM', 'authWindow', 'width=1200,height=600');});


//input serach
const ACCOUNTCD = $('#ACCOUNTCD');
const ACCGROUPTYP = $('#ACCGROUPTYP');

// action button
const SEARCH = $('#SEARCH');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

// form
const form = document.getElementById('accountcodetree');

SEARCH.click(function () {
    if(!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $('#loading').show();
});

SEARCHACCOUNT.click(function () {
  return keepData();
});

INSERT.click(function () {
  if(ACCOUNTCD.val() == '') {
    actionDialog(1);
    return false
  }
  return action('INSERT');
});

UPDATE.click(function () {
  if(ACCOUNTCD.val() == '') {
    actionDialog(1);
    return false
  }
  return action('UPDATE');
});

DELETE.click(function () {
  if(ACCOUNTCD.val() == '') {
    actionDialog(1);
    return false
  }
  return action('DELETE');
});

ACCGROUPTYP.change(function () {
  // if(ACCGROUPTYP.val() == '')
  //   return alertValidation();
  $('#loading').show();
  return window.location.href = 'index.php?ACCGROUPTYP=' + ACCGROUPTYP.val();
});

ACCOUNTCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        // keepData();
        if(ACCOUNTCD.val() == '') {
            actionDialog(1);
            return false
        }
        getAccCCd(ACCOUNTCD.val());
    }
});

async function action(action) {
  $('#loading').show();
  const data = new FormData(form);
  data.append("action", action);
  await axios
    .post("../ACCBOM/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      $('#datadvw').html('');
      let countRow = 0;
      $.each(response.data, function (key, value) {
        countRow++;
        $('#datadvw').append(
          '<tr class="divide-y divide-gray-200" id="rowId'+key+'">' +
            '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center">'+countRow+'</td>'+
            '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left">'+value.ACCOUNTCD+'</td>'+
            '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left">'+value.ACCOUNTNAME+'</td>'+
            '<td class="h-6 w-3/12 text-sm border border-slate-700"></td>' +
            '<td class="hidden">'+value.ACCOUNTCDID+'</td>' +
            '<td class="hidden"><input type="text" name="ACCOUNTCDIDA[]" value="' + value.ACCOUNTCDID +'"></td>' +
            '<td class="hidden"><input type="text" name="ACCOUNTCDA[]" value="' + value.ACCOUNTCD +'"></td>' +
            '<td class="hidden"><input type="text" name="ACCOUNTNAMEA[]" value="' + value.ACCOUNTNAME +'"></td>' +
          '</tr>'
        );
      });
      // console.log(countRow);
      if (countRow < 12) {
        for (var i = countRow; i < 12; i++) {
          $('#datadvw').append(
            '<tr class="divide-y divide-gray-200">' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
            '</tr>'
          );
        }
      }
      document.getElementById('rowCount').textContent = countRow;
      document.getElementById('loading').style.display = 'none';
      entry();
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function checkGroup() {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'checkGroup');
  await axios.post('../ACCBOM/function/index_x.php', data)
  .then(response => {
      // console.log(response.data);
      res = response.data;
  })
  .catch(e => {
    // console.log(e);
    document.getElementById('loading').style.display = 'none';
  });
}

async function getAccCCd(ACCOUNTCD) {
    $('#loading').show(); entry();
    const data = new FormData(form);
    data.append('action', 'getAccCCd');
    data.append('ACCOUNTCD', ACCOUNTCD);
    await axios.post('../ACCBOM/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // $('#ACCOUNTCD').val(response.data['ACCOUNTCD']);
        $('#ACCOUNTCD').val(response.data['ACCOUNTCD']);
        $('#ACCOUNTCDID').val(response.data['ACCOUNTCDID']);
        $('#ACCOUNTNAME').val(response.data['ACCOUNTNAME']);
        
        if(response.data['SYSMSG'] == 'ERRO_ACCOUNTREE_EXISTS' || response.data['SYSMSG'] == 'ERROR_NOSELECT_ACCPCD') {
            return getMessage(response.data['SYSMSG']);
        }

        if(response.data['ACCOUNTCD'] == '') {
            document.getElementById('INSERT').disabled = false;
            document.getElementById('UPDATE').disabled = true;
            document.getElementById('DELETE').disabled = true;
        }

        if(response.data['ACCOUNTCDID'] != '') {
            document.getElementById('INSERT').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;       
        }
        unRequired();
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
    });
}

async function searchC(DATA) {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'searchC');
  data.append('DATA', DATA);
  // console.log(DATA);
  await axios.post('../ACCBOM/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      $('#datadvw').html('');
      $('#DATA').val(DATA);
      $('#ACCOUNTCDID').val(DATA);
      let countRow = 0;
      $.each(response.data, function (key, value) {
        countRow++;
        $('#datadvw').append(
          '<tr class="divide-y divide-gray-200" id="rowId'+key+'">' +
            '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center">'+countRow+'</td>'+
            '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left">'+value.ACCOUNTCD+'</td>'+
            '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left">'+value.ACCOUNTNAME+'</td>'+
            '<td class="h-6 w-3/12 text-sm border border-slate-700"></td>' +
            '<td class="hidden">'+value.ACCOUNTCDID+'</td>' +
            '<td class="hidden"><input type="text" name="ACCOUNTCDIDA[]" value="' + value.ACCOUNTCDID +'"></td>' +
            '<td class="hidden"><input type="text" name="ACCOUNTCDA[]" value="' + value.ACCOUNTCD +'"></td>' +
            '<td class="hidden"><input type="text" name="ACCOUNTNAMEA[]" value="' + value.ACCOUNTNAME +'"></td>' +
          '</tr>'
        );
      });
      // console.log(countRow);
      if (countRow < 12) {
        for (var i = countRow; i < 12; i++) {
          $('#datadvw').append(
            '<tr class="divide-y divide-gray-200">' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
            '</tr>'
          );
        }
      }
      document.getElementById('rowCount').textContent = countRow;
      document.getElementById('loading').style.display = 'none';
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
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
    .post('../ACCBOM/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
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

async function unsetSession(form) {
  let data = new FormData();
  data.append('action', 'unsetsession');
  await axios
    .post('../ACCBOM/function/index_x.php', data)
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
  // window.location.href = '../ACCBOM/';
  $('#account_tree').empty('');
  emptyTable();

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

function emptyTable() {
    $('#datadvw').empty();
    for (var i = 1; i <= 12; i++) {
        $('#datadvw').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
    document.querySelector('#rowCount').innerText = '0';
}

function entry() {
  $('#ACCOUNTCD').val('');
  $('#ACCOUNTNAME').val('');
  $('#ACCOUNTCDID').val('');
  document.getElementById('INSERT').disabled = false;
  document.getElementById('UPDATE').disabled = true;
  document.getElementById('DELETE').disabled = true;
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: '',
    text: txt,
    // background: "#8ca3a3",
    showCancelButton: true,
    // confirmButtonColor: "silver",
    // cancelButtonColor: "silver",
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
      if (type == 1) {
        unsetSession();
        programDelete();
      }
    }
  });
}

function expanded(index, level) {
  if(level == 1) {
    $('#title' + index + ' .arrow-right').toggleClass('arrow-down');
    $('#accountView' + index + '').stop().slideToggle(500);
  } else if(level == 2) {
    $('#title1' + index + ' .arrow-right').toggleClass('arrow-down');
    $('#accountView1' + index + '').stop().slideToggle(500);
  } else if(level == 3) {
    $('#title2' + index + ' .arrow-right').toggleClass('arrow-down');
    $('#accountView2' + index + '').stop().slideToggle(500);
  } else if(level == 4) {
    $('#title3' + index + ' .arrow-right').toggleClass('arrow-down');
    $('#accountView3' + index + '').stop().slideToggle(500);
  } else if(level == 5) {

  }
}

function selectView(index) {
  $('.select').removeClass('selected');
  $('#selectView' + index + ' li').addClass('selected');
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