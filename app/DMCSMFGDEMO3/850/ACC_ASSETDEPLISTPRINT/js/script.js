// search
const assetaccguide = $("#assetaccguide");
const assetaccguide2 = $("#assetaccguide2");
// const setacc = $("#setacc");

// assetaccguide.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETACCGUIDE/index.php?index=1');
assetaccguide.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/ASSETACCGUIDE/index.php?page=ACC_ASSETDEPLISTPRINT&index=1",
    "authWindow",
    "width=1200,height=600"
  );
});
// assetaccguide2.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ASSETACCGUIDE/index.php?index=2');
assetaccguide2.click(function (e) {
  e.preventDefault();
  winopened = window.open(
    $("#sessionUrl").val() +
      "/guide/" +
      $("#comcd").val() +
      "/ASSETACCGUIDE/index.php?page=ACC_ASSETDEPLISTPRINT&index=2",
    "authWindow",
    "width=1200,height=600"
  );
});

//input serach
const YEAR = $("#YEAR");
const GA1 = $("#GA1");
const GA2 = $("#GA2");
const input_serach = [GA1, GA2];

// action button
//const insert = $("#insert");
const PRINT = $("#PRINT");
//const del = $("#delete");

// form
const form = document.getElementById("reportassetdepreciationlist");

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

GA1.change(function () {
  window.location.href = "index.php?ASSETACC=" + GA1.val() + "&index=1";
  keeyData();
});

GA1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?ASSETACC=" + GA1.val() + "&index=1";
    keeyData();
  }
});

GA2.change(function () {
  window.location.href = "index.php?ASSETACC=" + GA2.val() + "&index=2";
  keeyData();
});

GA2.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?ASSETACC=" + GA2.val() + "&index=2";
    keeyData();
  }
});

// GA1.on('keyup change', function(e) {
//     if(e.type === 'change') {
//         keepData();
//         window.location.href="index.php?Assetacccode=" + GA1.val()+"&index=1";
//     } else if( e.key === 'Enter' || e.keyCode === 13) {
//         keepData();
//         window.location.href="index.php?Assetacccode=" + GA1.val()+"&index=1";
//     }
// });

// GA2.on('keyup change', function(e) {
//     if(e.type === 'change') {
//         keepData();
//         window.location.href="index.php?Assetacccode=" + GA2.val()+"&index=2";
//     } else if( e.key === 'Enter' || e.keyCode === 13) {
//         keepData();
//         window.location.href="index.php?Assetacccode=" + GA2.val()+"&index=2";
//     }
// });
PRINT.click(async function () {
  // alert("TEST");
  Prints();
  return actionDialog(4);
});

async function Prints() {
  const data = new FormData(form);
  data.append("action", "print");

  await axios
    .post("../ACC_ASSETDEPLISTPRINT/function/index_x.php", data)
    .then((response) => {
      //  console.log(response.data)
      // clearForm(form);
      // window.location.reload();
      //alert("Update Success!");
    })
    .catch((e) => {
      console.log(e);
    });
}

async function printed() {
  // alert("TEST");
  // await keeyData();
  // var popupWindow = window.open('https://web-develop.dmcs.biz/DMCS_WEBAPP/home.php', '_blank', 'width=800, height=800');
  var popupWindow = window.open(
    "../ACC_ASSETDEPLISTPRINT/print.php",
    "_blank",
    "width=800, height=800"
  );
  // setTimeout(function() { popupWindow.close(); }, 10000);
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");
  await axios
    .post("../ACC_ASSETDEPLISTPRINT/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}

async function updated() {
  const data = new FormData(form);
  data.append("action", "run");

  await axios
    .post("../ACC_ASSETDEPLISTPRINT/function/index_x.php", data)
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

function HandlePopupResultIndex(code, result, index) {
  // console.log("result of popup is: " + code + ' : ' + result);
  $("#loading").show();
  return (window.location.href =
    $("#sessionUrl").val() +
    "/app/" +
    $("#comcd").val() +
    "/850/ACC_ASSETDEPLISTPRINT/index.php?" +
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
    "/850/ACC_ASSETDEPLISTPRINT/index.php?" +
    code +
    "=" +
    result);
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../ACC_ASSETDEPLISTPRINT/function/index_x.php", data)
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
    .post("../ACC_ASSETDEPLISTPRINT/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      return (window.location.href = $("#sessionUrl").val() + "/home.php");
    })
    .catch((e) => {
      console.log(e);
    });
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
      } else if (type == 4) {
        return printed();
      }
    }
  });
}

function alertWarning(msg, btnyes, btnno) {
  return Swal.fire({
    title: "",
    text: msg,
    background: "#8ca3a3",
    showCancelButton: false,
    confirmButtonColor: "silver",
    cancelButtonColor: "silver",
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
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
  if (form.id == "reportassetdepreciationlist") {
    // window.location.href = "index.php";
    window.location.href = "../ACC_ASSETDEPLISTPRINT/";
  }
  return false;
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
  return num.replace(/[^0-9.,]/g, "").replace(/(\..*?)\..*/g, "$1");
}

function digitFormat(num) {
  while (num.search(",") >= 0) {
    num = (num + "").replace(",", "");
  }
  return parseFloat(num).toFixed(6);
}

function formatDate(date) {
  var d = new Date(date),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();
  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;
  return [year, month, day].join("-");
}
function isArray(what) {
  return Object.prototype.toString.call(what) === "[object Array]";
}
