// button search
const searchstorage = $("#searchstorage");
const searchdivision = $("#searchdivision");

searchstorage.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHSTORAGE/index.php"
);
searchdivision.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHDIVISION/index.php"
);

//input serach
const STORAGECD = $("#STORAGECD");
const DIVISIONCD = $("#DIVISIONCD");

const input_serach = [STORAGECD, DIVISIONCD];

// action button
const insrts = $("#insert");
const updte = $("#update");
const deletes = $("#delete");
const closepage = $("#closepage");

// form
const form = document.getElementById("storage_master");

$(document).ready(function () {
  document.getElementById("update").disabled = true;
  document.getElementById("delete").disabled = true;
});

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

searchdivision.click(function () {
  keeyData();
});

STORAGECD.change(function () {
  window.location.href = "index.php?STORAGECDS=" + STORAGECD.val();
});

STORAGECD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?STORAGECDS=" + STORAGECD.val();
  }
});

DIVISIONCD.change(function () {
  window.location.href = "index.php?DIVISIONCD=" + DIVISIONCD.val();
});

DIVISIONCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?DIVISIONCD=" + DIVISIONCD.val();
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

closepage.click(function () {
  return programDelete();
});

$("table#search_table tr").click(function () {
  $("table#search_table tr").removeAttr("id");

  $(this).attr("id", "click-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    $("#STORAGECD").val(item.eq(0).text());
    $("#STORAGENAME").val(item.eq(1).text());
    $("#DIVISIONCD").val(item.eq(2).text());
    $("#DIVISIONNAME").val(item.eq(3).text());
    document.getElementById("insert").disabled = true;
    document.getElementById("update").disabled = false;
    document.getElementById("delete").disabled = false;
    // document.getElementById("CATALOGNAME").value = item.eq(1).text();
  }
});

async function searchs() {
  $("#loading").show();
  form.submit();
}

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../STORAGEMASTER/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      window.location.href = "index.php?refresh=1";
      // clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

function enrty() {
  document.getElementById("insert").disabled = false;
  document.getElementById("update").disabled = true;
  document.getElementById("delete").disabled = true;
  $("#STORAGECD").val("");
  $("#STORAGENAME").val("");
  $("#DIVISIONCD").val("");
  $("#DIVISIONNAME").val("");
}

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../STORAGEMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../STORAGEMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function programDelete() {
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../STORAGEMASTER/function/index_x.php", data)
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
  $("#search_table > tbody > tr").remove();
  emptyRow();
  // refresh
  window.location.href = "../STORAGEMASTER/";
  return false;
}

function emptyRow() {
  for (var i = 0; i < 10; i++) {
    $("table tbody").append(
      '<tr class="tr_border table-secondary">' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td></tr>'
    );
  }
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
    text: txt,
    background: "#8ca3a3",
    showCancelButton: true,
    confirmButtonColor: "silver",
    cancelButtonColor: "silver",
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
      if (type == 1) {
        programDelete();
        window.location.href = "/DMCS_WEBAPP";
      }
    }
  });
}

// function getMachineId() {
//     let machineId = localStorage.getItem('MachineId');

//     if (!machineId) {
//         machineId = crypto.randomUUID();
//         localStorage.setItem('MachineId', machineId);
//     }
//     return machineId.toUpperCase();
// }
