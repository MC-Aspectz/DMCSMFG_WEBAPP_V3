// search
const searchstaff = $("#searchstaff");
const searchdivision = $("#searchdivision");

searchstaff.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHSTAFF/index.php"
);
searchdivision.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHDIVISION/index.php"
);

//input serach
const STAFFCD = $("#STAFFCD");
const DIVISIONCD = $("#DIVISIONCD");
const MYFILE = $("#MYFILE");
const input_serach = [STAFFCD, DIVISIONCD];

// action button
const insert = $("#insert");
const update = $("#update");
const del = $("#delete");

// form
const form = document.getElementById("staffmaster");

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

insert.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  inserted();
  // form.submit();
});

update.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  updated();
  // form.submit();
});

del.click(function () {
  // check validate item code
  if (STAFFCD.val() == "") {
    return false;
  }
  deleted();
  // form.submit();
});

MYFILE.change(function () {
  chooseimage();

  //window.location.href="index.php?staffcd=" + STAFFCD.val();
});

STAFFCD.change(function () {
  keeyData();
  window.location.href = "index.php?staffcd=" + STAFFCD.val();
});

STAFFCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?staffcd=" + STAFFCD.val();
  }
});

DIVISIONCD.change(function () {
  keeyData();
  window.location.href = "index.php?divisioncd=" + DIVISIONCD.val();
});

DIVISIONCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?divisioncd=" + DIVISIONCD.val();
  }
});

async function inserted() {
  const data = new FormData(form);
  data.append("action", "insert");

  await axios
    .post("../STAFFMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
      // window.location.href='index.php';
    })
    .catch((e) => {
      console.log(e);
    });
}

async function updated() {
  const data = new FormData(form);
  data.append("action", "update");

  await axios
    .post("../STAFFMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function deleted() {
  const data = new FormData(form);
  data.append("action", "delete");

  await axios
    .post("../STAFFMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function chooseimage() {
  const data = new FormData(form);
  data.append("action", "photo");
  //alert("55555");
  await axios
    .post("../STAFFMASTER/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../STAFFMASTER/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../STAFFMASTER/function/index_x.php", data)
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
  if (form.id == "staffmaster") {
    // window.location.href = "index.php";
    window.location.href = "../STAFFMASTER/";
  }
  return false;
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        window.location.href = "/DMCS_WEBAPP";
      }
    }
  });
}
