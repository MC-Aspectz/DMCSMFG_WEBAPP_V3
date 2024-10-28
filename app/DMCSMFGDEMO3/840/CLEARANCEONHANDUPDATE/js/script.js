// icon
const SEARCHLOC = $('#SEARCHLOC');

SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=CLEARANCEONHANDUPDATE&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});

// input
const LOCCD = $('#LOCCD');

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');

// form
const form = document.getElementById('clearanceOnhandUpdate');

SEARCHLOC.click(async function() {
    await keepData();
});

SEARCH.click(async function() {
    await keepData();
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

COMMIT.click(function() {
    return action('commit');
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getLoc(LOCCD.val(), $('#LOCTYP').val());
    }
});

async function getLoc(LOCCD, LOCTYP) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('LOCCD', LOCCD);
    data.append('LOCTYP', LOCTYP);
    data.append('action', 'getLoc');
    await axios.post('../CLEARANCEONHANDUPDATE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
            });
        } else {
            document.getElementById('LOCCD').value = '';
            document.getElementById('LOCNAME').value = '';
        }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../CLEARANCEONHANDUPDATE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if (response.status == '200') {
          if(response.data != 'ERRO:ERRORUNCHECK') {
            return clearForm(form);
          } else {
            return errorDialog();
          }
        }
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../CLEARANCEONHANDUPDATE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'CLEARANCEONHANDUPDATE');
    await axios.post('../CLEARANCEONHANDUPDATE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
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

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
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
    for (var i = 0; i < selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // refresh
    window.location.href = '../CLEARANCEONHANDUPDATE/';
    // emptyTable();
    // $(":checkbox").bind("click", true);

    return false;
}