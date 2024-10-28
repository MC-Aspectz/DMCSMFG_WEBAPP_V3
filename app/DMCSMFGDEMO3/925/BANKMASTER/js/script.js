// action button
const INSERT = $("#INSERT");
const UPDATE = $("#UPDATE");
const DELETE = $("#DELETE");
const SEARCH = $("#SEARCH");

// input serach
const BANKCD = $("#BANKCD");

// form
const form = document.getElementById("bank_master");

SEARCH.click(async function () {
  await keepData();
  $("#loading").show();
  const action = document.createElement("input");
  action.id = "action";
  action.name = "action";
  action.type = "hidden";
  action.value = "SEARCH";
  form.appendChild(action);
  form.submit();
});

INSERT.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return action("INSERT");
});

UPDATE.click(function () {
  return action("UPDATE");
});

DELETE.click(function () {
  return action("DELETE");
});

BANKCD.on("keyup change", function (e) {
  if (e.type === "change" || e.key === "Enter" || e.keyCode === 13) {
    return getElement("BANKCD", BANKCD.val());
  }
});

async function getElement(code, value) {
  $("#loading").show();
  const data = new FormData(form);
  data.append(code, value);
  data.append("action", code);
  await axios
    .post("../BANKMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      let result = response.data;
      if (objectArray(result)) {
        // console.log(result);
        $.each(result, function (key, value) {
          if (document.getElementById("" + key + "")) {
            document.getElementById("" + key + "").value = value;
          }
        });
      }
      unRequired();
      document.getElementById("loading").style.display = "none";
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}

async function action(method) {
  $("#loading").show();
  let data = new FormData(form);
  data.append("action", method);
  await axios
    .post("../BANKMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      // clearForm(form);
      return window.location.reload();
    })
    .catch((e) => {
      $("#loading").hide();
      // console.log(e);
    });
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");
  await axios
    .post("../BANKMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession(form) {
  let data = new FormData();
  data.append("action", "unsetsession");
  data.append("systemName", "BANKMASTER");
  await axios
    .post("../BANKMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "programDelete");
  await axios
    .post("../BANKMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}

function entry() {
  $("#BANKCD").val("");
  $("#BANKNAME").val("");

  document.getElementById("INSERT").disabled = false;
  document.getElementById("UPDATE").disabled = true;
  document.getElementById("DELETE").disabled = true;

  return unRequired();
}

function unRequired() {
  document
    .getElementById("BANKCD")
    .classList[
      document.getElementById("BANKCD").value !== "" ? "remove" : "add"
    ]("req");
  document
    .getElementById("BANKNAME")
    .classList[
      document.getElementById("BANKNAME").value !== "" ? "remove" : "add"
    ]("req");
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
    text: txt,
    showCancelButton: true,
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
  window.location.href = "../BANKMASTER/";

  return false;
}
