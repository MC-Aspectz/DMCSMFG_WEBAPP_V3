// action button
const insrts = $("#insert");
const updte = $("#update");
const deletes = $("#delete");

// form
const form = document.getElementById("tax_code_master");

const TAXTYPECD1 = $("#TAXTYPECD");
const VATRATE = $("#VATRATE");

// button search

const input_serach = [TAXTYPECD1, VATRATE];

const search = $("#search");

const search_icon = [search];

for (const input of input_serach) {
  input.change(function () {
    $("#loading").show();
  });

  input.keyup(function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $("#loading").show();
    }
  });
}

for (const icon of search_icon) {
  icon.click(function () {
    keepData();
  });
}

TAXTYPECD1.change(function () {
  keepData();
  window.location.href = "index.php?TAXTYPECD=" + TAXTYPECD1.val();
});

TAXTYPECD1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?TAXTYPECD=" + TAXTYPECD1.val();
  }
});

VATRATE.change(function () {
  keepData();
  window.location.href = "index.php?VATRATE=" + VATRATE.val();
});

VATRATE.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?VATRATE=" + VATRATE.val();
  }
});

insrts.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return commit("insert");
});

updte.click(function () {
  return commit("update");
});

deletes.click(function () {
  return commit("deletes");
});

async function searchs() {
  $("#loading").show();
  form.submit();
  // let data = new FormData(form);
  // data.append('action', 'search');
  // await axios.post('../CATALOGMASTER/function/index_x.php', data)
  // .then(response => {
  //     console.log(response.data)
  // })
  // .catch(e => {
  //     console.log(e);
  // });
}

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../TAXTYPE/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = "index.php?refresh=1";
      // clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../TAXTYPE/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function clearForm(form) {
  // clearing inputs
  var inputs = form.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
            case 'checkbox':
                inputs[i].checked = false;
                break;
            case 'radio':
                inputs[i].checked = false;
                break;                
            default:
                inputs[i].value = '';
        }
    }
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

  // clearing table
  $("#table_result > tbody > tr").remove();

  // refresh
  window.location.href = "../TAXTYPE/";

  return false;
}

async function programDelete() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../TAXTYPE/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      return (window.location.href = $("#sessionUrl").val() + "/home.php");
    })
    .catch((e) => {
      console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
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
        unsetSession(form);
        programDelete();
      }
    }
  });
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../TAXTYPE/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}
