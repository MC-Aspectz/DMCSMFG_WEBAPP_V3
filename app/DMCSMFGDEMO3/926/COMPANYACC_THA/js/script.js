// search
const searchaccount = $("#searchaccount");
const searchaccount2 = $("#searchaccount2");
const searchaccount3 = $("#searchaccount3");
const searchaccount4 = $("#searchaccount4");
const searchaccount5 = $("#searchaccount5");
const searchaccountp1 = $("#searchaccountp1");
const searchaccountp2 = $("#searchaccountp2");
const searchaccountwht1 = $("#searchaccountwht1");
const searchaccountwht2 = $("#searchaccountwht2");
const searchaccountstd1 = $("#searchaccountstd1");
const searchaccountstd2 = $("#searchaccountstd2");
const searchaccountstdrec1 = $("#searchaccountstdrec1");
const searchaccountstdrec2 = $("#searchaccountstdrec2");
//const setacc = $("#setacc");

//Button Search
searchaccount.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=1"
);
searchaccount2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=2"
);
searchaccount3.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=3"
);
searchaccount4.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=4"
);
searchaccount5.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=5"
);
searchaccountp1.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=p1"
);
searchaccountp2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=p2"
);
searchaccountwht1.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=wht1"
);
searchaccountwht2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=wht2"
);
searchaccountstd1.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=stdpay1"
);
searchaccountstd2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=stdpay2"
);
searchaccountstdrec1.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=stdrec1"
);
searchaccountstdrec2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHACCOUNT/index.php?index=stdrec2"
);

//input serach
const ACCCD1 = $("#ACCCD1");
const ACCCD2 = $("#ACCCD2");
const ACCCD3 = $("#ACCCD3");
const ACCCD4 = $("#ACCCD4");
const ACCCD5 = $("#ACCCD5");
const ACCCDP1 = $("#ACCCDP1");
const ACCCDP2 = $("#ACCCDP2");
const WHTCD1 = $("#WHTCD1");
const WHTCD2 = $("#WHTCD2");
const STDPAYMENTCD1 = $("#STDPAYMENTCD1");
const STDPAYMENTCD2 = $("#STDPAYMENTCD2");
const STDRECEIVECD1 = $("#STDRECEIVECD1");
const STDRECEIVECD2 = $("#STDRECEIVECD2");

const input_serach = [
  ACCCD1,
  ACCCD2,
  ACCCD3,
  ACCCD4,
  ACCCD5,
  ACCCDP1,
  ACCCDP2,
  WHTCD1,
  WHTCD2,
  STDPAYMENTCD1,
  STDPAYMENTCD2,
  STDRECEIVECD1,
  STDRECEIVECD2,
];

// action button
const insert = $("#insert");
const update = $("#update");
const del = $("#delete");

// form
const form = document.getElementById("companyacc");

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

update.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  updated();
  // form.submit();
});

ACCCD1.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCD1.val() + "&index=1";
  alert("Update Success!");
});

ACCCD1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCD1.val() + "&index=1";
    //    alert("Update Success!");
  }
});

ACCCD2.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCD2.val() + "&index=2";
});

ACCCD2.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCD2.val() + "&index=2";
  }
});
ACCCD3.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCD3.val() + "&index=3";
});

ACCCD3.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCD3.val() + "&index=3";
  }
});
ACCCD4.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCD4.val() + "&index=4";
});

ACCCD4.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCD4.val() + "&index=4";
  }
});
ACCCD5.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCD5.val() + "&index=5";
});

ACCCD5.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCD5.val() + "&index=5";
  }
});
ACCCDP1.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCDP1.val() + "&index=p1";
});

ACCCDP1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCDP1.val() + "&index=p1";
  }
});
ACCCDP2.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + ACCCDP2.val() + "&index=p2";
});

ACCCDP2.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + ACCCDP2.val() + "&index=p2";
  }
});
WHTCD1.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + WHTCD1.val() + "&index=wht1";
});

WHTCD1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + WHTCD1.val() + "&index=wht1";
  }
});
WHTCD2.change(function () {
  keeyData();
  window.location.href = "index.php?acccode=" + WHTCD2.val() + "&index=wht2";
});

WHTCD2.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href = "index.php?acccode=" + WHTCD2.val() + "&index=wht2";
  }
});
STDPAYMENTCD1.change(function () {
  keeyData();
  window.location.href =
    "index.php?acccode=" + STDPAYMENTCD1.val() + "&index=stdpay1";
});

STDPAYMENTCD1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href =
      "index.php?acccode=" + STDPAYMENTCD1.val() + "&index=stdpay1";
  }
});
STDPAYMENTCD2.change(function () {
  keeyData();
  window.location.href =
    "index.php?acccode=" + STDPAYMENTCD2.val() + "&index=stdpay2";
});

STDPAYMENTCD2.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href =
      "index.php?acccode=" + STDPAYMENTCD2.val() + "&index=stdpay2";
  }
});

STDRECEIVECD1.change(function () {
  keeyData();
  window.location.href =
    "index.php?acccode=" + STDRECEIVECD1.val() + "&index=stdrec1";
});

STDRECEIVECD1.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href =
      "index.php?acccode=" + STDRECEIVECD1.val() + "&index=stdrec1";
  }
});
STDRECEIVECD2.change(function () {
  keeyData();
  window.location.href =
    "index.php?acccode=" + STDRECEIVECD2.val() + "&index=stdrec2";
});

STDRECEIVECD2.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keeyData();
    window.location.href =
      "index.php?acccode=" + STDRECEIVECD2.val() + "&index=stdrec2";
  }
});

async function updated() {
  const data = new FormData(form);
  data.append("action", "update");

  await axios
    .post("../COMPANYACC_THA/function/index_x.php", data)
    .then((response) => {
      //console.log(response.data)
      // clearForm(form);
      window.location.reload();
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
    .post("../COMPANYACC_THA/function/index_x.php", data)
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
    .post("../COMPANYACC_THA/function/index_x.php", data)
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
  if (form.id == "companyacc") {
    // window.location.href = "index.php";
    window.location.href = "../COMPANYACC_THA/";
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
