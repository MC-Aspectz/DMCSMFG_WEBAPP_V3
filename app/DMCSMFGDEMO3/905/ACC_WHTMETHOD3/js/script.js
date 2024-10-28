// button search
const SEARCHCUSTOMER = $("#SEARCHCUSTOMER");
const SEARCHACCOUNT1 = $("#SEARCHACCOUNT1");
const SEARCHACCOUNT2 = $("#SEARCHACCOUNT2");
const SEARCHACCOUNT3 = $("#SEARCHACCOUNT3");

SEARCHCUSTOMER.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHCUSTOMER/index.php?page=ACC_WHTMETHOD3",
    "authWindow",
    "width=1200,height=600"
  );
});
SEARCHACCOUNT1.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ACC_WHTMETHOD3&index=1",
    "authWindow",
    "width=1200,height=600"
  );
});
SEARCHACCOUNT2.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ACC_WHTMETHOD3&index=2",
    "authWindow",
    "width=1200,height=600"
  );
});
SEARCHACCOUNT3.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ACC_WHTMETHOD3&index=3",
    "authWindow",
    "width=1200,height=600"
  );
});

const serach_icon = [
  SEARCHCUSTOMER,
  SEARCHACCOUNT1,
  SEARCHACCOUNT2,
  SEARCHACCOUNT3,
];

//input serach
const CUSTOMERCD = $("#CUSTOMERCD");
const ACC_CD1 = $("#ACC_CD1");
const ACC_CD2 = $("#ACC_CD2");
const ACC_CD3 = $("#ACC_CD3");

const input_serach = [CUSTOMERCD, ACC_CD1, ACC_CD2, ACC_CD3];

// action button
const INSERT = $("#INSERT");
// const UPDATE = $('#UPDATE');
const DELETE = $("#DELETE");

// form
const form = document.getElementById("customerwithholdtax");

$(document).ready(function () {
  // document.getElementById('UPDATE').disabled = true;
  document.getElementById("DELETE").disabled = true;
  unRequired();
});

for (const input of input_serach) {
  input.change(function () {
    keepData();
  });

  input.keyup(function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      keepData();
    }
  });
}

for (const icon of serach_icon) {
  icon.click(function () {
    keepData();
  });
}

CUSTOMERCD.on("keyup change", function (e) {
  if (e.type === "change") {
    getSearch("CUSTOMERCD", CUSTOMERCD.val());
  } else if (e.key === "Enter" || e.keyCode === 13) {
    getSearch("CUSTOMERCD", CUSTOMERCD.val());
  }
});

ACC_CD1.on("keyup change", function (e) {
  if (e.type === "change") {
    HandlePopupIndex(ACC_CD1.val(), 1);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    HandlePopupIndex(ACC_CD1.val(), 1);
  }
});

ACC_CD2.on("keyup change", function (e) {
  if (e.type === "change") {
    HandlePopupIndex(ACC_CD2.val(), 2);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    HandlePopupIndex(ACC_CD2.val(), 2);
  }
});

ACC_CD3.on("keyup change", function (e) {
  if (e.type === "change") {
    HandlePopupIndex(ACC_CD3.val(), 3);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    HandlePopupIndex(ACC_CD3.val(), 3);
  }
});

async function getSearch(code, value) {
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/905/ACC_WHTMETHOD3/index.php?" +
    code +
    "=" +
    value);
}

INSERT.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return commit("insert");
});

// UPDATE.click(function() {
//     return commit('update');
// });

DELETE.click(function () {
  return commit("deletes");
});

$("table#search_table tr").click(function () {
  $("table#search_table tr").removeAttr("id");

  $(this).attr("id", "selected-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    // $('#WHTAXTYPE').val(item.eq(0).text());
    $("#ACC_CD1").val(item.eq(1).text());
    $("#ACCNAME1").val(item.eq(2).text());
    $("#ACC_CD2").val(item.eq(3).text());
    $("#ACCNAME2").val(item.eq(4).text());
    $("#ACC_CD3").val(item.eq(5).text());
    $("#ACCNAME3").val(item.eq(6).text());
    $("#WHTAXTYPE").val(item.eq(7).text());

    unRequired();

    document.getElementById("INSERT").disabled = false;
    //document.getElementById('UPDATE').disabled = true;
    document.getElementById("DELETE").disabled = true;
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
    .post("../ACC_WHTMETHOD3/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      window.location.href = "index.php?refresh=1";
      // clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

function entry() {
  document.getElementById("INSERT").disabled = false;
  //document.getElementById('UPDATE').disabled = true;
  document.getElementById("DELETE").disabled = true;

  $("#WHTAXTYPE").val("");
  $("#ACC_CD1").val("");
  $("#ACCNAME1").val("");
  $("#ACC_CD2").val("");
  $("#ACCNAME2").val("");
  $("#ACC_CD3").val("");
  $("#ACCNAME3").val("");
}

function unRequired() {
  let CUSTOMERCD = document.getElementById("CUSTOMERCD");
  let WHTAXTYPE = document.getElementById("WHTAXTYPE");
  let ACC_CD1 = document.getElementById("ACC_CD1");
  let ACC_CD2 = document.getElementById("ACC_CD2");
  let ACC_CD3 = document.getElementById("ACC_CD3");

  if (WHTAXTYPE.selectedIndex != 0) {
    WHTAXTYPE.classList.remove("req");
  } else {
    WHTAXTYPE.classList.add("req");
  }
  CUSTOMERCD.classList[CUSTOMERCD.value !== "" ? "remove" : "add"]("req");
  ACC_CD1.classList[ACC_CD1.value !== "" ? "remove" : "add"]("req");
  ACC_CD2.classList[ACC_CD2.value !== "" ? "remove" : "add"]("req");
  ACC_CD3.classList[ACC_CD3.value !== "" ? "remove" : "add"]("req");
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ACC_WHTMETHOD3/function/index_x.php", data)
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
    .post("../ACC_WHTMETHOD3/function/index_x.php", data)
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
    .post("../ACC_WHTMETHOD3/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      window.location.href = $("#sessionUrl").val() + "/home.php";
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
  $("#search_table > tbody > tr").remove();
  // emptyRow();
  // refresh
  window.location.href = "../ACC_WHTMETHOD3/";
  return false;
}

function emptyRow() {
  for (var i = 0; i < 8; i++) {
    $("table tbody").append(
      '<tr class="divide-y divide-gray-200">' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
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
        programDelete();
      }
    }
  });
}
