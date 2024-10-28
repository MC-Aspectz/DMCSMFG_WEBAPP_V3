//form
const form = document.getElementById('company_cost');

// button
const UPD = $("#UPDATE");


UPD.click(function() {
    // console.log("UPD");

    return commit('update');
});


async function commit(method) {
    $("#loading").show();
    console.log(method);
    let data = new FormData(form);
    data.append('action', method);
    // console.log(data);
    await axios.post('../COMPANYCOST/function/index_x.php', data)
    .then(response => {
        // console.log('Success:',response.data);
        // document.getElementById("SEARCH").click();
        $("#loading").hide();
        // clearForm(form);
        unsetSession();


    })
    .catch(e => {
        console.log(e);
    });
}



async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios
      .post('../COMPANYCOST/function/index_x.php', data)
      .then((response) => {
        // console.log(response.data);
      })
      .catch((e) => {
        document.getElementById("loading").style.display = "none";
      });
  }
  
  async function keepItemData() {
      const data = new FormData(form);
      data.append('action', 'keepItemData');
      // console.log(data);
      await axios.post('../COMPANYCOST/function/index_x.php', data)
      .then(response => {
          $('#loading').hide();
          // console.log(response.data)
      })
      .catch(e => {
          console.log(e);
      });
  }
  
  async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'COMPANYCOST');
    await axios
      .post('../COMPANYCOST/function/index_x.php', data)
      .then((response) => {
        // console.log(response.data)
        clearForm(form);
      })
      .catch((e) => {
        document.getElementById("loading").style.display = "none";
      });
  }
  
  async function programDelete() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'programDelete');
    await axios
      .post('../COMPANYCOST/function/index_x.php', data)
      .then((response) => {
          // console.log(response.data);
          if(response.status == 200) {
              unsetSession();
              return window.location.href = $("#sessionUrl").val() + "/home.php";
          }
      })
      .catch((e) => {
          console.log(e);
          $('#loading').hidden();
      });
  }
  
  async function clearForm(form) {
      // clearing inputs
      var inputs = form.getElementsByTagName('input');
      for (var i = 0; i<inputs.length; i++) {
          switch (inputs[i].type) {
              // case 'hidden':
              case 'text':
                  inputs[i].value = '';
                  break;
              case 'radio':
              case 'checkbox':
                  inputs[i].checked = false; 
          }
      }
      // clearing selects
      var selects = form.getElementsByTagName('select');
      for (var i = 0; i<selects.length; i++)
          selects[i].selectedIndex = 0;
  
      // clearing textarea
      var text= form.getElementsByTagName('textarea');
      for (var i = 0; i < text.length; i++)
          text[i].innerHTML= '';
  
      // clearing table
      $('#table_result > tbody > tr').remove();
  
      // refresh
      window.location.href = '../COMPANYCOST/';
  
      return false;
  }

  async function unsetItemData(lineIndex) {
    $("#loading").show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../COMPANYCOST/function/index_x.php', data)
    .then(response => {
        $("#loading").hide();
        // console.log(response.data);
    })
    .catch(e => {
        console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
    text: txt,
    // background: "#8ca3a3",
    showCancelButton: true,
    // confirmButtonColor: "silver",
    // cancelButtonColor: "silver",
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return programDelete();
        } else if (type == 2) {
            // $("#loading").show();
        } else {
        // 
        }
    }
  });
}

