// button search
const SEARCHACCOUNT1 = $("#SEARCHACCOUNT1");
const SEARCHACCOUNT2 = $("#SEARCHACCOUNT2");
const SEARCHACCOUNT3 = $("#SEARCHACCOUNT3");

// SEARCHACCOUNT1.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?index=1');
SEARCHACCOUNT1.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ASSETACCMASTER&index=1",
    "authWindow",
    "width=1200,height=600"
  );
});
// SEARCHACCOUNT2.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?index=2');
SEARCHACCOUNT2.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ASSETACCMASTER&index=2",
    "authWindow",
    "width=1200,height=600"
  );
});
// SEARCHACCOUNT3.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHACCOUNT/index.php?index=3');
SEARCHACCOUNT3.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/SEARCHACCOUNT/index.php?page=ASSETACCMASTER&index=3",
    "authWindow",
    "width=1200,height=600"
  );
});

//input serach

const ASSETACCCD = $("#ASSETACCCD");
const ASSETACCOUNT = $("#ASSETACCOUNT");
const DEPLECIATION = $("#DEPLECIATION");
const ACCUMULATED = $("#ACCUMULATED");

//const AFFILIATEFLG = $("#AFFILIATEFLG");

const input_serach = [ASSETACCCD, ASSETACCOUNT, DEPLECIATION, ACCUMULATED];

// action button
const insrts = $("#insert");
const updte = $("#update");
const deletes = $("#delete");
const closepage = $("#closepage");

const csv = $("#csv");

// form
const form = document.getElementById("assetacc_master");

$(document).ready(function () {
  unRequired();
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

csv.click(function () {
  // keeyData();
  exportCSV();
});

ASSETACCCD.change(function () {
  window.location.href = "index.php?checkasacc=" + ASSETACCCD.val();
  keeyData();
});

// ASSETACCCD.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         window.location.href="index.php?checkasacc=" + ASSETACCCD.val();
//         keeyData();
//     }
// })

ASSETACCOUNT.change(function () {
  window.location.href = "index.php?acccode=" + ASSETACCOUNT.val() + "&index=1";
  keeyData();
});

ASSETACCOUNT.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href =
      "index.php?acccode=" + ASSETACCOUNT.val() + "&index=1";
    keeyData();
  }
});

DEPLECIATION.change(function () {
  window.location.href = "index.php?acccode=" + DEPLECIATION.val() + "&index=2";
  keeyData();
});

DEPLECIATION.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href =
      "index.php?acccode=" + DEPLECIATION.val() + "&index=2";
    keeyData();
  }
});

ACCUMULATED.change(function () {
  window.location.href = "index.php?acccode=" + ACCUMULATED.val() + "&index=3";
  keeyData();
});

ACCUMULATED.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href =
      "index.php?acccode=" + ACCUMULATED.val() + "&index=3";
    keeyData();
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

  $(this).attr("id", "selected-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    //$('#ACCOUNTCDS').val(item.eq(0).text());
    $("#ASSETACCCD").val(item.eq(1).text());
    $("#NAME_C").val(item.eq(2).text());
    $("#NAME_E").val(item.eq(3).text());
    $("#ASSETACCOUNT").val(item.eq(4).text());
    $("#DEPLECIATION").val(item.eq(5).text());
    $("#ACCUMULATED").val(item.eq(6).text());
    $("#ASSETACCOUNTNM").val(item.eq(7).text());
    $("#DEPLECIATIONNM").val(item.eq(8).text());
    $("#ACCUMULATEDNM").val(item.eq(9).text());

    document.getElementById("insert").disabled = true;
    document.getElementById("update").disabled = false;
    document.getElementById("delete").disabled = false;
    unRequired();
  }
});

// async function searchs() {
//     $('#loading').show();
//     form.submit();
// }

async function exportCSV() {
  // Variable to store the final csv data
  var csv_data = [","];
  // Get each row data
  var rows = document.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    // Get each column data
    var cols = rows[i].querySelectorAll("td, th");
    // Stores each csv row data
    var csvrow = [];
    for (var j = 0; j < cols.length; j++) {
      // Get the text data of each cell
      // of a row and push it to csvrow
      csvrow.push(cols[j].innerHTML);
    }
    // Combine each column value with comma
    csv_data.push(csvrow.join(","));
  }
  // Combine each row data with new line character
  csv_data = csv_data.join("\n");
  // Call this function to download csv file
  await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
  CSVFile = new Blob(["\uFEFF" + csv_data], {
    type: "text/csv;charset=utf-8;",
  });
  // console.log(CSVFile);
  const supportsFileSystemAccess =
    "showSaveFilePicker" in window &&
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
            description: "CSV file",
            accept: { "application/csv": [".csv"] },
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
      if (err.name !== "AbortError") {
        console.error(err.name, err.message);
        return;
      }
    }
  }
  // Fallback if the File System Access API is not supported…
  // Create the CSVFile URL.
  const url = URL.createObjectURL(CSVFile);
  // Create the `<a download>` element and append it invisibly.
  const temp_link = document.createElement("a");
  temp_link.href = url;
  temp_link.download = suggestedName;
  temp_link.style.display = "none";
  document.body.append(temp_link);
  // Programmatically click the element.
  temp_link.click();
  // Revoke the CSVFile URL and remove the element.
  setTimeout(() => {
    URL.revokeObjectURL(url);
    temp_link.remove();
  }, 1000);
}

function HandlePopupResultIndex(code, result, index) {
  // console.log("result of popup is: " + code + ' : ' + result);
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/850/ASSETACCMASTER/index.php?" +
    code +
    "=" +
    result +
    "&index=" +
    index);
}

function HandlePopupResult(code, result) {
  // console.log("result of popup is: " + code + ' : ' + result);
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/850/ASSETACCMASTER/index.php?" +
    code +
    "=" +
    result);
}

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../ASSETACCMASTER/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      window.location.href = "index.php?refresh=1";
      // clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

// function entrys() {
//     document.getElementById("insert").disabled = false;
//     document.getElementById("update").disabled = true;
//     document.getElementById("delete").disabled = true;
//     $('#ACCOUNTCDS').val('');
//     $('#ACCOUNTNAMES').val('');
//     $('#ACCOUNTNAMES2').val('');
//     $('#ACCSUM_TYP').val('');
//     $('#ACC_TYPS').val('');
//     $('#ACC_GRPS').val('');
//     $('#INPACCEPT_TYP').val('F');
//     $('#INPACCEPT_TYP').prop("checked", false)
//     $('#ACCSUM_TYP').val('F');
//     $('#ACCSUM_TYP').prop("checked", false)

// }

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ASSETACCMASTER/function/index_x.php", data)
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
    .post("../ASSETACCMASTER/function/index_x.php", data)
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
    .post("../ASSETACCMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch((e) => {
      console.log(e);
    });
}

function unRequired() {
  let ASSETACCCD = document.getElementById("ASSETACCCD");
  let NAME_C = document.getElementById("NAME_C");
  let ASSETACCOUNT = document.getElementById("ASSETACCOUNT");

  ASSETACCCD.classList[ASSETACCCD.value !== "" ? "remove" : "add"]("req");
  NAME_C.classList[NAME_C.value !== "" ? "remove" : "add"]("req");
  ASSETACCOUNT.classList[ASSETACCOUNT.value !== "" ? "remove" : "add"]("req");
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
  if (form.id == "assetacc_master") {
    // window.location.href = "index.php";
    window.location.href = "../ASSETACCMASTER/";
  }
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
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        "</tr>"
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
        unsetSession(form);
        programDelete();
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
