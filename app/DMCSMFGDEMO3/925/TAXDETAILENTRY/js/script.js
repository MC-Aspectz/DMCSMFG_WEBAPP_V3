// action button
const insrts = $("#insert");
const updte = $("#update");
const deletes = $("#delete");
const COMMIT = $("#commit");

// form
const form = document.getElementById("tax_detail_entry");

COMMIT.click(function () {
  $("#loading").show();
  return commit("commit");
});

insrts.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return commit("insert");
});

updte.click(function () {
  UPD();
  console.log("Update");
});

async function searchs() {
  $("#loading").show();
  form.submit();
  // let data = new FormData(form);
  // data.append('action', 'search');
  // await axios.post('../CATALOGMASTER/function/index_x.php', data)
  // .then(response => {
  //     console.log(response.data)
  // })
  // .catch(e => {
  //     console.log(e);
  // });
}

async function UPD() {
  console.log("UPD in js");
  let rowno = $("#ROWNO").val();
  $("#TAXTYPECD" + rowno + "").val($("#TAXTYPECD").val());
  $("#TAXTYPECD_TD" + rowno + "").html($("#TAXTYPECD").val());
  $("#TAXTYPENAME" + rowno + "").val($("#TAXTYPENAME").val());
  $("#TAXTYPENAME_TD" + rowno + "").html($("#TAXTYPENAME").val());
  $("#TAXKBN" + rowno + "").val(document.getElementById("TAXKBN").value);
  $("#TAXKBN_TD" + rowno + "").html(document.getElementById("TAXKBN").value);
  $("#VATRATE" + rowno + "").val($("#VATRATE").val());
  $("#VATRATE_TD" + rowno + "").html($("#VATRATE").val());
  $("#TAXTTL" + rowno + "").val(document.getElementById("TAXTTL").value);
  $("#TAXTTL_TD" + rowno + "").html(document.getElementById("TAXTTL").value);
  $("#TDSTARTDATE" + rowno + "").val($("#TDSTARTDATE").val());
  $("#TDSTARTDATE_TD" + rowno + "").html($("#TDSTARTDATE").val());
  $("#TDENDDATE" + rowno + "").val($("#TDENDDATE").val());
  $("#TDENDDATE_TD" + rowno + "").html($("#TDENDDATE").val());

  enrty();
  await keepItemData();
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

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../TAXDETAILENTRY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      // window.location.href='index.php?refresh=1';
      // clearForm(form);
      unsetSession(form);
      $("#loading").hide();
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
    .post("../TAXDETAILENTRY/function/index_x.php", data)
    .then((response) => {
      $("#loading").hide();
      console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../TAXDETAILENTRY/function/index_x.php", data)
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
  window.location.href = "../TAXDETAILENTRY/";

  return false;
}

async function programDelete() {
  $("#loading").show();
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../TAXDETAILENTRY/function/index_x.php", data)
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
      }
    }
  });
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../TAXDETAILENTRY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

function unRequired() {
  let PROCESSTYPE = document.getElementById("PROCESSTYPE");
  let TAXTYPECD = document.getElementById("TAXTYPECD");
  let TDENDDATE = document.getElementById("TDENDDATE");

  PROCESSTYPE.classList[PROCESSTYPE.value !== "" ? "remove" : "add"]("req");
  TAXTYPECD.classList[TAXTYPECD.value !== "" ? "remove" : "add"]("req");
  TDENDDATE.classList[TDENDDATE.value !== "" ? "remove" : "add"]("req");
}
