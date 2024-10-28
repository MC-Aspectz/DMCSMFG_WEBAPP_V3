// form
const form = document.getElementById('accWHTMethod');

// action button
const SEARCH = $('#SEARCH');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

INSERT.click(function() {
    // check validate form
    if ($('#METHODNAME').val() == '' || $('#METHODCD').val() == '') {
        actionDialog(1);
        return false;
    }
    return actionDialog(2);
});

UPDATE.click(function() {
    // check validate form
    if ($('#METHODNAME').val() == '' || $('#METHODCD').val() == '') {
        actionDialog(1);
        return false;
    }
    return actionDialog(3);
});

DELETE.click(function() {
    // check validate form
    if ($('#METHODNAME').val() == '' || $('#METHODCD').val() == '') {
        actionDialog(1);
        return false;
    }
    return actionDialog(4);
});


async function action(action) {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', action);
    await axios.post('../ACC_WHTMETHOD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $("#loading").hide();
            entry();
            window.location.reload();
        }
    })
    .catch(e => {
        $("#loading").hide();
        // console.log(e);
    });
}

function selectRow() {
    $('table#table tbody tr').click(function () {
        $('table#table tbody tr').removeAttr('id');

        let item = $(this).closest('tr').children('td');

        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            // console.log(item.eq(0).text());
            $(this).attr('id', 'selected-row');
            $('#ROWNO').val(item.eq(0).text());
            $('#METHODCD').val(item.eq(1).text());
            $('#METHODCDID').val(item.eq(2).text());
            $('#METHODNAME').val(item.eq(3).text());
            $('#MEMO').val(item.eq(4).text());
            $('#PMNOTE02').val(item.eq(6).text());
            $('#PMNOTE05').val(item.eq(9).text());
            $('#PMNOTE01').val(item.eq(10).text());
           
            document.getElementById('PMNOTE06').value = item.eq(5).text(); 
            document.getElementById('PMNOTE03').value = item.eq(7).text();
            document.getElementById('PMNOTE04').value = item.eq(8).text();
            document.getElementById("INSERT").disabled = true;
            document.getElementById("UPDATE").disabled = false;
            document.getElementById("DELETE").disabled = false;     
            document.getElementById('METHODCD').classList.remove('req');
            document.getElementById('METHODNAME').classList.remove('req');  
        }
    });
}

function entry() {
    $('#ROWNO').val('');
    $('#METHODCD').val('');
    $('#METHODCDID').val('');
    $('#METHODNAME').val('');
    $('#MEMO').val('');
    $('#PMNOTE01').val('');
    $('#PMNOTE02').val('');
    $('#PMNOTE05').val('');
    document.getElementById('PMNOTE03').value = ''; 
    document.getElementById('PMNOTE04').value = '';
    document.getElementById('PMNOTE06').value = '';
    document.getElementById("INSERT").disabled = false;
    document.getElementById("UPDATE").disabled = true;
    document.getElementById("DELETE").disabled = true;
    document.getElementById('METHODCD').classList.add('req');
    document.getElementById('METHODNAME').classList.add('req');
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_WHTMETHOD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ACC_WHTMETHOD');

    await axios.post('../ACC_WHTMETHOD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function unsetItemData(lineIndex) {
    $("#loading").show();
    let data = new FormData(form);
    data.append('action', 'unsetItemData');
    data.append('lineIndex', lineIndex);
    await axios.post('../ACC_WHTMETHOD/function/index_x.php', data)
    .then(response => {
        $("#loading").hide();
        return calculateTotal();
        // console.log(response.data);
    })
    .catch(e => {
        console.log(e);
    });
}

async function programDelete() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'programDelete');
    await axios.post('../ACC_WHTMETHOD/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href = $('#sessionUrl').val() + '/home.php';
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
                unsetSession(form); 
                programDelete();
            } else if(type == 2) {
                return action('insert');
            } else if(type == 3) {
                return action('update');
            } else if(type == 4) {
                return action('delete'); 
            }
        }
    });
}

function alertWarning(msg, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: msg,
        // background: '#8ca3a3',
        showCancelButton: false,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
            if (result.isConfirmed) {
        }
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
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
    // $('#table_result > tbody > tr').remove();

    // refresh
    $('#dvwdetail').empty();
    emptyTable();
    $('#record').html(0);
    // window.location.href = '../ACC_WHTMETHOD/';

    return false;
}

function emptyTable() {
    for (var i = 1; i <= 8; i++) {
        $('#dvwdetail').append( '<tr class="divide-y divide-gray-200" id="rowId'+i+'">'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                    '<td class="h-6 border border-slate-700"></td>'+
                                '</tr>');
    }
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}

function digitFormat(num) {
    while (num.search(",") >= 0) {
        num = (num + "").replace(',', '');
    }
    return parseFloat(num).toFixed(6);
}

function changeRowId() {
    // var elem = document.getElementsByTagName("tr");
    var elem = document.getElementsByClassName('tr_border');
    for (var i = 1; i <= elem.length-1; i++) {
      // console.log(i);
      // if (elem[i].id) {
        // console.log(elem[i].id);
        index_x = Number(elem[i].rowIndex);
        // console.log(index_x);
        elem[i].id = "rowId" + index_x;
      // }
    }
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}