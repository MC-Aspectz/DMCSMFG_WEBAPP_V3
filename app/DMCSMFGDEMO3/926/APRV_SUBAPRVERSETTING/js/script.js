


async function programDelete() {
  $('#loading').show();
  let data = new FormData();
  data.append('action', 'programDelete');
  await axios
    .post('../APRV_SUBAPRVERSETTING/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      return window.location.href = $('#sessionUrl').val() + '/home.php';
    })
    .catch((e) => {
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
        // unsetSession();
        return programDelete();
      }
    }
  });
}
