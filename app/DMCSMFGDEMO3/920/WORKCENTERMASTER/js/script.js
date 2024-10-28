// input serach  DIVISIONCD STAFFCD
const DIVISIONCD = $("#DIVISIONCD");
const STAFFCD = $("#STAFFCD");
const WCCD = $("#WCCD");

const input_serach = [DIVISIONCD, STAFFCD, WCCD];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const guideindex3 = $("#guideindex3");
const search = $("#search");

const search_icon = [guideindex1, guideindex2, guideindex3, search];
//SEARCHWORKCENTER SEARCHDIVISION SEARCHSTAFF
guideindex1.attr(
  "href",
  $("#sessionUrl").val() +
    "/guide/DMCSMFGDEMO3/SEARCHWORKCENTER/index.php?index=1"
);
guideindex2.attr(
  "href",
  $("#sessionUrl").val() +
    "/guide/DMCSMFGDEMO3/SEARCHDIVISION/index.php?index=2"
);
guideindex3.attr(
  "href",
  $("#sessionUrl").val() + "/guide/DMCSMFGDEMO3/SEARCHSTAFF/index.php?index=3"
);

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

for (const icon of search_icon) {
  icon.click(function () {
    keepData();
  });
}

WCCD.change(function () {
  keepData();
  window.location.href = "index.php?WCCD=" + WCCD.val();
});

WCCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?WCCD=" + WCCD.val();
  }
});

DIVISIONCD.change(function () {
  keepData();
  window.location.href = "index.php?DIVISIONCD=" + DIVISIONCD.val();
});

DIVISIONCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?DIVISIONCD=" + DIVISIONCD.val();
  }
});

STAFFCD.change(function () {
  keepData();
  window.location.href = "index.php?STAFFCD=" + STAFFCD.val();
});

STAFFCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?STAFFCD=" + STAFFCD.val();
  }
});
// <!-- CURRENCYCD,CURRENCYUNITTYP,CURRENCYAMTTYP,CURRENCYDISP  -->

function entry1() {
  document.getElementById("insertA").disabled = false;
  document.getElementById("updateA").disabled = true;
  document.getElementById("deleteA").disabled = true;

  $("#KEEPSTATUS").val("ENT");

  //text WCCD WCNAME DIVISIONCD DIVISIONNAME STAFFCD STAFFNAME WCSTDHOURRATE WCSTDCOST WCHOURRATE WCCOST
  //dd WCTYP TIME_DIF
  //checkbox WCDISPLAYFLG
  $("#WCCD").attr("readonly", false).css("background-color", "white");
  $("#WCCD").val(""); //text
  $("#WCNAME").val(""); //text
  $("#DIVISIONCD").val(""); //text
  $("#DIVISIONNAME").val(""); //text
  $("#STAFFCD").val(""); //text
  $("#STAFFNAME").val(""); //text
  $("#WCSTDHOURRATE").val(""); //text
  $("#WCSTDCOST").val(""); //text
  $("#WCHOURRATE").val(""); //text
  $("#WCCOST").val(""); //text
  document.getElementById("WCTYP").value = ""; //dd
  // document.getElementById("TIME_DIF").value = '';//dd
  $("#WCDISPLAYFLG").val("F"); //checkbox
  $("#WCDISPLAYFLG").prop("checked", false); //checkbox
  $("#TAXINVOICENO").attr("readonly", false).css("background-color", "white");

  if (document.getElementById("KEEPSTATUS").value == "ENT") {
    console.log("ENT");
    document.getElementById("insertA").disabled = false;
    document.getElementById("updateA").disabled = true;
    document.getElementById("deleteA").disabled = true;
  } else if (document.getElementById("KEEPSTATUS").value == "UPD") {
    console.log("UPD");
    document.getElementById("insertA").disabled = true;
    document.getElementById("updateA").disabled = false;
    document.getElementById("deleteA").disabled = false;
  } else {
    document.getElementById("KEEPSTATUS").value;
    // console.log(document.getElementById('KEEPSTATUS').value);
    console.log("NONE");
    document.getElementById("updateA").disabled = true;
    document.getElementById("deleteA").disabled = true;
  }
}

// form
const form = document.getElementById("workcentermaster");

// action button
const insertA = $("#insertA");
const updateA = $("#updateA");
const deleteA = $("#deleteA");

// insrts.click(function() {
//     // check validate form
//     if (!form.reportValidity()) {
//         validationDialog();
//         return false;
//     }
//     return commit('insert');
// });

insertA.click(function () {
  // if($('#WCCD').val != '' && $('#WCNAME').val != '' && $('#DIVISIONCD').val != '' && $('#STAFFCD').val != ''
  // && $('#WCSTDHOURRATE').val != '' && $('#WCSTDCOST').val != ''&& $('#WCHOURRATE').val != '' && $('#WCCOST').val != '')
  if (
    document.getElementById("WCCD").value != "" &&
    document.getElementById("WCNAME").value != "" &&
    document.getElementById("DIVISIONCD").value != "" &&
    document.getElementById("STAFFCD").value != "" &&
    document.getElementById("WCSTDHOURRATE").value != "" &&
    document.getElementById("WCSTDCOST").value != "" &&
    document.getElementById("WCHOURRATE").value != "" &&
    document.getElementById("WCCOST").value != ""
  ) {
    return commit("insert");
  } else {
    // console.log('insert false');

    validationDialog();
    return false;
  }
});

updateA.click(function () {
  $("#KEEPSTATUS").val("ENT");

  return commit("update");
});

deleteA.click(function () {
  return commit("delete");
});

// function selectRow() {
//     $('table#search_table tr').click(function () {
//         $('table#search_table tr').removeAttr('id');

//         $(this).attr('id', 'click-row');

//         let item = $(this).closest('tr').children('td');

//         if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
//             document.getElementById("insertA").disabled = true;
//             document.getElementById("updateA").disabled = false;
//             document.getElementById("deleteA").disabled = false;
//             // document.getElementById("OK").disabled = true;
//             // console.log(item.eq(5).text());

//             // WCCD WCNAME DIVISIONCD STAFFCD WCTYP WCDISPLAYFLG WCSTDHOURRATE WCSTDCOST WCHOURRATE WCCOST
//             $('#WCCD').val(item.eq(0).text());//text
//             $('#WCNAME').val(item.eq(1).text());//text
//             $('#DIVISIONNAME').val(item.eq(2).text());//text
//             $('#STAFFNAME').val(item.eq(3).text());//text
//             $('#DIVISIONCD').val(item.eq(11).text());//text
//             $('#STAFFCD').val(item.eq(12).text());//text
//             document.getElementById("WCTYP").value = item.eq(4).text();//dd
//             if (item.eq(6).text() == "T") {
//                 $('#WCDISPLAYFLG').val(item.eq(6).text());
//                 $('#WCDISPLAYFLG').prop("checked", true)
//             } else {
//                 $('#WCDISPLAYFLG').val('F');
//                 $('#WCDISPLAYFLG').prop("checked", false)
//             }//checkbox
//             $('#WCSTDHOURRATE').val(item.eq(7).text());//text
//             $('#WCSTDCOST').val(item.eq(8).text());//text
//             $('#WCHOURRATE').val(item.eq(9).text());//text
//             $('#WCCOST').val(item.eq(10).text());//text

//         }
//     });
// }

// async function keepWcData() {
//     const data = new FormData(form);
//     data.append('action', 'keepWcData');
//     // console.log(data);
//     await axios.post('../WORKCENTERMASTER/function/index_x.php', data)
//     .then(response => {
//         $('#loading').hide();
//         // console.log(response.data)
//     })
//     .catch(e => {
//         console.log(e);
//     });
// }

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

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../WORKCENTERMASTER/function/index_x.php", data)
    .then((response) => {
      clearForm(form);

      document.getElementById("search").click();
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../WORKCENTERMASTER/function/index_x.php", data)
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
  window.location.href = "../WORKCENTERMASTER/";
  //  window.location.href = 'index.php';

  return false;
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
      } else {
        printReport();
      }
    }
  });
}

function formatDate(date) {
  var d = new Date(date),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();
  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;
  return [day, month, year].join("/");
}

async function keepData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../WORKCENTERMASTER/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
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

function digitFormat(num) {
  while (num.search(",") >= 0) {
    num = (num + "").replace(",", "");
  }
  return parseFloat(num).toFixed(2);
}
