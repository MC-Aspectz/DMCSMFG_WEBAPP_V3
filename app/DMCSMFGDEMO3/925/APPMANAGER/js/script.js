// search
const closepage = $("#closepage");

// action button
const kill = $("#kill");

const button_action = [kill];

// form
const form = document.getElementById("appmanager");

for (const btn of button_action) {
  btn.click(function () {
    $("#loading").show();
  });
}

kill.click(function () {
  return action("killRow");
});

closepage.click(function () {
  return programDelete();
});

async function action(action) {
  const data = new FormData(form);
  data.append("action", action);
  await axios
    .post("../APPMANAGER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      window.location.reload();
      document.getElementById("loading").style.display = "none";
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../APPMANAGER/function/index_x.php", data)
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
    .post("../APPMANAGER/function/index_x.php", data)
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
    .post("../APPMANAGER/function/index_x.php", data)
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
  window.location.href = "../APPMANAGER/";

  return false;
}

function chked(index) {
  // console.log(index);
  if (document.getElementById("CHECKROW" + index + "").checked) {
    document.getElementById("CHECKROWH" + index + "").disabled = true;
  } else {
    document.getElementById("CHECKROWH" + index + "").disabled = false;
  }
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

$("table#tablemonitor tr").click(function () {
  $("table#tablemonitor tr").removeAttr("id");

  $(this).attr("id", "click-row");

  let item1 = $(this).closest("tr").children("td");

  if (item1.eq(0).text() != "undefined" && item1.eq(0).text() != "") {
    // console.log(item1.eq(0).text());
  }
});
