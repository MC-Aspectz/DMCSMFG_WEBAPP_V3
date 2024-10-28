// action button
const RUN = $('#RUN');

// form
const form = document.getElementById('MRPProcess');

RUN.click(function () {
    // check validate form
    if (!form.reportValidity()) {
      alertValidation();
      return false;
    }
    return createPlanV2();
 });

async function createPlanV2() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'createPlanV2');
    await axios.post('../MRPPROCESS/function/index_x.php', data)
    .then((response)  => {
        // console.log(response.data);
        clearForm(form);
        $("#loading").hide();
        // return window.location.href='index.php';
    })
    .catch((e) => {
        console.log(e);
    });
}

function unRequired() {

    document.getElementById('MANUFACTURINGPRO').classList[document.getElementById('MANUFACTURINGPRO').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('MANUFACTURINGTYPE').classList[document.getElementById('MANUFACTURINGTYPE').value !== '' ? 'remove' : 'add']('req');
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: txt,
        showCancelButton: type != 3 ? true : false,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return closeApp($('#appcode').val()); 
        } else if (type == 2) {
            // $("#loading").show();
        } else {
        // 
        }
    }
  });
}

async function clearForm(form) {
  // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        switch (inputs[i].type) {
        // case 'hidden':
        case 'text':
            inputs[i].value = '';
            break;
        case 'date':
            inputs[i].value = new Date().dateToInput();
            break;
        case 'radio':
        case 'text':
            inputs[i].value = '';
            break;
        case 'checkbox':
            inputs[i].checked = false;
            break;
        }
    }
  // clearing selects
  var selects = form.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName('textarea');
  for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

  // refresh
  // window.location.href = "index.php";
  // window.location.href = "../MRPPROCESS/";
  unRequired();
  return false;
}

Date.prototype.dateToInput = function() {
  return this.getFullYear() + '-' + ('0' + (this.getMonth() + 1)).substr(-2,2) + '-' + ('0' + this.getDate()).substr(-2,2);
}

Date.prototype.timeToInput = function() {
  return  ('0' + (this.getHours())).substr(-2,2) + ':' + ('0' + this.getMinutes()).substr(-2,2);
}