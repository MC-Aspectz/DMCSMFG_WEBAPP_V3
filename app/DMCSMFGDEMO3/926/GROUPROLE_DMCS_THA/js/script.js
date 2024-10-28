//input
const GROUPCD = $('#GROUPCD');
const APPCD1 = $('#APPCD1');
const APPCD2 = $('#APPCD2');

// action button
const grant = $('#grant');
const grant_all = $('#grant-all');
const revoke_all = $('#revoke-all');
const revoke = $('#revoke');
const CSV = $('#CSV');
const reflect = $('#reflect');

const button_action = [grant, grant_all, revoke_all, revoke, reflect];

// form
const form = document.getElementById('grouprole');

for (const btn of button_action) {
  btn.click(function () {
    $('#loading').show();
  });
}

grant.click(function () {
  if (APPCD1.val() != '') {
    return action('grant');
  } else {
    document.getElementById('loading').style.display = 'none';
  }
});

grant_all.click(function () {
  return action('grantAll');
});

revoke_all.click(function () {
  return action('revokeAll');
});

revoke.click(function () {
  if (APPCD2.val() != '') {
    return action('revoke');
  } else {
    document.getElementById('loading').style.display = 'none';
  }
});

reflect.click(function () {
  // keepData();
  return action('reflect');
});

CSV.click(function () {
  return exportCSV();
});

async function searchs() {
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  $('#loading').show();
  // form.submit();
}

async function action(action) {
  const data = new FormData(form);
  data.append('action', action);
  await axios
    .post('../GROUPROLE_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      console.log(response.data);
      if (action == 'reflect') {
        document.getElementById('loading').style.display = 'none';
      } else {
        window.location.reload();
      }
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function exportCSV() {
  // Variable to store the final csv data
  let apppack = document.getElementById('APPPACK');
  let appname = apppack.options[apppack.selectedIndex].text;
  var csv_data = ['Group Name,' + GROUPCD.val() + ',Package Name,' + appname];
  // Get each row data
  var rows = document.getElementsByTagName('tr');
  for (var i = 0; i < rows.length; i++) {
    // Get each column data
    var cols = rows[i].querySelectorAll('td, td [type="checkbox"], th');
    // Stores each csv row datad
    var csvrow = [];
    [...cols].forEach((el) => {
      if (el.innerText.length > 0) {
        // console.log(el.innerText);
        csvrow.push(el.innerText);
      } else {
        if (el.checked != undefined) {
          // console.log(el.checked);
          csvrow.push(el.checked);
        }
      }
    });
    // console.log(csvrow);
    // Combine each column value with comma
    csv_data.push(csvrow.join(','));
  }
  // Combine each row data with new line character
  csv_data = csv_data.join("\n");
  // Call this function to download csv file
  // console.log(csv_data);
  await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
  CSVFile = new Blob(['\uFEFF' + csv_data], {
    type: 'text/csv;charset=utf-8;',
  });
  // console.log(CSVFile);
  const supportsFileSystemAccess =
    'showSaveFilePicker' in window &&
    (() => {
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
        types: [
          {
            description: 'CSV file',
            accept: { 'application/csv': ['.csv'] },
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

  await axios
    .post('../GROUPROLE_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession(form) {
  let data = new FormData();
  data.append('action', 'unsetsession');

  await axios
    .post('../GROUPROLE_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function programDelete() {
  $('#loading').show();
  let data = new FormData();
  data.append('action', 'programDelete');
  await axios
    .post('../GROUPROLE_DMCS_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      return window.location.href = $('#sessionUrl').val() + '/home.php';
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
  window.location.href = '../GROUPROLE_DMCS_THA/';

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
    title: '',
    text: txt,
    // background: '#8ca3a3',
    showCancelButton: true,
    // confirmButtonColor: 'silver',
    // cancelButtonColor: 'silver',
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

$('table#tableAvilavle tr').click(function () {
  $('table#tableAvilavle tr').removeAttr('id');

  $(this).attr('id', 'selected-row');

  let item1 = $(this).closest('tr').children('td');

  if (item1.eq(0).text() != 'undefined' && item1.eq(0).text() != '') {
    // console.log(item1.eq(0).text());
    $('#APPCD1').val(item1.eq(0).text());
  }
});

$('table#tableGrant tr').click(function () {
  $('table#tableGrant tr').removeAttr('id');

  $(this).attr('id', 'selected-row');

  let item2 = $(this).closest('tr').children('td');

  if (item2.eq(0).text() != 'undefined' && item2.eq(0).text() != '') {
    // console.log(item2.eq(0).text());
    $('#APPCD2').val(item2.eq(0).text());
  }
});
