//form
const form = document.getElementById('accDNCNReport');
//button
const PRINT = $('#PRINT');

PRINT.click(async function() {
    printed();
});

function search() {
    $('#loading').show();
    if (!form.reportValidity()) {
        alertValidation();
        $('#loading').hide();
        return false;
    }
}

async function printed() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'printReport');
    await axios.post('../ACC_DNCNREPORT/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(result, function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ACC_DNCNREPORT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_DNCNREPORT');
    await axios
      .post('../ACC_DNCNREPORT/function/index_x.php', data)
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
    window.location.href = 'index.php';

    return false;
}

function unRequired() {

    let D1 = document.getElementById("D1");
    let DCTYP = document.getElementById("DCTYP");

    D1.classList[D1.value !== '' ? 'remove' : 'add']('req');
    DCTYP.classList[DCTYP.value !== '' ? 'remove' : 'add']('req');
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
            if (type == 1) {
                return closeApp($('#appcode').val());   
            } else if (type == 2) {
                // $("#loading").show();
            } else if(type == 4) {
                return printed();
            }
        }
    });
}

// async function printed() {
//     await keepData();
//     var popupWindow = window.open('../ACC_DNCNREPORT/print.php', '_blank', 'width=800, height=800');
//     setTimeout(function() { popupWindow.close(); }, 10000);  
// } 