// search
const searchstaff = $("#searchstaff");
const closepage = $("#closepage");

const STARTDATE1 = $("#STARTDATE1");
const STARTDATE2 = $("#STARTDATE2");
searchstaff.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHSTAFF/index.php"
);
//input serach

const STAFFCDS = $("#STAFFCDS");

const input_serach = [STAFFCDS];

// action button
const csv = $("#csv");

// form
const form = document.getElementById("loginhistoryrd");

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

STAFFCDS.change(function () {
  window.location.href = "index.php?staffcd=" + STAFFCDS.val();
  keeyData();
});

STAFFCDS.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?staffcd=" + STAFFCDS.val();
    keeyData();
  }
});

csv.click(function () {
  //alert('test');
  exportCSV();
});

closepage.click(function () {
  return programDelete();
});

async function searchs() {
  $("#loading").show();
  form.submit();
}

async function exportCSV() {
  // Variable to store the final csv data
  var csv_data = ["Start Date," + STARTDATE1.val() + ",-," + STARTDATE2.val()];
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

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ACCTRANMODIFYHISTORY_RD/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession(form) {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../ACCTRANMODIFYHISTORY_RD/function/index_x.php", data)
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
    .post("../ACCTRANMODIFYHISTORY_RD/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
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
  if (form.id == "loginhistoryrd") {
    // window.location.href = "index.php";
    window.location.href = "../ACCTRANMODIFYHISTORY_RD/";
  }
  return false;
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
        unsetSession();
        window.location.href = "/DMCS_WEBAPP";
      }
    }
  });
}
