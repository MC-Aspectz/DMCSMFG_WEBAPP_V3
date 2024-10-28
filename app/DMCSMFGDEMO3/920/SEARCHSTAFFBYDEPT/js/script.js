// search
const searchdivision = $("#searchdivision");
const searchdivision1 = $("#searchdivision1");
const closepage = $("#closepage");

searchdivision.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHDIVISION/index.php?index=1"
);
searchdivision1.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHDIVISION/index.php?index=2"
);

//input serach
const FM0932DEPTSTART = $("#FM0932DEPTSTART");
const FM0932DEPTEND = $("#FM0932DEPTEND");

const input_serach = [FM0932DEPTSTART, FM0932DEPTEND];

// action button
const csv = $("#csv");

// form
const form = document.getElementById("searchstaffbydept");

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
  exportCSV();
});

closepage.click(function () {
  return programDelete();
});

FM0932DEPTSTART.change(function () {
  window.location.href = "index.php?FM0932DEPTSTART=" + FM0932DEPTSTART.val();
});

FM0932DEPTSTART.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?FM0932DEPTSTART=" + FM0932DEPTSTART.val();
  }
});

FM0932DEPTEND.change(function () {
  window.location.href = "index.php?FM0932DEPTEND=" + FM0932DEPTEND.val();
});

FM0932DEPTEND.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?FM0932DEPTEND=" + FM0932DEPTEND.val();
  }
});

async function exportCSV() {
  // Variable to store the final csv data
  var csv_data = [
    "Department," + FM0932DEPTSTART.val() + ",-," + FM0932DEPTEND.val(),
  ];
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

async function unsetSession(form) {
  let data = new FormData();
  data.append("action", "unsetsession");
  data.append("systemName", "SearchStaffByDept");

  await axios
    .post("../SEARCHSTAFFBYDEPT/function/index_x.php", data)
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
    .post("../SEARCHSTAFFBYDEPT/function/index_x.php", data)
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
  if (form.id == "searchstaffbydept") {
    // window.location.href = "index.php";
    window.location.href = "../SEARCHSTAFFBYDEPT/";
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
