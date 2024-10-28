// action button
const commitA = $("#commit");
const modify = $("#modify");
const deletes = $("#delete");
const OK = $("#ok");

// form
const form = document.getElementById("job_code_master");

commitA.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return commit("commit");
});

modify.click(function () {
  // check validate form
  // $('#loading').show();
  return update();
});

async function searchs() {
  $("#loading").show();
  form.submit();
  // let data = new FormData(form);
  // data.append('action', 'search');
  // await axios.post('../JOBCODEMASTER/function/index_x.php', data)
  // .then(response => {
  //     console.log(response.data)
  // })
  // .catch(e => {
  //     console.log(e);
  // });
}

async function commit(method) {
  $("#loading").show();
  // console.log(method);
  let data = new FormData(form);
  data.append("action", method);
  // console.log(data);
  await axios
    .post("../JOBCODEMASTER/function/index_x.php", data)
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
  // console.log($('#ROWNO').val());
  // console.log('Row Number:', rowno);
  $("#JOBCD" + rowno + "").val($("#JOBCD").val());
  $("#JOBCD_TD" + rowno + "").html($("#JOBCD").val());
  $("#JOBNAME" + rowno + "").val($("#JOBNAME").val());
  $("#JOBNAME_TD" + rowno + "").html($("#JOBNAME").val());
  $("#JOBTYPE" + rowno + "").val(document.getElementById("JOBTYPE").value); //dd
  $("#JOBTYPE_TD" + rowno + "").html($("#JOBTYPE option:selected").text()); //dd
  $("#JOBGROUP" + rowno + "").val(document.getElementById("JOBGROUP").value); //dd
  $("#JOBGROUP_TD" + rowno + "").html($("#JOBGROUP option:selected").text()); //dd

  enrty();
  await commit("modify");
}

async function unsetItemData(lineIndex) {
  $("#loading").show();
  let data = new FormData(form);
  data.append("action", "unsetItemData");
  data.append("lineIndex", lineIndex);
  await axios
    .post("../JOBCODEMASTER/function/index_x.php", data)
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
    .post("../JOBCODEMASTER/function/index_x.php", data)
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
  window.location.href = "../JOBCODEMASTER/";

  return false;
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
    .post("../JOBCODEMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}
