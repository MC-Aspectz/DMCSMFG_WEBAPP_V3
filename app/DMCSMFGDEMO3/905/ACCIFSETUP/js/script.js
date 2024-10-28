// button search
const SEARCHACCIFCD = $("#SEARCHACCIFCD");
const SEARCHACCOUNT1 = $("#SEARCHACCOUNT1");
const SEARCHACCOUNT2 = $("#SEARCHACCOUNT2");
const SEARCHACCOUNT3 = $("#SEARCHACCOUNT3");
const SEARCHACCOUNT4 = $("#SEARCHACCOUNT4");

SEARCHACCIFCD.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCIFCD/index.php?page=ACCIFSETUP",
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
      "/SEARCHACCOUNT/index.php?page=ACCIFSETUP&index=1",
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
      "/SEARCHACCOUNT/index.php?page=ACCIFSETUP&index=2",
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
      "/SEARCHACCOUNT/index.php?page=ACCIFSETUP&index=3",
    "authWindow",
    "width=1200,height=600"
  );
});
SEARCHACCOUNT4.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ACCIFSETUP&index=4",
    "authWindow",
    "width=1200,height=600"
  );
});

const serach_icon = [
  SEARCHACCIFCD,
  SEARCHACCOUNT1,
  SEARCHACCOUNT1,
  SEARCHACCOUNT2,
  SEARCHACCOUNT3,
  SEARCHACCOUNT4,
];

//input serach
const PROCESSTYP = $("#PROCESSTYPSS");
const ITEMTYP = $("#ITEMTYP");
const INVCALCTYP = $("#INVCALCTYPS");
const DEBITACCCD1 = $("#DEBITACCCD1");
const DEBITACCCD2 = $("#DEBITACCCD2");
const CREDITACCCD1 = $("#CREDITACCCD1");
const CREDITACCCD2 = $("#CREDITACCCD2");

const AFFILIATEFLG = $("#AFFILIATEFLG");

const input_serach = [
  ITEMTYP,
  DEBITACCCD1,
  DEBITACCCD2,
  CREDITACCCD1,
  CREDITACCCD2,
];

// action button
const INSERT = $("#INSERT");
const UPDATE = $("#UPDATE");
const DELETE = $("#DELETE");

// form
const form = document.getElementById("interfacesetting_acc");

$(document).ready(function () {
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;
  unRequired();
});

for (const icon of serach_icon) {
  icon.click(function () {
    keepData();
  });
}

for (const input of input_serach) {
  input.change(function () {
    $("#loading").show();
    keepData();
  });

  input.keyup(function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $("#loading").show();
      keepData();
    }
  });
}

// AFFILIATEFLG.change(function() {
//    if (AFFILIATEFLG.checked == true)
//    {
//    // document.getElementById("AFFILIATEFLGS").checked = true;
//    // AFFILIATEFLGS.val('T');
//     // $('#AFFILIATEFLGS').val('T');
//     alert($('#AFFILIATEFLGS').val());
//    }
//    else    {
//     alert('F');
//    //alert($("#AFFILIATEFLGS").val());
//    }

// });

PROCESSTYP.change(function () {
  SetAccEnable();
  // window.alert('555');
});

INVCALCTYP.change(function () {
  SetAccEnable();
});

ITEMTYP.on("keyup change", function (e) {
  if (e.type === "change") {
    return getSearch("ITEMTYP", ITEMTYP.val());
  } else if (e.key === "Enter" || e.keyCode === 13) {
    return getSearch("ITEMTYP", ITEMTYP.val());
  }
});

DEBITACCCD1.on("keyup change", function (e) {
  if (e.type === "change") {
    return HandlePopupIndex(DEBITACCCD1.val(), 1);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    return HandlePopupIndex(DEBITACCCD1.val(), 1);
  }
});

DEBITACCCD2.on("keyup change", function (e) {
  if (e.type === "change") {
    return HandlePopupIndex(DEBITACCCD2.val(), 2);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    return HandlePopupIndex(DEBITACCCD2.val(), 2);
  }
});

CREDITACCCD1.on("keyup change", function (e) {
  if (e.type === "change") {
    return HandlePopupIndex(CREDITACCCD1.val(), 3);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    return HandlePopupIndex(CREDITACCCD1.val(), 3);
  }
});

CREDITACCCD2.on("keyup change", function (e) {
  if (e.type === "change") {
    return HandlePopupIndex(CREDITACCCD2.val(), 4);
  } else if (e.key === "Enter" || e.keyCode === 13) {
    return HandlePopupIndex(CREDITACCCD2.val(), 4);
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
    $("#ROWCOUNTER").val(item.eq(0).text());
    $("#PROCESSTYP").val(item.eq(1).text());
    $("#NAIGAITYP").val(item.eq(2).text());
    $("#ITEMTYPNM").val(item.eq(3).text());
    $("#BOITYP").val(item.eq(4).text());
    $("#AFFILIATEFLGNM").val(item.eq(5).text());
    $("#INVCALCTYP").val(item.eq(6).text());
    $("#TAXTYP").val(item.eq(7).text());
    $("#DEBITACCCD1").val(item.eq(8).text());
    $("#CREDITACCCD1").val(item.eq(9).text());
    $("#DEBITACCCD2").val(item.eq(10).text());
    $("#CREDITACCCD2").val(item.eq(11).text());
    $("#MEMO").val(item.eq(12).text());
    $("#ITEMTYP").val(item.eq(13).text());
    $("#DEBITACCNM1").val(item.eq(14).text());
    $("#CREDITACCNM1").val(item.eq(15).text());
    $("#DEBITACCNM2").val(item.eq(16).text());
    $("#CREDITACCNM2").val(item.eq(17).text());
    $("#PROCESSTYPSS").val(item.eq(18).text());
    $("#NAIGAITYPS").val(item.eq(19).text());
    $("#BOITYPS").val(item.eq(20).text());
    $("#INVCALCTYPS").val(item.eq(21).text());
    $("#TAXTYPS").val(item.eq(22).text());
    $("#KEYDATA").val(item.eq(23).text());
    $("#AFFILIATEFLG").val(item.eq(24).text());
    if (item.eq(24).text() == "T") {
      $("#AFFILIATEFLG").val(item.eq(24).text());
      $("#AFFILIATEFLG").prop("checked", true);
    } else {
      $("#AFFILIATEFLG").val("F");
      $("#AFFILIATEFLG").prop("checked", false);
    }
    // window.alert($('#AFFILIATEFLG').val());

    document.getElementById("INSERT").disabled = true;
    document.getElementById("UPDATE").disabled = false;
    document.getElementById("DELETE").disabled = false;
    unRequired();
  }
});

async function getSearch(code, value) {
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/905/ACCIFSETUP/index.php?" +
    code +
    "=" +
    value);
}

async function searchs() {
  $("#loading").show();
  form.submit();
}

async function SetAccEnable() {
  const data = new FormData(form);
  data.append("action", "setaccenable");

  await axios
    .post("../ACCIFSETUP/function/index_x.php", data)
    .then((response) => {
      // window.alert('555');
      console.log(response.data);
      //clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);
  await axios
    .post("../ACCIFSETUP/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      window.location.reload();
      // clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

function copys() {
  document.getElementById("INSERT").disabled = false;
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;
}

function entrys() {
  document.getElementById("INSERT").disabled = false;
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;
  $("#PROCESSTYPSS").val("");
  $("#ITEMTYP").val("");
  $("#ITEMTYPNM").val("");
  $("#NAIGAITYPS").val("");
  $("#BOITYPS").val("");
  $("#AFFILIATEFLG").val("");
  $("#INVCALCTYPS").val("");
  $("#TAXTYPS").val("");
  $("#DEBITACCCD1").val("");
  $("#DEBITACCNM1").val("");
  $("#CREDITACCCD1").val("");
  $("#CREDITACCNM1").val("");
  $("#DEBITACCCD2").val("");
  $("#DEBITACCNM2").val("");
  $("#CREDITACCCD2").val("");
  $("#CREDITACCNM2").val("");
  $("#MEMO").val("");
}

function unRequired() {
  let PROCESSTYPSS = document.getElementById("PROCESSTYPSS");
  let ITEMTYP = document.getElementById("ITEMTYP");
  let NAIGAITYPS = document.getElementById("NAIGAITYPS");
  let BOITYPS = document.getElementById("BOITYPS");
  let INVCALCTYPS = document.getElementById("INVCALCTYPS");

  PROCESSTYPSS.classList[PROCESSTYPSS.value !== "" ? "remove" : "add"]("req");
  ITEMTYP.classList[ITEMTYP.value !== "" ? "remove" : "add"]("req");
  NAIGAITYPS.classList[NAIGAITYPS.value !== "" ? "remove" : "add"]("req");
  BOITYPS.classList[BOITYPS.value !== "" ? "remove" : "add"]("req");
  INVCALCTYPS.classList[INVCALCTYPS.value !== "" ? "remove" : "add"]("req");
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ACCIFSETUP/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

function Clears() {
  $("#PROCESSTYPSS").val("");
  $("#ITEMTYP").val("");
  $("#ITEMTYPNM").val("");
  $("#NAIGAITYPS").val("");
  $("#BOITYPS").val("");
  $("#AFFILIATEFLG").val("");
  $("#INVCALCTYPS").val("");
  $("#TAXTYPS").val("");
  $("#DEBITACCCD1").val("");
  $("#DEBITACCNM1").val("");
  $("#CREDITACCCD1").val("");
  $("#CREDITACCNM1").val("");
  $("#DEBITACCCD2").val("");
  $("#DEBITACCNM2").val("");
  $("#CREDITACCCD2").val("");
  $("#CREDITACCNM2").val("");
  $("#MEMO").val("");
  return unRequired();
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");
  data.append("systemName", "ACCIFSETUP");
  await axios
    .post("../ACCIFSETUP/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function programDelete() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../ACCIFSETUP/function/index_x.php", data)
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
  emptyRow();
  // refresh
  window.location.href = "../ACCIFSETUP/";

  return false;
}

function emptyRow() {
  for (var i = 0; i < 10; i++) {
    $("#dvwdetail").append(
      '<tr class="border border-gray-600">' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
        '<td class="h-6 border border-slate-700"></td>' +
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
        return programDelete();
      }
    }
  });
}
