// search
const searchitem = $("#searchitem");
const searchboi = $("#searchboi");
const searchcategory = $("#searchcategory");
const searchsupplier = $("#searchsupplier");
const searchlocation = $("#searchlocation");
const CLOSEPAGE = $("#CLOSEPAGE");

searchitem.attr("href", $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php');
searchboi.attr("href", $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php');
searchcategory.attr(
  "href",
  $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php'
);
searchsupplier.attr(
  "href",
  $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php'
);
searchlocation.attr(
  "href",
  $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTORAGE/index.php'
);

//input serach
const ITEMCD = $("#ITEMCD");
const CATALOGCD = $("#CATALOGCD");
const SUPPLIERCD = $("#SUPPLIERCD");
const STORAGECD = $("#STORAGECD");

const input_serach = [ITEMCD, CATALOGCD, SUPPLIERCD, STORAGECD];
const serachIcon = [
  searchitem,
  searchboi,
  searchcategory,
  searchsupplier,
  searchlocation,
];

// requried input
const ITEMSEARCH = $("#ITEMSEARCH");
const ITEMPOUNITRATE = $("#ITEMPOUNITRATE");
const ITEMLEADTIME = $("#ITEMLEADTIME");

// action button
const insert = $("#insert");
const update = $("#update");
const del = $("#delete");

// form
const form = document.getElementById("itemmaster");

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

for (const input of serachIcon) {
  input.click(function () {
    keeyData();
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
  if (ITEMCD.val() == "") {
    return false;
  }
  deleted();
  // form.submit();
});

CLOSEPAGE.click(function () {
  return programDelete();
});

ITEMCD.change(function () {
  window.location.href = "index.php?itemcd=" + ITEMCD.val();
  keeyData();
});

ITEMCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?itemcd=" + ITEMCD.val();
    keeyData();
  }
});

CATALOGCD.change(function () {
  window.location.href = "index.php?categorycd=" + CATALOGCD.val();
  keeyData();
});

CATALOGCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?categorycd=" + CATALOGCD.val();
    keeyData();
  }
});

SUPPLIERCD.change(function () {
  window.location.href = "index.php?suppliercd=" + SUPPLIERCD.val();
  keeyData();
});

SUPPLIERCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?suppliercd=" + SUPPLIERCD.val();
    keeyData();
  }
});

STORAGECD.change(function () {
  window.location.href = "index.php?locationcd=" + STORAGECD.val();
  keeyData();
});

STORAGECD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?locationcd=" + STORAGECD.val();
    keeyData();
  }
});

async function inserted() {
  const data = new FormData(form);
  data.append("action", "insert");

  await axios
    .post("../ITEMMASTER/function/index_x.php", data)
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
    .post("../ITEMMASTER/function/index_x.php", data)
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
    .post("../ITEMMASTER/function/index_x.php", data)
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
    .post("../ITEMMASTER/function/index_x.php", data)
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
  data.append("systemName", "ItemMaster");

  await axios
    .post("../ITEMMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
      // if(response.data) {
      //     clearForm(form);
      // }
    })
    .catch((e) => {
      console.log(e);
    });
}

async function programDelete() {
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../ITEMMASTER/function/index_x.php", data)
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
    switch (inputs[i].type) {
      // case 'hidden':
      case "text":
        inputs[i].value = "";
        break;
      case "radio":
      case "checkbox":
        inputs[i].checked = false;
    }
  }
  // clearing selects
  var selects = form.getElementsByTagName("select");
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName("textarea");
  for (var i = 0; i < text.length; i++) text[i].innerHTML = "";

  // clearing table
  $("#table_result > tbody > tr").remove();

  // refresh
  if (form.id == "itemmaster") {
    // window.location.href = "index.php";
    window.location.href = "../ITEMMASTER/";
  }
  return false;
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function unRequired() {
    if(ITEMCD.val() != '') {
        document.getElementById('ITEMCD').classList.remove('req');
    } else {
        document.getElementById('ITEMCD').classList.add('req');
    }
  
    if(ITEMSEARCH.val() != '') {
        document.getElementById('ITEMSEARCH').classList.remove('req');
    } else {
        document.getElementById('ITEMSEARCH').classList.add('req');
    }

    if(CATALOGCD.val() != '') {
        document.getElementById('CATALOGCD').classList.remove('req');
    } else {
        document.getElementById('CATALOGCD').classList.add('req');
    }

    if(ITEMPOUNITRATE.val() != '') {
        document.getElementById('ITEMPOUNITRATE').classList.remove('req');
    } else {
        document.getElementById('ITEMPOUNITRATE').classList.add('req');
    }

    if(STORAGECD.val() != '') {
        document.getElementById('STORAGECD').classList.remove('req');
    } else {
        document.getElementById('STORAGECD').classList.add('req');
    }
  
    if(ITEMLEADTIME.val() != '') {
        document.getElementById('ITEMLEADTIME').classList.remove('req');
    } else {
        document.getElementById('ITEMLEADTIME').classList.add('req');
    }
      
    let ITEMTYP = document.getElementById("ITEMTYP");
    if(ITEMTYP.selectedIndex != 0) {
        ITEMTYP.classList.remove('req');
    } else {
        ITEMTYP.classList.add('req');
    }

    let ITEMUNITTYP = document.getElementById("ITEMUNITTYP");
    if(ITEMUNITTYP.selectedIndex != 0) {
        ITEMUNITTYP.classList.remove('req');
    } else {
        ITEMUNITTYP.classList.add('req');
    }

    let ITEMPOUNITTYP = document.getElementById("ITEMPOUNITTYP");
    if(ITEMPOUNITTYP.selectedIndex != 0) {
        ITEMPOUNITTYP.classList.remove('req');
    } else {
        ITEMPOUNITTYP.classList.add('req');
    }

    let ITEMORDRULETYP = document.getElementById("ITEMORDRULETYP");
    if(ITEMORDRULETYP.selectedIndex != 0) {
        ITEMORDRULETYP.classList.remove('req');
    } else {
        ITEMORDRULETYP.classList.add('req');
    }
}

async function get_master() {
  // try {
  //     axios.get("../ITEMMASTER/item_master_submit.php?cd=test&dd=2")
  //     .then(function (response) {
  //         console.log(response.data);
  //         if (response.data.error) {
  //           this.errorMsg = response.data.message;
  //         } else {
  //           this.projects = response.data.projects;
  //         }
  //     })
  // } catch (error) {
  //     console.error(error);
  // }
}


