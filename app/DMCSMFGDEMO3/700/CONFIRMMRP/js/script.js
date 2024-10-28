// button search
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHOFFER = $('#SEARCHOFFER');

SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=CONFIRMMRP', 'authWindow', 'width=1200,height=600');});
SEARCHOFFER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHOFFER/index.php?page=CONFIRMMRP&COSTTYPE=' + $('#COSTTYPES').val(), 'authWindow', 'width=1200,height=600');});

const search_icon = [SEARCHSTAFF, SEARCHOFFER];

// input serach
const STAFFCD = $('#STAFFCD');
const OFFERCODE = $('#OFFERCODE');

// action button
const RUN = $('#RUN');
const SEARCH = $('#SEARCH');

// form
const form = document.getElementById('mrpconfirmation');

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    await keepData();
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

OFFERCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getOffer(OFFERCODE.val(), $('#COSTTYPES').val());
    }
});


RUN.click(function() {
    return action('RUN');
});

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../CONFIRMMRP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if (response.status == '200') {
            return clearForm(form);
        }
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../CONFIRMMRP/function/index_x.php', data)
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
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getOffer(OFFERCODE, COSTTYPE) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('COSTTYPE', COSTTYPE);
    data.append('OFFERCODE', OFFERCODE); 
    data.append('action', 'getOffer');
    await axios.post('../CONFIRMMRP/function/index_x.php', data)
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
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../CONFIRMMRP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../CONFIRMMRP/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            case 'text':
                inputs[i].value = '';
                break;
            case 'date':
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
    window.location.href = '../CONFIRMMRP/';
    //  window.location.href = 'index.php';

    return false;
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
        } else {
        // 
        }
    }
  });
}

function unRequired() {
    document.getElementById('COSTTYPES').classList[document.getElementById('COSTTYPES').value !== '' ? 'remove' : 'add']('req');
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 15; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}
