// action button
const insert = $("#insert");
const updated = $("#update");
const deletes = $("#delete");
const commitA = $("#commit");

// form
const form = document.getElementById("routing_master");

//browse icon
const SEARCHITEM = $("#SEARCHITEM");
const SEARCHITEMPLACE = $("#SEARCHITEMPLACE");
const SEARCHJOBCODE = $("#SEARCHJOBCODE");
const ITEMCLONE = $("#ITEMCLONE"); //////

var ITEMPSSTYP = $("#ITEMPSSTYP").val();

SEARCHITEM.attr(
  "href",
  $("#sessionUrl").val() +
    "/guide/" +
    $("#comcd").val() +
    "/SEARCHITEM/index.php?index=1"
);
SEARCHITEMPLACE.attr(
  "href",
  $("#sessionUrl").val() +
    "/guide/" +
    $("#comcd").val() +
    "/SEARCHITEMPLACE/index.php?ITEMPSSTYP=" +
    ITEMPSSTYP +
    "&page=PROCESSMASTER"
);
SEARCHJOBCODE.attr(
  "href",
  $("#sessionUrl").val() +
    "/guide/" +
    $("#comcd").val() +
    "/SEARCHJOBCODE/index.php?index=3"
);
ITEMCLONE.attr(
  "href",
  $("#sessionUrl").val() +
    "/guide/" +
    $("#comcd").val() +
    "/SEARCHITEM/index.php?index=4"
); //////

const serach_icon = [SEARCHITEM, SEARCHITEMPLACE, SEARCHJOBCODE, ITEMCLONE];

//input search
const ITEMCD = $("#ITEMCD");
const ITEMPSSPLACE = $("#ITEMPSSPLACE");
const ITEMPSSJOBTYP = $("#ITEMPSSJOBTYP");
const IMPSSADDBOARDQTY = $("#IMPSSADDBOARDQTY");
const IMPSSADDSPM = $("#IMPSSADDSPM");
const IMPSSADDUSAGE = $("#IMPSSADDUSAGE");

const input_serach = [
  ITEMCD,
  ITEMPSSPLACE,
  ITEMPSSJOBTYP,
  IMPSSADDBOARDQTY,
  IMPSSADDSPM,
  IMPSSADDUSAGE,
];

for (const icon of serach_icon) {
  icon.click(async function () {
    await keepData();
    await keepItemData();
  });
}

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

commitA.click(function () {
  // check validate form
  // $('#loading').show();
  return commit("commit");
});

updated.click(function () {
  // check validate form
  // $('#loading').show();
  return update();
});

ITEMCD.change(function () {
  clearRow();
  keepData();
  window.location.href = "index.php?ITEMCD=" + ITEMCD.val();
  document.getElementById("search").click();
});

ITEMCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    clearRow();
    keepData();
    window.location.href = "index.php?ITEMCD=" + ITEMCD.val();
    document.getElementById("search").click();
  }
});

ITEMPSSPLACE.change(function () {
  keepData();
  window.location.href =
    "index.php?ITEMPSSPLACE=" +
    ITEMPSSPLACE.val() +
    "&ITEMPSSTYP=" +
    ITEMPSSTYP;
});

ITEMPSSPLACE.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?ITEMPSSPLACE=" + ITEMPSSPLACE.val();
  }
});

ITEMPSSJOBTYP.change(function () {
  keepData();
  window.location.href = "index.php?ITEMPSSJOBTYP=" + ITEMPSSJOBTYP.val();
});

ITEMPSSJOBTYP.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?ITEMPSSJOBTYP=" + ITEMPSSJOBTYP.val();
  }
});

IMPSSADDBOARDQTY.change(function () {
  keepData();
  window.location.href =
    "index.php?IMPSSADDBOARDQTY=" +
    IMPSSADDBOARDQTY.val() +
    "&IMPSSADDSPM=" +
    IMPSSADDSPM.val() +
    "&IMPSSADDUSAGE=" +
    IMPSSADDUSAGE.val();
});

IMPSSADDBOARDQTY.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href =
      "index.php?IMPSSADDBOARDQTY=" + IMPSSADDBOARDQTY.val();
  }
});

IMPSSADDSPM.change(function () {
  keepData();
  window.location.href =
    "index.php?IMPSSADDSPM=" +
    IMPSSADDSPM.val() +
    "&IMPSSADDBOARDQTY=" +
    IMPSSADDBOARDQTY.val() +
    "&IMPSSADDUSAGE=" +
    IMPSSADDUSAGE.val();
});

IMPSSADDSPM.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?IMPSSADDSPM=" + IMPSSADDSPM.val();
  }
});

IMPSSADDUSAGE.change(function () {
  keepData();
  window.location.href =
    "index.php?IMPSSADDUSAGE=" +
    IMPSSADDUSAGE.val() +
    "&IMPSSADDBOARDQTY=" +
    IMPSSADDBOARDQTY.val() +
    "&IMPSSADDSPM=" +
    IMPSSADDSPM.val();
});

IMPSSADDUSAGE.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?IMPSSADDUSAGE=" + IMPSSADDUSAGE.val();
  }
});

async function commit(method) {
  $("#loading").show();
  // console.log(method);
  let data = new FormData(form);
  data.append("action", method);
  // console.log(data);
  await axios
    .post("../PROCESSMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      clearForm(form);
      // document.getElementById("search").click();
      $("#loading").hide();
    })
    .catch((e) => {
      console.log(e);
    });
}

async function update() {
  let rowno = $("#ROWNO").val();
  if (!rowno) {
    rowno = localStorage.getItem("selectedRowIndex");
  }
  // console.log(rowno);
  // console.log($('#ROWNO').val());
  // console.log('Row Number:', rowno);
  $("#ITEMPSSNO" + rowno + "").val($("#ITEMPSSNO").val());
  $("#ITEMPSSNO_TD" + rowno + "").html($("#ITEMPSSNO").val());
  $("#ITEMPSSTYPSTR" + rowno + "").val(
    document.getElementById("ITEMPSSTYP").value
  ); //dd
  $("#ITEMPSSTYPSTR_TD" + rowno + "").html(
    $("#ITEMPSSTYP option:selected").text()
  ); //dd
  $("#ITEMPSSTYP" + rowno + "").val(
    document.getElementById("ITEMPSSTYP").value
  ); //dd
  $("#ITEMPSSTYP_TD" + rowno + "").html(
    $("#ITEMPSSTYP option:selected").text()
  ); //dd
  // console.log($('#ITEMPSSTYP').val());
  $("#ITEMPSSPLACE" + rowno + "").val($("#ITEMPSSPLACE").val());
  $("#ITEMPSSPLACE_TD" + rowno + "").html($("#ITEMPSSPLACE").val());
  // console.log($('#ITEMPSSPLACE').val());
  $("#PLACENAME" + rowno + "").val($("#PLACENAME").val());
  $("#PLACENAME_TD" + rowno + "").html($("#PLACENAME").val());
  // console.log($('#PLACENAME').val());
  $("#ITEMPSSJOBTYP" + rowno + "").val($("#ITEMPSSJOBTYP").val());
  $("#ITEMPSSJOBTYP_TD" + rowno + "").html($("#ITEMPSSJOBTYP").val());
  // console.log($('#ITEMPSSJOBTYP').val());
  $("#JOB_NAME" + rowno + "").val($("#JOB_NAME").val());
  $("#JOB_NAME_TD" + rowno + "").html($("#JOB_NAME").val());
  $("#ITEMPSSDESC" + rowno + "").val($("#ITEMPSSDESC").val());
  $("#ITEMPSSDESC_TD" + rowno + "").html($("#ITEMPSSDESC").val());
  $("#ITEMIMGLOC" + rowno + "").val($("#ITEMIMGLOC").val());
  $("#ITEMIMGLOC_TD" + rowno + "").html($("#ITEMIMGLOC").val());
  $("#IMPSSADDBOARDQTY" + rowno + "").val($("#IMPSSADDBOARDQTY").val());
  $("#IMPSSADDBOARDQTY_TD" + rowno + "").html($("#IMPSSADDBOARDQTY").val());
  $("#IMPSSADDSPM" + rowno + "").val($("#IMPSSADDSPM").val());
  $("#IMPSSADDSPM_TD" + rowno + "").html($("#IMPSSADDSPM").val());
  $("#IMPSSADDUSAGE" + rowno + "").val($("#IMPSSADDUSAGE").val());
  $("#IMPSSADDUSAGE_TD" + rowno + "").html($("#IMPSSADDUSAGE").val());
  $("#ITEMPSSPLANQTY" + rowno + "").val($("#ITEMPSSPLANQTY").val());
  $("#ITEMPSSPLANQTY_TD" + rowno + "").html($("#ITEMPSSPLANQTY").val());
  $("#ITEMUNITTYP" + rowno + "").val(
    document.getElementById("ITEMUNITTYP").value
  ); //dd
  $("#ITEMUNITTYP_TD" + rowno + "").html(
    $("#ITEMUNITTYP option:selected").text()
  ); //dd
  $("#ITEMPSSUNITPRC" + rowno + "").val($("#ITEMPSSUNITPRC").val());
  $("#ITEMPSSUNITPRC_TD" + rowno + "").html($("#ITEMPSSUNITPRC").val());
  $("#ITEMPSSPLANTIME" + rowno + "").val($("#ITEMPSSPLANTIME").val());
  $("#ITEMPSSPLANTIME_TD" + rowno + "").html($("#ITEMPSSPLANTIME").val());
  $("#ITEMPSSPLANTIMETYP" + rowno + "").val(
    document.getElementById("ITEMPSSPLANTIMETYP").value
  ); //dd
  $("#ITEMPSSPLANTIMETYP_TD" + rowno + "").html(
    $("#ITEMPSSPLANTIMETYP option:selected").text()
  ); //dd
  $("#ITEMPSSLINKTYP" + rowno + "").val(
    document.getElementById("ITEMPSSLINKTYP").value
  ); //dd
  $("#ITEMPSSLINKTYP_TD" + rowno + "").html(
    $("#ITEMPSSLINKTYP option:selected").text()
  ); //dd
  $("#ITEMPSSALLOWANCE" + rowno + "").val($("#ITEMPSSALLOWANCE").val());
  $("#ITEMPSSALLOWANCE_TD" + rowno + "").html($("#ITEMPSSALLOWANCE").val());

  enrty();
  // await keepItemData();
  $("#loading").show();
  await UDP();
}

async function UDP() {
  // console.log("UDP");
  const data = new FormData(form);
  data.append("action", "update");
  // console.log(data);
  await axios
    .post("../PROCESSMASTER/function/index_x.php", data)
    .then((response) => {
      window.location.href = "../PROCESSMASTER/";
      $("#loading").hide();
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function keepItemData() {
  const data = new FormData(form);
  data.append("action", "keepItemData");
  // console.log(data);
  await axios
    .post("../PROCESSMASTER/function/index_x.php", data)
    .then((response) => {
      $("#loading").hide();
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetItemData(lineIndex) {
  $("#loading").show();
  let data = new FormData(form);
  data.append("action", "unsetItemData");
  data.append("lineIndex", lineIndex);
  await axios
    .post("../PROCESSMASTER/function/index_x.php", data)
    .then((response) => {
      $("#loading").hide();
      // console.log(response.data);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../PROCESSMASTER/function/index_x.php", data)
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

  // clearing row
  clearRow();

  // refresh
  window.location.href = "../PROCESSMASTER/";

  return false;
}

function clearRow() {
  var selectedRowIndex = localStorage.getItem("selectedRowIndex");
  if (selectedRowIndex !== null) {
    $("table#table tr").eq(selectedRowIndex).removeAttr("id");
    localStorage.removeItem("selectedRowIndex");
  }
}

function changeRowId() {
  var elem = document.getElementsByTagName("tr");
  for (var i = 0; i < elem.length; i++) {
    // console.log(i);
    if (elem[i].id) {
      index_x = Number(elem[i].rowIndex);
      elem[i].id = "rowId" + index_x;
    }
  }
}

function emptyRow(n) {
  $("table tbody").append(
    '<tr class="tr_border" id="rowId' +
      n +
      ">" +
      '<td class="td-class row-id"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td></tr>'
  );
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

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../PROCESSMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

function digitFormat(num) {
  while (num.search(",") >= 0) {
    num = (num + "").replace(",", "");
  }
  return parseFloat(num).toFixed(2);
}

function digitFormat2(num) {
  while (num.search(",") >= 0) {
    num = (num + "").replace(",", "");
  }
  return parseFloat(num).toFixed(3);
}
