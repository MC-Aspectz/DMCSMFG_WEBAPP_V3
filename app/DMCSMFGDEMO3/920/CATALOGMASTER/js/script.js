//input serach
const CATALOGCD = $("#CATALOGCD");
const CATALOGNAME = $("#CATALOGNAME");
const CATALOGDESC = $("#CATALOGDESC");
const ACCIFCD = $("#ACCIFCD");

const input_serach = [CATALOGCD, ACCIFCD];

// action button
const insrts = $("#insert");
const updte = $("#update");
const deletes = $("#delete");
const CLOSEPAGE = $("#CLOSEPAGE");
// button search
const accInterface = $("#accInterface");

accInterface.attr(
  "href",
  $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCIFCD/index.php'
);

// form
const form = document.getElementById("category_master");

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

accInterface.click(function () {
  keeyData();
});

CATALOGCD.change(function () {
  window.location.href = "index.php?CATALOGCD=" + CATALOGCD.val();
});

CATALOGCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?CATALOGCD=" + CATALOGCD.val();
  }
});

ACCIFCD.change(function () {
  window.location.href = "index.php?ACCIFCD=" + ACCIFCD.val();
});

ACCIFCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?ACCIFCD=" + ACCIFCD.val();
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

CLOSEPAGE.click(function () {
  return programDelete();
});

$("table#search_table tr").click(function () {
  $("table#search_table tr").removeAttr("id");

  $(this).attr("id", "click-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    $("#CATALOGCD").val(item.eq(0).text());
    $("#CATALOGNAME").val(item.eq(1).text());
    $("#CATALOGDESC").val(item.eq(2).text());
    $("#ACCIFCD").val(item.eq(3).text());
    $("#ACCIFNAME").val(item.eq(4).text());
    $("#ROWNO").val(item.eq(5).text());
    document.getElementById("insert").disabled = true;
    document.getElementById("update").disabled = false;
    document.getElementById("delete").disabled = false;
    // document.getElementById("CATALOGNAME").value = item.eq(1).text();
    unRequired();
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
    .post("../CATALOGMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
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
  $("#CATALOGCD").val("");
  $("#CATALOGNAME").val("");
  $("#CATALOGDESC").val("");
  $("#ACCIFCD").val("");
  $("#ACCIFNAME").val("");
  $("#ROWNO").val("");
  keeyData(); unRequired();
}

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../CATALOGMASTER/function/index_x.php", data)
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
    .post("../CATALOGMASTER/function/index_x.php", data)
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
    .post("../CATALOGMASTER/function/index_x.php", data)
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
    switch (inputs[i].type) {
      // case 'hidden':
      case "text":
        inputs[i].value = "";
        break;
      case "radio":
      case "checkbox":
        inputs[i].checked = false;
    }
  }
  // clearing selects
  var selects = form.getElementsByTagName("select");
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName("textarea");
  for (var i = 0; i < text.length; i++) text[i].innerHTML = "";

  // clearing table
  $("#search_table > tbody > tr").remove();
  emptyRow();
  // refresh
  // window.location.href = '../CATALOGMASTER/';
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
