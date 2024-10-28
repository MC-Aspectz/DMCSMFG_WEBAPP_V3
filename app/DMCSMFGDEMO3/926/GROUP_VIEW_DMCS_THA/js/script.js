// action button
const view = $('#view');

const button_action = [view];

// form
const form = document.getElementById('grouprole');

for (const btn of button_action) {
  btn.click(function () {
    $('#loading').show();
  });
}

view.click(function () {
  return (window.location.href = '../GROUP_VIEW_DMCS_THA/');
});

async function action(action) {
  const data = new FormData(form);
  data.append('action', action);
  await axios
    .post('../GROUP_VIEW_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      console.log(response.data);
      if (action == 'reflect') {
        document.getElementById('loading').style.display = 'none';
      } else {
        window.location.reload();
      }
    })
    .catch((e) => {
      console.log(e);
    });
}

async function searchGrant(apppack, staffcd) {
  $('#loading').show();
  const data = new FormData(form);
  data.append('action', 'searchGrant');
  data.append('APPPACK', apppack);
  data.append('STAFFCD', staffcd);
  await axios
    .post('../GROUP_VIEW_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      $('#datagrant').html("");
      let countRow = 0;
      $.each(response.data, function (key, value) {
        // console.log(value['APPCD2']);
        $('#datagrant').append(
          '<tr class="border border-gray-600" id="rowId'+key+'">' +
            '<td class="h-6 w-3/12 pl-1 text-[12px] border border-slate-700 whitespace-nowrap">' + value["APPCD2"] + "</td>" +
            '<td class="h-6 w-6/12 pl-1 text-[12px] border border-slate-700 whitespace-nowrap">' + value["APPNAME2"] +  "</td>" +
            '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center">' +
            '<input type="hidden" id="APPCOMMITH' +  key + '" name="APPCOMMIT[]" value="F" />' +
            '<input type="checkbox" id="APPCOMMIT' + key + '" name="APPCOMMIT[]" value="T" onchange="chked(1, ' + key + ');" ' + (value["APPCOMMIT"] == "T" ? "checked" : "") + "/></td>" +
            '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center">' +
            '<input type="hidden" id="APPMODIFYH' + key +  '" name="APPMODIFY[]" value="F" />' +
            '<input type="checkbox" id="APPMODIFY' + key +'" name="APPMODIFY[]" value="T" onchange="chked(2, ' + key + ');" ' + (value["APPMODIFY"] == "T" ? "checked" : "") + "/>" + "</td>" +
            '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center">' +
            '<input type="hidden" id="APPDELETEH' + key + '" name="APPDELETE[]" value="F"/>' +
            '<input type="checkbox" id="APPDELETE' + key + '" name="APPDELETE[]" value="T" onchange="chked(3, ' + key + ');" ' + (value["APPDELETE"] == "T" ? "checked" : "") + "/>" +  "</td>" +
            '<td class="hidden"><input type="text" name="APPCODE2[]" value="' + value["APPCD2"] + '"></td>' +
            '<td class="hidden"><input type="text" name="APPNAME2[]" value="' + value["APPNAME2"] +'"></td>' +
            "</tr>"
        );
        countRow++;
      });
      // console.log(countRow);
      if (countRow < 15) {
        for (var i = countRow; i < 15; i++) {
          $('#datagrant').append(
            '<tr class="divide-y divide-gray-200">' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              '<td class="h-6 border border-slate-700"></td>' +
              "</tr>" );
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

async function keepData() {
  const data = new FormData(form);
  data.append('action', 'keepdata');
  await axios
    .post('../GROUP_VIEW_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession(form) {
  let data = new FormData();
  data.append('action', 'unsetsession');
  await axios
    .post('../GROUP_VIEW_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function programDelete() {
  $('#loading').show();
  let data = new FormData();
  data.append('action', 'programDelete');
  await axios
    .post('../GROUP_VIEW_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      return window.location.href = $('#sessionUrl').val() + '/home.php';
    })
    .catch((e) => {
      console.log(e);
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
  $('#tableGrant > tbody > tr').remove();

  // refresh
  window.location.href = '../GROUP_VIEW_DMCS_THA/';

  return false;
}

function chked(type, index) {
  // console.log(index);
  if (type == 1) {
    if (document.getElementById("APPCOMMIT" + index + "").checked) {
      document.getElementById("APPCOMMITH" + index + "").disabled = true;
    } else {
      document.getElementById("APPCOMMITH" + index + "").disabled = false;
    }
  } else if (type == 2) {
    if (document.getElementById("APPMODIFY" + index + "").checked) {
      document.getElementById("APPMODIFYH" + index + "").disabled = true;
    } else {
      document.getElementById("APPMODIFYH" + index + "").disabled = false;
    }
  } else {
    if (document.getElementById("APPDELETE" + index + "").checked) {
      document.getElementById("APPDELETEH" + index + "").disabled = true;
    } else {
      document.getElementById("APPDELETEH" + index + "").disabled = false;
    }
  }
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
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
        return programDelete();
      }
    }
  });
}

function expanded(index) {
  $("#apppack" + index + " .arrow-right").toggleClass("arrow-down");
  $("#staffView" + index + "")
    .stop()
    .slideToggle(500);
}

function selectView(index, apppack, staffcd, staffname, division) {
  $('.select').removeClass('selected');
  $('#selectView' + index + ' li').addClass('selected');
  $('#APPPACK').val(apppack);
  $('#STAFFCD').val(staffcd);
  $('#STAFFNAME').val(staffname);
  $('#DIVISIONNAME').val(division);
}

$(document).ready(function() {  
  $('#tableGrant').on('click', 'tr', function(e) { e.preventDefault();
    // $(this).removeAttr('id');
    $('table#tableGrant tbody tr').removeAttr('id');
    let item = $(this).closest('tr').children('td');
    // console.log($(this));
    // console.log(item.eq(0).text());
    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(itemacc.eq(0).text());
      $(this).attr('id', 'selected-row');
    }
  });
}); 
