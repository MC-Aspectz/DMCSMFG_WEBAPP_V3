//input serach
const ACCOUNTCD = $("#ACCOUNTCD");
const ACC_GRP = $("#ACC_GRP");

//const AFFILIATEFLG = $('#AFFILIATEFLG');
const input_serach = [ACCOUNTCD, ACC_GRP];

// action button
const INSERT = $("#INSERT");
const UPDATE = $("#UPDATE");
const DELETE = $("#DELETE");

// form
const form = document.getElementById("accountmaster_acc");

$(document).ready(function () {
  unRequired();
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;
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

ACCOUNTCD.on("keyup change", function (e) {
  if (e.type === "change") {
    getSearch("ACCOUNTCD", ACCOUNTCD.val());
  } else if (e.key === "Enter" || e.keyCode === 13) {
    getSearch("ACCOUNTCD", ACCOUNTCD.val());
  }
});

ACC_GRP.change(function () {
  keepData();
  getSearch("ACC_GRP", ACC_GRP.val());
});

async function getSearch(code, value) {
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/905/ACCOUNTMASTER_AC/index.php?" +
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

UPDATE.click(function () {
  return commit("update");
});

DELETE.click(function () {
  return commit("deletes");
});

$("table#search_table tr").click(function () {
  $("table#search_table tr").removeAttr("id");

  $(this).attr("id", "selected-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    $("#ACCOUNTCD").val(item.eq(0).text());
    $("#ACCOUNTNAME").val(item.eq(1).text());
    $("#ACCOUNTNAME2").val(item.eq(2).text());
    $("#ACC_TYP").val(item.eq(3).text());
    $("#INPACCEPT_TYPNM").val(item.eq(4).text());
    $("#ACCSUM_TYPNM").val(item.eq(5).text());
    $("#ACC_GRP").val(item.eq(6).text());
    $("#ACC_TYP").val(item.eq(7).text());
    $("#INPACCEPT_TYP").val(item.eq(8).text());
    $("#ACCSUM_TYP").val(item.eq(9).text());
    $("#ACC_GRP").val(item.eq(10).text());
    if (item.eq(8).text() == "T") {
      $("#INPACCEPT_TYP").val(item.eq(8).text());
      $("#INPACCEPT_TYP").prop("checked", true);
    } else {
      $("#INPACCEPT_TYP").val("F");
      $("#INPACCEPT_TYP").prop("checked", false);
    }
    if (item.eq(9).text() == "T") {
      $("#ACCSUM_TYP").val(item.eq(9).text());
      $("#ACCSUM_TYP").prop("checked", true);
    } else {
      $("#ACCSUM_TYP").val("F");
      $("#ACCSUM_TYP").prop("checked", false);
    }
    // window.alert($('#AFFILIATEFLG').val());

    document.getElementById("INSERT").disabled = true;
    document.getElementById("UPDATE").disabled = false;
    document.getElementById("DELETE").disabled = false;

    unRequired();
  }
});

async function searchs() {
  $("#loading").show();
  form.submit();
}

async function exportCSV() {
  // Variable to store the final csv data
  var csv_data = ["Account group," + ACCGPSNM.val()];
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

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../ACCOUNTMASTER_AC/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      window.location.href = "index.php?refresh=1";
      // clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

function entry() {
  document.getElementById("INSERT").disabled = false;
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;
  $("#ACCOUNTCD").val("");
  $("#ACCOUNTNAME").val("");
  $("#ACCOUNTNAME2").val("");
  $("#ACCSUM_TYP").val("");
  $("#ACC_TYP").val("");
  $("#ACC_GRP").val("");
  $("#INPACCEPT_TYP").val("F");
  $("#INPACCEPT_TYP").prop("checked", false);
  $("#ACCSUM_TYP").val("F");
  $("#ACCSUM_TYP").prop("checked", false);
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ACCOUNTMASTER_AC/function/index_x.php", data)
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
    .post("../ACCOUNTMASTER_AC/function/index_x.php", data)
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
    .post("../ACCOUNTMASTER_AC/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = $("#sessionUrl").val() + "/home.php";
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
  // $('#table_result > tbody > tr').remove();

  // refresh
  window.location.href = "../ACCOUNTMASTER_AC/";

  return false;
}

function emptyRow() {
  for (var i = 0; i < 10; i++) {
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

function unRequired() {
  let ACCOUNTCD = document.getElementById("ACCOUNTCD");
  let ACCOUNTNAME = document.getElementById("ACCOUNTNAME");
  let ACC_TYP = document.getElementById("ACC_TYP");
  let ACC_GRP = document.getElementById("ACC_GRP");
  ACCOUNTCD.classList[ACCOUNTCD.value !== "" ? "remove" : "add"]("req");
  ACCOUNTNAME.classList[ACCOUNTNAME.value !== "" ? "remove" : "add"]("req");
  if (ACC_TYP.selectedIndex != 0) {
    ACC_TYP.classList.remove("req");
  } else {
    ACC_TYP.classList.add("req");
  }
  if (ACC_GRP.selectedIndex != 0) {
    ACC_GRP.classList.remove("req");
  } else {
    ACC_GRP.classList.add("req");
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
        programDELETE();
      }
    }
  });
}
