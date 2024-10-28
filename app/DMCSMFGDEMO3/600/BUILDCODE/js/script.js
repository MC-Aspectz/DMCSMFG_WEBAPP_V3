
// form
const form = document.getElementById('buildcode');


async function run() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'run');
    await axios.post('../BUILDCODE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if(response.data != 'ERRO:ERRORUNCHECK') {
            return alertSuccess();
        } else {
            return alertValidation();
        }
    })
    .catch(e => {
        $('#loading').hide();
        // console.log(e);
    });
}

async function keepData() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../BUILDCODE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();        
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../BUILDCODE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
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

	window.location.href = '../BUILDCODE/';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                return closeApp($('#appcode').val());      
            }
        }
    });
}