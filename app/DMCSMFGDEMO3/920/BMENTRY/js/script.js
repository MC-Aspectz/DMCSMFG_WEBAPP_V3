// input serach onchange  DIVISIONCD STAFFCD
const BMPITEMCD = $("#BMPITEMCD");
const STAFFCD = $("#STAFFCD");
const ITEMCLONE = $("#ITEMCLONE");
const BMCITEMCD = $("#BMCITEMCD");
const BMEXPDT = $("#BMEXPDT");

const input_serach = [BMPITEMCD, STAFFCD, BMCITEMCD, ITEMCLONE, BMEXPDT];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const guideindex3 = $("#guideindex3");
const guideindex4 = $("#guideindex4");
const search = $("#search");
const search2 = $("#search2");

const search_icon = [
  guideindex1,
  guideindex2,
  guideindex3,
  guideindex4,
  search,
];
//SEARCHITEM SEARCHSTAFF SEARCHITEM SEARCHITEM
guideindex1.attr(
  "href",
  $("#sessionUrl").val() + "/guide/DMCSMFGDEMO3/SEARCHITEM/index.php?index=1"
);
guideindex2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/DMCSMFGDEMO3/SEARCHSTAFF/index.php?index=2"
);
guideindex3.attr(
  "href",
  $("#sessionUrl").val() + "/guide/DMCSMFGDEMO3/SEARCHITEM/index.php?index=3"
);
guideindex4.attr(
  "href",
  $("#sessionUrl").val() + "/guide/DMCSMFGDEMO3/SEARCHITEM/index.php?index=4"
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

BMPITEMCD.change(function () {
  keepData();
  window.location.href = "index.php?BMPITEMCD=" + BMPITEMCD.val();
});

BMPITEMCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?BMPITEMCD=" + BMPITEMCD.val();
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

BMCITEMCD.change(function () {
  keepData();
  window.location.href = "index.php?BMCITEMCD=" + BMCITEMCD.val();
});

BMCITEMCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?BMCITEMCD=" + BMCITEMCD.val();
  }
});

ITEMCLONE.change(function () {
  keepData();
  window.location.href = "index.php?ITEMCLONE=" + ITEMCLONE.val();
});

ITEMCLONE.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?ITEMCLONE=" + ITEMCLONE.val();
  }
});

BMEXPDT.change(function () {
  keepData();
  window.location.href = "index.php?BMEXPDT=" + BMEXPDT.val();
});

BMEXPDT.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?BMEXPDT=" + BMEXPDT.val();
  }
});
// <!-- CURRENCYCD,CURRENCYUNITTYP,CURRENCYAMTTYP,CURRENCYDISP  -->

function entry1() {
  document.getElementById("ok").disabled = false;
  document.getElementById("updateA").disabled = true;
  document.getElementById("deleteA").disabled = true;

  $("#KEEPSTATUS").val("ENT");

  //text BMBASETYP ITEMCLONE BMCITEMCD CITEMNAME CITEMSPEC CITEMDRAWNO BMQTY BMADDSTDUNITPRC RUNNER_WGT REUSE_RATE BMADDSRPG BMADDSRPUNITPRC BMSCRAPRATE BMISSUEDT BMEXPDT BMREM
  //dd ITEMUNITTYP BMSUPPLYTYP
  //checkbox BMPHANTOMFLG

  $("#BMBASETYP").val(""); //text
  $("#ITEMCLONE").val(""); //text
  $("#BMCITEMCD").val(""); //text
  $("#CITEMNAME").val(""); //text
  $("#CITEMSPEC").val(""); //text
  $("#CITEMDRAWNO").val(""); //text
  $("#BMQTY").val(""); //text
  $("#BMADDSTDUNITPRC").val(""); //text
  $("#RUNNER_WGT").val("0.00"); //text
  $("#REUSE_RATE").val("0.00"); //text
  $("#BMADDSRPG").val("0.00"); //text
  $("#BMADDSRPUNITPRC").val("0.00"); //text
  $("#BMSCRAPRATE").val("0.00"); //text
  $("#BMISSUEDT").val(""); //text
  $("#BMEXPDT").val(""); //text
  $("#BMREM").val(""); //text
  // RUNNER_WGT REUSE_RATE BMADDSRPG BMADDSRPUNITPRC BMSCRAPRATE date('Y-m-d')
  document.getElementById("ITEMUNITTYP").value = ""; //dd
  document.getElementById("BMSUPPLYTYP").value = "0"; //dd

  $("#BMPHANTOMFLG").val("F"); //checkbox
  $("#BMPHANTOMFLG").prop("checked", false); //checkbox

  // $('#TAXINVOICENO').attr('readonly', false).css('background-color', 'white');
  // $('#WCCD').attr('readonly', false).css('background-color', 'white');

  if (document.getElementById("KEEPSTATUS").value == "ENT") {
    console.log("ENT");
    document.getElementById("ok").disabled = false;
    document.getElementById("updateA").disabled = true;
    document.getElementById("deleteA").disabled = true;
  } else if (document.getElementById("KEEPSTATUS").value == "UPD") {
    console.log("UPD");
    document.getElementById("ok").disabled = true;
    document.getElementById("updateA").disabled = false;
    document.getElementById("deleteA").disabled = false;
  } else {
    document.getElementById("KEEPSTATUS").value;
    // console.log(document.getElementById('KEEPSTATUS').value);
    console.log("NONE");
    document.getElementById("updateA").disabled = true;
    document.getElementById("deleteA").disabled = true;
  }
  keepBomData();
}

function emptyRow(n) {
  $("table tbody").append(
    '<tr class="tr_border" id="rowId' +
      n +
      ">" +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td>' +
      '<td class="td-class"></td></tr>'
  );
}

// form
const form = document.getElementById("bmentry");

// action button search2 clear1  copy commitA  updateA deleteA  ok

const commitA = $("#commitA");
const ok = $("#ok");
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

// insertA.click(function() {

//     // if($('#WCCD').val != '' && $('#WCNAME').val != '' && $('#DIVISIONCD').val != '' && $('#STAFFCD').val != ''
//     // && $('#WCSTDHOURRATE').val != '' && $('#WCSTDCOST').val != ''&& $('#WCHOURRATE').val != '' && $('#WCCOST').val != '')
//     if( document.getElementById('WCCD').value != '' && document.getElementById('WCNAME').value != '' && document.getElementById('DIVISIONCD').value != '' &&
//     document.getElementById('STAFFCD').value != '' && document.getElementById('WCSTDHOURRATE').value != '' && document.getElementById('WCSTDCOST').value != '' &&
//     document.getElementById('WCHOURRATE').value != '' && document.getElementById('WCCOST').value != '' )
//     {
//         return commit('insert');
//     }
//     else{
//         // console.log('insert false');

//         validationDialog();
//         return false;
//     }

// });

commitA.click(function () {
  $("#KEEPSTATUS").val("ENT");

  $("#loading").show();
  return commit("commit");
});

updateA.click(function () {
  $("#KEEPSTATUS").val("ENT");

  // $('#loading').show();
  return update();
});

// BMSUPPLYTYPSTR

async function update() {
  let dd2 = "",
    dd3 = "";
  const data = new FormData(form);
  data.append("action", "dd2");
  await axios
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      console.log("dd2");
      console.log(response.data);
      $.each(response.data, function (key, value) {
        if (document.getElementById("ITEMUNITTYP").value == key) {
          dd2 = value;
        }
      });
    })
    .catch((e) => {
      console.log(e);
    });

  data.append("action", "dd3");
  await axios
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      console.log("dd3");
      console.log(response.data);
      $.each(response.data, function (key, value) {
        if (document.getElementById("BMSUPPLYTYP").value == key) {
          dd3 = value;
        }
      });
    })
    .catch((e) => {
      console.log(e);
    });

  console.log(dd2);
  console.log(dd3);
  // console.log($("#ITEMUNITTYP option:selected").text());//UT
  // console.log(document.getElementById("ITEMUNITTYP").value);//UT
  // console.log($("#BMSUPPLYTYP option:selected").text());//UT
  // console.log(document.getElementById("BMSUPPLYTYP").value);//UT
  // <?php foreach ($dd2 as $key => $item) { ?>
  //     <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
  // <?php }?>
  //$data['DD2']

  let rowno = $("#ROWNO").val();
  $("#BMCITEMCD" + rowno + "").val($("#BMCITEMCD").val());
  $("#BMCITEMCD_TD" + rowno + "").html($("#BMCITEMCD").val());
  $("#CITEMNAME" + rowno + "").val($("#CITEMNAME").val());
  $("#CITEMNAME_TD" + rowno + "").html($("#CITEMNAME").val());
  $("#CITEMSPEC" + rowno + "").val($("#CITEMSPEC").val());
  $("#CITEMSPEC_TD" + rowno + "").html($("#CITEMSPEC").val());
  $("#BMBASETYP" + rowno + "").val($("#BMBASETYP").val());
  $("#BMBASETYP_TD" + rowno + "").html($("#BMBASETYP").val());
  $("#BMQTY" + rowno + "").val($("#BMQTY").val());
  $("#BMQTY_TD" + rowno + "").html($("#BMQTY").val());
  $("#ITEMUNITTYP" + rowno + "").html($("#ITEMUNITTYP option:selected").text()); //dd
  $("#ITEMUNITTYP_TD" + rowno + "").html(
    document.getElementById("ITEMUNITTYP").value
  ); //dd UT /
  $("#ITEMUNITTYPSTR_TD" + rowno + "").html(dd2); //dd ค่าที่โชว์
  $("#ITEMUNITTYPSTR" + rowno + "").val(
    document.getElementById("ITEMUNITTYP").value
  ); //dd ค่าที่เก็บ
  // $('#ITEMUNITTYPSTR'+rowno+'').html('TEST');//dd UT /
  // console.log($data['BM'][rowno]['ITEMUNITTYPSTR']);
  $("#BMADDSTDUNITPRC" + rowno + "").val($("#BMADDSTDUNITPRC").val());
  $("#BMADDSTDUNITPRC_TD" + rowno + "").html($("#BMADDSTDUNITPRC").val());
  $("#CURRENCYDISP" + rowno + "").val($("#CURRENCYDISP").val());
  $("#CURRENCYDISP_TD" + rowno + "").html($("#CURRENCYDISP").val());
  $("#RUNNER_WGT" + rowno + "").val($("#RUNNER_WGT").val());
  $("#RUNNER_WGT_TD" + rowno + "").html($("#RUNNER_WGT").val());
  $("#REUSE_RATE" + rowno + "").val($("#REUSE_RATE").val());
  $("#REUSE_RATE_TD" + rowno + "").html($("#REUSE_RATE").val());
  $("#BMADDSRPG" + rowno + "").val($("#BMADDSRPG").val());
  $("#BMADDSRPG_TD" + rowno + "").html($("#BMADDSRPG").val());
  $("#BMADDSRPUNITPRC" + rowno + "").val($("#BMADDSRPUNITPRC").val());
  $("#BMADDSRPUNITPRC_TD" + rowno + "").html($("#BMADDSRPUNITPRC").val());
  $("#BMSCRAPRATE" + rowno + "").val($("#BMSCRAPRATE").val());
  $("#BMSCRAPRATE_TD" + rowno + "").html($("#BMSCRAPRATE").val());
  $("#BMISSUEDT" + rowno + "").val($("#BMISSUEDT").val());
  $("#BMISSUEDT_TD" + rowno + "").html(
    $("#BMISSUEDT").val().replaceAll("-", "/")
  );
  $("#BMEXPDT" + rowno + "").val($("#BMEXPDT").val());
  $("#BMEXPDT_TD" + rowno + "").html($("#BMEXPDT").val().replaceAll("-", "/"));
  $("#BMSUPPLYTYP" + rowno + "").html($("#BMSUPPLYTYP option:selected").text()); //dd
  $("#BMSUPPLYTYP_TD" + rowno + "").html(
    document.getElementById("BMSUPPLYTYP").value
  ); //dd
  $("#BMSUPPLYTYPSTR_TD" + rowno + "").html(dd3); //dd ค่าที่โชว์
  $("#BMSUPPLYTYPSTR" + rowno + "").val(
    document.getElementById("BMSUPPLYTYP").value
  ); //dd ค่าที่เก็บ
  $("#BMREM" + rowno + "").val($("#BMREM").val());
  $("#BMREM_TD" + rowno + "").html($("#BMREM").val());
  $("#BMPHANTOMFLG" + rowno + "").val($("#BMPHANTOMFLG").val());
  $("#CITEMDRAWNO" + rowno + "").val($("#CITEMDRAWNO").val());
  $("#BMID" + rowno + "").val($("#BMID").val());
  $("#ITEMIMGLOC" + rowno + "").val($("#ITEMIMGLOC").val());
  // <!-- ITEMUNITTYPSTR, BMSUPPLYTYPSTR, BMQTY2, BMCOMB, WCCD, WCNAME, DIVISIONTYP -->
  $("#BMQTY2" + rowno + "").val($("#BMQTY2").val());
  $("#BMCOMB" + rowno + "").val($("#BMCOMB").val());
  $("#WCCD" + rowno + "").val($("#WCCD").val());
  $("#WCNAME" + rowno + "").val($("#WCNAME").val());
  $("#DIVISIONTYP" + rowno + "").val($("#DIVISIONTYP").val());

  // $('#ITEMUNITTYP'+rowno+'').val(document.getElementById("ITEMUNITTYP").value);//dd
  // $('#ITEMUNITTYP_TD'+rowno+'').html($("#ITEMUNITTYP option:selected").text());//dd

  document.getElementById("commitA").disabled = false;
  document.getElementById("updateA").disabled = true;
  document.getElementById("deleteA").disabled = true;
  document.getElementById("ok").disabled = false;

  entry1();
  await keepBomData(); //update data
}
// deleteA.click(function() {

//     return commit('delete');
// });

// function selectRow() {
//     $('table#search_table tr').click(function () {
//         $('table#search_table tr').removeAttr('id');

//         $(this).attr('id', 'click-row');

//         let item = $(this).closest('tr').children('td');

//         $('#KEEPSTATUS').val('UPD');

//         if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
//             document.getElementById("ok").disabled = true;
//             document.getElementById("updateA").disabled = false;
//             document.getElementById("deleteA").disabled = false;
//             $('#ROWNO').val(item.eq(0).text());//text
//             $('#BMBASETYP').val(item.eq(4).text());//text
//             $('#BMCITEMCD').val(item.eq(1).text());//text
//             $('#CITEMNAME').val(item.eq(2).text());//text
//             $('#CITEMSPEC').val(item.eq(3).text());//text
//             $('#CITEMDRAWNO').val(item.eq(38).text());//text
//             $('#BMQTY').val(item.eq(5).text());//text
//             $('#BMADDSTDUNITPRC').val(item.eq(8).text());//text
//             $('#RUNNER_WGT').val(item.eq(10).text());//text
//             $('#REUSE_RATE').val(item.eq(11).text());//text
//             $('#BMADDSRPG').val(item.eq(12).text());//text
//             $('#BMADDSRPUNITPRC').val(item.eq(13).text());//text
//             $('#BMSCRAPRATE').val(item.eq(14).text());//text
//             $('#BMREM').val(item.eq(19).text());//text

//             // $('#BMISSUEDT').val(formatDate(item.eq(15).text()));//date
//             // $('#BMEXPDT').val(formatDate(item.eq(16).text()));//date
//             $('#BMISSUEDT').val(item.eq(15).text().replaceAll("/","-"));//date
//             $('#BMEXPDT').val(item.eq(16).text().replaceAll("/","-"));//date

//             // console.log(item.eq(5).text());
//             // console.log(item.eq(6).value());

//             document.getElementById("ITEMUNITTYP").value = item.eq(6).text();//dd
//             document.getElementById("BMSUPPLYTYP").value = item.eq(17).text();//dd

//             // var subply = document.getElementById("BMSUPPLYTYP ");
//             // for(var i = 0 ;i < subply.options.length; i++) {
//             //     if(subply.options[i].text == item.eq(17).text()) {
//             //         subply.selectedIndex == i;
//             //         break;
//             //     }
//             // }

//             // $('#ITEMUNITTYP').filter(function() {
//             //     return $(this).text = item.eq(6).text();
//             // }).prop('selected', true);

//             // document.getElementById("ITEMUNITTYP").value = item.eq(5).text();//dd
//             // document.getElementById("BMSUPPLYTYP").value = item.eq(17).text();//dd

//             $('#BMPHANTOMFLG').val(item.eq(39).text());
//             if (item.eq(39).text() == "T") {
//                 $('#BMPHANTOMFLG').val(item.eq(39).text());
//                 $('#BMPHANTOMFLG').prop("checked", true)
//             } else {
//                 $('#BMPHANTOMFLG').val('F');
//                 $('#BMPHANTOMFLG').prop("checked", false)
//             }//checkbox

//         }
//         else{
//             document.getElementById("ok").disabled = false;
//             document.getElementById("updateA").disabled = true;
//             document.getElementById("deleteA").disabled = true;
//             // document.getElementById("OK").disabled = true;
//             // console.log(item.eq(5).text());

//             // WCCD WCNAME DIVISIONCD STAFFCD WCTYP WCDISPLAYFLG WCSTDHOURRATE WCSTDCOST WCHOURRATE WCCOST
//             // $('#WCCD').attr('readonly', true).css('background-color', 'lightgray');

//             // text BMBASETYP BMCITEMCD CITEMNAME CITEMSPEC CITEMDRAWNO BMQTY BMADDSTDUNITPRC
//             // RUNNER_WGT REUSE_RATE BMADDSRPG BMADDSRPUNITPRC BMSCRAPRATE BMISSUEDT BMEXPDT BMREM
//             $('#BMBASETYP').val('');//text
//             $('#BMCITEMCD').val('');//text
//             $('#CITEMNAME').val('');//text
//             $('#CITEMSPEC').val('');//text
//             $('#CITEMDRAWNO').val('');//text
//             $('#BMQTY').val('');//text
//             $('#BMADDSTDUNITPRC').val('');//text
//             $('#RUNNER_WGT').val('');//text
//             $('#REUSE_RATE').val('');//text
//             $('#BMADDSRPG').val('');//text
//             $('#BMADDSRPUNITPRC').val('');//text
//             $('#BMSCRAPRATE').val('');//text
//             $('#BMISSUEDT').val('');//text
//             $('#BMEXPDT').val('');//text
//             $('#BMREM').val('');//text

//             // dd ITEMUNITTYP BMSUPPLYTYP
//             document.getElementById("ITEMUNITTYP").value = '';//dd
//             document.getElementById("BMSUPPLYTYP").value = '';//dd

//             //checkbox BMPHANTOMFLG
//             $('#BMPHANTOMFLG').val('F');//checkbox
//             $('#BMPHANTOMFLG').prop("checked", false)//checkbox

//         }

//     if(document.getElementById('KEEPSTATUS').value == "ENT"){
//         // console.log('ENT');
//         document.getElementById("ok").disabled = false;
//         document.getElementById("updateA").disabled = true;
//         document.getElementById("deleteA").disabled = true;
//     }
//     else if(document.getElementById('KEEPSTATUS').value == "UPD"){
//         // console.log('UPD');
//         document.getElementById("ok").disabled = true;
//         document.getElementById("updateA").disabled = false;
//         document.getElementById("deleteA").disabled = false;
//     }
//     else{
//         document.getElementById('KEEPSTATUS').value;
//         // console.log(document.getElementById('KEEPSTATUS').value);
//         // console.log('NONE');
//         document.getElementById("updateA").disabled = true;
//         document.getElementById("deleteA").disabled = true;
//     }

//     });
// }

// async function keepWcData() {
//     const data = new FormData(form);
//     data.append('action', 'keepWcData');
//     // console.log(data);
//     await axios.post('../BMENTRY/function/index_x.php', data)
//     .then(response => {
//         $('#loading').hide();
//         // console.log(response.data)
//     })
//     .catch(e => {
//         console.log(e);
//     });
// }

// async function searchs() {
//     $('#loading').show();
//     form.submit();
//     // let data = new FormData(form);
//     // data.append('action', 'search');
//     // await axios.post('../CATALOGMASTER/function/index_x.php', data)
//     // .then(response => {
//     //     console.log(response.data)
//     // })
//     // .catch(e => {
//     //     console.log(e);
//     // });
// }

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      // clearForm(form);
      // document.getElementById("search").click();
      // window.location.href='index.php?refresh=1';
      // clearForm(form);
      unsetSession();
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../BMENTRY/function/index_x.php", data)
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
  window.location.href = "../BMENTRY/";
  $("#bom_tree").empty("");
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
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function keepBomData() {
  const data = new FormData(form);
  data.append("action", "keepBomData");
  // console.log(data);
  await axios
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      $("#loading").hide();
      console.log(response.data);
    })
    .catch((e) => {
      console.log(e);
    });
}

function changeRowId() {
  var elem = document.getElementsByTagName("tr");
  // console.log(elem);
  for (var i = 0; i < elem.length; i++) {
    // console.log(elem[i].id);
    if (elem[i].id) {
      console.log("changeRowId if");
      index_x = Number(elem[i].rowIndex);
      console.log(index_x);
      elem[i].id = "rowId" + index_x;
    }
  }
}

async function unsetBomItemData(lineIndex) {
  $("#loading").show();
  let data = new FormData(form);
  data.append("action", "unsetBomItemData");
  data.append("lineIndex", lineIndex);
  await axios
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      $("#loading").hide();
      // return calculateAccTotal();
      // console.log(response.data);
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

function expanded(index, level) {
  // console.log(level);
  if (level == 1) {
    $("#title" + index + " .arrow-right").toggleClass("arrow-down");
    $("#bomView" + index + "")
      .stop()
      .slideToggle(500);
  } else if (level == 2) {
    $("#title1" + index + " .arrow-right").toggleClass("arrow-down");
    $("#bomView1" + index + "")
      .stop()
      .slideToggle(500);
  } else if (level == 3) {
    $("#title2" + index + " .arrow-right").toggleClass("arrow-down");
    $("#bomView2" + index + "")
      .stop()
      .slideToggle(500);
  } else if (level == 4) {
    $("#title3" + index + " .arrow-right").toggleClass("arrow-down");
    $("#bomView3" + index + "")
      .stop()
      .slideToggle(500);
  } else if (level == 5) {
  }
}

function selectView(index) {
  $(".select").removeClass("selected");
  $("#selectView" + index + " li").addClass("selected");
}

async function searchDvw(PITEM) {
  $("#loading").show();
  const data = new FormData(form);
  data.append("action", "searchDvw");
  data.append("PITEM", PITEM);
  // data.append("BMPITEMCD", $('#BMPITEMCD').val());
  console.log(PITEM);
  await axios
    .post("../BMENTRY/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      $("#DVWDETAIL").html("");
      $("#PITEM").val(PITEM);
      // $('#ACCOUNTCDID').val(DATA);
      let countRow = 0;
      $.each(response.data, function (key, value) {
        countRow++;

        $("#DVWDETAIL").append(
          '<tr class="tr_border table-secondary" id="rowId' +
            key +
            '">' +
            '<td class="td-class" id="ROWNO_TD' +
            countRow +
            '" style="text-align: center; ">' +
            countRow +
            "</td>" +
            '<td class="td-class" id="BMCITEMCD_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMCITEMCD +
            "</td>" +
            '<td class="td-class" id="CITEMNAME_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.CITEMNAME +
            "</td>" +
            '<td class="td-class" id="CITEMSPEC_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.CITEMSPEC +
            "</td>" +
            '<td class="td-class" id="BMBASETYP_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMBASETYP +
            "</td>" +
            '<td class="td-class" id="BMQTY_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMQTY +
            "</td>" +
            '<td class="td-class" id="ITEMUNITTYP_TD' +
            countRow +
            '" style="display: none">' +
            value.ITEMUNITTYP +
            "</td>" +
            '<td class="td-class" id="ITEMUNITTYPSTR_TD' +
            countRow +
            '">' +
            value.ITEMUNITTYPSTR +
            "</td>" +
            '<td class="td-class" id="BMADDSTDUNITPRC_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMADDSTDUNITPRC +
            "</td>" +
            '<td class="td-class" id="CURRENCYDISP_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.CURRENCYDISP +
            "</td>" +
            '<td class="td-class" id="RUNNER_WGT_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.RUNNER_WGT +
            "</td>" +
            '<td class="td-class" id="REUSE_RATE_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.REUSE_RATE +
            "</td>" +
            '<td class="td-class" id="BMADDSRPG_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMADDSRPG +
            "</td>" +
            '<td class="td-class" id="BMADDSRPUNITPRC_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMADDSRPUNITPRC +
            "</td>" +
            '<td class="td-class" id="BMSCRAPRATE_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMSCRAPRATE +
            "</td>" +
            '<td class="td-class" id="BMISSUEDT_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMISSUEDT +
            "</td>" +
            '<td class="td-class" id="BMEXPDT_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMEXPDT +
            "</td>" +
            '<td class="td-class" id="BMSUPPLYTYP_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMSUPPLYTYP +
            "</td>" +
            '<td class="td-class" id="BMSUPPLYTYPSTR_TD' +
            countRow +
            '">' +
            value.BMSUPPLYTYPSTR +
            "</td>" +
            '<td class="td-class" id="BMREM_TD' +
            countRow +
            '" style="text-align: center; ">' +
            value.BMREM +
            "</td>" +
            '<td class="td-hide"><input type="hidden" id="ROWNO' +
            countRow +
            '" name="ROWNOA[]" value="' +
            countRow +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMCITEMCD' +
            countRow +
            '" name="BMCITEMCDA[]" value="' +
            value.BMCITEMCD +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="CITEMNAME' +
            countRow +
            '" name="CITEMNAMEA[]" value="' +
            value.CITEMNAME +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="CITEMSPEC' +
            countRow +
            '" name="CITEMSPECA[]" value="' +
            value.CITEMSPEC +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMBASETYP' +
            countRow +
            '" name="BMBASETYPA[]" value="' +
            value.BMBASETYP +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMQTY' +
            countRow +
            '" name="BMQTYA[]" value="' +
            value.BMQTY +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="ITEMUNITTYP' +
            countRow +
            '" name="ITEMUNITTYPA[]" value="' +
            value.ITEMUNITTYP +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMADDSTDUNITPRC' +
            countRow +
            '" name="BMADDSTDUNITPRCA[]" value="' +
            value.BMADDSTDUNITPRC +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="CURRENCYDISP' +
            countRow +
            '" name="CURRENCYDISPA[]" value="' +
            value.CURRENCYDISP +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="RUNNER_WGT' +
            countRow +
            '" name="RUNNER_WGTA[]" value="' +
            value.RUNNER_WGT +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="REUSE_RATE' +
            countRow +
            '" name="REUSE_RATEA[]" value="' +
            value.REUSE_RATE +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMADDSRPG' +
            countRow +
            '" name="BMADDSRPGA[]" value="' +
            value.BMADDSRPG +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMADDSRPUNITPRC' +
            countRow +
            '" name="BMADDSRPUNITPRCA[]" value="' +
            value.BMADDSRPUNITPRC +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMSCRAPRATE' +
            countRow +
            '" name="BMSCRAPRATEA[]" value="' +
            value.BMSCRAPRATE +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMISSUEDT' +
            countRow +
            '" name="BMISSUEDTA[]" value="' +
            value.BMISSUEDT +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMEXPDT' +
            countRow +
            '" name="BMEXPDTA[]" value="' +
            value.BMEXPDT +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMSUPPLYTYP' +
            countRow +
            '" name="BMSUPPLYTYPA[]" value="' +
            value.BMSUPPLYTYP +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMREM' +
            countRow +
            '" name="BMREMA[]" value="' +
            value.BMREM +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMPHANTOMFLG' +
            countRow +
            '" name="BMPHANTOMFLGA[]" value="' +
            value.BMPHANTOMFLG +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="CITEMDRAWNO' +
            countRow +
            '" name="CITEMDRAWNOA[]" value="' +
            value.CITEMDRAWNO +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="BMID' +
            countRow +
            '" name="BMIDA[]" value="' +
            value.BMID +
            '"></td>' +
            '<td class="td-hide"><input type="hidden" id="ITEMIMGLOC' +
            countRow +
            '" name="ITEMIMGLOCA[]" value="' +
            value.ITEMIMGLOC +
            '"></td>' +
            // '<td class="td-hide"><input type="hidden" id="ITEMUNITTYPSTR'+countRow+'" name="ITEMUNITTYPSTRA[]" value="' + value.ITEMUNITTYPSTR +'"></td>' +
            // '<td class="td-hide"><input type="hidden" id="BMSUPPLYTYPSTR'+countRow+'" name="BMSUPPLYTYPSTRA[]" value="' + value.BMSUPPLYTYPSTR +'"></td>' +
            // '<td class="td-hide"><input type="hidden" id="BMQTY2'+countRow+'" name="BMQTY2A[]" value="' + value.BMQTY2 +'"></td>' +
            // '<td class="td-hide"><input type="hidden" id="BMCOMB'+countRow+'" name="BMCOMBA[]" value="' + value.BMCOMB +'"></td>' +
            // '<td class="td-hide"><input type="hidden" id="WCCD'+countRow+'" name="WCCDA[]" value="' + value.WCCD +'"></td>' +
            // '<td class="td-hide"><input type="hidden" id="WCNAME'+countRow+'" name="WCNAMEA[]" value="' + value.WCNAME +'"></td>' +
            // '<td class="td-hide"><input type="hidden" id="DIVISIONTYP'+countRow+'" name="DIVISIONTYPA[]" value="' + value.DIVISIONTYP +'"></td>' +
            "</tr>"
        );
      });
      // console.log(countRow);
      if (countRow < 15) {
        for (var i = countRow; i < 15; i++) {
          $("#DVWDETAIL").append(
            '<tr class="tr_border table-secondary" id="rowId' +
              i +
              '">' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              '<td class="td-class"></td>' +
              "</tr>"
          );
        }
      }
      document.getElementById("rowCount").textContent = countRow;
      document.getElementById("loading").style.display = "none";
    })
    .catch((e) => {
      console.log(e);
      document.getElementById("loading").style.display = "none";
    });
}
