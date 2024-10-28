//input
const GROUPCD = $('#GROUPCD');
const STAFFCD1 = $('#STAFFCD1');
const STAFFCD2 = $('#STAFFCD2');

// action button
const grant = $('#grant');
const grant_all = $('#grant-all');
const revoke_all = $('#revoke-all');
const revoke = $('#revoke');

const button_action = [grant, grant_all, revoke_all, revoke];

// form
const form = document.getElementById('grouprole');

for (const btn of button_action) {
  btn.click(function () {
    $('#loading').show();
  });
}

grant.click(function () {
  if (STAFFCD1.val() != '') {
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
  if (STAFFCD2.val() != '') {
    return action('revoke');
  } else {
    document.getElementById('loading').style.display = 'none';
  }
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
    .post('../GROUPSTAFF/function/index_x.php', data)
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

async function keepData() {
  const data = new FormData(form);
  data.append('action', 'keepdata');
  await axios
    .post('../GROUPSTAFF/function/index_x.php', data)
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
    .post('../GROUPSTAFF/function/index_x.php', data)
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
    .post("../GROUPSTAFF/function/index_x.php", data)
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
  window.location.href = '../GROUPSTAFF/';

  return false;
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

$('table#tableAvilavle tr').click(function () {
  $('table#tableAvilavle tr').removeAttr('id');

  $(this).attr('id', 'selected-row');

  let item1 = $(this).closest('tr').children('td');

  if (item1.eq(0).text() != 'undefined' && item1.eq(0).text() != '') {
    // console.log(item1.eq(0).text());
    $('#STAFFCD1').val(item1.eq(0).text());
  }
});

$('table#tableGrant tr').click(function () {
  $('table#tableGrant tr').removeAttr('id');

  $(this).attr('id', 'selected-row');

  let item2 = $(this).closest('tr').children('td');

  if (item2.eq(0).text() != 'undefined' && item2.eq(0).text() != '') {
    // console.log(item2.eq(0).text());
    $('#STAFFCD2').val(item2.eq(0).text());
  }
});
