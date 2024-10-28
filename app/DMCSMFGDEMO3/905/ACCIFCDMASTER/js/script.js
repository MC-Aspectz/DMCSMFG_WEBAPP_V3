// button search
const SEARCHACCIFCD = $("#SEARCHACCIFCD");
const SEARCHACCIFCD1 = $("#SEARCHACCIFCD1");

SEARCHACCIFCD.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCIFCD/index.php?page=ACCIFCDMASTER",
    "authWindow",
    "width=1200,height=600"
  );
});
SEARCHACCIFCD1.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCIFCD/index.php?page=ACCIFCDMASTER1",
    "authWindow",
    "width=1200,height=600"
  );
});

//input serach
const ACCIFCD = $("#ACCIFCD");
const ACCIFNAME = $("#ACCIFNAME");

// action button
const INSERT = $("#INSERT");
const UPDATE = $("#UPDATE");
const DELETE = $("#DELETE");

// form
const form = document.getElementById("accountinterface_master");

$(document).ready(function () {
  unRequired();
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;
  if (ACCIFNAME.val() != "") {
    document.getElementById("INSERT").disabled = true;
    document.getElementById("UPDATE").disabled = false;
    document.getElementById("DELETE").disabled = false;
  }
});

ACCIFCD.on("keyup change", function (e) {
  if (e.type === "change") {
    $("#loading").show();
    return getSearch("ACCIFCD", ACCIFCD.val());
  } else if (e.key === "Enter" || e.keyCode === 13) {
    $("#loading").show();
    return getSearch("ACCIFCD", ACCIFCD.val());
  }
});

INSERT.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return commit("insert");
});

UPDATE.click(function () {
  return commit("update");
});

DELETE.click(function () {
  return commit("deletes");
});

$("table#table tr").click(function () {
  $("table#table tr").removeAttr("id");

  $(this).attr("id", "selected-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    $("#ACCIFCD").val(item.eq(0).text());
    $("#ACCIFNAME").val(item.eq(1).text());

    document.getElementById("INSERT").disabled = true;
    document.getElementById("UPDATE").disabled = false;
    document.getElementById("DELETE").disabled = false;
    // document.getElementById("CATALOGNAME").value = item.eq(1).text();
    unRequired();
  }
});

async function getSearch(code, value) {
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/905/ACCIFCDMASTER/index.php?" +
    code +
    "=" +
    value);
}

async function searchs() {
  $("#loading").show();
  form.submit();
}

async function commit(method) {
  $("#loading").show();
  let data = new FormData(form);
  data.append("action", method);
  await axios
    .post("../ACCIFCDMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      return window.location.reload();
      // clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

function enrty() {
  document.getElementById("INSERT").disabled = true;
  document.getElementById("UPDATE").disabled = false;
  document.getElementById("DELETE").disabled = false;
  $("#ACCIFCD").val("");
  $("#ACCIFNAME").val("");
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ACCIFCDMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../ACCIFCDMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function programDelete() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../ACCIFCDMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      return (window.location.href = $("#sessionUrl").val() + "/home.php");
    })
    .catch((e) => {
      // console.log(e);
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
  // $('#table > tbody > tr').remove();
  emptyRow();
  // refresh
  window.location.href = "../ACCIFCDMASTER/";
  return false;
}

function emptyRow() {
  for (var i = 0; i < 10; i++) {
    $("#dvwdetail").append(
      '<tr class="border border-gray-600">' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td></tr>'
    );
  }
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
        return programDelete();
      }
    }
  });
}

function unRequired() {
  if ($("#ACCIFCD").val() != "") {
    document.getElementById("ACCIFCD").classList.remove("req");
  } else {
    document.getElementById("ACCIFCD").classList.add("req");
  }

  if ($("#ACCIFNAME").val() != "") {
    document.getElementById("ACCIFNAME").classList.remove("req");
  } else {
    document.getElementById("ACCIFNAME").classList.add("req");
  }
}
