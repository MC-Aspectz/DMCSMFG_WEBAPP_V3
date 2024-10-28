// search
const searchcustomer = $("#searchcustomer");
const searchcountry = $("#searchcountry");
const searchstate = $("#searchstate");
const searchcity = $("#searchcity");
const searchcurrency = $("#searchcurrency");

searchcustomer.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHCUSTOMER/index.php"
);
searchcountry.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHCOUNTRY/index.php"
);
searchstate.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHSTATE1/index.php"
);
searchcity.attr("href", $("#sessionUrl").val() + "/guide/SEARCHCITY/index.php");
searchcurrency.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHCURRENCY/index.php"
);

//input serach
const CUSTOMERCD = $("#CUSTOMERCD");
const COUNTRYCD = $("#COUNTRYCD");
const STATECD = $("#STATECD");
const CITYCD = $("#CITYCD");
const CURRENCYCD = $("#CURRENCYCD");
const input_serach = [CUSTOMERCD, COUNTRYCD, STATECD, CITYCD, CURRENCYCD];

// action button
const insert = $("#insert");
const update = $("#update");
const del = $("#delete");

// form
const form = document.getElementById("customermaster");

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
  if (CUSTOMERCD.val() == "") {
    return false;
  }
  deleted();
  // form.submit();
});

CUSTOMERCD.change(function () {
  keeyData();
  window.location.href = "index.php?customercd=" + CUSTOMERCD.val();
});

CUSTOMERCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?customercd=" + CUSTOMERCD.val();
  }
});

COUNTRYCD.change(function () {
  keeyData();
  window.location.href = "index.php?countrycd=" + COUNTRYCD.val();
});

COUNTRYCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?countrycd=" + COUNTRYCD.val();
  }
});

STATECD.change(function () {
  keeyData();
  window.location.href = "index.php?statecd=" + STATECD.val();
});

STATECD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?statecd=" + STATECD.val();
  }
});

CITYCD.change(function () {
  keeyData();
  window.location.href = "index.php?citycd=" + CITYCD.val();
});

CITYCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?citycd=" + CITYCD.val();
  }
});

CURRENCYCD.change(function () {
  keeyData();
  window.location.href = "index.php?currencycd=" + CURRENCYCD.val();
});

CURRENCYCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?currencycd=" + CURRENCYCD.val();
  }
});

async function inserted() {
  const data = new FormData(form);
  data.append("action", "insert");

  await axios
    .post("../CUSTOMERMASTER_DMCS_THA/function/index_x.php", data)
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
    .post("../CUSTOMERMASTER_DMCS_THA/function/index_x.php", data)
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
    .post("../CUSTOMERMASTER_DMCS_THA/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../CUSTOMERMASTER_DMCS_THA/function/index_x.php", data)
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
    .post("../CUSTOMERMASTER_DMCS_THA/function/index_x.php", data)
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
  if (form.id == "customermaster") {
    // window.location.href = "index.php";
    window.location.href = "../CUSTOMERMASTER_DMCS_THA/";
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
