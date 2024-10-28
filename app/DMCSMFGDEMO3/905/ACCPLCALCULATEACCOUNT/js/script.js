//input
const ACCGROUPS = $('#ACCGROUPS');

// action button
const ADDP = $('#ADDP');
const TAKEP = $('#TAKEP');

const button_action = [ADDP, TAKEP];

// form
const form = document.getElementById('accplcalculate');

for (const btn of button_action) {
  btn.click(function () {
    $('#loading').show();
  });
}

ACCGROUPS.change(function () {
  $('#loading').show();
  window.location.href = 'index.php?ACCGROUPS=' + ACCGROUPS.val();
});

ADDP.click(function () {
  return action('addPLAccount');
});

TAKEP.click(function () {
  return action('takePLAccount');
});

async function action(action) {
  const data = new FormData(form);
  data.append('action', action);
  await axios
    .post('../ACCPLCALCULATEACCOUNT/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      window.location.reload();
      // document.getElementById('loading').style.display = 'none';
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ACCPLCALCULATEACCOUNT/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession(form) {
  let data = new FormData();
  data.append("action", "unsetsession");
  await axios
    .post("../ACCPLCALCULATEACCOUNT/function/index_x.php", data)
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
  data.append("action", "programDelete");
  await axios
    .post("../ACCPLCALCULATEACCOUNT/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = $('#sessionUrl').val() + '/home.php';
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
  // $("#table_result > tbody > tr").remove();

  // refresh
  window.location.href = '../ACCPLCALCULATEACCOUNT/';

  return false;
}

function chked(type, index) {
  // console.log(index);
  if (document.getElementById('CHECKROW' + type + "" + index + "").checked) {
    document.getElementById('CHECKROWH' + type + "" + index + "").disabled = true;
  } else {
    document.getElementById('CHECKROWH' + type + "" + index + "").disabled = false;
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
        programDelete();
      }
    }
  });
}

function isInt(value) {
  return (
    !isNaN(value) &&
    (function (x) {
      return (x | 0) === x;
    })(parseFloat(value))
  );
}

$('table#tableDVWA tr').click(function () {
  $('table#tableDVWA tr').removeAttr('id');

  $(this).attr('id', 'selected-row');

  let item1 = $(this).closest('tr').children('td');

  if (item1.eq(0).text() != 'undefined' && item1.eq(0).text() != '') {
    // console.log(item1.eq(0).text());
  }
});

$('table#tableDVWP tr').click(function () {
  $('table#tableDVWP tr').removeAttr('id');

  $(this).attr('id', 'selected-row');

  let item2 = $(this).closest('tr').children('td');

  if (item2.eq(0).text() != 'undefined' && item2.eq(0).text() != '') {
    // console.log(item2.eq(0).text());
  }
});
