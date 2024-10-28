// button search
// const SEARCHPROGRAM = $("#SEARCHPROGRAM");

// SEARCHPROGRAM.attr('href', $('#sessionUrl').val() + '/guide/SEARCHPROGRAM/index.php');
// SEARCHPROGRAM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPROGRAM/index.php?page=CUSTOMIZECOPY' , 'authWindow', 'width=1200,height=600');});

//input serach
const APPID = $("#APPID");
// const CURRENCYCD = $("#CURRENCYCD");
const input_serach = [APPID];

// action button
const Copy = $("#copy");
// const update = $("#update");
//const del = $("#delete");

// form
const form = document.getElementById("customizecopy");

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

APPID.change(function () {
  window.location.href = "index.php?programcd=" + APPID.val();
});

APPID.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?programcd=" + APPID.val();
  }
});

Copy.click(function () {
  // check validate form
  //alert('Copy Success');
  CopyApp();

  // form.submit();
});

// update.click(function() {
//     // check validate form
//   	if (!form.reportValidity()) {
// 		alertValidation();
// 		return false;
// 	}
// 	updated();
//     // form.submit();
// });

async function CopyApp() {
  const data = new FormData(form);
  data.append("action", "copys");

  await axios
    .post("../CUSTOMIZECOPY/function/index_x.php", data)
    .then((response) => {
      alert("Copy Success");
      console.log(response.data);
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function updated() {
  const data = new FormData(form);
  data.append("action", "run");

  await axios
    .post("../CUSTOMIZECOPY/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      // clearForm(form);
      // window.location.reload();
      alert("Update Success!");
    })
    .catch((e) => {
      console.log(e);
    });
}

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../CUSTOMIZECOPY/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../CUSTOMIZECOPY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
      $("#loading").hide();
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
  if (form.id == "customizecopy") {
    // window.location.href = "index.php";
    window.location.href = "../CUSTOMIZECOPY/";
  }
  return false;
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

async function programDelete() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../CUSTOMIZECOPY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      return (window.location.href = $("#sessionUrl").val() + "/home.php");
    })
    .catch((e) => {
      console.log(e);
    });
}

function HandlePopupResult(code, result) {
  // console.log("result of popup is: " + code + ' : ' + result);
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/911/CUSTOMIZECOPY/index.php?" +
    code +
    "=" +
    result);
}

function unRequired() {
  let APPID = document.getElementById("APPID");
  let NEWAPPID = document.getElementById("NEWAPPID");
  let NEWAPPNM = document.getElementById("NEWAPPNM");

  APPID.classList[APPID.value !== "" ? "remove" : "add"]("req");
  NEWAPPID.classList[NEWAPPID.value !== "" ? "remove" : "add"]("req");
  NEWAPPNM.classList[NEWAPPNM.value !== "" ? "remove" : "add"]("req");
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
