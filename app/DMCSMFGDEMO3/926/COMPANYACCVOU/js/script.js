// search
// const searchaccount = $("#searchaccount");
// const searchaccount2 = $("#searchaccount2");

//const setacc = $("#setacc");

//Button Search
// searchaccount.attr('href', $('#sessionUrl').val() + '/guide/SEARCHACCOUNT/index.php?index=1');
// searchaccount2.attr('href', $('#sessionUrl').val() + '/guide/SEARCHACCOUNT/index.php?index=2');

//input serach

// const ACCCDP1 = $("#ACCCDP1");
// const ACCCDP2 = $("#ACCCDP2");
// const WHTCD1 = $("#WHTCD1");
// const WHTCD2 = $("#WHTCD2");

// const input_serach = [ACCCD1, ACCCD2, ACCCD3, ACCCD4, ACCCD5, ACCCDP1, ACCCDP2, WHTCD1, WHTCD2, STDPAYMENTCD1, STDPAYMENTCD2, STDRECEIVECD1, STDRECEIVECD2];

// action button
const insert = $("#insert");
const update = $("#update");
const del = $("#delete");

// form
const form = document.getElementById("companyaccvou");

// for(const input of input_serach){
//     input.change(function () {
//     	$("#loading").show();
//     });

//     input.keyup(function (e) {
//         if (e.key === 'Enter' || e.keyCode === 13) {
//             $("#loading").show();
//         }
//     });
// };

update.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  updated();
  // form.submit();
});

async function updated() {
  const data = new FormData(form);
  data.append("action", "update");

  await axios
    .post("../COMPANYACCVOU/function/index_x.php", data)
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
    .post("../COMPANYACCVOU/function/index_x.php", data)
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
    .post("../COMPANYACCVOU/function/index_x.php", data)
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
  if (form.id == "companyaccvou") {
    // window.location.href = "index.php";
    window.location.href = "../COMPANYACCVOU/";
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
