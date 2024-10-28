// form
const form = document.getElementById('com_operation_setting');

// action button
const updates = $("#update");

updates.click(async function() {
  update();
});

async function update() {
  $("#loading").show();
  const data = new FormData(form);
  data.append('action', 'update');

  await axios.post('../COMPANYSALE/function/index_x.php', data)
  .then(response => {
    // console.log(response.data)
    // clearForm(form);
    window.location.reload();
    $("#loading").hide();
    alert("Update Success!");
  })
  .catch(e => {
      console.log(e);
  });
}


async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'COMPANYSALE');
    await axios
      .post('../COMPANYSALE/function/index_x.php', data)
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
    data.append('action', 'programDelete');

    await axios.post('../COMPANYSALE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch(e => {
        console.log(e);
    });
}

  function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
              programDelete();
            }
        }
    });
}